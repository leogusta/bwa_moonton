<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $featureMovies = Movie::whereIsFeatured(true)->get();
        $movies = Movie::all();

        /* return [
            'featureMovies' => $featureMovies,
            'movies' => $movies
        ]; */

        return inertia('User/Dashboard/Index', compact('featureMovies', 'movies'));
    }
}
