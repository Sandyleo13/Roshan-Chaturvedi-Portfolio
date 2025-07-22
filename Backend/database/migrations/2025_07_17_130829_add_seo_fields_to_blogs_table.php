<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('blogs', function (Blueprint $table) {
        if (!Schema::hasColumn('blogs', 'meta_title')) {
            $table->string('meta_title')->nullable();
        }
        if (!Schema::hasColumn('blogs', 'meta_description')) {
            $table->text('meta_description')->nullable();
        }
        if (!Schema::hasColumn('blogs', 'meta_keywords')) {
            $table->text('meta_keywords')->nullable();
        }
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
        });
    }
};
