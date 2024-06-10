<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamingAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id', 'play_count', 'likes', 'shares'
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
