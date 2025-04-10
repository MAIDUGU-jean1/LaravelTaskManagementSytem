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
        Schema::table('tasks', function (Blueprint $table) {  
      
            $table->dropColumn('status');  

           
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');  
        });  
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_status');
        Schema::table('tasks', function (Blueprint $table) {  
        
            $table->dropColumn('status');  
            $table->enum('status', ['pending', 'submitted'])->default('pending');  
        });  
        //
    }
};
