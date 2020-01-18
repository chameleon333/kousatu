<?php

// namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function testPostLike()
    {
        #いいねできているかチェック
        $factory_user = factory(App\Models\User::class)->create();
        $article = factory(App\Models\Article::class)->create();
        $user_id = $factory_user->id;
        $article_id = $article->id;
        $response = $this->actingAs($factory_user);
        // $response->get('/articles/'.$id);
        $response->post('/favorites', ['article_id' => $article_id]);
        $response->assertDatabaseHas('favorites', [
            'user_id' => $user_id,
            'article_id' => $article_id
        ]);

        #いいねを外せているかチェック
        // SELECT
        $favorite = \App\Models\Favorite::where('user_id',$user_id)->where('article_id',$article_id)->first();
        $this->assertNotNull($favorite); // データが取得できたかテスト
        $favorite_id =$favorite->id;

        $response->delete('/favorites/'.$favorite_id);
        $response->assertDatabaseMissing('favorites', [
            'user_id' => $user_id,
            'article_id' => $article_id
        ]);
    }


}
