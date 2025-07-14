<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $fillable = [
        'tanggal',
        'id_jenisBantuan',
        'nama',
        'date_birth',
        'keluhan',
        'alamat',
        'kontak',
        'status',
    ];

    /**
     * Get the jenis bantuan associated with the bantuan.
     */
    public function jenisBantuan()
    {
        return $this->belongsTo(JenisBantuan::class, 'id_jenisBantuan');
    }
}
