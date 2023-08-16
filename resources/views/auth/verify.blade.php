@extends('layouts.app')

@section('content')
    @php
        $resentEmail = session('resent_email') ?? old('email')
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Подтверждение email-адреса') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Новая ссылка для подтверждения e-mail была отправлена на Ваш адрес ')  }} {{ session('resent_email') }}
                            </div>
                        @endif

                        <div
                            class="mb-2"> {{ __('На Вашу почту '. $resentEmail. ' была отправлена ссылка для подтверждения Вашего e-mail адреса.') }}
                        </div>

                        <div>
                            {{ __('Если Вы не получили письмо и уверены в правильности введеного почтового ящика, нажмите на эту ссылку чтобы отправить письмо еще раз ->') }}
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-link p-0 m-0 align-baseline bla">{{ __('отправить повторную ссылку') }}</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
