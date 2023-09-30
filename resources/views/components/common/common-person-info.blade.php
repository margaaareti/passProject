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
                 class="@error('responsible_person') is-invalid @enderror"
        />
        @error('responsible_person')

        @foreach($errors->get('responsible_person') as $error)
            <x-error></x-error>
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

        <x-input name="phone_number" id="phone_number"
                 class="@error('phone_number') is-invalid @enderror"
                 value="{{ old('phone_number')}}"
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
        <x-label for="additional_info">{{__('Дополнительная информация')}}:
        </x-label>
        <x-textarea name="additional_info" id="additional_info" rows="4"
                    cols="40"
                    class="@error('additional_info') is-invalid @enderror">{{old('additional_info')}}
        </x-textarea>

        @error('additional_info')
        <x-error></x-error>
        @enderror
    </x-form-item>

    {{$slot}}

    <script>
        $(document).ready(function () {
            $('.responsible-checkbox').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#responsible_person').val('{{ sprintf("%s %s %s", $user->last_name, $user->name, $user->patronymic) }}');
                } else {
                    $('#responsible_person').val('');
                }
            });

            $('.phone-checkbox').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#phone_number').val('{{ $user->phone_number }}');
                } else {
                    $('#phone_number').val('');
                }
            });
        });
    </script>
</div>


