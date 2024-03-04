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

    

    public function createUserAction() {
        if (isset($_POST["usuario"]) && !empty($_POST["usuario"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
            $nickName = $_POST["usuario"];
            $password = $_POST["password"];
    
            if ($this->userManager->userExists($nickName)) {
                // echo "El usuario ya existe. Por favor, elija otro nombre de usuario.";
                header("location: createUsersForm_View?duplicatedUser");

            } else {
                $newUser = new User($nickName, $password);
                $this->userManager->createUser($newUser);
    
                header("location: userIndex?createdUser");
            }
        } else {
            echo "Debe introducir todos los datos";
        }
    }


    public function deleteUserAction()
    {
        $usuario = $_SESSION['user'];
        $userFound = $this->userManager->searchByUser($usuario);

        $this->userManager->deleteUser($userFound);
        header("location: userIndex");
       
    }
    
    public function updateUserAction()
    {  
        $usuario = $_SESSION['user'];
    
        $userFound = $this->userManager->searchByUser($usuario);
    
        $currentNickName = isset($userFound['nickName']) ? $userFound['nickName'] : '';
        $currentPassword = isset($userFound['password']) ? $userFound['password'] : '';
    
        $newNickName = isset($_POST["newNickName"]) && !empty($_POST["newNickName"]) ? $_POST["newNickName"] : $currentNickName;
        $newPassword = isset($_POST["newPassword"]) && !empty($_POST["newPassword"]) ? $_POST["newPassword"] : $currentPassword;
    
    
        $newDataUser = new User($newNickName, $newPassword);
        $this->userManager->updateDataUser($newDataUser, $userFound);
    
        header("location: userIndex");
    }

    public function checkLoginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nickName = isset($_POST['usuario']) ? $_POST['usuario'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                // Obtener la lista de usuarios

                $isValidated = $this->userManager->checkLogin($nickName, $password);

                if ($isValidated) {
                    // destruye cualquier sesion antigua iniciada
                    session_destroy();
                    // Inicia una nueva sesion
                    session_start();
                    $_SESSION["user"] = $nickName;
                    header("location: tasksList_View");
                } else {
                    // Usuario no autenticado, redirigir a la página de inicio de sesión
                    header("location: loginUsersForm_View?error");

                }
            } catch (Exception $e) {

                die("ERROR: " . $e->getMessage());
            }
        }
    }    

    public function closeUserSessionAction()
    {
        // cierra la sesion abierta
        session_destroy();
        // redirige a la pagina del login
        header("location:userIndex");

    }

    public function userProfile_ViewAction()
    {
      

    }

}

// $userController = new UserController();
// $userController->loginUsersForm_ViewAction("pirpol", "klkl23P");
