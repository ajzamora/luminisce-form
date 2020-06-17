<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->char('middle_initial', 5)->nullable();
            $table->unsignedTinyInteger('age');
            $table->string('home_address');
            $table->string('work_address')->nullable();
            $table->string('email')->unique();
            $table->unsignedInteger('mobile_number');
            $table->unsignedInteger('landline_number')->nullable();
            $table->unsignedTinyInteger('sex_id');
            $table->unsignedTinyInteger('civil_status_id');
            $table->timestamps();

            $table->foreign('sex_id')->references('id')->on('sexes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('civil_status_id')->references('id')->on('civil_statuses')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->index(['first_name', 'last_name', 'age', 'created_at', 'updated_at', 'sex_id', 'civil_status_id'], 'patient_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
