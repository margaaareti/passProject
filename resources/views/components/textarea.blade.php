<textarea {{$attributes->merge([
    'type' => 'text',
    'class'=>'form-control'
    ])}}>{{old($attributes->get('name'))}}</textarea>
