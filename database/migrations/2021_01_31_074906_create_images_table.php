<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url',50);
            $table->string('alt',50);
            $table->timestamps();

        });

        Schema::table("images", function(Blueprint $table){
            $table->softDeletes();
            $table->foreignId('produit_id')->nullable()->constrained()->onUpdate('cascade')->cascadeOnDelete();
            $table->unsignedBigInteger("category_id")->nullable();
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
        Schema::table("images", function(Blueprint $table){
            $table->dropForeign("images_produit_id_index");
            $table->dropForeign(['category_id']);
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('images');
    }
}
