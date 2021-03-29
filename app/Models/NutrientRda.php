<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class NutrientRda extends Model
{
    protected $appends = ['view_url', 'update_url', 'delete_url'];
    protected $casts = ['pregnant' => 'boolean', 'breast_feeding' => 'boolean'];

    public function getViewUrlAttribute()
    {
        if (Gate::allows('view-nutrient-rda', $this)) {
            return route('nutrient_rdas.show', ['nutrient_rda' => $this->id]);
        } else {
            return null;
        }
    }

    public function getUpdateUrlAttribute()
    {
        if (Gate::allows('update-nutrient-rda', $this)) {
            return route('nutrient_rdas.edit', ['nutrient_rda' => $this->id]);
        } else {
            return null;
        }
    }

    public function getDeleteUrlAttribute()
    {
        if (Gate::allows('delete-nutrient-rda', $this)) {
            return route('nutrient_rdas.destroy',
                ['nutrient_rda' => $this->id]);
        } else {
            return null;
        }
    }

    public function nutrient()
    {
        return $this->belongsTo(Nutrient::class);
    }

}
