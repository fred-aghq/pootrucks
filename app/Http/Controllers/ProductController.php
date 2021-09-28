<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\Location;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        $data = $request->input();
        $resource = new Product;

        $resource->amount = $data['amount'];

        $type = ProductType::firstOrCreate([
            'name' => $data['type'],
        ]);

        $location = Location::firstOrCreate([
            'name' => $data['location'],
        ]);

        $resource->setType($type);
        $resource->setLocation($location);
        $resource->save();

        return response(new ProductResource($resource), 201);
    }

    public function index(Request $request)
    {
        return ProductResource::collection(Product::all());
    }
}
