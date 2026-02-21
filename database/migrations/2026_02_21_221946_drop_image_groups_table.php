<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('image_groups');
    }

    public function down(): void
    {
        Schema::create('image_groups', function (Blueprint $table) {
            $table->unsignedInteger('ig_id')->autoIncrement();
            $table->string('ig_name', 45)->nullable();
            $table->enum('status', ['active','delete'])->default('active');
            $table->timestamp('c_date')->nullable()->useCurrent();
            $table->timestamp('m_date')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
    }
};
