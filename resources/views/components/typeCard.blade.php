@props(['carCard'=>false, 'guestCard'=>false])

@php
    $id = $carCard ? 'car_card' : ($guestCard ? 'guest_card' : '');
@endphp

<div {{ $attributes->merge(['id' => $id]) }} class="card silver-gradient-form mt-3 ps-4 pe-4">
    {{ $slot }}
</div>
