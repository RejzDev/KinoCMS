<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;

    public function creates(array $date)
    {
        $images = array();
        $i=0;
        foreach ($date['images'] as $item) {

            $images[] = [
                'page_id' => $date['page_id'],
                'patch' => $item,
                'position' => $i

            ];
            $i++;
        }
        $this->insert($images);
    }

    public function updates(array $date)
    {

        return $this->where('patch', '=', $date['oldPatch'])->update(["patch" => $date['newPatch']]);
    }

    public function deletes(string $patch)
    {
        return $this->where('patch', '=', $patch)->delete();
    }
}