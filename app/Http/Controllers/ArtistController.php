<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
class ArtistController extends Controller
{
    public function index()
    {
        return Artist::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'stage_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'genre' => 'nullable|string',
            'image_url' => 'nullable|string'
        ]);

        $artist = Artist::create($request->all());

        return response()->json($artist, 201);
    }

    public function show(Artist $artist)
    {
        return $artist;
    }

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'stage_name' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string',
            'genre' => 'sometimes|string',
            'image_url' => 'sometimes|string'
        ]);

        $artist->update($request->all());

        return response()->json($artist, 200);
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return response()->json(null, 204);
    }
}
