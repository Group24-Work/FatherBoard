<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;
use App\Models\Tag;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("product_tag",function($table)
        {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(Tag::class)->constrained()->onDelete("cascade");
$table->timestamps();

$table->unique(['product_id', 'tag_id']); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
