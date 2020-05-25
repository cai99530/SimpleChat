<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ChatController extends Controller
{
    //获取聊天页
    public function show(){
        // $user = Auth::user();
        $user = session()->get('user');
        return view('home.chat',compact('user'));
    }

    //写入消息
    public function write(Request $request){

        $input = $request->except('_token');
        $date = date('Y/m/d H:i:s');
        $res = Content::create([
            'username' => $input['username'],
            'content' => $input['content'],
            'date' => $date,
            'user_id'=>$input['userid'],
        ]);
        if($res){
            $data = [
                'message' => '添加成功',
            ];
        }else{
            $data = [
                'message' => '添加失败',
            ];

        }
        return $data;

    }

    //取出消息
    public function read(){
        $cont = Content::orderBy('cont_id','asc')->get();
        return response()->json($cont);

    }


}
