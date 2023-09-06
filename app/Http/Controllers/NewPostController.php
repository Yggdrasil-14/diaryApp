<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\NewPostRepository;

class NewPostController extends Controller
{
    public function newPostDisplay(){
        // 配列の初期化
        $data = array();

        // 現在日時
        date_default_timezone_set('Asia/Tokyo');
        $data['today'] = date('Y年m月d日 H:i:s');

        return view('newPost');
    }

    public function register(PostRequest $request){

        $repo = new NewPostRepository();

        $repo->insertDiary($request);

        return view('newPost');
    }
}
