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
                    <div class="panel-heading">User List</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Major</th>
                                        <th>Ban Status</th>
                                        <th>Admin Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)

                                        <tr>
                                            <th scope="row">{{$user->id}}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->major }}</td>
                                            <td><a class="btn btn-default" href="/admin/toggleBan/{{$user->id}}" role="button">{{ $user->isBanned ? "Unban" : "Ban" }}</a></td>
                                            <td>{{ $user->isAdmin }}</td>
                                        </tr>
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