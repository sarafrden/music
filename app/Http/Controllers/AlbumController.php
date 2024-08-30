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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'featuring' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'sub_genre' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'format' => 'nullable|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_date' => 'nullable|date',
            'is_compilation' => 'nullable',
            'cover_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('cover_url')) {
            $image = $request->file('cover_url')->store('images/albums', 'public');
            $data['cover_url'] = $image;
        }



        $album = Album::create($data);

        return response()->json($album, 201);
    }

    public function show(Album $album)
    {
        return response()->json($album->load('artist'));
    }

    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'release_date' => 'sometimes|date',
            'sub_title' => 'nullable|string|max:255',
            'featuring' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'sub_genre' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'format' => 'nullable|string|max:255',
            'is_compilation' => 'nullable',
            'cover_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('cover_url')) {
            $image = $request->file('cover_url')->store('images/albums', 'public');
            $data['cover_url'] = $image;
        }
        $album->update($data);

        return response()->json($album, 200);
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return response()->json(null, 204);
    }
}
