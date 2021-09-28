<?php

namespace App\Projectors;

use App\Events\ProductAmountAdded;
use App\Events\ProductAmountSubtracted;
use App\Events\ProductCreated;
use App\Models\Concerns\HasUuid;
use App\Models\Location;
use App\Models\Product;
use App\Models\ProductType;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ProductTotalAmountProjector extends Projector
{
    public function onProductCreated(ProductCreated $event)
    {
        $product = new Product(
            $event->attributes
        );

        $product->id = $event->attributes['id'];

        $type = ProductType::firstOrCreate([
            'name' => $event->attributes['type'],
        ]);

        $location = Location::firstOrCreate([
            'name' => $event->attributes['location'],
        ]);

        $product->setType($type);
        $product->setLocation($location);

        $product->save();
    }

    public function onProductAmountAdded(ProductAmountAdded $event)
    {
        $product = Product::find($event->modelId);

        $product->amount += $event->amount;

        $product->save();
    }

    public function onProductAmountSubtracted(ProductAmountSubtracted $event)
    {
        $product = Product::find($event->modelId);

        $product->amount -= $event->amount;

        $product->save();
    }
}
