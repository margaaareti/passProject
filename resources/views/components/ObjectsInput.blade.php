<div class="form-group">
    <x-label required for="object">{{__('Объекты, на который необходим доступ:')}}
        <span class="tooltip-icon"
              title="Указаны объекты, где имеется СКУД. Если нужный объект отсутствует в списке- необходимо подавать заявку на почту"><i
                class="fa-solid fa-circle-exclamation"></i></span>
    </x-label>
    <select class="object-select" name="object[]" multiple="multiple"
            style="width: 100%"
            required>

        @foreach($objects as $value => $text)
            <option class="select-option" value="{{$value}}">{{$text}}</option>
        @endforeach

    </select>

    @error('object')

    <x-error></x-error>

    @enderror
</div>

