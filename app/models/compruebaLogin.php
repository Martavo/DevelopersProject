<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

try {
        $nickName = isset($_POST['usuario']) ? $_POST['usuario'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Crear una instancia de UserManager para acceder a los métodos relacionados con los usuarios
        $userManager = new UserManager();

        // Obtener la lista de usuarios
        $users = $userManager->getUsers();

        // Validar el usuario y la contraseña
        $validCredentials = false;
        foreach ($users as $user) {
            if ($user['nickName'] === $nickName && $user['password'] === $password) {
                $validCredentials = true;
                break;
            }
        }

        if ($validCredentials) {
            // Usuario autenticado correctamente
            session_start();
            $_SESSION["user"] = $nickName;
            header("location: listaTareas_View.php");
         } else {
            // Usuario no autenticado, redirigir a la página de inicio de sesión
            header("Location: ../../app/views/formularioLogin_View.html");
        }

    }catch(Exception $e){

        die("ERROR: " . $e->getMessage());
    }

?>
</body>
</html>