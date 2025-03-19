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
        Schema::create("password_resets",function($table)
        {
            $table->id();
            $table->foreignIdFor(CustomerInformation::class)->constrained()->onDelete("cascade");
            $table->string("code");
            $table->timestamp("expire_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_resets');    }
};
