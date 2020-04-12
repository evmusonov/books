<div class="book-item">
    @if (\Illuminate\Support\Facades\Auth::check())
        <div style="background: none;" class="{{ in_array($book->id, \Illuminate\Support\Facades\Auth::user()->favBooksIds()) ? 'no-edit-panel' : 'edit-panel' }}">
            <div>
                <a href="/user/{{ \Illuminate\Support\Facades\Auth::user()->id }}/favorite?book_id={{ $book->id }}" id="fav-{{ \Illuminate\Support\Facades\Auth::user()->id }}-{{ $book->id }}" class="change-fav-js" title="В избранное">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    @endif
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
