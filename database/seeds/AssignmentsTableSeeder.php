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

        foreach(range(1, 10) as $index) {
            DB::table('assignments')->insert([
                'employment_id' => $this->getRandomEmploymentId(),
                'title' => $faker->catchPhrase,
                'description' => $faker->bs,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }

    private function getRandomEmploymentId() {
        $employment = Employment::inRandomOrder()->first();
        return $employment->id;
    }
}
