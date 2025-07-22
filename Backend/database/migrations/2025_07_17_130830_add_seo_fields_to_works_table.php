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
    Schema::table('works', function (Blueprint $table) {
        if (!Schema::hasColumn('works', 'meta_title')) {
            $table->string('meta_title')->nullable();
        }
        if (!Schema::hasColumn('works', 'meta_description')) {
            $table->text('meta_description')->nullable();
        }
        if (!Schema::hasColumn('works', 'meta_keywords')) {
            $table->text('meta_keywords')->nullable();
        }
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('works', function (Blueprint $table) {
            //
        });
    }
};
