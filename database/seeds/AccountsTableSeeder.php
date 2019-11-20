<?php

use Illuminate\Database\Seeder;

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
          'remember_token' => str_random(10),
          'created_at' => now(),
          'updated_at' => now()
        ]);
      }
    }
}