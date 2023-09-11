<?php

namespace App\Http\Controllers\diary;

use App\Http\Requests\PostRequest;
use App\Http\Services\DiaryService;

class ListController extends Controller
{
    
    private $diaryService;
    
    public function __construct(DiaryService $diaryService)
    {
        $this->diaryService = $diaryService;
    }
    
    
    public function list(){

        $diarysCnt = $this->diaryService->getCnt();
        $data = $this->diaryService->getDiaries();

        return view('diary/list',compact('diarysCnt','data'));
    }

    public function delete($id){

        $this->diaryService->delete($id);

        return redirect('/diary/list');
    }

    public function edit($id){

        $data = $this->diaryService->edit($id);
        
        return view('diary/editPost',compact('data'));
    }

    public function update(PostRequest $request,$id){
        
        $this->diaryService->update($request,$id);

        return redirect('/diary/list');
    }
}
