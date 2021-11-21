<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_img',
        'patch',
        'position',
    ];

    //Зв'язок з таблицею movies
    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }

  // //Зв'язок з таблицею cinemas
  // public function cinemas()
  // {
  //     return $this->belongsTo(Cinema::class);
  // }

  // //Зв'язок з таблицею halls
  // public function halls()
  // {
  //     return $this->belongsTo(Hall::class);
  // }

  // //Зв'язок з таблицею news
  // public function news()
  // {
  //     return $this->belongsTo(News::class);
  // }

  // //Зв'язок з таблицею pages
  // public function pages()
  // {ц
  //     return $this->belongsTo(Page::class);
  // }

  // //Зв'язок з таблицею actions
  // public function actions()
  // {
  //     return $this->belongsTo(Action::class);
  // }

    public function creates(array $date)
    {
        $images = array();
        $i=0;
        foreach ($date['images'] as $item) {
            if (isset($date['img_pos'][$i])) $pos = $date['img_pos'][$i];
            $images[] = [
            'key_img' => $date['movie_id'],
            'patch' => $item,
            'position' => $pos

        ];
            $i++;
        }
        $this->insert($images);
    }
    public function updates(array $date)
    {
       // $images = array();
      //  $i=0;
       //foreach ($date['images'] as $item) {
       //    if (isset($date['img_pos'][$i])) $pos = $date['img_pos'][$i];
       //    $images[] = [
       //        'key_img' => $date['movie_id'],
       //        'patch' => $item,
       //        'position' => $pos
       //
       //    ];
       //    $i++;
       //}
       // $this->insert($images);


        return $this->where('patch', '=', $date['oldPatch'])->update(["patch" => $date['newPatch']]);
    }

    public function deletes(Image $image)
    {
        $image->delete();
    }
}
