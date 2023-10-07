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
                <input type="checkbox" name="Checkbox1" class="responsible-checkbox paste-checkbox">
                <x-label class="ms-1" for="Checkbox1">Указать свои данные</x-label>
            </div>
        </div>

        <x-input name="responsible_person" id="responsible_person"
                 value="{{ old('responsible_person')}}"
                 class="person-field @error('responsible_person') is-invalid @enderror"
        />
        @error('responsible_person')

        @foreach($errors->get('responsible_person') as $error)
            <x-error :message="$message"></x-error>
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
                <input type="checkbox" name="Checkbox2" class="phone-checkbox paste-checkbox">
                <x-label class="ms-1" for="Checkbox2">Указать свой номер</x-label>
            </div>
        </div>

        <x-input name="phone_number"
                 class="number-field @error('phone_number') is-invalid @enderror"
                 value="{{ old('phone_number')}}"
        />

        @error('phone_number')
        @foreach($errors->get('phone_number') as $error)
            <span class="invalid-feedback" role="alert">
                <x-error :message="$message"></x-error>
            </span>
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
            var formSelector = document.getElementById('exampleSelect'); // Замените 'form-selector' на ваш собственный id

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

</div>


