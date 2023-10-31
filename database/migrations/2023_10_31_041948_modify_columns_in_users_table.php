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
            $table->string('firstname',20)->change();
            $table->string('lastname',20)->change();
            $table->string('phone',10)->change();
            $table->boolean('is_firsttime_login')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname',20)->change();
            $table->string('lastname',20)->change();
            $table->string('phone',10)->change();
            $table->boolean('is_firsttime_login')->default(0)->change();
        });
    }
};
