<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Movie extends Model
{
    use HasFactory;

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
    public function createMovie(): bool
    {
        $this->name = 'Test';
        $this->description = 'Test';
        $this->url_trailer = 'Test';
        $this->type_movie = 'Test';
        $this->url = 'Test';
        $this->title = 'Test';
        $this->keywords = 'Test';
        $this->seo_description = 'Test';
        $this->status = 1;
        $this->soon = 0;

        return $this->save();
    }

}
