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
    Schema::create('clients', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('status')->default('active');
      $table->json('feature_flags')->nullable();
      $table->decimal('total_spend', 10, 2)->default(0); // For top clients/revenue charts
      // Optional: If you want engagement metrics (sessions this month)
      $table->unsignedInteger('sessions')->default(0);
      $table->timestamps(); // includes created_at and updated_at (used for charting)
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('clients');
  }
};
