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
     * @return string
     */
    private function getTableName(): string
    {
        return (new Place)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        \Schema::create($this->getTableName(), function (Blueprint $table) {
            $table->increments(Place::ID);
            $table->string(Place::ADDRESS);
            $table->decimal(Place::LATITUDE, 10, 7);
            $table->decimal(Place::LONGITUDE, 10, 7);
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
        \Schema::dropIfExists($this->getTableName());
    }
}
