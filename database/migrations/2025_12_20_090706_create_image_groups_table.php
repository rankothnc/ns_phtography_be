<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_groups', function (Blueprint $table) {
            $table->increments('ig_id');
            $table->string('ig_name', 45)->nullable();
            $table->enum('status', ['active', 'delete'])->default('active');
            $table->timestamp('c_date')->useCurrent()->nullable();
            $table->timestamp('m_date')->useCurrent()->useCurrentOnUpdate()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_groups');
    }
};

