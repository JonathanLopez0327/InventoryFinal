<?php
  // Operaciones del CRUD para el inventario

  include_once '../DB/index.php';

  $objeto = new Conexion();

  $conexion = $objeto->Conectar();

  $_POST = json_decode(file_get_contents("php://input"),true);

  $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
  $id = (isset($_POST['ID_INVENTORY'])) ? $_POST['ID_INVENTORY'] : '';

  $code_product = (isset($_POST['CODE_PRODUCT'])) ? $_POST['CODE_PRODUCT'] : '';
  $name_product = (isset($_POST['NAME_PRODUCT'])) ? $_POST['NAME_PRODUCT'] : '';
  $unit_porduct = (isset($_POST['UNIT_PRODUCT'])) ? $_POST['UNIT_PRODUCT'] : '';
  $stock = (isset($_POST['STOCK'])) ? $_POST['STOCK'] : '';
  $date_initial = (isset($_POST['DATE_INITIAL'])) ? $_POST['DATE_INITIAL'] : '';
  $category = (isset($_POST['CATEGORY'])) ? $_POST['CATEGORY'] : '';
  $unitary_price = (isset($_POST['UNITARY_PRICE'])) ? $_POST['UNITARY_PRICE'] : '';

  switch ($opcion) {
    case 1:
      // Proceso para Agregar
      $consulta = "INSERT INTO type_inventory_a(CODE_PRODUCT, NAME_PRODUCT, UNIT_PRODUCT, STOCK, DATE_INITIAL, CATEGORY, UNITARY_PRICE)
      VALUES ('$code_product', '$name_product', '$unit_porduct', '$stock', '$date_initial', '$category', '$unitary_price $ RD')";

      $result = $conexion->prepare($consulta);
      $result->execute();
    break;

    case 2:
      // Preceso para Modificar
      $consulta = "UPDATE type_inventory_a SET CODE_PRODUCT = '$code_product', NAME_PRODUCT = '$name_product',
      UNIT_PRODUCT = '$unit_porduct', STOCK = '$stock', DATE_INITIAL = '$date_initial', CATEGORY = '$category',
      UNITARY_PRICE = '$unitary_price' WHERE ID_INVENTORY = '$id'";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;

    case 3:
      // Proceso para Eliminar
      $consulta = "DELETE FROM type_inventory_a WHERE ID_INVENTORY='$id'";

      $result = $conexion->prepare($consulta);
      $result->execute();
    break;

    case 4:
      // Proceso para traer todos los datos
      $consulta = "SELECT * FROM type_inventory_a";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;
  }

  // Convierte a JSON
  print json_encode($data, JSON_UNESCAPED_UNICODE);
  $conexion = NULL;
