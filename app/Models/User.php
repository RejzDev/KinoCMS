<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers()
    {
       return $this->all();
    }

    public function updates(array $data, User $user): int
    {
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->pseudonym = $data['nick'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->email = $data['email'];
        if ($data['password'] == null){
            $user->password = $user['password'];
        } else {
            $user->password = $data['password'];
        }
        $user->password = $user['password'];
        $user->card = $data['card'];
        $user->language = 1;
        $user->sex = 1;
        $user->phone = $data['phone'];
        $user->phone = $data['date'];
        $user->city = $data['city'];

        $user->update();

        return $user->id;
    }

        public function getStatistic()
        {


            $users = count($this->getUsers());
            $mans = $this->where('sex', '=', 1)->count('id');
            $womens = $users - $mans;
            $interestMan = (100 * $mans) / $users;
            $interestWomen = 100 -  $interestMan;

            $date['man'] = $interestMan;
            $date['women'] = $interestWomen;


            return $date;
        }

    public function getUserIds($id)
    {
        return $this->find($id);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
