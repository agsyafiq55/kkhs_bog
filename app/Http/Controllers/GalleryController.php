<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery images.
     */
    public function index(Request $request)
    {
        $selectedCategory = $request->category;
        
        $query = Gallery::orderBy('created_at', 'desc');
        
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }
        
        $images = $query->get();
        
        // Get all unique categories for the filter
        $categories = Gallery::select('category')->distinct()->pluck('category');
        
        return view('gallery.index', compact('images', 'categories', 'selectedCategory'));
    }

    /**
     * Display the specified gallery image.
     */
    public function show($id)
    {
        $image = Gallery::findOrFail($id);
        
        // Get related images from the same category (excluding the current image)
        $relatedImages = Gallery::where('category', $image->category)
            ->where('id', '!=', $image->id)
            ->limit(4)
            ->get();
            
        return view('gallery.show', compact('image', 'relatedImages'));
    }
}