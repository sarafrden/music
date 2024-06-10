<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'album_id', 'artist_id', 'duration', 'audio_url'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function analytics()
    {
        return $this->hasMany(StreamingAnalytics::class);
    }

    public function distribution()
    {
        return $this->hasMany(TrackDistribution::class);
    }
}
