<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    //Зв'язок з таблицею images
    public function images()
    {
        return $this->hasMany(CinemaImage::class,'cinema_id');
    }

    public function halls()
    {
        return $this->hasMany(Hall::class,'cinema_id');
    }


    /**
     * Добавляє кинотеатр в БД
     * @return bool
     */
    public function create(array $data): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $border_img = (isset($data['border_img'])) ? $data['border_img'] : null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->conditions = $data['conditions'];
        if ($main_img != null){ $this->logo_img = $main_img;}
        if ($border_img != null){ $this->background_img = $border_img;}
        $this->url = $data['url'];
        $this->title = $data['title'];
        $this->keywords = $data['keywords'];
        $this->seo_description = $data['seo-description'];


        $object = $this->save();

        return $this->id;
    }

    public function updates(array $data, Cinema $cinema): int
    {
        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $border_img = (isset($data['border_img'])) ? $data['border_img'] : null;
        $cinema->name = $data['name'];
        $cinema->description = $data['description'];
        $cinema->conditions = $data['conditions'];
        if ($main_img != null){ $cinema->logo_img = $main_img;}
        if ($border_img != null){ $cinema->background_img = $border_img;}
        $cinema->url = $data['url'];
        $cinema->title = $data['title'];
        $cinema->keywords = $data['keywords'];
        $cinema->seo_description = $data['seo-description'];

        $object = $cinema->update();

        return $cinema->id;
    }

    public function allCinema(){
      return  $this->all();
    }


    public function searches(string $search)
    {
        return $this->with('halls')->where('name', 'like', '%' . $search . '%')->get();

    }

    public function getLastHalls()
    {
        return $this->with('halls')->orderBy('id', 'desc')->limit(10)->get();
    }

    public function getLastCinema()
    {
        return $this->with('cinemas')->orderBy('id', 'desc')->limit(10)->get();
    }

    public function searchesCinema(string $search)
    {
        return $this->where('name', 'like', '%' . $search . '%')->get();

    }

    public function getCinemaIds(int $id)
    {


        return $this->with('images', 'halls')->find($id);
    }


}
