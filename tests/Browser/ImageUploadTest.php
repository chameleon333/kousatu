<?php

// namespace Tests\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Storage;

class ImageUploadTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    #ajaxを使った/article/create内での画像POST処理
    public function testPostImage_in_article_create()
    {
        Storage::fake('post_images');
        $user = factory(App\Models\User::class)->create();
        $uploadedFile = UploadedFile::fake()->image('testImage.jpg');
        $uploadedFile->move('storage/framework/testing/disks/post_images');
        $filename = $uploadedFile->getFilename();
        $this->browse(function ($first) use ($user,$filename){
            $first->loginAs($user)
                  ->visit('/articles/create')
                  ->click('#editSection > div > div.te-toolbar-section > div.tui-editor-defaultUI-toolbar > button.tui-image.tui-toolbar-icons')
                  ->attach('.te-image-file-input','storage/framework/testing/disks/post_images/'.$filename)
                  ->click('#editSection > div > div.tui-popup-wrapper.te-popup-add-image.tui-editor-popup > div.tui-popup-body > div.te-button-section > button.te-ok-button')
                  ->screenshot('test')
                  ->assertSee('article_images/');
        });
    }

    #/register内でのプロフィール画像アップロードチェック
    public function testPostImage_in_register()
    {
        #プロフィール画像アップロード後valueに画像データが入っているかチェック
        Storage::fake('post_images');
        $uploadedFile = UploadedFile::fake()->image('testImage.jpg');
        $uploadedFile->move('storage/framework/testing/disks/post_images');
        $filename = $uploadedFile->getFilename();
        $this->browse(function ($first) use ($filename){
            $attribute = $first->visit('/register')
                  ->click('#avatar')
                  ->attach('.sr-only','storage/framework/testing/disks/post_images/'.$filename)
                  ->waitFor('#crop', 5)
                  ->screenshot('test')
                  ->click('#crop')
                  ->pause(1000)
                  ->attribute('#avatar', 'style');

                  $attribute = explode(',',$attribute);
                  $attribute = str_replace('");', '', $attribute[1]);

                  $first->assertInputValue('#binary_image', $attribute);
        });
    }

    public function testPostImage_in_users_edit()
    {
        Storage::fake('post_images');
        $user = factory(App\Models\User::class)->create();
        $uploadedFile = UploadedFile::fake()->image('testImage.jpg');
        $uploadedFile->move('storage/framework/testing/disks/post_images');
        $filename = $uploadedFile->getFilename();
        $this->browse(function ($first) use ($user,$filename){
            $attribute = $first->loginAs($user)
                ->visit('/users/'.$user->id."/edit")
                ->click('#avatar')
                ->attach('.sr-only','storage/framework/testing/disks/post_images/'.$filename)
                ->waitFor('#crop', 5)
                ->pause(2000) #cropがクリックできる状態まで待つ
                ->click('#crop')
                ->screenshot('test')
                ->attribute('#avatar', 'style');
                $attribute = explode(',',$attribute);
                $attribute = str_replace('");', '', $attribute[1]);
                $first->assertInputValue('#binary_image', $attribute);
        });
    }
}
