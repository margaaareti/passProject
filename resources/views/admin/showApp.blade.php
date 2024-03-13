@extends('admin.layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <h4 class="display-5 mb-4">{{$application->applicationable->getName()}} {{$application->id}}</h4>
            </div>
            @if($application->status->isApproved())
                <div class="text-center d-flex align-items-center justify-content-center">
                    <div class="display-4 mb-3 ms-5">Согласовано!</div>
                    <div class=""><small>({{$application->approver->last_name}} {{$application->approver->name}}
                            ) </small></div>
                </div>
                <div class="alert alert-success text-center mb-0" role="alert">
                    Данные заявки успешно внесены в Google таблицу под номером
                    <strong>{{$application->application_number}}</strong>
                </div>
                <div class="mb-2">
                    <a href="{{ route('admin.app.showAllApp', $application->applicationable->id) }}"
                       class="btn  btn-success mt-3">← {{__('Вернуться к заявкам')}}</a>
                </div>
            @elseif($application->status->isPending())
                <div class="text-center d-flex align-items-center justify-content-center">
                    <div class="display-4 mb-3 ms-5">В ожидании!</div>
                    <div class=""><small>({{$application->approver->last_name}} {{$application->approver->name}}
                            ) </small></div>
                </div>
                <div class="alert alert-warning text-center mb-0" role="alert">
                    Заявка находится в ожидании по причине: {{$application->pending_comment}}
                    <strong>{{$application->application_number}}</strong>
                </div>
                <div class="mb-2">
                    <a href="{{ route('admin.app.showAllApp', $application->applicationable->id) }}"
                       class="btn  btn-success mt-3">← {{__('Вернуться к заявкам')}}</a>
                </div>
            @endif


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID заявки</th>
                                <td>{{$application->id}}</td>
                            </tr>
                            <tr>
                                <th>Тип Заявки</th>
                                <td>{{$application->application_type}}</td>
                            </tr>
                            <tr>
                                <th>Подразделение</th>
                                <td>{{$application->user->department}}</td>
                            </tr>
                            <tr>
                                <th>Кем подано</th>
                                <td>
                                    {{$application->user['last_name']}}
                                    {{$application->user['name']}}
                                    {{$application->user['patronymic']}}
                                    ({{$application->user->isu_number}})
                                </td>
                            </tr>
                            @if($application['application_type'] !== 'Внос/Вынос')
                                <tr>
                                    <th>Начальная дата</th>
                                    <td>{{date_format(date_create($application->start_date),'d.m.Y')}}</td>
                                </tr>
                                <tr>
                                    <th>Конечная дата</th>
                                    <td>{{date_format(date_create($application->end_date),'d.m.Y')}}</td>
                                </tr>
                                <tr>
                                    <th>Объекты</th>
                                    <td>{{$application->object}}</td>
                                </tr>
                            @else
                                <tr>
                                    <th>Дата вноса</th>
                                    <td>{{date_format(date_create($application->{'property-in-date'}),'d.m.Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Дата выноса</th>
                                    <td>{{date_format(date_create($application->{'property-out-date'}),'d.m.Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Объекты</th>
                                    <td>{{$application->object_in}} {{$application->object_out}}</td>
                                </tr>
                            @endif
                            @if($application->equipment)
                                <tr>
                                    <th>Имущество/Оборудование</th>
                                    <td>{{$application->equipment}}</td>
                                </tr>

                            @endif
                            <tr>
                                <th>Ответственный</th>
                                <td>{{$application->responsible_person}}</td>
                            </tr>
                            <tr>
                                <th>Контактный номер</th>
                                <td>{{$application->phone_number}}</td>
                            </tr>
                            @if($application->application_type == 'Проход')
                                <tr>
                                    <th>Количество приглашенных</th>
                                    <td>{{$application->applicationable->guests_count}}</td>
                                </tr>
                                <tr>
                                    <th>Список приглашенных</th>
                                    <td>
                                        @foreach($application->applicationable->guests as $guest)
                                            {{$guest->name}} <br>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    @if($application->additional_info)
                                        <th>Дополнительная информация по заявке</th>
                                        <td>
                                            {{$application->additional_info}}
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        </table>

                        <div class="d-flex flex-row">
                            @if(!$application->status->isApproved())
                                <div class="me-5 d-flex flex-row">
                                    <form action="{{route('admin.app.approveApp', $application->id)}}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$application->id}}">
                                        <button type="submit" class="btn btn-success mt-3">Согласовать</button>
                                        <div class="form-check form-check-lg mt-2 ms-1">
                                            <input class="form-check-input" type="checkbox" name="with_letter"
                                                   id="with_letter_{{ $application->id }}">
                                            <label class="form-check-label" for="with_letter_{{ $application->id }}">
                                                С ответом
                                            </label>
                                        </div>
                                    </form>
                                    @if(!$application->status->isPending())
                                    <div>
                                        <button type="submit" class="btn btn-warning mt-3 ms-3" id="pending_btn">В
                                            ожидание
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('guests.export', $application->applicationable->id) }}"
                                   class="btn  btn-success mt-3">{{__('Загрузить список приглашенных в exel')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" id="pendingModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Причина перевода заявки в ожидание</h5>
                        </div>
                        <div class="modal-body">
                            <!-- Форма для ввода причины -->
                            <form action="{{route('admin.app.pendingApp', $application->id)}}" method="post" id="reasonForm">
                                @csrf
                                <div class="form-group">
                                    <label class="mb-2" for="reason">Причина:</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                                    <input type="hidden" name="id" value="{{$application->id}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="hide_btn">Отмена</button>
                                    <button type="submit" class="btn btn-primary" onclick="submitReason()">Подтвердить</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const checkbox = document.getElementById('with_letter_{{ $application->id }}');
                const pendingModal = document.getElementById('pendingModal')
                const pendingBtn = document.getElementById('pending_btn')
                const modal = new bootstrap.Modal(pendingModal);
                const hideButton = document.getElementById('hide_btn');

                pendingBtn.addEventListener('click', function() {
                    // Открываем модальное окно
                    modal.show();
                })

               hideButton.addEventListener('click', function() {
                   // Открываем модальное окно
                   modal.hide();
               })

                checkbox.addEventListener('change', function () {
                    if (!this.checked) {
                        this.blur(); // Снимаем фокус с чекбокса, если он не отмечен
                    }
                });
            });

        </script>

    </section>
@endsection

