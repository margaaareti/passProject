<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationsRequests\StorePropertyAppRequest;
use App\Services\Applications\PropertyAppService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyAppController extends Controller
{

    public function __construct(protected PropertyAppService $propertyAppService)
    {
    }


    public function store(StorePropertyAppRequest $request)
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

        try {
            $propertyApplicationId = $this->propertyAppService->create($request->all());
        } catch
        (\Exception $error) {
            Log::error('Error sending data Repository: ' . $error->getMessage());
            return redirect()->back()->withErrors($error->getMessage())->with('selected_form', $selectedForm);
        }

        if ($propertyApplicationId !== null) {
            return redirect()->route('user.app.showPropertyApp', $propertyApplicationId)->with([
                'success' => 'Форма отправлено успешно',
                'selected_form' => $selectedForm
            ]);

        } else {
            return redirect()->back()->withErrors('Возникли проблемы с подачей заявки. Обратитесь к администратору')->with([
                    'selected_form' => $selectedForm
                ]
            )->withInput();
        }
    }


    public function showApp($id)
    {
        $user = Auth::user();
        $application = $this->propertyAppService->fetchApplication($id);
        return view('user.applications.showPropertyApp', compact('user', 'application'));
    }
}
