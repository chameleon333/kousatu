<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

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

    public function testDisplayFollowUserInUsers() 
    {   
        $followers = factory(App\Models\Follower::class,5)->create([
            'following_id' => 1,
        ]);

        $following_id = $followers[0]->following_id;
        $following_user = User::find($following_id);

        $response = $this->actingAs($following_user);
        $response = $response->get('/users/'.$following_user->id.'/following');

        foreach($followers as $follower) {
            $followed_user = User::find($follower->followed_id);
            $response->assertSeeText($followed_user->name);
            $response->assertSeeText($followed_user->screen_name);
        }
    }

    public function testDisplayFollowerUserInUsers() 
    {   
        $followers = factory(App\Models\Follower::class,5)->create([
            'followed_id' => 1,
        ]);

        $followed_id = $followers[0]->followed_id;
        $followed_user = User::find($followed_id);

        $response = $this->actingAs($followed_user);
        $response = $response->get('/users/'.$followed_user->id.'/followers');

        foreach($followers as $follower) {
            $following_user = User::find($follower->following_id);
            $response->assertSeeText($following_user->name);
            $response->assertSeeText($following_user->screen_name);
        }
    }

}
