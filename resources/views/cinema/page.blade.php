@extends('layouts.page')

@section('title', 'Главная')

@section('css')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

@endsection

@section('content')


    <div class="container">

        <div class=" col-md-12">
            <img src="{{\Storage::disk('public')->url('catalog/cinema/source/' . $data['background_img'])}}" style="width:100%; height: 400px;">

        </div>
        <div class="row text-center col-md-12">

            <div class="col-md-2">
                <p>Реклама</p>

                <p>Количество залов {{count($data['halls'])}}</p>
                <div class="row">
                    @foreach($data['halls'] as $item)
                            <span class="border border-dark">Зал {{$item['number']}}</span>
                    @endforeach
                </div>


                <div class="row">
                    <p>Смотрите сегодня</p>
                    @foreach($timeTable as $item)
                        <span class="border border-dark">{{$item['movies']['name']}}</span>
                    @endforeach
                </div>
                <a href="{{route('time-table.home')}}" class="btn btn-success">Расписание всех сеансов</a>
            </div>

            <div class="col-md-10 ">
                <div class="row">
                    <div class="col-md-3">
                         <h3 class="text-left">{{$data['name']}}</h3>

                    </div>
                    <div class="col-md-2">
                           <img src="{{\Storage::disk('public')->url('catalog/cinema/source/' . $data['logo_img'])}}"  style="width:100px; height: 100px;">

                    </div>

                    <div class="col-md-4">
                        <div class="col">
                        <a href="{{route('time-table.home')}}" class="btn btn-success">Расписание сеансов</a>
                        </div>
                        <div class="row bg-ong">
                            <div class="back-3D col-md-2">3D</div>
                            <div class="back-vip col-md-2">VIP</div>
                        </div>
                    </div>

                </div>
                <div class="col-md-10">
                    <div class="row">
                        <p class="text-left">{{$data['description']}}</p>



                            <div class="row ">
                                <h3>Условия</h3>

                                <div class="bg-ong">
                                    <div class="row ">
                                    @foreach($page as $item)
                                    <div class="col-md-6">
                                    <a href="{{route('page.page', $item['id'])}}">{{$item['name']}}</a>
                                    <p class="text_cinema text-left">{{$item['description']}}</p>
                                    </div>
                                    @endforeach
                                </div>
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
                                                <img src="{{\Storage::disk('public')->url('catalog/cinema/source/' . $item['patch'])}}"  style="width:550px; height: 300px;">
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
