<?php

namespace App\Http\Controllers\AdminControllers;

use App\Exports\GuestExport;
use App\Http\Controllers\Controller;

use App\Models\Application;
use App\Modules\Admin\AdminPanelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function showAllApplications(AdminPanelService $adminPanelService)
    {

        $applications = $adminPanelService->getAllApplications()->run();

        return view('admin.showAllApp', compact('applications'));
    }

    public function showApplication($type, $id)
    {
        $application = Application::findOrFail($id);

        if (!$application) {
            abort(404);
        }

        $application->viewed = true;
        $application->save();

        // Здесь вы можете передать данные в представление и отобразить их
        return view('admin.showApp', compact('application'));
    }


    public function approveApplication(Request $request, AdminPanelService $adminPanelService)
    {
        $user = Auth::user();

        if (!$user) {
            abort(404);
        }

        $applicationId = $request->input('id');

        $data = $adminPanelService->proccessData($applicationId)->run();

        $approved_status = $adminPanelService->sendDataToGoogleSheets($data)->run();

       return redirect()->back()->with('approved_status');

    }
    public function export($appId)
    {
        return Excel::download(new GuestExport($appId), 'guests.xlsx');
    }


}
