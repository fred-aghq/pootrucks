<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceStoreRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Models\ResourceType;
use App\Transformers\ResourceStoreJsonTransformer;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function store(ResourceStoreRequest $request)
    {
        $data = $request->input();
        $resource = new Resource;

        $resource->amount = $data['amount'];
        $resource->location = $data['location'];

        $type = ResourceType::firstOrCreate([
            'name' => $data['type'],
        ]);

        $resource->setType($type);

        $resource->save();
        return response(new ResourceResource($resource), 201);
    }

    public function index(Request $request)
    {
        return ResourceResource::collection(Resource::all());
    }
}
