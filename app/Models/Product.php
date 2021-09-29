<?php

namespace App\Models;

use App\Events\ProductAmountAdded;
use App\Events\ProductAmountSubtracted;
use App\Events\ProductCreated;
use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name',
        'location_id',
        'product_type_id',
        'amount',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->id = $this->id ?? Str::uuid()->toString();
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

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

    public function addAmount(float $amount)
    {
        event(new ProductAmountAdded($this->id, $amount));
        return $this->refresh();
    }

    public function subAmount(float $amount)
    {
        event(new ProductAmountSubtracted($this->id, $amount));
        return $this->refresh();
    }

    public function getKeyType(): string
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }
}
