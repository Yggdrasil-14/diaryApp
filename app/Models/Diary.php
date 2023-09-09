<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diary extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'content', 'img_path','delete_flg'];
    protected $table = 'diarys';//対象とするテーブル名の指定

    //テーブル内データの件数を返す
    public function getCnt(){
        $cnt = DB::table($this->table)->where('delete_flg', '=', 0)->count();
        return $cnt;
    }
    
    //テーブル内の削除フラグが立っていないすべてのデータを取得して返す
    public function getData(){
        $data = DB::table($this->table)->where('delete_flg', '=', 0)->orderBy('date')->paginate(5);
        return $data;
    }

}
