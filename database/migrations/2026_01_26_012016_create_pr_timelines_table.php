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
        Schema::create('pr_timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained('purchase_requests')->onDelete('cascade');
            $table->date('pr_received_date')->nullable();
            $table->date('pr_approved_date')->nullable();
            $table->date('quotation_date')->nullable();
            $table->date('po_created_date')->nullable();
            $table->date('po_approved_date')->nullable();
            $table->date('contract_signed_date')->nullable();
            $table->date('goods_received_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_timelines');
    }
};
