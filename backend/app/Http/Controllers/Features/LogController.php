<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\Features\LogRequest;
use App\Models\Log;
use App\Http\Resources\LogResource;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Get all logs success.',
            'data' => LogResource::collection(Log::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LogRequest $request)
    {
        $log = auth('api')->user()->logs()->create($request->validated());

        return response()->json([
            'message' => 'Create log success.',
            'data' => new LogResource($log)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        return response()->json([
            'message' => 'Get log success.',
            'data' => new LogResource($log)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LogRequest $request, Log $log)
    {
        $log->update($request->validated());

        return response()->json([
            'message' => 'Update log success.',
            'data' => new LogResource($log->refresh())
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        $log->delete();

        return response()->json([
            'message' => 'delete log success.',
            'data' => new LogResource($log)
        ], 200);
    }
}
