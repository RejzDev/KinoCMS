<?php


    namespace App\Helpers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Intervention\Image\Facades\Image;
    use App\Models\Movie;

    class ImageSaver
    {

        public function upload(Request $request, $item, string $dir)
        {
            $name = $item->main_img ?? null;
            if ($item && $request->remove) { // если надо удалить изображение
                $this->remove($item, $dir);
                $name = null;
            }
            $source = $request->file('main_img');
            if ($source) { // если было загружено изображение
                // перед загрузкой нового изображения удаляем старое
                if ($item && $item->image) {
                    $this->remove($item, $dir);
                }
                $ext = $source->extension();
                // сохраняем загруженное изображение без всяких изменений
                $path = $source->store('catalog/' . $dir . '/source', 'public');
                $path = Storage::disk('public')->path($path); // абсолютный путь
                $name = basename($path); // имя файла

            }
            return $name;
        }

        public function uploadGalary(Request $request, $image, $object, string $dir)
        {

            foreach ($object->images as $img) {
                $name = $img->patch ?? null;
            }
            $i = 0;
            foreach ($object->images as $img) {
                if ($image && $request->remove && $img->position == $request->img_pos[$i]) {
                    $this->removeGalery($image, $dir);
                    $name = null;
                    $i++;
                }
            }
            $source = $image;
            if ($source) { // если было загружено изображение
                // перед загрузкой нового изображения удаляем старое
                $i = 0;
                foreach ($object->images as $img) {
                    if (isset($request->img_pos[$i])){
                    if ($object && $img->patch && $img->position == $request->img_pos[$i]) {
                        $this->removeGalery($img, $dir);
                    }
                    }
                    $i++;
                }
                $ext = $source->extension();
                // сохраняем загруженное изображение без всяких изменений
                $path = $source->store('catalog/' . $dir . '/source', 'public');
                $path = Storage::disk('public')->path($path); // абсолютный путь
                $name = basename($path); // имя файла
            }

            return $name;
        }


        public
        function remove($item, $dir)
        {
            $old = $item->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/' . $dir . '/source/' . $old);
            }
        }

        public
        function removeGalery($item, $dir)
        {
            $old = $item->patch;
            if ($old) {
                Storage::disk('public')->delete('catalog/' . $dir . '/source/' . $old);
            }
        }
    }
