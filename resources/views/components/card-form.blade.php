<form {{ $attributes}}>

    @csrf

    @if ($errors->any())
        <div class="alert alert-danger pb-0">
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



