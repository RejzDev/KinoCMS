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
                <form action="{{route('hall.update', $hall['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Номер зала</label>
                            <input type="text" class="form-control" name="number" id="number" placeholder="Номер зала" value="{{$hall['number']}}">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание зала</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст">{{$hall['description']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Схема зала</label>
                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/hall/source/' . $hall['image']) }}" alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Верхний банер банер</label>
                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/hall/source/' . $hall['banner_img']) }}" alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="banner_img">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Галерея картинка</label>
                            @php
                                $i =0;
                                if (isset($hall['images'][0]) ){
                                foreach ($hall['images'] as $img){
                                if ($img) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url['img'][$i] = Storage::disk('public')->url('catalog/hall/source/' . $img['patch']);
                                    $url['patch'][$i] = $img['patch'];

                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/hall/source/no-img.jpg');
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

                                        @if(isset($hall['images'][$i]['position']))
                                            <div class="col-md-2">
                                                    <span class="close-image-icon">
                                                    <a href="#" class="close" aria-label="Close"
                                                       onclick="removeImage({{$i}}, 'hall'); return false;">
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
                                                    src="{{ Storage::disk('public')->url('catalog/hall/source/no-img.jpg') }}"
                                                    alt="" class="img-lg">
                                                <input type="file" class="form-control-file" name="image[{{$i}}]">
                                            </div>
                                        @endif
                                    @endfor
                                @else
                                    @for($i =0; $i < 5; $i++)
                                        <div class="col-md-2"><img
                                                src="{{ Storage::disk('public')->url('catalog/hall/source/no-img.jpg') }}"
                                                alt="" class="img-lg">
                                            <input type="file" class="form-control-file" name="image[{{$i}}]">
                                        </div>

                                    @endfor
                                @endif
                            </div>
                        </div>




                        <label for="name">SEO блок:</label>
                        <div class="form-group">
                            <label for="name">URL:</label>
                            <input type="text" class="form-control" name="url" value="{{$hall['url']}}" id="url"
                                   placeholder="url">
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$hall['title']}}" id="title"
                                   placeholder="title">
                        </div>
                        <div class="form-group">
                            <label for="name">Keywords</label>
                            <input type="text" class="form-control" name="keywords" value="{{$hall['keywords']}}"
                                   id="keywords"
                                   placeholder="keywords">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="5" name="seo-description" id="seo-description"
                                      placeholder="description">{{$hall['seo_description']}}</textarea>
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
