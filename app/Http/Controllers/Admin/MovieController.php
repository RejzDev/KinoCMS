<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Movie;
    use Illuminate\Http\Request;
    use App\Helpers\ImageSaver;
    use App\Models\Image;
    use App\Models\Genre;

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
            $date['ong'] = $movies->getOngoingMovies();
            $date['soon'] = $movies->getSoonMovies();


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

            $movies->getRelationValue('images');

            $data = $request->all();


                $data['url-trailer'] = explode('=', $data['url-trailer']);
            if (count($data['url-trailer']) > 1)
            {
                $data['url-trailer'] = 'https://www.youtube.com/embed/' . $data['url-trailer'][1];
            }



            $this->validate($request, [
                'name' => 'required|max:100',
                'description' => 'required',
                'main_img' => '|mimes:jpeg,jpg,png|max:5000',
                'image[0]' => 'mimes:jpeg,jpg,png|max:5000',
                'url-trailer' => 'max:300|',
                'type_movie' => 'required',
                'url' => 'required|max:100|unique:movies,url|regex:~^[-_a-z0-9]+$~i',
                'title' => 'required|max:100',
                'keywords' => 'required',
                'seo-description' => 'required',
            ]);




            $data['ch'] = implode(',', $request->input('type_movie'));


            $data['main_img'] = $this->imageSaver->upload($request, null, 'movie');

            $movie = $movies->create($data);

            if (!empty($request->file('image'))) {
                $imagesDate['movie_id'] = $movie;
                foreach ($request->file('image') as $image) {
                    $data['images'][] = $this->imageSaver->uploadGalary($request, $image, $movies, 'movie');
                }

                $i = 0;
                do {
                    $imagesDate['images'][] = $data['images'][$i];
                    $imagesDate['position'] = $i;
                    $i++;
                } while ($i < count($data['images']));
                $id = $images->creates($imagesDate);

            }

            if (isset($data['name-pole'])){
                $genre = new Genre();
                $genres = array();
                $count = 0;
                for ($i = 0; $i < count($data['name-pole']); $i++){
                    array_push($genres, array(
                        'name' => $data['name-pole'][$i],
                        'description' => $data['genre'][$i],
                        'movie_id' => $movie,
                    ));

                }

               $genre->create($movie);

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
            $movie->getRelationValue('images');
            $movie->getRelationValue('genres');


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
            $movie->getRelationValue('images');



            if (!empty($request->file('image'))) {
                for ($i = 0; $i < 5; $i++) {
                    if (isset($request->image[$i])) {
                        $img_pos[] = $i + 1;
                        $request['img_pos'] = $img_pos;
                    }
                }

            }
            //Валидация
            $this->validate($request, ['name' => 'required|max:100',
                'description' => 'required',
                'main_img' => '|mimes:jpeg,jpg,png|max:5000',
                'image[0]' => 'mimes:jpeg,jpg,png|max:5000',
                'url-trailer' => 'max:300|',
                'type_movie' => 'required',
                'url' => 'required|max:100|regex:~^[-_a-z0-9]+$~i|unique:movies,url,' . $movie['id'],
                'title' => 'required|max:100',
                'keywords' => 'required',
                'seo-description' => 'required',]);


            $data = $request->all();




            if ($movie['url_trailer'] != $data['url-trailer'])
            {
                $data['url-trailer'] = explode('=', $data['url-trailer']);
                $data['url-trailer'] = 'https://www.youtube.com/embed/' . $data['url-trailer'][1];
            }


            $data['ch'] = implode(',', $request->input('type_movie'));


            $data['main_img'] = $this->imageSaver->upload($request, $movie, 'movie');

            $movies = $movie->updates($data, $movie);

            if (!empty($request->file('image'))) {
                $imagesDate['movie_id'] = $movie->id;
                $i=0;

                foreach ($request->file('image') as $image) {
                    if (!empty($movie->images[$i]['patch'])) {
                        $imagesDate['newPatch'] = $this->imageSaver->uploadGalary($request, $image, $movie, 'movie');

                        $imagesDate['oldPatch'] = $movie->images[$i]['patch'];
                        $images->updates($imagesDate, $data['img_pos']);
                    } else {
                        $imagesDate['images'][] = $this->imageSaver->uploadGalary($request, $image, $movie, 'movie');
                    }
                    $i++;
                }

            }

            if (!empty($request->file('newImage'))) {
                $imagesDate['movie_id'] = $movie->id;
                $i=0;

                foreach ($request->file('newImage') as $image) {

                        $imagesDate['images'][$i] = $this->imageSaver->uploadGalary($request, $image, $movie, 'movie');
                    $i++;
                }

                    $images->creates($imagesDate);

            }



            if (isset($data['name-pole'])){


                $genre = new Genre();
                $genresSave = array();
                $genresUp = array();
                $count = 0;
                for ($i = 0; $i < count($data['name-pole']); $i++){
                    if (is_null($data['genre_id'][$i])){
                        array_push($genresSave, array(
                            'name' => $data['name-pole'][$i],
                            'description' => $data['genre'][$i],
                            'movie_id' => $movie->id,
                        ));
                    } else{
                        array_push($genresUp, array(
                            'name' => $data['name-pole'][$i],
                            'description' => $data['genre'][$i],
                            'id' => $data['genre_id'][$i],
                        ));
                    }

                }

                $genre->create($genresSave);
                $genre->updates($genresUp);

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
        function destroy(Request $request, Movie $movie)
        {
            return 'succsess';
        }
    }
