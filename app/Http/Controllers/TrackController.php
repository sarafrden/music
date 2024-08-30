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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'album_id' => 'required|exists:albums,id',
            'artist_id' => 'required|exists:artists,id',
            'duration' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'audio_url' => 'required|mimes:mp3,wav,ogg|max:100240',
        ]);
        if ($request->hasFile('audio_url')) {
            $audio_url = $request->file('audio_url')->store('audio_files/Tracks', 'public');
            $data['audio_url'] = $audio_url;
        }
        $track = Track::create($data);

        return response()->json($track, 201);
    }

    public function show(Track $track)
    {
        return response()->json($track->load(['album', 'artist']));
    }

    public function update(Request $request, Track $track)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'duration' => 'nullable|integer',
            'audio_url' => 'nullable|mimes:mp3,wav,ogg|max:100240', // max 10MB,
            'type_id' => 'nullable|exists:types,id',
        ]);
        if ($request->hasFile('audio_url')) {
            $audio_url = $request->file('audio_url')->store('audio_files/Tracks', 'public');
            $data['audio_url'] = $audio_url;
        }
        $track->update($data);

        return response()->json($track, 200);
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return response()->json(null, 204);
    }

}
