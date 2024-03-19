<div class="input-group row mt-3">

    <x-form-item class="col-md-7 col-sm-12">

        <div class="label-group">
            <div>
                <x-label required for="responsible_person">{{__('Ответственный:')}}
                    <x-icon title="ФИО ответственного лица от подразделения">
                    </x-icon>
                </x-label>
            </div>

            <div>
                <input type="checkbox" name="Checkbox1" class="responsible-checkbox paste-checkbox" {{ session('checkbox1') ? 'checked' : '' }}>
                <x-label class="ms-1" for="Checkbox1">{{__('Указать свои данные')}}</x-label>
            </div>
        </div>

        <x-input name="responsible_person" id="responsible_person"
                 class="person-field @error('responsible_person') is-invalid @enderror"
        />
        @error('responsible_person')

        @foreach($errors->get('responsible_person') as $error)
            <x-error :message="$error"></x-error>
        @endforeach

        @enderror

    </x-form-item>

    <x-form-item class="col-md-5 col-sm-12">

        <div class="label-group">

            <div>
                <x-label required for="phone_number">{{__('Телефон:')}}
                    <x-icon title="Ввод номера с восьмерки">
                    </x-icon>
                </x-label>
            </div>

            <div class="checkbox-wrapper-29">
                <label class="checkbox">
                    <input type="checkbox" name="Checkbox2" class="phone-checkbox paste-checkbox checkbox__input" {{ session('checkbox2') ? 'checked' : '' }}>
                    <span class="checkbox__label"></span>
                    <span class="ms-1">{{__('Указать свой номер:')}}</span>
                </label>
            </div>
        </div>

        <x-input name="phone_number"
                 class="number-field @error('phone_number') is-invalid @enderror"
        />

       <x-error name="phone_number"></x-error>

    </x-form-item>


    <x-form-item>
        <x-label for="additional_info">{{__('Дополнительная информация')}}:
        </x-label>
        <x-textarea name="additional_info" id="additional_info" rows="4"
                    cols="40"
                    class="@error('additional_info') is-invalid @enderror">{{old('additional_info')}}
        </x-textarea>
        <x-error name="additional_info"/>
    </x-form-item>

    {{$slot}}


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formSelector = document.getElementById('exampleSelect');
            const userLastName = '{{$user->last_name}}';
            const userName = '{{$user->name}}';
            const userPatronymic = '{{$user->patronymic}}';
            const userPhoneNumber = '{{$user->phone_number}}';

            formSelector.addEventListener('change', function () {
                resetInputs('.responsible-checkbox', '.person-field');
                resetInputs('.phone-checkbox', '.number-field');
            });

            handleCheckbox('.responsible-checkbox', '.person-field', userLastName + ' ' + userName + ' ' + userPatronymic);
            handleCheckbox('.phone-checkbox', '.number-field', userPhoneNumber);

            function resetInputs(checkboxSelector, inputSelector) {
                const checkboxes = document.querySelectorAll(checkboxSelector);
                const inputs = document.querySelectorAll(inputSelector);

                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                inputs.forEach(function (input) {
                    input.value = '';
                });
            }

            function handleCheckbox(checkboxSelector, inputSelector, value) {
                const checkboxes = document.querySelectorAll(checkboxSelector);
                const inputs = document.querySelectorAll(inputSelector);

                checkboxes.forEach(function (checkbox) {
                    checkbox.addEventListener('change', function () {
                        for (let i = 0; i < inputs.length; i++) {
                            inputs[i].value = this.checked ? value : '';
                        }
                    });
                });

                // Добавляем обработчик события для очистки чекбоксов при изменении значений полей
                inputs.forEach(function (input) {
                    input.addEventListener('input', function () {
                        {
                            checkboxes.forEach(function (checkbox) {
                                checkbox.checked = false;
                            });
                        }
                    });
                });

                inputs.forEach(function (input) {
                    input.addEventListener('input', function () {
                        if (input.value === userLastName + ' ' + userName + ' ' + userPatronymic || input.value === userPhoneNumber) {
                            checkboxes.forEach(function (checkbox) {
                                checkbox.checked = true;
                            });
                        }
                    });
                });
            }
        });

    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var checkboxName = this.name;
                    var isChecked = this.checked;
                    sessionStorage.setItem('checkbox_' + checkboxName, isChecked);
                });

                var storedValue = sessionStorage.getItem('checkbox_' + checkbox.name);

                if (storedValue !== null) {
                    checkbox.checked = storedValue === 'true';
                }
            });
        });

    </script>



    <style>
        .checkbox-wrapper-29 {
            --size: 1rem;
            --background: #fff;
            font-size: var(--size);
        }

        .checkbox-wrapper-29 *,
        .checkbox-wrapper-29 *::after,
        .checkbox-wrapper-29 *::before {
            box-sizing: border-box;
        }

        .checkbox-wrapper-29 input[type="checkbox"] {
            visibility: hidden;
            display: none;
        }

        .checkbox-wrapper-29 .checkbox__label {
            width: var(--size);
        }

        .checkbox-wrapper-29 .checkbox__label:before {
            content: ' ';
            display: block;
            height: var(--size);
            width: var(--size);
            position: absolute;
            top: calc(var(--size) * 0.125);
            left: 0;
            background: var(--background);
        }

        .checkbox-wrapper-29 .checkbox__label:after {
            content: ' ';
            display: block;
            height: 20px;
            width: 20px;
            border: calc(var(--size) * .14) solid #888686;
            transition: 200ms;
            position: absolute;
            top: calc(var(--size) * 0.125);
            left: 0;
            background: var(--background);
        }

        .checkbox-wrapper-29 .checkbox__label:after {
            transition: 100ms ease-in-out;
        }

        .checkbox-wrapper-29 .checkbox__input:checked ~ .checkbox__label:after {
            border-top-style: none;
            border-right-style: none;
            -ms-transform: rotate(-45deg); /* IE9 */
            transform: rotate(-45deg);
            height: calc(var(--size) * .5);
            border-color: green;
        }

        .checkbox-wrapper-29 .checkbox {
            position: relative;
            display: flex;
            cursor: pointer;
            /* Mobile Safari: */
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        .checkbox-wrapper-29 .checkbox__label:after:hover,
        .checkbox-wrapper-29 .checkbox__label:after:active {
            border-color: green;
        }

        .checkbox-wrapper-29 .checkbox__label {
            margin-right: calc(var(--size) * 0.45);
        }
    </style>



    <style>
        .checkbox-wrapper-47 input[type="checkbox"] {
            display: none;
            visibility: hidden;
        }

        .checkbox-wrapper-47 label {
            position: relative;
            padding-left: 2em;
            padding-right: 1em;
            line-height: 2;
            cursor: pointer;
            display: inline-flex;
        }

        .checkbox-wrapper-47 label:before {
            box-sizing: border-box;
            content: " ";
            position: absolute;
            top: 0.3em;
            left: 0;
            display: block;
            width: 1.4em;
            height: 1.4em;
            border: 2px solid #9098A9;
            border-radius: 6px;
            z-index: -1;
        }

        .checkbox-wrapper-47 input[type=checkbox]:checked + label {
            padding-left: 1em;
            color: #0f5229;
        }
        .checkbox-wrapper-47 input[type=checkbox]:checked + label:before {
            top: 0;
            width: 100%;
            height: 2em;
            background: #b7e6c9;
            border-color: #2cbc63;
        }

        .checkbox-wrapper-47 label,
        .checkbox-wrapper-47 label::before {
            transition: 0.25s all ease;
        }
    </style>



</div>

