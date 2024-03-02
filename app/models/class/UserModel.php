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
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $newUser = [
            "nickName" => $user->getNickName(),
            "password" => $hashedPassword
        ];
        $this->users[] = $newUser;
        $this->saveUsers();
    }

    public function deleteUser($userFound)
    {
        foreach ($this->users as $key => $user) {
            if ($user['nickName'] === $userFound['nickName']) {
                array_splice($this->users, $key, 1);
                $this->saveUsers();
                return;
            }
        }
    }


    public function updateDataUser(User $newDataUser, $userFound)
    {
    foreach ($this->users as $key => $user) {
        if ($user['nickName'] === $userFound['nickName']) {
            $this->users[$key]['nickName'] = $newDataUser->getNickName();
            if ($newDataUser->getPassword() !== $user['password']) {
                $this->users[$key]['password'] = password_hash($newDataUser->getPassword(), PASSWORD_DEFAULT);
            }
            $this->saveUsers();
            return;
        }
    }
    }


    public function searchByUser($searchedUser)
    {
        $users = $this->getUsers();
        $userfound = null;
    
        foreach ($users as $user) {
            if ($user['nickName'] === $searchedUser) {
                $userfound = $user;
                break;  // Salir del bucle una vez que se haya encontrado el usuario
            }
        }
    
        return $userfound;
    }

    public function checkLogin($nickName, $password): bool
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user['nickName'] === $nickName && password_verify($password, $user['password'])) {
                return true; 
            }
        }
    
        return false; 

    }

    public function userExists($nickName): bool {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['nickName'] === $nickName) {
                return true; 
            }
        }
        return false; 
    }

    


    
}


