@props(['value'=>''])

<input

{{ $attributes->merge([
    'type' => 'text',
    'value'=> (old($attributes->get('name'),$value)),
])->class([
    'form-control',
]
) }} />

