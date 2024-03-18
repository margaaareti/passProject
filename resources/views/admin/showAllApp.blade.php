@extends('admin.layouts.main')

@section('content')
    <section>
        <div class="container">
            @if($applications->isEmpty())
                Нет ни одной записи
                <div class="mb-2">
                    <a href="{{ route('admin.app.showAllApp', '') }}"
                       class="btn btn-success mt-3">← {{__('Вернуться к заявкам')}}</a>
                </div>
            @else
                <h4>Все заявки</h4>

                @if(session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <caption>{{__('Таблица заявок')}}</caption>
                        <div class="d-flex mb-4">
                            <div>
                                <button class="btn btn-success" onclick="window.location.reload();">Обновить список</button>
                            </div>
                            <div class="ms-3">
                                <select class="form-select" name="filterStatus" id="filterStatus"
                                        onchange="applyFilter(this.value)">
                                    <option value="all" {{ session('filter') == '' ? 'selected' : '' }}>Все</option>
                                    <option value="new" {{ session('filter') == 'new' ? 'selected' : '' }}>Новые
                                    </option>
                                    <option value="pending" {{ session('filter') == 'pending' ? 'selected' : '' }}>
                                        Ожидающие
                                    </option>
                                    <option value="approved" {{ session('filter') == 'approved' ? 'selected' : '' }}>
                                        Согласованные
                                    </option>
                                </select>
                            </div>
                            <div class="ms-3">
                                <form action={{route('admin.app.search')}} method="GET">
                                    <input type="text" name="application_number" class="form-control"
                                           value="{{session('message') ? '' : request()->input('application_number') }}"
                                           placeholder="Введите номер заявки">
                                    <button type="submit" class="btn btn-primary mt-2">Поиск</button>
                                </form>
                                <button class="btn btn-primary mt-2" onclick="resetSearch()">Сбросить</button>
                            </div>
                        </div>
                        <tr class="table-active">
                            <th>ID заявки</th>
                            <th>Тип Заявки</th>
                            <th class="text-center">Подразделение</th>
                            <th>Кем подано</th>
                            <th>Начальная дата</th>
                            <th>Конечная дата</th>
                            <th>Объекты</th>
                            <th>Ответственный</th>
                            <th style="width: 140px">Контактный номер</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        @foreach($applications as $application)
                            <tr @if(!$application->viewed) style="font-weight: bold" @endif>
                                <td class="text-center">{{$application->id}}</td>
                                <td>{{$application->application_type}}</td>
                                <td class="text-center">{{$application->user->department}}</td>
                                <td>{{$application->user['last_name']}} {{$application->user['name']}} {{$application->user['patronymic']}}</td>
                                <td>{{date_format(date_create($application->start_date),'d.m.Y')}}</td>
                                <td>{{date_format(date_create($application->end_date),'d.m.Y')}}</td>
                                @if($application['application_type'] !== 'Внос/Вынос')
                                    <td>{{$application->object}}</td>
                                @else
                                    <td>
                                        @if($application->applicationable->object_in && $application->applicationable->object_out)
                                            {{$application->applicationable->object_in}}
                                            <br>{{$application->applicationable->object_out}}
                                        @elseif($application->applicationable->object_in)
                                            {{$application->applicationable->object_in}}
                                        @elseif($application->applicationable->object_out)
                                            {{$application->applicationable->object_out}}
                                        @endif
                                    </td>
                                @endif
                                <td>{{$application->responsible_person}}</td>
                                <td>{{$application->phone_number}}</td>
                                <td>
                                    <p class="text-{{$application->status->color()}}">{{$application->status->name()}}</p>
                                </td>
                                <td>
                                    <a href="{{route('admin.app.showApp', ['type'=>$application->applicationable->getType(), 'id'=>$application->id])}}">
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
                        @endforeach

                    </table>
                </div>
            @endif
        </div>
    </section>


    <script>
        function applyFilter(filter) {
            // Формируем URL с параметром фильтра и перезагружаем страницу
            window.location.href = window.location.pathname + '?filter=' + filter;
        }

        function resetSearch() {
            var currentUrl = window.location.href; // Получаем текущий URL страницы
            // Удаляем все после "/search"
            window.location.href = currentUrl.split('/search')[0]; // Перенаправляем на новый URL
        }
    </script>
@endsection


