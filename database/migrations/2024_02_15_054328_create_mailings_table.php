<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Mailing;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mailings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sent_count')->nullable()->default(0);
            $table->integer('delivered_count')->nullable()->default(0);
            $table->text('message');
            $table->integer('is_active')->default(Mailing::MAILING_IS_NOT_ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailings');
    }
};
