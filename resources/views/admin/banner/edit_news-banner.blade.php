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


        <section class="content">


            <div class="container-fluid">
                <div class="card">

                    <form action="{{route('news-banner.update', $banner['id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Баннер</label>
                                <div class="input-group">
                                    <div class="col-md-2">
                                        <img
                                            src="{{ Storage::disk('public')->url('catalog/banner/source/' . $banner['image']) }}"
                                            alt=""
                                            class="img-lg">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="file" class="form-control-file" name="main_img">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group col-sm-8">
                                    <label for="url">Url</label>
                                    <input type="text" class="form-control" name="url" id="url" placeholder="Url"
                                           value="{{$banner['url']}}">

                                </div>
                            </div>

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
