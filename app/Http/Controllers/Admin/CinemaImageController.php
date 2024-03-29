<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Models\CinemaImage;
use App\Http\Controllers\Controller;

class CinemaImageController extends Controller
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Видалення зображень
     * @param Request $request
     */
    public function removeImage(Request $request)
    {

        $images = new CinemaImage();
        if (isset($request->patch)){
            $images->deletes($request->patch);
            $this->imageSaver->removeGalery($request, $request->dir);

        }



    }
}
