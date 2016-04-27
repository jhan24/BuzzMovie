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
                    <div class="panel-heading">Profile</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">

                                    <div class="input-group">
                                        <input id="nameText" type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
                                        <span class="input-group-btn">
                                            <button id="editNameButton" type="button" class="btn btn-default">Edit</button>
                                        </span>
                                    </div>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="usernameText" type="text" class="form-control" name="username" value="{{ $user->username }}" readonly>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">

                                    <div class="input-group">
                                        <input id="emailText" type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                                        <span class="input-group-btn">
                                            <button id="editEmailButton" type="button" class="btn btn-default">Edit</button>
                                        </span>
                                    </div>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Major</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="majorText" type="text" class="form-control" name="major" value="{{ $user->major }}" readonly>
                                    <span class="input-group-btn">
                                            <button id="editMajorButton" type="button" class="btn btn-default">Edit</button>
                                        </span>
                                    </div>

                                    @if ($errors->has('major'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('major') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="passwordText" type="password" class="form-control" name="password" readonly>
                                    <span class="input-group-btn">
                                            <button id="editPasswordButton" type="button" class="btn btn-default">Edit</button>
                                        </span>
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="passwordConfirmationText" type="password" class="form-control" name="password_confirmation" readonly>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Submit Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#editNameButton').click(function() {
            $('#nameText').removeAttr("readonly");
        });
        $('#editEmailButton').click(function() {
            $('#emailText').removeAttr("readonly");
        });
        $('#editMajorButton').click(function() {
            $('#majorText').removeAttr("readonly");
        });
        $('#editPasswordButton').click(function() {
            $('#passwordText').removeAttr("readonly");
            $('#passwordConfirmationText').removeAttr("readonly");
        });
    </script>
@endsection