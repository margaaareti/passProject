@extends('admin.layouts.main')

@section('content')
    <section>
        <div class="container">
                <h4>Все заявки</h4>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>ID заявки</th>
                            <th>Тип Заявки</th>
                            <th class="text-center">Подразделение</th>
                            <th>Кем подано</th>
                            <th>Начальная дата</th>
                            <th>Конечная дата</th>
                            <th>Объекты</th>
                            <th>Ответственный</th>
                            <th>Контактный номер</th>
                            <th></th>
                        <tr>
{{--                            <p>{{$application->user['name']}}</p>--}}
                            <tr>
                                <td class="text-center">{{$application->id}}</td>
                                <td>{{$application->application_type}}</td>
                                <td class="text-center">{{$application->user->department}}</td>
                                <td>{{$application->user['last_name']}} {{$application->user['name']}} {{$application->user['patronymic']}}</td>
                                @if($application['application_type'] !== 'Внос/Вынос')
                                    <td>{{date_format(date_create($application->start_date),'d.m.Y')}}</td>
                                    <td>{{date_format(date_create($application->end_date),'d.m.Y')}}</td>
                                    <td>{{$application->object}}</td>
                                @else
                                    <td>{{date_format(date_create($application->{'property-in-date'}),'d.m.Y') }}</td>
                                    <td>{{date_format(date_create($application->{'property-out-date'}),'d.m.Y') }}</td>
                                    <td>{{$application->object_in}} {{$application->object_out}}</td>
                                @endif
                                <td>{{$application->responsible_person}}</td>
                                <td>{{$application->phone_number}}</td>
                                <td>
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor"
                                             class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>

{{--                        <div>--}}
{{--                            @foreach($application->guests as $guest)--}}
{{--                                <p>{{$guest->name}}</p>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

                        <form action="{{route('admin.app.approveApp', $application->id)}}}" method="post">
                            @csrf

                            <input type="hidden" name="id" value="{{$application->id}}">

                            <button type="submit">Согласовать</button>
                        </form>
                    </table>
                </div>
        </div>
    </section>
@endsection

