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
            $table->string('first_name');
            $table->string('last_name');
            $table->char('middle_initial')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('home_address')->nullable();
            $table->string('work_address')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('mobile_number')->nullable();
            $table->unsignedBigInteger('landline_number')->nullable();
            $table->unsignedTinyInteger('sex_id');
            $table->unsignedTinyInteger('civil_status_id')->nullable();
            $table->unsignedBigInteger('encoder_id')->nullable();
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
