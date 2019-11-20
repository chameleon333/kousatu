<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//      $this->call(ArticlesTableSeeder::class);
      $this->call([
//        AccountsTableSeeder::class,
        ArticlesTableSeeder::class,
        CommentsTableSeeder::class,
        FavaritesTableSeeder::class,
        FollowersTableSeeder::class,
        Article_stockTableSeeder::class,
      ]);
    }
}
