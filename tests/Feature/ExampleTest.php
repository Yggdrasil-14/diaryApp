<?php

namespace Tests\Feature;

use App\Models\Diary;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use DatabaseMigrations;

    //画面遷移テスト
    public function test画面遷移()
    {
        //一覧画面
        $response = $this->get('/');
        $response->assertStatus(302);

        //一覧画面
        $response = $this->get('/diary/list');
        $response->assertStatus(200)->assertViewIs('diary.list');

        //新規投稿画面
        $response = $this->get('/diary/newPost');
        $response->assertStatus(200)->assertViewIs('diary.newPost');

        //ゴミ箱画面
        $response = $this->get('/diary/trash');
        $response->assertStatus(200)->assertViewIs('diary.trash');

        //編集画面
        //1レコード作成して編集画面への遷移テスト
        $diary = Diary::factory()->create();
        $response = $this->get('/diary/edit/'.$diary->id);
        $response->assertStatus(200)->assertViewIs('diary.editPost');

    }

    // 日記作成テスト
    public function test日記作成()
    {
        $diary = Diary::factory()->make();
        
        $response = $this->post('/diary/newPost', $diary->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('diaries', ['id' => $diary->id]);
    }

    // 日記取得テスト
    public function test日記取得()
    {
        $diaryRec1 = Diary::factory()->create();
        $diaryRec2 = Diary::factory()->create(['id' => 2,'content' => 'test02']);
        
        $response = $this->get('/diary/list');
        $response->assertStatus(200)->assertViewIs('diary.list')->assertSee($diaryRec1->content)->assertSee('test02');
        $this->assertDatabaseHas('diaries', ['id' => $diaryRec1->id]);
        $this->assertDatabaseHas('diaries', ['id' => 2]);
    }

    // 日記更新テスト
    public function test日記更新()
    {
        $diary = Diary::factory()->create();
        $diary = Diary::factory()->make();
        $diary->content = 'test02';
        
        $response = $this->post('/diary/update/'.$diary->id, $diary->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('diaries', ['id' => $diary->id]);
    }

    // 日記削除（delete_flgの更新）テスト
    public function test日記削除（delete_flgの更新）()
    {
        $diary = Diary::factory()->create();

        $response = $this->get('/diary/delete/'.$diary->id);
        $response->assertStatus(302);
        $this->assertDatabaseHas('diaries', ['delete_flg' => 1]);
    }

    // 日記削除（レコード削除）テスト
    public function test日記削除（レコード削除）()
    {
        $diary = Diary::factory()->create();

        $response = $this->get('/diary/destroy/'.$diary->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('diaries', ['id' => $diary->id]);
    }

    // 日記復元（delete_flgの更新）テスト
    public function test日記復元()
    {
        $diary = Diary::factory()->set('delete_flg', 1)->create();

        $response = $this->get('/diary/restoration/'.$diary->id);
        $response->assertStatus(302);
        $this->assertDatabaseHas('diaries', ['delete_flg' => 0]);
    }
}
