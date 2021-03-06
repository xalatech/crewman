<?php

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
        $this->call([
            EmployeesTableSeeder::class,
            EmployersTableSeeder::class,
            EmploymentsTableSeeder::class,
            AssignmentsTableSeeder::class,
            AssignmentRolesTableSeeder::class,
            AssignmentLeavesTableSeeder::class,
            AssignmentLocationsTableSeeder::class,
        ]);
    }
}
