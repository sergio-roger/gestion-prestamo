#Inicio de la primera parte de a bd
CREATE DATABASE if NOT EXISTS crediexpress CHARACTER SET utf8 COLLATE utf8_general_ci;

#Tabla de roles
CREATE TABLE IF NOT EXISTS roles(
    id int AUTO_INCREMENT not null PRIMARY KEY,
  	rol_tipo varchar(255) null,
    rol_descripcion varchar(255) null,
    estado char null
)ENGINE=INNODB;

#Tabla de Usuarios
CREATE TABLE IF NOT EXISTS usuarios(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    rol_id int null,
  	usu_nombres varchar(255) null,
    usu_apellidos varchar(255) null,
    usu_correo varchar(255) null,
    usu_direccion varchar(255) null,
    usu_sexo char null,
    usu_cargo varchar(255) null,
    usu_foto varchar(255) null,
    usu_usuario varchar(255) null,
    usu_clave varchar(255) null,
    usu_telefono varchar(12) null,
    estado char null,
    CONSTRAINT FOREIGN KEY (rol_id) REFERENCES roles(id)
)ENGINE=INNODB;

#Tablas de opciones para los préstamos
CREATE TABLE IF NOT EXISTS montos(
    id int AUTO_INCREMENT not null PRIMARY key,
    mon_cantidad decimal(8,2) null,
    mon_descripcion varchar(255) null,
    estado char null
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS intereses(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    int_porcentaje int null,
    estado char
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS plazos(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    pla_duracion int null,
    plaz_periodo varchar(255) null,
    estado char
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS estatus(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    est_abreviacion varchar(255) null,
    est_detalle varchar(255) null,
    estado char null
)ENGINE=INNODB;

#Tabla de Clientes
CREATE TABLE IF NOT EXISTS clientes(
    id int AUTO_INCREMENT not null PRIMARY KEY,
 	cli_cedula varchar(10) null,
    cli_nombres varchar(50) null,
    cli_apellidos varchar(50) null,
    cli_correo varchar(255) null,
    cli_sexo char null,
    cli_edad int(2) null,
    cli_telefono varchar(12) null,
    cli_lugar_trabajo varchar(255) null,
    cli_lugar_cobro varchar(255) null,
    cli_fecha_ingreso date,
    cli_fecha_update timestamp,
    estado char null
)ENGINE=INNODB;

#Tabla préstamos
CREATE TABLE IF NOT EXISTS prestamos(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    usu_id int null,
    cli_id int null,
    int_id int null,
    mon_id int null,
    pla_id int null,
    est_id int null,
    pres_fecha_inicio date null,
    pres_fecha_fin date null,
    pres_fecha_registro date null,
    pres_fecha_update timestamp null,
    pres_observacion text null,
    pres_cuota int null,
    pres_pagado decimal(8,2) null,
    pres_total decimal(8,2) null,
    pres_terminos char null,
    estado char null,
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id),
    CONSTRAINT FOREIGN KEY (cli_id) REFERENCES clientes(id),
    CONSTRAINT FOREIGN KEY (int_id) REFERENCES intereses(id),
    CONSTRAINT FOREIGN KEY (mon_id) REFERENCES montos(id),
    CONSTRAINT FOREIGN KEY (pla_id) REFERENCES plazos(id),
    CONSTRAINT FOREIGN KEY (est_id) REFERENCES estatus(id)
)ENGINE=INNODB;

#Tabla de cuotas para los préstamos
CREATE TABLE IF NOT EXISTS cuotas(
    id int AUTO_INCREMENT NOT null PRIMARY key,
    pres_id int null,
    cli_id int null,
    usu_id int null,
    est_id int null,
    cuo_cuota_numero int null,
    cuo_fecha_estimada date null,
    cuo_fecha_pago date null,
    cuo_valor_pago decimal(8,2) null,
    cuo_saldo_inicial decimal(8,2) null,
    cuo_saldo_actual decimal(8,2) null,
    cuo_fecha_registro date null,
    cuo_hora_registro time null,
    cuo_fecha_update timestamp null,
    estado char null,
    CONSTRAINT FOREIGN KEY (pres_id) REFERENCES prestamos(id),
    CONSTRAINT FOREIGN KEY (cli_id) REFERENCES clientes(id),
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id),
    CONSTRAINT FOREIGN KEY (est_id) REFERENCES estatus(id)
)ENGINE=INNODB;

#Insertar roles
INSERT INTO `roles`(`id`, `rol_tipo`, `rol_descripcion`, `estado`) VALUES (null,'admin','Administrador', 'A');

#Fin primera parte de la bd