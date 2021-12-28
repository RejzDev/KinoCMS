<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BgBanner extends Model
{
    use HasFactory;

    public function getBgBanners()
    {
        return  $this->where('banner_id', '=', 3)->get();
    }

    public function updates(array $data, BgBanner $bgBanner): int
    {

        $bgBanner->image = $data['main_img'];

        $object = $bgBanner->save();

        return $bgBanner->id;
    }

    public function deletes(BgBanner $bgBanner): int
    {

        $bgBanner->image = 'gg';

        $object = $bgBanner->save();

        return $bgBanner->id;
    }
}
