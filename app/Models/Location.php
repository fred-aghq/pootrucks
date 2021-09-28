<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
