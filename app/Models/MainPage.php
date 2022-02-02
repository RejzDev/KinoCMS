<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class MainPage extends Model
    {
        use HasFactory;

        public function getMainPage(): MainPage
        {
                return $this->find(1);
        }

        public function create(array $data): int
        {
            $this->first_phone = $data['phone_1'];
            $this->second_phone = $data['phone_2'];
            $this->description = $data['description'];
            $this->url = $data['url'];
            $this->title = $data['title'];
            $this->keywords = $data['keywords'];
            $this->seo_description = $data['seo-description'];
            if ($data['status'] == 'on') {
                $this->status = 1;
            } else {
                $this->status = 0;
            }


            $this->save();

            return $this->id;
        }

        public function updates(array $data, MainPage $mainPage): int
        {
            $mainPage->first_phone = $data['phone_1'];
            $mainPage->second_phone = $data['phone_2'];
            $mainPage->description = $data['description'];
            $mainPage->url = $data['url'];
            $mainPage->title = $data['title'];
            $mainPage->keywords = $data['keywords'];
            $mainPage->seo_description = $data['seo-description'];
            if ($data['status'] == 'on') {
                $mainPage->status = 1;
            } else {
                $mainPage->status = 0;
            }
            $mainPage->update();

            return $mainPage->id;
        }

        public function getPage()
        {
            return $this->find(1);
        }



    }
