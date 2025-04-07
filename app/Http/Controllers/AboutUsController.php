<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display the about us page.
     */
    public function index()
    {
        // Get the first (and likely only) about us record
        $aboutUs = AboutUs::first();
        
        return view('aboutus.index', compact('aboutUs'));
    }
}