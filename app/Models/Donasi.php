<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'date',
        'type',
        'tujuan_donasi_id',
        'catatan',
        'is_anonymous',
        'user_id',
    ];

    public function tujuanDonasi()
    {
        return $this->belongsTo(TujuanDonasi::class, 'tujuan_donasi_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function money()
    {
        return $this->hasOne(Money::class);
    }

    public function jasa()
    {
        return $this->hasOne(Jasa::class);
    }
}
