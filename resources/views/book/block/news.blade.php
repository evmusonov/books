@if ($books)
    <h2 class="mb-3">Новинки</h2>
    <div>
        <div class="owl-carousel owl-theme">
            @foreach($books as $book)
                <div>
                    @include('book.show-card', ['book' => $book])
                </div>
            @endforeach
        </div>
    </div>
@endif
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            items: 4,
            nav: true,
            autoplay: true,
            autoplayHoverPause: true,
            loop: true,
            responsive:{
                600:{
                    items:1
                },
                800:{
                    items:2
                },
                1000:{
                    items:4
                }
            }
        });
    });
</script>
