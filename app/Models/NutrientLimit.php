<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * Class NutrientLimit
 *
 * @package App\Models
 */
class NutrientLimit extends Model
{
    protected $appends = ['view_url', 'update_url', 'delete_url'];
    protected $casts = ['pregnant' => 'boolean', 'breast_feeding' => 'boolean'];

    public function getViewUrlAttribute()
    {
        if (Gate::allows('view-nutrient-limit', $this)) {
            return route('nutrient_limits.show',
                ['nutrient_limit' => $this->id]);
        } else {
            return null;
        }
    }

    public function getUpdateUrlAttribute()
    {
        if (Gate::allows('update-nutrient-limit', $this)) {
            return route('nutrient_limits.edit',
                ['nutrient_limit' => $this->id]);
        } else {
            return null;
        }
    }

    public function getDeleteUrlAttribute()
    {
        if (Gate::allows('delete-nutrient-limit', $this)) {
            return route('nutrient_limits.destroy',
                ['nutrient_limit' => $this->id]);
        } else {
            return null;
        }
    }

    public function nutrient()
    {
        return $this->belongsTo(Nutrient::class);
    }
}
