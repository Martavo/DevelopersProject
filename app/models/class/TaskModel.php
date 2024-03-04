<?php
enum TaskType: string {
    case FrontEnd = 'FrontEnd';
    case BackEnd = 'BackEnd';
    case DataScience = 'DataScience';
}

enum TaskStatus: string {
    case Pending = 'Pendiente';
    case Finished = 'Finalizada';
    case InProcess = 'En Ejecucion';
}

class Task
{
    protected int $taskId;
    protected string $taskName;
    protected string $taskType;
    protected string $creationDate;
    protected string $expectedEndDate;
    protected string $taskStatus;

    public function __construct(
    string $taskName,
    string $taskType,
    string $creationDate,
    string $expectedEndDate,
    string $taskStatus)
    {
        $this->taskId = $this->getLastTaskId() + 1;//le da el valor a $taskId con el valor del ultimo taskId  + 1
        $this->taskName = $taskName;
        $this->taskType = $taskType;
        $this->creationDate = $creationDate;
        $this->expectedEndDate = $expectedEndDate;
        $this->taskStatus= $taskStatus;
    }

    public function getLastTaskId(): int
    {
        $tasks = json_decode(file_get_contents(__DIR__ . '../../BBDD/toDo.json'), true);

        $lastTask = end($tasks);
        $lastTaskId = $lastTask["taskId"];

        if (empty($tasks)) {
            return 0;
        }
        
        $lastTask = end($tasks);
        $lastTaskId = $lastTask["taskId"];
    
        return $lastTaskId;
    }
    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setTaskId(int $taskId)
    {
        $this->$taskId = $taskId;
    }

    /**
     * Get the value of tarea
     */ 
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * Set the value of tarea
     *
     * @return  self
     */ 
    public function setTaskName(string $taskName)
    {
        $this->taskName = $taskName;

        return $this;
    }


    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of ExpectedEndDate
     */ 
    public function getExpectedEndDate()
    {
        return $this->expectedEndDate;
    }

    /**
     * Set the value of ExpectedEndDate
     *
     * @return  self
     */ 
    public function setExpectedEndDate($expectedEndDate)
    {
        $this->expectedEndDate = $expectedEndDate;

        return $this;
    }



    /**
     * Get the value of taskType
     */ 
    public function getTaskType()
    {
        return $this->taskType;
    }

    /**
     * Set the value of taskType
     *
     * @return  self
     */ 
    public function setTaskType($taskType)
    {
        $this->taskType = $taskType;

        return $this;
    }

    /**
     * Get the value of taskStatus
     */ 
    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    /**
     * Set the value of taskStatus
     *
     * @return  self
     */ 
    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;

        return $this;
    }
}

// $Tarea1 = new Task( "Agregar color fondo", taskType::FRONTEND, "2021-01-01", "2021-01-10", taskStatus::PENDIENTE); 
// $Tarea2 = new Task( "Crear funcion sumar", taskType::BACKEND, "2022-11-04", "2022-12-15", taskStatus::EN_EJECUCION); 
// $Tarea3 = new Task( "Preever ventas 2025", taskType::DATA_SCIENCE, "2022-09-09", "2022-05-15", taskStatus::EN_EJECUCION); 

// var_dump($Tarea1->gettaskId());
// var_dump($Tarea2->gettaskId());
// var_dump($Tarea3->gettaskId());