<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    //
    public function getLogin()
    {
        return view('backend.login');
    }
    public function postLogin(LoginRequest $request)
    {
        $arr =
            [
                'code' => $request->code,
                'password' => $request->password
            ];
        if ($request->remember = 'Remember Me') {
            $remember = true;
        }
        else{
            $remember = false;
        }
        if (Auth::attempt($arr,$remember)) {
            return redirect()->route('backend.home')->with('flash_success','Đăng nhập thành công!!! thích quá <3');
        }
        else{
            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu chưa đúng');
        }
    }
}
