<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestAppRequest;
use App\Services\Applications\CarAppService;
use App\Services\Applications\GuestAppService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GuestAppController extends Controller
{

    protected GuestAppService $guestAppService;
    protected CarAppService $carAppService;

    public function __construct(GuestAppService $guestAppService, CarAppService $carAppService)
    {
        $this->middleware('custom.throttle')->only('store');
        $this->guestAppService = $guestAppService;
        $this->carAppService = $carAppService;

    }


    public function index()
    {
        {
            $selectedForm = '';

            $user = Auth::user();

            $objectsForInvitation = [
                'К49' => 'Кронверский,49',
                'Л9' => 'Ломоносова,9',
                'Л9 лит.М' => 'Ломоносова,9 (здание бывш. церкви)',
                'Гривцова 14' => 'Гривцова,14',
                'Биржевая 4' => 'Биржевая,4',
                'Биржевая 14' => 'Биржевая,14',
                'Биржевая 16' => 'Биржевая,16',
                'Хрустальная 14' => 'Хрустальная,14',
                'Чайковского 14' => 'Чайковского,11',
//            'Песочная 14' => 'Песочная,14',
//            'Вяземский 5-7' => 'Вяземский',
//            'Ленсовета 23' => 'Ленсовета',
//            'Новоизмайловский,34' => 'Новоизмайловский',
//            '2-я Комсомольская 5-7' => '2-я Комсомольская',
//            'Альпийский 15' => 'Альпийский 15',
//            'Кадетская 3' => 'Кадетская 3',
//            'Ягодное' => 'Ягодное',
            ];

            $objectsForParking = [
                'К49' => 'Кронверский,49',
                'Л9_1' => 'Ломоносова, 9- Въезд через ворота (главная стоянка, 4 въезд)',
                'Л9_2' => 'Ломоносова, 9- Въезд с Банного переулка (парковка за столовой, 6 въезд)',
                'Л9_3' => 'Ломоносова, 9- Въезд за шлагбаум  (парковка руководства, 5 въезд)',
                'Гривцова, 14' => 'Гривцова, 14',
                'Чайковского, 14' => 'Чайковского, 11',
            ];

            return view('user.applications.index', compact('user', 'objectsForParking','objectsForInvitation', 'selectedForm'));
        }
    }


    public function create()
    {
        //
    }


    public function store(StoreGuestAppRequest $request)
    {

        $limitExceeded = checkRequestLimit($request,5);
        if ($limitExceeded) {
            return $limitExceeded;
        }

        $selectedForm = $request->input('selected_form');
        if (!$selectedForm) {
            $selectedForm = '';
        }


        session(['selected_form'=>$selectedForm]);
        session()->flash('checkbox1', $request->has('Checkbox1'));
        session()->flash('checkbox2', $request->has('Checkbox2'));

        try {
           $guestApplicationId = $this->guestAppService->create($request->all());
        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage())->with('selected_form', $selectedForm);
        }

        if($guestApplicationId !== null) {

            //очищаем поля после успешной отправки
            $clearedFields = [
                'time_start',
                'time_end'
            ];

            //Задаем значения по умолчанию для очищаемых полей
            foreach ($clearedFields as $field) {
                $request->merge([$field => null]);
            }

            return redirect()->route('user.app.showApp', $guestApplicationId)->with([
                'success' => 'Форма отправлено успешно',
                'selected_form' => $selectedForm
            ]);

        } else {
            return redirect()->back()->withErrors('Форма не была отправлена по неизвестным причинам. Просьбма обратиться к администратора');
        }
    }


    public function showAllApp()
    {
        $user = Auth::user();
        $guestApplications = $this->guestAppService->fetchAllApplications();
        $carApplications = $this->carAppService->fetchAllCarApplications();

        $applications = $guestApplications->concat($carApplications)->sortByDesc('created_at');

        return view('user.applications.showAllApp', compact('user', 'applications'));
    }

    public function showApp($id)
    {
        $user = Auth::user();
        $application = $this->guestAppService->fetchApplication($id);
        return view('user.applications.showApp', compact('user', 'application'));
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
