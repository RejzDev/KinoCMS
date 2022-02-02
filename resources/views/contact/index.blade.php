
@extends('layouts.page')

@section('css')

    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


@endsection

@section('title', "Контакти")



@section('content')




    <div class="container bg-white">



            <div class="row text-center">




                <div class="col-md-10">

                        @foreach($data as $item)
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="text-left">{{$item['name']}}</h3>

                            </div>
                            <div class="col-md-2">
                                <img src="{{\Storage::disk('public')->url('catalog/contact/source/' . $item['image'])}}"  style="width:100px; height: 100px;">

                            </div>

                            <div class="col-md-4">
                                <p class="text-left">{{$item['description']}}</p>
                            </div>



                    </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{\Storage::disk('public')->url('catalog/contact/source/' . $item['image'])}}"  style="width:300px; height: 300px;">

                                </div>
                                <div class="col-md-4">
                                    <div id="map{{$item['id']}}" class="map" style="height: 300px;
            width: 400px;"></div>
                                </div>
                            </div>
                @endforeach
            </div>



                <div class="col-md-2">
                    <div class="col-md-2 lin">
                        <p>РЕКЛАМА</p>
                    </div>


                </div>





        </div>
</div>

@endsection

@section('js')



<script>

    function initMap() {

        @foreach($data as $item)
        var element = document.getElementById('map{{$item['id']}}');
        var options = {
            zoom: 15,
            center: {lat: {{$item['cord'][0]}}, lng: {{$item['cord'][1]}}},
        };

        var myMap = new google.maps.Map(element, options);

        var markers = [
            {
                coordinates: {lat: {{$item['cord'][0]}}, lng: {{$item['cord'][1]}}},
            },
        ];

        for (var i = 0; i < markers.length; i++) {
            addMarker(markers[i]);
        }

        function addMarker(properties) {
            var marker = new google.maps.Marker({
                position: properties.coordinates,
                map: myMap
            });

            if (properties.image) {
                marker.setIcon(properties.image);
            }

        }



        @endforeach
    }

    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA5CFcT6kjbGH1bUaQ5nkJSd3s6Fr715g&callback=initMap">
    </script>

@endsection
