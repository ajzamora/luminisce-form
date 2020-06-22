<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('query01')->nullable();
            $table->string('query02')->nullable();
            $table->string('query03')->nullable();
            $table->string('query04')->nullable();
            $table->string('query05')->nullable();
            $table->string('query06')->nullable();
            $table->string('query07')->nullable();
            $table->string('query08')->nullable();
            $table->string('query09')->nullable();
            $table->string('query10')->nullable();
            $table->string('query11')->nullable();
            $table->string('query12')->nullable();
            $table->string('query13')->nullable();
            $table->string('query14')->nullable();
            $table->string('query15')->nullable();
            $table->string('query16')->nullable();
            $table->string('query17')->nullable();
            $table->string('query18')->nullable();
            $table->string('query19_1')->nullable();
            $table->string('query19_2')->nullable();
            $table->string('query19_3')->nullable();
            $table->string('query19_4')->nullable();
            $table->string('query19_5')->nullable();
            $table->string('query19_6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
