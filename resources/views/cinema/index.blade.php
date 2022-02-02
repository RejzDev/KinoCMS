@extends('layouts.page')

@section('css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('title', 'Главная')



@section('content')


    <div class="container bg-white">


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
                                    <a href="{{route('page.cinema', $item['id'])}}" class="group inner list-group-item-heading">{{$item['name']}}</a>
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
