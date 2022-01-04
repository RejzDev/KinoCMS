<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ImageSaver;

class NewsBannerController extends Controller
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
    public function create()
    {
        return view('admin.banner.create_news-banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new NewsBanner();


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, null, 'banner');


        $banner->creates($data);

        return redirect(route('banner.index'))->withSuccess('Баннер был успешно добавлен!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsBanner  $newsBanner
     * @return \Illuminate\Http\Response
     */
    public function show(NewsBanner $newsBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsBanner  $newsBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsBanner $newsBanner)
    {
        return view('admin.banner.edit_news-banner', ['banner' => $newsBanner]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsBanner  $newsBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsBanner $newsBanner)
    {

        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, $newsBanner, 'banner');


        $newsBanner->updates($data, $newsBanner);

        return redirect(route('banner.index'))->withSuccess('Баннер был успешно j,yjdkmjy!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsBanner  $newsBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsBanner $newsBanner)
    {
        $newsBanner->delete();
    }
}
