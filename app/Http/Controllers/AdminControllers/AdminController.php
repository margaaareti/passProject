<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\CarApplication;
use App\Models\PeopleApplication;
use App\Models\PropertyApplication;
use App\Modules\Admin\AdminPanelService;

class AdminController extends Controller
{

    public function showAllApplications(AdminPanelService $adminPanelService)
    {

        $applications = $adminPanelService->getAllApplications()->run();

        return view('admin.showAllApp', compact('applications'));
    }

    public function showApplication($type,$id)
    {
        $application = match ($type) {
            'car' => CarApplication::findOrFail($id),
            'property' => PropertyApplication::findOrFail($id),
            'people' => PeopleApplication::findOrFail($id),
            default => abort(404), // Если тип модели неправильный, выведите ошибку 404
        };

        // Здесь вы можете передать данные в представление и отобразить их
        return view('admin.showApp', compact('application'));

    }

}
