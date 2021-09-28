<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductType extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

    public static function getByName(string $name): ?self
    {
        $model = self::where('name', $name)->first();

        if ($model) {
            return $model;
        }

        throw new ModelNotFoundException('The resource type "' . $name . '" was not found');
    }
}
