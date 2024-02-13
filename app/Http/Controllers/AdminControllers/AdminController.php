<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\AdminPanelService;

class AdminController extends Controller
{

    public function showAllApplications(AdminPanelService $adminPanelService)
    {

        $allApplications= $adminPanelService->getAllApplications()->run();

        dd($allApplications);

        return view('admin.showAllApp');
    }

}
