<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isNull;

class PaginationController extends Controller
{
    public function getPage(Request $request) {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://free-news.p.rapidapi.com/v1/search?q=latest&lang=en&page=" . $request->currentPage,
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

        return ($err)? abort(404) : response()->json($response);
    }

    public function getLang(Request $request) {

        $response = Http::get('https://newsapi.org/v2/everything?q=latest&apiKey=' . env('NEWS_API_KEY') . '&language=' . $request->lang);
        return response()->json($response->json());
    }
}
