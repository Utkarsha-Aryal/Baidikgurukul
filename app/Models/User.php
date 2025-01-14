<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\BackPanel\NewsEvent;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // public function post()
    // {
    //     return $this->hasMany(NewsEvent::class)->where('status', 'Y');
    // }

    /* update password-start */
    public static function updatepassword($post)
    {
        try {
            $user = User::where('id', auth()->id())->first();

            if (!Hash::check($post['current_password'], $user->password)) {
                throw new Exception('The current password is incorrect.');
            }

            if ($post['password'] !== $post['confirm_password']) {
                throw new Exception('The new password and confirm password do not match.');
            }

            $user->password = Hash::make($post['password']);
            $user->first_time_login = 1;
            if (!$user->save()) {
                throw new Exception('Password is not updated.');
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /* update password-end */


    /*update profile-start */
    public static function updatedata($post)
    {
        try {
            $updateArray = [
                'name' => $post['name'],
                // 'email' => $post['email'],
                'address' => $post['address'],
            ];

            $updateArray['updated_at'] = Carbon::now();

            if (!User::where('id', 1)->update($updateArray)) {
                throw new Exception("Couldn't Save Records", 1);
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /*update profile-end*/


    /*update profile image-start*/
    public static function saveProfileImage($post)
    {
        try {
            $dataArray = [];

            if (!empty($post['image'])) {
                $fileName =  Common::uploadFile('profile', $post['image']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['image'] = $fileName;
            }

            $dataArray['updated_at'] = Carbon::now();
            if (!User::where('id', 1)->update($dataArray)) {
                throw new Exception("Couldn't update Records", 1);
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /*update profile image-end*/

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
