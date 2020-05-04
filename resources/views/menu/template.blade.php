@php
    use App\Components\Session;
@endphp

@if ($menu)
    <ul class="list-unstyled nav-menu">
        @foreach ($menu as $item)
            <li><a href="{{ $item->link == '/books' ? '/' . Session::getCity()->alias . '/books' : $item->link }}">{{ $item->title }}</a></li>
        @endforeach
    </ul>
@endif
