<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
class AlbumController extends Controller
{
    public function index()
    {
        return response()->json(Album::with('artist')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_date' => 'nullable|date',
            'cover_url' => 'nullable|string'
        ]);

        $album = Album::create($request->all());

        return response()->json($album, 201);
    }

    public function show(Album $album)
    {
        return response()->json($album->load('artist'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'release_date' => 'sometimes|date',
            'cover_url' => 'sometimes|string'
        ]);

        $album->update($request->all());

        return response()->json($album, 200);
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return response()->json(null, 204);
    }
}
