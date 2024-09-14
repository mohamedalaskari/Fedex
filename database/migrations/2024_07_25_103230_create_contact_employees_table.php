<?php

use App\Models\ContactType;
use App\Models\Employee;
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
        Schema::create('contact_employees', function (Blueprint $table) {
            $table->id();
            $table->string('contact');
            $table->foreignIdFor(Employee::class)->constrained();
            $table->foreignIdFor(ContactType::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_employees');
    }
};
