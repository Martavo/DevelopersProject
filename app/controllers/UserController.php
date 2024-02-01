<?php

//require_once(__DIR__ . '/../../models/class/User.php');
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

    public function indexAction()
{
    
}

    

    public function loginUsersForm_ViewAction()
    {
        
    }

    public function createUsersForm_ViewAction()
    {
        
    }

    
    
    public function createUserAction()
    {
        if (isset($_POST["usuario"]) && isset($_POST["password"])) {
            $nickName = $_POST["usuario"];
            $password = $_POST["password"];
            
    
            $newUser = new User($nickName, $password);
            $this->userManager->createUser($newUser);
    
            header("location: userIndex");
        } else {
            
            echo "Debe introducir todos los datos";
        }
    }


    public function deleteUserAction()
    {
        if (isset($_GET["nickName"])) {
            $nickName = $_GET["nickName"];
            $this->userManager->deleteUser($nickName);

            header("location: userIndex");
        } else {
            echo "Introduce el nombre de usuario que quieres borrar.";
        }
    }

    public function updateUserAction()
    {
        if (isset($_GET["nickName"]) && isset($_POST["newNickName"]) && isset($_POST["newPassword"])) {
            $originalNickName = $_GET["nickName"];
            $newNickName = $_POST["newNickName"];
            $newPassword = $_POST["newPassword"];

            $updatedUser = new User($newNickName, $newPassword);
            $this->userManager->updateUser($updatedUser, $originalNickName);

            header("location: userIndex");
        } else {
            echo "Rellena todos los campos.";
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

    public function closeUserSessionAction()
    {
        // Reanuda la sesion que esta abierta, para que identifique que sesion tiene que cerrar
        session_start();
        // cierra la sesion abierta
        session_destroy();
        // redirige a la pagina del login
        header("location:login.html");

    }
}

// $userController = new UserController();
// $userController->loginUsersForm_ViewAction("pirpol", "klkl23P");
