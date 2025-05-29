<?php
namespace App\Models;

class User
{
    private $id, $email, $password ,$name, $created_at, $balance;

    public function __construct($id, $email, $password, $name, $created_at, $balance = 0)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->balance = $balance;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getBalance() {
        return $this->balance;
    }
}