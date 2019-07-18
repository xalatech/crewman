<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrentEmploymentTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER only_one_current_employment AFTER INSERT ON employments FOR EACH ROW
        BEGIN
            REPLACE INTO current_employments(employee_id, employment_id) VALUES (NEW.employee_id, NEW.id);
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER only_one_current_employment');
    }
}
