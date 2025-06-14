<?php

namespace models;

class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $role;

    public function __construct($username, $password, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}