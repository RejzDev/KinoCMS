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

        <h2 class="text-center">Страници</h2>
        <div class="form-group col-sm-4 text-center">
            <a href="{{route('pages.create')}}"
               class="btn btn-block btn-success">Создать страницу</a>
        </div>

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
                                    <th>
                                        Статус
                                    </th>
                                    <th style="width: 30%">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="hall_{{$main['id']}}">

                                    <td>
                                        Главная страница
                                    </td>
                                    <td>

                                        {{ Carbon\Carbon::parse($main['created_at'])->format('d.m.Y') }}
                                    </td>
                                    <td>

                                        @if($main['status'] == 1)
                                            ВКЛ
                                        @else
                                            ВИКЛ
                                        @endif
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{route('main-page.edit', $main['id'])}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                                @foreach ($page as $item)
                                    <tr id="hall_{{$item['id']}}">

                                        <td>
                                            {{ $item['name'] }}
                                        </td>
                                        <td>

                                            {{ Carbon\Carbon::parse($item['created_at'])->format('d.m.Y') }}
                                        </td>
                                        <td>

                                            @if($item['status'] == 1)
                                                ВКЛ
                                            @else
                                                ВИКЛ
                                                @endif
                                        </td>

                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="{{route('pages.edit', $item['id'])}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>

                                            @if($item['id'] > 5)
                                                <form action="{{route('pages.destroy', $item['id'])}}" method="POST"
                                                      style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                        <i class="fas fa-trash">
                                                        </i>

                                                    </button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                <tr id="hall_{{$contact['id']}}">

                                    <td>
                                        Контакти
                                    </td>
                                    <td>

                                        {{ Carbon\Carbon::parse($contact['created_at'])->format('d.m.Y') }}
                                    </td>
                                    <td>

                                        @if($contact['status'] == 1)
                                            ВКЛ
                                        @else
                                            ВИКЛ
                                        @endif
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{route('contact.edit', $contact['id'])}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div><!-- /.container-fluid -->
            </section>

        </div>

@endsection
