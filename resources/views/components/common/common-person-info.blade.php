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
        @error('phone_number')
        @foreach($errors->get('phone_number') as $error)
                <x-error :message="$error"></x-error>
        @endforeach
        @enderror

    </x-form-item>


    <x-form-item>
        <x-label for="additional_info">{{__('Дополнительная информация')}}:
        </x-label>
        <x-textarea name="additional_info" id="additional_info" rows="4"
                    cols="40"
                    class="@error('additional_info') is-invalid @enderror">{{old('additional_info')}}
        </x-textarea>

        @error('additional_info')
        <x-error :message="$message"></x-error>
        @enderror
    </x-form-item>

    {{$slot}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var formSelector = document.getElementById('exampleSelect');

            formSelector.addEventListener('change', function () {
                var responsibleCheckboxes = document.querySelectorAll('.responsible-checkbox');
                var phoneCheckboxes = document.querySelectorAll('.phone-checkbox');
                var responsiblePersonInputs = document.querySelectorAll('.person-field');
                var phoneNumberInputs = document.querySelectorAll('.number-field');

                responsibleCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                phoneCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                responsiblePersonInputs.forEach(function (input) {
                    input.value = '';
                });

                phoneNumberInputs.forEach(function (input) {
                    input.value = '';
                });
            });

            var responsibleCheckboxes = document.querySelectorAll('.responsible-checkbox');
            var phoneCheckboxes = document.querySelectorAll('.phone-checkbox');

            responsibleCheckboxes.forEach(function (checkbox) {
                var responsiblePersonInputs = document.querySelectorAll('.person-field');
                for (var i = 0; i < responsiblePersonInputs.length; i++) {
                    if (checkbox.checked) {
                        responsiblePersonInputs[i].value = '{{$user->last_name}} {{$user->name}} {{$user->patronymic}}';
                    }
                }
            });

        // else {
        //         responsiblePersonInputs[i].value = '';

            phoneCheckboxes.forEach(function (checkbox) {
                var phoneNumberInputs = document.querySelectorAll('.number-field');
                for (var i = 0; i < phoneNumberInputs.length; i++) {
                    if (checkbox.checked) {
                        phoneNumberInputs[i].value = '{{$user->phone_number}}';
                    }
                }
            });

        // else {
        //         phoneNumberInputs[i].value = '';
        //     }


            responsibleCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    var responsiblePersonInputs = document.querySelectorAll('.person-field');
                    for (var i = 0; i < responsiblePersonInputs.length; i++) {
                        if (this.checked) {
                            responsiblePersonInputs[i].value = '{{$user->last_name}} {{$user->name}} {{$user->patronymic}}';
                        } else {
                            responsiblePersonInputs[i].value = '';
                        }
                    }
                });
            });

            phoneCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    var phoneNumberInputs = document.querySelectorAll('.number-field');
                    for (var i = 0; i < phoneNumberInputs.length; i++) {
                        if (this.checked) {
                            phoneNumberInputs[i].value = '{{$user->phone_number}}';
                        } else {
                            phoneNumberInputs[i].value = '';
                        }
                    }
                });
            });
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


