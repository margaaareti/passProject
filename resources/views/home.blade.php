@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        {{ __('Dashboard') }}
                    </div>

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


                <div class="card mt-4 ps-4 pe-4">

                    <form class="mt-3" method="POST" action="{{ route('user.app.create') }}">
                        @csrf

                        <div class="form-group">
                            <label for="approved_by">Кем одобрена заявка:</label>
                            <input type="text" name="signed_by" value="{{ old('signed_by') }}"  id="approved_by" class="form-control @error('signed_by') is-invalid @enderror " required>
                            @error('signed_by')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="start_date">Начальная дата:</label>
                            <input type="date" name="start_date" value="{{ old('start_date') ?? now()->format('Y-m-d') }}" id="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date">Конечная дата:</label>
                            <input type="date" name="end_date" value="{{ old('end_date') ?? now()->format('Y-m-d') }}" id="end_date" class="form-control @error('end_date') is-invalid @enderror " required>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="object">Объекты, на который необходим доступ:</label>
                            <textarea name="object" id="object" class="form-control" required> {{ old('object') }} </textarea>
                            @error('object')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="purpose">Цель приглашения:</label>
                            <textarea name="purpose" id="purpose" class="form-control @error('start_date') is-invalid @enderror " required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="department">Подразделение:</label>
                            <textarea name="department" id="department" class="form-control @error('department') is-invalid @enderror " required>{{ old('department') }}</textarea>
                            @error('department')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contract_number">Номер договора:</label>
                            <input type="text" name="contract_number" value="{{ old('contract_number') }}" id="contract_number" class="form-control @error('start_date') is-invalid @enderror " >
                            @error('contract_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="equipment">Вносимое или выносимое снаряжение:</label>
                            <textarea name="equipment" id="equipment" class="form-control @error('equipment') is-invalid @enderror " required> {{ old('equipment') }}</textarea>
                            @error('equipment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="guest">ФИО гостя:</label>
                            <input type="text" name="guests" value="{{ old('guests') }}" id="guest" class="form-control @error('guests') is-invalid @enderror" required>
                            @error('guests')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Номер телефона ответственного лица:</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" >
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
