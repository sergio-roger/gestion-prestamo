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
    usu_verificar char(1) null,
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
    pla_periodo varchar(255) null,
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
    pres_visible char null,
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
    cuo_observacion text null,
    estado char null,
    CONSTRAINT FOREIGN KEY (pres_id) REFERENCES prestamos(id),
    CONSTRAINT FOREIGN KEY (cli_id) REFERENCES clientes(id),
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id),
    CONSTRAINT FOREIGN KEY (est_id) REFERENCES estatus(id)
)ENGINE=INNODB;

ALTER TABLE `cuotas` CHANGE `cuo_fecha_update` `cuo_fecha_update` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

#Insertar roles
INSERT INTO `roles`(`id`, `rol_tipo`, `rol_descripcion`, `estado`) VALUES (null,'admin','Administrador', 'A');

#Fin primera parte de la bd

#Segunda parte

#Listar todos los préstamos 
CREATE PROCEDURE `sp_getPrestamos`()
 NOT DETERMINISTIC 
 NO SQL SQL 
 SECURITY 
 DEFINER SELECT * , (SELECT CONCAT(clientes.cli_nombres,' ', clientes.cli_apellidos) FROM clientes where prestamos.cli_id = clientes.id) as nombres, (SELECT montos.mon_cantidad from montos where montos.id = prestamos.mon_id) as monto, (SELECT intereses.int_porcentaje from intereses where intereses.id = prestamos.int_id) as interes, (SELECT plazos.pla_duracion from plazos where plazos.id = prestamos.pla_id) as plazoDuracion, (SELECT plazos.pla_periodo FROM plazos where plazos.id = prestamos.pla_id)AS plazoPeriodo, (SELECT CONCAT(usuarios.usu_nombres,' ', usuarios.usu_apellidos) FROM usuarios where usuarios.id = prestamos.usu_id) as usuarios FROM prestamos WHERE pres_visible = 'V' and estado = 'A' 

#Listar préstamos ocultos
CREATE PROCEDURE `sp_getPrestamosHide`() 
NOT DETERMINISTIC 
NO SQL 
SQL SECURITY 
DEFINER 
SELECT * , (SELECT CONCAT(clientes.cli_nombres,' ', clientes.cli_apellidos) FROM clientes where prestamos.cli_id = clientes.id) as nombres, (SELECT montos.mon_cantidad from montos where montos.id = prestamos.mon_id) as monto, (SELECT intereses.int_porcentaje from intereses where intereses.id = prestamos.int_id) as interes, (SELECT plazos.pla_duracion from plazos where plazos.id = prestamos.pla_id) as plazoDuracion, (SELECT plazos.pla_periodo FROM plazos where plazos.id = prestamos.pla_id)AS plazoPeriodo, (SELECT CONCAT(usuarios.usu_nombres,' ', usuarios.usu_apellidos) FROM usuarios where usuarios.id = prestamos.usu_id) as usuarios FROM prestamos WHERE pres_visible = 'O' and estado = 'A' ORDER BY 1 DESC 


#Para obtener un unico préstamos
CREATE PROCEDURE `getPrestamo`(IN `id_pres` INT) 
COMMENT 'Para obtener un prestamo en particular' 
NOT DETERMINISTIC 
NO SQL 
SQL SECURITY DEFINER 
SELECT * , (SELECT CONCAT(clientes.cli_nombres,' ', clientes.cli_apellidos) FROM clientes where prestamos.cli_id = clientes.id) as nombres, (SELECT montos.mon_cantidad from montos where montos.id = prestamos.mon_id) as monto, (SELECT intereses.int_porcentaje from intereses where intereses.id = prestamos.int_id) as interes,
(SELECT estatus.est_detalle from estatus where estatus.id = prestamos.est_id) as det_estatus, (SELECT plazos.pla_duracion from plazos where plazos.id = prestamos.pla_id) as plazoDuracion, (SELECT plazos.pla_periodo FROM plazos where plazos.id = prestamos.pla_id)AS plazoPeriodo, (SELECT CONCAT(usuarios.usu_nombres,' ', usuarios.usu_apellidos) FROM usuarios where usuarios.id = prestamos.usu_id) as usuarios FROM prestamos WHERE estado = 'A' and 
id = id_pres


