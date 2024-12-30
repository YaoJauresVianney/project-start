<?php

use App\Models\Event;
use App\Models\Fighter;
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
        Schema::create('fights', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignIdFor(Event::class, 'event_id');
            $table->foreignIdFor(Fighter::class, 'fighter_one_id');
            $table->foreignIdFor(Fighter::class, 'fighter_two_id');
            $table->enum('number_of_rounds', ['3', '5']);
            $table->boolean('for_title')->default(false);
            $table->enum('method', ['KO','TKO', 'Submission', 'Splited Decision', 'Unanimous Decision', 'Majority Decision', 'Unanimous Draw', 'Majority Draw', 'Splited Draw', 'No Contest', 'Disqualification']);
            $table->integer('last_round');
            $table->time('duration');
            $table->foreignIdFor(Fighter::class, 'winner_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fights');
    }
};
