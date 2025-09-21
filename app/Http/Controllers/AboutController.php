<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Contracts\View\View;

/**
 * Controller responsible for displaying the About page.
 *
 * This controller retrieves all AboutSection records from the database,
 * orders them by the `order` column and groups them by their `key` so
 * the view can easily access specific sections. The resulting
 * associative array is passed to the `about` view under the variable
 * name `$aboutContent`.
 */
class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return View
     */
    public function show(): View
    {
        // Fetch all about sections sorted by the order field
        $sections = AboutSection::orderBy('order')->get();

        // Transform into associative array keyed by `key` for easy lookup
        $aboutContent = [];
        foreach ($sections as $section) {
            $aboutContent[$section->key] = $section;
        }

        return view('about', compact('aboutContent'));
    }
}