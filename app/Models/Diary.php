<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'content', 'img_path','delete_flg'];

    //テーブル内データの件数を返す
    public function getCnt(){
        return Diary::where('delete_flg', '=', 0)->count();
    }
    
    //テーブル内の削除フラグが立っていないすべてのデータを取得して返す
    public function getData(){
        return Diary::where('delete_flg', '=', 0)->orderBy('date')->paginate(5);
    }
    
}
