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
        $table->string('slug')->nullable(); // TEMPORARILY nullable, no unique yet
    });

    // Now fill slugs for existing blogs
    $blogs = \App\Models\Blog::all();
    foreach ($blogs as $blog) {
        $blog->slug = \Illuminate\Support\Str::slug($blog->title);
        $blog->save();
    }

    // Now make it unique and NOT NULL
    Schema::table('blogs', function (Blueprint $table) {
        $table->string('slug')->unique()->change();
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
