<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class FriendshipsController extends Controller
{

    public function check($id)

    {

        if(Auth::user()->is_friends_with($id) === 1)

        {

            return ["status" => "friends"];

        }

        if(Auth::user()->has_pending_friend_request_from($id) === 1)

        {

            return ["status" => "pending"];

        }


        if(Auth::user()->has_pending_friend_request_sent_to($id) === 1)

        {

            return ["status" => "waiting"];

        }


        return ["status" => 0];






    }


}
