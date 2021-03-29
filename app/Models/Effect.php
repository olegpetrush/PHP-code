<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * Class Effect
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @mixin Builder
 */
class Effect extends Model
{
    protected $appends
        = [
            'view_url',
            'update_url',
            'delete_url'
        ];

    public function getViewUrlAttribute()
    {
        if (Gate::allows('view-effect', $this)) {
            return route('effects.show', ['effect' => $this->id]);
        } else {
            return null;
        }
    }

    public function getUpdateUrlAttribute()
    {
        if (Gate::allows('update-effect', $this)) {
            return route('effects.edit', ['effect' => $this->id]);
        } else {
            return null;
        }
    }

    public function getDeleteUrlAttribute()
    {
        if (Gate::allows('delete-effect', $this)) {
            return route('effects.destroy', ['effect' => $this->id]);
        } else {
            return null;
        }
    }

}
