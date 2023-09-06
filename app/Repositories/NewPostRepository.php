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
            'img_id' => 'test',
            'delete_flg' => '0',
        ]);
    }
}