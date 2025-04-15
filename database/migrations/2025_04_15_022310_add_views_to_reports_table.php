<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        // database/migrations/xxxx_xx_xx_change_voting_column_type_on_reports_table.php
        public function up(): void
{
    Schema::table('reports', function (Blueprint $table) {
        $table->unsignedInteger('views')->default(0);
    });
}

public function down(): void
{
    Schema::table('reports', function (Blueprint $table) {
        $table->dropColumn('views');
    });
}

};
