<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\Tag;

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

        $articles = factory(Article::class,12)->create();

        $this->browse(function (Browser $browser) use ($articles){
            $browser->visit('/articles')
                    ->waitForText($articles[0]->title)
                    ->driver->executeScript('window.scrollTo(0, 500);'); 
            
            $browser->waitForText($articles[11]->title);

            foreach($articles as $article) {
                $browser->assertSee($article->title);
            }
        });
    }

    public function testInfinite_scrolling_in_tags_show()
    {
        $tag = factory(Tag::class)->create();
        $articles = factory(Article::class,12)->create();

        foreach($articles as $article) {
            $article->tags()->attach($tag->id);
        }

        $this->browse(function (Browser $browser) use ($articles,$tag){
            $browser->visit("/tags/{$tag->id}") 
                ->waitForText($articles[0]->title)
                ->driver->executeScript('window.scrollTo(0, 500);'); 
            $browser->waitForText($articles[11]->title);

            foreach($articles as $article) {
                $browser->assertSee($article->title);
            }
        });
    }

    public function testHidden_article_infinite_scrolling_in_article_index()
    {

        $articles = factory(Article::class,12)->create([
            "status"=> 1
        ]);

        $this->browse(function (Browser $browser) use ($articles){
            $browser->visit('/articles')
                    ->waitUntilMissing('div.infinite-loading-container > div:nth-child(1) > i')
                    ->driver->executeScript('window.scrollTo(0, 500);'); 
            foreach($articles as $article) {
                $browser->assertDontSee($article->title);
            }
        });
    }

    public function testHidden_article_infinite_scrolling_in_tags_show()
    {
        $tag = factory(Tag::class)->create();
        $articles = factory(Article::class,12)->create([
            "status" => 1
        ]);

        foreach($articles as $article) {
            $article->tags()->attach($tag->id);
        }

        $this->browse(function (Browser $browser) use ($articles,$tag){
            $browser->visit("/tags/{$tag->id}") 
                    ->waitUntilMissing('div.infinite-loading-container > div:nth-child(1) > i')
                    ->driver->executeScript('window.scrollTo(0, 500);'); 
            
            foreach($articles as $article) {
                $browser->assertDontSee($article->title);
            }
        });
    }
}
