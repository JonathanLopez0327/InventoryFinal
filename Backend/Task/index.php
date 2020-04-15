<?php
// Operaciones del CRUD

include_once '../DB/index.php';

$objeto = new Conexion();

$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['ID_TASK'])) ? $_POST['ID_TASK'] : '';

$task = (isset($_POST['TASK'])) ? $_POST['TASK'] : '';
$task_description = (isset($_POST['TASK_DESCRIPTION'])) ? $_POST['TASK_DESCRIPTION'] : '';
$category_task = (isset($_POST['CATEGORY_TASK'])) ? $_POST['CATEGORY_TASK'] : '';
$oriented_to = (isset($_POST['ORIENTED_TO'])) ? $_POST['ORIENTED_TO'] : '';
$date_task = (isset($_POST['DATE_TASK'])) ? $_POST['DATE_TASK'] : '';


switch ($opcion) {
    case 1:
        // Proceso para Agregar
        $consulta = "INSERT INTO task (TASK, TASK_DESCRIPTION, CATEGORY_TASK, ORIENTED_TO, DATE_TASK)
        VALUES ('$task', '$task_description', '$category_task', '$oriented_to', '$date_task')";

        $result = $conexion->prepare($consulta);
        $result->execute();
        break;

    case 2:
        // Preceso para Agregar
        $consulta = "UPDATE task SET TASK = '$task', TASK_DESCRIPTION = '$task_description', CATEGORY_TASK = '$category_task',
        ORIENTED_TO = '$oriented_to', DATE_TASK = '$date_task' WHERE ID_TASK = '$id'";

        $result = $conexion->prepare($consulta);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3:
        // Proceso para Eliminar
        $consulta = "DELETE FROM task WHERE ID_TASK='$id'";

        $result = $conexion->prepare($consulta);
        $result->execute();
        break;

    case 4:
        // Proceso para traer todos los datos
        $consulta = "SELECT * FROM task";

        $result = $conexion->prepare($consulta);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        break;
}

// Convierte a JSON
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
