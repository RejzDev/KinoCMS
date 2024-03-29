@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            @if($data['bgBanner'][0]['image'] == null)
             background-color: #FFFFFF; /* Цвет фона и путь к файлу */

            @else
            background-image: url("{{\Storage::disk('public')->url('catalog/banner/source/' . $data['bgBanner'][0]['image'])}}"); /* Цвет фона и путь к файлу */

        @endif
        }
    </style>
@endsection

@section('phone')
    <p class="phone-p">{{ $data['mainPage']['first_phone']}}</p>
    <p class="phone-p">{{ $data['mainPage']['second_phone']}}</p>
@endsection

@section('mainBanner')
@if($data['banner'][0]['status'] == 1)
    <div id="myCarousel1" class="carousel slide slide_main" data-ride="carousel">


        <!-- Wrapper for slides -->
        <div class="carousel-inner">

            @foreach($data['mainBanner'] as $key=>$item)
                <div class="item @if($key == 0) active @endif ">
                    <img src="{{\Storage::disk('public')->url('catalog/banner/source/' . $item['image'])}}" alt="Los Angeles" style="width:100%; height: 60%;">
                    <div class="carousel-caption">
                    </div>
                </div>
            @endforeach


        </div>


        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel1" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endif

@endsection

@section('content')
    <div class="container bg-style">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
                    <img src="/images/bg.jpg" alt="Los Angeles" style="width:100%; height: 60%;">
                    <div class="carousel-caption">
                        <h3>Los Angeles</h3>
                        <p>LA is always so much fun!</p>
                    </div>
                </div>

                <div class="item">
                    <img src="/images/bg.jpg" alt="Chicago" style="width:100%; height: 60%;">
                    <div class="carousel-caption">
                        <h3>Chicago</h3>
                        <p>Thank you, Chicago!</p>
                    </div>
                </div>

                <div class="item">
                    <img src="/images/bg.jpg" alt="New York" style="width:100%; height: 60%;">
                    <div class="carousel-caption">
                        <h3>New York</h3>
                        <p>We love the Big Apple!</p>
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <h2 class="text-center">Список текущих фильмов</h2>
        <div class="row text-center">

            @foreach($data['state'] as $item)

                <div class="item  col-xs-3 col-lg-3">
                    @php
                        if ($item['image']) {
                            // $url = url('storage/catalog/category/image/' . $category->image);
                            $url = Storage::disk('public')->url('catalog/movie/source/' . $item['image']);
                        } else {
                            // $url = url('storage/catalog/category/image/default.jpg');
                            $url = Storage::disk('public')->url('catalog/movie/source/no-img.jpg');
                        }
                    @endphp
                    <div class="thumbnail">
                        <img class="group list-group-image img-kino" src="{{ $url }}" alt="" class="img-fluid">
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">{{$item['name']}}</h4>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="{{route('page.movie', $item['id'])}}">Купить билет</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            @endforeach

        </div>

        <h2 class="text-center">Скоро в прокате</h2>
        <div class="row text-center">

            @foreach($data['soon'] as $item)

                <div class="item  col-xs-3 col-lg-3">
                    @php
                        if ($item['image']) {
                            // $url = url('storage/catalog/category/image/' . $category->image);
                            $url = Storage::disk('public')->url('catalog/movie/source/' . $item['image']);
                        } else {
                            // $url = url('storage/catalog/category/image/default.jpg');
                            $url = Storage::disk('public')->url('catalog/movie/source/no-img.jpg');
                        }
                    @endphp
                    <div class="thumbnail">
                        <img class="group list-group-image img-kino" src="{{ $url }}" alt="" class="img-fluid">
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">{{$item['name']}}</h4>
                        </div>
                    </div>

                </div>

            @endforeach

        </div>


        <h2 class="text-center">Новости и Акции</h2>
        <div class="row text-center">



            <div id="carouselExampleIndicators" class="carousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($data['newsBanner']  as $key=>$item)

                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="@if($key == 0) active @endif "></li>

                    @endforeach
                </ol>
                <div class="carousel-inner">

                    @foreach($data['newsBanner']  as $key=>$item)
                        <div class="carousel-item @if($key == 0) active @endif ">
                            <img src="{{\Storage::disk('public')->url('catalog/banner/source/' . $item['image'])}}"  style="width:550px; height: 300px;">
                            <div class="carousel-caption">
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
                <h3 class="text-center">Сео-текст</h3>
        <p>{{ $data['mainPage']['seo_description']}}</p>
    </div>



@endsection

@section('js')
    <script>
        $('#myCarousel1').carousel({
            interval: {{$data['mainBanner'][0]['banners']['time']}} + '000'
        })
    </script>
@endsection

