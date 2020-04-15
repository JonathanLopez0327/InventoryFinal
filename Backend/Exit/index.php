<?php
// Operaciones del CRUD para el inventario

include_once '../DB/index.php';

$objeto = new Conexion();

$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['ID_EXIT'])) ? $_POST['ID_EXIT'] : '';
$id_inventory = (isset($_POST['ID_INVENTORY'])) ? $_POST['ID_INVENTORY'] : '';

$code_product_exit = (isset($_POST['CODE_PRODUCT_EXIT'])) ? $_POST['CODE_PRODUCT_EXIT'] : '';
$name_product_exit = (isset($_POST['NAME_PRODUCT_EXIT'])) ? $_POST['NAME_PRODUCT_EXIT'] : '';
$stock_exit = (isset($_POST['STOCK_EXIT'])) ? $_POST['STOCK_EXIT'] : '';
$unitary_price_exit = (isset($_POST['UNITARY_PRICE_EXIT'])) ? $_POST['UNITARY_PRICE_EXIT'] : '';
$unit_product_exit = (isset($_POST['UNIT_PRODUCT_EXIT'])) ? $_POST['UNIT_PRODUCT_EXIT'] : '';
$category_of_exit = (isset($_POST['CATEGORY_EXIT'])) ? $_POST['CATEGORY_EXIT'] : '';
$date_of_exit = (isset($_POST['DATE_OF_EXIT'])) ? $_POST['DATE_OF_EXIT'] : '';
$stock_current = (isset($_POST['STOCK_CURRENT'])) ? $_POST['STOCK_CURRENT'] : '';

$stock = (isset($_POST['STOCK'])) ? $_POST['STOCK'] : '';

$total = 0;

switch ($opcion) {
  case 1:
    // Proceso para Agregar
    if ($stock_exit > $stock_current) {
    } else {

      $total = $stock - $stock_exit;

      $consulta = "INSERT INTO exit_product(
          CODE_PRODUCT_EXIT,
          NAME_PRODUCT_EXIT,
          STOCK_EXIT,
          UNITARY_PRICE_EXIT,
          UNIT_PRODUCT_EXIT,
          CATEGORY_EXIT,
          DATE_OF_EXIT,
          STOCK_CURRENT
        ) VALUES(
          '$code_product_exit',
          '$name_product_exit',
          '$stock_exit',
          '$unitary_price_exit',
          '$unit_product_exit',
          '$category_of_exit',
          '$date_of_exit',
          '$total'
        )";

      $result = $conexion->prepare($consulta);
      $result->execute();
    }


    break;

  case 2:
    // Preceso para Actualizar
    $consulta = "UPDATE exit_product SET CODE_PRODUCT_EXIT = '$code_product_exit', NAME_PRODUCT_EXIT = '$name_product_exit', STOCK_EXIT = '$stock_exit',
      UNITARY_PRICE_EXIT = '$unitary_price_exit', UNIT_PRODUCT_EXIT = '$unit_product_exit', CATEGORY_EXIT = '$category_of_exit', DATE_OF_EXIT = '$date_of_exit'
      STOCK_CURRENT = '$stock_current' WHERE ID_EXIT = '$id'";

    $result = $conexion->prepare($consulta);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 3:
    // Proceso para Eliminar
    $consulta = "DELETE FROM exit_product WHERE ID_EXIT='$id'";

    $result = $conexion->prepare($consulta);
    $result->execute();
    break;

  case 4:
    // Proceso para traer todos los datos
    $consulta = "SELECT * FROM exit_product";

    $result = $conexion->prepare($consulta);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;

  case 5:
    // Actualizar Cantidad
    if ($stock_exit > $stock) {
    } else {

      $total = $stock - $stock_exit;
      $consulta = "UPDATE type_inventory_a  SET STOCK = '$total' WHERE ID_INVENTORY = '$id_inventory'";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    break;
}

// Convierte a JSON
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
