<div class="book-item">
    @if ($book->thumb)
        <div><a href="/books/{{ $book->id }}">{!! \App\Image::render($book->thumb, 'thumb') !!}</a></div>
    @endif
    <h4 class="mb-1 mt-3"><a href="/books/{{ $book->id }}">{{ $book->title }}</a></h4>
    <div>{{ $book->edition }}, {{ $book->year_edition }} г.</div>
    <div class="footer">
        <div class="status" title="Тип сделки">{{ $book->dealType->title }}</div>
        <div class="views" title="Дата размещения">{{ date('d.m.Y H:s', strtotime($book->created_at)) }}</div>
    </div>
</div>
