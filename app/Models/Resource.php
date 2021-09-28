<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory, HasUuid;

    public function resourceType(): BelongsTo
    {
        return $this->belongsTo(ResourceType::class);
    }

    public function setType(ResourceType $type): self
    {
        $this->resourceType()->associate($type);
        return $this;
    }
}
