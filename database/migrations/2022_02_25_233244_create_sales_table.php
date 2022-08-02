<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('start_cash')->nullable();
            $table->integer('cash_drawer')->nullable();
            $table->integer('cash_withdraw')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('mb')->nullable();
            $table->integer('total')->nullable();
            $table->integer('profit')->nullable();
            $table->integer('expense')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
