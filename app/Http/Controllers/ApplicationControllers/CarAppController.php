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


        try {
            $this->carAppService->create($request->all());
            return redirect('carPage')->with([
                'success' => 'Форма отправлено успешно',
            ]);

        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage());
        }

    }
}
