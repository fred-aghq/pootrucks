<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductType;
use App\Transformers\ResourceStoreJsonTransformer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        $data = $request->input();
        $resource = new Product;

        $resource->amount = $data['amount'];
        $resource->location = $data['location'];

        $type = ProductType::firstOrCreate([
            'name' => $data['type'],
        ]);

        $resource->setType($type);

        $resource->save();
        return response(new ProductResource($resource), 201);
    }

    public function index(Request $request)
    {
        return ProductResource::collection(Product::all());
    }
}
