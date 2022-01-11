@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('title', 'Главная')



@section('content')


    <div class="container bg-white">

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
        <div class="row text-center">

            <h2 class="text-center">Наши кинотеатры</h2>
            <div class="col-md-10">
                <div class="row">

                    @foreach($date as $item)

                        <div class="item col-md-6">

                            @php
                                if ($item['logo_img']) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url = Storage::disk('public')->url('catalog/cinema/source/' . $item['logo_img']);
                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/cinema/source/no-img.jpg');
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
            </div>

            <div class="col-md-2">
                <div class="col-md-2 lin">
                    <p>РЕКЛАМА</p>
                </div>


            </div>




        </div>
    </div>
    </div>
@endsection
