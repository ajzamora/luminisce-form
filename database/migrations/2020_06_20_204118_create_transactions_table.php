<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('patient_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('particular')->nullable();
            $table->string('paid')->nullable();
            $table->string('mode')->nullable();
            $table->string('bal')->nullable();
            $table->string('dc')->nullable();
            $table->string('packages')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->index(['date', 'particular']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
