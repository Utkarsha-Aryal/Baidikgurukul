<?php

namespace App\Models\BackPanel;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ForgotPassword extends Model
{
    use HasFactory;

    protected $table = 'users';

    // Get registered email
    public static function checkRegisteredEmail($post)
    {
        try {
            $user = ForgotPassword::where('status', 'Y')->where('email', $post['email'])->first(['id', 'email']);
            if ($user) {
                $otp = Str::random(4);
                Mail::to($user->email)->send(new ForgotPasswordMail($otp));
                $dataArray = [
                    'user_id' => $user->id,
                    'otp' => $otp,
                    'created_at' => Carbon::now(),
                ];
                $userId = Otp::where('user_id', $user->id)->first(['user_id']);

                if ($userId) {

                    if (!Otp::where('user_id', $user->id)->update($dataArray)) {
                        throw new Exception("Couldn't Save Records", 1);
                    }
                } else {
                    if (!Otp::insert($dataArray)) {
                        throw new Exception("Couldn't Save File", 1);
                    }
                }
                return $user;
            } else {
                throw new Exception("Email does not registered");
            }

            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }



    /* update password-start */
    public static function updateData($post)
    {
        try {
            $user = User::where('id', $post['id'])->first();
            if ($user) {
                if ($post['password'] !== $post['confirm_password']) {
                    throw new Exception('The new password and confirm password do not match.');
                }
                if (!User::where(['id' =>  $post['id']])->update(['password' => Hash::make($post['password'])])) {
                    throw new Exception("Couldn't update password. Please try again", 1);
                }
                return $user;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    /* update password-end */
}
