<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Place
 *
 * @package App
 * @property int $id
 * @property string $address
 * @property float $lat
 * @property float $lng
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    public const ID = 'id';
    public const ADDRESS = 'address';
    public const LATITUDE = 'lat';
    public const LONGITUDE = 'lng';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
}
