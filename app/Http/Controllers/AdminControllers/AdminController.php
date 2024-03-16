<?php

namespace App\Http\Controllers\AdminControllers;

use App\Exports\GuestExport;
use App\Http\Controllers\Controller;

use App\Models\Application;
use App\Models\Enums\ApplicationStatusEnum;
use App\Modules\Admin\AdminPanelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function showAllApplications(AdminPanelService $adminPanelService, Request $request)
    {

//        $applications = $adminPanelService->getAllApplications()->run();

        $filter = $request->input('filter', 'all');

        if ($filter) {
            session(['filter' => $filter]);
        }

        if ($filter != 'all') {
            $applications = Application::where('status', $filter)->get();
        } else {
            $applications = Application::all();
        }

        return view('admin.showAllApp', compact('applications'))->with($filter);
    }



    public function showApplication($type, $id)
    {
        $application = Application::findOrFail($id);

        if (!$application) {
            abort(404);
        }

        $application->viewed = true;
        $application->save();

        return view('admin.showApp', compact('application'));
    }


    public function approveApplication(Request $request, AdminPanelService $adminPanelService)
    {
        $user = Auth::user();

        if (!$user) {
            abort(404);
        }

        $applicationData = $request->only(['id', 'with_letter']);

        $data = $adminPanelService->proccessData($applicationData)->run();

        dd($data);

        $approved_status = $adminPanelService->sendDataToGoogleSheets($data)->run();

        return redirect()->back()->with('approved_status');

    }

    public function pendingApplication(Request $request, AdminPanelService $adminPanelService)
    {
        $user = Auth::user();
        if (!$user) {
            abort(404);
        }

       $application = Application::find($request->input('id'));

        if ($application) {
            // Обновляем нужное поле
            $application->update([
                'status' => ApplicationStatusEnum::pending,
                'approved_by' => $user->id,
                'pending_comment' => $request->input('reason')]);
        }

        return redirect()->back()->with('pending_status');

    }

    public function search(Request $request)
    {
        $appId = $request->input('application_number');

        if(!$appId) {
            return back()->with('message','Введите номер заявки');
        }

        $applications = Application::where('id', $appId)->get();


        if($applications->isEmpty()) {
            return back()->with('message', 'Заявки с ID ' . $request->input('application_number'). ' не существует');
        }

        return view('admin.showAllApp', compact('applications'));
    }


    public function export($appId)
    {
        return Excel::download(new GuestExport($appId), 'guests.xlsx');
    }

}
