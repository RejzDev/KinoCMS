<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(BannerImage::class,'banner_id');
    }


    public function getBanners()
    {
        return  $this->all();
    }

    public function updates(array $data, Banner $banner): int
    {
        if (isset($data['status'])){
            $banner->status = 1;
        } else{
            $banner->status = 0;
        }

        $banner->time = $data['time'];



        $object = $banner->save();

        return $banner->id;
    }
}
