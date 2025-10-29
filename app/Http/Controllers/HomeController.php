<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display the home page with reviews slider
     */
    public function index()
    {
        // Get first 6 reviews for the slider on home page
        $allReviews = ReviewsController::getAllReviews();
        $reviews = array_slice($allReviews, 0, 12);
        
        return view('home', compact('reviews'));
    }
}

