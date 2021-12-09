<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(PageImage::class,'page_id');
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

    public function updates(array $data, Page $page): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $page->name = $data['name'];
        $page->created_at = $data['date'];
        $page->description = $data['description'];
        if ($main_img != null){ $page->image = $main_img;}
        $page->url_video = $data['url-video'];
        $page->url = $data['url'];
        $page->title = $data['title'];
        $page->keywords = $data['keywords'];
        $page->seo_description = $data['seo-description'];

        $object = $page->update();

        return $page->id;
    }

    public function getPage()
    {


        return $this->orderBy('id', 'asc')->get();
    }
}
