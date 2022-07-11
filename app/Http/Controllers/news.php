<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http; // To fetch API endpoints
use App\Helpers\UserSystemInfoHelper; // a class to get user system information 
use Stevebauman\Location\Facades\Location; // Composer packages to get client ip

class news extends Controller
{
    public function getEverything() {
        // Get all from Top headlines
        $response = Http::get('https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=' . env('NEWS_API_KEY') . '&language=en');
        $news = $response->json();
        // $data = Location::get(request()->getClientIps());

        if ($response) {
            return view('index', [
                'newsData' => $news,
                // 'userInfo' => $data
            ]);
        } else {
            abort(404);
        }

    }

    public function getTopHeadlines() {

        $response = Http::get('https://newsapi.org/v2/top-headlines?apiKey=' . env('NEWS_API_KEY') .'&country=my');
    }
}
