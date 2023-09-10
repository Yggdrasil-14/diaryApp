<?php

namespace App\Http\Controllers;

use App\Http\Services\DiaryService;

class TrashListController extends Controller
{
    
    private $diaryService;
    
    public function __construct(DiaryService $diaryService)
    {
        $this->diaryService = $diaryService;
    }
    
    public function trashListDisplay(){

        $diarysCnt = $this->diaryService->getTrashCnt();
        $data = $this->diaryService->getTrashDiaries();

        return view('trashList',compact('diarysCnt','data'));
    }

    public function destroy($id){

        $this->diaryService->destroy($id);

        return redirect('/trashListDisplay');
    }

    public function restoration($id){

        $data = $this->diaryService->restoration($id);
        
        return redirect('/trashListDisplay');
    }
}
