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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id'); // Add first_name after the id column
            $table->string('last_name')->after('first_name'); // Add last_name after the first_name column
            $table->string('middle_name')->nullable()->after('last_name'); // Add middle_name after the last_name column
            $table->dropColumn('name'); // Remove the name column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id'); // Add back the name column if rolled back
            $table->dropColumn(['first_name', 'last_name', 'middle']); // Remove the first_name and last_name columns
        });
    }
};
