<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Models\NewsImage;
use App\Models\CinemaImage;

class NewsController extends Controller
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
        $news = new News();
        $date = $news->getNews();


        return view('admin.news.index', ['news' => $date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new News();
        $images = new NewsImage();

        $news->getRelationValue('images');




        $this->validate($request, [
            'name' => 'required|max:100',
            'date' => 'required|max:100',
            'description' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
            'image[0]' => '|mimes:jpeg,jpg,png|max:5000',
            'url' => 'required|max:100|unique:news,url|regex:~^[-_a-z0-9]+$~i',
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, null, 'news');

        $news_id = $news->create($data);

        if (!empty($request->file('image'))) {
            $imagesDate['news_id'] = $news_id;
            foreach ($request->file('image') as $image) {
                $data['images'][] = $this->imageSaver->uploadGalary($request, $image, $news, 'news');
            }

            $i = 0;
            do {
                $imagesDate['images'][] = $data['images'][$i];
                $imagesDate['position'] = $i;
                $i++;
            } while ($i < count($data['images']));
            $id = $images->creates($imagesDate);
        }
        return redirect(route('news.index'))->withSuccess('Новость была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $news->getRelationValue('images');

        return view('admin.news.edit', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {

        $images = new NewsImage();

        $news->getRelationValue('images');

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
            'url' => 'required|max:100|regex:~^[-_a-z0-9]+$~i|unique:news,url,' . $news['id'],
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, $news, 'news');

        $news_id = $news->updates($data, $news);



        if (!empty($request->file('image'))) {
            $imagesDate['news_id'] = $news->id;
            $i=0;

            foreach ($request->file('image') as $image) {
                if (!empty($news->images[$i]['patch'])) {
                    $imagesDate['newPatch'] = $this->imageSaver->uploadGalary($request, $image, $news, 'news');

                    $imagesDate['oldPatch'] = $news->images[$i]['patch'];
                    $images->updates($imagesDate);
                } else {
                    $imagesDate['images'][] = $this->imageSaver->uploadGalary($request, $image, $news, 'news');
                }
                $i++;
            }

        }

        if (!empty($request->file('newImage'))) {
            $imagesDate['news_id'] = $news->id;
            $i=0;

            foreach ($request->file('newImage') as $image) {

                $imagesDate['images'][$i] = $this->imageSaver->uploadGalary($request, $image, $news, 'news');
                $i++;
            }

            $images->creates($imagesDate);

        }
        return redirect(route('news.index'))->withSuccess('Новость была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->getRelationValue('images');
        $images = new NewsImage();

        $news->delete();

        $this->imageSaver->delete($news->image, 'news');

        foreach ($news->images as $img){
            $this->imageSaver->removeGalery($img, 'news');
        }


        return redirect(route('news.index'))->withSuccess('Новость была успешно удалена!');
    }

    /**
     * Видалення зображень
     * @param Request $request
     */
    public function removeImage(Request $request)
    {

        $images = new NewsImage();
        if (isset($request->patch)){
            $images->deletes($request->patch);
            $this->imageSaver->removeGalery($request, $request->dir);

        }



    }
}
