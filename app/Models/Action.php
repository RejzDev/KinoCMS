<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(ActionImage::class,'action_id');
    }


    public function create(array $data): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $this->name = $data['name'];
        $this->created_at = $data['date'];
        $this->description = $data['description'];
        if ($main_img != null){ $this->image = $main_img;}
        $this->url_video = $data['url-video'];
        $this->url = $data['url'];
        $this->title = $data['title'];
        $this->keywords = $data['keywords'];
        $this->seo_description = $data['seo-description'];
        $this->status = 1;



        $object = $this->save();

        return $this->id;
    }

    public function updates(array $data, Action $action): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $action->name = $data['name'];
        $action->created_at = $data['date'];
        $action->description = $data['description'];
        if ($main_img != null){ $action->image = $main_img;}
        $action->url_video = $data['url-video'];
        $action->url = $data['url'];
        $action->title = $data['title'];
        $action->keywords = $data['keywords'];
        $action->seo_description = $data['seo-description'];

        $object = $action->update();

        return $action->id;
    }

    public function getAction()
    {


        return $this->orderBy('created_at', 'desc')->get();
    }

    public function getActionIds(int $id)
    {
        return $this->find($id);
    }
}
