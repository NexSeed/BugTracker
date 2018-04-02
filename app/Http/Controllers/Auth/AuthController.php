<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;
    /*　リダイレクト先を指定しなかった場合は/homeへリダイレクトするように AuthenticatesAndRegistersUsersトレイとの中でハードコーディングされています*/
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $redirectTo = '/top'; // 追加。登録後やログイン後のリダイレクト先
    // ミドルウェアguestはRedirectIfAuthenticatedと定義されている at Kernel.php
    // RedirectIFAuthenticatedのhandle関数を通って以下が実行される
    // handle関数の中は、ログインしてたら/homeにリダイレクトする。してなかったら次に行くという処理。
    //　ここで、redirectToに上書きすることで、リダイレクト先が置き換わる。

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
