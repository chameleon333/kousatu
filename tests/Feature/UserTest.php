<?php

use App\Models\Favorite;
use App\Models\User;

use Tests\TestCase;
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
    
    public function testIsDisplayUserEditByLoginUser() {
        $user_a = factory(App\Models\User::class)->create();
        $user_b = factory(App\Models\User::class)->create();

        $user_ids = [$user_a->id,$user_b->id];

        foreach($user_ids as $user_id) {
            $article = factory(App\Models\Article::class)->create([
                "user_id" => $user_id,
            ]);    
        }
        $this->actingAs($user_a)
             ->get("/users/{$user_a->id}")
             ->assertSee("プロフィールを編集する")
             ->assertSee("公開中")
             ->assertSee("fa-ellipsis-v");

        $this->actingAs($user_a)
             ->get("/users/{$user_b->id}")
             ->assertDontSee("プロフィールを編集する")
             ->assertDontSee("公開中")
             ->assertDontSee("fa-ellipsis-v");
    }

    public function testIsDisplayUserEditByNoLoginUser() {
        $user = factory(App\Models\User::class)->create();
        $this->get("/users/{$user->id}")
             ->assertDontSee("プロフィールを編集する")
             ->assertDontSee("公開中")
             ->assertDontSee("fa-ellipsis-v");
    }

    #総合いいね数が多い順にユーザーが出るかテスト
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
