<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DdexTransaction;
use App\Services\DdexService;

class DdexController extends Controller
{
    protected $ddexService;

    public function __construct(DdexService $ddexService)
    {
        $this->ddexService = $ddexService;
    }

    public function handleDdexXml(Request $request)
    {
        $xmlString = $request->input('xml');
        $this->ddexService->parseDdexXml($xmlString);

        return response()->json(['message' => 'DDEX XML processed successfully.']);
    }
    public function handleTransaction(Request $request)
    {
        $xmlString = $request->getContent();
        $this->ddexService->parseDdexXml($xmlString);

        return response()->json(['message' => 'DDEX transaction processed successfully'], 200);
    }
    public function index()
    {
        return response()->json(DdexTransaction::with('metadata')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|string',
            'status' => 'nullable|string'
        ]);

        $transaction = DdexTransaction::create($request->all());

        return response()->json($transaction, 201);
    }

    public function show(DdexTransaction $transaction)
    {
        return response()->json($transaction->load('metadata'));
    }

    public function update(Request $request, DdexTransaction $transaction)
    {
        $request->validate([
            'transaction_type' => 'required|string',
            'status' => 'nullable|string'
        ]);

        $transaction->update($request->all());

        return response()->json($transaction, 200);
    }

    public function destroy(DdexTransaction $transaction)
    {
        $transaction->delete();

        return response()->json(null, 204);
    }
}
