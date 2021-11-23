@extends('layouts.admin_layout')

@section('title', 'Создать кинотеатр')

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
                <form action="{{route('hall.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="cinema_id" value="{{$cinema_id}}">
                        <div class="form-group">
                            <label for="name">Номер зала</label>
                            <input type="text" class="form-control" name="number" id="number" placeholder="Номер зала">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание зала</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Схема зала</label>
                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/movie/source/no-img.jpg') }}" alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Верхний банер банер</label>
                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/movie/source/no-img.jpg') }}" alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="banner_img">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Галерея картинка</label>
                            <div class="input-group">
                                @for($i =0; $i < 5; $i++)
                                    <div class="col-md-2"><img
                                            src="{{ Storage::disk('public')->url('catalog/movie/source/no-img.jpg') }}"
                                            alt="" class="img-lg">
                                        <input type="file" class="form-control-file" name="image[{{$i}}]">
                                    </div>

                                @endfor
                            </div>
                        </div>




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
