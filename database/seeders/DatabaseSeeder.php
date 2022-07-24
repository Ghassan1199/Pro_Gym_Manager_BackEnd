<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\coach;
use App\Models\contract;
use App\Models\day;
use App\Models\exercies;
use App\Models\gym;
use App\Models\payment;
use App\Models\qualifications;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $exe = exercies::factory(25)->create();
        $qual = qualifications::factory(25)->create();

        admin::factory(10)->create()->each(function ($admin) use ($exe, $qual) {
            gym::factory(1)->create(['admin_id' => $admin->id,])->each(function ($gym) use ($exe, $qual) {
                coach::factory(3)->create(['gym_id' => $gym->id])->each(function ($coach) use ($gym, $exe, $qual) {
                    contract::factory(1)->create(['coach_id' => $coach->id]);
                    $coach->qualifications()->attach($qual->random(3));

                    User::factory(5)->create(['gym_id' => $gym->id])->each(function ($user) use ($coach, $exe) {
                        subscription::factory(1)->create(['user_id' => $user->id, 'coach_id' => $coach->id])->each(function ($subscription) use ($exe) {
                            payment::factory(rand(1, 4))->create(['sub_id' => $subscription->id, 'amount' => 2000]);
                            day::factory(1)->create(['sub_id' => $subscription->id]);
                            $subscription->exercies()->attach($exe->random(5));
                        });
                    });
                });

            });
        });
    }
}
