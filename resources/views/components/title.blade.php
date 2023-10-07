<div {{$attributes}}>

    @isset($link)
        <div class="mb-3">
            {{ $link }}
        </div>
    @endisset

    <div class="d-flex justify-content-between">

        <div>
            <h1 class="">
                {{$slot}}
            </h1>
        </div>

        @isset($right)
            <div>
                {{$right}}
            </div>
        @endisset

    </div>


</div>
