
@section('hall')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-center">Список залов</h1>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
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
                        <th style="width: 30%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cinema->halls as $hall)
                        <tr>

                            <td>
                                {{ $hall['number'] }} Зал
                            </td>
                            <td>

                            </td>
                            <td>

                                {{ Carbon\Carbon::parse($hall['created_at'])->format('d.m.Y') }}
                            </td>

                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('hall.edit', $hall['id']) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <form action="{{route('hall.destroy', $hall['id'])}}" method="POST"
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
            </div>
            <!-- /.card-body -->
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
