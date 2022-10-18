<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogImportUserWalletFailed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_log_import_user_wallet_failed', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->default('empty');
            $table->string('description', 200)->default('empty');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_log_import_user_wallet_failed');
    }
}
