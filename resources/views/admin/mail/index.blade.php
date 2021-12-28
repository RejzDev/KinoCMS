@extends('layouts.admin_layout')

@section('title', 'Главная')

@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
            </div>
        @endif

        <h2 class="text-center">SMS</h2>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <form action="{{route('send')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Вибрать пользователей кому слать</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="allUser" id="exampleCheck1">
                                    <label class="form-check-label"  for="exampleCheck1">Вибрать всех</label>

                                    <input type="checkbox" class="form-check-input" name="User" id="exampleCheck1">
                                    <label class="form-check-label"  for="exampleCheck1">Виборочно</label>

                                </div>

                                <div class="text-right">
                                    <a href="{{route('mail.users')}}"
                                       class="btn btn-block btn-default col-sm-4 ">Вибрать</a>
                                </div>


                            </div>

                            <div class="form-group">
                                <label for="description">Текст</label>
                                <textarea class="form-control col-md-6" cols="50" rows="10" name="content" id="content"
                                          placeholder="текст"></textarea>
                            </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="card">
                    <form action="{{route('mail.sendMail')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Вибрать пользователей кому слать</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="allUser" id="exampleCheck2">
                                    <label class="form-check-label"  for="exampleCheck2">Вибрать всех</label>

                                    <input type="checkbox" class="form-check-input" name="User" id="exampleCheck2">
                                    <label class="form-check-label"  for="exampleCheck2">Виборочно</label>

                                </div>

                                <div class="text-right">
                                    <a href="{{route('mail.users')}}"
                                       class="btn btn-block btn-default col-sm-4 ">Вибрать</a>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="text">
                                    <label class="form-check-label"  for="html-text">Загрузить HTML-письмо</label>

                                    <a  href="{{route('mail.html')}}"
                                       class="btn btn-default col-sm-4">Вибрать</a>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                @foreach($views as $view)
                                <div class="text" id="mail_{{$view['id']}}">
                                    <input type="checkbox" class="form-check-input" name="mail_view" value="{{$view['id']}}" id="exampleCheck2">

                                    <label class="form-check-label"  for="html-text">{{$view['name']}}</label>


                                    <a href="#" onclick="deleteMail({{$view['id']}}); return false;" class="btn btn_style delete-btn">
                                                удалить

                                        </a>

                                </div>
                                @endforeach
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->

        </section>

    </div>

@endsection
