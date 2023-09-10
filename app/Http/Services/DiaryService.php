<?php

namespace App\Http\Services;

use App\Models\Diary;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class DiaryService
{
    //テーブル内データの件数を返す
    public function getCnt(){
        return Diary::where('delete_flg', '=', 0)->count();
    }
    
    //テーブル内の削除フラグが立っていないすべてのデータを取得して返す
    public function getDiaries(){
        return Diary::where('delete_flg', '=', 0)->orderBy('date')->paginate(5);
    }

    //削除データの件数を返す
    public function getTrashCnt(){
        return Diary::where('delete_flg', '=', 1)->count();
    }
    
    //テーブル内の削除フラグが立っているすべてのデータを取得して返す
    public function getTrashDiaries(){
        return Diary::where('delete_flg', '=', 1)->orderBy('date')->paginate(5);
    }

    //IDを受けて削除フラグ立てを実行
    public function delete($id){
        Diary::where('id', '=', $id)->update(['delete_flg' => 1,]);
    }

    //IDを受けて日記と画像の削除を実行
    public function destroy($id){
        $diary = Diary::find($id);
        if (!is_null($diary->img_path)) {
            $deleteFilePath = substr($diary->img_path,8);
            Storage::disk('public')->delete($deleteFilePath);
        }
        Diary::where('id', '=', $id)->delete();
    }

    //IDを受けて削除フラグ折りを実行
    public function restoration($id){
        Diary::where('id', '=', $id)->update(['delete_flg' => 0,]);
    }

    public function register(PostRequest $request){

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
        Diary::create([
            'date' => $request->date,
            'content' => $request->content,
            'img_path' => $request->img_path,
            'delete_flg' => '0',
        ]);
    }

    //IDを受けて日記データを取得
    public function edit($id){
        return $diary = Diary::find($id);
    }

    //IDとリクエストパラメータを受けてアップデートを実行
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
            Diary::where('id', '=', $id)
                        ->update([
                                    'date' => $request->date,
                                    'content' => $request->content,
                                    'img_path' => $request->img_path,
                                ]);
        }
        //画像の更新がない場合
        if (!isset($request['image'])) {
            Diary::where('id', '=', $id)
                        ->update([
                                    'date' => $request->date,
                                    'content' => $request->content,
                                ]);
        }
        return redirect('/diaryListDisplay');
    }

    //現在時刻を各フォーマットで取得
    public static function getDateTime(){
        date_default_timezone_set('Asia/Tokyo');
        $today = array(
            'dispToday' => date('m/d Y'),
            'dataToday' => date('Y-m-d H:i:s'),
            'imageDataToday' => date('Y-m-d_His')
        );

        return $today;
    }
}
