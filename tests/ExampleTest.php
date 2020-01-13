<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;

class ExampleTest extends TestCase
{
    public function testBasicExample()
    {
        $this->visit('/')->('投稿する');
    }
}