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

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
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
                <form action="{{route('cinema.update', $cinema['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('main.nameCinema')</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Название фильма" value="{{$cinema['name']}}">
                        </div>
                        <div class="form-group">
                            <label for="conditions">@lang('main.conditions')</label>
                            <textarea class="form-control" rows="5" name="conditions" id="conditions"
                                      placeholder="текст">{{$cinema['conditions']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('main.description')</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст">{{$cinema['description']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.main_img')</label>
                            <div class="input-group">
                                <img
                                    src="{{ Storage::disk('public')->url('catalog/cinema/source/'. $cinema['logo_img']) }}"
                                    alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.banner_img')</label>
                            <div class="input-group">
                                <img
                                    src="{{ Storage::disk('public')->url('catalog/cinema/source/'. $cinema['background_img']) }}"
                                    alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="baner_img">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.galery_img')</label>
                            @php
                                $i =0;
                                if (isset($cinema['images'][0]) ){
                                foreach ($cinema['images'] as $img){
                                if ($img) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url['img'][$i] = Storage::disk('public')->url('catalog/cinema/source/' . $img['patch']);
                                    $url['patch'][$i] = $img['patch'];

                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/cinema/source/no-img.jpg');
                                }
                                $i++;
                                }
                                } else {
                                    $url['img'] = 0;
                                }
                                 $i =0;
                            @endphp
                            <div class="input-group">
                                @if($url['img'] != 0)
                                    @for($i =0; $i < 5; $i++)

                                        @if(isset($cinema['images'][$i]['position']))
                                            <div class="col-md-2">
                                                    <span class="close-image-icon">
                                                    <a href="#" class="close" aria-label="Close"
                                                       onclick="removeImage({{$i}}, 'cinema'); return false;">
                                                     <span aria-hidden="true" title="Удалить">&times;</span>
                                                    </a>
                                                    </span>
                                                <img src="{{$url['img'][$i]}}" id="img-{{$i}}" alt="" class="img-lg">
                                                <input type="file" class="form-control-file" name="image[{{$i}}]">
                                                <input type="hidden" class="form-control-file" id="image_{{$i}}"
                                                       name="image_{{$i}}"
                                                       value="{{$url['patch'][$i]}}">


                                            </div>
                                        @else
                                            <div class="col-md-2"><img
                                                    src="{{ Storage::disk('public')->url('catalog/cinema/source/no-img.jpg') }}"
                                                    alt="" class="img-lg">
                                                <input type="file" class="form-control-file" name="image[{{$i}}]">
                                            </div>
                                        @endif
                                    @endfor
                                @else
                                    @for($i =0; $i < 5; $i++)
                                        <div class="col-md-2"><img
                                                src="{{ Storage::disk('public')->url('catalog/cinema/source/no-img.jpg') }}"
                                                alt="" class="img-lg">
                                            <input type="file" class="form-control-file" name="image[{{$i}}]">
                                        </div>

                                    @endfor
                                @endif
                            </div>
                        </div>

                        <div class="content-header">
                            <div class="container-fluid">
                                <h1 class="m-0 text-center">Список залов</h1>
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <table class="table table-striped projects">
                                            <thead>
                                            <tr>

                                                <th>
                                                    Название
                                                </th>
                                                <th>
                                                    Дата создания
                                                </th>
                                                <th style="width: 30%">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($cinema->halls as $hall)
                                                <tr id="hall_{{$hall['id']}}">

                                                    <td>
                                                        {{ $hall['number'] }} Зал
                                                    </td>
                                                    <td>

                                                        {{ Carbon\Carbon::parse($hall['created_at'])->format('d.m.Y') }}
                                                    </td>

                                                    <td class="project-actions text-right">
                                                        <a class="btn btn-info btn-sm" href="{{route('hall.edit', $hall['id'])}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a>

                                                        <a href="#" onclick="deletes({{$hall['id']}}); return false;"
                                                           class="btn btn-danger btn-sm delete-btn">
                                                            <i class="fas fa-trash">
                                                            </i>

                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>

                        <div class="form-group col-sm-4 text-center">
                            <a href="{{route('hall.create', ['cinema_id' => $cinema])}}"
                               class="btn btn-block btn-success">Создать зал</a>
                        </div>

                        <label for="name">SEO блок:</label>
                        <div class="form-group">
                            <label for="name">URL:</label>
                            <input type="text" class="form-control" name="url" value="{{$cinema['url']}}" id="url"
                                   placeholder="url">
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$cinema['title']}}" id="title"
                                   placeholder="title">
                        </div>
                        <div class="form-group">
                            <label for="name">Keywords</label>
                            <input type="text" class="form-control" name="keywords" value="{{$cinema['keywords']}}"
                                   id="keywords"
                                   placeholder="keywords">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="5" name="seo-description" id="seo-description"
                                      placeholder="description">{{$cinema['seo_description']}}</textarea>
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
