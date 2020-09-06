<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Tweet;

use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        if(Auth::check()){
            $user = Auth::user();
            
            $tweets = $user->feed_tweets()->orderBy('created_at','desc')->paginate(10);
            
            $data=
            [
                'user'=>$user,
                'tweets'=>$tweets,
                
            ];
        }

        return view('home',$data);
        
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
        $this->validate($request,[
            'content'=>'required'
        ]);

        $request->user()->tweets()->create([
            'content'=>$request->content
        ]);

        return back();
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
        $tweet=\App\Tweet::find($id);

        if(Auth::id()===$tweet->user_id){
            $tweet->delete();
        }

        return back();
    }
}
