@extends('layouts.page')

@section('title', 'Главная')

@section('content')


    <div class="container">


        <div class="row text-center col-md-12">

            <div class="col-md-2">
                <div class="col-md-2 lin">
                    <a href="{{route('ongoing.home')}}" class="btn btn-standart {{request()->is('ongoing-movies*') ? 'btn-buy' : null}}">Авиша</a>
                </div>

                <div class="col-md-2 lin">
                    <a href="{{route('soon.home')}}" class="btn btn-standart {{request()->is('soon-movies*') ? 'btn-buy' : null}} ">Скоро</a>
                </div>
            </div>

            <div class="col-md-10 bg-ong ">
                <div class="row">


                    @foreach($date['data'] as $item)

                        <div class="item col-md-3">
                            <p>{{$item['title']}}</p>
                            @php
                                if ($item['movies']['image']) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url = Storage::disk('public')->url('catalog/movie/source/' . $item['movies']['image']);
                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/movie/source/no-img.jpg');
                                }
                            @endphp
                            <div class="thumbnail">
                                <img class="group list-group-image img-ong" src="{{ $url }}" alt="" class="img-fluid">
                                <div class="caption">
                                    <h4 class="group inner list-group-item-heading">{{$item['movies']['name']}}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <a class="btn btn-success" href="{{route('page.movie', $item['id'])}}>Купить</a>
                                    </div>
                                </div>
                            </div>


                        </div>

                    @endforeach

                </div>
            </div>


        </div>
    </div>
    </div>
@endsection
