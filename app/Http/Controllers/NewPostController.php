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
        $today = $this->getDateTime(); 

        if (isset($request['image'])) {
            $dir = 'img';
            // アップロードされたファイル名 + 日時を取得
            $today = $this->getDateTime()['imageDataToday'];
            $fileName = $request->file('image')->getClientOriginalName();
            $imageSaveName = $today . "_" . $fileName;
            // 日時 + 取得したファイル名で保存
            $request->file('image')->storeAs('public/' . $dir, $imageSaveName);
            $request->merge(['img_path' => 'storage/' . $dir . '/' . $imageSaveName]);
        }
        $repo->insertDiary($request);
        return redirect('/newPostDisplay');
    }

    public static function getDateTime(){
        // 現在日時
        date_default_timezone_set('Asia/Tokyo');
        $today = array(
            'dispToday' => date('m/d Y'),
            'dataToday' => date('Y-m-d H:i:s'),
            'imageDataToday' => date('Y-m-d_His')
        );

        return $today;
    }

    
}
