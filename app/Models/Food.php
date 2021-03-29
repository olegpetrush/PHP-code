<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * Class Food
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Food extends Model
{
    protected $appends
        = [
            'view_url',
            'update_url',
            'delete_url'
        ];

    public function getViewUrlAttribute()
    {
        if (Gate::allows('view-food', $this)) {
            return route('foods.show', ['food' => $this->id]);
        } else {
            return null;
        }
    }

    public function getUpdateUrlAttribute()
    {
        if (Gate::allows('update-food', $this)) {
            return route('foods.edit', ['food' => $this->id]);
        } else {
            return null;
        }
    }

    public function getDeleteUrlAttribute()
    {
        if (Gate::allows('delete-food', $this)) {
            return route('foods.destroy', ['food' => $this->id]);
        } else {
            return null;
        }
    }

}
