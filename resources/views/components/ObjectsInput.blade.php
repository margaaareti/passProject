@props(['objects', 'multiple' => false,'inputName'=>'object'])

<div class="form-group">
    <x-label required for="object">{{__('Локация:')}}
        <span class="tooltip-icon"
              title="Указаны объекты, где имеется СКУД. Если нужный объект отсутствует в списке- необходимо подавать заявку на почту"><i
                class="fa-solid fa-circle-exclamation"></i></span>
    </x-label>

    <select class="object-select" name="{{$inputName}}[]" @if($multiple) multiple="multiple" @endif style="width: 100%" required>

        @foreach($objects as $object => $text)
            <option class="select-option" value="{{ $object }}" {{ in_array($object, old('object', [])) ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach

    </select>

    @error('object')

    <x-error :message="$message"></x-error>

    @enderror
</div>


