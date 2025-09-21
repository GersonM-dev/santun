<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AboutSection
 *
 * This model represents a section of the “Tentang Kami” (About Us) page.
 * Each record stores a unique key identifying the type of section (for example
 * `our_advantage_title` or `features_body`), a human‑friendly title,
 * rich text content, and an optional numeric order used to sort sections on
 * the page. Using a database‑backed model allows administrators to edit
 * the about page via a Filament resource without touching source code.
 */
class AboutSection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'title',
        'content',
        'order',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about_sections';
}