<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuid;

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function setType(ProductType $type): self
    {
        $this->productType()->associate($type);
        return $this;
    }

    public function setLocation(Location $location): self
    {
        $this->location()->associate($location);
        return $this;
    }
}
