<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('role', ['owner', 'manager', 'player', 'viewer'])->default('viewer');
            $table->timestamps();

            $table->unique(['team_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('teams');
    }
};
