<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class DiaryListController extends Controller
{
    public function diaryListDisplay(){

        $object = new Diary();

        $diarysCnt = $object->getCnt();
        $data = $object->getData();

        return view('diaryList',compact('diarysCnt','data'));
    }

    public function delete($id){

        $object = new Diary();

        $data = $object->find($id);

        if (!is_null($data->img_path)) {
            $deleteFilePath = substr($data->img_path,8);
            Storage::disk('public')->delete($deleteFilePath);
        }

        $object->where('id', '=', $id)->update(['delete_flg' => 1,]);
        //$object->where('id', '=', $id)->delete();

        return redirect('/diaryListDisplay');
    }

    public function edit($id){

        $object = new Diary();
        $data = $object->find($id);
        
        return view('editPost',compact('data'));
    }

    public function update(PostRequest $request,$id){
        //画像が設定されている場合、画像をアップロード
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

        //すでに画像が設定されているかつ新たな画像が設定されている場合、元の画像を削除
        if (!is_null($request->currentImage) and isset($request['image'])) {
            $deleteFilePath = substr($request->currentImage,8);
            Storage::disk('public')->delete($deleteFilePath);
        }

        $object = new Diary();
        //画像の更新がある場合
        if (isset($request['image'])) {
            $data = $object->where('id', '=', $id)
                        ->update([
                                    'date' => $request->date,
                                    'content' => $request->content,
                                    'img_path' => $request->img_path,
                                ]);
        }
        //画像の更新がない場合
        if (!isset($request['image'])) {
            $data = $object->where('id', '=', $id)
                        ->update([
                                    'date' => $request->date,
                                    'content' => $request->content,
                                ]);
        }
        return redirect('/diaryListDisplay');
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
