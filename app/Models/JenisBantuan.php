<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBantuan extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the Bantuan records associated with this JenisBantuan.
     */
    public function bantuans()
    {
        return $this->hasMany(Bantuan::class);
    }
}
