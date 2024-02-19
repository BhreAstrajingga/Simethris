<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT',
                'slug' => 'lorem_ipsum_sit',
                'img_cover' => NULL,
                'creator_id' => 1,
                'created_at' => '2022-11-07 08:16:33',
                'updated_at' => NULL,
                'published_at' => '2022-10-07 08:16:33',
                'deleted_at' => NULL,
                'body' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus quis sem diam. Sed commodo metus in ultrices consequat. Vestibulum eu orci ante. Mauris vel tincidunt mauris. Cras finibus, purus eu pharetra molestie, orci felis lacinia orci, ac congue quam turpis a nibh
 
 Nam viverra diam magna, eget lobortis orci tincidunt sed. Donec et lobortis est. Morbi eget massa est. In iaculis odio lectus, sed efficitur nunc viverra non. Nullam molestie eros magna, eu posuere mauris posuere sit amet. Pellentesque hendrerit condimentum ipsum, euismod ornare lectus pharetra eget. Praesent semper est erat, commodo mollis arcu efficitur vitae. Maecenas gravida sit amet nisi vel interdum.
 
 Vestibulum molestie, ipsum vitae feugiat lacinia, nisi magna accumsan velit, ac semper nisi felis vitae augue. Vivamus mattis quis erat eu gravida. Integer venenatis risus vitae ullamcorper cursus. Proin sodales odio sed aliquet pulvinar. Duis ipsum erat, ultricies a dolor non, tempor dictum ante. <br> Morbi vel metus lectus',
                'exerpt' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus quis sem diam.',
                'tags' => '#1 tag',
                'category_id' => 2,
                'visibility' => 1,
                'is_published' => 1,
                'is_deleted' => 1,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'VESTIBULUM ANTE',
                'slug' => 'vestibulum_ante',
                'img_cover' => NULL,
                'creator_id' => 1,
                'created_at' => '2022-12-07 08:16:33',
                'updated_at' => NULL,
                'published_at' => '2022-10-07 08:16:33',
                'deleted_at' => NULL,
                'body' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus quis sem diam. Sed commodo metus in ultrices consequat. Vestibulum eu orci ante. Mauris vel tincidunt mauris. Cras finibus, purus eu pharetra molestie, orci felis lacinia orci, ac congue quam turpis a nibh',
                'exerpt' => 'Ultrices posuere cubilia Curae; Phasellus quis sem diam.',
                'tags' => '',
                'category_id' => 1,
                'visibility' => 0,
                'is_published' => 0,
                'is_deleted' => 0,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'CONSECTETUR ADIPISCING ELIT',
                'slug' => 'lorem_ipsum_sit',
                'img_cover' => NULL,
                'creator_id' => 1,
                'created_at' => '2022-10-07 08:16:33',
                'updated_at' => NULL,
                'published_at' => '2022-10-07 08:16:33',
                'deleted_at' => NULL,
                'body' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus quis sem diam. Sed commodo metus in ultrices consequat. Vestibulum eu orci ante. Mauris vel tincidunt mauris. Cras finibus, purus eu pharetra molestie, orci felis lacinia orci, ac congue quam turpis a nibh
 
 Nam viverra diam magna, eget lobortis orci tincidunt sed. Donec et lobortis est. Morbi eget massa est. In iaculis odio lectus, sed efficitur nunc viverra non. Nullam molestie eros magna, eu posuere mauris posuere sit amet. Pellentesque hendrerit condimentum ipsum, euismod ornare lectus pharetra eget. Praesent semper est erat, commodo mollis arcu efficitur vitae. Maecenas gravida sit amet nisi vel interdum.
 
 Vestibulum molestie, ipsum vitae feugiat lacinia, nisi magna accumsan velit, ac semper nisi felis vitae augue. Vivamus mattis quis erat eu gravida. Integer venenatis risus vitae ullamcorper cursus. Proin sodales odio sed aliquet pulvinar. Duis ipsum erat, ultricies a dolor non, tempor dictum ante. <br> Morbi vel metus lectus',
                'exerpt' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus quis sem diam.',
                'tags' => '#1 tag',
                'category_id' => 2,
                'visibility' => 1,
                'is_published' => 1,
                'is_deleted' => 0,
                'is_active' => 1,
            ),
        ));
        
        
    }
}