@extends('layouts.app')

@section('content')

    <div class="container py-3">
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

                    <div class="ps-4"><h1>Hello {{__(sprintf('%s %s %s', $user->last_name, $user->name, $user->patronymic))}}</h1></div>

                </div>


                <div class="card mt-4 ps-4 pe-4 silver-gradient-form">

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
                            <label for="department" class="required">{{__('Подразделение')}}:</label>
                            <input name="department" id="department"
                                   class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department', $user->department )}}" required>

                            @error('department')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="signed_by" class="required">{{__('Кем одобрена заявка')}}:</label>
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
                            <label for="start_date" class="required">{{__('Начальная дата:')}}</label>
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
                            <label for="end_date" class="required">{{__('Конечная дата:')}}</label>
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
                                <label for="time_start">{{__('Время c :')}}</label>
                                <input type="text" name="time_start" value="{{ old('time_start') }}"
                                       id="time_start" class="form-control @error('time_start') is-invalid @enderror" autocomplete="off">
                                @error('time_start')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group time_end">
                                <label for="time_end"> {{__('До :')}}</label>
                                <input type="text" name="time_end" value="{{ old('time_end') }} "
                                       id="time_end" class="form-control @error('time_end') is-invalid @enderror ">
                                @error('time_end')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="object" class="required">{{__('Объекты, на который необходим доступ:')}}</label>
                            <select name="object[]" id="object" class="form-control" multiple="multiple"
                                    required>

                                @foreach($objects as $value => $text)
                                    <option class="select-option" value="{{$value}}">{{$text}}</option>
                                @endforeach

                            </select>

                            @error('object')

                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>

                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rooms">{{__('Номера помещений:')}}</label>
                            <textarea name="rooms" id="rooms"
                                      class="form-control @error('rooms') is-invalid @enderror ">{{ old('rooms') }}</textarea>
                            @error('rooms')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="purpose" class="required">{{__('Цель приглашения:')}}</label>
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
                            <label for="contract_number">{{__('Номер договора:')}}</label>
                            <input type="text" name="contract_number" value="{{ old('contract_number') }}"
                                   id="contract_number" class="form-control @error('start_date') is-invalid @enderror ">
                            @error('contract_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="equipment">{{__('Вносимое или выносимое снаряжение:')}}</label>
                            <textarea name="equipment" id="equipment"
                                      class="form-control @error('equipment') is-invalid @enderror "> {{ old('equipment') }}</textarea>
                            @error('equipment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <label for="guests" class="required">{{__('ФИО гостя:')}}</label>

                            <textarea type="text" name="guests" id="guests"
                                      class="form-control @error('guests') is-invalid @enderror"
                                      required>{{ old('guests') }}</textarea>

                            @error('guests')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="responsible_person">
                            <label for="responsible_person" class="required">{{__('Ответственный:')}}</label>
                            <input type="text" name="responsible_person"
                                   value="{{ old('responsible_person', sprintf('%s %s %s', $user->last_name, $user->name, $user->patronymic))}}"
                                   id="responsible_person"
                                   class="form-control @error('responsible_person') is-invalid @enderror">
                            @error('responsible_person')

                            @foreach($errors->get('responsible_person') as $error)
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                            @endforeach

                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="required">{{__('Номер телефона ответственного лица:')}}</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number)}}"
                                   id="phone_number" class="form-control @error('phone_number') is-invalid @enderror">
                            @error('phone_number')

                            @foreach($errors->get('phone_number') as $error)
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                            @endforeach

                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="additional_info">{{__('Дополнительная информация')}}:</label>
                            <textarea type="text" name="additional_info" id="additional_info" rows="4" cols="40"
                                      class="form-control @error('additional_info') is-invalid @enderror">{{old('additional_info')}} </textarea>
                            @error('additional_info')


                            @enderror
                        </div>


                        <div class="mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">{{__('Отправить')}}</button>
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

@endsection
