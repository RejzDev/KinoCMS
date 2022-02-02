@extends('layouts.page')

@section('title', 'Главная')

@section('css')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

@endsection

@section('content')


    <div class="container">

        <div class=" col-md-12">
            <img src="{{\Storage::disk('public')->url('catalog/hall/source/' . $data['banner_img'])}}" style="width:100%; height: 400px;">

        </div>
        <div class="row text-center col-md-12">

            <div class="col-md-2">
                <p>Реклама</p>


                <div class="row">
                    <p>Смотрите сегодня</p>
                    @foreach($timeTable as $item)
                        <span class="border border-dark">{{$item['movies']['name']}}</span>
                    @endforeach
                </div>
            </div>

            <div class="col-md-10 ">
                <div class="row">
                         <h3 class="text-center">Зал {{$data['number']}}</h3>



                </div>
                <div class="col-md-10">
                    <div class="row">
                        <p class="text-left">{{$data['description']}}</p>




                        <div class=" col-md-10">
                            <img src="{{\Storage::disk('public')->url('catalog/hall/source/' . $data['image'])}}" style="width:100%; height: 400px;">

                        </div>

                            </div>



                        @if(isset($data['images']))
                            <div class="row ">
                                <h3>Фотогалерея</h3>
                                <div id="carouselExampleIndicators" class="carousel" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach($data['images'] as $key=>$item)

                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="@if($key == 0) active @endif "></li>

                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">

                                        @foreach($data['images'] as $key=>$item)
                                            <div class="carousel-item @if($key == 0) active @endif ">
                                                <img src="{{\Storage::disk('public')->url('catalog/hall/source/' . $item['patch'])}}"  style="width:550px; height: 300px;">
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
                        @endif
                    </div>
                </div>
            </div>
    </div>
@endsection
