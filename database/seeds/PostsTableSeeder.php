<?php

use Illuminate\Database\Seeder;
use App\Post;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $post = new Post;

            $post->fill([
                'user_id' => 1,
                'caption' =>  '4番目のキャプション',
                'photo' =>   '1.jpg',
            ]);
            $post->save();
            $post = new Post;

            $post->fill([
                'user_id' => 1,
                'caption' => '5番目のキャプション',
                'photo' =>   '2.jpg',
            ]);
            $post->save();
            $post = new Post;

            $post->fill([
                'user_id' => 1,
                'caption' => '6番目のキャプション',
                'photo' =>  '3.jpg',
            ]);
            $post->save();

        
    }
}
