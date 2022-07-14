<?php

namespace Database\Seeders;

use Database\Factories\adminFactory;
use Illuminate\Database\Seeder;
use \App\Models\admin;
use App\Models\coach;
use App\Models\contract;
use App\Models\gym;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        admin::factory(10)->create()->each(function ($admin) {
            gym::factory(1)->create(['admin_id' => $admin->id,])->each(function ($gym) {
                coach::factory(3)->create(['gym_id' => $gym->id])->each(function ($coach) use($gym){
                    contract::factory(1)->create(['coach_id' => $coach->id]);
                    
                    User::factory(5)->create(['gym_id' => $gym->id])->each(function($user) use($coach){
                        subscription::factory(1)->create([
                            'user_id'=>$user->id,
                            'coach_id'=>$coach->id
                        ]);
                    });
                });

            });
        });
    }
}
