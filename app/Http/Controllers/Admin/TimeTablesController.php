<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\TimeTable;
    use Illuminate\Http\Request;
    use App\Models\Movie;
    use App\Models\Cinema;
    use App\Models\Hall;

    class TimeTablesController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $model = new Movie();

            $result = $model->getLastMovies();



              return view('admin.time_tables.create',['movies' => $result]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $model = new TimeTable();

            $data = $request->all();

            $model->create($data);
        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\TimeTable $timeTable
         * @return \Illuminate\Http\Response
         */
        public function show(TimeTable $timeTable)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\TimeTable $timeTable
         * @return \Illuminate\Http\Response
         */
        public function edit(TimeTable $timeTable)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\TimeTable $timeTable
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, TimeTable $timeTable)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\TimeTable $timeTable
         * @return \Illuminate\Http\Response
         */
        public function destroy(TimeTable $timeTable)
        {
            //
        }


        public function moviesSearches(Request $request)
        {

            $model = new Movie();

            $search = $request->search;


            if (is_null($search)){
                $result = $model->getLastMovies();
            }else{
                $result = $model->searches($search);
            }


            foreach ($result as $item) {
                $data[] =array(
                    "id"=>$item['id'],
                    "text"=>$item['name']
                );

            }

            $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];

           return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);



        }

        public function hallsSearches(Request $request)
        {

            $model = new Cinema();

            $search = $request->search;


            if (is_null($search)){
                $result = $model->getLastHalls();
            }else{
                $result = $model->searches($search);
            }


            foreach ($result as $item) {

                foreach ($item['halls'] as $hall) {
                    $data[] = array(
                        "id" => $hall['id'],
                        "text" => $item['name'] . ' (' . $hall['number'] . ' Зал)'
                    );
                }
            }

            $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];

            return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);



        }

    }
