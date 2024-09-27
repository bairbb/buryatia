<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\District;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $this->seedDistricts();
    }

    private function seedDistricts(): void
    {
        $districts = District::cases();
        $data = [];

        foreach ($districts as $district) {
            $data[] = [
                'title' => $district->value,
                'slug' => Str::lower($district->name),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('districts')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
