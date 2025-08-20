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
        Schema::create('ad_spends', function (Blueprint $table): void {
            $table->id();
            $table->string('facebook_campaign_id');
            $table->string('campaign_name');
            $table->string('ad_set_id')->nullable();
            $table->string('ad_id')->nullable();
            $table->decimal('spend_amount', 10, 2);
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('conversions')->default(0);
            $table->date('spend_date');
            $table->timestamps();

            $table->index(['facebook_campaign_id', 'spend_date']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_spends');
    }
};
