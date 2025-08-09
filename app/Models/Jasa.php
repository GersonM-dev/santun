<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $table = 'jasas'; // Explicitly tell Eloquent
    protected $fillable = [
        'donasi_id',
        'description_jasa',
        'jasa_attachment',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
}
