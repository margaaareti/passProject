@extends('layouts.app')
@section('page.title', 'Подать заявку')

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
                                <option class="form-select__option"
                                        value="Guests"{{$selectedForm === 'Guests' ? 'selected' : ''}}>Приглашение
                                    посетителей
                                </option>
                                <option class="form-select__option" value="Car" selected>Въезд автотранспорта
                                </option> {{$selectedForm === 'Car' ? 'selected' : ''}}
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

                    <button type="button" class="nav-buttons__button btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                        Выбрать тип заявки
                    </button>

                    <button type="button" class="nav-buttons__button btn btn-primary">
                        <a class="nav-buttons__link nav-link" href="{{ route('user.app.show') }}">Посмотреть все
                            заявки</a>
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{--                <div class="card">--}}

    {{--                    <div class="card-header">--}}
    {{--                        {{ __('Dashboard') }}--}}
    {{--                    </div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        @if (session('status'))--}}
    {{--                            <div class="alert alert-success" role="alert">--}}
    {{--                                {{ session('status') }}--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
    {{--                        {{ __('You are logged in!') }}--}}
    {{--                    </div>--}}

    {{--                    <div class="ps-4"><h1>--}}
    {{--                            Hello {{__(sprintf('%s %s %s', $user->last_name, $user->name, $user->patronymic))}}</h1>--}}
    {{--                    </div>--}}

    {{--                </div>--}}


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <x-carCard>

                    <x-card-header>
                        <x-card-title>{{__('Въезд автотранспорта')}}</x-card-title>
                    </x-card-header>

                    <x-card-body>

                        <x-card-form action="{{ route('user.app.create')}}" method="POST">

                            <x-input type="hidden" name="selected_form" value="Car"/>

                            <x-form-item>
                                <x-label required for="department">
                                    {{__('Подразделение:')}} <span class="tooltip-icon"
                                                                   title="Сокращенное название подразделения"><i
                                            class="fa-solid fa-circle-exclamation"></i></span>
                                </x-label>
                                <x-input name="department"
                                         value="{{ old('department', $user->department )}}" required/>
                                @error('department')
                                <x-error></x-error>
                                @enderror
                            </x-form-item>

                            <x-form-item>
                                <x-label required for="signed_by">
                                    {{__('Кем одобрена заявка:')}} <span class="tooltip-icon"
                                                                         title="Руководитель подразделения или лицо его замещающее"><i
                                            class="fa-solid fa-circle-exclamation"></i></span>
                                </x-label>
                                <x-input name="signed_by"
                                         value="{{ old('signed_by','Иванов Иван Иванович' )}}" required/>
                                @error('signed_by')
                                <x-error></x-error>
                                @enderror
                            </x-form-item>


                            <x-form-item>
                                <x-DateInput></x-DateInput>
                            </x-form-item>

                            <x-form-item>
                                <x-TimeInput></x-TimeInput>
                            </x-form-item>

                            <x-form-item>
                                <x-ObjectsInput :objects="$objects"></x-ObjectsInput>
                            </x-form-item>

                            <x-form-item>
                                <x-label required for="purpose">{{__('Цель приглашения:')}}
                                    <span class="tooltip-icon"
                                          title="Кратко, цель приглашения: стажировка, проведение работ, съемки, участие в мероприятии *название мероприятия* и т.д."><i
                                            class="fa-solid fa-circle-exclamation"></i></span>
                                </x-label>

                                <x-textarea name="purpose" id="purpose"
                                            class="form-control @error('purpose') is-invalid @enderror"
                                            required>{{ old('purpose') }}
                                    required>{{ old('purpose') }}
                                </x-textarea>

                                @error('purpose')
                                <x-error></x-error>
                                @enderror
                            </x-form-item>

                            <x-form-item class="form-group">
                                <x-label required for="guests">{{__('Номер автомобиля:')}}
                                    <span class="tooltip-icon" title="Номер автомобиля"><i
                                            class="fa-solid fa-circle-exclamation"></i></span>
                                </x-label>

                                <x-input type="text" name="cars" id="cars"
                                         class="form-control @error('guests') is-invalid @enderror"
                                         required>{{ old('cars') }}
                                </x-input>
                                <div>
                                    @error('cars')
                                    <x-error></x-error>
                                    @enderror
                                </div>
                            </x-form-item>

                            <x-form-item>
                                <x-label
                                    for="equipment">{{__('Ввозимое/вывозимое имущество (если имеется) :')}}</x-label>
                                <x-textarea name="equipment" id="equipment"
                                            class="form-control @error('equipment') is-invalid @enderror "> {{ old('equipment') }}</x-textarea>
                                @error('equipment')
                                <x-error></x-error>
                                @enderror
                            </x-form-item>

                            <div class="responsible_person">
                                <x-label required for="responsible_person">{{__('Ответственный:')}}
                                    <span class="tooltip-icon" title="ФИО ответственного лица от подразделения"><i
                                            class="fa-solid fa-circle-exclamation"></i></span>
                                </x-label>
                                <x-input name="responsible_person"
                                       value="{{ old('responsible_person', sprintf('%s %s %s', $user->last_name, $user->name, $user->patronymic))}}"
                                       id="responsible_person"
                                       class="form-control @error('responsible_person') is-invalid @enderror"
                                />
                                @error('responsible_person')

                                @foreach($errors->get('responsible_person') as $error)
                                    <x-error></x-error>
                                @endforeach

                                @enderror
                            </div>

                            <x-form-item>
                                <x-label required for="phone_number">{{__('Номер телефона ответственного лица:')}}
                                    <span class="tooltip-icon"
                                          title="Номер тел. ответственного лица для оперативной связи"><i
                                            class="fa-solid fa-circle-exclamation"></i></span>
                                </x-label>
                                <x-input name="phone_number" id="phone_number"
                                       value="{{ old('phone_number', $user->phone_number)}}"
                                       class="@error('phone_number') is-invalid @enderror"
                                />

                                @error('phone_number')

                                @foreach($errors->get('phone_number') as $error)
                                    <span class="invalid-feedback" role="alert">
                                        <x-error></x-error>
                                    </span>
                                @endforeach

                                @enderror
                            </x-form-item>

                            <x-form-item>
                                <label for="additional_info">{{__('Дополнительная информация')}}:</label>
                                <textarea type="text" name="additional_info" id="additional_info" rows="4" cols="40"
                                          class="form-control @error('additional_info') is-invalid @enderror">{{old('additional_info')}} </textarea>
                                @error('additional_info')
                                @foreach($errors->get('additional_info') as $error)
                                        <x-error></x-error>
                                @endforeach

                                @enderror
                            </x-form-item>


                            <x-form-item class="mt-3 mb-3">
                                <button type="submit" class="btn">{{__('Отправить')}}</button>
                            </x-form-item>

                            </form>

                        </x-card-form>

                    </x-card-body>

                </x-carCard>

            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="guest_card" class="card silver-gradient-form mt-3 ps-4 pe-4" style="display:none">

                            <x-card-header>
                                <x-card-title>{{__('Проход граждан')}}</x-card-title>
                            </x-card-header>

                            <form id="guest_form" class="mt-3" method="POST" action="{{ route('user.app.create') }}">
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

                                <input type="hidden" name="selected_form" value="Guests">
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


                                <x-form-item>
                                    <x-DateInput></x-DateInput>
                                </x-form-item>

                                <x-form-item>
                                    <x-TimeInput></x-TimeInput>
                                </x-form-item>

                                <x-form-item>
                                    <x-ObjectsInput :objects="$objects"></x-ObjectsInput>
                                </x-form-item>

                                <div class="form-group">
                                    <label for="purpose" class="required">{{__('Цель въезда:')}}
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
                                    <label for="phone_number"
                                           class="required">{{__('Номер телефона ответственного лица:')}}
                                        <span class="tooltip-icon"
                                              title="Номер тел. ответственного лица для оперативной связи"><i
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
        </div>
    </div>

    </div>

@endsection
