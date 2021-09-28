<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function boot()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        parent::boot();
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
