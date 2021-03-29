<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @package App\Models
 * @property int $id
 * @property int $product_id
 * @property string $zip
 * @property string $is_manufacturer
 * @property string $type
 * @property string $is_packager
 * @property string $address
 * @property string $state
 * @property string $is_distributor
 * @property string $city
 * @property string $is_reseller
 * @property string $is_other
 * @property string $name
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Contact extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
