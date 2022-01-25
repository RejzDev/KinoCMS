<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

  //protected $fillable = [
  //    'name',
  //    'description',
  //    'image',
  //    'url_trailer',
  //    'type_movie',
  //    'url',
  //    'title',
  //    'keywords',
  //    'seo_description',
  //    'status',
  //    'soon',
  //];

    public function create(array $genre){
        $this->insert($genre);

        return 1;

    }

    public function updates(array $genre)
    {
        foreach ($genre as $item)
        $this->where('id', '=', $item['id'])
            ->update(['name' => $item['name'],
                'description' => $item['description']]);
    }
}
