<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCosmeticFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetic_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('patient_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('cquery01')->nullable();
            $table->string('cquery02')->nullable();
            $table->string('cquery03')->nullable();
            $table->string('cquery04')->nullable();
            $table->string('cquery05')->nullable();
            $table->string('cquery06')->nullable();
            $table->string('cquery07')->nullable();
            $table->string('cquery08')->nullable();
            $table->string('cquery09')->nullable();
            $table->string('cquery10')->nullable();
            $table->string('cquery11')->nullable();
            $table->string('cquery12')->nullable();
            $table->string('cquery13')->nullable(); // images
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
        Schema::dropIfExists('cosmetic_forms');
    }
}
