<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Models\PageImage;
use App\Models\MainPage;
use App\Models\Contact;

class PageController extends Controller
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
        $news = new Page();
        $date = $news->getPage();

        $mainPage = new MainPage();
        $main = $mainPage->getMainPage();

        $contacts = new Contact();
        $contact = $contacts->getContact();

        //dd(\Request::ip());

        return view('admin.page.index', ['page' => $date,
            'main' => $main,
            'contact' => $contact]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $images = new PageImage();

        $page->getRelationValue('images');




        $this->validate($request, [
            'name' => 'required|max:100',
            'date' => 'required|max:100',
            'description' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
            'image[0]' => '|mimes:jpeg,jpg,png|max:5000',
            'url' => 'required|max:100|unique:pages,url|regex:~^[-_a-z0-9]+$~i',
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, null, 'page');

        $page_id = $page->create($data);

        if (!empty($request->file('image'))) {
            $imagesDate['page_id'] = $page_id;
            foreach ($request->file('image') as $image) {
                $data['images'][] = $this->imageSaver->uploadGalary($request, $image, $page, 'page');
            }

            $i = 0;
            do {
                $imagesDate['images'][] = $data['images'][$i];
                $imagesDate['position'] = $i;
                $i++;
            } while ($i < count($data['images']));
            $id = $images->creates($imagesDate);
        }
        return redirect(route('pages.index'))->withSuccess('Страница была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $page->getRelationValue('images');

        return view('admin.page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $images = new PageImage();

        $page->getRelationValue('images');

        if (!empty($request->file('image'))) {
            for ($i = 0; $i < 5; $i++) {
                if (isset($request->image[$i])) {
                    $img_pos[] = $i + 1;
                    $request['img_pos'] = $img_pos;
                }
            }

        }


        $this->validate($request, [
            'name' => 'required|max:100',
            'date' => 'required|max:100',
            'description' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
            'image[0]' => '|mimes:jpeg,jpg,png|max:5000',
            'url' => 'required|max:100|regex:~^[-_a-z0-9]+$~i|unique:pages,url,' . $page['id'],
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, $page, 'news');

        $page_id = $page->updates($data, $page);



        if (!empty($request->file('image'))) {
            $imagesDate['page_id'] = $page->id;
            $i=0;

            foreach ($request->file('image') as $image) {
                if (!empty($news->images[$i]['patch'])) {
                    $imagesDate['newPatch'] = $this->imageSaver->uploadGalary($request, $image, $page, 'page');

                    $imagesDate['oldPatch'] = $page->images[$i]['patch'];
                    $images->updates($imagesDate);
                } else {
                    $imagesDate['images'][] = $this->imageSaver->uploadGalary($request, $image, $page, 'page');
                }
                $i++;
            }
            if (isset($imagesDate['images'])) {
                $images->creates($imagesDate);
            }

        }
        return redirect(route('pages.index'))->withSuccess('Страница была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->getRelationValue('images');


        $page->delete();

        $this->imageSaver->delete($page->image, 'page');

        foreach ($page->images as $img){
            $this->imageSaver->removeGalery($img, 'page');
        }


        return redirect(route('pages.index'))->withSuccess('Страница была успешно удалена!');
    }
}
