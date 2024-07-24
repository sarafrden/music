<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StreamingAnalytics;
class StreamingAnalyticsController extends Controller
{
    public function index()
    {
        return response()->json(StreamingAnalytics::with('track')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'play_count' => 'required|integer',
            'likes' => 'required|integer',
            'shares' => 'required|integer'
        ]);

        $analytics = StreamingAnalytics::create($request->all());

        return response()->json($analytics, 201);
    }

    public function show(StreamingAnalytics $analytics)
    {
        return response()->json($analytics->load('track'));
    }

    public function update(Request $request, StreamingAnalytics $analytics)
    {
        $request->validate([
            'play_count' => 'required|integer',
            'likes' => 'required|integer',
            'shares' => 'required|integer'
        ]);

        $analytics->update($request->all());

        return response()->json($analytics, 200);
    }

    public function destroy(StreamingAnalytics $analytics)
    {
        $analytics->delete();

        return response()->json(null, 204);
    }
}
