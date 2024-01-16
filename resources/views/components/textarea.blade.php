@props(['readonly' => false])

<textarea {{$attributes->merge([
    'type' => 'text',
    'class'=>'form-control',
    'readonly'=> $readonly ? 'readonly' : null,
    ])}}>{{old($attributes->get('name'))}}</textarea>
