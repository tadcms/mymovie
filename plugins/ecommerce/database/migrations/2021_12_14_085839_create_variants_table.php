<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'variants',
            function (Blueprint $table) {
                $table->id();

                //Information
                $table->string('sku_code', 100)->nullable()->index();
                $table->string('barcode', 100)->nullable()->index();
                $table->string('title');
                $table->text('thumbnail')->nullable();
                $table->text('summary')->nullable();
                $table->text('description')->nullable();
                $table->json('names')->nullable();
                $table->json('images')->nullable();

                //Price
                $table->decimal('price', 15, 2)->nullable();
                $table->decimal('sale_price', 15, 2)->nullable();
                $table->decimal('compare_price', 15, 2)->nullable();

                //Stock
                $table->bigInteger('quantity')->default(0);
                $table->boolean('stock')->default(0);

                //Type: [default, downloadable, virtual]
                $table->string('type')->default('default');

                //Relation
                $table->unsignedBigInteger('post_id')->index();

                //TimeStamps
                $table->timestamps();

                $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('variants');
    }
}
