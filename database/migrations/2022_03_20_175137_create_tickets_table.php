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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('username')->nullable();
            $table->string('ticket_id')->nullable();
            $table->string('lang_id')->nullable();
            $table->string('contact')->nullable();
            $table->string('client_name')->nullable();
            $table->string('n_i_f')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('type')->nullable();
            $table->string('mark')->nullable();
            $table->string('model')->nullable();
            $table->string('imei_no')->nullable();
            $table->string('warranty')->nullable();
            $table->string('repair')->nullable();
            $table->string('observ_of_damag')->nullable();
            $table->string('technician')->nullable();
            $table->string('payment')->nullable();
            $table->double('total', 20, 2)->nullable();
            $table->double('received', 20, 2)->nullable();
            $table->double('balance', 20, 2)->nullable();
            $table->text('address')->nullable();
            $table->text('comments')->nullable();
            $table->timestamp('deliver_date')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
