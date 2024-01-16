@props(['items', 'count', 'type'])

<p class="card-body__text">Количество {{ $type }}, указанных в заявке: {{ $count }}</p>
<ul class="card-body__list {{ $type }}-list">
    @foreach ($items as $index => $item)
        <li class="card-body__text @if($index >= 2) hidden @endif">{{ $item->name ?? $item->number }}</li>
    @endforeach

    @if(count($items) > 2)
        <!-- Если элементов больше 3, показываем кнопку "Скрыть всех" -->
        <button class="card-body_button" onclick="showAllItems(this)">Показать всех</button>
    @endif
</ul>
