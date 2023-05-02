<?php

namespace App\Http\Controllers\ApplicationControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestAppRequest;
use App\Services\Applications\GuestAppService;
use Illuminate\Http\Request;

class GuestAppController extends Controller
{

    protected GuestAppService $guestAppService;

    public function __construct(GuestAppService $guestAppService)
    {
        $this->guestAppService = $guestAppService;
        $this->middleware('custom.throttle

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

        $request->validated($request->all());

        $this->guestAppService->create($request->all());

        return redirect('home')->withInput();
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
