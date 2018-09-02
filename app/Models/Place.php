<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Place
 *
 * @package App
 * @property int                 $id
 * @property string              $address
 * @property float               $lat
 * @property float               $lng
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|Place whereAddress($value)
 * @method static Builder|Place whereCreatedAt($value)
 * @method static Builder|Place whereId($value)
 * @method static Builder|Place whereLat($value)
 * @method static Builder|Place whereLng($value)
 * @method static Builder|Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    public const ID = 'id';
    public const ADDRESS = 'address';
    public const LATITUDE = 'lat';
    public const LONGITUDE = 'lng';

    private const EARTH_RADIUS = 6371;

    protected $casts = [
        self::LATITUDE  => 'float',
        self::LONGITUDE => 'float',
    ];

    /**
     * @param Place $place
     *
     * @return Builder
     */
    public static function getOrderedByDistanceToPlace(Place $place): Builder
    {
        $latitude = self::LATITUDE;
        $longitude = self::LONGITUDE;
        $orderBy = <<<ORDER_BY
ACOS(
    SIN(RADIANS({$place->lat}))*SIN(RADIANS({$latitude}))
    +
    COS(RADIANS({$place->lat}))*COS(RADIANS({$latitude}))
    *COS(RADIANS({$place->lng})-RADIANS({$longitude}))
)
ORDER_BY;

        return self::whereKeyNot($place->getKey())->orderByRaw($orderBy);
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return (new self)->getTable();
    }

    /**
     * @param Place $that
     *
     * @return float
     */
    public function getDistanceTo(Place $that): float
    {
        $thatLat = deg2rad($that->lat);
        $thisLat = deg2rad($this->lat);

        $thatLng = deg2rad($that->lng);
        $thisLng = deg2rad($this->lng);

        return round(
            self::EARTH_RADIUS * acos(
                sin($thatLat) * sin($thisLat)
                + cos($thatLat) * cos($thisLat) * cos($thatLng - $thisLng)
            ),
            2);
    }

    /**
     * @return Collection
     */
    public static function getAddressesForFilter(): Collection
    {
        return (new self)->select(self::ADDRESS)->orderBy(self::ADDRESS)->get();
    }
}
