<div>
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


    <x-form-item>
        <x-DateInput></x-DateInput>
    </x-form-item>

    <x-form-item>
        <x-TimeInput></x-TimeInput>
    </x-form-item>

    <x-form-item>
        <x-ObjectsInput :objects="$objects" :multiple="true"></x-ObjectsInput>
    </x-form-item>

    <x-form-item>
        <x-label required for="purpose">{{__('Цель:')}}
                <x-icon title="Кратко, цель приглашения: стажировка, проведение работ, съемки, участие в мероприятии *название мероприятия* и т.д.">
                </x-icon>
        </x-label>

        <x-textarea name="purpose" id="purpose"
                    class="@error('purpose') is-invalid @enderror"
                    require>{{ old('purpose') }}
        </x-textarea>

        <x-error name="purpose"/>
    </x-form-item>

    {{$slot}}

</div>

