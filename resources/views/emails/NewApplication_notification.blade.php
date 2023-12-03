<p1>Здорова.Это Влад из УФБ. Тестирую функционал своего сервиса подачи заявок. Не обращай внимание на данное
    письмо и не удаляй его. Вскоре я это сделаю сам.
</p1>

<p>Новая заявка от пользователя</p>

<ul>
    {{--    <li>{{$guestApplicationData['name']}}</li>--}}
    {{--    <li>{{$guestApplicationData['object']}}</li>--}}
    {{--    <li>{{$guestApplicationData['guests']}}</li>--}}
    <li>{{$guestApplicationData['application_type']}}</li>
    <li>{{$guestApplicationData['guests_count']}}</li>
    @foreach($guestApplicationData['guests'] as $guest_name)
        <li>
            <ul>
                <li>{{$guest_name}}</li>
            </ul>
        </li>
    @endforeach
        {{--    <li>{{$guestApplicationData['purpose']}}</li>--}}

</ul>
