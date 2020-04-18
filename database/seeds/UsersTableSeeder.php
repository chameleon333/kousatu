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
        'screen_name' => 'taro',
        'name'           => '山田太郎',
        'self_introduction'  => "私は山田太郎です。映画、小説、漫画。さまざまなコンテンツの考察を投稿します。",
        'profile_image'  => '/storage/profile_image/profile1.jpeg',
        'email'          => 'taro@gmail.com',
        'password'       => Hash::make('12345678'),
        'remember_token' => Str::random(10),
        'created_at'     => now(),
        'updated_at'     => now()
      ]);

      $faker = Faker::create('ja_JP');
      for ($i = 2; $i <= 10; $i++){
        $name = $faker->name;
        User::create([
          'screen_name' => $faker->unique()->regexify('\w{8}'),
          'name'           => $name,
          'self_introduction'  =>"私は".$name."です。映画、小説、漫画。さまざまなコンテンツの考察を投稿します。",
          'profile_image'  => '/storage/profile_image/profile'.$i.'.jpeg',
          'email'          => $faker->email,
          'password'       => Hash::make('12345678'),
          'remember_token' => Str::random(10),
          'created_at'     => now(),
          'updated_at'     => now()
        ]);
      }
    }
}
