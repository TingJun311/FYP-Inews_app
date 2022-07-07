<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class news extends Controller
{
    public function fetchAll() {
        $response = Http::get('https://newsapi.org/v2/top-headlines?apiKey=' . env('NEWS_API_KEY') .'&country=my');
        $news = $response->object();

        if ($response) {
            return view('index', [
                'newsData' => $news->articles,
            ]);
        } else {
            abort(404);
        }
    }
}
