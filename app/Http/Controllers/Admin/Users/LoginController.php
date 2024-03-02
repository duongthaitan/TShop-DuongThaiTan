<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
  public function index()
  {
    return view(
      'admin.users.login',
      [
        'title' => 'TShop | Đăng nhập hệ thống'
      ]
    );
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email:filter',
      'password' => 'required',
    ]);
    //Kiểm tra đầu vào người dùng nhập có khớp với mật khẩu họ đã tạo !
    if (Auth::attempt([
          'email' => $request->input('email'),
          'password' => $request->input('password')
    ], $request -> input('remember')))
    {
      return redirect()->route('admin');
    }


    \Illuminate\Support\Facades\Session::flash('error','Email hoặc mật khẩu không chính xác');
    return redirect()->back();
  }
}
