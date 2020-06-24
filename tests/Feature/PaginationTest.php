<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;


use Tests\TestCase;

class PaginationTest extends TestCase
{

    use DatabaseMigrations;

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

    // //ログイン時、記事投稿画面に遷移する
    public function testPostFormInLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/articles/create');
        $response->assertSee('投稿する');
    }

    //ログアウト時、記事投稿画面に遷移した際、ログイン画面に遷移
    public function testPostFormInLogout()
    {
        $response = $this->get('/articles/create');
        $response->assertLocation('/login');
    }


}

