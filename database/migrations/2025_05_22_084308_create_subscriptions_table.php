<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique()->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', Status::STATUSES_SUBSCRIPTION)->default(Status::STATUS_SUBSCRIPTION_INACTIVE);

            $table->string('stripe_subscription_id')->nullable(); // for Stripe integration
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
