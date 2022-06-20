<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaxProviderPriceToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('max_provider_price')->nullable()->after('price');
        });

        DB::table('orders')
            ->join('services', 'services.id', '=', 'service_id')
            ->select('orders.id', 'services.max_provider_price')
            ->orderBy('orders.id')
            ->chunk(50, function ($orders) {
                foreach ($orders as $order) {
                    DB::table('orders')
                        ->where('id', $order->id)
                        ->update(['max_provider_price' => $order->max_provider_price]);
                }
            });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('max_provider_price')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('max_provider_price');
        });
    }
}
