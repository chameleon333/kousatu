<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

use Tests\TestCase;

class PaginationTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertLocation('/articles');
        // $response->assertStatus(302);
    }

    public function testArticle()
    {
        $response = $this->get('/articles');
        $response->assertSee('ユーザ一覧');
    }

    //ログイン時、記事投稿画面に遷移する
    public function testPostForm_inLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/articles/create');
        $response->assertSee('投稿する');
    }

    //ログアウト時、記事投稿画面に遷移した際、ログイン画面に遷移
    public function testPostForm_inLogout()
    {
        $response = $this->get('/articles/create');
        $response->assertLocation('/login');
    }




}

