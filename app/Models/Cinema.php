<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(Image::class,'key_img');
    }

    public function halls()
    {
        return $this->hasMany(Image::class,'cinema_id');
    }


    /**
     * Добавляє кинотеатр в БД
     * @return bool
     */
    public function create(array $data): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $border_img = (isset($data['background_img'])) ? $data['border_img'] : null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->conditions = $data['conditions'];
        if ($main_img != null){ $this->logo_img = $main_img;}
        if ($border_img != null){ $this->background_img = $border_img;}
        $this->url = $data['url'];
        $this->title = $data['title'];
        $this->keywords = $data['keywords'];
        $this->seo_description = $data['seo-description'];


        $object = $this->save();

        return $this->id;
    }


}
