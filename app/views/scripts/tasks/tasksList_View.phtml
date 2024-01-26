<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../app/views/layouts/hoja.css">
    <title>Lista de Tareas</title>
</head>
<body>
    
<?php
require_once "../app/controllers/ApplicationController.php";

    // INSERTAR REGISTROS -------------------
    if(isset($_POST["cr"])){ //Si se ha pulsado el boton insertar
        $user= $_POST["user"];
        $taskName= $_POST["taskName"];
        $taskType= $_POST["taskType"];
        $creationDate= $_POST["creationDate"];
        $expectedEndDate= $_POST["expectedEndDate"];
        $statusTask= $_POST["statusTask"];

        $toDo->createTask(new Task(
            $taskName,
            $taskType,
            $creationDate,
            $expectedEndDate,
            $statusTask,
        ),
        $user);

        // hacemos que se dirija a esta misma pagina para que actualice la página con los nuevo datos insertados
        header("location:index.php");
    }
    
    // FIN INSERTAR REGISTROS --------------
    
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
  <table width="50%">
    <tr >
      <td class="primera_fila">Nº Tarea</td>
      <td class="primera_fila">Usuario</td>
      <td class="primera_fila">Tarea</td>
      <td class="primera_fila">Tipo de Tarea</td>
      <td class="primera_fila">Fecha de Creacion</td>
      <td class="primera_fila">Fecha Fin Prevista</td>
      <td class="primera_fila">Estado de la tarea</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 

<!--filas de inserccion datos  -->    
    <tr>
      <td></td>
        <td><input type='text' name='user' size='10' class='centrado'></td>
        <td><input type='text' name='taskName' size='10' class='centrado'></td>
        <td>
            <select name="taskType" id="taskType" size='10' class='centrado'>
                <option value="FrontEnd">FrontEnd</option>
                <option value="BackEnd">BackEnd</option>
                <option value="DataScience">Data Science</option>
            </select>
        </td>
        <td><input type='text' name='creationDate' size='10' class='centrado'></td>
        <td><input type='text' name='expectedEndDate' size='10' class='centrado'></td>
        <td>
            <select name="statusTask" id="statusTask" size='10' class='centrado'>
                <option value="En ejecucion">En ejecucion</option>
                <option value="Pendiente">Pendiente</option>
                <option value="Finalizada">Finalizada</option>
            </select>
        </td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
    </tr>    

		<?php 
      foreach($arrayTasks as $task): ?>
   	<tr>
     <td><?php echo $task['taskId']?></td>
      <td><?php echo $task['user']?></td>
      <td><?php echo $task['taskName']?></td>
      <td><?php echo $task['taskType']?></td>
      <td><?php echo $task['creationDate']?></td>
      <td><?php echo $task['expectedEndDate']?></td>
      <td><?php echo $task['taskStatus']?></td>
      <td class="bot">
        <a href="..\..\app\models\actions\deleteTask.php?taskId=<?php echo $task['taskId']?>" onclick="return confirmDelete(<?php echo $task['taskId']?>);">
        <input type='button' name='del' id='del' value='Borrar'>
      </a>
      </td>
      <td class='bot'>
        <a href="../../app/models/actions/updateTask.php?taskId=<?php echo $task['taskId']?> & user=<?php echo $task['user']?> & taskName=<?php echo $task['taskName']?> & taskType=<?php echo $task['taskType']?> & creationDate=<?php echo $task['creationDate']?> & expectedEndDate=<?php echo $task['expectedEndDate']?> & taskStatus=<?php echo $task['taskStatus']?>">
        <input type='button' name='up' id='up' value='Actualizar'>
      </a>
      </td>
    </tr>
    <?php
    endforeach
    ?>
  </table>
</form>

<!-- Ventana emergente para confirmar borrado de registro -->
<script>
function confirmDelete(id) {
  return confirm("¿Estás seguro de que deseas borrar la tarea numero: " + id + "?");
}
</script>

</body>
</html>