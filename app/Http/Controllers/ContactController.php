<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function save(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required|min:2|max:50',
                'last_name' => 'required|min:2|max:50',
                'email' => 'required',
                'message' => 'required|min:5|max:255'
            ];

            $message = [
                'first_name.required' => 'First name is required.',
                'first_name.min' => 'First name must be at least 2 characters long.',
                'first_name.max' => 'First name cannot exceed 50 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.min' => 'Last name must be at least 2 characters long.',
                'last_name.max' => 'Last name cannot exceed 50 characters.',
                'email.required' => 'Email address is required.',
                'message.required' => 'Message is required.',
                'message.min' => 'Message must be at least 5 characters long.',
                'message.max' => 'Message cannot exceed 255 characters.'
            ];

            $validate = Validator::make($request->all(), $rules, $message);

            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }
            $post = $request->all();
            $type = 'success';
            $message = 'Data send successfully';

            DB::beginTransaction();
            $post['created_by'] = $this->userid;
            if (!Contact::saveData($post)) {
                throw new Exception('Could not send data', 1);
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollBack();
            $type = 'error';
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }
}