@props(['name' => ''])

@error($name)
<span class="invalid-feedback mb-2" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror


{{--@if ($errors->has($name))--}}
{{--    <div class="alert alert-danger pb-0">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->get($name) as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
