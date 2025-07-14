<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $fillable = ['name', 'short_code'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
