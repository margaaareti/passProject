@extends('layouts.app')

@section('page.title', 'Мои заявки')

@section('content')

    <div id="new">

        <x-common.nav-buttons>

        </x-common.nav-buttons>

        <div class="container py-3">


            <div class="mb-3">
                <select class="form-select" name="filterAppCard" id="filterAppCard" onchange="applyFilterCard(this.value)">
                    <option value="new" {{ session('filter') == 'all' ? 'selected' : '' }}>Все</option>
                    <option value="pending" {{ session('filter') == 'pending' ? 'selected' : '' }}>Ожидающие</option>
                    <option value="approved" {{ session('filter') == 'approved' ? 'selected' : '' }}>Одобренные</option>
                </select>
            </div>

            <div class="card-container">
                @forelse($applications as $application)
                    <div class="card-container__item">
                        <div class="card h-100">

                            <div class="card__header card-header text-center">
                                <a class="card-header__link"
                                   href="{{route('user.app.' . $application->applicationable->getUrl(), $application->id)}}">{{ __($application->applicationable->getName())}} {{$application->applicationable->getApplicationId()}}</a>
                            </div>

                            <div class="card__body card-body">

                                <div class="approved-info">
                                    @if($application->status->isApproved())
                                        <p class="approved-info__text">Одобрено <img class="approved-info__image"
                                                                                     src={{asset('img/approvedAppIcon.png')}} alt="Картинка">
                                        </p>
                                    @elseif($application->status->isPending())
                                        <p class="approve-info__text">
                                            Ожидает доп. согласования <img class="approved-info__image ms-1"
                                                                 src={{asset('img/pending.svg')}} alt="Картинка"></p>
                                    @else
                                        <p class="approve-info__text">
                                            На рассмотрении <img class="approved-info__image"
                                                                 src={{asset('img/wwww.svg')}} alt="Картинка"></p>
                                    @endif
                                </div>

                                <p class="card-body__text">
                                    Отправлено: {{$application->created_at->format('H:i:s d.m.Y')}}
                                </p>

                                @if($application['application_type'] === 'Внос/Вынос')
                                    <p class="card-body__text">Тип действия: {{$application->type}}</p>
                                    @if($application->applicationable->object_in)
                                        <p class="card-body__text">Дата
                                            вноса: {{date_format(date_create($application->start_date),'d.m.Y')}}
                                        <p class="card-body__text">
                                            Локация: {{$application->applicationable->object_in}}</p>
                                    @endif
                                    @if($application->applicationable->object_out)
                                        <p class="card-body__text">Дата
                                            выноса: {{date_format(date_create($application->end_date),'d.m.Y')}}
                                        <p class="card-body__text">
                                            Локация: {{$application->applicationable->object_out}}</p>
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

                                @if ($application->applicationable->guests)
                                    <p class="card-body__text">Количество лиц, указанных в
                                        заявке: {{$application->applicationable->guests_count}}</p>

                                    <ul class="card-body__list guest-list">
                                        @php $guestCount = count($application->applicationable->guests); @endphp <!-- Считаем количество гостей -->
                                        @foreach ($application->applicationable->guests as $index => $guest)
                                            <li class="card-body__text @if($index >= 2) hidden @endif">{{ $guest->name }}</li>
                                            <!-- Показываем всех гостей -->
                                        @endforeach
                                    </ul>

                                    @if($guestCount > 2)
                                        <!-- Если гостей больше 3, показываем кнопку "Скрыть всех" -->
                                        <button class="card-body_button" onclick="showAllGuests(this)">Показать всех
                                        </button>
                                    @endif

                                @elseif ($application->applicationable->cars)
                                    <p class="card-body__text">Количество авто, указанных в
                                        заявке: {{$application->applicationable->cars_count}}</p>
                                    <ul class="card-body__list car-list">
                                        @php $carsCount = count($application->applicationable->cars); @endphp <!-- Считаем количество авто -->
                                        @foreach ($application->applicationable->cars as $index => $car)
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

                function applyFilterCard(filter) {
                    // Формируем URL с параметром фильтра и перезагружаем страницу
                    window.location.href = window.location.pathname + '?filter=' + filter;
                }

            </script>
        </div>
    </div>

@endsection
