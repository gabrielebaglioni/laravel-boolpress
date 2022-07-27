<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

class PostUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::where('user_id', null)->get();
        foreach($posts as $post){
           $user = User::inRandomOrder()->first();
           $post->user_id = $user->id;
           $post->save();
           

        }
    }
}
