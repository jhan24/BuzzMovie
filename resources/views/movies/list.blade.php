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
                    <div class="panel-heading">Movie Results</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Year</th>
                                            <th>Critic's Score</th>
                                            <th>MPAA Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <span style="display:none">{{$i = 1}}</span>
                                        @foreach ($movies as $movie)
                                            <span style="display:none">{{$criticsScore = $movie->ratings->critics_score}}</span>
                                            @if ($criticsScore == -1)
                                                <span style="display:none">{{$criticsScore = "Unrated"}}</span>
                                            @endif
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td><a href="\movies\1\{{ $movie->id }}">{{ $movie->title }}</a></td>
                                                <td>{{ $movie->year }}</td>
                                                <td>{{ $criticsScore }}</td>
                                                <td>{{ $movie->mpaa_rating }}</td>
                                            </tr>
                                            <span style="display:none">{{$i = $i + 1}}</span>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection