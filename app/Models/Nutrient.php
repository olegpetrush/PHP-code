<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * Class Nutrient
 *
 * @package App\Models
 *
 */
class Nutrient extends Model
{
    protected $appends
        = [
            'view_url',
            'update_url',
            'delete_url'
        ];

    public function getViewUrlAttribute()
    {
        if (Gate::allows('view-nutrient', $this)) {
            return route('nutrients.show', ['nutrient' => $this->id]);
        } else {
            return null;
        }
    }

    public function getUpdateUrlAttribute()
    {
        if (Gate::allows('update-nutrient', $this)) {
            return route('nutrients.edit', ['nutrient' => $this->id]);
        } else {
            return null;
        }
    }

    public function getDeleteUrlAttribute()
    {
        if (Gate::allows('delete-nutrient', $this)) {
            return route('nutrients.destroy', ['nutrient' => $this->id]);
        } else {
            return null;
        }
    }

    public function nutrientLimits()
    {
        return $this->hasMany(NutrientLimit::class);
    }

    public function nutrientRda()
    {
        return $this->hasMany(NutrientRda::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
