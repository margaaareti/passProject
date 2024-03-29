@extends('layouts.app')

@section('page.title', 'Мои заявки')

@section('content')

    <div id="new">

        <button-component></button-component>


        <x-common.nav-buttons>

        </x-common.nav-buttons>

        <div class="container py-3">
            <div class="card-container">
                @forelse($applications as $application)
                    <div class="card-container__item">
                        <div class="card h-100">
                                <div class="card__header card-header text-center">
                                    <a class="card-header__link"
                                       href="{{route('user.app.' . $application->getUrl(), $application->id)}}">{{ __($application->getName())}} {{$application->id}}</a>
                                </div>

                            <div class="card__body card-body">

                                <div class="approved-info">
                                    @if($application->is_approved === true)
                                        <p class="approved-info__text">Одобрено <img class="approved-info__image"
                                                                                     src={{asset('img/approvedAppIcon.png')}} alt="Картинка">
                                        </p>
                                    @else
                                        <p class="approve-info__text">
                                            На рассмотрении <img class="approved-info__image"
                                                                 src={{asset('img/wwww.svg')}} alt="Картинка"></p>
                                    @endif
                                </div>

                                <p class="card-body__text">
                                    Отправлено: {{$application->created_at->format('H:i:s d.m.Y')}}</p>
                                @if($application['application_type'] === 'Внос/Вынос')
                                    <p class="card-body__text">Тип действия: {{$application->type}}</p>
                                    @if($application['property-in-date'] || $application['object_in'] )
                                        <p class="card-body__text">Дата
                                            вноса: {{date_format(date_create($application->{'property-in-date'}),'d.m.Y')}}
                                        <p class="card-body__text">Локация: {{$application->object_in}}</p>
                                    @endif
                                    @if($application['property-out-date'] || $application['object_out'])
                                        <p class="card-body__text">Дата
                                            выноса: {{date_format(date_create($application->{'property-out-date'}),'d.m.Y')}}
                                        <p class="card-body__text">Локация: {{$application->object_out}}</p>
                                    @endif
                                    <p class="card-body__text">Имущество: {{$application->equipment}}</p>
                                    <p class="card-body__text">Цель: {{$application->purpose}}</p>
                                    <p class="card-body__text">Ответственный: {{$application->responsible_person}}</p>
                                @else
                                    <p class="card-body__text">Дата:
                                        c {{date_format(date_create($application->start_date),'d.m.Y')}}
                                        по {{date_format(date_create($application->end_date),'d.m.Y')}} </p>
                                    <p class="card-body__text">Локация: {{$application->object}}</p>
                                    <p class="card-body__text">Цель: {{$application->purpose}}</p>
                                    <p class="card-body__text">Ответственный: {{$application->responsible_person}}</p>
                                @endif
                                @if ($application->guests)
                                    <p class="card-body__text">Количество лиц, указанных в
                                        заявке: {{$application->guests_count}}</p>

                                    <ul class="card-body__list guest-list">
                                        @php $guestCount = count($application->guests); @endphp <!-- Считаем количество гостей -->
                                        @foreach ($application->guests as $index => $guest)
                                            <li class="card-body__text @if($index >= 2) hidden @endif">{{ $guest->name }}</li>
                                            <!-- Показываем всех гостей -->
                                        @endforeach
                                    </ul>

                                    @if($guestCount > 2)
                                        <!-- Если гостей больше 3, показываем кнопку "Скрыть всех" -->
                                        <button class="card-body_button" onclick="showAllGuests(this)">Показать всех
                                        </button>
                                    @endif

                                @elseif ($application->cars)
                                    <p class="card-body__text">Количество авто, указанных в
                                        заявке: {{$application->cars_count}}</p>
                                    <ul class="card-body__list car-list">
                                        @php $carsCount = count($application->cars); @endphp <!-- Считаем количество авто -->
                                        @foreach ($application->cars as $index => $car)
                                            <li class="card-body__text @if($index >= 2) hidden @endif">{{ $car->number }}</li>
                                        @endforeach
                                        @if($carsCount > 2)
                                            <!-- Если гостей больше 3, показываем кнопку "Скрыть всех" -->
                                            <button class="card-body_button" onclick="showAllGuests(this)">Показать
                                                всех
                                            </button>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p class="empty-state__text text-white text-center">Нет заявок</p>
                    </div>
                @endforelse
            </div>


            <script>
                function showAllGuests(button) {
                    const list = button.parentElement.querySelector('.card-body__list');
                    const listItems = list.querySelectorAll('li');

                    for (let i = 2; i < listItems.length; i++) {
                        listItems[i].classList.toggle('hidden'); // Переключаем класс "hidden" у всех элементов списка начиная с 2-го элемента
                    }

                    if (button.innerText === 'Скрыть') {
                        button.innerText = 'Показать всех';
                    } else {
                        button.innerText = 'Скрыть';
                    }
                }
            </script>
        </div>
    </div>

@endsection
