@component('modals.modal')
    @slot('name', 'city-choose-modal')
    @slot('title', 'Веберите город')

    <div class="chosen-city text-center">
        @foreach(\App\City::where('status', 1)->get() as $city)
            <div class="name choose-city-js" data-id="{{ $city->id }}">{{ $city->title }}</div>
        @endforeach
    </div>

@endcomponent
