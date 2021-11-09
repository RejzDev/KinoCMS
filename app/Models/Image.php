<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //Зв'язок з таблицею movies
    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }

    //Зв'язок з таблицею cinemas
    public function cinemas()
    {
        return $this->belongsTo(Cinema::class);
    }

    //Зв'язок з таблицею halls
    public function halls()
    {
        return $this->belongsTo(Hall::class);
    }

    //Зв'язок з таблицею news
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    //Зв'язок з таблицею pages
    public function pages()
    {
        return $this->belongsTo(Page::class);
    }

    //Зв'язок з таблицею movies
    public function actions()
    {
        return $this->belongsTo(Action::class);
    }
}
