<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Article;
use App\Models\Tag;


use Tests\TestCase;

class PaginationTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPaginationIndex()
    {
        $this->get('/')
            ->assertStatus(302);
    }
    public function testPaginationArticle()
    {
        $this->get('/articles')
            ->assertStatus(200);
    }

    public function testPaginationArticleShow()
    {
        $article = factory(Article::class)->create();

        $this->get("/articles/{$article->id}")
            ->assertStatus(200);
    }

    public function testPaginationArticleEdit()
    {
        $article = factory(Article::class)->create();
        $user = User::find($article->user_id);

        $this->actingAs($user)
            ->get("/articles/{$article->id}/edit")
            ->assertStatus(200);
    }

    public function testPaginationArticleCreate()
    {
        $article = factory(Article::class)->create();
        $user = User::find($article->user_id);

        $this->actingAs($user)
            ->get("/articles/create")
            ->assertStatus(200);
    }

    public function testPaginationUsers()
    {

        $this->get("/users")
            ->assertStatus(200);
    }

    public function testPaginationUsersShow()
    {
        $user = factory(User::class)->create();
        $this->get("/users/{$user->id}")
            ->assertStatus(200);
    }

    public function testPaginationUsersShowFollowing()
    {
        $user = factory(User::class)->create();
        $this->get("/users/{$user->id}/following")
            ->assertStatus(200);
    }

    public function testPaginationUsersShowFollowers()
    {
        $user = factory(User::class)->create();
        $this->get("/users/{$user->id}/followers")
            ->assertStatus(200);
    }

    public function testPaginationUsersShowFavorite()
    {
        $user = factory(User::class)->create();
        $this->get("/users/{$user->id}/favorite")
            ->assertStatus(200);
    }

    public function testPaginationUsersEdit()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get("/users/{$user->id}/edit")
            ->assertStatus(200);
    }

    public function testPaginationSearch()
    {
        $user = factory(User::class)->create();
        $this->get("/search?keyword=test")
            ->assertStatus(200);
    }

    public function testPaginationTag()
    {
        $tag = factory(Tag::class)->create();
        $this->get("/tags/{$tag->id}")
            ->assertStatus(200);
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
