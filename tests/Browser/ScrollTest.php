<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;

class ScrollTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testInfinite_scrolling_in_article_index()
    {

        for($i = 0; $i < 12; $i++){
            $article = factory(Article::class)->create();
            $articles[] = $article;
        }


        $this->browse(function (Browser $browser) use ($articles){
            $browser->visit('/articles')
                    ->waitForText($articles[0]->title)
                    ->driver->executeScript('window.scrollTo(0, 500);'); 
                    
            $browser->waitForText($articles[11]->title)
                    ->assertSee($articles[0]->title)
                    ->assertSee($articles[1]->title)
                    ->assertSee($articles[2]->title)
                    ->assertSee($articles[3]->title)
                    ->assertSee($articles[4]->title)
                    ->assertSee($articles[5]->title)
                    ->assertSee($articles[6]->title)
                    ->assertSee($articles[7]->title)
                    ->assertSee($articles[8]->title)
                    ->assertSee($articles[9]->title)
                    ->assertSee($articles[10]->title)
                    ->assertSee($articles[11]->title);
        });
        

    }
}
