<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('points_redeemed', 12, 2)->default(0)->after('subtotal');
            $table->decimal('points_discount_rm', 12, 2)->default(0)->after('points_redeemed');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['points_redeemed', 'points_discount_rm']);
        });
    }
};
