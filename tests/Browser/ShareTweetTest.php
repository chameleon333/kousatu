<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;


class ShareTweetTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testShareArticle()
    {
        $article = factory(Article::class)->create();
        $tag = factory(Tag::class)->create();
        $article->tags()->attach($tag->id);

        $this->browse(function ($browser) use ($article,$tag){

            $selector = '#twitterShare';
            $browser->loginAs($article)
                    ->visit("/articles/{$article->id}");

            $browser->waitFor($selector)
                    ->assertSourceHas("hashtags={$tag->name}")
                    ->assertSourceHas("text={$article->title}");

        });



    }
}
