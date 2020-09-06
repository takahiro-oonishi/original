<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\User;
use App\Tweet;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function counts($user){
        $counts_tweets=$user->tweets()->count();
        $counts_followings=$user->followings()->count();
        $counts_followers=$user->followers()->count();
    
        return[
            'count_tweets'=>$counts_tweets,
            'count_followings'=>$counts_followings,
            'count_followers'=>$counts_followers
        ];
    }
}
