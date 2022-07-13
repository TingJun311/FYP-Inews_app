<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http; // To fetch API endpoints
use App\Helpers\UserSystemInfoHelper; // a class to get user system information 
use Stevebauman\Location\Facades\Location; // Composer packages to get client ip

class news extends Controller
{
    public function getTopHeadlines() {
        // Get all from Top headlines will get user ip address dynamically
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=my&apiKey=' . env('NEWS_API_KEY'));
        $news = $response->json();
        // $data = Location::get(request()->getClientIps());

        if ($response) {
            return view('index', [
                'newsData' => $news,
            ]);
        } else {
            abort(404);
        }

    }

    public function getByCategory($category) {

        $response = Http::get('https://newsapi.org/v2/top-headlines?apiKey=' . env('NEWS_API_KEY') .'&category=' . $category . '&country=my&pageSize=100');
        $newsByCategory = $response->json();

        if ($response) {
            return view('index', [
                'newsData' => $newsByCategory,
            ]);
        } else {
            abort(404);
        }
    }

    // Get single articles
    public function getArticles() {

        return view('news.article', [
            "link" => request()->link
        ]);

    }

    public function bookmark($articles) {
        dd($articles);
    }
}
