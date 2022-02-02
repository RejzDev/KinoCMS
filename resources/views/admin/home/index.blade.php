@extends('layouts.admin_layout')

@section('title', 'Админ Панель')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Админ Панель</h1>
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

                            <p>Зарегистрирование пользователи</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Пользователи <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-5">

                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$countUsers}}</h3>

                            <p>Пользователи онлайн</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                              </div>
                </div>

                <!-- ./col -->
            </div>

            <div class="row">
                <!-- Left col -->

                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">

                    <!-- DONUT CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Donut Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart" style="height:230px; min-height:230px"></canvas>
                        </div>
                        <!-- /.card-body -->
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
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
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


        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
            labels: [
                'Chrome',
                'FireFox',
            ],
            datasets: [
                {
                    data: [{{$browser['Chrome']}}, {{$browser['Firefox']}}],
                    backgroundColor : ['#f56954', '#00a65a'],
                }
            ]
        }
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })





    </script>
@endsection


