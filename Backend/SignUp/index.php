<?php
  // Operaciones del CRUD

  include_once '../DB/index.php';

  $objeto = new Conexion();

  $conexion = $objeto->Conectar();

  $_POST = json_decode(file_get_contents("php://input"),true);

  $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
  $id = (isset($_POST['ID_USER'])) ? $_POST['ID_USER'] : '';

  $name_user = (isset($_POST['NAME_USER'])) ? $_POST['NAME_USER'] : '';
  $lastname_user = (isset($_POST['LASTNAME_USER'])) ? $_POST['LASTNAME_USER'] : '';
  $type_user = (isset($_POST['TYPE_USER'])) ? $_POST['TYPE_USER'] : '';
  $user_name = (isset($_POST['USER_NAME'])) ? $_POST['USER_NAME'] : '';
  $pass_user = (isset($_POST['PASS_USER'])) ? $_POST['PASS_USER'] : '';


  switch ($opcion) {
    case 1:
      // Proceso para Agregar
      $consulta = "INSERT INTO users(NAME_USER, LASTNAME_USER, TYPE_USER, USER_NAME, PASS_USER)
      VALUES ('$name_user', '$lastname_user', '$type_user', '$user_name', '$pass_user')";

      $result = $conexion->prepare($consulta);
      $result->execute();
    break;

    case 2:
      // Preceso para Agregar
      $consulta = "UPDATE users SET NAME_USER = '$name_user', LASTNAME_USER = '$lastname_user',
      TYPE_USER = '$type_user', USER_NAME = '$user_name', PASS_USER = '$pass_user' WHERE ID_USER = '$id'";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;

    case 3:
      // Proceso para Eliminar
      $consulta = "DELETE FROM users WHERE ID_USER='$id'";

      $result = $conexion->prepare($consulta);
      $result->execute();
    break;

    case 4:
      // Proceso para traer todos los datos
      $consulta = "SELECT * FROM users";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;
  }

  // Convierte a JSON
  print json_encode($data, JSON_UNESCAPED_UNICODE);
  $conexion = NULL;
