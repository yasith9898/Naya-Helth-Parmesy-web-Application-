<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_es')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_ku')->nullable();
            $table->string('name_tr')->nullable();
            $table->string('name_fa')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_es')->nullable();
            $table->text('desc_ar')->nullable();
            $table->text('desc_ku')->nullable();
            $table->text('desc_tr')->nullable();
            $table->text('desc_fa')->nullable();
            $table->decimal('normal_price', 10, 2)->default(0);
            $table->decimal('price_with_ice_cream', 10, 2)->default(0);
            $table->decimal('price_per_kilo', 10, 2)->default(0);
            $table->string('currency')->default('IQD');
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