#Para obtener el préstamo de un cliente determinado
CREATE PROCEDURE `sp_getPrestamoCliente`(IN `id_cliente` INT) 
COMMENT 'Para obtener el prestamo segun id del cliente' 
NOT DETERMINISTIC 
NO SQL 
SQL SECURITY 
DEFINER 
SELECT *,
(SElECT montos.mon_cantidad FROM montos where montos.id = prestamos.mon_id) as monto
FROM prestamos where (est_id = 1 OR est_id = 2) and pres_visible = 'V' and prestamos.cli_id = id_cliente

#Obtener préstamos limitados a n registros
CREATE PROCEDURE `sp_gePrestamosLimit`(IN `limite` INT, IN `estatus_param` INT) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER SELECT * , 
(SELECT CONCAT(clientes.cli_nombres,' ', clientes.cli_apellidos) FROM clientes where prestamos.cli_id = clientes.id) as nombres, 
(SELECT montos.mon_cantidad from montos where montos.id = prestamos.mon_id) AS monto, 
(SELECT intereses.int_porcentaje from intereses where intereses.id = prestamos.int_id) AS interes, 
(SELECT plazos.pla_duracion from plazos where plazos.id = prestamos.pla_id) AS plazoDuracion, 
(SELECT plazos.pla_periodo FROM plazos where plazos.id = prestamos.pla_id) AS plazoPeriodo, 
(SELECT CONCAT(usuarios.usu_nombres,' ', usuarios.usu_apellidos) FROM usuarios where usuarios.id = prestamos.usu_id) AS usuarios 
FROM prestamos WHERE pres_visible = 'V' and estado = 'A' AND prestamos.est_id = estatus_param ORDER BY 1 DESC LIMIT limite

#Para obtener una determinada cuota
CREATE PROCEDURE `sp_getCuota`(IN `id_cuota` INT) 
NOT DETERMINISTIC NO SQL
SQL SECURITY 
DEFINER 
SELECT * , 
(SELECT estatus.est_detalle from estatus where estatus.id = cuotas.est_id) as estatus_des 
from cuotas where estado = 'A' and id = id_cuota

#Verificar si existe un cliente con un prestamo activo inicial o pagando
CREATE PROCEDURE `sp_existeClientePrestamo`(IN `id_cliente` INT) 
NOT DETERMINISTIC 
NO SQL 
SQL SECURITY 
DEFINER 
SELECT * from prestamos where estado = 'A' and (est_id = 1 OR est_id = 2) and cli_id = id_cliente

#Segunda Parte 
#Seguridad, validación, control de transacciones, movimientos

CREATE TABLE IF NOT EXISTS patrimonios(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    usu_id int null,
    pat_valor decimal(8,2) null,
    pat_fecha_registro date null,
    estado char null,
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id)
)ENGINE=INNODB

CREATE TABLE IF NOT EXISTS motivos(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    usu_id int null,
    mot_detalle text null,
    mot_fecha_registro date null,
    estado char null,
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id)
)ENGINE=INNODB

CREATE TABLE IF NOT EXISTS tiposMovimientos(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    usu_id int null,
    tm_numeracion int null,
    tm_cuenta varchar(255) null,
    tm_operacion char null,
    tm_fecha_registro date null,
    estado char null,
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id)
)ENGINE=INNODB

CREATE TABLE IF NOT EXISTS movimientos(
    id int AUTO_INCREMENT not null PRIMARY KEY,
    usu_id int null,
   	tm_id int null,
    mot_id int null,
    mov_valor decimal(8,2) null,
    mov_fecha_registro date null,
    estado char null,
    CONSTRAINT FOREIGN KEY (usu_id) REFERENCES usuarios(id),
    CONSTRAINT FOREIGN KEY (tm_id) REFERENCES tiposmovimientos(id),
    CONSTRAINT FOREIGN KEY (mot_id) REFERENCES motivos(id)
)ENGINE=INNODB


