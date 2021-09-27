<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function store(Request $request)
    {
        $data = json_decode($request->getContent());
        $resource = new Resource;
        $resource->type = $data->type;
        $resource->amount = $data->amount;
        $resource->location = $data->location;
        $resource->save();
        return response('Resource stored', 200)->header('Content-Type', 'text/plain');
    }

    public function index(Request $request)
    {
        return Resource::all();
    }
}
