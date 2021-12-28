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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <h2 class="text-center">SMS</h2>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <form action="{{route('mail.upload')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">


                                <div class="form-group">
                                    <label for="description">Введіть назву шаблона</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$movie['name']}}"
                                           placeholder="Название шаблона">
                                </div>

                            <div class="form-group">
                                <label for="description">Введіть HTML код письма</label>
                                <textarea class="form-control"  rows="10" name="content" id="content"
                                          placeholder="текст"></textarea>
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
