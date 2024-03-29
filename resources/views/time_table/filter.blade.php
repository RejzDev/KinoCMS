@extends('layouts.page')

@section('css')

    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

@endsection

@section('title', 'Главная')



@section('content')


    <div class="container bg-white">

        <div class="row text-center">

            <h2 class="text-center">Расписание</h2>
            <form action="{{route('filter')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="form-check">



                <div class="form-group">
                    <div class="row">

                        <div class="col-md-3 text-left">
                            <input type="checkbox" name="type_movie[]" value="3D" class="form-check-input" id="3D">
                            <label class="form-check-label" for="3D">3D</label>
                            <input type="checkbox" name="type_movie[]" value="2D" class="form-check-input" id="2D">
                            <label class="form-check-label" for="2D">IMAX</label>
                            <input type="checkbox" name="type_movie[]" value="IMAX" class="form-check-input"
                                   id="IMAX">
                            <label class="form-check-label" for="IMAX">VIP</label>

                        </div>

                        <div class="form-group col-md-2">
                            <select id="cinema_select" class="js-data-example-ajax form-control" name="cinema">
                                <option value="">Виберете кинотеатр</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <input type="date" class="form-control" name="date">
                        </div>

                        <div  class="form-group col-md-2">
                            <select id="movies_select" class="js-data-example-ajax form-control" name="movie">
                                <option value="">Виберете фильм</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select id="halls_select" class="js-data-example-ajax form-control" name="hall">
                                <option value="">Виберете зал</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary">Показать</button>
                        </div>

                    </div>

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
@section('js')
    <script src="/admin/plugins/select2/js/select2.js"></script>
    <!-- Script -->
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            console.log(1);

            $( "#sel_emp" ).select2();


        });


        $('#cinema_select').select2({
            ajax: {
                url: "{{route('cinema.searches')}}",
                type: "post",
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response,

                    };

                },
                cache: true

            }
        });

        $('#movies_select').select2({
            ajax: {
                url: "{{route('movie.searches')}}",
                type: "post",
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response,

                    };

                },
                cache: true

            }
        });

        $('#halls_select').select2({
            ajax: {
                url: "{{route('halls.searches')}}",
                type: "post",
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response,

                    };

                },
                cache: true

            }
        });


    </script>



@endsection
