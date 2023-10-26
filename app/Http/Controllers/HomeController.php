<?php

namespace App\Http\Controllers;

use App\Services\Applications\CarAppService;
use App\Services\Applications\GuestAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected GuestAppService $guestAppService;
    protected CarAppService $carAppService;

    public function __construct(GuestAppService $guestAppService, CarAppService $carAppService)
    {
        $this->guestAppService = $guestAppService;
        $this->carAppService = $carAppService;

    }

    public function index()
    {
        {

            $user = Auth::user();

            $objectsForInvitation = [
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

            $objectsForParking = [
                'К49' => 'Кронверский,49',
                'Л9_1' => 'Ломоносова, 9- Въезд через ворота (главная стоянка, 4 въезд)',
                'Л9_2' => 'Ломоносова, 9- Въезд с Банного переулка (парковка за столовой, 6 въезд)',
                'Л9_3' => 'Ломоносова, 9- Въезд за шлагбаум  (парковка руководства, 5 въезд)',
                'Гривцова, 14' => 'Гривцова, 14',
                'Чайковского, 14' => 'Чайковского, 11',
            ];

            return view('user.applications.index', compact('user', 'objectsForParking', 'objectsForInvitation'));
        }
    }

    public function showAllApplications()
    {
        $user = Auth::user();
        $guestApplications = $this->guestAppService->fetchAllApplications();
        $carApplications = $this->carAppService->fetchAllCarApplications();

        $applications = $guestApplications->concat($carApplications)->sortByDesc('created_at');

        return view('user.applications.showAllApp', compact('user', 'applications'));
    }

}
