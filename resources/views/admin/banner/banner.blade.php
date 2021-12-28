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

        <h2 class="text-center">На главной верх</h2>

        <section class="content">


            <div class="container-fluid">
                <div class="card">


                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{route('banner.update', $data['banners'][0]['id'])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group col-md-16 container-fluid text-right">

                                        <label class="switch">

                                            <input type="checkbox" name="status" @if($data['banners'][0]['status'] == 1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                <div class="form-group text-left">
                                    <label for="exampleInputFile"></label>
                                    <div class="input-group">

                                            @foreach($data['mainBanners'] as $main)

                                                <div class="col-md-2" id="banner_{{$main['id']}}">
                                                    <span class="close-image-icon">
                                                    <a href="#" class="close" aria-label="Close" onclick="removeBanner({{$main['id']}}); return false;">
                                                     <span aria-hidden="true" title="Удалить">&times;</span>
                                                    </a>
                                                    </span>
                                                    <img
                                                        src="{{ Storage::disk('public')->url('catalog/banner/source/' . $main['image']) }}"
                                                        alt="" class="img-lg">
                                                    <a href="{{route('main-banner.edit', $main['id'])}}" class="btn btn-default">Редактировать</a>
                                                    <br>
                                                    <label for="url">Url</label>
                                                    <p   name="url" id="url">{{$main['url']}}</p>
                                                    <label for="Text">Text</label>
                                                    <p  name="text" id="text" placeholder="text">{{$main['text']}}</p>

                                                </div>

                                            @endforeach

                                    </div>

                                </div>
                                <div class="input-group text-center">
                                    <a href="{{route('main-banner.create')}}" class="btn btn-default">Добавить баннер</a>
                                </div>

                                    <br>

                                    <div class="form-group col-md-2">
                                        <label>Select</label>
                                        <select class="form-control" name="time">
                                            <option value="5" @if($data['banners'][0]['time'] == 5) selected @endif>5с</option>
                                            <option value="10" @if($data['banners'][0]['time'] == 10) selected @endif>10с</option> </select>
                                    </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                    </form>
                    <!-- /.card-body -->
                </div>



            </div><!-- /.container-fluid -->



        </section>

            <h2 class="text-center">На главной верх</h2>

            <section class="content">


                <div class="container-fluid">
                    <div class="card">


                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{route('bg_banner.update', $data['banners'][0]['id'])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="input-group">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio1" checked="">
                                                <label class="form-check-label">Фото на фон</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio1" >
                                                <label class="form-check-label">Просто фон</label>
                                            </div>

                                        </div>
                                        <div class="col-md-2" id="bgBanner_{{$data['bgBanners'][0]['id']}}">
                                            <img
                                                src="{{ Storage::disk('public')->url('catalog/banner/source/' . $data['bgBanners'][0]['image']) }}"
                                                alt=""
                                                class="img-lg">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="file" class="form-control-file" name="main_img">
                                        </div>
                                        <div class="text-right" >
                                             <a href="#" class="btn btn-default" onclick="removeBgBanner({{$data['bgBanners'][0]['id']}}); return false;">Удалить</a>

                                        </div>
                                    </div>


                                    <br>


                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </form>
                                <!-- /.card-body -->
                            </div>



                        </div><!-- /.container-fluid -->



            </section>


            <h2 class="text-center">На главной верх</h2>

            <section class="content">


                <div class="container-fluid">
                    <div class="card">


                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{route('banner.update', $data['banners'][0]['id'])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group col-md-16 container-fluid text-right">

                                        <label class="switch">

                                            <input type="checkbox" name="status" @if($data['newsBanner'][0]['status'] == 1) checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="exampleInputFile"></label>
                                        <div class="input-group">

                                            @foreach($data['newsBanner'] as $news)

                                                <div class="col-md-2" id="banner_{{$news['id']}}">
                                                    <span class="close-image-icon">
                                                    <a href="#" class="close" aria-label="Close" onclick="removeBanner({{$news['id']}}); return false;">
                                                     <span aria-hidden="true" title="Удалить">&times;</span>
                                                    </a>
                                                    </span>
                                                    <img
                                                        src="{{ Storage::disk('public')->url('catalog/banner/source/' . $news['image']) }}"
                                                        alt="" class="img-lg">
                                                    <a href="{{route('main-banner.edit', $news['id'])}}" class="btn btn-default">Редактировать</a>
                                                    <br>
                                                    <label for="url">Url</label>
                                                    <p   name="url" id="url">{{$news['url']}}</p>

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>
                                    <div class="input-group text-center">
                                        <a href="{{route('main-banner.create')}}" class="btn btn-default">Добавить баннер</a>
                                    </div>

                                    <br>

                                    <div class="form-group col-md-2">
                                        <label>Select</label>
                                        <select class="form-control" name="time">
                                            <option value="5" @if($data['newsBanner'][0]['time'] == 5) selected @endif>5с</option>
                                            <option value="10" @if($data['newsBanner'][0]['time'] == 10) selected @endif>10с</option> </select>
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
