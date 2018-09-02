<?php
declare(strict_types=1);

use App\Models\Place;
use Illuminate\Database\Migrations\Migration;

/**
 * Class FillPlacesTable
 */
class FillPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        /** @noinspection UsingInclusionReturnValueInspection */
        /** @noinspection PhpIncludeInspection */
        $rawAreas = require base_path() . '/database/areas.php';
        $preparedAreas = [];
        foreach ($rawAreas as $k => $v) {
            $preparedAreas[] = [
                'address'    => $k,
                'lat'        => $v['lat'],
                'long'       => $v['long'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        Place::query()->insert($preparedAreas);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Place::query()->delete();
    }
}
