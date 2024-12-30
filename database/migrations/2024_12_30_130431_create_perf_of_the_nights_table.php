<?php

use App\Models\Fight;
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
        Schema::create('perf_of_the_nights', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('perf', ['Fight of the night', 'Perf of the night']);
            $table->foreignIdFor(Fight::class, 'fight_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perf_of_the_nights');
    }
};
