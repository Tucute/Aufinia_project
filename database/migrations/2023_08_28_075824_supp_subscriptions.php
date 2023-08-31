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
        Schema::create('supp_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('CustomerId');
            $table->string('CustomerEmail');
            $table->string('LatestInvId')->nullable();
            $table->integer('SubsrcInterval')->nullable();
            $table->string('ProductId');
            $table->string('PlanId')->nullable();
            $table->string('SubsrcId');
            $table->dateTime('CurrentPeriodStart')->nullable();
            $table->dateTime('CurrentPeriodEnd')->nullable();
            $table->string('Licensekey');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supp_subscriptions');
    }
};
