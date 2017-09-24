<?php

namespace App\Traits;

use App\Friendship;

trait Friendable


{

    /**
     * @param $user_requested_id
     * @return \Illuminate\Http\JsonResponse
     *
     *  Método que solicita Amizade
     */

    public function add_friend($user_requested_id)

    {

        $Friendship = Friendship::create([

            'requester' => $this->id,

            'user_requested' => $user_requested_id

        ]);


        if ($Friendship)

        {

            return response()->json($Friendship, 200);

        }

        return response()->json('fail', 501);

    }


    /**
     * @return array
     *
     * Método que Verifica os pedidos de amizades pendente, do User Actual
     * O método retorna users em forma de Array
     *
     */

    public function pending_friend_requests()

    {
        $users = array();

        $friendships = Friendship::where('status', 0)

            ->where('user_requested', $this->id)

            ->get();

        foreach ($friendships as $friendship):

            array_push($users, \App\User::find($friendship->requester));

        endforeach;


        return $users;

    }


    /**
     * @return static
     *
     * Método que retorna id dos Amigos
     *
     */

    public function friends_ids()

    {

        return collect($this->friends())->pluck('id')->toArray();

    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     *
     *  Método que veifica se um determinado User é Amigo do User Atual ou não
     *  Para tal recebe por parâmetro o Id do User
     */


    public function is_friends_with($user_id)

    {

        if(in_array($user_id, $this->friends_ids()))

        {

            return response()->json('true', 200);

        }

        else

        {

            return response()->json('false', 200);

        }

    }


    /**
     * @return array
     *
     * Método que retorna todos Amigos do User Actual
     * Os amigos são retornados sub forma de um Array
     */

    public function friends()

    {

        $friends = array();


        $f1 = Friendship::where('status', 1)

            ->where('requester', $this->id)

            ->get();

        foreach ($f1 as $friendship):

            array_push($friends, \App\User::find($friendship->user_requested));

        endforeach;


        $friends2 = array();

        $f2 = Friendship::where('status', 1)

            ->where('user_requested', $this->id)

            ->get();

        foreach ($f2 as $friendship):

            array_push($friends2, \App\User::find($friendship->requester));

        endforeach;


        return array_merge($friends, $friends2);


    }


    /**
     * @param $requester
     * @return \Illuminate\Http\JsonResponse
     *
     *  Método que Aceita um pedido de Amizade
     */

    public function accept_friend($requester)

    {

        $friendship = Friendship::where('requester', $requester)

            ->where('user_requested', $this->id)

            ->first();

        if($friendship)

        {

            $friendship->update([

                'status' => 1

            ]);

            return response()->json($friendship, 200);

        }

        return response()->json('fail', 501);

    }

}