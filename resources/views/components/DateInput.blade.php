<div class="date_range">
    <div class="start_date">
        <x-label required for="start_date" >{{__('С:')}}</x-label>
        <x-input type="date" name="start_date" id="start_date"
                 value="{{ old('start_date') ?? now()->format('Y-m-d') }}"
                 required/>
        @error('start_date')
        <x-error :message="$message"></x-error>
        @enderror
    </div>

    <div class="end_date">
        <x-label required for="end_date" >{{__('По:')}}</x-label>
        <x-input type="date" name="end_date" id="end_date"
                 value="{{ old('end_date') ?? now()->format('Y-m-d') }}"
                 required />
        @error('end_date')
        <x-error :message="$message"></x-error>
        @enderror
    </div>

</div>

