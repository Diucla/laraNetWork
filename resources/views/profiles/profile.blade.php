@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="col-lg-4">

            <div class="panel panel-default">

                <div class="panel-heading">

                    {{ $user->name  }}'s Profile.

                </div>

                <div class="panel-body">

                    <img src="{{ $user->avatar }}" width="70px" height="70px" style="border-radius: 50%" alt="{{ $user->name }}'s profile photo ">

                </div>

            </div>

        </div>

    </div>


@stop