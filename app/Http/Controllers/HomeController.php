<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\School;
use App\Models\Homepage;
use App\Models\HeroImage;

class HomeController extends Controller
{
    public function index()
    {
        $school = School::first();
        $homepage = Homepage::getSettings();

        // Get active hero images
        $heroImages = HeroImage::getActiveImages();

        $latestNews = News::published()->latest()->take(3)->get();
        $featuredGallery = Gallery::featured()->take(6)->get();

        return view('home', compact('school', 'homepage', 'heroImages', 'latestNews', 'featuredGallery'));
    }
}
