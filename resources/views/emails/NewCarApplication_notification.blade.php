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
    <h1>Новая заявка: въезд автотранспорта</h1>
    <div class="card" style="text-align: left;">

        <h1 class="application_header">Новая заявка от сотрудника: {{$carApplicationData['user_fullname']}}</h1>
        <h2 class="application_header">ИСУ: {{$carApplicationData['user_isu']}}</h2>
        <h3 class="application_header">Почта: {{$carApplicationData['user_email']}}</h3>
        <h4 class="application_header">Заголовок HQ: {{$carApplicationData['object']}}, {{$carApplicationData['department']}},
            <{{$carApplicationData['end_date']}}> </h4>

{{--        <p><strong>Тип:</strong> {{$carApplicationData['application_type']}} </p>--}}
        <p class="application_info"><strong>Подразделение: </strong>{{$carApplicationData['department']}}</p>
        <p class="application_info"><strong>C</strong> {{$carApplicationData['start_date']}}<strong> по </strong>{{$carApplicationData['end_date']}}
        </p>
        <p class="application_info"><strong>Локация: </strong>{{$carApplicationData['object']}}</p>
{{--        <p><strong>Цель: </strong>{{$carApplicationData['purpose']}}</p>--}}
        <p class="application_info"><strong>Ответственный: </strong>{{$carApplicationData['responsible_person']}}</p>
        <p class="application_info"><strong>Телефон: </strong>{{$carApplicationData['phone_number']}}</p>
        @unless(empty($carApplicationData['additional_info']))
            <p><strong>Доп.информация: </strong>{{$carApplicationData['additional_info']}}</p>
        @endunless
    </div>
</div>
</body>
</html>




