<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_commissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agent_id')->constrained('agents')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->decimal('order_subtotal', 12, 2);
            $table->decimal('commission_percent', 5, 2)->default(6.00);
            $table->decimal('commission_amount_rm', 12, 2)->default(0);
            $table->decimal('point_rate', 12, 2)->default(1);
            $table->decimal('points_awarded', 12, 2)->default(0);

            $table->string('status')->default('credited');
            $table->timestamp('credited_at')->nullable();

            $table->timestamps();

            $table->unique('order_id'); // 防重复
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_commissions');
    }
};
