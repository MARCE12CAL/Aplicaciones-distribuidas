//FRAGMENTACIÓN HORIZONTAL
FRAGMENTACION HORIZONTAL --------------------------------------------------
1
CREAR TABLA 

CREATE TABLE alumno_horizontal (`codigo` int(5) NOT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `nombres` varchar(40) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `telefono1` varchar(15) DEFAULT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `redsocial` varchar(15) DEFAULT NULL,
  `carrera` varchar(40) DEFAULT NULL,
  `extension` varchar(15) DEFAULT NULL,
  `aniograduacion` int(4) DEFAULT NULL,
  `lugardetrabajo` varchar(40) DEFAULT NULL,
  `direcciontrabajo` varchar(40) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cargo` varchar(40) DEFAULT NULL,
  `Empresapropia` varchar(5) DEFAULT NULL,
  `trabajaensuareadeestudio` varchar(5) DEFAULT NULL,
  `tiempodetrabajo` int(2) DEFAULT NULL,
  `s1` text DEFAULT NULL,
  `s2` text DEFAULT NULL,
  `s3` text DEFAULT NULL,
  `s4` text DEFAULT NULL,
  `s5` text DEFAULT NULL,
  `s6` text DEFAULT NULL,
  `s7` text DEFAULT NULL,
  `s8` text DEFAULT NULL,
  `s9` text DEFAULT NULL,
  `s10` text DEFAULT NULL,
  `s11` text DEFAULT NULL,
  `s12` datetime DEFAULT NULL,
  `s13` text DEFAULT NULL,
  `s14` text DEFAULT NULL,
  `s15` text DEFAULT NULL,
  `s16` text DEFAULT NULL,
  `s17` text DEFAULT NULL,
  `s18` text DEFAULT NULL,
  `s19` text DEFAULT NULL,
  `s20` text DEFAULT NULL,
  `s21` text DEFAULT NULL,
  `s22` text DEFAULT NULL,
  `s23` text DEFAULT NULL,
  `s24` text DEFAULT NULL,
  `s25` text DEFAULT NULL,
  `s26` text DEFAULT NULL,
  `s27` text DEFAULT NULL,
  `s28` text DEFAULT NULL,
  `s29` text DEFAULT NULL,
  `s30` text DEFAULT NULL,
  `s31` text DEFAULT NULL,
  `s32` text DEFAULT NULL,
  `s33` text DEFAULT NULL,
  `fechagrado` date DEFAULT NULL,
  `s36` text DEFAULT NULL,
  `s37` text DEFAULT NULL,
  `s38` text DEFAULT NULL,
  `s39` text DEFAULT NULL,
  `s40` text DEFAULT NULL,
  `s41` text DEFAULT NULL,
  `s42` text DEFAULT NULL,
  `s43` text DEFAULT NULL,
  `s44` text DEFAULT NULL,
  `s45` text DEFAULT NULL,
  `s46` text DEFAULT NULL,
  `s47` text DEFAULT NULL,
  `area1` varchar(50) DEFAULT NULL,
  `area2` varchar(50) DEFAULT NULL,
  `s48` text DEFAULT NULL,
  `s45_1` text DEFAULT NULL,
  `s46_1` text DEFAULT NULL,
  `s47_1` text DEFAULT NULL,
  `s48_1` text DEFAULT NULL,
  `s49_1` text DEFAULT NULL,
  `s50_1` text DEFAULT NULL,
  `valida` varchar(2) DEFAULT NULL,
  `validac` varchar(2) DEFAULT NULL,
  `validad` varchar(2) DEFAULT NULL,
  `validas` varchar(2) DEFAULT NULL,
  `validat` varchar(2) DEFAULT NULL,
  `ins_even` varchar(2) DEFAULT NULL,
  `par_even` varchar(2) DEFAULT NULL
)  

Insertar los datos de la tabla original en la nueva tabla particionada:


INSERT INTO alumno_horizontal
SELECT * FROM alumno;
******************************************************************************

------------------------------------------------------------
CREAR OTRAS DOS TABLAS PARA SEPARARLAS EN FRAGMENTOS MAS PEQUEÑAS

CREATE TABLE alumno_p1 LIKE alumno;
CREATE TABLE alumno_p2 LIKE alumno;
----------------------------------------------
SE CALCULA EL VALOR INTERMEDIO ATRA VEZ DEL ID O CODIGO PARA PODER DIVIDIR LA TABLA PRINCIPAL ALUMNO_HORIZONTAL

SELECT @mitad_codigo := (
    SELECT ROUND(MAX(codigo) - MIN(codigo)) / 2 + MIN(codigo)
    FROM alumno
);
---------------------------------------------------
Se Inserta los registros en las tablas correspondientes según el valor del campo codigo:


INSERT INTO alumno_p1
SELECT * FROM alumno
WHERE codigo < 196599;

INSERT INTO alumno_p2
SELECT * FROM alumno
WHERE codigo >=196600;
-----------------------------------------
SE VERIFICA EL NUMERO DE REGISTRO EN CADA TABLA:

SELECT COUNT(*) FROM alumno_p1;
SELECT COUNT(*) FROM alumno_p2;