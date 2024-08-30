<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist_id',
        'release_date',
        'cover_url',
        'sub_title',
        'featuring',
        'genre',
        'sub_genre',
        'format',
        'label',
        'is_compilation',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
