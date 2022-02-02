<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function contactCinemas()
    {
        return $this->hasMany(ContactCinema::class,'contact_id');
    }

    public function create(array $data): int
    {
        $this->url = $data['url'];
        $this->title = $data['title'];
        $this->keywords = $data['keywords'];
        $this->seo_description = $data['seo-description'];
        $this->status = 1;

       $this->save();

        return $this->id;
    }

    public function updates(array $data, Contact $contact): int
    {

        $contact->url = $data['url'];
        $contact->title = $data['title'];
        $contact->keywords = $data['keywords'];
        $contact->seo_description = $data['seo-description'];
        if (isset($data['status'])){
            $contact->status = 1;
        } else{
            $contact->status = 0;
        }

        $contact->update();

        return $contact->id;
    }

    public function getContact(): Contact
    {
        return $this->find(1);
    }
}
