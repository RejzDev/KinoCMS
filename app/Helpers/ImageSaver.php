<?php


    namespace App\Helpers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Intervention\Image\Facades\Image;
    use App\Models\Movie;

    class ImageSaver {

        public function upload(Request $request, $item, string  $dir) {
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
                $path = $source->store('catalog/'.$dir.'/source', 'public');
                $path = Storage::disk('public')->path($path); // абсолютный путь
                $name = basename($path); // имя файла

            }
            return $name;
        }

        public function uploadGalary(Request $request, $image , $item, string $dir) {
            $name = $items ?? null;
            if ($item && $request->remove) {
                $this->removeGalery($item, $dir);
                $name = null;
            }
            $source = $image;
            if ($source) { // если было загружено изображение
                // перед загрузкой нового изображения удаляем старое
                if ($item && $item->image) {
                    $this->removeGalery($item, $dir);
                }
                $ext = $source->extension();
                // сохраняем загруженное изображение без всяких изменений
                $path = $source->store('catalog/'.$dir.'/source', 'public');
                $path = Storage::disk('public')->path($path); // абсолютный путь
                $name = basename($path); // имя файла
            }

            return $name;
        }



        public function remove($item, $dir) {
            $old = $item->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/'.$dir.'/source/' . $old);
            }
        }

        public function removeGalery($item, $dir) {
            $old = $item;
            if ($old) {
                Storage::disk('public')->delete('catalog/'.$dir.'/source/' . $old);
            }
        }
    }
