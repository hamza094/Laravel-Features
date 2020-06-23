<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'admin',
            'email'=>'wells_pisces@live.com',
            'password'=>bcrypt('runberryrun'),
            'img'=>'https://openclipart.org/image/2400px/svg_to_png/261880/Cartoon-Man-Avatar.png',
            'is_activated'=>1,
            'admin'=>1,
            'api_token'=>str_random(60)
        ]);
    }
}
