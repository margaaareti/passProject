<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarAppRequest;

class CarAppController extends Controller
{

    public function __construct()
    {
        $this->middleware('custom.throttle')->only('store');
    }
    public function store(StoreCarAppRequest $request)
    {


        $validatedData = $request->validated();

        return redirect()->back()->with([
            'success' => 'Форма отправлено успешно',
        ]);
    }
}
