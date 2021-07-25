<?php

use App\Models\Article;
use App\Models\Favorite;
use App\Models\Tag;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    // use DatabaseMigrations;
    // use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCreateArticle()
    {
        #アップロードした記事データがDBにあるかテスト
        $factory_user = factory(App\Models\User::class)->create();

        $response = $this->actingAs($factory_user);

        $user_id = $factory_user->id;
        $testTitle = "テストタイトル";
        $testBody = "# テストh1
## テストタイトルh2
- テストリスト
- テストリスト
- テストリスト
- テストリスト";

        $testTags = ["テスト1","テスト2","テスト3","テスト4","テスト5"];
        $response->post('/articles', ['title' => $testTitle, 'body' => $testBody,'tags' => $testTags, 'article_status_id' => 0]);
        $response->assertDatabaseHas('articles', [
            'title' => $testTitle,
            'body' => $testBody,
        ]);

        #登録したタグ名が登録テーブルに登録されているかテスト
        foreach ($testTags as $testTag) {
            $response->assertDatabaseHas('tags', [
                'name' => $testTag,
            ]);
            $tag_id = Tag::select('id')->where("name", $testTag)->first();
            $tag_ids[] = $tag_id->id;
        }

        #登録したカテゴリーが中間テーブルに保存されているかテスト
        foreach ($tag_ids as $tag_id) {
            $response->assertDatabaseHas('article_tag', ['tag_id' => $tag_id]);
        }

        #不正な形式の記事が登録されないかテスト
        #タイトル0文字または３1文字以上の記事が投稿されないかテスト
        $lengths = [0,31];
        foreach ($lengths as $length) {
            $Bad_testTitle = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);

            $response->post('/articles', ['title' => $Bad_testTitle, 'body' => $testBody]);
            $response->assertDatabaseMissing('articles', [
                'title' => $Bad_testTitle,
                'body' => $testBody
            ]);
        }
    }

    public function testUpdateArticle()
    {
        #更新した記事データがDBにあるかテスト
        $factory_user = factory(App\Models\User::class)->create();

        $factory_article = factory(Article::class)
        ->create(["user_id" => $factory_user->id,])
        ->each(function (Article $article) {
            $article->tags()->saveMany(factory(Tag::class, rand(0, 5)))->create();

            $tags = Tag::all();
            $tag_ids = [];
            foreach ($tags as $tag) {
                $tag_ids[] = $tag->id;
            }
            $article->articleTagSync($tag_ids);
        });

        $response = $this->actingAs($factory_user);

        $user_id = $factory_user->id;
        $testTitle = "テストタイトル";
        $testBody = "# テストh1
## テストタイトルh2
- テストリスト
- テストリスト
- テストリスト
- テストリスト";

        $testTags = ["テスト1","テスト2","テスト3","テスト4","テスト5"];
        $response->put("/articles/{$factory_article}", [ 'title' => $testTitle, 'body' => $testBody,'tags' => $testTags,'article_status_id' => 0]);
        $response->assertDatabaseHas('articles', [
            'title' => $testTitle,
            'body' => $testBody,
        ]);

        #登録したタグ名が登録テーブルに登録されているかテスト
        foreach ($testTags as $testTag) {
            $response->assertDatabaseHas('tags', [
                'name' => $testTag,
            ]);
            $tag_id = Tag::select('id')->where("name", $testTag)->first();
            $tag_ids[] = $tag_id->id;
        }

        #登録したカテゴリーが中間テーブルに保存されているかテスト
        foreach ($tag_ids as $tag_id) {
            $response->assertDatabaseHas('article_tag', [
                'article_id' => $factory_article,
                'tag_id' => $tag_id
            ]);
        }

        #不正な形式の記事が登録されないかテスト
        #タイトル0文字または３1文字以上の記事が投稿されないかテスト
        $lengths = [0,31];
        foreach ($lengths as $length) {
            $Bad_testTitle = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);

            $response->post('/articles', ['title' => $Bad_testTitle, 'body' => $testBody]);
            $response->assertDatabaseMissing('articles', [
                'title' => $Bad_testTitle,
                'body' => $testBody
            ]);
        }
    }

    #いいねが多い順に記事が出るかテスト
    public function testPopularArticles()
    {
        factory(Favorite::class, 6)->create();

        $create_count = 5;
        for ($i=0; $i < $create_count; $i++) {
            factory(Favorite::class, $create_count-$i)->create([
                'article_id' => 1+$i,
            ]);
        }
        $expected = Article::all()->first()->getPopularArticles()->pluck('id')->all();

        $this->get('/fetch?mode=popular')->assertSeeTextInOrder($expected);
    }


    #最新順に記事が出るかテスト
    public function testTimelineArticles()
    {
        for ($i=0; $i < 6; $i++) {
            usleep(100000);
            factory(Article::class)->create();
        }
        $expected = Article::latest()->get()->pluck("id")->take(6)->all();
        $this->get('/fetch')->assertSeeTextInOrder($expected);
    }
}
