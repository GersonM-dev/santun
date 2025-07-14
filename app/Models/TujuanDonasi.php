<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TujuanDonasi extends Model
{
    protected $fillable = ['name', 'is_active', 'description'];

    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'tujuan_donasi_id');
    }
}
