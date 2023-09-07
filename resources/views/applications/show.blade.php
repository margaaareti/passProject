@extends('layouts.app')

@section('page.title', 'Мои заявки')

@section('content')
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="nav-buttons">
                    <button type="button" class="nav-buttons__button btn btn-primary">
                        <a class="nav-buttons__link nav-link" href="{{ route('home') }}">Ссылка на главную</a>
                    </button>

                    <button type="button" class="nav-buttons__button btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                        <a class="nav-buttons__link nav-link" href="{{ route('user.app') }}">Подать заявку</a>
                    </button>

                    <button type="button" class="nav-buttons__button btn btn-primary">
                        <a class="nav-buttons__link nav-link" href="{{ route('user.app.show') }}">Посмотреть все
                            заявки</a>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-3">
        <div class="card-container">
            @forelse($applications as $application)
            <div class="card-container__item">
                <div class="card h-100">

                    <div class="card__header card-header text-center">
                        <a class="card-header__link" href="{{route('user.app.showApp', $application->id)}}" >{{ __('Заявка на проход посетителей №')}} {{$application->id}}</a>
                    </div>

                    <div class="card__body card-body">
                        <p class="card-body__text">Отправлено: {{$application->created_at}}</p>
                        <p class="card-body__text">Дата: c {{$application->start_date}} по {{$application->end_date}} </p>
                        <p class="card-body__text">Локация: {{$application->object}}</p>
                        <p class="card-body__text">Цель: {{$application->purpose}}</p>
                        <p class="card-body__text">Ответственный: {{$application->responsible_person}}</p>
                        <p class="card-body__text">Количество лиц, указанных в заявке: {{$application->guests_count}}</p>
                        <ul class="card-body__list">
                            @foreach ($application->guests as $guest)
                                <li class="card-body__text">{{ $guest->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @empty
                <div class="empty-state">
                    <p class="empty-state__text text-white text-center">Нет заявок</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection
