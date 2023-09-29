<input @if($attributes['type'] !=='hidden') class="form-control" @endif"

{{ $attributes->merge([
    'type' => 'text',
]) }} />

