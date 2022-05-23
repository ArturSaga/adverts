<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categoryes =['clothis', 'auto', 'sport', 'home'];
        DB::table('adverts')->insert([
                'user_id'=>rand(0,10),
                'category'=> $categoryes[rand(0,3)] ,
                'subcategory'=> Str::random(10),
                'title'=> Str::random(10),
                'description'=> Str::random(25),
            ]);
    }
}
