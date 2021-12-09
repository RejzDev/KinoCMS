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
                <!-- form start -->
                <form action="{{ route('pages.update', $page['id']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <div class="card-body">
                        <div class="form-group">

                            <div class="col-md-6">
                            <label for="name">Название страници</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$page['name']}}"
                                   placeholder="Название страници">
                            </div>
                            <div class="col-md-6">
                                <label for="name">Дата публикации</label>
                                <input type="date" class="form-control" name="date" id="date"  placeholder="Дата публикации" value="{{ Carbon\Carbon::parse($page['created_at'])->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст">{{$page['description']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Главная картинка</label>


                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/page/source/' . $page['image']) }}"
                                     alt=""
                                     class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Галерея картинка</label>
                            @php
                                $i =0;
                                if (isset($page['images'][0]) ){
                                foreach ($page['images'] as $img){
                                if ($img) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url['img'][$i] = Storage::disk('public')->url('catalog/page/source/' . $img['patch']);
                                    $url['patch'][$i] = $img['patch'];

                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/page/source/no-img.jpg');
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

                                        @if(isset($page['images'][$i]['position']))
                                            <div class="col-md-2">
                                                    <span class="close-image-icon">
                                                    <a href="#" class="close" aria-label="Close" onclick="removeImage({{$i}}, 'page'); return false;">
                                                     <span aria-hidden="true" title="Удалить">&times;</span>
                                                    </a>
                                                    </span>
                                                <img src="{{$url['img'][$i]}}" id="img-{{$i}}" alt="" class="img-lg">
                                                <input type="file" class="form-control-file"  name="image[{{$i}}]">
                                                <input type="hidden" class="form-control-file" id="image_{{$i}}" name="image_{{$i}}"
                                                       value="{{$url['patch'][$i]}}">


                                            </div>
                                        @else
                                            <div class="col-md-2"><img
                                                    src="{{ Storage::disk('public')->url('catalog/page/source/no-img.jpg') }}"
                                                    alt="" class="img-lg">
                                                <input type="file" class="form-control-file" name="image[{{$i}}]">
                                            </div>
                                        @endif
                                    @endfor
                                    @else
                                    @for($i =0; $i < 5; $i++)
                                            <div class="col-md-2"><img
                                                    src="{{ Storage::disk('public')->url('catalog/page/source/no-img.jpg') }}"
                                                    alt="" class="img-lg">
                                                <input type="file" class="form-control-file" name="image[{{$i}}]">
                                            </div>

                                    @endfor
                                @endif


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Сылка на видео:</label>
                            <input type="text" class="form-control" name="url-video" id="url-video"
                                   placeholder="Сылка на видео" value="{{$page['url_video']}}">
                        </div>

                        </div>
                        <label for="name">SEO блок:</label>
                        <div class="form-group">
                            <label for="name">URL:</label>
                            <input type="text" class="form-control" name="url" value="{{$page['url']}}" id="url"
                                   placeholder="url">
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$page['title']}}" id="title"
                                   placeholder="title">
                        </div>
                        <div class="form-group">
                            <label for="name">Keywords</label>
                            <input type="text" class="form-control" name="keywords" value="{{$page['keywords']}}"
                                   id="keywords"
                                   placeholder="keywords">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="5" name="seo-description" id="seo-description"
                                      placeholder="description">{{$page['seo_description']}}</textarea>
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
