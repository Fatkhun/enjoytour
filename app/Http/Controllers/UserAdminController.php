<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserAdmin;
use Auth;
use Storage;

class UserAdminController extends Controller
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
        $register = UserAdmin::create([
            'username'=> $username,
            'email'=> $email,
            'password'=> $password,
        ]);
        if ($register) {
            $res['success'] = true;
            $res['username'] = $username;
            $res['email'] = $email;
            $res['password'] = $password;
            $res['api_key'] = "";
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
        $login = UserAdmin::where('email', $email)->first();
        if (!$login) {
            $res['success'] = false;
            $res['message'] = 'Your email or password incorrect!';
            return response($res);
        }else{
            if ($hasher->check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = UserAdmin::where('id', $login->id)->update(['api_key' => $api_token]);
                if ($create_token) {
                    $res['success'] = true;
                    $res['password'] = $password;
                    $res['username'] = $login->username;
                    $res['email'] = $email;
                    $res['api_key'] = $api_token;
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
      $data = UserAdmin::all();
      if ($data) {
        $res['success'] = true;
        $res['message'] = 'Success get all user';
        $res['data'] = $data;
        return response($res);
      }
    }

    // delete by id
    public function destroy(Request $request, $id){
        $data = UserAdmin::where('id',$id)->first();
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
          $data = UserAdmin::where('id',$id)->first();
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
    public function get_useradmin(Request $request, $id)
    {
        $user = UserAdmin::where('id', $id)->get();
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
}
