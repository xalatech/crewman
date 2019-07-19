<?php

use Illuminate\Database\Seeder;
use App\Models\Employment;
use Faker\Factory as Faker;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Assignment');
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));

        $employments = Employment::select('*')->get();

        foreach($employments as $employment) {
            for($i = 0; $i <= 5; $i++) {
                DB::table('assignments')->insert([
                    'employment_id' => $employment->id,
                    'title' => $faker->catchPhrase,
                    'description' => $faker->bs,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
