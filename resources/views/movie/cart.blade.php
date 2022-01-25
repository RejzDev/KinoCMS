@extends('layouts.page')

@section('title', 'Главная')

@section('css')
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('content')


    <div class="container">


        <div class="row text-center col-md-12">


            <p>Расписание сеансов кинотеатра</p>
            <form action="{{route('filter_movie')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">

                    <div class="form-group col-md-6 container-fluid d-flex justify-content-center align-items-center p-0">

                        <select id="cinema_select" class="js-data-example-ajax form-control" name="cinema">
                            <option value="">Виберете кинотеатр</option>
                        </select>


                            <div class="col-md-6 text-right">

                                <label class="checkbox-btn">
                                    <input type="checkbox" value="vse" name="type_movie[]">
                                    <span>Все</span>
                                </label>

                                <label class="checkbox-btn">
                                    <input type="checkbox" name="type_movie[]" value="3D">
                                    <span>3D</span>
                                </label>

                                <label class="checkbox-btn">
                                    <input type="checkbox" name="type_movie[]" value="2D">
                                    <span>2D</span>
                                </label>


                            </div>


                    </div>

                    </div>


                    <div class="row">
                    <div class="form-group col-md-12">
                        @foreach($date['date'] as $item)
                        <label class="checkbox-btn col-md-1">
                            <input type="checkbox" value="{{$item['format']}}" name="date">
                            <span>{{$item['day']}}</span>
                        </label>
                        @endforeach
                    </div>
                    </div>

                <input type="hidden" value="{{$movie['id']}}" name="movie_id">




                    <div class="form-group col-md-2 float-right">
                        <button type="submit" class="btn btn-primary">Показать</button>
                    </div>


            </form>



            <form action="{{route('booking.movie', $movie['id'])}}" method="post" enctype="multipart/form-data">
                @csrf

                @if(isset($result['movies']))
                    <div class="col-md-12">
                        @foreach($result['movies'] as $item)

                            <label class="checkbox-btn col-md-2">
                                <input type="checkbox" name="hall" value="{{$item->hall_id}}">
                                <span>{{$item->time}}  {{$item->type_movie}}
                           <p>Зал {{$item->number}}</p>
                        </span>

                                <input type="hidden" value="{{$movie['id']}}" name="movie_id">
                                <input type="hidden" value="{{$item->price}}" name="price">
                                <input type="hidden" value="{{$item->id}}" name="time_table_id">

                            </label>

                        @endforeach
                    </div>
                @endif

                <div class="row ">
                <div class="form-group col-md-3 container-fluid d-flex justify-content-center align-items-center p-0">
                    <button type="submit"  class="btn btn-block btn-success ">Купить билет</button>
                </div>
                </div>

            </form>




            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">

                        <div class="row">
                            <img src="{{\Storage::disk('public')->url('catalog/movie/source/' . $movie['image'])}}"  style="width:550px; height: 400px;">

                        </div>

                        <div class="row">
                            <table class="table table-dark table-striped text-left">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($movie['genres'] as $item)
                                <tr>
                                    <th>{{$item['name']}}</th>
                                    <td>{{$item['description']}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>



                    </div>

                    <div class="col-md-7 ">

                        <div class="row ">

                            <div class="text-center">
                                <h3>{{$movie['name']}}</h3>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="text-left">
                                <p>{{$movie['description']}}</p>
                            </div>
                        </div>

                        <div class="row ">
                            <h3>Кадри и постери</h3>
                            <div class="col-md-8 container-fluid d-flex justify-content-center align-items-center p-0">


                                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach($movie['images'] as $key=>$item)
                                            <div class="carousel-item @if($key == 0) active @endif ">
                                                <img src="{{\Storage::disk('public')->url('catalog/movie/source/' . $item['patch'])}}"  style="width:550px; height: 300px;">
                                                <div class="carousel-caption">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                        </div>
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




            </script>
@endsection
