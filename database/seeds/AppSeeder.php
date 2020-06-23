<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           App\Article::create([
            'title'=>'Modern web development',
            'slug'=>str_slug('Modern web development'),
            'content'=>'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas beatae fugiat maxime vel autem voluptatibus porro atque libero voluptatum. Repellat est consequuntur cumque, voluptates, perspiciatis asperiores doloremque. Architecto, dolore commodi, unde dolor facere obcaecati illo at temporibus explicabo, eveniet quidem ducimus maiores perferendis id necessitatibus perspiciatis sequi, non iusto error odio fugit consequatur debitis nam. Libero neque deleniti cum et! Doloremque excepturi debitis tempore, ad in incidunt obcaecati. Nostrum reiciendis repudiandae odit neque aut adipisci maiores placeat pariatur voluptatum cum.',
            'img'=>'https://i2.wp.com/robotechlabs.com/wp-content/uploads/2018/07/Web-Development-Workshop.jpg?fit=1920%2C1080',
            'category_id'=>'1',
            'user_id'=>'1',
            ]);
        
              App\Category::create([
            'title'=>'Web Development',
             ]);
        
              App\Tag::create([
            'name'=>'tec',
        ]);
    }
}
