<?php

use Illuminate\Database\Seeder;
use App\Models\Follower;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 9; $i++) {
            $n = $i + 1;
            Follower::create([
                'following_id' => 'test_user'. $i,
                'followed_id' => 'test_user'. $n,
            ]);
        }
    }
}
