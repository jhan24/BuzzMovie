@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $movie->title }}</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="display:none">{{$criticsScore = $movie->ratings->critics_score}}</span>
                                @if ($criticsScore == -1)
                                    <span style="display:none">{{$criticsScore = "Unrated"}}</span>
                                @endif
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Year</th>
                                        <th>MPAA Rating</th>
                                        <th>Critics Score</th>
                                        <th>Runtime</th>
                                        <th>User Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $movie->title }}</td>
                                        <td>{{ $movie->year }}</td>
                                        <td>{{ $movie->mpaa_rating }}</td>
                                        <td>{{ $criticsScore }}</td>
                                        <td>{{ $movie->runtime }}</td>
                                        <td>{{ $userRatings }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p>{{ $movie->synopsis }}</p>
                                <br>
                                <p>Rate the movie!</p>
                                <p>Your current rating is: {{ $currentUserRating }}</p>
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/movies/1/' . $movie->id) }}">
                                    {!! csrf_field() !!}
                                    <select name="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <br> <br>
                                    <button type="submit" class="btn btn-default">Rate</button>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection