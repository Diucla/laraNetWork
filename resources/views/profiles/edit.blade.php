@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit your profile.</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{ route('profile.update') }}" method="post">

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label for="location">Location</label>

                                    <input type="text" name="location" value="{{ $info->location }}" class="form-control" required>

                                </div>

                                <div class="form-group">

                                    <label for="about">About</label>

                                    <textarea name="about" id="about" cols="25" rows="9" class="form-control" required> {{ $info->about }} </textarea>

                                </div>

                                <div class="form-group">

                                    <button class="btn btn-primary btn-lg" type="submit">

                                        save information

                                    </button>

                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
