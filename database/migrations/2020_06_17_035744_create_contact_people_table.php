<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('full_name')->nullable();
            $table->string('home_address')->nullable();
            $table->unsignedBigInteger('contact_number')->nullable();
            $table->string('relationship')->nullable();
            $table->timestamps();
            $table->index(['full_name', 'created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_people');
    }
}
