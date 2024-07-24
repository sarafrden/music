<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
class TrackController extends Controller
{
    public function index()
    {
        return response()->json(Track::with(['album', 'artist'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'album_id' => 'required|exists:albums,id',
            'artist_id' => 'required|exists:artists,id',
            'duration' => 'required|integer',
            'audio_url' => 'nullable|string'
        ]);

        $track = Track::create($request->all());

        return response()->json($track, 201);
    }

    public function show(Track $track)
    {
        return response()->json($track->load(['album', 'artist']));
    }

    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|integer',
            'audio_url' => 'nullable|string'
        ]);

        $track->update($request->all());

        return response()->json($track, 200);
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return response()->json(null, 204);
    }
}
