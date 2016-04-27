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
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            just fuck my shit up fam
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-12">
                            <a class="btn btn-default" href="/movies/search" role="button">Search Movies</a>
                            <a class="btn btn-default" href="/movies/list/latest" role="button">Recent Movies</a>
                            <a class="btn btn-default" href="/movies/list/dvd" role="button">Recent DVDs</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-12">
                            <a class="btn btn-default" href="/movies/recommendations/general" role="button">Get Recommendations</a>
                            <a class="btn btn-default" href="/movies/recommendations/major" role="button">Get Major Recommendations</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
