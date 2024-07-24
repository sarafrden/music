<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Royalty;
class RoyaltyController extends Controller
{
    public function index()
    {
        return response()->json(Royalty::with('artist')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $royalty = Royalty::create($request->all());

        return response()->json($royalty, 201);
    }

    public function show(Royalty $royalty)
    {
        return response()->json($royalty->load('artist'));
    }

    public function update(Request $request, Royalty $royalty)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        $royalty->update($request->all());

        return response()->json($royalty, 200);
    }

    public function destroy(Royalty $royalty)
    {
        $royalty->delete();

        return response()->json(null, 204);
    }
}
