<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\ResourceType;
use App\Transformers\ResourceStoreJsonTransformer;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function store(Request $request)
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
        return response()->json($resource, 200);
    }

    public function index(Request $request)
    {
        return Resource::all();
    }
}
