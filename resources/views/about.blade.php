@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="main_content">
{{--            $texts->viewTexts[0]->images--}}
            <h1>{{ $texts->viewTexts[0]->description }}</h1>
            <ul>
                <h3>Ambassadors</h3>
                @foreach($ambassadors as $ambassador)
                    <li class="news__item">
                        <ul>
                            <li>{{ $ambassador->title }}</li>
                            <li>{{ $ambassador->description }}</li>
                            <li><img width="100px" height="100px" src="{{ $ambassador->image }}" alt=""></li>
                        </ul>
                    </li>
                @endforeach

            </ul>
            <ul>
                <h3>Partners</h3>
                @foreach($partners as $partner)
                    <li class="news__item">
                        <ul>
                            <li>{{ $partner->title }}</li>
                            <li>{{ $partner->description }}</li>
                            <li><img width="100px" height="100px" src="{{ $partner->image }}" alt=""></li>
                        </ul>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@endsection