@extends('layouts.page')

@section('css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('title', 'Главная')



@section('content')


    <div class="container bg-white">

        <div class="row text-center">


            <div class="col-md-10 bg-ong ">
                <div class="row">
                    <h2 class="text-left">Новости</h2>
                    @foreach($date as $item)

                        <div class="item col-md-3 ">

                            @php

                                if ($item['image']) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url = Storage::disk('public')->url('catalog/news/source/' . $item['image']);
                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/news/source/no-img.jpg');
                                }

                            @endphp
                            <div class="container-fluid ">
                                <img class="group list-group-image img-ong" src="{{ $url }}" alt="" >
                                <div class="caption">
                                    <a href="#">{{$item['name']}}</a>
                                </div>
                                <div class="caption">
                                    <p class="text_cinema text-left">{{$item['dates']}}</p>
                                </div>
                                <div class="caption">
                                    <p class="text_cinema text-left">{{$item['description']}}</p>
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
