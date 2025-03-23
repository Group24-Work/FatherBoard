<?php

use App\Models\CustomerInformation;
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
        Schema::create('restricted_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CustomerInformation::class)->constrained()->cascadeOnDelete();
            $table->boolean("Restricted");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restricted_users');
    }
};
