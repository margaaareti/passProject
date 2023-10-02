<div class="time_range">

    <div class="time_start">
        <x-label for="time_start">{{__('Время c :')}}</x-label>
        <x-input type="text" name="time_start" id="time_start" value="{{ old('time_start') }}"/>
        @error('time_start')
        <x-error></x-error>
        @enderror
    </div>

    <div class="time_end">
        <x-label for="time_end"> {{__('До :')}}</x-label>
        <x-input type="text" name="time_end" id="time_end" value="{{ old('time_end') }} "/>
        @error('time_end')
        <x-error :message="$message"></x-error>
        @enderror
    </div>
</div>

