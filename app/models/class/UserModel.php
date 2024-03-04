<?php

class User
{
    protected string $nickName;
    protected string $password;
    protected int $userId;

    public function __construct(string $nickName, string $password)
    {
        $this->userId =  $this->getLastUserId() + 1 ;//le da el valor a $taskId con el valor del ultimo taskId  + 1
        $this->nickName = $nickName;
        $this->password = $password;
    }
    public function getLastUserId(): int
    {
        $users = json_decode(file_get_contents(__DIR__ . '../../BBDD/users.json'), true);

        $lastUser = end($users); //toma el ultimo user
        if(empty($lastUser["userId"])){
            return 0;
        }else{

            return $lastUser["userId"]; 
        }
    }

        /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
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
            "userId" => $user->getUserId(),
            "nickName" => $user->getNickName(),
            "password" => $user->getPassword()
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
            $this->users[$key]['password'] = $newDataUser->getPassword();
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

        $isValidated = false;
        $longArray = count($users);
        $i = 0;
        while ($isValidated == false && $i < $longArray) {
            if ($users[$i]['nickName'] === $nickName && $users[$i]['password'] === $password) {
                $isValidated = true;
            }
            $i++;
        }

        return $isValidated;

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


