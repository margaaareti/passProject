<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestAppRequest;
use App\Services\Applications\GuestAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestAppController extends Controller
{

    protected GuestAppService $guestAppService;

    public function __construct(GuestAppService $guestAppService)
    {
        $this->middleware('custom.throttle')->only('store');
        $this->guestAppService = $guestAppService;

    }


    public function index()
    {
        {
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

            $selectedForm = 'Guests';

            return view('user.applications.index', compact('user', 'objectsForParking','objectsForInvitation', 'selectedForm'));
        }
    }


    public function create()
    {
        //
    }


    public function store(StoreGuestAppRequest $request)
    {
        // Получаем время последнего отправленного запроса, связанного с CSRF токеном, из сессии сервера
        $token = $request->input('_token');

        $lastRequestTime = $request->session()->get('lastRequestTime_' . $token, 0);

        //Получаем текущее время
        $currentTime = time();

        if ($currentTime - $lastRequestTime < 5) {
            $request->session()->flashInput($request->input());
            return redirect()->back()->withErrors('Ошибка: превышено ограничение количества запросов');
        }

        // Сохраняем время текущего запроса для CSRF токена в сессии сервера
        $request->session()->put('lastRequestTime_' . $token, $currentTime);


        //Проверяем запрос
        $request->validated($request->all());

        $selectedForm = $request->input('selected_form');

        if (!$selectedForm) {
            $selectedForm = '';
        }

        session()->flash('checkbox1', $request->has('Checkbox1'));
        session()->flash('checkbox2', $request->has('Checkbox2'));

        try {
            $this->guestAppService->create($request->all());
        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage());
        }

        //очищаем поля после успешной отправки
        $clearedFields = [
            'time_start',
            'time_end'
        ];

        //Задаем значения по умолчанию для очищаемых полей
        foreach ($clearedFields as $field) {
            $request->merge([$field => null]);
        }


        return redirect()->back()->with([
            'success' => 'Форма отправлено успешно',
            'selected_form' => $selectedForm
        ]);

    }


    public function showAllApp()
    {
        $user = Auth::user();
        $applications = $this->guestAppService->fetchAllApplications();
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
