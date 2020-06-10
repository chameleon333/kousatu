<?php

use Tests\TestCase;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
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

    public function testPostFollow()
    {
        #フォローテスト
        $factory_userA = factory(App\Models\User::class)->create();
        $factory_userB = factory(App\Models\User::class)->create();
        $user_idA= $factory_userA->id;
        $user_idB= $factory_userB->id;

        $response = $this->actingAs($factory_userA);
        $response->post('/users/'.$user_idB.'/follow');
        $response->assertDatabaseHas('followers', [
            'following_id' => $user_idA,
            'followed_id' => $user_idB
        ]);

        $response->delete('/users/'.$user_idB.'/unfollow');
        $response->assertDatabaseMissing('followers', [
            'following_id' => $user_idA,
            'followed_id' => $user_idB
        ]);
    }

    #ユーザー登録テスト
    public function testRegisterUserProfile()
    {
        $testPassword = "123456789";

        # 正常系テスト

        ## アップロードしたプロフィールデータがDBにあるかテスト
        $factory_userA = factory(App\Models\User::class)->create();
        $testUserNameA = $factory_userA->screen_name;
        $testEmailA = $factory_userA->email;

        $this->post('/register', ['screen_name' => $testUserNameA, 'email' => $testEmailA, 'password' => $testPassword, 'password_confirmation' => $testPassword]);
        $this->assertDatabaseHas('users', [
            'screen_name' => $testUserNameA,
            'email' => $testEmailA
        ]);

        ## 不正な形式のユーザー名が登録されないかテスト
        $Bad_testUserName = "testUserばっとてすと@";
        $factory_userB = factory(App\Models\User::class)->create();
        $testEmailB = $factory_userB->email;

        $this->post('/register', ['screen_name' => $Bad_testUserName, 'email' => $testEmailB, 'password' => $testPassword, 'password_confirmation' => $testPassword]);
        $this->assertDatabaseMissing('users', [
            'screen_name' => $Bad_testUserName,
            'email' => $testEmailB
        ]);
        $factory_userC = factory(App\Models\User::class)->create();
        $testUserNameC = $factory_userC->screen_name;
        $Bad_testEmail = "testUserばっとてすと@";

        #不正な形式のメールアドレスが登録されないかテスト
        $this->post('/register', ['screen_name' => $testUserNameC, 'email' => $Bad_testEmail, 'password' => $testPassword, 'password_confirmation' => $testPassword]);
        $this->assertDatabaseMissing('users', [
            'screen_name' => $testUserNameC,
            'email' => $Bad_testEmail
        ]);
    }

    public function testUpdateUserProfile()
    {
        #アップロードしたプロフィールデータがDBにあるかテスト
        $factory_user = factory(App\Models\User::class)->create();
        $response = $this->actingAs($factory_user);
        $user_id = $factory_user->id;


        #アップデート用のプロフィールデータを生成する
        $factory_user_update = factory(App\Models\User::class)->make();
        $testUserName = $factory_user_update->screen_name;
        $testName = $factory_user_update->name;
        $testEmail = $factory_user_update->email;
        $testSelfIntroduction = $factory_user_update->self_introduction;

        $response->put('/users/'.$user_id, ['screen_name' => $testUserName, 'name' => $testName, 'email' => $testEmail, 'self_introduction' => $testSelfIntroduction]);
        $response->assertDatabaseHas('users', [
            'id' => $user_id,
            'screen_name' => $testUserName,
            'name' => $testName,
            'email' => $testEmail,
            'self_introduction' => $testSelfIntroduction
        ]);

        $Bad_testUserName = "testUserばっとてすと@";

        #不正な形式のプロフィールが登録されないかテスト
        $response->put('/users/'.$user_id, ['screen_name' => $Bad_testUserName, 'name' => $testName, 'email' => $testEmail, 'self_introduction' => $testSelfIntroduction]);
        $response->assertDatabaseMissing('users', [
            'id' => $user_id,
            'screen_name' => $Bad_testUserName,
            'name' => $testName,
            'email' => $testEmail,
            'self_introduction' => $testSelfIntroduction
        ]);
    }

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
        foreach($testTags as $testTag){
            $response->assertDatabaseHas('tags', [
                'name' => $testTag,
            ]);
            $tag_id = Tag::select('id')->where("name",$testTag)->first();
            $tag_ids[] = $tag_id->id;
        }

        #登録したカテゴリーが中間テーブルに保存されているかテスト
        foreach($tag_ids as $tag_id){
            $response->assertDatabaseHas('article_tag',['tag_id' => $tag_id]);
        }

        #不正な形式の記事が登録されないかテスト
        #タイトル0文字または３1文字以上の記事が投稿されないかテスト
        $lengths = [0,31];
        foreach($lengths as $length) {
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
        ->each(function(Article $article){
            $article->tags()->saveMany(factory(Tag::class, rand(0,5)))->create();

            $tags = Tag::all();
            $tag_ids = [];
            foreach($tags as $tag) {
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
        foreach($testTags as $testTag){
            $response->assertDatabaseHas('tags', [
                'name' => $testTag,
            ]);
            $tag_id = Tag::select('id')->where("name",$testTag)->first();
            $tag_ids[] = $tag_id->id;
        }

        #登録したカテゴリーが中間テーブルに保存されているかテスト
        foreach($tag_ids as $tag_id){
            $response->assertDatabaseHas('article_tag',[
                'article_id' => $factory_article,
                'tag_id' => $tag_id
            ]);
        }

        #不正な形式の記事が登録されないかテスト
        #タイトル0文字または３1文字以上の記事が投稿されないかテスト
        $lengths = [0,31];
        foreach($lengths as $length) {
            $Bad_testTitle = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);

            $response->post('/articles', ['title' => $Bad_testTitle, 'body' => $testBody]);
            $response->assertDatabaseMissing('articles', [
                'title' => $Bad_testTitle,
                'body' => $testBody
            ]);
        }
    }

    public function testCheckIsArticlePublic(){
        $user = factory(App\Models\User::class)->create();
        $article = factory(App\Models\Article::class)->create([
            "user_id" => $user->id,
            'status' => 0,
        ]);

        $response = $this->actingAs($user);
        $response = $this->get('/articles');
        $response->assertSee($article->title);
        $response = $this->get('users/'.$article->user_id);
        $response->assertSee($article->title);  

        # 下書きに表示されないことをチェック
        $response = $this->get('users/'.$article->user_id."?status=1");
        $response->assertDontSee($article->title);

    }

    public function testCheckIsArticleDraft(){
        $user = factory(App\Models\User::class)->create();
        $article = factory(App\Models\Article::class)->create([
            "user_id" => $user->id,
            'status' => 1,
        ]);

        $response = $this->actingAs($user);
        $response = $this->get('users/'.$article->user_id."?status=1");
        $response->assertSee($article->title);

        # 記事が公開されていないようチェック
        $response = $this->get('/articles');
        $response->assertDontSee($article->title);
        $response = $this->get('users/'.$article->user_id);
        $response->assertDontSee($article->title);

    }

    # 記事を第三者からチェック
    public function testCheckIsArticleByOutsider(){
        $creater_user = factory(App\Models\User::class)->create();
        $outsider_user = factory(App\Models\User::class)->create();

        # 公開記事が確認できるか
        $public_artile = factory(App\Models\Article::class)->create([
            "user_id" => $creater_user->id,
            'status' => 0,
        ]);
        $response = $this->actingAs($outsider_user);
        $response = $this->get('users/'.$public_artile->user_id);
        $response->assertSee($public_artile->title);

        # 下書き記事が見れないようになっているか
        $draft_article = factory(App\Models\Article::class)->create([
            "user_id" => $creater_user->id,
            'status' => 1,
        ]);
        $response = $this->actingAs($outsider_user);
        $response = $this->get('users/'.$draft_article->user_id."?status=1");
        $response->assertDontSee($draft_article->title);
    }
    
}
