<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(HallImage::class,'hall_id');
    }



    public function create(array $data): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $banner_img = (isset($data['banner_img'])) ? $data['banner_img'] : null;
        $this->number = $data['number'];
        $this->description = $data['description'];
        if ($main_img != null){ $this->image = $main_img;}
        if ($banner_img != null){ $this->banner_img = $banner_img;}
        $this->url = $data['url'];
        $this->title = $data['title'];
        $this->keywords = $data['keywords'];
        $this->seo_description = $data['seo-description'];
        $this->cinema_id = $data['cinema_id'];


        $object = $this->save();

        return $this->id;
    }

    public function updates(array $data, Hall $hall): int
    {
        if (isset($data['main_img'])) {
            $main_img = $data['main_img'];
        }

        if (isset($data['banner_img'])) {
            $banner_img = $data['banner_img'];
        }

        $hall->number = $data['number'];
        $hall->description = $data['description'];
        if ($main_img != null){ $hall->image = $main_img;}
        if ($banner_img != null){ $hall->banner_img = $banner_img;}
        $hall->url = $data['url'];
        $hall->title = $data['title'];
        $hall->keywords = $data['keywords'];
        $hall->seo_description = $data['seo-description'];



        $object = $hall->update();

        return $hall->id;
    }
    public function getHalls()
    {
        return $this->orderBy('id', 'desc')->limit(10)->get();
    }

    public function searchesHall(string $search)
    {
        return $this->where('name', 'like', '%' . $search . '%')->get();

    }

    public function getHallIds(int $id)
    {


        return $this->with('images')->find($id);
    }

}
