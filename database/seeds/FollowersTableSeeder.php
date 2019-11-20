<?php

use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 10; $i++) {
            Follower::create([
                'following_id' => $i,
                'followed_id' => 1
            ]);
        }
    }
}
