<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FollowTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testFollowInUser()
    {
        $user_list = factory(App\Models\User::class, 2)->create();
        $selector = "div.d-flex.justify-content-end.flex-grow-1.w-25 > div > button";

        $this->browse(function ($first) use ($user_list, $selector) {
            $first->loginAs($user_list[0])
                ->visit("/users/")
                ->screenshot("follow")
                ->waitFor($selector)
                ->click($selector)
                ->waitForText('フォロー解除')
                ->assertSeeIn($selector, "フォロー解除")
                ->click($selector)
                ->waitUntilMissingText("フォロー解除")
                ->assertSourceHas('<button type="submit" class="btn btn-primary">フォロー</button>');
        });
    }

    public function testFollowInUserShow()
    {
        $user_list = factory(App\Models\User::class, 2)->create();
        $selector = "div.mx-3.mb-3.d-flex.flex-column > div:nth-child(1) > div > button";

        $this->browse(function ($first) use ($user_list, $selector) {
            $first->loginAs($user_list[0])
                ->visit("/users/{$user_list[1]->id}")
                ->waitFor($selector)
                ->click($selector)
                ->waitForText('フォロー解除')
                ->assertSeeIn($selector, "フォロー解除")
                ->click($selector)
                ->waitUntilMissingText("フォロー解除")
                ->assertSourceHas('<button type="submit" class="btn btn-primary">フォロー</button>');
        });
    }
}
