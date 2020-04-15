-- Creacion de la ase de datos 
create database  system_inventory;

use system_inventory;

-- Informacion de usuario
-- La informacion mas delicada se debe de sifrar como sifras a una clave
create table users (
  ID_USER int auto_increment primary key,
  NAME_USER varchar(50) not null,
  LASTNAME_USER varchar(50) not null,
  TYPE_USER varchar(15) not null,
  USER_NAME varchar(50) not null,
  PASS_USER varchar(255) not null
);

-- Informacion de la sesiones
-- Registra cada sesion para validarla en el backend mas adelante

create table sessions (
  ID_SESSION int auto_increment primary key,
  USER_NAME varchar(50) not null,
  TYPE_SESSION varchar(50) not null,
);

-- Informacion de la actividad
-- Esta es para mostrar los usuarios online y solo es del dominio del administrador

create table actividad (
  ID_ACTIVITY int auto_increment primary key,
  ACTIVITY char(15),
  TYPE varchar(25)
);

-- Lo mas importante el inventario

create table type_inventory (
  ID_TYPE int auto_increment primary key,
  TYPE_INVENTORY varchar(25) not null
);

-- First category moviliario

create table type_inventory_a (
    ID_INVENTORY int(0100) auto_increment primary key,
    CODE_PRODUCT varchar(50),
    NAME_PRODUCT varchar(50) not null,
    UNIT_PRODUCT varchar(25) not null,
    STOCK float,
    DATE_INITIAL varchar(50),
    CATEGORY varchar(50),
    UNITARY_PRICE varchar(50)
);

-- Entrada del producto

create table entry_product (
  ID_ENTRY int auto_increment primary key,
  CODE_PRODUCT_ENTRY varchar(50) not null,
  NAME_PRODUCT_ENTRY varchar(50) not null,
  STOCK_ENTRY float not null,
  UNITARY_PRICE_ENTRY varchar(50) not null,
  UNIT_PRODUCT_ENTRY varchar(50) not null,
  DATE_OF_ENTRY varchar(50) not null,
  CATEGORY_ENTRY varchar(50) not null
);

-- Salida del producto

create table exit_product (
  ID_EXIT int auto_increment primary key,
  CODE_PRODUCT_EXIT varchar(50) not null,
  NAME_PRODUCT_EXIT varchar(50) not null,
  STOCK_EXIT float not null,
  UNITARY_PRICE_EXIT varchar(50) not null,
  UNIT_PRODUCT_EXIT varchar(50) not null,
  CATEGORY_EXIT varchar(50) not null,
  DATE_OF_EXIT varchar(50) not null,
  STOCK_CURRENT float not null,
);

-- Tareas

create table task (
  ID_TASK int auto_increment primary key,
  TASK varchar(50) not null,
  TASK_DESCRIPTION varchar(100) not null,
  CATEGORY_TASK varchar(50) not null,
  ORIENTED_TO varchar(50) not null,
  DATE_TASK varchar(50) not null
);