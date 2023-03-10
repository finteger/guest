<?php

namespace Finteger\Guest\Api\Controllers;

use Flarum\Database\AbstractModel;
use Flarum\User\User;


class Guest extends AbstractModel
{
    protected $table = 'users';

    public static function register(string $username): self
    {
        $guest = new static;

        $guest->username = $username;
        $guest->password = '';
        $guest->email = '';
        $guest->is_activated = 1;
        $guest->join_time = time();

        return $guest;
    }
}