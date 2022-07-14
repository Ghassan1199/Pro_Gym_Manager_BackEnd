<?php

namespace Database\Seeders;

use Database\Factories\adminFactory;
use Illuminate\Database\Seeder;
use \App\Models\admin;
use App\Models\coach;
use App\Models\contract;
use App\Models\gym;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        admin::factory(10)->create()->each(function($admin){
            gym::factory(1)->create(['admin_id'=>$admin->id,])->each(function($gym){
                User::factory(5)->create(['gym_id'=>$gym->id]);
                coach::factory(3)->create(['gym_id'=>$gym->id])->each(function ($coach){
                    contract::factory(1)->create(['coach_id'=>$coach->id]);
                });
            });
        });

    }
}
