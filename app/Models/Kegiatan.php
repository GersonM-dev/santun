<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'name',
        'date',
        'konten',
        'gambar',
        'youtube_video_link',
        'lokasi',
        'is_approved',
        'status',
    ];
}
