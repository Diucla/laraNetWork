@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="col-lg-4">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <p class="text-center">

                        {{ $user->name  }}'s Profile.

                    </p>

                </div>

                <div class="panel-body">

                        <img src="{{ $user->avatar }}" width="130px" height="130px" alt="{{ $user->name }}'s profile photo " style="display: block; margin: 0 auto; border-radius: 50%">

                        <p class="text-center">
                             
                            @if(Auth::id() == $user->id)

                                <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info"> Edit your profile </a>
                                
                            @endif

                        </p>

                </div>

            </div>

        </div>

    </div>


@stop