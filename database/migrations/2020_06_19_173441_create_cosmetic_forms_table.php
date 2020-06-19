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
            $table->string('cquery01', 100);
            $table->string('cquery02', 30);
            $table->string('cquery03', 30);
            $table->string('cquery04', 150);
            $table->string('cquery05', 150);
            $table->string('cquery06', 150);
            $table->string('cquery07', 150);
            $table->string('cquery08', 150);
            $table->string('cquery09', 150);
            $table->string('cquery10', 150);
            $table->string('cquery11', 150);
            $table->string('cquery12', 150);
            $table->string('cquery13', 150); // images
            $table->string('cquery14', 150);
            $table->string('cquery15', 150);
            $table->string('cquery16', 150);
            $table->string('cquery17', 150);
            $table->string('cquery18', 150);
            $table->string('cquery19', 150);
            $table->string('cquery20', 150);
            $table->string('cquery21', 150);
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
