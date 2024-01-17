<?php

enum tipoTarea
{
    case FRONTEND;
    case BACKEND;
    case DATA_SCIENCE;

    public function tareas():string
    {
        return match($this)
        {
            self::FRONTEND=>"Frontend",
            self::BACKEND=>"BackEnd",
            self::DATA_SCIENCE=>"DataScience"
        };
    }
}
enum estadoTarea
{
    case PENDIENTE;
    case EN_EJECUCION;
    case TERMINADO;
    public function estadosTarea():string
    {
        return match($this)
        {
            self::PENDIENTE=>"Pendiente",
            self::EN_EJECUCION=>"En ejecucion",
            self::TERMINADO=>"Terminado"
        };
    }
}

class Task
{
    protected int $idTarea;
    protected string $nomTarea;
    protected tipoTarea $tipoTarea;
    protected string $fechaCreacion;
    protected string $fechaFinPrevista;
    protected estadoTarea $estadoTarea;

    public function __construct(
    string $nomTarea,
    tipoTarea $tipoTarea,
    string $fechaCreacion,
    string $fechaFinPrevista,
    estadoTarea $estadoTarea)
    {
        $this->idTarea = $this->getLastIdTarea() + 1;//le da el valor a $idTarea con el valor del ultimo idTarea  + 1
        $this->nomTarea = $nomTarea;
        $this->tipoTarea = $tipoTarea;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaFinPrevista = $fechaFinPrevista;
        $this->estadoTarea= $estadoTarea;
    }

    public function getLastIdTarea(): int
    {
        $tareas = json_decode(file_get_contents(__DIR__ . '../../../models/toDo.json'), true);

        $ultimaTarea = end($tareas);
        $ultimoId = $ultimaTarea["idTarea"];

        return $ultimoId;
    }
    public function getIdTarea()
    {
        return $this->idTarea;
    }

    public function setIdTarea($idTarea)
    {
        $this->$idTarea = $idTarea;
    }

    /**
     * Get the value of tarea
     */ 
    public function getNomTarea()
    {
        return $this->nomTarea;
    }

    /**
     * Set the value of tarea
     *
     * @return  self
     */ 
    public function setNomTarea($nomTarea)
    {
        $this->nomTarea = $nomTarea;

        return $this;
    }

    /**
     * Get the value of tipoTarea
     */ 
    public function getTipoTarea()
    {
        return $this->tipoTarea->tareas();
    }

    /**
     * Set the value of tipoTarea
     *
     * @return  self
     */ 
    public function setTipoTarea($tipoTarea)
    {
        $this->tipoTarea = $tipoTarea;

        return $this;
    }

    /**
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */ 
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get the value of fechaFinPrevista
     */ 
    public function getFechaFinPrevista()
    {
        return $this->fechaFinPrevista;
    }

    /**
     * Set the value of fechaFinPrevista
     *
     * @return  self
     */ 
    public function setFechaFinPrevista($fechaFinPrevista)
    {
        $this->fechaFinPrevista = $fechaFinPrevista;

        return $this;
    }

    /**
     * Get the value of estadoTarea
     */ 
    public function getEstadoTarea()
    {
        return $this->estadoTarea->estadosTarea();
    }

    /**
     * Set the value of estadoTarea
     *
     * @return  self
     */ 
    public function setEstadoTarea($estadoTarea)
    {
        $this->estadoTarea = $estadoTarea;

        return $this;
    }

}

// $Tarea1 = new Task( "Agregar color fondo", tipoTarea::FRONTEND, "2021-01-01", "2021-01-10", estadoTarea::PENDIENTE); 
// $Tarea2 = new Task( "Crear funcion sumar", tipoTarea::BACKEND, "2022-11-04", "2022-12-15", estadoTarea::EN_EJECUCION); 
// $Tarea3 = new Task( "Preever ventas 2025", tipoTarea::DATA_SCIENCE, "2022-09-09", "2022-05-15", estadoTarea::EN_EJECUCION); 

// var_dump($Tarea1->getIdTarea());
// var_dump($Tarea2->getIdTarea());
// var_dump($Tarea3->getIdTarea());