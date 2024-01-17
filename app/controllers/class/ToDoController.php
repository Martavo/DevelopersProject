<?php

class ToDo
{
    protected array $tareas;

    public function getTareas()
    {   
        $tareas = json_decode(file_get_contents(__DIR__ . '../../../models/toDo.json'), true);

        return $this->tareas = $tareas;
    }

    public function createTarea(Task $tarea, User $usuario)
    {
        $tareas = $this->getTareas(); //obtenemos todas las tareas antes de agregar la nueva tarea

        // recogemos los valores de los getters de cada objeto en cada variable
        $idTarea=$tarea->getIdTarea();
        $nickName = $usuario->getNickName();
        $password = $usuario->getPassword();
        $nomTarea = $tarea->getNomTarea();
        $tipoTarea=$tarea->getTipoTarea();
        $fechaCreacion=$tarea->getFechaCreacion();
        $fechaFinPrevista=$tarea->getFechaFinPrevista();
        $estadoTarea=$tarea->getEstadoTarea();

        // creamos la tarea con los valores de cada variable
        $tareaNueva = ["idTarea"=>$idTarea, "nickName"=>$nickName,"password"=>$password, "nomTarea"=>$nomTarea, "tipoTarea"=>$tipoTarea, "fechaCreacion"=>$fechaCreacion, "fechaFinPrevista"=>$fechaFinPrevista, "estadoTarea"=>$estadoTarea];

        // insertamos la tarea en el array de $tareas
        $tareas []= $tareaNueva;

        // insertamos el array $tareas en la BBDD(el archivo Json) por medio del metodo addJson() junto con la nueva tarea creada
        $this->addJson($tareas);

    }

    public function addJson($tareas)
    {
        file_put_contents(__DIR__ . '../../../models/toDo.json', json_encode($tareas, JSON_PRETTY_PRINT));
    }

}


