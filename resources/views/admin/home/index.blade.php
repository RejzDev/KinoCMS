@extends('layouts.admin_layout')

@section('title', 'Главная')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">

                    <canvas id="myChart" width="100" height="50"></canvas>


                </div>

                <div class="col-lg-3 col-5">

                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{count($user)}}</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
            </div>

            <div class="row">
                <!-- Left col -->

                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">

                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Visitors
                            </h3>
                            <!-- card tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white">Visitors</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white">Online</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white">Sales</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->






                    <!-- /.card -->
                </section>

                <section class="col-lg-7 connectedSortable">


                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Пол</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pie-chart" width="800" height="450"></canvas>   </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- right col -->

                    <!-- /.card -->
                </section>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>



    <script>

        var date = new Date();

        var day1 = date.toLocaleDateString();
        var day2 = get(day1);
        var day3 = get(day2);

        console.log(day2)

        new Chart(document.getElementById("myChart"), {
            type: 'line',
            data: {
                labels:[day3, day2, day1],
                datasets: [{
                    label: 'Сеансы',
                    data: [{{$data['line'][2]}}, {{$data['line'][1]}}, {{$data['line'][0]}}],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        stacked: true
                    }
                }
            }
        });


        function get(data)
        {
            data = data.split('.');
            data = new Date(data[2], +data[1]-1, +data[0], -168, 0, 0, 0);
            data = [data.getDate(),data.getMonth()+1,data.getFullYear()];
            data = data.join('.').replace(/(^|\/)(\d)(?=\/)/g,"$10$2");
            return data
        }

    </script>

    <script>
        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
                labels: ["Женский", "Мужской"],
                datasets: [{
                    label: "100% от общего числа сеансов",
                    backgroundColor: ["#3e95cd", "#8e5ea2"],
                    data: [{{$data['pie']['women']}},{{$data['pie']['man']}}]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: '100% от общего числа сеансов'
                }
            }
        });








    </script>
@endsection


