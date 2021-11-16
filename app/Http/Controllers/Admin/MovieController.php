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
         *Вивід фільмів
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $movies = new Movie();
            $date = $movies->getOngoingMovies();


            return view('admin.movie.index', ['date' => $date]);
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
         * Сохранение фильма
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $movies = new Movie();
            $images = new Image();
            //$movie->createMovie($request);


            $this->validate($request, [
                'name' => 'required|max:100',
                'description' => 'required',
                'image-1' => '|mimes:jpeg,jpg,png|max:5000',
                'image-2' => 'mimes:jpeg,jpg,png|max:5000',
                'image-3' => 'mimes:jpeg,jpg,png|max:5000',
                'image-4' => 'mimes:jpeg,jpg,png|max:5000',
                'image-5' => 'mimes:jpeg,jpg,png|max:5000',
                'image-6' => 'mimes:jpeg,jpg,png|max:5000',
                'url-trailer' => 'max:300|',
                'type_movie' => 'required',
                'url' => 'required|max:100|unique:movies,url|regex:~^[-_a-z0-9]+$~i',
                'title' => 'required|max:100',
                'keywords' => 'required',
                'seo-description' => 'required',
            ]);
            /*
             * Проверка пройдена, создаем категорию
             */

            $file = $request->file('image-1');


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
                ->route('movies.index');

        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public function show(Movie $movie)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *Сторінка редагування
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public function edit(Movie $movie)
        {
            $date = explode(',', $movie['type_movie']);
            foreach ($date as $type) {
                if ($type == '3D') {
                    $movie['3D'] = $type;
                } elseif ($type == '2D') {
                    $movie['2D'] = $type;
                } else {
                    $movie['IMAX'] = $type;
                }
            }


            return view('admin.movie.edit', ['movie' => $movie]);
        }

        /**
         * Update the specified resource in storage.
         *Оновлення даних фільму
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Movie $movie
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Movie $movie)
        {

            $images = new Image();

            //Валидация
            $this->validate($request, [
                'name' => 'required|max:100',
                'description' => 'required',
                'image-1' => 'mimes:jpeg,jpg,png|max:5000',
                'image-2' => 'mimes:jpeg,jpg,png|max:5000',
                'image-3' => 'mimes:jpeg,jpg,png|max:5000',
                'image-4' => 'mimes:jpeg,jpg,png|max:5000',
                'image-5' => 'mimes:jpeg,jpg,png|max:5000',
                'image-6' => 'mimes:jpeg,jpg,png|max:5000',
                'url-trailer' => 'max:300|',
                'type_movie' => 'required',
                'url' => 'required|max:100|regex:~^[-_a-z0-9]+$~i|unique:movies,url,'. $movie['id'],
                'title' => 'required|max:100',
                'keywords' => 'required',
                'seo-description' => 'required',
            ]);
            /*
             * Проверка пройдена, создаем категорию
             */

            $file = $request->file('image-1');


            $data = $request->all();

            $data['ch'] = implode(',', $request->input('type_movie'));

            $data['images'] = $this->imageSaver->upload($request, $movie, 'movie');

            $movies = $movie->updates($data,$movie);

            if ($request->file('image-2')) {
                $imagesDate['movie_id'] = $movie;
                for ($i = 1; $i < count($data['images']); $i++) {

                    $imagesDate['images'] = $data['images'][$i]['name'];
                    $imagesDate['position'] = $i;
                    $image = $images->create($imagesDate);

                }
            }


            return redirect()
                ->route('movies.index');
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
