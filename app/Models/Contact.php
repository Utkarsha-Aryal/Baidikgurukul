<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Exception;


class Contact extends Model
{
    use HasFactory;

    public static function saveData($post)
    {
        try {
            $dataArray = [
                'first_name' => $post['first_name'],
                'last_name' => $post['last_name'],
                'email' => $post['email'],
                'message' => $post['message'],
            ];

            if (!Contact::insert($dataArray)) {
                throw new Exception("Couldn't send data", 1);
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
