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
                        @if ($errors->any())
                            <div class="alert alert-danger pb-0">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            @if (session()->has('success'))
                                <div id="success-message" class="alert alert-success" style="display:none">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        @endif

                        <div class="form-group">
                            <label for="department">Подразделение:</label>
                            <input name="department" id="department"
                                   class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department') }}" required>

                            @error('department')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="signed_by">Кем одобрена заявка:</label>
                            <input type="text" name="signed_by" value="{{  old('signed_by', 'Иванов Иван Иванович')  }}"
                                   class="form-control @error('signed_by') is-invalid @enderror " id="signed_by"
                                   placeholder="Иванов Иван Иванович" required>
                            @error('signed_by')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="start_date">Начальная дата:</label>
                            <input type="date" name="start_date"
                                   value="{{ old('start_date') ?? now()->format('Y-m-d') }}" id="start_date"
                                   class="form-control @error('start_date') is-invalid @enderror" required>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date">Конечная дата:</label>
                            <input type="date" name="end_date" value="{{ old('end_date') ?? now()->format('Y-m-d') }}"
                                   id="end_date" class="form-control @error('end_date') is-invalid @enderror " required>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="time_range">

                            <div class="form-group time_start">
                                <label for="time_start">Время c:</label>
                                <input type="text" name="time_start" value="{{ old('time_range') }}"
                                       id="time_start" class="form-control @error('time_range') is-invalid @enderror ">
                                @error('time_range')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group time_end">
                                <label for="time_end">До:</label>
                                <input type="text" name="time_end" value="{{ old('time_end') }}"
                                       id="time_end" class="form-control @error('time_end') is-invalid @enderror ">
                                @error('time_start')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="object">Объекты, на который необходим доступ:</label>
                                <select name="object[]" id="object" class="form-control" multiple="multiple"
                                        required>
                                    <option value="К49">Кронверский,49</option>
                                    <option value="Л9">Ломоносова,9</option>
                                    <option value="Л9 лит.М">Ломоносова,9 (здание бывш. церкви)</option>
                                    <option value="Гр14">Гривцова,14</option>
                                    <option value="Б4">Биржевая,4</option>
                                    <option value="Б14">Биржевая,14</option>
                                    <option value="Б16">Биржевая,16</option>
                                    <option value="Ч14">Чайковского,11</option>
                                    <option value="Хрустальная">Хрустальная</option>
                                    <option value="Вяземский">Вяземский</option>
                                    <option value="Ленсовета">Ленсовета</option>
                                    <option value="Серебристый">Серебристый</option>
                                </select>

                                @error('object')

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>

                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="purpose">Цель приглашения:</label>
                            <textarea name="purpose" id="purpose"
                                      class="form-control @error('start_date') is-invalid @enderror "
                                      required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="contract_number">Номер договора:</label>
                            <input type="text" name="contract_number" value="{{ old('contract_number') }}"
                                   id="contract_number" class="form-control @error('start_date') is-invalid @enderror ">
                            @error('contract_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="equipment">Вносимое или выносимое снаряжение:</label>
                            <textarea name="equipment" id="equipment"
                                      class="form-control @error('equipment') is-invalid @enderror "
                                      required> {{ old('equipment') }}</textarea>
                            @error('equipment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="guest">ФИО гостя:</label>
                            <input type="text" name="guests" value="{{ old('guests') }}" id="guest"
                                   class="form-control @error('guests') is-invalid @enderror" required>
                            @error('guests')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Номер телефона ответственного лица:</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number','89384528803')}}"
                                   id="phone_number" class="form-control @error('phone_number') is-invalid @enderror">
                            @error('phone_number')

                            @foreach($errors->get('phone_number') as $error)
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                            @endforeach

                            @enderror
                        </div>

                        <div class="mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>

                    </form>



                    <script>
                        const successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'block';
                            setTimeout(function () {
                                successMessage.style.display = 'none';
                            }, 5000);
                        }
                    </script>

                </div>
            </div>
        </div>


    </div>
    </div>
@endsection
