
@extends('layouts.page')

@section('css')

    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

@endsection

@section('title', $data['title'])



@section('content')




    <div class="container bg-white">


            <div class=" col-md-12">
                <img src="{{\Storage::disk('public')->url('catalog/page/source/' . $data['image'])}}" style="width:100%; height: 400px;">

            </div>
            <div class="row text-center">




                <div class="col-md-10">
                    <h2 class="text-center">{{$data['name']}}</h2>
                    <div class="row">
                        <p class="text-left">{{$data['description']}}</p>


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
                                                <img src="{{\Storage::disk('public')->url('catalog/page/source/' . $item['patch'])}}"  style="width:550px; height: 300px;">
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

                    <div class="col-md-2">
                        <div class="col-md-2 lin">
                            <p>РЕКЛАМА</p>
                        </div>


                    </div>




                </div>
            </div>
    </div>
@endsection
