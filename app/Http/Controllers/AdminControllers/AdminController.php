<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use App\Modules\Admin\AdminPanelService;
use App\Modules\Admin\ModelExtractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function showAllApplications(AdminPanelService $adminPanelService)
    {

        $applications = $adminPanelService->getAllApplications()->run();

        return view('admin.showAllApp', compact('applications'));
    }

    public function showApplication($type,$id)
    {
        $application = ModelExtractor::getModel($type,$id);

        if (!$application) {
            abort(404);
        }

        $application->viewed=true;
        $application->save();

        // Здесь вы можете передать данные в представление и отобразить их
        return view('admin.showApp', compact('application'));
    }


    public function approveApplication(Request $request, AdminPanelService $adminPanelService)
    {
        $user= Auth::user();

        if(!$user){
            abort(404)
;        }

        $data = $request->all();
        unset($data['_token']);

       $data = $adminPanelService->proccessData($data)->run();
       dd($data);

    }

}
