<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'donasi_id',
        'name',
        'qty',
        'satuan_id',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}
