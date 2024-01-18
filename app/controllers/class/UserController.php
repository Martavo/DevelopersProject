<?php

class User
{
    protected string $nickName;
    protected string $password;

    public function __construct(string $nickName,
    string $password)
    {
        $this->nickName=$nickName;
        $this->password=$password;
    }

    /**
     * Get the value of usuario
     */ 
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}