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
        $cnt = DB::table($this->table)->count();
        return $cnt;
    }
    
    //テーブル内のすべてのデータを取得して返す
    public function getData(){
        $data = DB::table($this->table)->orderBy('date')->paginate(5);
        return $data;
    }

}
