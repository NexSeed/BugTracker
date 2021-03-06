<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\http_support()
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Article;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UsersTableSeeder');
        $this->call('ArticlesTableSeeder');

        Model::reguard();
    }

    /**
    * 
    */
}

/**
*  
*/
class UsersTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'root',
            'email' => 'root@sample.com',
            'password' => bcrypt('password')
        ]);
        
        User::create([
            'name' => 'yuuukaaa',
            'email' => 'yukahakoko@gmail.com',
            'password' => bcrypt('123456')
        ]);
        
        User::create([
            'name' => 'ユーザ3',
            'email' => 'y8011@yahoo.co.jp',
            'password' => bcrypt('123456')
        ]);
    }
}

class ArticlesTableSeeder extends Seeder
{
    
    function run()
    {
    
        DB::table('articles')->delete();

        $user = User::all()->first();
        $faker = Faker::create('en_US');

        for($i=0;$i < 10; $i++) {
            // Article::create([
            //     'title' => $faker->sentence(),
            //     'body' => $faker->paragraph(),
            //     'published_at' => Carbon::today()

            // ]);

            $article = new Article([
                'title' => $faker->sentence(),
                'body' => $faker->paragraph(),
                'urgency' => 'A',
                'system' => 'テスト',
                'type' => 'Proposal',
                
            ]);
            $user->articles()->save($article);  // $userと関連づけて$articleを保存
        }
    }
}

