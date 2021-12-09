@extends('layouts.admin_layout')

@section('title', 'Главная')

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

                <div class="container rounded border border-dark contact">

                    <div class="form-group col-md-4">
                        <label for="name">Название кинотеатра:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Название кинотеатра">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" rows="5" name="description" id="description"
                                  placeholder="текст"></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">Кординаты для карты:</label>
                        <input type="text" class="form-control" name="cord" id="cord" placeholder="Кординаты для карты">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Лого</label>
                        <div class="input-group">
                            <div class="col-md-2">
                                <img src="{{ Storage::disk('public')->url('catalog/action/source/no-img.jpg') }}" alt=""
                                    class="img-lg">
                            </div>
                            <div class="col-md-2">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-default">Удалить</button>

                            </div>
                        </div>
                    </div>

                </div>

                    <div class="container contact text-center col-md-2">

                            <a href="{{route('contact-cinema.create')}}"
                               class="btn btn-block btn-success">Добавить еще кинотеатр</a>

                    </div>


                <!-- form start -->
                <form action="{{route('contact.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <label for="name">SEO блок:</label>
                        <div class="form-group">
                            <label for="name">URL:</label>
                            <input type="text" class="form-control" name="url" id="url" placeholder="url">
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="title">
                        </div>
                        <div class="form-group">
                            <label for="name">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords"
                                   placeholder="keywords">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="5" name="seo-description" id="seo-description"
                                      placeholder="description"></textarea>
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
