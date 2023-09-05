<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;

class DiaryListController extends Controller
{
    public function diaryListDisplay(){

        $object = new Diary();

        $diarysCnt = $object->getCnt();
        $data = $object->getData();

        return view('diaryList',compact('diarysCnt','data'));
    }
}
