@extends('layouts.app')
@section('page.title', 'Подать заявку')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="background-color: #1c7430">

                    <p>{{session('foo')}}</p>

                </div>


                <x-typeCard carCard>

                    <x-card-header>
                        <x-card-title>{{__('Въезд автотранспорта')}}</x-card-title>
                    </x-card-header>

                    <x-card-body>

                        <form action="{{ route('carCreate')}}"
                              method="POST">

                            @csrf
                            <x-input type="hidden" name="selected_form" value="Car"/>

                            <x-common.common-form-items :user="$user" :objects="$objectsForParking">

                                <x-form-item class="form-group">
                                    <x-label required for="cars">{{__('Номер автомобиля:')}}
                                        <x-icon title="Например: А 123 БВ 178">
                                        </x-icon>
                                    </x-label>

                                    <x-input name="cars" id="cars"
                                             class="@error('cars') is-invalid @enderror"
                                             required>{{ old('cars') }}
                                    </x-input>
                                    <div>
                                        @error('cars')
                                        <x-error :message="$message"></x-error>
                                        @enderror
                                    </div>
                                </x-form-item>

                                <x-form-item>
                                    <x-label
                                        for="equipment">{{__('Ввозимое/вывозимое имущество (если имеется) :')}}
                                    </x-label>
                                    <x-textarea name="equipment" id="equipment"
                                                class="@error('equipment') is-invalid @enderror ">
                                        {{ old('equipment') }}
                                    </x-textarea>
                                    @error('equipment')
                                    <x-error :message="$message"></x-error>
                                    @enderror
                                </x-form-item>

                                <x-common.common-person-info :user="$user">

                                </x-common.common-person-info>

                                <x-form-item class="mt-3 mb-3">
                                    <button type="submit" class="btn">{{__('Отправить')}}</button>
                                </x-form-item>

                            </x-common.common-form-items>

                        </form>

                    </x-card-body>

                </x-typeCard>

            </div>

@endsection
