<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Org\code\Code;
use App\Model\User;

class LoginController extends Controller
{
    //返回登录页
    public function login(){
        session()->flush();
        return view('home.login');
    }

    //获取验证码
    public function code(){
        $code = new Code();
        return $code->make();
    }

    // 实现登录
    public function dologin(Request $request){
        $input = $request->except('_token');
        if(strtolower($input['code']) != strtolower(session()->get('code'))){
            $errorcode = [
                'message'=>'验证码错误',
            ];
            return $errorcode;
        }

        $user =  User::where('username',$input['username'])->where('password',$input['password'])->first();

        if(!$user){
            $errorrinfo = [
                'message'=>'用户名或密码错误',
                'username'=>$input['username'],
            ];
            return $errorrinfo;
        }
        session()->put('user',$user);

        

    }


    // 退出登录
    public function loginout(){
        session()->remove('user');
        return redirect('/');
    }




}
