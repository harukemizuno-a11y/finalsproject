
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title')->default('My Portfolio');
            $table->string('slug')->unique();
            $table->string('name')->default('Your Name');
            $table->string('headline')->nullable();
            $table->text('bio')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar')->nullable();

            $table->json('skills')->nullable();
            $table->json('projects')->nullable();
            $table->json('socials')->nullable();

            $table->string('template')->default('modern');
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
