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


        <h2 class="text-center">Список кинотеатров</h2>
            <div class="form-group col-sm-4 text-center">
                <a href="{{route('cinema.create')}}"
                   class="btn btn-block btn-success">Создать кинотеатр</a>
            </div>
        <div class="row text-center">
            @foreach($date as $item)
                <div class="col col-lg-3 col-sm-3"><a href="{{ route('cinema.edit', $item['id']) }}">
                        @php
                            if ($item['logo_img']) {
                                // $url = url('storage/catalog/category/image/' . $category->image);
                                $url = Storage::disk('public')->url('catalog/cinema/source/' . $item['logo_img']);
                            } else {
                                // $url = url('storage/catalog/category/image/default.jpg');
                                $url = Storage::disk('public')->url('catalog/cinema/source/no-img.jpg');
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
