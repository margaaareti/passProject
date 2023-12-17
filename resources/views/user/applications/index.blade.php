@extends('layouts.app')
@section('page.title', 'Подать заявку')

@section('content')
    <!-- Модальное окно -->
    <x-common.modal-window>

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

                        <x-card-form id="form1" type="cars" data-target="confirmationModal" action="{{ route('carCreate')}}"
                                     method="POST">

                            <input id="1" type="hidden" name="selected_form" value="Car"/>

                            <x-common.common-form-items :user="$user" :objects="$objectsForParking">

                                <x-form-item class="form-group">
                                    <x-label required for="cars">{{__('Номер автомобиля:')}}
                                        <x-icon title="Например: А 123 БВ 178">
                                        </x-icon>
                                    </x-label>

                                    <x-input name="cars" id="cars"
                                             class="@error('cars') is-invalid @enderror"
                                             required>{{ old('cars') }}
                                    </x-input>
                                    <div>
                                        @error('cars')
                                        <x-error :message="$message"></x-error>
                                        @enderror
                                    </div>
                                </x-form-item>

{{--                                <x-form-item class="mb-1 mt-1">--}}
{{--                                    <input type="checkbox" name="carEquipment-show" class="equipment-checkbox" class="equipment-checkbox" {{ old('carEquipment-show') ? 'checked' : '' }}>--}}
{{--                                    <x-label for="equipment">{{__('Ввоз имущества/оборудования')}}:--}}
{{--                                    </x-label>--}}
{{--                                    <x-textarea name="equipment" id="equipment" rows="4"--}}
{{--                                                cols="40"--}}
{{--                                                class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}--}}
{{--                                    </x-textarea>--}}
{{--                                    <x-error name="additional_info"/>--}}
{{--                                </x-form-item>--}}

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
                                <h4 class="modal-title" id="exampleModalLabel">Проверьте правильность введенных
                                    данных</h4>
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

                                <x-card-form id="form2" type="guests" method="POST" data-target="confirmationModal"
                                             action="{{ route('user.app.create') }}">

                                    <input id='2' type="hidden" name="selected_form" value="Guests"/>

                                    <x-common.common-form-items :user="$user" :objects="$objectsForInvitation">

{{--                                        <x-form-item class="mb-1 mt-1">--}}
{{--                                            <input type="checkbox" name="guestEquipment-show" class="equipment-checkbox" {{ old('guestEquipment-show') ? 'checked' : '' }}>--}}
{{--                                            <x-label for="equipment">{{__('Внос имущества/оборудования')}}:--}}
{{--                                            </x-label>--}}
{{--                                            <x-textarea name="equipment" id="equipment" rows="4"--}}
{{--                                                        cols="40"--}}
{{--                                                        class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}--}}
{{--                                            </x-textarea>--}}
{{--                                            <x-error name="additional_info"/>--}}
{{--                                        </x-form-item>--}}

                                        <x-form-item>
                                            <x-label required for="guests">{{__('ФИО гостей:')}}
                                                <x-icon title="ФИО каждого гостя с новой строки">
                                                </x-icon>
                                            </x-label>

                                            <x-textarea name="guests" id="guests"
                                                        placeholder="Иванов Иван Иванович&#10Сергеев Сергей Сергеевич&#10Андреев Андрей Андреевич&#10и т.д."
                                                        class="@error('guests') is-invalid @enderror"
                                                        required>{{ old('guests') }}
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

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'block';
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 10000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Получаем ссылки на чекбоксы и поля ввода
            var checkboxes = document.querySelectorAll('.equipment-checkbox');
            var equipmentFields = document.querySelectorAll('.equipment-field');

            // Скрыть или показать поля при загрузке страницы
            // Скрыть или показать поля при загрузке страницы
            toggleEquipmentsFields();

            // Добавляем обработчик изменения состояния каждого чекбокса
            checkboxes.forEach(function (checkbox, index) {
                checkbox.addEventListener('change', function () {
                    toggleEquipmentsField(index);
                });
            });

            // Функция для скрытия или показа полей в зависимости от состояния чекбоксов
            function toggleEquipmentsFields() {
                checkboxes.forEach(function (checkbox, index) {
                    toggleEquipmentsField(index);
                });
            }

            // Функция для скрытия или показа поля в зависимости от состояния чекбокса
            function toggleEquipmentsField(index) {
                if (checkboxes[index].checked) {
                    equipmentFields[index].style.display = '';
                } else {
                    equipmentFields[index].style.display = 'none';
                }
            }
        });
    </script>



@endsection
