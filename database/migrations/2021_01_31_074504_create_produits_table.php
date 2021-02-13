<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->unique()->nullable(false);
            $table->text('description');
            $table->float('priceHT',8,2);
            $table->integer('quantity')->nullable(false);
            $table->integer('tva')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("produits", function(Blueprint $table){
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("produits", function(Blueprint $table){
            $table->dropSoftDeletes();
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('produits');
    }
}
