@props(['size'=>'12'])

<div class="container">
    <div class="row justify-content-center">

        <div {{$attributes->class([

            "col-md-{$size}"
            ])}}>

            <div class="nav-buttons">
                <x-button class="nav-buttons__button btn btn-light">
                    <a class="nav-buttons__link nav-link" href="{{ route('home') }}">На главную</a>
                </x-button>

                @if(Route::is('user.app.show'))
                    <x-button class="nav-buttons__button btn btn-light">
                        <a class="nav-buttons__link nav-link" href="{{ route('user.app') }}">Подать заявку</a>
                    </x-button>
                @else
                    <x-button class="nav-buttons__button btn btn-light" data-bs-toggle="modal"
                              data-bs-target="#exampleModal">
                        Выбрать тип заявки
                    </x-button>
                @endif

                <x-button class="nav-buttons__button btn btn-light {{Route::is('user.app.show') ? 'active-link' : ''}}">
                    <a class="nav-buttons__link nav-link" href="{{ route('user.app.show') }}">Статус
                        заявок</a>
                </x-button>
            </div>
        </div>

    </div>
</div>


