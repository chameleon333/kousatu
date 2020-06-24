<?php

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    #検索時に記事が出るかテスト
    public function testSearchArticles() {
        $article = factory(Article::class)->create();
        $response = $this->post('/search',["keyword"=>$article->title]);
        $response->assertSee($article->title);
    }
}
