<?php

class User
{
    protected string $nickName;
    protected string $password;

    public function __construct(string $nickName, string $password)
    {
        $this->nickName = $nickName;
        $this->password = $password;
    }

    // getters and setters 
    public function getNickName()
    {
        return $this->nickName;
    }

    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}



    class UserManager
{
    protected array $users;


    //get users from JSON or empty array if there aren't
    public function getUsers()
    {   
        $this->users = json_decode(file_get_contents(__DIR__ . '../../BBDD/users.json'), true) ?? [];
        return $this->users;
    }


    //save changes in JSON
    protected function saveUsers()
    {
        file_put_contents(__DIR__ . '../../BBDD/users.json', json_encode($this->users, JSON_PRETTY_PRINT));
    }

    public function createUser(User $user)
    {
        $this->getUsers();
        $newUser = [
            "nickName" => $user->getNickName(),
            "password" => $user->getPassword()
        ];
        $this->users[] = $newUser;
        $this->saveUsers();
    }

    public function deleteUser(string $nickName)
    {
        $this->getUsers();
        foreach ($this->users as $key => $user) {
            if ($user['nickName'] === $nickName) {
                array_splice($this->users, $key, 1);
                $this->saveUsers();
                return;
            }
        }
    }


    public function updateUser(User $updatedUser, string $nickName)
    {
        $this->getUsers();
        foreach ($this->users as $key => $user) {
            if ($user['nickName'] === $nickName) {
                $this->users[$key]['nickName'] = $updatedUser->getNickName();
                $this->users[$key]['password'] = $updatedUser->getPassword();
                $this->saveUsers();
                return;
            }
        }
    }

    
}


