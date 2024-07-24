<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DistributionChannel;
class DistributionChannelController extends Controller
{
    public function index()
    {
        return response()->json(DistributionChannel::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $channel = DistributionChannel::create($request->all());

        return response()->json($channel, 201);
    }

    public function show(DistributionChannel $channel)
    {
        return response()->json($channel);
    }

    public function update(Request $request, DistributionChannel $channel)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $channel->update($request->all());

        return response()->json($channel, 200);
    }

    public function destroy(DistributionChannel $channel)
    {
        $channel->delete();

        return response()->json(null, 204);
    }
}
