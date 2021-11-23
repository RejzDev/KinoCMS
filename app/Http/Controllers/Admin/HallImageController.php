<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Models\HallImage;


class HallImageController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    public function removeImage(Request $request)
    {

        $images = new HallImage();
        if (isset($request->patch)){
            $images->deletes($request->patch);
            $this->imageSaver->removeGalery($request, $request->dir);

        }

    }
}
