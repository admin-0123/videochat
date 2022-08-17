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
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('prefix')->nullable();
            $table->string('number')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->decimal('amount', 25, 5)->default(0);
            $table->char('currency', 10)->nullable();
            $table->date('date')->nullable();
            $table->morphs('transactionable');
            $table->boolean('status')->default(0);
            $table->json('billing_address')->nullable();
            $table->json('payment_gateway')->nullable();
            $table->json('meta')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
