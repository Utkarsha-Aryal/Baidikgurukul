<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index()
    {

        return view('backend.auth.login');
    }

    function resetPasswordForm()
    {
        return view('backend.auth.reset_password');
    }

    function loginUser(Request $request)
    {
        try {

            $rules = [
                'email' => 'required|email|max:50',
                'password' => 'required|max:50',

            ];
            $message = [
                'email.required' => 'Email field is required',
                'email.email' => 'Email format does not matched',
                'password.required' => 'Password field is required'
            ];

            $validate = Validator::make($request->all(), $rules, $message);
            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }
            $post = $request->all();
            $type = 'success';
            $message = 'Login success';
            $credentials = [
                'email' => $post['email'],
                'password' => $post['password'],
            ];

            if (Auth::attempt($credentials)) {
                $user = User::where('email', $post['email'])->first();
                if ($user->first_time_login === null) {
                    $message = "Reset password";
                    return json_encode(['type' => $type, 'message' => $message, 'url' => '/admin/reset-password']);
                } else {

                    session(['email' => $user['email']]);
                    return json_encode(['type' => $type, 'message' => $message, 'url' => '/admin/dashboard']);
                }
            } else {
                throw new Exception('Invallid user or password');
            }
        } catch (QueryException) {
            // return redirect()->back()->with('error', 'Database error: ')->withInput();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage())->withInput();
            $type = 'error';
            $message = $e->getMessage();
        }
        // return redirect()->back()->with('error', 'Invallid user or password')->withInput();
        return json_encode(['type' => $type, 'message' => $message]);
    }

    public function logOut()
    {
        if (!Auth::user()) {
            return redirect('admin/login')->with('error', 'Please login first.');
        }
        if (!Auth::logout()) {
            return redirect('admin/login')->with('success', 'Successfully logged out.');
        } else {
            return redirect()->back()->with('error', 'Not able to logout.');
        }
    }

    public function profile()
    {
        $user = User::where(['id' => auth()->id()])->first();
        $data['userData'] = $user;
        return view('backend.profile.index', $data);
    }


    public function getTabContent(Request $request)
    {
        $post = $request->all();
        if ($post['id'] == "editprofile") {

            $user = User::where(['id' => auth()->id()])->first();
            $data['userData'] = $user;

            return view('backend.profile.editprofile', $data);
        } else {

            $user = User::where(['id' => auth()->id()])->first();
            return view('backend.profile.setting');
        }
    }



    //  //reset password-start
    public function resetPassword(Request $request)
    {
        try {

            $rules = [
                'current_password' => 'required|max:250',
                'password' => 'required|max:250',
                'confirm_password' => 'required|max:250',

            ];
            $message = [
                'current_password.required' => 'Please enter current password',
                'password.required' => 'Please enter new password',
                'confirm_password.required' => 'Please enter confirm password',

            ];

            $validation = Validator::make($request->all(), $rules, $message);

            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Password is updated successfully.';

            DB::beginTransaction();

            if (!User::updatepassword($post)) {
                throw new Exception('Could not save record', 1);
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ')->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect('/admin/login')->with('success', 'password changed successfully');
    }
    //reset password-end


    //update new password
    public function updatePassword(Request $request)
    {
        try {

            $rules = [
                'current_password' => 'required|max:250',
                'password' => 'required|max:250',
                'confirm_password' => 'required|max:250',

            ];
            $message = [
                'current_password.required' => 'Please enter current password',
                'password.required' => 'Please enter new password',
                'confirm_password.required' => 'Please enter confirm password',

            ];

            $validation = Validator::make($request->all(), $rules, $message);

            if ($validation->fails()) {
                return json_encode(['type' => 'error', 'message' => $validation->errors()->first()]);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Password is updated successfully.';

            DB::beginTransaction();

            if (!User::updatepassword($post)) {
                throw new Exception('Could not save record', 1);
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


    //update profile name details
    public function updateProfileAll(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|max:250',
                // 'email' => 'required|email',
                'address' => 'required|max:250'
            ];

            $message = [
                'name.required' => 'Please enter name',
                // 'email.required' => 'Please enter email',
                'address.required' => 'please enter address',

            ];

            $validation = Validator::make($request->all(), $rules, $message);
            if ($validation->fails()) {
                return json_encode(['type' => 'error', 'message' => $validation->errors()->first()]);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Record saved successfully';

            DB::beginTransaction();

            if (!User::updatedata($post))
                throw new Exception("Couldn't Save Records", 1);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollback();
            $type = 'error';
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }



    //profile image upload
    public function uploadImage(Request $request)
    {
        try {
            $rules = [
                'image' => 'nullable|file|mimes:jpg,jpeg,png'
            ];

            $message = [
                'image.required' => 'Please select file.',
                'image.mimes' => 'Supported files are (JPEG,JPG,PNG) only.'
            ];
            $validation = Validator::make($request->all(), $rules, $message);
            if ($validation->fails()) {
                throw new Exception($validation->errors()->first(), 1);
            }
            $post = $request->all();
            $type = 'success';
            $message = 'Profile picture updated successfylly';

            DB::beginTransaction();

            if (!User::saveProfileImage($post)) {
                throw new Exception("error", 1);
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
