@props(['required'=> false])

<label {{$attributes->class([
    ($required ? 'required':''),
    'mb-1'
    ])}}>
    {{$slot}}
</label>

