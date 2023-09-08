<?php

namespace App\Repositories;

use App\Models\Diary;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class NewPostRepository
{
    public function insertDiary(PostRequest $request)
    {
        $diary = new Diary();
        
        $diary->create([
            'date' => $request->date,
            'content' => $request->content,
            'img_path' => $request->img_path,
            'delete_flg' => '0',
        ]);
    }
}