<?php
require_once(__DIR__ . '../../models/class/UserModel.php');
require_once(__DIR__ . '../../models/class/ToDoModel.php');
require_once(__DIR__ . '/../../lib/base/Controller.php');


class UserController extends Controller
{
    private $userManager;
   
    public function __construct()
    {
        $this->userManager = new UserManager();
        
    }

    public function createUserAction()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nickName = $_POST['usuario'] ?? '';
        $password = $_POST['password'] ?? '';

        //$passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $creationSuccess = $this->userManager->createUser($nickName, $password);

        if ($creationSuccess) {
            header("location: loginUsersForm_View");
        } else {
            
        }

    }
}

    public function updateUserAction()
{
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
        $currentUserName = $_SESSION['user'];
        $newUserName = $_POST['newUserName'] ?? $currentUserName;
        $newPassword = $_POST['newPassword'] ?? '';

        $updateSuccess = $this->userManager->updateUser($currentUserName, $newUserName, $newPassword);

        if ($updateSuccess) {
            $_SESSION['user'] = $newUserName;
            header("location: userProfile_View");
        } else {
            
        } 
    }
}

    public function deleteUserAction()
{
    session_start();
    if (isset($_SESSION['user'])) {
        $userName = $_SESSION['user'];
        $deleteSuccess = $this->userManager->deleteUser($userName);

        if ($deleteSuccess) {
            session_destroy();
            header("location: loginUsersForm_View");
        } else {
            
        }
    }
}

public function checkLoginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nickName = isset($_POST['usuario']) ? $_POST['usuario'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                // Obtener la lista de usuarios
                $users = $this->userManager->getUsers();

                $isValidated = false;
                $longArray = count($users);
                $i = 0;
                while ($isValidated == false && $i < $longArray) {
                    if ($users[$i]['nickName'] === $nickName && $users[$i]['password'] === $password) {
                        $isValidated = true;
                    }
                    $i++;
                }

                if ($isValidated) {
                    // Usuario autenticado correctamente
                    session_start();
                    $_SESSION["user"] = $nickName;
                    header("location: tasksList_View");
                } else {
                    // Usuario no autenticado, redirigir a la página de inicio de sesión
                    header("location: loginUsersForm_View");
                    echo "usuario incorrecto";
                }
            } catch (Exception $e) {

                die("ERROR: " . $e->getMessage());
            }
        }
    }

}

    /*public function indexAction()
    {

    }*/

    /*public function loginUsersForm_ViewAction()
    {
        echo "hola desde loginUsersForm_View";
        

    }*/

    /*public function createUsersForm_ViewAction()
    {
        echo "hola desde createUsersForm_View";
    }*/

    


// $userController = new UserController();
// $userController->loginUsersForm_ViewAction("pirpol", "klkl23P");