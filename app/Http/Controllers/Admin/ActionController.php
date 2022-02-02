<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Http\Request;
use App\Models\ActionImage;
use App\Helpers\ImageSaver;
use App\Models\NewsImage;

class ActionController extends Controller
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
        $action = new Action();
        $date = $action->getAction();


        return view('admin.action.index', ['action' => $date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.action.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = new Action();
        $images = new ActionImage();

        $action->getRelationValue('images');




        $this->validate($request, [
            'name' => 'required|max:100',
            'date' => 'required|max:100',
            'description' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
            'image[0]' => '|mimes:jpeg,jpg,png|max:5000',
            'url' => 'required|max:100|unique:actions,url|regex:~^[-_a-z0-9]+$~i',
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, null, 'action');

        $action_id = $action->create($data);

        if (!empty($request->file('image'))) {
            $imagesDate['action_id'] = $action_id;
            foreach ($request->file('image') as $image) {
                $data['images'][] = $this->imageSaver->uploadGalary($request, $image, $action, 'action');
            }

            $i = 0;
            do {
                $imagesDate['images'][] = $data['images'][$i];
                $imagesDate['position'] = $i;
                $i++;
            } while ($i < count($data['images']));
            $id = $images->creates($imagesDate);
        }
        return redirect(route('action.index'))->withSuccess('Акция была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
    {
        $action->getRelationValue('images');

        return view('admin.action.edit', ['action' => $action]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        $images = new ActionImage();

        $action->getRelationValue('images');

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
            'url' => 'required|max:100|regex:~^[-_a-z0-9]+$~i|unique:actions,url,' . $action['id'],
            'title' => 'required|max:100',
            'keywords' => 'required',
            'seo-description' => 'required',
        ]);


        $data = $request->all();

        $data['main_img'] = $this->imageSaver->upload($request, $action, 'action');

        $action_id = $action->updates($data, $action);



        if (!empty($request->file('image'))) {
            $imagesDate['action_id'] = $action->id;
            $i=0;

            foreach ($request->file('image') as $image) {
                if (!empty($news->images[$i]['patch'])) {
                    $imagesDate['newPatch'] = $this->imageSaver->uploadGalary($request, $image, $action, 'action');

                    $imagesDate['oldPatch'] = $news->images[$i]['patch'];
                    $images->updates($imagesDate);
                } else {
                    $imagesDate['images'][] = $this->imageSaver->uploadGalary($request, $image, $action, 'action');
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
        return redirect(route('action.index'))->withSuccess('Акция была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Action $action)
    {
        $action->getRelationValue('images');
        $images = new ActionImage();

        $action->delete();

        $this->imageSaver->delete($action->image, 'action');

        foreach ($action->images as $img){
            $this->imageSaver->removeGalery($img, 'action');
        }


        return redirect(route('action.index'))->withSuccess('Новость была успешно удалена!');
    }

    /**
     * Видалення зображень
     * @param Request $request
     */
    public function removeImage(Request $request)
    {

        $images = new ActionImage();
        if (isset($request->patch)){
            $images->deletes($request->patch);
            $this->imageSaver->removeGalery($request, $request->dir);

        }



    }
}
