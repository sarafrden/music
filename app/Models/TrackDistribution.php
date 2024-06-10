<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackDistribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'track_id', 'distribution_channel_id', 'status'
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function distributionChannel()
    {
        return $this->belongsTo(DistributionChannel::class);
    }
}
