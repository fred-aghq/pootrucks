<?php

namespace App\Http\Controllers;

use App\Http\Requests\MissionStoreRequest;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function store(MissionStoreRequest $request)
    {
        return response()->json($request->getContent(), 200);
    }
}
