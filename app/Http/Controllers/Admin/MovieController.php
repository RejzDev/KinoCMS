<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Movie;
    use Illuminate\Http\Request;
    use App\Helpers\ImageSaver;
    use App\Models\Image;

    class MovieController extends Controller
    {

        private $imageSaver;

        public function __construct(ImageSaver $imageSaver)
        {
            $this->imageSaver = $imageSaver;
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $movies = new Movie();
            var_dump($movies->getOngoingMovies());
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('admin.movie.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $movies = new Movie();
            $images = new Image();
            // $movie->createMovie($request);

            $this->validate($request, [
                'parent_id' => 'integer',
                'image-1' => 'mimes:jpeg,jpg,png|max:5000',
                'image-2' => 'mimes:jpeg,jpg,png|max:5000',
                'image-3' => 'mimes:jpeg,jpg,png|max:5000',
                'image-4' => 'mimes:jpeg,jpg,png|max:5000',
                'image-5' => 'mimes:jpeg,jpg,png|max:5000',
                'image-6' => 'mimes:jpeg,jpg,png|max:5000'
            ]);
            /*
             * Проверка пройдена, создаем категорию
             */

            $file = $request->file('image');


            $data = $request->all();

            $data['ch'] = implode(',', $request->input('type_movie'));


            $data['images'] = $this->imageSaver->upload($request, null, 'movie');

            $movie = $movies->create($data);

            $imagesDate['movie_id'] = $movie;
            for ($i = 1; $i < count($data['images']); $i++) {

                $imagesDate['images'] = $data['images'][$i]['name'];
                $imagesDate['position'] = $i;
                $image = $images->create($imagesDate);

            }


            return redirect()
                ->route('movies.create');

        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public
        function show(Movie $movie)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public
        function edit(Movie $movie)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public
        function update(Request $request, Movie $movie)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public
        function destroy(Movie $movie)
        {
            //
        }
    }
