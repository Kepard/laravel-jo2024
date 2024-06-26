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
        Schema::create('sports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('competitions', function(Blueprint $table){
            $table->foreignIdFor(App\Models\Sport::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports');
        Schema::table('competitions', function(Blueprint $table){
            $table->dropForeignIdFor(App\Models\Sport::class);
        });
    }
};
