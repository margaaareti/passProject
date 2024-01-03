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

                        <x-card-form id="form1" type="cars" data-target="confirmationModal"
                                     action="{{ route('carCreate')}}"
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

                                <x-form-item class="mb-1 mt-1">
                                    <input type="checkbox" name="carEquipment-show" class="equipment-checkbox"
                                           class="equipment-checkbox" {{ old('carEquipment-show') ? 'checked' : '' }}>
                                    <x-label for="equipment">{{__('Ввоз имущества/оборудования')}}:
                                    </x-label>
                                    <x-textarea name="equipment" id="equipment" rows="4"
                                                cols="40"
                                                class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}
                                    </x-textarea>
                                    <x-error name="additional_info"/>
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
                                             action="{{ route('guest.app.create') }}">

                                    <input id='2' type="hidden" name="selected_form" value="Guests"/>

                                    <x-common.common-form-items :user="$user" :objects="$objectsForInvitation">

                                        <x-form-item class="mb-1 mt-1">
                                            <input type="checkbox" name="guestEquipment-show"
                                                   class="equipment-checkbox" {{ old('guestEquipment-show') ? 'checked' : '' }}>
                                            <x-label for="equipment">{{__('Внос имущества/оборудования')}}:
                                            </x-label>
                                            <x-textarea name="equipment" id="equipment" rows="4"
                                                        cols="40"
                                                        class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}
                                            </x-textarea>
                                            <x-error name="guestEquipment-show"/>
                                        </x-form-item>

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


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-typeCard propertyCard>

                    <x-card-header>
                        <x-card-title>{{__('Внос-Вынос имущества')}}</x-card-title>
                    </x-card-header>

                    <x-card-body>

                        <x-card-form id="form3" type="property" method="POST" data-target="confirmationModal"
                                     action="{{ route('guest.app.create') }}">

                            <input id='3' type="hidden" name="selected_form" value="Property"/>

                            <div class="check-box-group">
                                <div class="check-box-group__item">
                                    <input type="checkbox" name="property" value="in"
                                           class="property-checkbox" {{ old('property') === 'in' ? 'checked' : '' }}>
                                    <x-label for="equipment">{{__('Только внос')}}</x-label>
                                </div>
                                <div class="check-box-group__item">
                                    <input type="checkbox" name="property" value="out"
                                           class="property-checkbox" {{ old('property') === 'out' ? 'checked' : '' }}>
                                    <x-label for="equipment">{{__('Только вынос')}}</x-label>
                                </div>
                                <div class="check-box-group__item">
                                    <input type="checkbox" name="property" value="in-and-out" class="property-checkbox"
                                           checked>
                                    <x-label for="equipment">{{__('Внос и вынос')}}</x-label>
                                </div>
                            </div>

                            <x-form-item>
                                <x-label required for="department"> {{__('Подразделение:')}}
                                    <x-icon title="Сокращенное название подразделения">
                                    </x-icon>
                                </x-label>
                                <x-input name="department"
                                         value="{{ $user->department }}" required/>
                                <x-error name="department"/>
                            </x-form-item>

                            <x-form-item>
                                <x-label required for="signed_by">{{__('Кем одобрена заявка:')}}
                                    <x-icon title="Кем одобрена заявка">
                                    </x-icon>
                                </x-label>
                                <x-input name="signed_by" class="@error('signed_by') is-invalid @enderror"
                                         value="{{'Иванов Иван Иванович'}}" required/>
                                <x-error name="signed_by"/>
                            </x-form-item>

                            <x-form-item class="property-data-container">
                                <div class="property-in-group">
                                    <div class="property-in-group-wrap d-flex justify-content-center">

                                        <div class="start_date col-md-5 me-3">
                                            <x-label required for="property-in-date">{{__('Дата вноса:')}}</x-label>
                                            <x-input class="property-in-date" type="date" name="property-in-date" id="end-date"
                                                     value="{{ now()->format('Y-m-d') }}"/>
                                            @error('start_date')
                                            <x-error :message="$message"></x-error>
                                            @enderror
                                        </div>

                                        <x-form-item class="col-md-5">
                                            <x-ObjectsInput
                                                :objects="$objectsForInvitation"></x-ObjectsInput>
                                        </x-form-item>
                                    </div>
                                </div>

                                <div class="property-out-group">
                                    <div class="property-out-group-wrap d-flex justify-content-center">
                                        <div class="end_date col-md-5 me-3">
                                            <x-label required for="property-out-date">{{__('Дата выноса:')}}</x-label>
                                            <x-input  class="property-out-date" type="date" name="property-out-date" id="end_date"
                                                     value="{{ now()->format('Y-m-d') }}" />
                                            @error('end_date')
                                            <x-error :message="$message"></x-error>
                                            @enderror
                                        </div>

                                    <x-form-item class="col-md-5">
                                        <x-ObjectsInput :objects="$objectsForInvitation"></x-ObjectsInput>
                                    </x-form-item>
                                </div>
            </div>

            </x-form-item>


            <x-form-item class="mb-1 mt-1">
                <x-label for="equipment">{{__('Имущество/оборудованиe')}}:
                </x-label>
                <x-textarea name="equipment" id="equipment" rows="4"
                            cols="40"
                            class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}
                </x-textarea>
                <x-error name="guestEquipment-show"/>
            </x-form-item>

            <x-form-item>
                <x-label required for="purpose">{{__('Цель:')}}
                    <x-icon
                        title="Цель приглашения: проведение работ, съемки, переезд и т.д ">
                    </x-icon>
                </x-label>

                <x-textarea name="purpose" id="purpose"
                            class="@error('purpose') is-invalid @enderror"
                            require>{{ old('purpose') }}
                </x-textarea>

                <x-error name="purpose"/>

            </x-form-item>

            <x-common.common-person-info :user="$user">

            </x-common.common-person-info>


            <x-form-item class="mt-3 mb-3">
                <x-button type="submit">
                    {{__('Отправить')}}
                </x-button>
            </x-form-item>

            </x-card-form>

            </x-card-body>

            </x-typeCard>

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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Устанавливаем значения по умолчанию только если old('property') возвращает null
            document.querySelectorAll('.property-checkbox').forEach(function (checkbox) {
                if (checkbox.checked && !checkbox.hasAttribute('checked')) {
                    checkbox.checked = false;
                }

                // Добавляем обработчик события для каждого чекбокса
                checkbox.addEventListener('change', function () {
                    // Снимаем отметку с других чекбоксов только в пределах .property-checkbox
                    document.querySelectorAll('.property-checkbox').forEach(function (otherCheckbox) {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.checked = false;
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Получаем все чекбоксы с классом "property-checkbox"
            var propertyCheckboxes = document.querySelectorAll('.property-checkbox');

            // Получаем блоки
            var propertyInGroup = document.querySelector('.property-in-group');
            var propertyOutGroup = document.querySelector('.property-out-group');

            //Получаем поля с датами
            var propertyInDate = document.querySelector('.property-in-date');
            var propertyOutDate = document.querySelector('.property-out-date');

            // Инициализация состояния чекбоксов при загрузке страницы
            propertyCheckboxes.forEach(function (checkbox) {
                if (checkbox.checked && !checkbox.hasAttribute('checked')) {
                    checkbox.checked = false;
                }
            });

            // Установка значения по умолчанию для "in-and-out" чекбокса
            var propertyInAndOutCheckbox = document.querySelector('input[name="property"][value="in-and-out"]');
            propertyInAndOutCheckbox.checked = true;

            // Добавляем обработчик событий для каждого чекбокса
            propertyCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', togglePropertyGroups);
            });

            // Функция для скрытия/показа блоков в зависимости от состояния чекбоксов
            function togglePropertyGroups() {
                const propertyInCheckbox = document.querySelector('input[name="property"][value="in"]');
                const propertyOutCheckbox = document.querySelector('input[name="property"][value="out"]');
                const propertyInAndOutCheckbox = document.querySelector('input[name="property"][value="in-and-out"]');

                if (!propertyInCheckbox.checked && !propertyOutCheckbox.checked && !propertyInAndOutCheckbox.checked) {
                    // Если ни один чекбокс не отмечен, ставим "in-and-out" в состояние checked
                    propertyInAndOutCheckbox.checked = true;
                }

                var currentDate = new Date();
                var formattedDate = currentDate.toISOString().slice(0, 10);

                if (propertyOutCheckbox.checked) {
                    propertyOutGroup.style.display = 'block';
                    propertyInGroup.style.display = 'none';
                    propertyOutDate.value = formattedDate;
                    propertyInDate.removeAttribute('required');
                    propertyOutDate.setAttribute('required','true')
                    propertyInDate.value = '';
                } else if (propertyInCheckbox.checked) {
                    propertyInGroup.style.display = 'block';
                    propertyOutGroup.style.display = 'none';
                    propertyInDate.value = formattedDate;
                    propertyInDate.setAttribute('required','true')
                    propertyOutDate.removeAttribute('required');
                    propertyOutDate.value = '';
                } else if (propertyInAndOutCheckbox.checked) {
                    propertyInGroup.style.display = 'block';
                    propertyOutGroup.style.display = 'block';
                    propertyInDate.value = formattedDate;
                    propertyOutDate.value = formattedDate;
                    propertyInDate.setAttribute('required','true')
                    propertyOutDate.setAttribute('required','true')
                } else {
                    // Если ни один чекбокс не отмечен, скрываем оба блока
                    propertyInGroup.style.display = 'none';
                    propertyOutGroup.style.display = 'none';
                }
            }

            // Предотвращаем снятие чекбокса
            propertyCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('click', function (event) {
                    if (!event.target.checked) {
                        event.preventDefault();
                    }
                });
            });

            // Инициализация состояния чекбоксов при загрузке страницы
            togglePropertyGroups();
        });
    </script>

@endsection
