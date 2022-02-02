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
                <form action="{{ route('movies.update', $movie['id']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('main.nameFilm')</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$movie['name']}}"
                                   placeholder="Название фильма">
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('main.description')</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст">{{$movie['description']}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.main_img')</label>


                            <div class="input-group">
                                <img src="{{ Storage::disk('public')->url('catalog/movie/source/' . $movie['image']) }}"
                                     alt=""
                                     class="img-lg">
                                <input type="file" class="form-control-file" name="main_img">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">@lang('main.galery_img')</label>
                            @php
                                $i =0;
                                if (isset($movie['images'][0]) ){
                                foreach ($movie['images'] as $img){
                                if ($img) {
                                    // $url = url('storage/catalog/category/image/' . $category->image);
                                    $url['img'][$i] = Storage::disk('public')->url('catalog/movie/source/' . $img['patch']);
                                    $url['patch'][$i] = $img['patch'];

                                } else {
                                    // $url = url('storage/catalog/category/image/default.jpg');
                                    $url = Storage::disk('public')->url('catalog/movie/source/no-img.jpg');
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

                                        @if(isset($movie['images'][$i]['position']))
                                            <div class="col-md-2">
                                                    <span class="close-image-icon">
                                                    <a href="#" class="close" aria-label="Close"
                                                       onclick="removeImage({{$i}}, 'movie'); return false;">
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
                                                    src="{{ Storage::disk('public')->url('catalog/movie/source/no-img.jpg') }}"
                                                    alt="" class="img-lg">
                                                <input type="file" class="form-control-file" name="newImage[{{$i}}]">
                                            </div>
                                        @endif
                                    @endfor
                                @else
                                    @for($i =0; $i < 5; $i++)
                                        <div class="col-md-2"><img
                                                src="{{ Storage::disk('public')->url('catalog/movie/source/no-img.jpg') }}"
                                                alt="" class="img-lg">
                                            <input type="file" class="form-control-file" name="newImage[{{$i}}]">
                                        </div>

                                    @endfor
                                @endif


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('main.trailer')</label>
                            <input type="text" class="form-control" name="url-trailer" id="url-trailer"
                                   placeholder="Сылка на видео Ютуб" value="{{$movie['url_trailer']}}">
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('main.type_movie')</label>
                            <div class="form-check">

                                <input type="checkbox" name="type_movie[]" value="3D" @if(isset($movie['3D']))checked
                                       @endif class="form-check-input"
                                       id="3D">
                                <label class="form-check-label" for="3D">3D</label>
                                <input type="checkbox" name="type_movie[]" value="2D" @if(isset($movie['2D']))checked
                                       @endif class="form-check-input"
                                       id="2D">
                                <label class="form-check-label" for="2D">2D</label>
                                <input type="checkbox" name="type_movie[]" value="IMAX"
                                       @if(isset($movie['IMAX']))checked @endif class="form-check-input"
                                       id="IMAX">
                                <label class="form-check-label" for="IMAX">IMAX</label>


                            </div>
                        </div>

                         <label for="genre">@lang('main.small_desc')</label>

                     @foreach($movie['genres'] as $item)
                         <p><label for="var1"> Поле: </label>
                             <input type="hidden" value="{{$item['id']}}" name="genre_id[]" id="genreId{{$item['id']}}">
                             <input type="text" value="{{$item['name']}}" name="name-pole[]" id="name-pole{{$item['id']}}">
                             <input type="text" value="{{$item['description']}}" name="genre[]" id="genre{{$item['id']}}">
                             <a href="#" onclick="deletesGenre({{$item['id']}}); return false;"
                                class="btn btn-danger btn-sm delete-btn">
                                 <i class="fas fa-trash">
                                 </i>

                             </a>
                         </p>
                         @endforeach

                         <p><span id="addVar"> @lang('main.small_desc_btn') </span> </p>


                         <label for="name">SEO блок:</label>
                        <div class="form-group">
                            <label for="name">URL:</label>
                            <input type="text" class="form-control" name="url" value="{{$movie['url']}}" id="url"
                                   placeholder="url">
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$movie['title']}}" id="title"
                                   placeholder="title">
                        </div>
                        <div class="form-group">
                            <label for="name">Keywords</label>
                            <input type="text" class="form-control" name="keywords" value="{{$movie['keywords']}}"
                                   id="keywords"
                                   placeholder="keywords">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="5" name="seo-description" id="seo-description"
                                      placeholder="description">{{$movie['seo_description']}}</textarea>
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

                    + '<input type="hidden"  name="genre_id[]" id="genre_id'+varCount+'">'
                    + '<input type="text"  name="name-pole[]" id="name-pole'+varCount+'">'
                    + '<input type="text"  name="genre[]" id="genre'+varCount+'">'

                    + '<span class = "remove"> Удалить </span> </p>';

                // Новый элемент формы добавляется перед кнопкой "новая"

                $(this).parent().before($node);

            });



            // Удалить нажатие кнопки

            $('form').on('click', '.removeVar', function(){

                $(this).parent().remove();

                //varCount--;

            });

        });


        function deletesGenre(id){

            var genre = document.getElementById("genreId"+id);
            var name = document.getElementById("name-pole"+id);
            var genre = document.getElementById("genre"+id);
            genre.remove();
            $.ajax({
                url: "/genre/"+id,
                type: "DELETE",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : 'json',
                success: (data) => {
                    console.log(data)

                },
                error: (data) => {
                    console.log(data)
                }
            });
        }

    </script>
@endsection
