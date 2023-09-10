<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Http\Requests\PostRequest;
use App\Http\Services\DiaryService;
use Illuminate\Support\Facades\Storage;

class DiaryListController extends Controller
{
    
    private $diaryService;
    
    public function __construct(DiaryService $diaryService)
    {
        $this->diaryService = $diaryService;
    }
    
    
    public function diaryListDisplay(){

        $diarysCnt = $this->diaryService->getCnt();
        $data = $this->diaryService->getDiaries();

        return view('diaryList',compact('diarysCnt','data'));
    }

    public function delete($id){

        $this->diaryService->delete($id);

        return redirect('/diaryListDisplay');
    }

    public function edit($id){

        $data = $this->diaryService->edit($id);
        
        return view('editPost',compact('data'));
    }

    public function update(PostRequest $request,$id){
        
        $this->diaryService->update($request,$id);

        return redirect('/diaryListDisplay');
    }
}
