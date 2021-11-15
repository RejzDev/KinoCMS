<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviseController extends Controller
{

    public function index()
    {
        $movies = new Movie();
        var_dump($movies->getOngoingMovies());
    }

   //Передавати $request
    public function create()
    {
       /* $new_movie = new Movie();
        $new_movie->name = 'Spider';
        $new_movie->description = 'Spider vzxcsfsdf';
        $new_movie->url_trailer = 'admin/221';
        $new_movie->type_movie = '3d';
        $new_movie->url = 'zxc/.cld';
        $new_movie->title = 'Spider Man';
        $new_movie->keywords = 'Spider, keywords';
        $new_movie->seo_description = 'seo_description';
        $new_movie->save();*/

       $movie = new Movie();
       $movie->createMovie();

       // return View

    }




}
