<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Status;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('special_content_groups', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string(column: 'slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', Status::STATUSES_SPECIAL_CONTENT_GROUP)->default(Status::STATUS_SPECIAL_CONTENT_GROUP_DRAFT);
            $table->unsignedInteger('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('special_content_groups');
    }
};
