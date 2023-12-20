<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_menu_menu_item_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuMenuItemTable extends Migration
{
    public function up()
    {
        Schema::create('menu_menu_item', function (Blueprint $table) {
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_item_id')->constrained()->onDelete('cascade');
            $table->primary(['menu_id', 'menu_item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_menu_item');
    }
}
