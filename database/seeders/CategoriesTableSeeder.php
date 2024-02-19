<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Category 1',
                'slug' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => '0000-00-00 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Category 2',
                'slug' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => '0000-00-00 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Category 3',
                'slug' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => '0000-00-00 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Category 4',
                'slug' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => '0000-00-00 00:00:00',
            ),
        ));
        
        
    }
}