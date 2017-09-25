<?php

namespace App\Traits;

use App\Friendship;

trait Friendable

{

    /**
     * @param $user_requested_id
     * @return \Illuminate\Http\JsonResponse
     *
     *  Método que envia um pedido Amizade
     *  Este metodo recebe @param o usuario destinatário, isto é quem vai receber o pedido.
     *
     */

    public function add_friend($user_requested_id)

    {

        if ($this->id === $user_requested_id)
        {
            return 0;
        }

        if ($this->is_friends_with($user_requested_id) === 1)
        {
            return "already friends";
        }

        if ($this->has_pending_friend_request_sent_to($user_requested_id) === 1)
        {
            return "already sent a friend request";
        }


        if ($this->has_pending_friend_request_from($user_requested_id) === 1)
        {
            return $this->accept_friend($user_requested_id);
        }

        $Friendship = Friendship::create([

            'requester' => $this->id,

            'user_requested' => $user_requested_id

        ]);


        if ($Friendship)

        {
            return 1;
        }


            return 0;
    }



    /**
     * @param $requester
     * @return \Illuminate\Http\JsonResponse
     *
     *  Método que Aceita um pedido de Amizade
     */

    public function accept_friend($requester)

    {

        if ($this->has_pending_friend_request_from($requester)=== 0)
        {
            return 0;
        }

        $friendship = Friendship::where('requester', $requester)

            ->where('user_requested', $this->id)

            ->first();

        if($friendship)

        {

            $friendship->update([

                'status' => 1

            ]);

            return 1;

        }

        return 0;

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
            return 1;
        }

        else

        {
            return 0;
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
     * @return array
     *
     *
     *
     */

    public function pending_friend_requests_ids()

    {

        return collect($this->pending_friend_requests())->pluck('id')->toArray();

    }


    /**
     * @return array
     *
     */
    public function pending_friend_requests_sent()

    {

        $users = array();

        $friendships = Friendship::where('status', 0)

            ->where('requester', $this->id)

            ->get();

        foreach ($friendships as $friendship):

            array_push($users, \App\User::find($friendship->user_requested));

        endforeach;


        return $users;


    }

    /**
     * @return array
     *
     *
     */

    public function pending_friend_requests_sent_ids()

    {

        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();

    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     *
     * Verifica se te pedido de Amizade pendente do um determinado User
     * Este User e atribuido atravez do @param $user_id
     *
     */

    public function has_pending_friend_request_from($user_id)

    {

        if (in_array($user_id, $this->pending_friend_requests_ids()))

        {
            return 1;
        }

        else

        {
            return 0;
        }

    }

    /**
     * @param $user_id
     * @return int
     *
     */

    public function has_pending_friend_request_sent_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_sent_ids()))
        {
            return 1;
        }

        else

        {
            return 0;
        }
    }


}