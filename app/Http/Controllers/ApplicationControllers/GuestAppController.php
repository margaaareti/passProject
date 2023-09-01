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

            $objects = [
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

            $selectedForm = 'Car';

            return view('applications.index', compact('user', 'objects', 'selectedForm'));
        }
    }


    public function create()
    {
        //
    }


    public function store(StoreGuestAppRequest $request)
    {

        $token = $request->input('_token');

        // Получаем время последнего отправленного запроса, связанного с CSRF токеном, из сессии сервера
        $lastRequestTime = $request->session()->get('lastRequestTime_' . $token, 0);

        //Получаем текущее время
        $currentTime = time();

        if ($currentTime - $lastRequestTime < 5) {

            $request->session()->flashInput($request->input());
            return redirect()->back()->withErrors('Ошибка: превышено ограничение количества запросов');
        }

        // Сохраняем время текущего запроса для CSRF токена в сессии сервера
        $request->session()->put('lastRequestTime_' . $token, $currentTime);

        $request->validated($request->all());

        try {
            $this->guestAppService->create($request->all());

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
            ]);

        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage());
        }
    }


    public function show()
    {
        $user = Auth::user();
        return view('applications.show',compact('user'));
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
