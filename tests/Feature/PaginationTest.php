<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Favorite;
use App\Models\Article;
use App\Models\Tag;
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

    public function testArticle()
    {
        $response = $this->get('/articles');
        $response->assertSee('ユーザ一覧');
        // $response->dump();
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

    #検索時に記事が出るかテスト
    public function testSearchArticles() {
        $article = factory(Article::class)->create();
        $response = $this->post('/search',["keyword"=>$article->title]);
        $response->assertSee($article->title);
    }

    #ユーザーが人気順に出るかテスト
    public function testPopularUsers() {
        factory(Favorite::class,10)->create();

        for($i=0; $i < 5; $i++) {
            factory(Favorite::class,5-$i)->create([
                'article_id' => 1+$i,
            ]);
        }

        $user = User::all()->first();


        $popular_users = $user->getPopularUsers();
        foreach($popular_users as $popular_user) {
            $popular_user_name[] = $popular_user->name;
        }

        $response = $this->get('/articles');
        $response->assertSeeTextInOrder($popular_user_name);
    }


}

