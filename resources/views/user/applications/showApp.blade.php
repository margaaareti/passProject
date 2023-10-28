@extends('layouts.app')

@section('page.title', 'Заявка №'. $application->id)

@section('content')
    <x-common.nav-buttons>

    </x-common.nav-buttons>

    <div class="container py-3">
        <div class="card-container">
            <div class="card-container__item">
                <div class="card h-100">
                    @if($application->guests)
                        <x-title class="card__header card-header text-center">
                            <h1 class="card-header__guest-title">{{ __('Заявка на проход посетителей №')}} {{$application->id}}</h1>
                        </x-title>
                    @elseif($application->cars)
                        <x-title class="card__header card-header text-center">
                            <h1 class="card-header__car-title">{{ __('Заявка на въезд автотранспорта №')}} {{$application->id}}</h1>
                        </x-title>
                    @endif
                    <x-slot name="right">
                        <x-button>
                            <a class="nav-buttons__link nav-link" href="*">Какая-то кнопка</a>
                        </x-button>
                    </x-slot>

                    <div class="card__body card-body">
                        <div class="card-body__link mb-2">
                            <a href="{{route('user.app.showAllApp')}}">К списку заявок</a>
                        </div>
                        <p class="card-body__text">
                            <strong>Отправлено:</strong> {{$application->created_at->format('H:i:s d.m.Y')}}</p>
                        <p class="card-body__text"><strong>Дата:</strong> c {{$application->start_date}}
                            по {{$application->end_date}} </p>
                        <p class="card-body__text"><strong>Локация</strong>: {{$application->object}}</p>
                        <p class="card-body__text"><strong>Цель:</strong> {{$application->purpose}}</p>
                        <p class="card-body__text">
                            <strong>Ответственный:</strong> {{$application->responsible_person}}
                        </p>
                        @if($application->guests)
                            <p class="card-body__text"><strong>Количество лиц, указанных в
                                    заявке:</strong> {{$application->guests_count}}</p>
                            <div class="card-body__guest-block">
                                <ul class="card-body__list">
                                    @foreach ($application->guests as $guest)
                                        <li class="card-body__text">{{ $guest->name }}</li>
                                    @endforeach
                                </ul>
                                <x-button class="card-body__button">
                                    + Добавить гостя
                                </x-button>
                                @elseif($application->cars)
                                    <p class="card-body__text"><strong>Количество авто, указанных в
                                            заявке:</strong> {{$application->cars_count}}</p>
                                    <div class="card-body__car-block">
                                        <ul class="card-body__list">
                                            @foreach ($application->cars as $car)
                                                <li class="card-body__text">{{ $car->number }}</li>
                                            @endforeach
                                        </ul>
                                        <x-button class="card-body__button">
                                            + Добавить автомобиль
                                        </x-button>
                                        @endif
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
