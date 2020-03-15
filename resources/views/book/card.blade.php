<div class="book-item">
    <div class="edit-panel">
        <div>
            <a href="/books/{{ $book->id }}/edit">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
        </div>
        <div>
            <a href="/books/{{ $book->id }}/change-status">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </div>
        <div>
            <a href="/books/{{ $book->id }}/delete">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    @if ($book->thumb)
        <div><a href="/books/{{ $book->id }}">{!! \App\Image::render($book->thumb, 'thumb') !!}</a></div>
    @endif
    <h4><a href="/books/{{ $book->id }}">{{ $book->title }}</a></h4>
    <div>{{ $book->edition }}, {{ $book->year_edition }} г.</div>
    <div class="footer">
        <div class="status">Активно</div>
        <div class="views"><i class="fa fa-eye" aria-hidden="true"></i> 32</div>
    </div>
</div>
