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
        //
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email', 255)->nullable(false)->unique('email');
            $table->string('password', 255)->nullable(false);
            $table->string('remeber_token', 100)->nullable(true);
            $table->string('isManager',255)->nullable(false)->default('no');
            $table->timestamp('created_at', 'updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
