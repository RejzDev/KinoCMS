<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Image;
use App\Models\CinemaImage;
use App\Helpers\ImageSaver;

class CinemaController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cinema = new Cinema();
        $images = new CinemaImage();

        $cinema->getRelationValue('images');
        $cinema->getRelationValue('halls');



        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
            'border_img' => '|mimes:jpeg,jpg,png|max:5000',
            'image[0]' => '|mimes:jpeg,jpg,png|max:5000',
            'url' => 'required|max:100|unique:movies,url|regex:~^[-_a-z0-9]+$~i',
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, null, 'cinema');

        $cinema_id = $cinema->create($data);

        if (!empty($request->file('image'))) {
            $imagesDate['cinema_id'] = $cinema_id;
            foreach ($request->file('image') as $image) {
                $data['images'][] = $this->imageSaver->uploadGalary($request, $image, $cinema, 'cinema');
            }

            $i = 0;
            do {
                $imagesDate['images'][] = $data['images'][$i];
                $imagesDate['position'] = $i;
                $i++;
            } while ($i < count($data['images']));
            $id = $images->creates($imagesDate);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function show(Cinema $cinema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinema $cinema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cinema $cinema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cinema $cinema)
    {
        //
    }
}
