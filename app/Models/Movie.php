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
        return $this->with('images')->where('status', '=', 1)->get();
    }

    /**
     * Добавляє фільм в БД
     * @return bool
     */
    public function create(array $data): int
    {
        $img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        if ($img != null){ $this->image = $img;}
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

    /**
     * Оновлення даних фильма
     * @param $attributes
     * @param $movie
     * @return mixed
     */
    public function updates($attributes,$movie)
    {
        $img = (isset($attributes['main_img'])) ? $attributes['main_img'] : null;
        $movie->name = $attributes['name'];
        $movie->description = $attributes['description'];
        if ($img != null){ $movie->image = $img;}
        $movie->url_trailer = $attributes['url-trailer'];
        $movie->type_movie = $attributes['ch'];
        $movie->url = $attributes['url'];
        $movie->title = $attributes['title'];
        $movie->keywords = $attributes['keywords'];
        $movie->seo_description = $attributes['seo-description'];
        $movie->status = 1;
        $movie->soon = 0;

        $object = $movie->save();

        return $movie->id;
    }

}
