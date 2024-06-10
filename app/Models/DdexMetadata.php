<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdexMetadata extends Model
{
    use HasFactory;
    protected $fillable = ['ddex_transaction_id', 'key', 'value'];

    public function transaction()
    {
        return $this->belongsTo(DdexTransaction::class);
    }
}
