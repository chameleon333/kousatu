<?php

use App\Models\Article;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoriteTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostLike()
    {
        #いいねできているかチェック
        $factory_user = factory(App\Models\User::class)->create();
        $article = factory(App\Models\Article::class)->create();
        $user_id = $factory_user->id;
        $article_id = $article->id;
        $response = $this->actingAs($factory_user);
        $response->post('/favorites', ['article_id' => $article_id]);
        $response->assertDatabaseHas('favorites', [
            'user_id' => $user_id,
            'article_id' => $article_id
        ]);

        #いいねを外せているかチェック
        $favorite = \App\Models\Favorite::where('user_id',$user_id)->where('article_id',$article_id)->first();
        $this->assertNotNull($favorite); // データが取得できたかテスト
        $favorite_id =$favorite->id;

        $response->delete('/favorites/'.$favorite_id);
        $response->assertDatabaseMissing('favorites', [
            'user_id' => $user_id,
            'article_id' => $article_id
        ]);
    }

    public function testDisplayFavoriteArticleInUsers()
    {
        $user_id = 1;
        $favorites = factory(App\Models\Favorite::class,5)->create([
            'user_id' => $user_id,
        ]);

        $favoriting_user = User::find($user_id);

        $response = $this->actingAs($favoriting_user);
        $response = $response->get('/users/'.$user_id.'/favorite');

        foreach($favorites as $favorite) {
            $favorite_article = Article::find($favorite->article_id);
            $response->assertSeeText($favorite_article->title);
        }
    }

    public function testNotDisplayFavoriteArticleInUsers()
    {
        $user_id = 1;
        $favorites = factory(App\Models\Favorite::class,5)->create([
            'user_id' => 2,
        ]);

        $favoriting_user = User::find($user_id);

        $response = $this->actingAs($favoriting_user);
        $response = $response->get('/users/'.$user_id.'/favorite');

        foreach($favorites as $favorite) {
            $favorite_article = Article::find($favorite->article_id);
            $response->assertDontSeeText($favorite_article->title);
        }
    }

}
