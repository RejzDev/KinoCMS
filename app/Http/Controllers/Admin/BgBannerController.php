<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BgBanner;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;

class BgBannerController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BgBanner  $bgBanner
     * @return \Illuminate\Http\Response
     */
    public function show(BgBanner $bgBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BgBanner  $bgBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(BgBanner $bgBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BgBanner  $bgBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BgBanner $bgBanner)
    {
        $data = $request->all();

        if (isset($data['main_img'])){
            $data['main_img'] = $this->imageSaver->upload($request, $bgBanner, 'banner');
        }



        $bgBanner->updates($data, $bgBanner);

        return redirect(route('banner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BgBanner  $bgBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(BgBanner $bgBanner)
    {
        $bgBanner->deletes($bgBanner);
    }
}
