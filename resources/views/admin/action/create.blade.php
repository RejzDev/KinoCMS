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
                    <div class="row float-right">

                        <div class="col-md-2 text-right">
                            <a href="{{route('locale', 'ru')}}" class="@if(session('locale') == 'ru') active @endif btn btn-light">Руский</a>
                        </div>
                        <div class="col-md-2 text-left">
                            <a href="{{route('locale', 'ua')}}" class="@if(session('locale') == 'ua') active @endif btn  btn-light">Українська</a>
                        </div>

                    </div>
                <!-- form start -->
                <form action="{{route('action.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('main.nameAction')</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Название новости">
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('main.date_pub')</label>
                            <input type="date" class="form-control" name="date" id="date" placeholder="Дата публикации">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('main.description')</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.main_img')</label>



                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/action/source/no-img.jpg') }}" alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.galery_img')</label>

                            <div class="input-group">
                                @for($i =0; $i < 5; $i++)
                                    <div class="col-md-2"><img
                                            src="{{ Storage::disk('public')->url('catalog/action/source/no-img.jpg') }}"
                                            alt="" class="img-lg">
                                        <input type="file" class="form-control-file" name="image[{{$i}}]">
                                    </div>

                                @endfor
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Сылка на видео:</label>
                            <input type="text" class="form-control" name="url-video" id="url-video"
                                   placeholder="Сылка на видео Ютуб">
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
