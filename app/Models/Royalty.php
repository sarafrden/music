<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Royalty extends Model
{
    use HasFactory;
    protected $fillable = [
        'artist_id', 'amount', 'date'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
