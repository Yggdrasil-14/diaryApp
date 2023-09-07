<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\NewPostRepository;

class NewPostController extends Controller
{
    public function newPostDisplay(){
        
        $today = $this->getDateTime();

        return view('newPost',compact('today'));
    }

    public function register(PostRequest $request){

        $repo = new NewPostRepository();

        $repo->insertDiary($request);

        $today = $this->getDateTime();

        return view('newPost',compact('today'));
    }

    public static function getDateTime(){
        // 現在日時
        date_default_timezone_set('Asia/Tokyo');
        $today = array(
            'dispToday' => date('m/d Y'),
            'dataToday' => date('Y-m-d H:i:s')
        );

        return $today;
    }

    
}
