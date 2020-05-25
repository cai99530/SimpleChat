<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Content;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('home.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $input = $request->except('_token');
        $res1 = User::where('user_id',$id)->update([
            'username' => $input['username'],
            'password' => $input['password'],
        ]);
        $res2 = User::find($id)->contents()->update([
            'username' => $input['username'],
        ]);

        $arr = [$res1,$res2];
        return $arr;


        
        // if(!$res1){
        //     $usererror=[
        //         'message'=>'第一步错误',
        //     ];
        //     return $usererror;
        // }


        // if(!$res2){
        //     $conterror=[
        //         'message'=>'第二步错误',
        //     ];
        //     return $conterror;
        // }

        session()->remove('user');
        // if($res1 && $res2){
        //     session()->remove('user');
        //     $data = [
        //         'status' => 0,
        //         'message' => '修改成功，请重新登陆',
        //     ];
        // }else{
        //     $data = [
        //         'status' => 1,
        //         'message' => '修改失败',
        //     ];
        // }

        // return $data;
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
