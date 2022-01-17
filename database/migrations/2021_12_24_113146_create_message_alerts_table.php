<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_alert_remember");
            $table->string("subject");
            $table->text("message");
            $table->foreign("id_alert_remember")->references("id")
            ->on("alert_remembers")->onDelete("cascade");
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
        Schema::dropIfExists('message_alerts');
    }
}
