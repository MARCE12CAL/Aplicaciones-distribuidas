--CONSULTA
--INSERT INTO alumno_p2
--SELECT * FROM alumno
--WHERE codigo >=196600;



-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 03-06-2024 a las 10:04:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quinto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_2`
--

CREATE TABLE `alumno_2` (
  `codigo` int(5) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
