<?php

// namespace Tests\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

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
        $user = factory(App\Models\User::class)->create();
        $uploadedFile = UploadedFile::fake()->image('testImage.png');
        $uploadedFile->move('tests/data');
        $filename = $uploadedFile->getFilename();

        $this->browse(function ($first) use ($user){
            $first->loginAs($user)
                  ->visit('/articles/create')
                  ->click('#editSection > div > div.te-toolbar-section > div.tui-editor-defaultUI-toolbar > button')
                  ->attach('.te-image-file-input','/var/www/tests/data/testImage.png')
                  ->click('#editSection > div > div.tui-popup-wrapper.te-popup-add-image.tui-editor-popup > div.tui-popup-body > div.te-button-section > button.te-ok-button')
                  ->screenshot('test')
                  ->assertSee('/storage/post_image/');
        });
    }
}
