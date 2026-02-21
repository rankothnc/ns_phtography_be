<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('image_items', function (Blueprint $table) {

            // Drop old columns
            $table->dropColumn(['ig_id', 'image_desc']);

            // Add new columns
            $table->integer('ic_id')->default(0)->after('ii_id');
            $table->date('capture_date')->nullable()->after('image_title');
            $table->text('image_desc_short')->nullable()->after('capture_date');
            $table->text('image_desc_long')->nullable()->after('image_desc_short');
        });
    }

    public function down(): void
    {
        Schema::table('image_items', function (Blueprint $table) {

            $table->dropColumn([
                'ic_id',
                'capture_date',
                'image_desc_short',
                'image_desc_long'
            ]);

            $table->integer('ig_id')->default(0)->after('ii_id');
            $table->text('image_desc')->nullable()->after('image_title');
        });
    }
};
