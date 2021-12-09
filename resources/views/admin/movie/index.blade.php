@extends('layouts.admin_layout')

@section('title', 'Главная')

@section('content')

    <div class="container">
        <h2 class="text-center">Список текущих фильмов</h2>
        <div class="form-group col-sm-4 text-center">
            <a href="{{route('movies.create')}}"
               class="btn btn-block btn-success">Создать фильм</a>
        </div>
        <div class="row text-center">
            @foreach($date as $item)
                <div class="col col-lg-3 col-sm-3"><a href="{{ route('movies.edit', $item['id']) }}">
                        @php
                            if ($item['image']) {
                                // $url = url('storage/catalog/category/image/' . $category->image);
                                $url = Storage::disk('public')->url('catalog/movie/source/' . $item['image']);
                            } else {
                                // $url = url('storage/catalog/category/image/default.jpg');
                                $url = Storage::disk('public')->url('catalog/movie/source/no-img.jpg');
                            }
                        @endphp

                        <img src="{{ $url }}" alt="" class="img-fluid">
                        <p>{{$item['name']}}</p>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
