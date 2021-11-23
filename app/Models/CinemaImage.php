<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaImage extends Model
{
    use HasFactory;

    public function creates(array $date)
    {
        $images = array();
        $i=0;
        foreach ($date['images'] as $item) {

            $images[] = [
                'cinema_id' => $date['cinema_id'],
                'patch' => $item,
                'position' => $i

            ];
            $i++;
        }
        $this->insert($images);
    }

    public function deletes(string $patch)
    {
        return $this->where('patch', '=', $patch)->delete();
    }

}
