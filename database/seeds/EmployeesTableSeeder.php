<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Employee');
        $digits = 5;

        for($i = 0; $i <= 10; $i++) {
            DB::table('employees')->insert([
                'id' => rand(pow(10, $digits-1), pow(10, $digits)-1), // produce five digit number
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
