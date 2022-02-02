
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


            <div class="row text-center">




                <div class="col-md-10 bg-ong">
                    <h2 class="text-left">{{$data['name']}}</h2>
                    <img class="float-left" src="{{\Storage::disk('public')->url('catalog/action/source/' . $data['image'])}}"  style="width:550px; height: 300px;">
                    <div class="row">
                        <p class="text-left">{{$data['description']}}</p>

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
