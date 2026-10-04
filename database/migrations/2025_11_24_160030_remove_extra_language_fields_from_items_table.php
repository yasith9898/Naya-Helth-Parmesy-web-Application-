<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // Remove other language fields (keep English and Spanish)
            $table->dropColumn([
                'name_ar',
                'name_ku',
                'name_tr',
                'name_fa',
                'desc_ar',
                'desc_ku',
                'desc_tr',
                'desc_fa'
            ]);
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            // Add back the removed fields
            $table->string('name_ar')->nullable()->after('name_es');
            $table->string('name_ku')->nullable()->after('name_ar');
            $table->string('name_tr')->nullable()->after('name_ku');
            $table->string('name_fa')->nullable()->after('name_tr');
            $table->text('desc_ar')->nullable()->after('desc_es');
            $table->text('desc_ku')->nullable()->after('desc_ar');
            $table->text('desc_tr')->nullable()->after('desc_ku');
            $table->text('desc_fa')->nullable()->after('desc_tr');
        });
    }
};
