<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HallImage;
use App\Helpers\ImageSaver;

class HallController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $cinema_id =  $request->cinema_id;
        return view('admin.hall.create',['cinema_id' => $cinema_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hall = new Hall();
        $images = new HallImage();

        $hall->getRelationValue('images');




        $this->validate($request, [
            'number' => 'required|numeric|unique:halls',
            'description' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
            'banner_img' => '|mimes:jpeg,jpg,png|max:5000',
            'image[0]' => '|mimes:jpeg,jpg,png|max:5000',
            'url' => 'required|max:100|unique:halls,url|regex:~^[-_a-z0-9]+$~i',
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();


        $data['main_img'] = $this->imageSaver->upload($request, null, 'hall');
        $data['banner_img'] = $this->imageSaver->upload($request, null, 'hall');

        $hall_id = $hall->create($data);

        if (!empty($request->file('image'))) {
            $imagesDate['cinema_id'] = $hall_id;
            foreach ($request->file('image') as $image) {
                $data['images'][] = $this->imageSaver->uploadGalary($request, $image, $hall, 'cinema');
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
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $images = new HallImage();
        $hall->delete();

        $this->imageSaver->remove(, 'hall');

      $images->deletes($hall->patch);
      $this->imageSaver->removeGalery($hall, 'hall');



    }
}
