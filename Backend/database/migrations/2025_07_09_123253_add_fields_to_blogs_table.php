<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->text('excerpt')->nullable();
            $table->string('category')->nullable();
            $table->string('read_time')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('image')->nullable();
            $table->boolean('featured')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'excerpt',
                'category',
                'read_time',
                'publish_date',
                'image',
                'featured'
            ]);
        });
    }
};
