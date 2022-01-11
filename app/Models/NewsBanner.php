<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsBanner extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(NewsBannerImage::class,'banner_id');
    }

    public function getNewsBanners()
    {
        return  $this->where('banner_id', '=', '2')->get();
    }

    public function creates(array $data): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $this->banner_id = 2;
        $this->url = $data['url'];
        if ($main_img != null){ $this->image = $main_img;}

        $object = $this->save();

        return $this->id;
    }

    public function updates(array $data, NewsBanner $mainBanner): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $mainBanner->banner_id = 2;
        $mainBanner->url = $data['url'];
        if ($main_img != null){ $mainBanner->image = $main_img;}


        $object = $mainBanner->save();

        return $mainBanner->id;
    }

    public function getNewsBanner()
    {
        return  $this->where('banner_id', '=', '2')->limit(1)->get();
    }
}
