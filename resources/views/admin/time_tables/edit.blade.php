@extends('layouts.admin_layout')

@section('title', 'Создать расписание')

@section('css')

    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">


@endsection

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="card card-primary">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- /.card-header -->
                <!-- form start -->

                    <form action="{{ route('time-tables.update', $timeTable['id']) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Виберете фильм</label>

                            <select id='sel_emp' name="movie" class="country_select form-control">
                                <option value='0'>Виберете фильм</option>
                                @foreach($movies as $movie)
                                    <option value='{{$movie['id']}}' @if($movie['id'] == $timeTable['movie_id']) selected @endif>{{$movie['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Виберете зал</label>

                            <select id='sel_emps' name="hall" class="country_select form-control">
                                <option value='0'>Виберете зал</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="conditions">Время</label>
                            <input type="time" id="appt" name="time">
                        </div>
                        <div class="form-group">
                            <label>Дата:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Цена</label>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Цена">

                        </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->


        </div>
    </div>

@endsection

@section('js')
    <script src="/admin/plugins/select2/js/select2.js"></script>
    <script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Script -->
    <script type="text/javascript">


        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM-DD-YYYY'
            }
        })

        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){

            $( "#sel_emp" ).select2({

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

        });


        $(document).ready(function(){
            console.log(1);

            $( "#sel_emps" ).select2({

                ajax: {
                    url: "{{route('hall.searches')}}",
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

        });





    </script>



@endsection
