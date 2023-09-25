<input @if($attributes['type'] !=='hidden') class="form-control" @endif
 @error('department') is-invalid @enderror"

{{ $attributes->merge([
    'type' => 'text'
]) }} />

