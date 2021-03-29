<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 * @property int $category
 * @property string $name
 * @property array $keywords
 * @property array $negative_keywords
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Category extends Model
{
    protected $casts=[
        'keywords'=>'array',
        'negative_keywords'=>'array'
    ];

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}
