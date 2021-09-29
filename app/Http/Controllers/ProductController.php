<?php

namespace App\Http\Controllers;

use App\Events\ProductCreated;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        $data = $request->input();
        $data['id'] = Str::uuid()->toString();

        event(new ProductCreated($data));

        return response(new ProductResource(Product::find($data['id'])), 201);
    }

    public function index(Request $request)
    {
        return ProductResource::collection(Product::all());
    }
}
