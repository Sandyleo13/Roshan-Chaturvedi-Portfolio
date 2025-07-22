<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('role')->nullable();
            $table->string('period')->nullable();
            $table->string('status')->nullable();

            $table->json('metrics')->nullable();
            $table->json('technologies')->nullable();
            $table->json('features')->nullable();

            $table->json('links')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'period',
                'status',
                'metrics',
                'technologies',
                'features',
                'links',
            ]);
        });
    }
};
