@extends('layouts.app')

@section('page.title', 'Заявка №'. $application->id)

@section('content')

        <x-common.nav-buttons>

        </x-common.nav-buttons>

    <div class="container py-3">
        <div class="card-container row">
            <div class="card-container__item">
                <div class="card h-100">

                    <x-title class="card__header card-header text-center d-flex justify-content-center">
                        <h1 class="card-header__title guest-title">{{ __($application->applicationable->getName())}} {{$application->id}}</h1>
                        <div class="approved-info">
                            @if($application->status->isApproved())
                                <p class="approved-info__text text-center">Одобрено
                                    <img class="approved-info__image"
                                         src={{asset('img/approvedAppIcon.png')}} alt="Картинка"></p>
                            @else
                                <p class="approved-info__text">На рассмотрении <img class="approved-info__image"
                                                                                    width="15px" height="15px"
                                                                                    src={{asset('img/wwww.svg')}} alt="Картинка">
                                </p>
                            @endif
                        </div>
                    </x-title>

                    <div class="card__body card-body">
                        <div class="card-body__link mb-2">
                            <a href="{{route('user.app.showAllApp')}}" class="btn mb-2">К списку заявок</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Отправлено</th>
                                    <td>{{$application->created_at->format('H:i:s d.m.Y')}}</td>
                                </tr>
                                <tr>
                                    <th>Дата</th>
                                    <td>c {{date_format(date_create($application->start_date),'d.m.Y')}}
                                        по {{date_format(date_create($application->end_date),'d.m.Y')}} </p></td>
                                </tr>
                                <tr>
                                    <th>Локация</th>
                                    <td>{{$application->object}}</td>
                                </tr>
                                <tr>
                                    <th>Цель</th>
                                    <td>{{$application->purpose}}</td>
                                </tr>
                                @if($application->equipment)
                                    <tr>
                                        <th>Имущество/Оборудование
                                        </th>
                                        <td>{{$application->equipment}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Ответственный:</th>
                                    <td>{{$application->responsible_person}}</td>
                                </tr>
                                @if($application->applicationable->guests)
                                    <tr>
                                        <th>Приглашенные</th>
                                        <td>
                                            <div id="vueApp">
                                                <vue-app data-application-id="{{$application->applicationable->id}}"
                                                         data-application-created="{{ $application->created_at }}"></vue-app>
                                            </div>
                                        </td>
                                    </tr>
                                @elseif($application->applicationable->cars)
                                    <tr>
                                        <th>Количество авто, указанных в
                                            заявке:
                                        </th>
                                        <td>{{$application->applicationable->cars_count}}</td>
                                    </tr>
                                    <tr>
                                        <th>Количество авто, указанных в
                                            заявке:
                                        </th>
                                        <td>
                                            <div class="card-body__car-block">
                                                <ul class="card-body__list car-list">
                                                    @foreach ($application->applicationable->cars as $car)
                                                        <li class="card-body__text">{{ $car->number }}</li>
                                                    @endforeach
                                                </ul>
                                                <x-button class="card-body__button">
                                                    + Добавить автомобиль
                                                </x-button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection


{{--                        <p class="card-body__text">--}}
{{--                            <strong>Отправлено:</strong> {{$application->created_at->format('H:i:s d.m.Y')}}</p>--}}
{{--                        <p class="card-body__text"><strong>Дата:</strong>--}}
{{--                            c {{date_format(date_create($application->start_date),'d.m.Y')}}--}}
{{--                            по {{date_format(date_create($application->end_date),'d.m.Y')}} </p>--}}
{{--                        <p class="card-body__text"><strong>Локация:</strong>: {{$application->object}}</p>--}}
{{--                        <p class="card-body__text"><strong>Цель:</strong> {{$application->purpose}}</p>--}}
{{--                        @if($application->equipment)--}}
{{--                            <p class="card-body__text"><strong>Вносимое--}}
{{--                                    оборудование:</strong> {{$application->equipment}}</p>--}}
{{--                        @endif--}}
{{--                        <p class="card-body__text"><strong>Ответственный:</strong> {{$application->responsible_person}}--}}
{{--                        </p>--}}

{{--                        @if($application->applicationable->guests)--}}

{{--                            <div id="vueApp">--}}
{{--                                <vue-app data-application-id="{{$application->applicationable->id}}"--}}
{{--                                         data-application-created="{{ $application->created_at }}"></vue-app>--}}
{{--                            </div>--}}

{{--                        @elseif($application->applicationable->cars)--}}
{{--                            <p class="card-body__text"><strong>Количество авто, указанных в--}}
{{--                                    заявке:</strong> {{$application->applicationable->cars_count}}</p>--}}
{{--                            <div class="card-body__car-block">--}}
{{--                                <ul class="card-body__list car-list">--}}
{{--                                    @foreach ($application->applicationable->cars as $car)--}}
{{--                                        <li class="card-body__text">{{ $car->number }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                                <x-button class="card-body__button">--}}
{{--                                    + Добавить автомобиль--}}
{{--                                </x-button>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                    </div>--}}

