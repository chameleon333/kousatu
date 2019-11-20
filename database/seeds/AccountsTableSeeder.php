<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 1; $i <= 10; $i++){
        Account::create([
          'account_id' => 'test_user'. $i,
          'email' => 'test'.$i.'@test.com',
          'password' => Hash::make(12345678),
          'profile_image' => 'https://placehold.jp/50x50.png',
//          'remember_token' => str_random(10),
          'remember_token' => Str::random(10),
          'created_at' => now(),
          'updated_at' => now()
        ]);
      }
    }
}