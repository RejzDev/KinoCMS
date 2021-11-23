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
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $banner_img = (isset($data['banner_img'])) ? $data['banner_img'] : null;
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
}
