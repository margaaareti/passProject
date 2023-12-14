<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    .application-notification{
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
        background: #31bdd3;
    }

</style>

<body>
<div class="application-notification">
    <h1>Новая заявка</h1>
    <div class="card" style="text-align: left;">

        <h1 class="application_header">Новая заявка от сотрудника: {{$carApplicationData['user_fullname']}}</h1>
{{--        <h2 class="application_header">ИСУ: {{$guestApplicationData['user_isu']}}</h2>--}}
{{--        <h3 class="application_header">Почта: {{$guestApplicationData['user_email']}}</h3>--}}
{{--        <h4 class="application_header">Заголовок HQ: {{$guestApplicationData['object']}}, {{$guestApplicationData['department']}},--}}
{{--            <{{$guestApplicationData['end_date']}}> </h4>--}}

{{--        --}}{{--<p><strong>Тип:</strong> {{$guestApplicationData['application_type']}} </p>--}}
{{--        <p class="application_info"><strong>Подразделение: </strong>{{$guestApplicationData['department']}}</p>--}}
{{--        <p class="application_info"><strong>C</strong> {{$guestApplicationData['start_date']}}<strong> по </strong>{{$guestApplicationData['end_date']}}--}}
{{--        </p>--}}
{{--        <p class="application_info"><strong>Локация: </strong>{{$guestApplicationData['object']}}</p>--}}
{{--        --}}{{--<p><strong>Цель: </strong>{{$guestApplicationData['purpose']}}</p>--}}
{{--        --}}{{--<p><strong>Кол-во гостей: </strong>{{$guestApplicationData['guests_count']}}</p>--}}
{{--        <p class="application_info"><strong>Ответственный: </strong>{{$guestApplicationData['responsible_person']}}</p>--}}
{{--        <p class="application_info"><strong>Телефон: </strong>{{$guestApplicationData['phone_number']}}</p>--}}
{{--        @unless(empty($guestApplicationData['additional_info']))--}}
{{--            <p><strong>Доп.информация: </strong>{{$guestApplicationData['additional_info']}}</p>--}}
{{--        @endunless--}}

{{--        --}}{{--<p><strong>Приглашенные лица в зявке:</strong></p>--}}
{{--        --}}{{--@foreach($guestApplicationData['guests'] as $guest_name)--}}
{{--        --}}{{--        <ul>--}}
{{--        --}}{{--            <li>{{$guest_name}}</li>--}}
{{--        --}}{{--        </ul>--}}
{{--        --}}{{--@endforeach--}}
    </div>
</div>
</body>
</html>




