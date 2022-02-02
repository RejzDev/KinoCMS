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
                <form action="{{route('main-page.update', $page['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group col-md-2 container-fluid">
                            <label class="switch">
                                <input type="checkbox" name="status" @if($page['status'] == 1) checked @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name">@lang('main.phone')</label>
                            <input type="text" class="form-control" name="phone_1" id="phone_1"
                                   placeholder="067 58 10 180" value="{{$page['first_phone']}}">
                            <input type="text" class="form-control" name="phone_2" id="phone_2"
                                   placeholder="067 58 10 180" value="{{$page['second_phone']}}">
                        </div>






                        <div class="form-group">
                            <label for="description">SEO текст</label>
                            <textarea class="form-control" rows="5" name="description" id="description"
                                      placeholder="текст">{{$page['description']}}</textarea>
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
