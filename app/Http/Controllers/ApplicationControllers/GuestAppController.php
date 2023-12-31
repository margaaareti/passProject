<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequests\StoreGuestAppRequest;
use App\Jobs\EmailNotificationsJobs\Guests\SendAddNewGuestNotification;
use App\Models\PeopleApplication;
use App\Services\Applications\CarAppService;
use App\Services\Applications\GuestAppService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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


    public function create()
    {
        //
    }


    public function store(StoreGuestAppRequest $request)
    {

        $limitExceeded = checkRequestLimit($request, 5);
        if ($limitExceeded) {
            return $limitExceeded;
        }

        $selectedForm = $request->input('selected_form');
        if (!$selectedForm) {
            $selectedForm = '';
        }


        session(['selected_form' => $selectedForm]);
        session()->flash('checkbox1', $request->has('Checkbox1'));
        session()->flash('checkbox2', $request->has('Checkbox2'));

//        for ($i = 0; $i <= 1; $i++) {
        try {
            $guestApplicationId = $this->guestAppService->create($request->all());
        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage())->with('selected_form', $selectedForm);
        }
//        }

        if ($guestApplicationId !== null) {

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


    public function showApp($id)
    {
        $user = Auth::user();
        $application = $this->guestAppService->fetchApplication($id);
        return view('user.applications.showApp', compact('user', 'application'));
    }

    public function getGuestsList($id): JsonResponse
    {
        $application = PeopleApplication::find($id);
        return response()->json($application->guests);
    }

    public function addGuestToList(Request $request, $id): JsonResponse
    {

        try {
            $application = PeopleApplication::with('guests')->find($id);

            if (!$application) {
                return response()->json(['error' => 'Application not found'], 404);
            }

            $user = auth()->user();

            $data = [
                'application_number' => $application->application_number,
                'guest_name' => $request->input('fullName'),
                'user_name' => optional(auth()->user())->last_name . ' ' . optional(auth()->user())->name . ' ' . optional(auth()->user())->patronymic,
                'user_department' => optional($user)->department,
            ];

            // Кладем нового гостя в бд и увеличиваем счетчик
            $newGuest = $application->guests()->create([
                'name' => $data['guest_name'],
            ]);

            $application->increment('guests_count');


            // Передайте данные в задачу
            dispatch(new SendAddNewGuestNotification($data));
        } catch (\Exception $error) {
            Log::error('Ошибка добавления нового гостя в заявку: ' . $error->getMessage());
            return response()->json(['error' => $error->getMessage()], 500);
        }

        return response()->json($newGuest);
    }


    public function edit(string $applicationId)
    {
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
