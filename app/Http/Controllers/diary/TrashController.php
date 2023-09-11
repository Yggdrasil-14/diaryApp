<?php

namespace App\Http\Controllers\diary;

use App\Http\Services\DiaryService;

class TrashController extends Controller
{
    
    private $diaryService;
    
    public function __construct(DiaryService $diaryService)
    {
        $this->diaryService = $diaryService;
    }
    
    public function trash(){

        $diarysCnt = $this->diaryService->getTrashCnt();
        $data = $this->diaryService->getTrashDiaries();

        return view('diary/trash',compact('diarysCnt','data'));
    }

    public function destroy($id){

        $this->diaryService->destroy($id);

        return redirect('/diary/trash');
    }

    public function restoration($id){

        $data = $this->diaryService->restoration($id);
        
        return redirect('/diary/trash');
    }
}
