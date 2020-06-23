<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_statuses', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->string('status', 10)->unique();

//            $table->set('status', ['single', 'married', 'separated', 'divorced', 'widowed']);
        });

        DB::table('civil_statuses')->insert([
            ['id' => 1, 'status' => 'choose...'],
            ['id' => 2, 'status' => 'single'],
            ['id' => 3, 'status' => 'married'],
            ['id' => 4, 'status' => 'separated'],
            ['id' => 5, 'status' => 'divorced'],
            ['id' => 6, 'status' => 'widowed']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('civil_statuses');
    }
}
