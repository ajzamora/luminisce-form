<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientContactPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_contact_people', function (Blueprint $table) {
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('contact_person_id')
                ->constrained('contact_people')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('relationship');
            $table->timestamps();

            $table->primary(['patient_id', 'contact_person_id']);
            $table->index(['relationship', 'created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_contact_people');
    }
}
