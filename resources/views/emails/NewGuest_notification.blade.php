<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    .application-notification{
        padding: 10px 10px;
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
        background: #82c9ce;
    }

    .application_info{
        font-size: 16px ;
    }

</style>

<body>
<div class="application-notification">
    <h1 class="application_header">Заявка {{$newGuestApplicationData['application_number']}}: добавлен новый посетитель.</h1>
    <p class="application_info"><strong>ФИО посетителя: {{$newGuestApplicationData['guest_name']}}</strong></p>
    <p class="application_info"><strong>Внесен сотрудником {{$newGuestApplicationData['user_department']}}: {{$newGuestApplicationData['user_name']}}</strong></p>
</div>
</body>
</html>




