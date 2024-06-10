<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DdexTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_type', 'status'];

    public function metadata()
    {
        return $this->hasMany(DdexMetadata::class);
    }
}
