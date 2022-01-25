@extends('layouts.page')

@section('title', 'Главная')

@section('css')
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/cd792ce23d.js"></script>
@endsection

@section('content')


    <div class="container">


        <div class="row text-center col-md-12">



            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">

                        <div class="row">
                            <img src="{{\Storage::disk('public')->url('catalog/movie/source/' . $movie['image'])}}"  style="width:250px; height: 260px;">

                        </div>

                    </div>

                    <div class="col-md-10 ">

                        <div class="row">
                            <div class="head text-left col-md-4">
                                {{$movie['name']}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-left col-md-4">
                                {{$date}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-left col-md-2">
                                Цена в ГРН: <labal id="price">{{$price}}</labal>
                            </div>

                            <div class="text-left col-md-3">
                                Заброньовано:
                                <label class="checkbox-bt">
                                    <input type="checkbox" disabled  value="" name="gg">
                                    <span>1</span>
                                </label>
                            </div>
                            <div class="text-left col-md-2">

                                Ваш заказ:
                            </div>

                            <div class="text-left col-md-4 border border-dark">
                                Билетов:
                                <label class="red" id="bilet">
                                  0
                                </label>

                                Сума:
                                <label class="red" id="suma">
                                    0
                                </label>
                            </div>
                        </div>

                        <div class="row ">

                            <div class="text-center">
                                <h3>Екран</h3>
                            </div>
                        </div>
                        <form action="{{route('saveBooking')}}" method="post" enctype="multipart/form-data">
                            @csrf

                        <div class="row ">

                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 1</label>
                                @foreach($places['col1'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 1, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 2</label>
                                @foreach($places['col2'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 2, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 3</label>
                                @foreach($places['col3'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 3, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>
                        <div class="row"></div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 4</label>
                                @foreach($places['col4'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 4, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 5</label>
                                @foreach($places['col5'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 5, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 6</label>
                                @foreach($places['col6'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 6, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 7</label>
                                @foreach($places['col7'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" onclick="pl({{$item['id']}}); return false;" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 7, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 8</label>
                                @foreach($places['col8'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox" @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 8, {{$loop->index += 1}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 9</label>
                                @foreach($places['col9'] as $item)

                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox"  @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach value="Ряд 9, {{$loop->index}}, {{$item['id']}}" name="places[]">
                                        <span> {{$loop->index += 1}}</span>
                                    </label>

                                @endforeach

                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12 text-center">
                                <label for="" class="float-left">Ряд 10</label>
                                @foreach($places['col10'] as $item)
                                    <label class="checkbox-bt">
                                        <input id="checkbox_{{$item['id']}}" type="checkbox"  @foreach($booking as $book) @if($book['place_id'] == $item['id']) disabled @endif   @endforeach  value="Ряд 10, {{$loop->index}}, {{$item['id']}}" name="places[]">
                                        <span>{{$loop->index}}</span>
                                    </label>
                                @endforeach

                            </div>


                        </div>
                            <input type="hidden" value="{{$movie['id']}}" name="movie_id">
                            <input type="hidden" value="{{$time_table}}" name="time_table_id">

                            <div class="row">
                                <p>Стоимость услуги бронирования 3грн, за каждое место</p>
                                <p>ЗАБРОНИРОВАНИЕ БИЛЕТИ НУЖНО ВИКУПИТЬ В КАСЕ НЕ ПОЗДНЕЕ ЧЕМ ЗА ПОЛ ЧАСА ДО НАЧАЛА СЕАНСА</p>
                            </div>
                            <div class="row ">



                                @if(isset(Auth::user()->name))
                                <div class="form-group col-md-3 container-fluid d-flex justify-content-center align-items-center p-0">
                                    <button type="submit"  class="btn btn-block btn-success ">Забронировать</button>
                                </div>
                                @else
                                    <div class="form-group col-md-3 container-fluid d-flex justify-content-center align-items-center p-0">
                                       Нужна авторизация
                                    </div>
                                @endif
                            </div>
                        </form>

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


                $('input[type="checkbox"]').on('click', function() {
                    var PCTthis = {{$price}};
                    var prices = parseInt($('#suma').html());
                    var cnt = parseInt($('#bilet').html());
                    console.log(prices);
                    if($(this).prop('checked')) {
                        prices += PCTthis;
                        cnt += 1;
                        $('#suma').html(prices);
                        $('#bilet').html(cnt);
                    } else{
                        prices -= PCTthis;
                        cnt -= 1;
                        console.log(prices);
                        $('#suma').html(prices);
                        $('#bilet').html(cnt);
                    }
                });

                function pl(itemId) {
                    var cnt = parseInt($('#quantity_' + itemId).val());
                    var newCnt = cnt + 1;

                    var itemPrice = parseInt($('#itemPrice_' + itemId).attr('value'));
                    var itemRealPrice = newCnt * itemPrice;
                    var totalPrice = parseInt($('#totalPrice').html());
                    var totalRealPrice = totalPrice + itemPrice;


                    $('#quantity_' + itemId).val(newCnt);
                    $('#itemTotal_' + itemId).html(itemRealPrice);
                    $('#totalPrice').html(totalRealPrice);



                }



            </script>
@endsection
