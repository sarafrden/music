<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionChannel extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function trackDistributions()
    {
        return $this->hasMany(TrackDistribution::class);
    }
}
