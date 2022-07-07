<?php

namespace App\Http\Controllers;

use Stevebauman\Location\Facades\Location; // Composer packages to get client ip
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // To fetch API endpoints
use App\Helpers\UserSystemInfoHelper; // a class to get user system information 

class news extends Controller
{
    public function getEverything() {
        // Get all from Top headlines
        $response = Http::get('https://newsapi.org/v2/everything?q=latest&apiKey=' . env('NEWS_API_KEY') . '&language=en');
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

        // Http::async()
        //     ->get('https://newsapi.org/v2/everything?q=latest&apiKey=' . env('NEWS_API_KEY') . '&language=en')
        //     ->then(function ($response) {
        //         $news = $response->object();

        //         if ($response) {
        //             return view('index', [
        //                 'newsData' => $news->articles,
        //                 // 'userInfo' => $data
        //             ]);
        //         } else {
        //             abort(404);
        //         }
        // });
    }

    public function getTopHeadlines() {

        $response = Http::get('https://newsapi.org/v2/top-headlines?apiKey=' . env('NEWS_API_KEY') .'&country=my');
    }
}
