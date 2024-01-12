@props(['objects', 'multiple' => false,'inputName'=>'object', 'selectClass' => ''])

@php
    // Адаптируем имя поля в зависимости от наличия атрибута multiple
    $fieldName = $multiple ? $inputName.'[]' : $inputName;
    // Получаем значение из old или устанавливаем значение по умолчанию
    $oldValue = old($fieldName, ($multiple ? [] : ''));
@endphp

<div class="form-group">
    <x-label required for="object">{{__('Локация:')}}</x-label>
    <span class="tooltip-icon"
          title="Указаны объекты, где имеется СКУД. Если нужный объект отсутствует в списке - необходимо подавать заявку на почту"><i
            class="fa-solid fa-circle-exclamation"></i></span>

    <select class="object-select {{$selectClass}}" name="{{$fieldName}}" @if($multiple) multiple="multiple" @endif style="width: 100%" required>
        @if(!$multiple)
            <option value="" @if(!old($inputName)) selected @endif disabled>Выберите локацию</option>
        @endif
        @foreach($objects as $object => $text)
            <option class="select-option" value="{{ $object }}"
            @if($multiple)
                {{ in_array($object, $oldValue) ? 'selected' : '' }}
                @else
                {{ $object == $oldValue ? 'selected' : '' }}
                @endif
            >{{ $text }}</option>
        @endforeach
    </select>

    @error($fieldName)
    <x-error :message="$message"/>
    @enderror
</div>



