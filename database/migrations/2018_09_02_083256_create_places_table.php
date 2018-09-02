<?php
declare(strict_types=1);

use App\Models\Place;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePlacesTable
 */
class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        \Schema::create(Place::getTableName(), function (Blueprint $table) {
            $table->increments(Place::ID);
            $table->string(Place::ADDRESS);
            $table->decimal(Place::LATITUDE, 9, 6);
            $table->decimal(Place::LONGITUDE, 9, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        \Schema::dropIfExists(Place::getTableName());
    }
}
