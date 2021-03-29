<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Statement
 *
 * @package App\Models
 * @property int $id
 * @property int $product_id
 * @property string $statement
 * @property string $statement_type
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Statement extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
