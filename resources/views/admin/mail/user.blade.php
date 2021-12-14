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

        <h2 class="text-center">Пользователи</h2>


        <section class="content">
            <form action="{{route('saveUser')}}" method="post" enctype="multipart/form-data">
                @csrf
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">

                    </th>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        Дата регестрации
                    </th>
                    <th scope="col">
                        День рождения
                    </th>
                    <th scope="col">
                        Email
                    </th>
                    <th scope="col">
                        Телефон
                    </th>
                    <th scope="col">
                        ФИО
                    </th>
                    <th scope="col">
                        Псевдоним
                    </th>
                    <th scope="col">
                        Город
                    </th>


                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td> <input type="checkbox" name="User[]" value="{{$user->id}}" id="exampleCheck1">
                        </td>
                        <td>{{$user->id}}</td>
                        <td> {{ Carbon\Carbon::parse($user['created_at'])->format('d.m.Y') }}
                        </td>
                        <td> {{ Carbon\Carbon::parse($user['date_birth'])->format('d.m.Y') }}
                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->name}} {{$user->surname}}</td>
                        <td>{{$user->pseudonym}}</td>
                        <td>{{$user->city}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
</form>

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
