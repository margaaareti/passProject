<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;


class TestController extends Controller
{
    public function show(Request $request)
    {

        return view('test');

    }

    public function send(Request $request)
    {

        $email = $request->input('email');

        $array=[
            $email,
        ];

        $range = 'A2:D2';


        Sheets::spreadsheet(config('google.post_spreadsheet_id'))->sheetById('google.post_sheet_id')->range($range)->append([$array]);


        return redirect('test');

    }
}
