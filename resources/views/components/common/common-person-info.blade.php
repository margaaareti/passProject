<div class="row input-group">
    <x-form-item class="col-8">
        <x-label required for="responsible_person">{{__('Ответственный:')}}
            <x-icon>
                ФИО ответственного лица от подразделения
            </x-icon>
        </x-label>
        <x-input name="responsible_person" id="responsible_person"
                 value="{{ old('responsible_person', sprintf('%s %s %s', $user->last_name, $user->name, $user->patronymic))}}"
                 class="@error('responsible_person') is-invalid @enderror"
        />
        @error('responsible_person')

        @foreach($errors->get('responsible_person') as $error)
            <x-error></x-error>
        @endforeach

        @enderror
    </x-form-item>

    <x-form-item class="col-4">
        <x-label required for="phone_number">{{__('Номер телефона:')}}
            <x-icon>
                Номер тел. для оперативной связи>
            </x-icon>
        </x-label>

        <x-input name="phone_number" id="phone_number"
                 class="@error('phone_number') is-invalid @enderror"
                 value="{{ old('phone_number', $user->phone_number)}}"
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
</div>


