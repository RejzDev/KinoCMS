@extends('layouts.admin_layout')

@section('title', 'Главная')

@section('content')


        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.295288104745!2d28.40934431587912!3d49.23289048221793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf9b11a1e38ec9104!2zNDnCsDEzJzU4LjQiTiAyOMKwMjQnNDEuNSJF!5e0!3m2!1suk!2sua!4v1643738102536!5m2!1suk!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


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
                <form action="{{ route('user.update', $user['id']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <div class="card-body">

                         <div class="row">
                         <div class="form-group col-md-6">

                             <div class="col-md-6">
                                 <label for="name">Имя</label>
                                 <input type="text" class="form-control" name="name" id="name" value="{{$user['name']}}"
                                        placeholder="Имя">
                             </div>
                             <div class="col-md-6">
                                 <label for="name">Фамилия</label>
                                 <input type="text" class="form-control" name="surname" id="surname" value="{{$user['surname']}}"
                                        placeholder="Фамилия">
                             </div>
                             <div class="col-md-6">
                                 <label for="name">Псевдоним</label>
                                 <input type="text" class="form-control" name="nick" id="nick" value="{{$user['pseudonym']}}"
                                        placeholder="nick">
                             </div>
                             <div class="col-md-6">
                                 <label for="name">E-mail</label>
                                 <input type="text" class="form-control" name="email" id="email" value="{{$user['email']}}"
                                        placeholder="Имя">
                             </div>

                             <div class="col-md-6">
                                 <label for="name">Адрес</label>
                                 <input type="text" class="form-control" name="address" id="address" value="{{$user['address']}}"
                                        placeholder="Address">
                             </div>
                             <div class="col-md-6">
                                 <label for="name">Пароль</label>
                                 <input type="password" class="form-control" name="password" id="password"
                                        placeholder="password">
                             </div>

                             <div class="col-md-6">
                                 <label for="name">Номер карты</label>
                                 <input type="text" class="form-control" name="card" id="card" value="{{$user['card']}}"
                                        placeholder="Номер карты">
                             </div>

                         </div>
                             <div class="form-group col-md-6">

                                 <div class="col-md-6">
                                     <label for="name">Язик</label>
                                         <div class="custom-control custom-radio">
                                             <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio"  @if($user['language'] == 1) checked @endif>
                                             <label for="customRadio1" class="custom-control-label">Українська</label>
                                         </div>
                                         <div class="custom-control custom-radio">
                                             <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" @if($user['language'] == 0) checked @endif>
                                             <label for="customRadio2" class="custom-control-label">Руский</label>
                                         </div>

                                 </div>
                                 <div class="col-md-6">
                                     <label for="name">Пол</label>
                                     <div class="custom-control custom-radio">
                                         <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio1" @if($user['sex'] == 1) checked="" @endif>
                                         <label for="customRadio3" class="custom-control-label">Мужской</label>
                                     </div>
                                     <div class="custom-control custom-radio">
                                         <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio1"  @if($user['sex'] == 0) checked="" @endif>
                                         <label for="customRadio4" class="custom-control-label">Женский</label>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <label for="name">Телефон</label>
                                     <input type="text" class="form-control" name="phone" id="phone" value="{{$user['phone']}}"
                                            placeholder="phone">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="name">Дата рождения</label>
                                     <input type="date" class="form-control" name="date" id="date"  placeholder="Дата рождения" value="{{ Carbon\Carbon::parse($user['date_birtch'])->format('Y-m-d') }}">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="name">Город</label>
                                     <input type="text" class="form-control" name="city" id="city" value="{{$user['city']}}"
                                            placeholder="city">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="name">Повторите пароль</label>
                                     <input type="password" class="form-control" name="password1" id="password1"
                                            placeholder="password">
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
            <!-- /.card -->


        </div>
    </div>

@endsection
