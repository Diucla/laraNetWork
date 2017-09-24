@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="col-lg-4">

            <!-- ======================================================================= -->
            <!-- =================== Avatar, Button to Edit Profile ===================== -->
            <!-- ======================================================================= -->

            <div class="panel panel-default">

                <div class="panel-heading">

                    <p class="text-center">

                        {{ $user->name  }}'s Profile.

                    </p>

                </div>

                <div class="panel-body">


                    <!-- User Avatar -->

                    <img src="{{ Storage::url($user->avatar) }}" width="140px" height="140px" alt="{{ $user->name }}'s profile photo " style="display: block; margin: 0 auto; border-radius: 50%">

                    <!-- User Location -->

                    <p class="text-center" style="margin-top: 2em">

                        {{ $user->profile->location }}

                    </p>

                    <!-- Button to edit Information -->

                    <p class="text-center" style="margin-top: 2em">

                        @if(Auth::id() == $user->id)

                            <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info"> Edit your profile </a>

                        @endif

                    </p>

                </div>

            </div>

            <!-- ========================================================================= -->
            <!-- ==========================  More Information ============================ -->
            <!-- ========================================================================= -->

            <div class="panel panel-default">

                <div class="panel-heading">

                    <p class="text-center">

                        About Me.

                    </p>

                </div>

                <div class="panel-body">


                    <p class="text-center">

                        {{ $user->profile->about }}

                    </p>


                </div>

            </div>

        </div>

    </div>


@stop