<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subcategory
 *
 * @package App\Models
 * @property int $id
 * @property int $category_id
 * @property int $name
 * @property array $keywords
 * @property array $negative_keywords
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Subcategory extends Model
{
    protected $casts
        = [
            'keywords'          => 'array',
            'negative_keywords' => 'array'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
