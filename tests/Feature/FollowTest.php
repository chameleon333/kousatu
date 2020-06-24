<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FollowTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

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

}
