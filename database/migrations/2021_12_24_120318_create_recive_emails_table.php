<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciveEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recive_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_message_alert");
            $table->string("email");
            $table->string("name");
            $table->text("token");
            $table->boolean("confirmad")->default(false);
            $table->boolean("status");
            $table->foreign("id_message_alert")
            ->references("id")
            ->on("message_alerts")->onDelete("cascade");
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
        Schema::dropIfExists('recive_emails');
    }
}
