@extends('layouts.app')
@section('page.title', 'Подать заявку')

@section('content')
    <!-- Модальное окно c выбором типа формы-->
    <x-modals.form-select-modal/>
    <!-- Модальное окно c подтверждением отправляемых данных-->
    <x-modals.confirmation-modal/>

    <!-- Основной контент -->
    <x-common.nav-buttons size="8">

    </x-common.nav-buttons>

    <!-- Модальное окно с полями добавления имущества в заявке на внос/вынос -->
    <div id="equipmentModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить Имущество/оборудование</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="equipmentForm">
                        <div class="form-group">
                            <label for="equipmentName">Название:</label>
                            <input type="text" class="form-control" id="equipmentName">
                        </div>
                        <div class="form-group">
                            <label for="equipmentQuantity">Количество:</label>
                            <input type="number" class="form-control" id="equipmentQuantity">
                        </div>
                        <div id="modalWarning" class="alert alert-danger mt-2"
                             style="display: none;">
                            Пожалуйста, заполните все поля.
                        </div>
                        <button type="button" class="btn btn-success"
                                id="addEquipmentModalBtn">
                            Добавить
                        </button>
                        <button type="button" class="btn btn-danger btn-secondary" data-bs-dismiss="modal">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <x-typeCard carCard>

                    <x-card-header>
                        <x-card-title>{{__('Въезд автотранспорта')}}</x-card-title>
                    </x-card-header>

                    <x-card-body>

                        <label for="test-input">Test</label>

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
                                           class="carEquipment-checkbox" {{ old('carEquipment-show') ? 'checked' : '' }}>
                                    <x-label for="equipment">{{__('Имущество/оборудованиe')}}:
                                    </x-label>
                                    <x-textarea name="equipment" id="CarEquipment" rows="4"
                                                cols="40"
                                                class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}
                                    </x-textarea>
                                    <x-error name="additional_info"/>
                                </x-form-item>

                                <x-common.common-person-info :user="$user">

                                </x-common.common-person-info>

                                <x-form-item class="mt-3 mb-3">
                                    <x-button class="btn-submit" type="submit">
                                        {{__('Отправить')}}
                                    </x-button>
                                </x-form-item>

                            </x-common.common-form-items>

                        </x-card-form>

                    </x-card-body>

                </x-typeCard>

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

                                        <x-form-item class="mb-1 mt-1">
                                            <input type="checkbox" name="guestEquipment-show"
                                                   class="questEquipment-checkbox" {{ old('guestEquipment-show') ? 'checked' : '' }}>
                                            <x-label for="equipment">{{__('Имущество/оборудование')}}:
                                            </x-label>
                                            <x-textarea name="equipment" id="guestEquipment" rows="4"
                                                        cols="40"
                                                        class="equipment-field @error('equipment') is-invalid @enderror">{{old('equipment')}}
                                            </x-textarea>
                                            <x-error name="guestEquipment-show"/>
                                        </x-form-item>

                                        <x-common.common-person-info :user="$user">

                                        </x-common.common-person-info>


                                        <x-form-item class="mt-3 mb-3">
                                            <x-button class="btn-submit" type="submit">
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
                        <x-card-title>{{__('Внос-Вынос имущества/оборудования')}}</x-card-title>
                    </x-card-header>

                    <x-card-body>

                        <x-card-form id="form3" type="property" method="POST" data-target="confirmationModal"
                                     action="{{ route('property.app.create') }}">

                            <input id='3' type="hidden" name="selected_form" value="Property"/>

                            <div class="check-box-group">
                                <div class="check-box-group__item">
                                    <input type="radio" name="type" value="Внос"
                                           class="property-radio" {{ old('action-type') === 'in' ? 'checked' : '' }}>
                                    <x-label for="equipment">{{__('Только внос')}}</x-label>
                                </div>
                                <div class="check-box-group__item">
                                    <input type="radio" name="type" value="Вынос"
                                           class="property-radio" {{ old('action-type') === 'out' ? 'checked' : '' }}>
                                    <x-label for="equipment">{{__('Только вынос')}}</x-label>
                                </div>
                                <div class="check-box-group__item">
                                    <input type="radio" name="type" value="Внос-Вынос" class="property-radio"
                                           {{ old('action-type') === 'in-and-out' ? 'checked' : '' }} checked>
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
                                            <x-input class="property-in-date" type="date" name="property-in-date"
                                                     id="end-date"
                                                     value="{{now()->format('Y-m-d') }}"/>
                                            @error('start_date')
                                            <x-error :message="$message"></x-error>
                                            @enderror
                                        </div>

                                        <x-form-item class="col-md-5 object-in">
                                            <x-ObjectsInput
                                                :objects="$objectsForInvitation"
                                                inputName="object_in"
                                                selectClass="object-in"
                                            >
                                            </x-ObjectsInput>
                                        </x-form-item>
                                    </div>
                                </div>

                                <div class="property-out-group">
                                    <div class="property-out-group-wrap d-flex justify-content-center">
                                        <div class="end_date col-md-5 me-3">
                                            <x-label required for="property-out-date">{{__('Дата выноса:')}}</x-label>
                                            <x-input class="property-out-date" type="date" name="property-out-date"
                                                     id="end_date"
                                                     value="{{ now()->format('Y-m-d') }}"/>
                                            @error('end_date')
                                            <x-error :message="$message"></x-error>
                                            @enderror
                                        </div>

                                        <x-form-item class="col-md-5 object-out">
                                            <x-ObjectsInput :objects="$objectsForInvitation"
                                                            inputName="object_out"
                                                            selectClass="object-out"
                                            >
                                            </x-ObjectsInput>
                                        </x-form-item>
                                        @if($errors->has('object_out'))
                                            <span class="is-invalid">Упс, ошибка</span>
                                        @endif
                                    </div>
                                </div>

                            </x-form-item>


                            <x-form-item class="mb-1 mt-1">
                                <x-label for="equipment">{{__('Имущество/оборудованиe')}}:
                                </x-label>
                            </x-form-item>

                            <button type="button" id="addEquipmentBtn" class="btn btn-primary mb-2">Добавить +</button>

                            <input type="hidden" id="equipmentCounter" name="equipmentCounter"
                                   value="{{ old('equipmentCounter') ?? 1 }}">

                            <div id="equipmentList">
                                @if(old('equipment_name_1'))
                                    @for($i = 1; old('equipment_name_' . $i) !== null; $i++)
                                        <div class="equipment-block row">
                                            <div class="col-md-9">
                                                <label for="equipment_name_{{ $i }}">Имущество/оборудование:</label>
                                                <input type="text" class="form-control" name="equipment_name_{{$i}}"
                                                       value="{{ old('equipment_name_' . $i) }}" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="equipment_quantity_{{ $i }}">Количество(шт.):</label>
                                                <input type="number" class="form-control"
                                                       name="equipment_quantity_{{$i}}"
                                                       value="{{ old('equipment_quantity_' . $i) }}" readonly>
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <button type="button"
                                                        class="btn btn-danger delete-btn delete-equipment-button"
                                                        data-block-id="${equipmentCounter}">&times;
                                                </button>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>

                            <input type="hidden" id="hiddenEquipmentData" name="hiddenEquipmentData"
                                   value="{{old('hiddenEquipmentData')}}">


                            <x-form-item>
                                <x-label required for="purpose">{{__('Цель:')}}
                                    <x-icon
                                        title="Цель: проведение работ, съемки, переезд и т.д ">
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
                                <x-button class="btn-submit" type="submit">
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
            // Скрипт для отображения полей для вноса имущества и оборудования
            const guestEquipmentCheckbox = document.querySelector('input[name="guestEquipment-show"]');
            const guestEquipmentTextarea = document.querySelector('textarea#guestEquipment');
            const carEquipmentCheckbox = document.querySelector('input[name="carEquipment-show"]');
            const carEquipmentTextarea = document.querySelector('textarea#CarEquipment');

            guestEquipmentCheckbox.addEventListener('change', toggleEquipmentTextarea);
            carEquipmentCheckbox.addEventListener('change', toggleEquipmentTextarea);

            function toggleEquipmentTextarea() {
                guestEquipmentTextarea.style.display = guestEquipmentCheckbox.checked ? 'block' : 'none';
                carEquipmentTextarea.style.display = carEquipmentCheckbox.checked ? 'block' : 'none';
            }

            toggleEquipmentTextarea();

            // Скрипт для отображения полей в зависимости от выбора радиокнопки
            const propertyRadios = document.querySelectorAll('.property-radio');
            const propertyInGroup = document.querySelector('.property-in-group');
            const propertyOutGroup = document.querySelector('.property-out-group');
            const propertyInDate = document.querySelector('.property-in-date');
            const propertyOutDate = document.querySelector('.property-out-date');
            const selectObjectIn = document.querySelector('.object-in');
            const selectObjectOut = document.querySelector('.object-out');
            console.log(selectObjectOut, selectObjectIn)
            console.log('ffff')

            function togglePropertyGroups() {
                const inRadio = document.querySelector('input[name="type"][value="Внос"]');
                const outRadio = document.querySelector('input[name="type"][value="Вынос"]');
                const inAndOutRadio = document.querySelector('input[name="type"][value="Внос-Вынос"]');
                const currentDate = new Date();
                const formattedDate = currentDate.toISOString().slice(0, 10);

                propertyInGroup.style.display = inRadio.checked || inAndOutRadio.checked ? 'block' : 'none';
                propertyOutGroup.style.display = outRadio.checked || inAndOutRadio.checked ? 'block' : 'none';

                if (outRadio.checked) {
                    propertyOutDate.value = formattedDate;
                    propertyInDate.value = '';
                    selectObjectIn.value = '';
                    selectObjectIn.removeAttribute('required');
                    selectObjectOut.setAttribute('required', 'true');
                    propertyInDate.removeAttribute('required');
                    propertyOutDate.setAttribute('required', 'true');
                } else if (inRadio.checked) {
                    propertyInDate.value = formattedDate;
                    propertyOutDate.value = '';
                    selectObjectOut.value = '';
                    selectObjectOut.removeAttribute('required');
                    selectObjectIn.setAttribute('required', 'true');
                    propertyInDate.setAttribute('required', 'true');
                    propertyOutDate.removeAttribute('required');
                } else if (inAndOutRadio.checked) {
                    propertyInDate.value = formattedDate;
                    propertyOutDate.value = formattedDate;
                    propertyInDate.setAttribute('required', 'true');
                    propertyOutDate.setAttribute('required', 'true');
                    selectObjectOut.setAttribute('required', 'true');
                    selectObjectIn.setAttribute('required', 'true');
                }
            }

            propertyRadios.forEach(function (radio) {
                radio.addEventListener('change', togglePropertyGroups);
            });

            // Устанавливаем значения при загрузке страницы
            const oldProperty = "{{ old('type') }}";
            const selectedRadio = document.querySelector(`input[name="type"][value="${oldProperty}"]`);
            if (selectedRadio) {
                selectedRadio.checked = true;
                togglePropertyGroups(); // Вызываем функцию для обработки изменений
            } else {
                // Если нет выбранного радио, скрываем оба блока
                propertyInGroup.style.display = 'none';
                propertyOutGroup.style.display = 'none';
            }
        });

        // Устанавливаем значения при загрузке страницы
        document.addEventListener('DOMContentLoaded', function () {
            const selectedType = "{{ old('type', 'Внос') }}";
            const selectedRadio = document.querySelector(`input[name="type"][value="${selectedType}"]`);
            if (selectedRadio) {
                selectedRadio.checked = true;
                selectedRadio.dispatchEvent(new Event('change'));
            }
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const equipmentModal = new bootstrap.Modal(document.getElementById('equipmentModal'));
            const addEquipmentBtn = document.getElementById('addEquipmentBtn');
            const addEquipmentModalBtn = document.getElementById('addEquipmentModalBtn');
            const equipmentNameInput = document.getElementById('equipmentName');
            const equipmentQuantityInput = document.getElementById('equipmentQuantity');
            const modalWarning = document.getElementById('modalWarning');
            const equipmentListContainer = document.getElementById('equipmentList');
            const form = document.getElementById('form3');

            // Получаем текущее значение equipmentCounter из old данных
            let equipmentCounter = parseInt("{{ old('equipmentCounter') ?? 1 }}");

            addEquipmentBtn.addEventListener('click', function () {
                hideWarning();
                equipmentModal.show();
            });

            addEquipmentModalBtn.addEventListener('click', function () {
                const name = equipmentNameInput.value;
                const quantity = equipmentQuantityInput.value;

                if (name && quantity) {
                    // Создаем новый блок с информацией об оборудовании
                    const equipmentBlock = document.createElement('div');
                    equipmentBlock.classList.add('equipment-block', 'row', 'mb-2'); // Добавлены классы Bootstrap
                    equipmentBlock.innerHTML = `
                    <div class="col-md-9">
                        <label for="equipment_name_${equipmentCounter}">Имущество/оборудование:</label>
                        <input type="text" class="form-control" name="equipment_name_${equipmentCounter}" value="${name}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="equipment_quantity_${equipmentCounter}">Количество(шт.):</label>
                        <input type="number" class="form-control" name="equipment_quantity_${equipmentCounter}" value="${quantity}" readonly>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button type="button" class="btn btn-danger delete-btn delete-equipment-button" data-block-id="${equipmentCounter}">&times;</button>
                    </div>
                `;


                    // Добавляем обработчик события для кнопки удаления
                    const deleteBtn = equipmentBlock.querySelector('.delete-btn');
                    deleteBtn.addEventListener('click', function () {
                        equipmentBlock.remove();
                    });

                    // Добавляем блок в контейнер
                    equipmentListContainer.appendChild(equipmentBlock);

                    // Очищаем поля в модальном окне
                    equipmentNameInput.value = '';
                    equipmentQuantityInput.value = '';

                    // // Закрываем модальное окно
                    // equipmentModal.hide();

                    // Увеличиваем счетчик
                    equipmentCounter++;

                    // Обновляем значение equipmentCounter в скрытом поле
                    document.getElementById('equipmentCounter').value = equipmentCounter;
                } else {
                    showWarning();
                }
            });

            // Событие закрытия модального окна
            equipmentModal._element.addEventListener('hidden.bs.modal', function () {
                // Очищаем поля в модальном окне при его закрытии
                equipmentNameInput.value = '';
                equipmentQuantityInput.value = '';
            });


            function showWarning() {
                modalWarning.style.display = 'block';
            }

            function hideWarning() {
                modalWarning.style.display = 'none';
            }

            equipmentNameInput.addEventListener('input', function () {
                hideWarning();
            });

            equipmentQuantityInput.addEventListener('input', function () {
                hideWarning();
            });


            // Добавьте следующий код, чтобы блокировать отправку формы при нажатии Enter
            form.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });

            // Добавляем обработчик события для кнопки удаления внутри каждого блока
            equipmentListContainer.addEventListener('click', function (event) {
                const deleteBtn = event.target.closest('.delete-btn');
                if (deleteBtn) {
                    const equipmentBlock = deleteBtn.closest('.equipment-block');
                    if (equipmentBlock) {
                        equipmentBlock.remove();
                    }

                    // Обновляем значение equipmentCounter в скрытом поле
                    const remainingBlocks = equipmentListContainer.querySelectorAll('.equipment-block').length;
                    equipmentCounter = remainingBlocks + 1; // Увеличиваем на 1, так как счет начинается с 1
                    document.getElementById('equipmentCounter').value = equipmentCounter;
                }
            });
        });

    </script>

@endsection
