<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;
    protected $table = 'diarys';

    public function getData(){
        $data = DB::table($this->table)->get();
        return $data;
    }
}
