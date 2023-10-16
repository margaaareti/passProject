<input

{{ $attributes->merge([
    'type' => 'text',
    'value'=> old($attributes->get('name'))
])->class([
    'form-control',
]
) }} />

