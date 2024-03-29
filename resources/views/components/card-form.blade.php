@props(['type'])
<meta name="csrf-token" content="{{ csrf_token() }}">

<form {{$attributes}}>
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger pb-0" data-form="common">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @else
        @if (session()->has('success'))
            <div id="success-message" class="alert alert-success" style="display:none">
                {{ session()->get('success') }}
            </div>
        @endif
    @endif

    {{ $slot }}

</form>





