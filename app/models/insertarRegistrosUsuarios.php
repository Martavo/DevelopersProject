<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtener datos del formulario
        $nickName = isset($_POST['usuario']) ? $_POST['usuario'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Crear una instancia de User y UserManager
        $newUser = new User($nickName, $password);
        $userManager = new UserManager();

        // Crear el usuario y lo guarda en el json
        $userManager->createUser($newUser);

        // Redirigir a compruebaLogin para confirmar que todo está ok y ir a la pagina principal
        header("Location: compruebaLogin.php");
        exit();

    } catch (Exception $e) {
        die("ERROR: " . $e->getMessage());
    }
}
?>
</body>
</html>