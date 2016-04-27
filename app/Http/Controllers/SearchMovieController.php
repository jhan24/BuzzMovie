<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Rating;
use DB;

class SearchMovieController extends Controller
{
    public function showSearch() {
        return view('movies.search');
    }
    
    public function getRecentMovies() {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?apikey=yedukp76ffytfuy24zsqk7f5');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);


        return view("movies.list", ['movies' => $jsonData->movies]);
    }
    
    public function getRecentDVDs() {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://api.rottentomatoes.com/api/public/v1.0/lists/dvds/new_releases.json?apikey=yedukp76ffytfuy24zsqk7f5');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);


        return view("movies.list", ['movies' => $jsonData->movies]);
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
        $currentUser = Auth::user();
        return view("movies.detail", ['movie' => $jsonData, 'userRatings' => $this->getMovieAverageRating($jsonData->id), 'currentUserRating' => $this->getRatingByUserAndMovie($currentUser->id, $jsonData->id)]);
    }

    public function setMovieRating(Request $request, $id) {
        $currentUser = Auth::user();
        $rating = $request->rating;
        $this->createOrUpdateRating($currentUser->id, $id, $rating);
        return redirect()->route('showMovieDetail', $id);
    }

    private function createOrUpdateRating($userID, $movieID, $rating) {
        $user = User::find($userID);
        $ratingObject = Rating::firstOrCreate(['movieID' => $movieID, 'user_id' => $userID]); //short hand for what is commented out below
        //$rating = Rating::where('movieID', $movieID)->where('user_id', $userID);
//        if ($rating == NULL) {
//              create a rating with Rating::Create
//        } else {
//              update the individual fields (the rating field) as necessary
//        }
        $ratingObject->rating = $rating;
        $ratingObject->major = $user->major;
        $ratingObject->save();
    }
    
    private function getRatingByUserAndMovie($userID, $movieID) {
        $ratings = Rating::where('user_id', $userID)->where('movieID', $movieID)->first();
        if ($ratings == NULL) {
            return "Unrated";
        }
        return $ratings->rating;
    }
    
    private function getMovieAverageRating($movieID) {
        $ratings = Rating::where('movieID', $movieID);
        $sum = $ratings->sum('rating');
        $count = $ratings->count();
        if ($count == 0) {
            return "Unrated";
        }
        return $sum / $count;
    }

    public function showRecommendations() {
        $query = 'SELECT movieID, AVG(rating) AS avg_rating FROM ratings GROUP BY movieID ORDER BY avg_rating DESC LIMIT 0, 5';
        $avg = DB::select($query);
        $movies = collect();
        foreach ($avg as $rating) {
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, 'http://api.rottentomatoes.com/api/public/v1.0/movies/' . $rating->movieID . '.json?apikey=yedukp76ffytfuy24zsqk7f5');
            curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

            $jsonData = json_decode(curl_exec($curlSession));
            curl_close($curlSession);
            $movies->push($jsonData);
        }
        return view("movies.list", ['movies' => $movies]);
    }

    public function showMajorRecommendations() {
        $currentUser = Auth::user();
        $query = "SELECT movieID, AVG(rating) AS avg_rating FROM ratings WHERE major='" . $currentUser->major . "'GROUP BY movieID ORDER BY avg_rating DESC LIMIT 0, 5";
        $avg = DB::select($query);
        $movies = collect();
        foreach ($avg as $rating) {
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, 'http://api.rottentomatoes.com/api/public/v1.0/movies/' . $rating->movieID . '.json?apikey=yedukp76ffytfuy24zsqk7f5');
            curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

            $jsonData = json_decode(curl_exec($curlSession));
            curl_close($curlSession);
            $movies->push($jsonData);
        }
        return view("movies.list", ['movies' => $movies]);
    }
}
