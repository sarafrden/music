<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackDistribution;
class TrackDistributionController extends Controller
{
    public function index()
    {
        return response()->json(TrackDistribution::with(['track', 'distributionChannel'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'distribution_channel_id' => 'required|exists:distribution_channels,id',
            'status' => 'required|string|max:255'
        ]);

        $distribution = TrackDistribution::create($request->all());

        return response()->json($distribution, 201);
    }

    public function show(TrackDistribution $distribution)
    {
        return response()->json($distribution->load(['track', 'distributionChannel']));
    }

    public function update(Request $request, TrackDistribution $distribution)
    {
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        $distribution->update($request->all());

        return response()->json($distribution, 200);
    }

    public function destroy(TrackDistribution $distribution)
    {
        $distribution->delete();

        return response()->json(null, 204);
    }
}
