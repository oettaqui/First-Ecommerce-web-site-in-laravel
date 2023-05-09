<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product');
            // $table->string('image', 2048)->nullable();
            $table->string('slug');
            $table->integer('stock')->default(0);
            $table->float('price');
            $table->longtext('description_product');
            $table->tinyInteger('promotion')->default('0')->comment('0=not_yeat, 1=promotion');
            $table->tinyInteger('tranding')->default('0')->comment('0=not_yeat, 1=tranding');
            $table->tinyInteger('status')->default('0')->comment('0=visibel, 1=hidden');
            $table->foreignId('category_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
