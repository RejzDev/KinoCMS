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
                    <div class="row float-right">

                        <div class="col-md-2 text-right">
                            <a href="{{route('locale', 'ru')}}" class="@if(session('locale') == 'ru') active @endif btn btn-light">Руский</a>
                        </div>
                        <div class="col-md-2 text-left">
                            <a href="{{route('locale', 'ua')}}" class="@if(session('locale') == 'ua') active @endif btn  btn-light">Українська</a>
                        </div>

                    </div>

                <form action="{{route('movies.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('main.nameFilm')</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Название фильма">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('main.description')</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.main_img')</label>


                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/movie/source/no-img.jpg') }}" alt="" class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.galery_img')</label>
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
                        <div class="form-group">
                            <label for="name">@lang('main.trailer')</label>
                            <input type="text" class="form-control" name="url-trailer" id="url-trailer"
                                   placeholder="Сылка на видео Ютуб">
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('main.type_movie')</label>
                            <div class="form-check">

                                <input type="checkbox" name="type_movie[]" value="3D" class="form-check-input" id="3D">
                                <label class="form-check-label" for="3D">3D</label>
                                <input type="checkbox" name="type_movie[]" value="2D" class="form-check-input" id="2D">
                                <label class="form-check-label" for="2D">2D</label>
                                <input type="checkbox" name="type_movie[]" value="IMAX" class="form-check-input"
                                       id="IMAX">
                                <label class="form-check-label" for="IMAX">IMAX</label>

                            </div>
                        </div>


                        <label for="genre">@lang('main.small_desc')</label>

                            <p><span id="addVar"> @lang('main.small_desc_btn') </span> </p>



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

@section('js')
    <script>


        // Количество начальных параметров

        var varCount = 0;



        $(function () {

            // Новое нажатие кнопки

            $('#addVar').on('click', function(){

                varCount++;

                $node = '<p><label for="var'+varCount+'"> Поле'+varCount+': </label>'

                    + '<input type="text"  name="name-pole[]" id="name-pole'+varCount+'">'
                    + '<input type="text"  name="genre[]" id="genre'+varCount+'">'

                    + '<span class = "removeVar"> Удалить </span> </p>';

                // Новый элемент формы добавляется перед кнопкой "новая"

                $(this).parent().before($node);

            });



            // Удалить нажатие кнопки

            $('form').on('click', '.removeVar', function(){

                $(this).parent().remove();

                //varCount--;

            });

        });


    </script>
@endsection
