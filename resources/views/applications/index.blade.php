@extends('layouts.app')

@section('content')
    <!-- Модальное окно -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Заголовок модального окна</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleSelect" class="form-label">Выберите что-то</label>
                            <select class="form-select" id="exampleSelect">
                                <option value="" disabled selected>Выберите тип заявки</option>
                                <option value="Guests" >Приглашение гостей</option>
                                <option value="Car"  >Въезд автотранспорта</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Основной контент -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="nav-buttons">
                    <button type="button" class="nav-buttons__button btn btn-primary">
                        <a class="nav-buttons__link nav-link" href="{{ route('home') }}">Ссылка на главную</a>
                    </button>

                    <button type="button" class="nav-buttons__button btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Выбрать тип заявки
                    </button>

                    <button type="button" class="nav-buttons__button btn btn-primary">
                        <a class="nav-buttons__link nav-link" href="{{ route('user.app.show') }}">Посмотреть все заявки</a>
                    </button>
                </div>

            </div>
        </div>
    </div>


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

                    <div class="ps-4"><h1>
                            Hello {{__(sprintf('%s %s %s', $user->last_name, $user->name, $user->patronymic))}}</h1>
                    </div>

                </div>


                <div class="card silver-gradient-form mt-4 ps-4 pe-4">

                    <form class="mt-3" id="form1" method="POST" style="display: none" action="{{ route('user.app.create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="department" class="required">
                                {{__('SDFSDFSDF:')}} <span class="tooltip-icon"
                                                           title="Сокращенное название подразделения"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
                            <input name="department" id="department"
                                   class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department', $user->department )}}" required>

                            @error('department')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </form>

                    <form class="mt-3" id="form2" method="POST" action="{{ route('user.app.create') }}"
                          style="display:none">
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
                            <label for="department" class="required">
                                {{__('Подразделение:')}} <span class="tooltip-icon"
                                                               title="Сокращенное название подразделения"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
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
                            <label for="signed_by" class="required">{{__('Кем одобрена заявка:')}}
                                <span class="tooltip-icon" title="Руководитель подразделения или лицо его замещающее"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
                            <input type="text" name="signed_by" value="{{  old('signed_by', 'Иванов Иван Иванович')  }}"
                                   class="form-control @error('signed_by') is-invalid @enderror " id="signed_by"
                                   placeholder="Иванов Иван Иванович" required>
                            @error('signed_by')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="date_range">

                            <div class="form-group start_date">
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

                            <div class="form-group end_date">
                                <label for="end_date" class="required">{{__('Конечная дата:')}}</label>
                                <input type="date" name="end_date"
                                       value="{{ old('end_date') ?? now()->format('Y-m-d') }}"
                                       id="end_date" class="form-control @error('end_date') is-invalid @enderror "
                                       required>
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="time_range">

                            <div class="form-group time_start">
                                <label for="time_start">{{__('Время c :')}}</label>
                                <input type="text" name="time_start" value="{{ old('time_start') }}"
                                       id="time_start" class="form-control @error('time_start') is-invalid @enderror"
                                       autocomplete="off">
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
                            <label for="object" class="required">{{__('Объекты, на который необходим доступ:')}}
                                <span class="tooltip-icon"
                                      title="Указаны объекты, где имеется СКУД. Если нужный объект отсутствует в списке- необходимо подавать заявку на почту"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
                            <select name="object[]" id="object" class="form-control" multiple="multiple"
                                    style="width: 100%"
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
                            <label for="rooms">{{__('Номера помещений:')}}
                                <span class="tooltip-icon"
                                      title="Ввод через пробел. Запятые проставляются автоматически."><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
                            <textarea name="rooms" id="rooms"
                                      class="form-control @error('rooms') is-invalid @enderror ">{{ old('rooms') }}</textarea>
                            @error('rooms')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="purpose" class="required">{{__('Цель приглашения:')}}
                                <span class="tooltip-icon"
                                      title="Кратко, цель приглашения: стажировка, проведение работ, съемки, участие в мероприятии *название мероприятия* и т.д."><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
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
                            <label
                                for="equipment">{{__('Вносимое или выносимое снаряжение/имущество/оборудование:')}}</label>
                            <textarea name="equipment" id="equipment"
                                      class="form-control @error('equipment') is-invalid @enderror "> {{ old('equipment') }}</textarea>
                            @error('equipment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="guests" class="required">{{__('ФИО гостя:')}}
                                <span class="tooltip-icon" title="ФИО каждого гостя с новой строки"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>

                            <textarea type="text" name="guests" id="guests"
                                      placeholder="Иванов Иван Иванович&#10Сергеев Сергей Сергеевич&#10Андреев Андрей Андреевич&#10и т.д."
                                      class="form-control @error('guests') is-invalid @enderror"
                                      required>{{ old('guests') }}</textarea>
                            <div>
                                @error('guests')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="responsible_person">
                            <label for="responsible_person" class="required">{{__('Ответственный:')}}
                                <span class="tooltip-icon" title="ФИО ответственного лица от подразделения"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
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
                            <label for="phone_number" class="required">{{__('Номер телефона ответственного лица:')}}
                                <span class="tooltip-icon" title="Номер тел. ответственного лица для оперативной связи"><i
                                        class="fa-solid fa-circle-exclamation"></i></span>
                            </label>
                            <input type="text" name="phone_number"
                                   value="{{ old('phone_number', $user->phone_number)}}"
                                   id="phone_number"
                                   class="form-control @error('phone_number') is-invalid @enderror">
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
                            <button type="submit" class="btn">{{__('Отправить')}}</button>
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
