<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http; // To fetch API endpoints
use App\Helpers\UserSystemInfoHelper; // a class to get user system information 
use Stevebauman\Location\Facades\Location; // Composer packages to get client ip~

use function PHPUnit\Framework\isNull;

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
        return view('news.category', [
            'category' => $category,
        ]);
    }

    // Get single articles
    public function getArticles() {

        return view('news.article', [
            "link" => request()->link
        ]);

    }

    public function bookmark(Request $request) {
        // POST request from ajax through laravel post route
        return response()->json($request->all());
    }

    public function searchNews(Request $request) {
        // return response()->json($request->all());

        if (!isNull($request->searchBpx) || !empty($request->searchBox))
            return view('search.result', [
                'searchData' => $request->searchBox
            ]);
        }
}
