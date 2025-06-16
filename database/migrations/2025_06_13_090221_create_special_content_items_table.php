<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('special_content_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string(column: 'slug')->unique();

            $table->foreignId('group_id')
                ->constrained('special_content_groups')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->enum('type', array_column(Type::cases(), 'value'))->nullable();
            $table->text('content')->nullable();
            $table->string('media_url')->nullable();
            $table->string('link_url')->nullable();
            $table->string('button_text')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_content_items');
    }
};
