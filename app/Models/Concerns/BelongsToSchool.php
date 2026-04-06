<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToSchool
{
    protected static function bootBelongsToSchool(): void
    {
        static::addGlobalScope('school', function (Builder $builder) {
            if (app()->runningInConsole() || ! auth()->check()) {
                return;
            }

            $schoolId = session('school_id');

            if (! $schoolId) {
                $builder->whereRaw('1 = 0');
                return;
            }

            $builder->where($builder->getModel()->getTable() . '.school_id', $schoolId);
        });

        static::creating(function ($model) {
            if (app()->runningInConsole()) {
                return;
            }

            if (! empty($model->school_id)) {
                return;
            }

            $schoolId = session('school_id');

            if ($schoolId) {
                $model->school_id = $schoolId;
            }
        });
    }
}
