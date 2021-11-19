<?php


    namespace App\Helpers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Intervention\Image\Facades\Image;

    class ImageSaver {

        public function upload($request, $item, $dir) {
            $name = $item->image ?? null;
            if ($item && $request->remove) {
                $this->remove($item, $dir);
                $name = null;
            }
            for($i = 1; $i < 8; $i++){
                if ($request->file('image-' . $i) != null) {
                    $source = $request->file('image-' . $i);

                    if ($source) {
                        if ($item && $item->image) {
                            $this->remove($item, $dir);
                        }
                        if ($item && $item->images) {
                            $this->remove($item, $dir);
                        }
                        $ext = $source->extension();

                        $path = $source->store('catalog/'.$dir.'/source', 'public');
                        $path = Storage::disk('public')->path($path);
                        $name[$i]['name'] = basename($path);

                    }
                } else {
                    break;
                }
            }

            return $name;
        }



        public function remove($item, $dir) {
            $old = $item->image;
            if ($old) {
                Storage::disk('public')->delete('catalog/'.$dir.'/source/' . $old);
            }
        }
    }
