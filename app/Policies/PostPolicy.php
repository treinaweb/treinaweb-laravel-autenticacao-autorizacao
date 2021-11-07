<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update($user)
    {
        if ($user->type == 'admin') {
            return Response::allow();
        }

        return Response::deny('Você precisa ter permissão de admin');
    }

    public function delete($user, $post)
    {
        if ($post->owner == $user->id) {
            return Response::allow();
        }

        return Response::deny('Somente o dono pode excluir um post');
    }
}
