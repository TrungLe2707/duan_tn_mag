<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddProductIdToProductVariantsTable extends Migration
    {
        public function up()
        {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
            });
        }

        public function down()
        {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            });
        }
    }