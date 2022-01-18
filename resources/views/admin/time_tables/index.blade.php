@extends('layouts.admin_layout')


@section('title', 'Главная')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection


@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
            </div>
        @endif

            <div class="form-group col-sm-4 text-center">
                <a href="{{route('time-tables.create')}}"
                   class="btn btn-block btn-success">Создать расписание</a>
            </div>

        <h2 class="text-center">Расписанние</h2>


        <section class="content">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">
                       Фильм
                    </th>
                    <th scope="col">
                        Дата и время
                    </th>
                    <th scope="col">
                        Зал
                    </th>
                    <th scope="col">
                        Цена грн.
                    </th>
                    <th scope="col">
                    </th>

                </tr>
                </thead>
                <tbody>

                @foreach($data as $item)
                    <tr>
                        <td>{{$item->movies->name}}</td>
                        <td>{{$item->date}} {{$item->time}}</td>
                        <td>Зал {{$item->halls->number}}</td>
                        <td>{{$item->price}}</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{route('time-tables.edit', $item['id'])}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>

                            <form action="{{route('time-tables.destroy', $item['id'])}}" method="POST"
                                  style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                    <i class="fas fa-trash">
                                    </i>

                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>




        </section>

    </div>

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#example').DataTable();
    </script>
@endsection
