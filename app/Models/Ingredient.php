<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ingredient
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $ingredient_id
 * @property int $product_id
 * @property string $dsld_ingredient_categories
 * @property string $amount_serving_unit
 * @property string $new_amount_serving_unit
 * @property int $ingredient_group_grp_id
 * @property string $blends
 * @property string $amount_per_serving
 * @property string $new_amount_per_serving
 * @property string $dietary_ingredient_synonym_source
 * @property int $nutrient_id
 * @property string $blended_ingredient_types
 * @property string $pct_daily_value_per_serving
 * @property string $serving_size
 * @property float $serving_size_value
 * @property string $suggested_recommended_usage_directions
 * @property string $db_source
 * @property string $ancestry_number_of_parents_row_ids
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Ingredient extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function nutrient()
    {
        return $this->belongsTo(Nutrient::class);
    }
}
