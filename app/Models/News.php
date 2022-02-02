<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(NewsImage::class,'news_id');
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

    public function updates(array $data, News $news): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $news->name = $data['name'];
        $news->created_at = $data['date'];
        $news->description = $data['description'];
        if ($main_img != null){ $news->image = $main_img;}
        $news->url_video = $data['url-video'];
        $news->url = $data['url'];
        $news->title = $data['title'];
        $news->keywords = $data['keywords'];
        $news->seo_description = $data['seo-description'];
        if (isset($data['status'])){
            $news->status = 1;
        } else{
            $news->status = 0;
        }

        $object = $news->update();

        return $news->id;
    }

    public function getNews()
    {


        return $this->orderBy('created_at', 'desc')->get();
    }
}
