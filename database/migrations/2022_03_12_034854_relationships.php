<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('division_id')->references('id')->on('divisions');
        });
        Schema::table('polls', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
        Schema::table('choices', function (Blueprint $table) {
            $table->foreign('poll_id')->references('id')->on('polls');
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('choice_id')->references('id')->on('choices');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('poll_id')->references('id')->on('polls');
            $table->foreign('division_id')->references('id')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['division_id']);
        });
        Schema::table('polls', function (Blueprint $table) {
            $table->dropColumn(['created_by']);
        });
        Schema::table('choices', function (Blueprint $table) {
            $table->dropColumn(['poll_id']);
        });
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn(['choice_id']);
            $table->dropColumn(['user_id']);
            $table->dropColumn(['poll_id']);
            $table->dropColumn(['division_id']);
        });
    }
};
