<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Employer');

        for($i = 0; $i <= 10; $i++) {
            DB::table('employers')->insert([
                'name' => $faker->company,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
