<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    protected $fillable = [
        'donasi_id',
        'total',
        'proof_picture',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
}
