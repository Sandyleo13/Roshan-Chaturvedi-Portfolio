<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Add slug column to works if not exists
        if (!Schema::hasColumn('works', 'slug')) {
            Schema::table('works', function (Blueprint $table) {
                $table->string('slug')->nullable();
            });
        }

        // Add slug column to articles if not exists
        if (!Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')->nullable();
            });
        }

        // Backfill slugs for works
        \App\Models\Work::all()->each(function ($work) {
            if (!$work->slug) {
                $work->slug = Str::slug($work->title) . '-' . $work->id;
                $work->save();
            }
        });

        // Backfill slugs for articles
        \App\Models\Article::all()->each(function ($article) {
            if (!$article->slug) {
                $article->slug = Str::slug($article->title) . '-' . $article->id;
                $article->save();
            }
        });

        // Add unique constraint on slug
        Schema::table('works', function (Blueprint $table) {
            $table->unique('slug');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop unique + column only if exists
        if (Schema::hasColumn('works', 'slug')) {
            Schema::table('works', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }

        if (Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }
    }
};
