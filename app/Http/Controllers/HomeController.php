<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
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

        return view('home', compact('user', 'objects'));
    }
}
