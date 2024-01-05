<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationsRequests\StorePropertyAppRequest;

class PropertyAppController extends Controller
{
    public function store(StorePropertyAppRequest $request)
    {

        dd($request->all());

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
//        try {
//            $guestApplicationId = $this->guestAppService->create($request->all());
//        } catch (\Exception $error) {
//            return redirect()->back()->withErrors($error->getMessage())->with('selected_form', $selectedForm);
//        }
////        }
//
//        if ($guestApplicationId !== null) {
//
//            //очищаем поля после успешной отправки
//            $clearedFields = [
//                'time_start',
//                'time_end'
//            ];
//
//            //Задаем значения по умолчанию для очищаемых полей
//            foreach ($clearedFields as $field) {
//                $request->merge([$field => null]);
//            }
//
//            return redirect()->route('user.app.showApp', $guestApplicationId)->with([
//                'success' => 'Форма отправлено успешно',
//                'selected_form' => $selectedForm
//            ]);
//
//        } else {
//            return redirect()->back()->withErrors('Форма не была отправлена по неизвестным причинам. Просьбма обратиться к администратора');
//        }
    }
}
