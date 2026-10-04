<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add new fields to items table only
        Schema::table('items', function (Blueprint $table) {
            // Trade Name (in English and Spanish)
            $table->string('trade_name_en')->nullable()->after('name_fa');
            $table->string('trade_name_es')->nullable()->after('trade_name_en');

            // From/Origin (in English and Spanish)
            $table->string('origin_en')->nullable()->after('trade_name_es');
            $table->string('origin_es')->nullable()->after('origin_en');

            // Packaging (in English and Spanish)
            $table->text('packaging_en')->nullable()->after('origin_es');
            $table->text('packaging_es')->nullable()->after('packaging_en');

            // Composition (in English and Spanish)
            $table->text('composition_en')->nullable()->after('packaging_es');
            $table->text('composition_es')->nullable()->after('composition_en');

            // Change slug to not unique temporarily (we'll add composite unique later)
            $table->dropUnique(['slug']);
        });

        // Add composite unique constraint for items
        Schema::table('items', function (Blueprint $table) {
            $table->unique(['slug', 'trade_name_en']);
        });
    }

    public function down()
    {
        // Remove fields from items table
        Schema::table('items', function (Blueprint $table) {
            $table->dropUnique(['slug', 'trade_name_en']);

            $table->dropColumn([
                'trade_name_en',
                'trade_name_es',
                'origin_en',
                'origin_es',
                'packaging_en',
                'packaging_es',
                'composition_en',
                'composition_es'
            ]);

            // Restore unique constraint on slug
            $table->unique(['slug']);
        });
    }
};
