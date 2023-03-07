<?php

namespace Database\Seeders;
 
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                \App\Models\User::factory(10)->create();

        
        //    $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->enum("type",["role","traveler","visitor"]);
        //     // $table->string('mobile')->unique()->nullable();
        //     $table->string("description")->nullable();
        //     $table->rememberToken();
        //     $table->timestamps();
         
        // User::factory()->create([
        //     'name' => 'Aisha',
        //     'email' => 'Aisha@rahhal.com',
        //     'password' => bcrypt('123456'),
        //     'role' => 'traveler',
        //     'image' => '/img/def.png',
        // ]);

        DB::table('regions')->insert([
   
            ['name' => "Center"]
        ]
    
    );
    }
}
