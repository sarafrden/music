<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
class TypeController extends Controller
{
    public function index()
    {
        return response()->json(Type::get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'name|string|max:255',
        ]);

        $Type = Type::create($request->all());

        return response()->json($Type, 201);
    }

    public function show(Type $Type)
    {
        return response()->json($Type->load(['album', 'artist']));
    }

    public function update(Request $request, Type $Type)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $Type->update($request->all());

        return response()->json($Type, 200);
    }

    public function destroy(Type $Type)
    {
        $Type->delete();

        return response()->json(null, 204);
    }
}
