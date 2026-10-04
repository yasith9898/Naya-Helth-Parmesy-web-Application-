<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // Remove the specified fields
            $table->dropColumn([
                'desc_en',
                'normal_price',
                'price_with_ice_cream',
                'price_per_kilo',
                'currency'
            ]);
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            // Add back the removed fields
            $table->text('desc_en')->nullable()->after('name_es');
            $table->decimal('normal_price', 10, 2)->default(0)->after('desc_es');
            $table->decimal('price_with_ice_cream', 10, 2)->default(0)->after('normal_price');
            $table->decimal('price_per_kilo', 10, 2)->default(0)->after('price_with_ice_cream');
            $table->string('currency')->default('IQD')->after('price_per_kilo');
        });
    }
};
