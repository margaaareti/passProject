@extends('layouts.app')
@section('page.title', 'Подать заявку')

@section('content')
    <!-- Модальное окно -->
    <x-common.modal-window :selectedForm="$selectedForm">

    </x-common.modal-window>

    <!-- Основной контент -->
    <x-common.nav-buttons size="8">

    </x-common.nav-buttons>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <x-typeCard carCard>

                    <x-card-header>
                        <x-card-title>{{__('Въезд автотранспорта')}}</x-card-title>
                    </x-card-header>

                    <x-card-body>

                        <x-card-form id="form1" data-target="confirmationModal" action="{{ route('user.app.create')}}"
                                     method="POST">

                            <x-input type="hidden" name="selected_form" value="Car"/>

                            <x-common.common-form-items :user="$user" :objects="$objects">

                                <x-form-item class="form-group">
                                    <x-label required for="cars">{{__('Номер автомобиля:')}}
                                        <x-icon title="Например: А 123 БВ 178">
                                        </x-icon>
                                    </x-label>

                                    <x-input name="cars" id="cars"
                                             class="@error('guests') is-invalid @enderror"
                                             required>{{ old('cars') }}
                                    </x-input>
                                    <div>
                                        @error('cars')
                                        <x-error :message="$message"></x-error>
                                        @enderror
                                    </div>
                                </x-form-item>

                                <x-form-item>
                                    <x-label
                                        for="equipment">{{__('Ввозимое/вывозимое имущество (если имеется) :')}}
                                    </x-label>
                                    <x-textarea name="equipment" id="equipment"
                                                class="@error('equipment') is-invalid @enderror ">
                                        {{ old('equipment') }}
                                    </x-textarea>
                                    @error('equipment')
                                    <x-error :message="$message"></x-error>
                                    @enderror
                                </x-form-item>

                                <x-common.common-person-info :user="$user">

                                </x-common.common-person-info>

                                <x-form-item class="mt-3 mb-3">
                                    <button type="submit" class="btn">{{__('Отправить')}}</button>
                                </x-form-item>

                            </x-common.common-form-items>

                        </x-card-form>

                    </x-card-body>

                </x-typeCard>

            </div>


            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="d-flex flex-column">
                            <div class="modal-header mb-1">
                                <h4 class="modal-title" id="exampleModalLabel">Проверьте правильность введенных данных</h4>
                            </div>
                            <div>
                                <h5 class="modal-title" id="applicationType"></h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div id="modalData"></div>
                        </div>
                        <div class="modal-footer">
                            <x-button data-bs-dismiss="modal">Закрыть</x-button>
                            <x-button id="confirmButton">Подтвердить</x-button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <x-typeCard guestCard>

                            <x-card-header>
                                <x-card-title>{{__('Проход граждан')}}</x-card-title>
                            </x-card-header>

                            <x-card-body>

                                <x-card-form id="form2" method="POST" data-target="confirmationModal"
                                             action="{{ route('user.app.create') }}">

                                    <input type="hidden" name="selected_form" value="Guests">

                                    <x-common.common-form-items :user="$user" :objects="$objects">

                                        {{--                                        <x-form-item>--}}
                                        {{--                                            <label for="rooms">{{__('Номера помещений:')}}--}}
                                        {{--                                                <x-icon>--}}
                                        {{--                                                    Ввод через пробел. Запятые проставляются автоматически--}}
                                        {{--                                                </x-icon>--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <x-textarea name="rooms" id="rooms"--}}
                                        {{--                                                        class="@error('rooms') is-invalid @enderror">{{ old('rooms') }}--}}
                                        {{--                                            </x-textarea>--}}
                                        {{--                                            @error('rooms')--}}
                                        {{--                                            <x-error></x-error>--}}
                                        {{--                                            @enderror--}}
                                        {{--                                        </x-form-item>--}}

                                        {{--                                        <x-form-item>--}}
                                        {{--                                            <x-label--}}
                                        {{--                                                for="equipment">{{__('Вносимое или выносимое снаряжение/имущество/оборудование:')}}--}}
                                        {{--                                            </x-label>--}}
                                        {{--                                            <x-textarea name="equipment" id="equipment"--}}
                                        {{--                                                        class="@error('equipment') is-invalid @enderror"> {{ old('equipment') }}--}}
                                        {{--                                            </x-textarea>--}}
                                        {{--                                            @error('equipment')--}}
                                        {{--                                            <x-error></x-error>--}}
                                        {{--                                            @enderror--}}
                                        {{--                                        </x-form-item>--}}

                                        <x-form-item>
                                            <x-label required for="guests">{{__('ФИО гостей:')}}
                                                <x-icon title="ФИО каждого гостя с новой строки">
                                                </x-icon>
                                            </x-label>

                                            <x-textarea name="guests" id="guests"
                                                        placeholder="Иванов Иван Иванович&#10Сергеев Сергей Сергеевич&#10Андреев Андрей Андреевич&#10и т.д."
                                                        class="@error('guests') is-invalid @enderror"
                                                        required>{!! old('guests') !!}
                                            </x-textarea>
                                            @error('guests')
                                            <x-error :message="$message"></x-error>
                                            @enderror
                                        </x-form-item>

                                        <x-common.common-person-info :user="$user">

                                        </x-common.common-person-info>


                                        <x-form-item class="mt-3 mb-3">
                                            <x-button type="submit">
                                                {{__('Отправить')}}
                                            </x-button>
                                        </x-form-item>

                                    </x-common.common-form-items>

                                </x-card-form>

                            </x-card-body>

                        </x-typeCard>


{{--                        <script>--}}
{{--                            const successMessage = document.getElementById('success-message');--}}
{{--                            if (successMessage) {--}}
{{--                                successMessage.style.display = 'block';--}}
{{--                                setTimeout(function () {--}}
{{--                                    successMessage.style.display = 'none';--}}
{{--                                }, 10000);--}}
{{--                            }--}}
{{--                        </script>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

@endsection
