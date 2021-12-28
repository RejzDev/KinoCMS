<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    use HasFactory;



    public function getMainBanners()
    {
        return  $this->where('banner_id', '=', '1')->get();
    }

    public function create(array $data): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $this->banner_id = 1;
        $this->url = $data['url'];
        if ($main_img != null){ $this->image = $main_img;}
        $this->text = $data['text'];



        $object = $this->save();

        return $this->id;
    }

    public function updates(array $data, MainBanner $mainBanner): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $mainBanner->banner_id = 1;
        $mainBanner->url = $data['url'];
        if ($main_img != null){ $mainBanner->image = $main_img;}
        $mainBanner->text = $data['text'];



        $object = $mainBanner->save();

        return $mainBanner->id;
    }
}
