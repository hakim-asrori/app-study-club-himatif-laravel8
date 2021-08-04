<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\Models\User;
use \App\Models\Classes;
use \App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();

    	Category::create([
    		'category' => 'Cyber Security'
    	]);

    	Category::create([
    		'category' => 'Web Programming'
    	]);

    	Category::create([
    		'category' => 'Mobile Programming'
    	]);

    	Category::create([
    		'category' => 'Desain UI/UX'
    	]);

        Classes::create([
            'id' => 0,
            'class' => 'Tidak ada kelas'
        ]);

        User::create([
         'email' => 'rilozpedia20@gmail.com',
         'password' => Hash::make('rilozpedia20@gmail.com'),
         'id_role' => 1,
         'id_category' => 2,
        ]);
    }
}
