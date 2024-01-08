@props(['objects', 'multiple' => false,'inputName'=>'object', 'selectClass' => ''])

@php
    // Адаптируем имя поля в зависимости от наличия атрибута multiple
    $fieldName = $multiple ? $inputName.'[]' : $inputName;
@endphp

<div class="form-group">
    <x-label required for="object">{{__('Локация:')}}
        <span class="tooltip-icon"
              title="Указаны объекты, где имеется СКУД. Если нужный объект отсутствует в списке- необходимо подавать заявку на почту"><i
                class="fa-solid fa-circle-exclamation"></i></span>
    </x-label>

    <select class="object-select {{$selectClass}}" name="{{$fieldName}}" @if($multiple) multiple="multiple" @endif style="width: 100%" required>
        @if(!$multiple)
        <option value="" selected disabled>Выберите локацию</option>
        @endif
        @foreach($objects as $object => $text)
                <option class="select-option" value="{{ $object }}"
                @if($multiple)
                    {{ in_array($object, old($inputName, [])) ? 'selected' : '' }}
                    @elseif(!$multiple)
                    {{old($inputName ? 'selected' : '' )}}
                    @endif
                >{{ $text }}</option>
        @endforeach

    </select>

    @error($fieldName)

    <x-error :message="$message"></x-error>

    @enderror
</div>


