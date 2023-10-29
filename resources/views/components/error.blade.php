@props(['name' => ''])

@error($name)
<span class="invalid-feedback mb-2" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

