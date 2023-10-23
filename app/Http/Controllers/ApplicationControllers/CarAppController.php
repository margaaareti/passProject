<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarAppRequest;
use App\Services\Applications\CarAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarAppController extends Controller
{

    protected CarAppService $carAppService;

    public function __construct(CarAppService $carAppService)
    {
        $this->middleware('custom.throttle')->only('store');
        $this->carAppService = $carAppService;
    }


    public function index(){

        $selectedForm="";
        $objectsForParking = [
            'К49' => 'Кронверский,49',
            'Л9_1' => 'Ломоносова, 9- Въезд через ворота (главная стоянка, 4 въезд)',
            'Л9_2' => 'Ломоносова, 9- Въезд с Банного переулка (парковка за столовой, 6 въезд)',
            'Л9_3' => 'Ломоносова, 9- Въезд за шлагбаум  (парковка руководства, 5 въезд)',
            'Гривцова, 14' => 'Гривцова, 14',
            'Чайковского, 14' => 'Чайковского, 11',
        ];

        $user= Auth::user();

        return view('carPage', compact('user', 'objectsForParking','selectedForm'));
    }



    public function store(StoreCarAppRequest $request)
    {


        $limitExceeded = checkRequestLimit($request, 5);
        if ($limitExceeded) {
            return $limitExceeded;
        }


        $selectedForm = $request->input('selected_form');
        if (!$selectedForm) {
            $selectedForm = '';
        }


        session()->flash('checkbox1', $request->has('Checkbox1'));
        session()->flash('checkbox2', $request->has('Checkbox2'));


        try {
            $this->carAppService->create($request->all());
            return redirect()->route('user.app')->with([
                'success' => 'Форма отправлено успешно',
                'selected_form' => $selectedForm
            ]);

        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage());
        }

    }

//    public function showAllApp()
//    {
//        $user = Auth::user();
//        $applications = $this->carAppService->fetchAllCarApplications();
//        return view('user.applications.showAllApp', compact('user', 'applications'));
//    }
//
//    public function showApp($id)
//    {
//        $user = Auth::user();
//        $application = $this->carAppService->fetchCarApplication($id);
//        return view('user.applications.showApp', compact('user', 'application'));
//    }

}
