<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadMail extends Model
{
    use HasFactory;

    public function saves(string $data)
    {
        $this->name = 'Name';
        $this->patch = $data;

        $id = $this->save();

        return $id;
    }

    public function getMail(int $id)
    {
       return $this->find($id);


    }

    public function getViews()
    {
        return $this->orderBy('id', 'desc')->get();


    }
    public function destroys($id)
    {
        $item = $this->where('id', '=', $id)->delete();
        return true;
    }

}
