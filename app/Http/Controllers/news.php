<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http; // To fetch API endpoints
use App\Helpers\UserSystemInfoHelper; // a class to get user system information 
use Stevebauman\Location\Facades\Location; // Composer packages to get client ip~

use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\throwException;

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
            'page' => 1,
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




    // Testing
    public function getAPINews(Request $request) {
        // return response()->json($request['query']);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://free-news.p.rapidapi.com/v1/search?q=" . $request['query'] ."&lang=" . $request['lang'] . "&page=" . $request['page'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: " . env('API_HOST'),
                "X-RapidAPI-Key: " . env('API_KEY')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return response()->json($response);
    }
    public function getNews() {
        return view('main', [
            'query' => 'latest',
            'lang' => 'en',
            'page' => 1
        ]);
    }

    public function getLatest($category, $langs, $articles, $pages, $totalPages) {

        $data = [
            'q' => 'bmw',
            'lang' => 'en',
            'page' => 1,
        ];
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => env('API_HOST'),
            'X-RapidAPI-Key' => env('API_KEY'),
        ])->get('https://free-news.p.rapidapi.com/v1/search', $data);

        if ($response->failed()) {
            throw new \RuntimeException('Failed to convert', $response->status());
        }
        return response()->json($response);
    }
}
