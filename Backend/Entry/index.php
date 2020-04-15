<?php
  // Operaciones del CRUD para el inventario

  include_once '../DB/index.php';

  $objeto = new Conexion();

  $conexion = $objeto->Conectar();

  $_POST = json_decode(file_get_contents("php://input"),true);

  $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
  $id = (isset($_POST['ID_ENTRY'])) ? $_POST['ID_ENTRY'] : '';

  $code_product_entry = (isset($_POST['CODE_PRODUCT_ENTRY'])) ? $_POST['CODE_PRODUCT_ENTRY'] : '';
  $name_product_entry = (isset($_POST['NAME_PRODUCT_ENTRY'])) ? $_POST['NAME_PRODUCT_ENTRY'] : '';
  $stock_entry = (isset($_POST['STOCK_ENTRY'])) ? $_POST['STOCK_ENTRY'] : '';
  $unitary_price_entry = (isset($_POST['UNITARY_PRICE_ENTRY'])) ? $_POST['UNITARY_PRICE_ENTRY'] : '';
  $unit_product_entry = (isset($_POST['UNIT_PRODUCT_ENTRY'])) ? $_POST['UNIT_PRODUCT_ENTRY'] : '';
  $date_of_entry = (isset($_POST['DATE_OF_ENTRY'])) ? $_POST['DATE_OF_ENTRY'] : '';
  $category_entry = (isset($_POST['CATEGORY_ENTRY'])) ? $_POST['CATEGORY_ENTRY'] : '';


  switch ($opcion) {
    case 1:
      // Proceso para Agregar
      $consulta = "INSERT INTO entry_product (CODE_PRODUCT_ENTRY, NAME_PRODUCT_ENTRY, STOCK_ENTRY, UNITARY_PRICE_ENTRY, UNIT_PRODUCT_ENTRY, DATE_OF_ENTRY, CATEGORY_ENTRY)
      VALUES ('$code_product_entry', '$name_product_entry', '$stock_entry', '$unitary_price_entry $ RD', '$unit_product_entry', '$date_of_entry',
        '$category_entry')";

      $result = $conexion->prepare($consulta);
      $result->execute();
    break;

    case 2:
      // Preceso para Agregar
      $consulta = "UPDATE entry_product SET CODE_PRODUCT_ENTRY = '$code_product_entry', NAME_PRODUCT_ENTRY = '$name_product_entry', STOCK_ENTRY = '$stock_entry',
      UNITARY_PRICE_ENTRY = '$unitary_price_entry', UNIT_PRODUCT_ENTRY = '$unit_product_entry', DATE_OF_ENTRY = '$date_of_entry', CATEGORY_ENTRY = '$category_entry'
      WHERE ID_ENTRY = '$id'";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;

    case 3:
      // Proceso para Eliminar
      $consulta = "DELETE FROM entry_product WHERE ID_ENTRY='$id'";

      $result = $conexion->prepare($consulta);
      $result->execute();
    break;

    case 4:
      // Proceso para traer todos los datos
      $consulta = "SELECT * FROM entry_product";

      $result = $conexion->prepare($consulta);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
    break;
  }

  // Convierte a JSON
  print json_encode($data, JSON_UNESCAPED_UNICODE);
  $conexion = NULL;
