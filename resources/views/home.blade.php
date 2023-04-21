@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="ps-4"><h1>Hello {{__($user->name)}}</h1></div>
            </div>

            <form class="mt-5" method="POST" action="{{ route('user.app.create') }}">
                @csrf
                <div class="form-group">
                    <label for="approved_by">Кем одобрена заявка:</label>
                    <input type="text" name="approved_by" id="approved_by" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Начальная дата:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Конечная дата:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="objects">Объекты, на который необходим доступ:</label>
                    <textarea name="objects" id="objects" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="purpose">Цель приглашения:</label>
                    <textarea name="purpose" id="purpose" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="contract_number">Номер договора:</label>
                    <input type="text" name="contract_number" id="contract_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="equipment">Вносимое или выносимое снаряжение:</label>
                    <textarea name="equipment" id="equipment" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="guest_name">ФИО гостя:</label>
                    <input type="text" name="guest_name" id="guest_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Номер телефона ответственного лица:</label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>

        </div>
    </div>
</div>
@endsection
