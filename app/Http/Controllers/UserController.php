<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Auth;
use Storage;

class UserController extends Controller
{
    /**
     * Register new user
     *
     * @param $request Request
     */
    public function register(Request $request)
    {
        $this->validate($request, [
          'username' => 'required|string',
          'email' => 'required|string',
          'password' => 'required|string'
      ]);
        $hasher = app()->make('hash');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $hasher->make($request->input('password'));
        $register = User::create([
            'username'=> $username,
            'email'=> $email,
            'password'=> $password,
        ]);
        if ($register) {
            $res['success'] = true;
            $res['username'] = $username;
            $res['email'] = $email;
            $res['password'] = $password;
            $res['api_token'] = "";
            $res['message'] = 'Success register';
            $res['data'] = $register;
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'Failed to register!';
            return response($res);
        }
    }

    /**
     * Index login controller
     *
     * When user success login will retrive callback as api_token
     */
    public function login(Request $request)
    {
        $hasher = app()->make('hash');
        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
        if (!$login) {
            $res['success'] = false;
            $res['message'] = 'Your email or password incorrect!';
            return response($res);
        }else{
            if ($hasher->check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['success'] = true;
                    $res['password'] = $password;
                    $res['username'] = $login->username;
                    $res['email'] = $email;
                    $res['api_token'] = $api_token;
                    $res['message'] = 'Success login';
                    $res['data'] = $login;
                    return response($res);
                }
            }else{
                $res['success'] = true;
                $res['message'] = 'You email or password incorrect!';
                return response($res);
            }
        }
    }

    // get all user
    public function index(Request $request){
      $data = User::all();
      if ($data) {
        $res['success'] = true;
        $res['message'] = 'Success get all user';
        $res['data'] = $data;
        return response($res);
      }
    }

    // delete by id
    public function destroy(Request $request, $id){
        $data = User::where('id',$id)->first();
        $data->delete();
        if ($data) {
          $res['success'] = true;
          $res['message'] = 'Success delete user';
          $res['data'] = $data;
          return response($res);
        }else{
          $res['success'] = false;
          $res['message'] = 'Failed delete user!';
          return response($res);
        }
    }

    // update by id
    public function update(Request $request, $id){
          $data = User::where('id',$id)->first();
          $hasher = app()->make('hash');
          $data->username = $request->input('username');
          $data->email = $request->input('email');
          $data->password = $hasher->make($request->input('password'));
          $data->save();
          if ($data) {
            $res['success'] = true;
            $res['message'] = 'Success update user';
            $res['data'] = $data;
            return response($res);
          }else{
            $res['success'] = false;
            $res['message'] = 'Failed update user!';
            $res['data'] = $data;
            return response($res);
          }
    }


    /**
     * Get user by id
     *
     * URL /user/{id}
     */
    public function get_user(Request $request, $id)
    {
        $user = User::where('id', $id)->get();
        if ($user) {
              $res['success'] = true;
              $res['message'] = 'Success find user';
              $res['data'] = $user;
        
              return response($res);
        }else{
          $res['success'] = false;
          $res['message'] = 'Cannot find user!';
        
          return response($res);
        }
    }

    public function updateProfile(Request $request, $id) {
      $this->validate($request, [
          // 'avatar' => 'required|image',
          'first_name' => 'required|string',
          'last_name' => 'required|string'
          // 'sex' => 'required|string'
      ]);
      $avatar = Str::random(34);
      $request->file('avatar')->move(storage_path('uploads/avatar/'), $avatar);
      $user_profile = User::where('id', $id)->first();
      if ($user_profile) {
        $current_avatar = storage_path('uploads/avatar') . "/" . $user_profile->avatar;
        if (file_exists($current_avatar)) {
          unlink($current_avatar);
        }
        $user_profile->avatar = $avatar;
        $user_profile->first_name = $request->first_name;
        $user_profile->last_name = $request->last_name;
        $user_profile->sex = $request->sex;
        $user_profile->save();
      }else{
        $user_profile = new User;
        $user_profile->avatar = $avatar;
        $user_profile->first_name = $request->first_name;
        $user_profile->last_name = $request->last_name;
        $user_profile->sex = $request->sex;
        $user_profile->save();
      }
      $res['success'] = true;
      $res['avatar'] = $user_profile->avatar;
      $res['first_name'] = $user_profile->first_name;
      $res['last_name'] = $user_profile->last_name;
      $res['sex'] = $user_profile->sex;
      $res['message'] = "Success update user profile.";
      $res['data'] = $user_profile;
      return response($res);
    }

    public function get_avatar($name)
    {
        $avatar_path = storage_path('avatar') . '/' . $name;
        if (file_exists($avatar_path)) {
          $file = file_get_contents($avatar_path);
          return response($file, 200)->header('Content-Type', 'image/jpeg');
        }
        $res['success'] = false;
        $res['message'] = "Avatar not found";        
        return $res;
    }
}