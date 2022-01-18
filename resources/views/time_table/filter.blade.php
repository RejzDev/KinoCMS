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

            <h2 class="text-center">Расписание</h2>
            <form action="{{route('filter')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-check">

                <div class="col-md-4 text-left">
                    <input type="checkbox" name="type_movie[]" value="3D" class="form-check-input" id="3D">
                    <label class="form-check-label" for="3D">3D</label>
                    <input type="checkbox" name="type_movie[]" value="2D" class="form-check-input" id="2D">
                    <label class="form-check-label" for="2D">IMAX</label>
                    <input type="checkbox" name="type_movie[]" value="IMAX" class="form-check-input"
                           id="IMAX">
                    <label class="form-check-label" for="IMAX">VIP</label>

                </div>
                <div class="form-group">

                    <select class="form-control col-md-2" name="movie">
                        <option>Виберете фильм</option>
                        @foreach($data['movie'] as $item)
                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="date" class="form-control col-md-2" name="date">

                <div class="card-footer col-md-4">
                    <button type="submit" class="btn btn-primary">Показать</button>
                </div>

            </div>

            </form>
            <div class="col-md-10">
                <div class="row">

                    <div class="card">


                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm ">
                                <thead>
                                <tr>
                                    <th>Время</th>
                                    <th>Фильм</th>
                                    <th>Зал</th>
                                    <th>Цена</th>
                                    <th>Бронировать</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data['movies'] as $item)
                                <tr class="text-left">
                                    <td>{{$item->date}} {{$item->time}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        {{$item->number}}
                                    </td>
                                    <td>{{$item->price}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>


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
