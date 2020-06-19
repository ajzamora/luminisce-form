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
            $table->string('query01', 100);
            $table->string('query02', 100);
            $table->string('query03', 100);
            $table->string('query04', 100);
            $table->string('query05', 100);
            $table->string('query06', 3);
            $table->string('query07', 3);
            $table->string('query08', 100);
            $table->string('query09', 3);
            $table->string('query10', 3);
            $table->string('query11', 100);
            $table->string('query12', 100);
            $table->string('query13', 100);
            $table->string('query14', 3);
            $table->string('query15', 100);
            $table->string('query16', 200);
            $table->string('query17', 3);
            $table->string('query18', 200);
            $table->string('query19_1', 100);
            $table->string('query19_2', 100);
            $table->string('query19_3', 100);
            $table->string('query19_4', 100);
            $table->string('query19_5', 100);
            $table->string('query19_6', 100);
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
