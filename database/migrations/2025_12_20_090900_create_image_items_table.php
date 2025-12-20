<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_items', function (Blueprint $table) {
            $table->increments('ii_id');
            $table->integer('ig_id')->default(0);
            $table->text('image_path')->nullable();
            $table->string('image_title', 255)->nullable();
            $table->text('image_desc')->nullable();
            $table->enum('status', ['active', 'delete'])->default('active');
            $table->timestamp('c_date')->useCurrent()->nullable();
            $table->timestamp('m_date')->useCurrent()->useCurrentOnUpdate()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_items');
    }
};
