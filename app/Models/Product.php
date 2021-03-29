<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App\Models
 *
 * @property string $outer_packaging
 * @property string $statement_of_identity
 * @property string $langual_dietary_claim_or_use
 * @property int $count
 * @property string $product_name
 * @property string $category
 * @property string $subcategory
 * @property string $langual_product_type
 * @property string $brand
 * @property string $date_entered_into_dsld
 * @property string $serving_size
 * @property string $nhanes_id
 * @property boolean $success
 * @property string $suggested_use
 * @property string $database
 * @property string $net_contents_quantity
 * @property string $langual_supplement_form
 * @property string $product_trademark_copyright_symbol
 * @property string $sku
 * @property string $db_source
 * @property string $langual_intended_target_groups
 * @property string $tracking_history
 * @property string $precautions
 * @property string $directions
 * @property string $formulations
 * @property string $description
 * @property boolean $artificial_flavor
 * @property boolean $artificial_color
 * @property boolean $preservatives
 * @property boolean $sugar
 * @property boolean $starch
 * @property boolean $milk
 * @property boolean $lactose
 * @property boolean $yeast
 * @property boolean $fish
 * @property boolean $sodium
 * @property boolean $soy
 * @property boolean $gluten
 * @property boolean $wheat
 * @property boolean $sweetener
 * @property boolean $vegan
 * @property boolean $vegetarian
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 * @method Builder filter(array $data)
 */
class Product extends Model
{
    protected $casts
        = [
            'success'           => 'boolean',
            'artificial_flavor' => 'boolean',
            'artificial_color'  => 'boolean',
            'preservatives'     => 'boolean',
            'sugar'             => 'boolean',
            'starch'            => 'boolean',
            'milk'              => 'boolean',
            'lactose'           => 'boolean',
            'yeast'             => 'boolean',
            'fish'              => 'boolean',
            'sodium'            => 'boolean',
            'soy'               => 'boolean',
            'gluten'            => 'boolean',
            'wheat'             => 'boolean',
            'sweetener'         => 'boolean',
            'vegan'             => 'boolean',
            'vegetarian'        => 'boolean'
        ];

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function scopeFilter(Builder $q, array $data): Builder
    {
        $filters = $data['filter'] ?? [];
        if (empty($filters)) {
            return $q;
        }
        if (array_key_exists('search', $filters)
            && ! empty($filters['search'])
        ) {
            $q->where('product_name','like',$filters['search'])
            ->orWhere('sku',$filters['search']);
        }
        $q->groupBy('product_name');
        $q->orderBy('product_name');
        return $q;
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
