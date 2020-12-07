<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий Гайдаш
 * Date: 03.12.2020
 * Time: 08:23
 */

namespace App\Repository;


use App\Models\User;

class SubscribesRepository
{
    public static function create(User $user)
    {
        $user->subscribes()->create();
        return $user;
    }

    public static function destroy(User $user)
    {
        $user->subscribes->first()->delete();
        return $user;
    }
}