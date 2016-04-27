<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SearchMovieController extends Controller
{
    public function showSearch() {
        return view('movies.search');
    }
    
    public function getRecentMovies() {
        
    }
    
    public function getRecentDVDs() {
        
    }

    public function showSearchQuery(Request $request) {
        $movieSearchQuery = $request->query("searchQuery");
        $query = str_replace(" ", "%20", $movieSearchQuery);
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=yedukp76ffytfuy24zsqk7f5&q=' . $query . '&page_limit=50');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);


        return view("movies.list", ['movies' => $jsonData->movies]);
    }

    public function showMovieDetail($id) {
        
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://api.rottentomatoes.com/api/public/v1.0/movies/' . $id . '.json?apikey=yedukp76ffytfuy24zsqk7f5');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        
        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

        return view("movies.detail", ['movie' => $jsonData]);
    }

    public function setMovieRating(Request $request, $id) {
        
    }
}
