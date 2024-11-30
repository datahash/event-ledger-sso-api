<?php

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('organisation_id');
            $table->unsignedBigInteger('created_by');
            $table->json('message');
            $table->string('hash_message');
            $table->string('reference')->index()->nullable();
            $table->string('topic_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('explorer_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
