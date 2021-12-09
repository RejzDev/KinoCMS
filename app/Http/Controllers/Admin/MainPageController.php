<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainPage;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainPage = new MainPage();
        $mainPage->getMainPage();

        return view('admin.page.main_page_index', ['mainPage' => $mainPage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.main_page_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $mainPage = new MainPage();



        $this->validate($request, [
            'phone_1' => 'required|max:10',
            'phone_2' => 'required|max:10',
            'description' => 'required',
            'url-trailer' => 'max:300|',
            'url' => 'required|max:100|unique:main_pages,url|regex:~^[-_a-z0-9]+$~i',
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();


        $mainPage->create($data);

        return redirect(route('pages.index'))->withSuccess('Главная страница была успешно добавлена!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function show(MainPage $mainPage)
    {




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function edit(MainPage $mainPage)
    {
        return view('admin.page.main_page_edit', ['page' => $mainPage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainPage $mainPage)
    {
        $this->validate($request, [
            'phone_1' => 'required|max:10',
            'phone_2' => 'required|max:10',
            'description' => 'required',
            'url-trailer' => 'max:300|',
            'url' => 'required|max:100|regex:~^[-_a-z0-9]+$~i|unique:main_pages,url,' . $mainPage['id'],
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();


        $mainPage->updates($data, $mainPage);

        return redirect(route('pages.index'))->withSuccess('Главная страница была успешно обновлена!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainPage  $mainPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainPage $mainPage)
    {


    }

}
