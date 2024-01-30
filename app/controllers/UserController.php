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

    public function indexAction()
    {

    }

    public function loginUsersForm_ViewAction()
    {
   
    }

    public function createUsersForm_ViewAction()
    {
      
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

// $userController = new UserController();
// $userController->loginUsersForm_ViewAction("pirpol", "klkl23P");
