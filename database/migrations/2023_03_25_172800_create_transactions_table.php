<?php

use App\Enums\Transactions\Status;
use App\Enums\Transactions\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', Type::getValues());
            $table->enum('status', Status::getValues());
            $table->string('txid');
            $table->integer('vout');
            $table->decimal('amount', 18, 8, true);
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
