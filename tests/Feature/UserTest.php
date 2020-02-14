<?php

use Tests\TestCase;
use App\Models\Article;
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

        #アップロードしたプロフィールデータがDBにあるかテスト
        $factory_userA = factory(App\Models\User::class)->make();
        $testUserNameA = $factory_userA->screen_name;
        $testEmailA = $factory_userA->email;

        $this->post('/register', ['screen_name' => $testUserNameA, 'email' => $testEmailA, 'password' => $testPassword, 'password_confirmation' => $testPassword]);
        $this->assertDatabaseHas('users', [
            'screen_name' => $testUserNameA,
            'email' => $testEmailA
        ]);
        $Bad_testUserName = "testUserばっとてすと@";
        $factory_userB = factory(App\Models\User::class)->make();
        $testEmailB = $factory_userB->email;

        #不正な形式のユーザー名が登録されないかテスト
        $this->post('/register', ['screen_name' => $Bad_testUserName, 'email' => $testEmailB, 'password' => $testPassword, 'password_confirmation' => $testPassword]);
        $this->assertDatabaseMissing('users', [
            'screen_name' => $Bad_testUserName,
            'email' => $testEmailB
        ]);
        $factory_userC = factory(App\Models\User::class)->make();
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
        $testName = $factory_user_update->screen_name;
        $testEmail = $factory_user_update->email;

        // $testUserName = "testUser";
        // $testName = "テスト";
        // $testEmail = "test@test.com";
        $response->put('/users/'.$user_id, ['screen_name' => $testUserName, 'name' => $testName, 'email' => $testEmail]);
        $response->assertDatabaseHas('users', [
            'id' => $user_id,
            'screen_name' => $testUserName,
            'name' => $testName,
            'email' => $testEmail
        ]);

        $Bad_testUserName = "testUserばっとてすと@";

        #不正な形式のプロフィールが登録されないかテスト
        $response->put('/users/'.$user_id, ['screen_name' => $Bad_testUserName, 'name' => $testName, 'email' => $testEmail]);
        $response->assertDatabaseMissing('users', [
            'id' => $user_id,
            'screen_name' => $Bad_testUserName,
            'name' => $testName,
            'email' => $testEmail
        ]);
    }

    public function testPostArticle()
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

        $response->post('/articles', ['title' => $testTitle, 'body' => $testBody]);
        $response->assertDatabaseHas('articles', [
            'title' => $testTitle,
            'body' => $testBody
        ]);

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

    
}
