<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Movie extends Model
{
    use HasFactory;
   //
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

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(Image::class,'key_img');
    }

    /**
     * Вертає усі фільми зі статусом 1
     * @return Collection
     */
    public function getOngoingMovies(): Collection
    {
        return $this->where('status', '=', 1)->get();
    }

    /**
     * Добавляє фільм в БД
     * @return bool
     */
    public function create(array $data): int
    {

        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->image = $data['images'][1]['name'];
        $this->url_trailer = $data['url-trailer'];
        $this->type_movie = $data['ch'];
        $this->url = $data['url'];
        $this->title = $data['title'];
        $this->keywords = $data['keywords'];
        $this->seo_description = $data['seo-description'];
        $this->status = 1;
        $this->soon = 0;

        $object = $this->save();

        return $this->id;
    }

}
