<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

if (!function_exists('active_link')) {
    function active_link(string $name, string $active = 'active'): string
    {
      return Route::is($name) ? $active : '';
    }
}


if(!function_exists('checkRequestLimit')) {

    function checkRequestLimit(Request $request, $seconds = 5)
    {
        // Получаем время последнего отправленного запроса, связанного с CSRF токеном, из сессии сервера
        $token = $request->input('_token');

        $lastRequestTime = $request->session()->get('lastRequestTime_' . $token, 0);

        $currentTime = time();

        if ($currentTime - $lastRequestTime < $seconds ) {
            $request->session()->flashInput($request->input());
            return redirect()->back()->withErrors('Ошибка: превышено ограничение количества запросов');
        }

        $request->session()->put('lastRequestTime_' . $token, $currentTime);
    }
}
