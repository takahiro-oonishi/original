<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    //プロフィール登録フォームの表示
    //@retrun Response
    public function index(){
        $is_image=false;
        
        if(Storage::disk('local')->exists('public/profile_images/'.Auth::id().'.jpg')){
            $is_image=true;
        }

        return view('profile.index',['is_image'=>$is_image]);
    }

    //プロフィールの保存
    //@param ProfileRepuest $request
    //@retrun Response
    public function store(ProfileRequest $request){
        
        $request->photo->storeAs('public/profile_images',Auth::id().'.jpg');
        
        return redirect('profile_index')->with('success','新しいプロフィール画像を登録しました');
    
    }



}
