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
                    <div class="panel-heading">Search</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                Search for movies below!
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="GET" action="{{ url('/movies/search/query') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="searchQuery" id="searchText" placeholder="Search for movies...">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection