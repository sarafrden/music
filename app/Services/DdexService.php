<?php

namespace App\Services;

use App\Models\DdexTransaction;
use App\Models\DdexMetadata;

class DdexService
{
    public function parseDdexXml($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $transaction = DdexTransaction::create([
            'transaction_type' => (string) $xml->getName(),
            'status' => 'processed',
        ]);

        foreach ($xml->children() as $key => $value) {
            DdexMetadata::create([
                'ddex_transaction_id' => $transaction->id,
                'key' => $key,
                'value' => (string) $value,
            ]);
        }
    }
}
