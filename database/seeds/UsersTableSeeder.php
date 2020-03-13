<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      #簡単ログイン用 ユーザー作成
      User::create([
        'screen_name' => 'test1@test.com',
        'name'           => 'test1',
        'profile_image'  => 'storage/profile_image/profile1.jpeg',
        'email'          => 'test1@test.com',
        'password'       => Hash::make('12345678'),
        'remember_token' => Str::random(10),
        'created_at'     => now(),
        'updated_at'     => now()
      ]);

      $faker = Faker::create('ja_JP');
      for ($i = 1; $i <= 10; $i++){
        User::create([
          'screen_name' => $faker->unique()->regexify('\w{8}'),
          'name'           => $faker->name,
          'profile_image'  => 'storage/profile_image/profile'.$i.'.jpeg',
          'email'          => $faker->email,
          'password'       => Hash::make('12345678'),
          'remember_token' => Str::random(10),
          'created_at'     => now(),
          'updated_at'     => now()
        ]);
      }
    }
}
