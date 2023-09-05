<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;

class DiaryListController extends Controller
{
    public function diaryListDisplay(){
        $diary = new Diary;
        $value = $diary->find(1);

        return view('diaryList', compact('value'));
    }
}
