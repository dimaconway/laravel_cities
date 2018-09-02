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
 * @property float $lng
 * @property float $lat
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $long
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereLong($value)
 */
class Place extends Model
{
    //
}
