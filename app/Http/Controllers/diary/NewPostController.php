<?php

namespace App\Http\Controllers\diary;

use App\Http\Requests\PostRequest;
use App\Http\Services\DiaryService;

class NewPostController extends Controller
{
    private $diaryService;
    
    public function __construct(DiaryService $diaryService)
    {
        $this->diaryService = $diaryService;
    }
    
    public function newPost(){
        
        $today = $this->diaryService->getDateTime();

        return view('diary/newPost',compact('today'));
    }

    public function register(PostRequest $request){

        $this->diaryService->register($request);

        return redirect('/diary/list');
    }
}
