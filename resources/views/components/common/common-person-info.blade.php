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

            <div>
                <input type="checkbox" name="Checkbox2" class="phone-checkbox paste-checkbox" {{ session('checkbox2') ? 'checked' : '' }}>
                <x-label class="ms-1" for="Checkbox2">{{__('Указать свой номер:')}}</x-label>
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


</div>

