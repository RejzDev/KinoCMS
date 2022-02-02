@extends('layouts.page')

@section('css')

    <link rel="stylesheet" href="{{asset('/admin/plugins/select2/css/select2.css?v=11254')}}">
    <link rel="stylesheet" href="{{asset('/admin/plugins/select2-bootstrap4-theme/elect2-bootstrap4.min.css?v=1522')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


@endsection

@section('title', "Страница пользователя")



@section('content')




    <div class="container bg-white">


        <div class="row text-center">
            <form action="{{ route('users.update', $user['id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Имя</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{$user['name']}}"
                                           placeholder="Имя">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Фамилия</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="surname" id="surname"
                                           value="{{$user['surname']}}"
                                           placeholder="Фамилия">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Псевдоним</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nick" id="nick"
                                           value="{{$user['pseudonym']}}"
                                           placeholder="nick">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="card" id="card"
                                           value="{{$user['card']}}"
                                           placeholder="Номер карты">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">E-mail</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email" id="email"
                                           value="{{$user['email']}}"
                                           placeholder="Имя">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Адрес</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address" id="address"
                                           value="{{$user['address']}}"
                                           placeholder="Address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Пароль</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Номер карты</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="card" id="card"
                                           value="{{$user['card']}}"
                                           placeholder="Номер карты">
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name">Язик</label>
                                </div>
                                <div class="col-md-2">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1"
                                               name="customRadio" @if($user['language'] == 1) checked @endif>
                                        <label for="customRadio1" class="custom-control-label">Українська</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2"
                                               name="customRadio" @if($user['language'] == 0) checked @endif>
                                        <label for="customRadio2" class="custom-control-label">Руский</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name">Пол</label>
                                </div>
                                <div class="col-md-2">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio3"
                                               name="customRadio1" @if($user['sex'] == 1) checked="" @endif>
                                        <label for="customRadio3" class="custom-control-label">Мужской</label>
                                    </div>
                                </div>
                                <div class="col-md-2">

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio4"
                                               name="customRadio1" @if($user['sex'] == 0) checked="" @endif>
                                        <label for="customRadio4" class="custom-control-label">Женский</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="name">Телефон</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           value="{{$user['phone']}}"
                                           placeholder="phone">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                <label for="name">Дата рождения</label>
                                </div>
                                <div class="col-md-6">
                                <input type="date" class="form-control" name="date" id="date"
                                       placeholder="Дата рождения"
                                       value="{{ Carbon\Carbon::parse($user['date_birtch'])->format('Y-m-d') }}">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                <label for="name">Город</label>
                                </div>
                                <div class="col-md-6">
                                <input type="text" class="form-control" name="city" id="city" value="{{$user['city']}}"
                                       placeholder="city">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                <label for="name">Повторите пароль</label>
                                </div>
                                <div class="col-md-6">
                                <input type="password" class="form-control" name="password1" id="password1"
                                       placeholder="password">
                            </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>


        </div>
    </div>

@endsection


