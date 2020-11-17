@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="main_content">
            <ul>
                @foreach($services as $item)
                    <li class="news__item">
                        <div>
                            <ul>
                                <li>{{ $item->name }}</li>
                                <li>{{ $item->description }}</li>
                            </ul>
                            <button class="btn-primary">Заказать</button>
                        </div>

                        <div>
                            @foreach($item->examples as $example)
                                <ul>
                                    <li>{{ $example->name }}</li>
                                    <li>{{ $example->description }}</li>
                                    @if(!empty($images = json_decode($example->media)))
                                        <li>
                                            @foreach($images as $image)
                                                <img width="100px" height="100px" src="{{ $image }}" alt="">
                                            @endforeach
                                        </li>
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@endsection