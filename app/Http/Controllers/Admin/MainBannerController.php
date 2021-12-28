<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainBanner;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;

class MainBannerController extends Controller
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
        return view('admin.banner.create_main-banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new MainBanner();


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, null, 'banner');


        $banner->create($data);

        return redirect(route('banner.index'))->withSuccess('Баннер был успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainBanner  $mainBanner
     * @return \Illuminate\Http\Response
     */
    public function show(MainBanner $mainBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainBanner  $mainBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(MainBanner $mainBanner)
    {
        return view('admin.banner.edit_main-banner', ['banner' => $mainBanner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainBanner  $mainBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainBanner $mainBanner)
    {



        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, $mainBanner, 'banner');


        $mainBanner->updates($data, $mainBanner);

        return redirect(route('banner.index'))->withSuccess('Баннер был успешно j,yjdkmjy!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainBanner  $mainBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainBanner $mainBanner)
    {
        $mainBanner->delete();
    }
}
