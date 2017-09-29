<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class FriendshipsController extends Controller
{

    /**
     * @param $id
     * @return array
     *
     *
     */
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

    public  function add_friend($id)
    {
        //Sending notifications, emails, broadcating
         return Auth::user()->add_friend($id);
    }

    public function accept_friend($id)
    {
        //sending nots
        return Auth::user()->accept_friend($id);
    }


}
