<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Employment;

class EmploymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Employment');
        $faker->addProvider(new \Brunty\Faker\BuzzwordJobProvider($faker));

        foreach(range(1, 10) as $index) {
            DB::table('employments')->insert([
                'employer_id' => $this->getRandomEmployerId(),
                'employee_osma_id' => $this->getRandomEmployeeId(),
                'title' => $faker->jobTitle,
                'description' => $faker->text,
                'start_date' => $faker->dateTimeBetween('last year', 'now'),
                'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }

    private function getRandomEmployeeId() {
        $employee = Employee::inRandomOrder()->first();
        return $employee->osma_id;
    }

    private function getRandomEmployerId() {
        $employer = Employer::inRandomOrder()->first();
        return $employer->id;
    }
}
