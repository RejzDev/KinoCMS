<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCinema extends Model
{
    use HasFactory;

    public function create(array $data): int
    {

        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->address = $data['cord'];
        if ($main_img != null){ $this->image = $main_img;}
        $this->contact_id = 1;
        $this->status = 1;

        $this->save();

        return $this->id;
    }

    public function updates(array $data, ContactCinema $contactCinema): int
    {

        $main_img = (isset($data['main_img'])) ? $data['main_img'] : null;
        $contactCinema->name = $data['name'];
        $contactCinema->description = $data['description'];
        $contactCinema->address = $data['cord'];
        if ($main_img != null){ $contactCinema->image = $main_img;}
        $contactCinema->contact_id = 1;
        $contactCinema->status = 1;

        $contactCinema->update();

        return $contactCinema->id;
    }
}
