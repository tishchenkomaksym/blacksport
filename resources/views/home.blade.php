@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="main_content">
        <ul>
            @foreach($news as $item)
                <li class="news__item">
                    <ul>
                        <li>{{ $item->title }}</li>
                        <li>{{ $item->description }}</li>
                    </ul>
                    <div>
{{--                        {{ dd($item->images) }}--}}
                        @if(!empty($images = json_decode($item->images)))
                            @foreach($images as $image)
                                <img width="300px" height="200px" src="{{ $image }}" alt="">
                            @endforeach
                        @endif
                    </div>
                </li>
            @endforeach

        </ul>
    </div>
</div>
@endsection
