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
        $this->middleware('custom.throttle');
        $this->guestAppService = $guestAppService;

    }


    public function index()
    {
        //
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
            return redirect()->back()->withErrors('Ошибка:превышено ограничение количества запросов');
        }

        // Сохраняем время текущего запроса для CSRF токена в сессии сервера
        $request->session()->put('lastRequestTime_' . $token, $currentTime);

        $request->validated($request->all());

        $this->guestAppService->create($request->all());


        return redirect('home', compact('objects'))->withInput()->with('success','Форма отправлено успешно');
    }


    public function show(string $id)
    {
        //
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
