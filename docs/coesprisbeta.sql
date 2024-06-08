-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2015 a las 07:30:53
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coespris`
--
CREATE DATABASE IF NOT EXISTS `coespris` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `coespris`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes`
--

DROP TABLE IF EXISTS `asistentes`;
CREATE TABLE IF NOT EXISTS `asistentes` (
  `id_grupo` bigint(20) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `estatus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_solicitud` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizacion`
--

DROP TABLE IF EXISTS `autorizacion`;
CREATE TABLE IF NOT EXISTS `autorizacion` (
  `id_autorizacion` bigint(20) NOT NULL,
  `au_fecha` datetime NOT NULL,
  `au_comisionado` text COLLATE utf8_unicode_ci NOT NULL,
  `id_formato` smallint(6) NOT NULL,
  `id_folio` bigint(20) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL,
  `ct_nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ct_apaterno` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ct_amaterno` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ct_calle` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ct_numero` smallint(6) NOT NULL,
  `id_colonia` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `ct_nombre`, `ct_apaterno`, `ct_amaterno`, `ct_calle`, `ct_numero`, `id_colonia`) VALUES
(1, 'MIGUEL ANGEL ', 'ANDRADE', 'SOTO', 'PUERTO DE ENSENADA', 448, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_postal`
--

DROP TABLE IF EXISTS `codigo_postal`;
CREATE TABLE IF NOT EXISTS `codigo_postal` (
  `id_cod_pos` int(11) NOT NULL,
  `cp_cod_pos` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codigo_postal`
--

INSERT INTO `codigo_postal` (`id_cod_pos`, `cp_cod_pos`) VALUES
(1, 28200),
(2, 28000),
(3, 28047),
(4, 28040),
(5, 28100),
(6, 28869),
(7, 28970);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colonia`
--

DROP TABLE IF EXISTS `colonia`;
CREATE TABLE IF NOT EXISTS `colonia` (
  `id_colonia` int(11) NOT NULL,
  `cl_nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_cod_pos` int(11) NOT NULL,
  `id_localidad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `colonia`
--

INSERT INTO `colonia` (`id_colonia`, `cl_nombre`, `id_cod_pos`, `id_localidad`) VALUES
(1, 'Centro', 1, 3),
(2, 'Los Electricistas', 3, 4),
(3, 'Centro', 2, 4),
(4, 'BUROCRATAS', 4, 4),
(5, 'Centro', 2, 4),
(6, 'Centro', 5, 9),
(7, 'Salahua', 6, 3),
(8, 'Centro', 7, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

DROP TABLE IF EXISTS `cuenta`;
CREATE TABLE IF NOT EXISTS `cuenta` (
  `id_cuenta` int(11) NOT NULL,
  `cn_razon_social_banco` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cn_cuentahabiente` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `cn_numero_cuenta` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `cn_clabe` char(18) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id_cuenta`, `cn_razon_social_banco`, `cn_cuentahabiente`, `cn_numero_cuenta`, `cn_clabe`) VALUES
(1, 'HSBC', 'SERVICIO DE SALUD DEL ESTADO DE COLIMA', '4050453042', '021090040504530423');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` smallint(6) NOT NULL,
  `c_nombre` char(70) COLLATE utf8_unicode_ci NOT NULL,
  `c_duracion` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `c_nombre`, `c_duracion`) VALUES
(1, 'Manejo higienico de alimentos', 3),
(2, 'Manejo y dispensacion de medicamos (Instructor Autorizado)', 2),
(3, 'Manejo y dispensacion de medicamos', 3),
(4, 'Manejo de residuos toxicos', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_fiscales`
--

DROP TABLE IF EXISTS `datos_fiscales`;
CREATE TABLE IF NOT EXISTS `datos_fiscales` (
  `id_cliente` int(11) NOT NULL,
  `df_rfc` char(13) COLLATE utf8_unicode_ci NOT NULL,
  `df_razon_social` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `df_calle` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `df_numero` int(11) NOT NULL,
  `id_colonia` int(11) NOT NULL,
  `correo_electronico` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos_fiscales`
--

INSERT INTO `datos_fiscales` (`id_cliente`, `df_rfc`, `df_razon_social`, `df_calle`, `df_numero`, `id_colonia`, `correo_electronico`) VALUES
(1, 'HGHG123456HGF', 'COLIMA CUSTOMS', 'V. CARRANZA', 789, 1, 'miguel@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_secundarios_autorizacion`
--

DROP TABLE IF EXISTS `datos_secundarios_autorizacion`;
CREATE TABLE IF NOT EXISTS `datos_secundarios_autorizacion` (
  `id_dat_sec_autorizacion` int(11) NOT NULL,
  `dsa_nombre` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `dsa_tipo_dato` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dsa_extras` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `dsa_clave` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos_secundarios_autorizacion`
--

INSERT INTO `datos_secundarios_autorizacion` (`id_dat_sec_autorizacion`, `dsa_nombre`, `dsa_tipo_dato`, `dsa_extras`, `dsa_clave`) VALUES
(1, 'RESPONSABLE SANITARIO', 'texto', 'required', 'key_resp_san'),
(2, 'GIRO', 'texto', 'required placeholder=''FARMACIA,BOTICA, DROGUERIA''', 'giro_negocio'),
(3, 'DENOMINACION', 'texto', 'required', 'no_denominacion'),
(4, 'RESPONSABLE', 'texto', 'required', 'nom_responsable'),
(5, 'TIPO DE DE INTERNAMIENTO O SALIDA', 'radio', 'INTERNAMIENTO DE CADAVERES;INTERNAMIENTO DE RESTOS ARIDOS;SALIDA DE CADAVERES;SALIDA DE RESTOS ARIDOS;\r\n', 'key_tipo_int'),
(6, 'NOMBRE', 'texto', 'required', 'key_nombrelugar'),
(7, 'TELEFONO', 'texto', 'required', 'key_telefono'),
(8, 'INICIO DE LABORES', 'texto', 'required', 'key_labores'),
(9, 'LICENCIA PARA:', 'radio', 'FARMACIA;BOTICA;DROGERIA;', 'key_licencia'),
(10, 'FOLIO', 'texto', 'required placeholder=''0000'' pattern="[0-9]{4}"', 'key_folio_farm'),
(11, 'CLASIFICACION AUTORIZADA PARA:', 'radio', '464111;464112;', 'key_clas_aut'),
(12, 'Psicotropicos', 'boolean', '', 'key_psico'),
(13, 'Vacunas', 'boolean', '', 'key_vacunas'),
(14, 'Toxoides', 'boolean', '', 'key_toxoides'),
(15, 'Sueros y Antitoxinas de Origen Animal', 'boolean', '', 'key_saoa'),
(16, 'Hemoderivados', 'boolean', '', 'key_hemo'),
(17, 'LUGAR DE DESTINO', 'texto', 'required', 'key_destino'),
(18, 'EMBALSAMADO', 'radio', 'SI;NO;', 'key_embal'),
(19, 'Original de la certificación de un médico con título legalmente expedido, de las circunstancias previas al fallecimiento de la persona de cuyo cadáver se hubieren extraído los órganos,  tejidos y sus componentes y células que se pretenden internar', 'boolean', 'INTERNACION AL TERRITORIO NACIONAL DE ORGANOS, TEJIDOS Y  SUS COMPONENTES Y CELULAS ', 'key_Ai_certi_me'),
(20, 'Original de la documentación constitutiva de la institución que realice la internación', 'boolean', '', 'key_Ai_doc_con'),
(21, 'Documento que acredite el funcionamiento legal del establecimiento que otorga los órganos, tejidos y sus componentes y células', 'boolean', 'DEL ESTABLECIMIENTO EN EL EXTRANJERO', 'key_Ai_doc_acr'),
(22, 'Autorización del gobierno para la salida de órganos, tejidos y sus componentes y células del país.', 'boolean', '', 'key_Ai_autori'),
(23, 'Constancia de que el establecimiento otorga los órganos, tejidos y sus componentes y células a título gratuito', 'boolean', '', 'key_Ai_const'),
(24, 'Certificación de que los órganos, tejidos y sus componentes y células,  están exentos de cualquier patología', 'boolean', '', 'key_Ai_cert_or'),
(25, 'Documentación sobre la vía de entrada al territorio nacional', 'boolean', '', 'key_Ai_doc_via'),
(26, 'Original de la certificación de un médico con título legalmente expedido, de las circunstancias previas al fallecimiento de la persona de cuyo cadáver se hubieren extraído los órganos, tejidos y sus componentes y células.', 'boolean', 'SALIDA DEL TERRITORIO NACIONAL DE ORGANOS, TEJIDOS Y SUS COMPONENTES Y CELULAS.', 'key_As_certi_me'),
(27, 'Original de la documentación constitutiva de la institución que realice la salida del país', 'boolean', '', 'key_As_doc_con'),
(28, 'Documento que acredite el funcionamiento legal del establecimiento que otorga los órganos, tejidos y sus componentes y células.', 'boolean', 'DEL ESTABLECIMIENTO EN EL PAIS.', 'key_As_doc_acr'),
(29, 'Constancia de que el establecimiento otorga los órganos, tejidos y sus componentes y células a título gratuito.', 'boolean', '', 'key_As_const'),
(30, 'Certificación de que los órganos, tejidos y sus componentes y células, están exentos de cualquier patología', 'boolean', '', 'key_As_cert_or'),
(31, 'Documentación sobre la vía de salida del territorio nacional', 'boolean', '', 'key_As_doc_via'),
(32, 'Certificado y acta de defunción', 'boolean', 'DOCUMENTOS PARA EL TRASLADO DE CADAVERES', 'key_B_certi'),
(33, 'Comprobante de la tesis de embalsamamiento, en caso de que la distancia por recorrer sea mayor a 300 kms. o transcurran más de 48 horas. a partir del momento de la defunción', 'boolean', '', 'key_B_comprob'),
(34, 'Carta poder del particular a la funeraria, asentando en ésta la vía de traslado aérea, terrestre o marítima a utilizar.', 'boolean', '', 'key_B_carta'),
(35, 'Solicitud escrita de algún disponente secundario, representante legal o quién demuestre interés jurídico, señalando la causa de la solicitud.', 'boolean', 'DOCUMENTOS PARA EMBALSAMAMIENTO', 'key_B_solici'),
(36, 'Original y copia del certificado de defunción.', 'boolean', '', 'key_B_cert_def'),
(37, 'Original y copia de la documentación que acredite la legitimación del solicitante y de los motivos de la solicitud. (credencial de elector o pasaporte vigente', 'boolean', '', 'key_B_motivos'),
(38, 'Certificado y acta de defunción, traducidos al español y certificados por las autoridades consulares mexicanas', 'boolean', 'DOCUMENTOS PARA INTERNAMIENTO DE CADAVERES', 'key_C_certi'),
(39, 'Comprobante de embalsamamiento, traducido al español y certificado por las autoridades consulares mexicanas, en el país donde ocurrió el deceso', 'boolean', '', 'key_C_comprob'),
(40, 'Permiso del traslado internacional otorgado por la autoridad sanitaria del país donde haya ocurrido el fallecimiento, traducido al español y certificado por las autoridades consulares mexicanas.', 'boolean', '', 'key_C_permiso'),
(41, 'Original de la carta poder del particular a la agencia funeraria que efectúa el traslado, asentando la vía de traslado (aérea, marítima o terrestre a utilizar).', 'boolean', '', 'key_C_carta'),
(42, 'Comprobante de inhumación', 'boolean', 'INTERNAMIENTO DE RESTOS ARIDOS', 'key_Ci_compro'),
(43, 'Información sobre la vía aérea, marítima o terrestre que se utilizará', 'boolean', '', 'key_Ci_via'),
(44, 'Especificación del destino de los restos', 'boolean', '', 'key_Ci_destino'),
(45, 'Certificado o acta de defunción.', 'boolean', 'SALIDA DE CADAVERES', 'key_Cs_certifi'),
(46, 'Comprobante de la tesis de embalsamamiento', 'boolean', '', 'key_Cs_comp'),
(47, 'Original de la carta poder del particular a la agencia funeraria que efectúa el traslado, asentando en esta la vía de traslado (aérea, marítima o terrestre a utilizar)', 'boolean', '', 'key_Cs_carta'),
(48, 'Comprobante de inhumación', 'boolean', 'SALIDA DE RESTOS ARIDOS', 'key_Csr_comp_in'),
(49, 'Comprobante de exhumación como residuos cumplidos', 'boolean', '', 'key_Csr_comp_ex'),
(50, 'Información sobre la vía de traslado (aérea, marítima o terrestre a utilizar)', 'boolean', '', 'key_Csr_via'),
(51, 'Especificación del destino final de los restos.', 'boolean', '', 'key_Csr_desti'),
(52, 'Certificado o acta de defunción', 'boolean', 'PARA LA EXHUMACION PREMATURA', 'key_D_certi'),
(53, 'Comprobante de inhumación', 'boolean', '', 'key_D_comp_in'),
(54, 'Orden girada por Ministerio Público o autoridad judicial, para la exhumación prematura', 'boolean', '', 'key_D_orden'),
(55, 'Comprobante de inhumación', 'boolean', 'PARA LA EXHUMACION', 'key_E_comp_in'),
(56, 'Original de la carta Poder del particular hacia la agencia funeraria, asentando en ésta la vía de traslado (aérea, marítima o terrestre a utilizar).', 'boolean', '', 'key_E_carta'),
(57, 'Identificación del solicitante (credencial de elector o pasaporte vigente).', 'boolean', '', 'key_E_identifi'),
(58, 'Especificación del destino final de los restos.', 'boolean', '', 'key_E_destino'),
(59, 'Certificado o acta de defunción.', 'boolean', 'PARA LA INHUMACION O INCINERACION DE CADAVERES SI SE EFECTUA ANTES DE 12 HRS. O DESPUES DE 48 DE OCURRIDO EL DECESO', 'key_F_certi_def'),
(60, 'Comprobante de la tesis del embalsamamiento, cuando se realice la inhumación o incineración después de las 48 horas de haber ocurrido el fallecimiento', 'boolean', '', 'key_F_comprob'),
(61, 'Acta de no inconveniencia de la Procuraduría General de Justicia del Distrito federal\r\no su equivalente en el resto de las entidades federativas. En caso de existir investigación judicial relacionada con la causa de la defunción\r\n', 'boolean', '', 'key_F_acta'),
(62, 'LICENCIA NUM:', 'texto', 'required placeholder=''06 010 09 0001''', 'licencia_numero'),
(63, 'LICENCIA SANITARIA No:', 'texto', 'required placeholder=''00-06 A000''', 'lic_sanitaria'),
(64, 'FOLIOS:', 'texto', 'required', 'key_folios'),
(65, 'No FOLIO(Credencial Elector):', 'texto', 'required', 'num_credencial'),
(66, 'LUGAR DE INHUMACION', 'texto', 'required', 'key_lug_in'),
(67, 'MOTIVOS DE LA EXHUMACION', 'texto', 'required', 'key_mot_ex'),
(68, 'CREMATORIO', 'texto', 'required', 'key_cremato'),
(69, 'LUGAR DONDE SE REALIZARA', 'texto', 'required', 'key_lug_rea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_secundarios_solicitud`
--

DROP TABLE IF EXISTS `datos_secundarios_solicitud`;
CREATE TABLE IF NOT EXISTS `datos_secundarios_solicitud` (
  `id_dat_sec_sol` int(11) NOT NULL,
  `dss_nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dss_tipo_dato` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dss_extras` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `dss_clave` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos_secundarios_solicitud`
--

INSERT INTO `datos_secundarios_solicitud` (`id_dat_sec_sol`, `dss_nombre`, `dss_tipo_dato`, `dss_extras`, `dss_clave`) VALUES
(3, 'RAZÓN SOCIAL O DENOMINACIÓN DEL ESTABLECIMIENTO', 'texto', 'required', 'key_razonsoc'),
(4, 'CONSISTE EN LO SIGUIENTE', 'texto', 'required', 'key_consiste'),
(5, 'MUNICIPIO', 'lista', 'municipio', 'key_municipio'),
(6, 'DOMICILIO', 'texto', 'required', 'key_domicilio'),
(8, 'PLANTA BAJA', 'int', 'required', 'key_pbaja'),
(9, 'PISO 1', 'int', '0', 'key_piso1'),
(10, 'PISO 2', 'int', '0', 'key_piso2'),
(11, 'PISO 3', 'int', '0', 'key_piso3'),
(12, 'SUPERFICIE TOTAL DE CONSTRUCCION', 'int', 'total', 'key_superficie'),
(13, 'PERITO', 'texto', 'required', 'key_perito'),
(14, 'CALLE', 'texto', 'requried', 'key_calle'),
(15, 'NUMERO', 'int', 'required', 'key_numero'),
(16, 'COLONIA', 'texto', 'required', 'key_colonia'),
(18, 'NOMBRE DEL FINADO', 'texto', 'required', 'key_finado'),
(20, 'LIBROS ESTUPEFACIENTES', 'radio', 'ESTUPEFACIENTES(GRUPO I);PSICOTROPICOS(GRUPO II);ESTUPEFACIENTES(GRUPO III);', 'key_estupefaci'),
(21, 'CLAVE SCIAN', 'texto', 'required', 'key_scian'),
(22, 'DESCRIPCION SCIAN', 'texto', 'required', 'key_des_scian'),
(23, 'ESTABLECIMIENTO DE', 'radio', 'PRODUCTOS Y SERVICIOS;SERVICIOS DE SALUD;SALUD AMBIENTAL;INSUMOS PARA LA SALUD;', 'key_estab_de'),
(24, 'CON OBJETO DE', 'radio', 'VERIFICACION PARA VALORAR EL LEVANTAMIENTO DE LA MEDIDA DE SEGURIDAD;VERIFICACION POR LA TOMA DE MUESTRAS PARA VALORAR EL LEVANTAMIENTO DE LA MEDIDA DE SEGURIDAD;VERIFICACION PARA LA LIBERACION DE PRODUCTO ASEGURADO;VERIFICACION GENERAL DEL ESTABLECIMIENTO;VERIFICACION PARA LA TOMA DE MUESTRA DE PRODUCTO;VERIFICACION PARA RETIRO DE SELLOS DE SUSPENSION DE TRABAJOS Y SERVICIOS POR BAJA DEFINITIVA;VERIFICACION PARA RETIRO DE SELLOS DE SUSPENSION DE TRABAJOS Y SERVICIOS, PARA DESTRUCCION DE PRODUCTO;', 'key_objeto'),
(25, 'TIPO ASESORIA', 'radio', 'PRODUCTOS Y SERVICIOS;INSUMOS PARA LA SALUD;', 'key_asesoria'),
(26, 'NUMERO DE EXPEDIENTE', 'texto', 'required', 'key_expedien'),
(29, 'LIBROS B.SANGRE', 'radio', 'BANCOS DE SANGRE;SERVICIOS DE TRANSFUSION;', 'key_libros_b'),
(30, 'DOMICILIO DEL CURSO', 'texto', 'required', 'key_curso_dom'),
(31, 'HORARIO DEL CURSO', 'texto', 'required', 'key_hor_cur'),
(32, 'NO. PERSONAS DE CURSO', 'int', 'required', 'key_per_cur'),
(33, 'NOMBRE INSTRUCTOR DE CURSO', 'texto', 'required', 'key_nomb_ins'),
(34, 'SOLIC DE', 'radio', 'Constancia de no inconveniente de aviso sanitario de importación;Consulta en materia de sanidad internacional;', 'key_solic_de'),
(35, 'DENOMINACION ESPECIFICA DEL PRODUCTO', 'texto', 'required', 'key_denominac'),
(36, 'NOMBRE(MARCA COMERCIAL) O DENOMINACION DISTINTA', 'texto', 'required', 'key_denom_t'),
(37, 'MODELO', 'texto', 'required', 'key_modelo'),
(38, 'DESCRIPCION DEL PRODUCTO', 'texto', 'required', 'key_descripcion'),
(39, 'FRACCION ARANCELARIA', 'texto', 'required', 'key_arancel'),
(40, 'NUMERO DE ACTA', 'int', 'required', 'key_acta'),
(41, 'FECHA DE ACTA', 'fecha', 'required', 'key_f_acta'),
(44, 'NUMERO DE PERSONAS QUE ASISTIRAN', 'int', 'required', 'key_asistiran'),
(45, 'CODIGO DE BARRAS', 'radio', 'CODIGOS DE BARRAS;', 'key_barras'),
(46, 'TIPO LICENCIA', 'radio', 'INSUMOS PARA LA SALUD;SALUD AMBIENTAL;', 'key_tipolic'),
(47, 'CONSTANCIA MANEJO ALIMENTOS', 'radio', 'EXPEDICION DE CONSTANCIA POR PERSONA DEL CURSO DE MANEJO Y DISPENSACION  DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS, DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL, IMPARTIDA POR INSTRUCTOR AUTORIZADO QUE CUENTE CON CLAVE ALFANUMERICA;CONSTANCIA DEL CURSO DE CAPACITACION DE BUENAS PRACTICAS DE HIGIENE Y/O MANEJO HIGIENICO DE ALIMENTOS;', 'key_constancial'),
(48, 'TIPO DE OPINIÓN TECNICA', 'radio', 'ESTABLECIMIENTO;ETIQUETADO;', 'key_opinion'),
(49, 'APELLIDO PATERNO DEL FINADO', 'texto', 'required', 'key_apat_fin'),
(50, 'APELLIDO MATERNO DEL FINADO', 'texto', 'required', 'key_amat_fin'),
(51, 'EDAD DEL FINADO', 'texto', 'required', 'key_edad_fin'),
(52, 'SEXO DEL FINADO', 'texto', 'required', 'key_sexo_fin'),
(53, 'CAUSA DE LA DEFUSION', 'texto', 'required', 'key_causa'),
(54, 'FECHA DE INHUMACION', 'fecha', 'required', 'key_inhumacion'),
(55, 'PARENTESCO CON EL DIFUNTO', 'texto', 'required', 'key_parentesco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dsa_autorizacion`
--

DROP TABLE IF EXISTS `dsa_autorizacion`;
CREATE TABLE IF NOT EXISTS `dsa_autorizacion` (
  `id_dat_sec_aut` int(11) NOT NULL,
  `id_autorizacion` bigint(20) NOT NULL,
  `valor_capturado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dsa_servicio`
--

DROP TABLE IF EXISTS `dsa_servicio`;
CREATE TABLE IF NOT EXISTS `dsa_servicio` (
  `id_dat_sec_aut` int(11) NOT NULL,
  `id_servicio` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dsa_servicio`
--

INSERT INTO `dsa_servicio` (`id_dat_sec_aut`, `id_servicio`) VALUES
(17, 10),
(18, 10),
(32, 10),
(33, 10),
(34, 10),
(35, 10),
(36, 10),
(37, 10),
(17, 11),
(18, 11),
(32, 11),
(33, 11),
(34, 11),
(35, 11),
(36, 11),
(37, 11),
(18, 12),
(59, 12),
(60, 12),
(61, 12),
(69, 12),
(55, 13),
(56, 13),
(57, 13),
(58, 13),
(68, 13),
(55, 14),
(56, 14),
(57, 14),
(58, 14),
(68, 14),
(2, 17),
(3, 17),
(23, 17),
(62, 17),
(64, 17),
(23, 18),
(2, 19),
(4, 19),
(6, 19),
(7, 19),
(8, 19),
(1, 22),
(5, 23),
(17, 23),
(18, 23),
(38, 23),
(39, 23),
(40, 23),
(41, 23),
(42, 23),
(43, 23),
(44, 23),
(45, 23),
(46, 23),
(47, 23),
(48, 23),
(49, 23),
(50, 23),
(51, 23),
(9, 24),
(10, 24),
(11, 24),
(12, 24),
(13, 24),
(14, 24),
(15, 24),
(16, 24),
(63, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dss_servicio`
--

DROP TABLE IF EXISTS `dss_servicio`;
CREATE TABLE IF NOT EXISTS `dss_servicio` (
  `id_dat_sec_sol` int(11) NOT NULL,
  `id_servicio` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dss_servicio`
--

INSERT INTO `dss_servicio` (`id_dat_sec_sol`, `id_servicio`) VALUES
(2, 17),
(4, 7),
(4, 8),
(4, 9),
(5, 7),
(5, 8),
(5, 9),
(6, 7),
(6, 8),
(6, 9),
(8, 7),
(8, 8),
(8, 9),
(9, 7),
(9, 8),
(10, 7),
(10, 8),
(11, 7),
(11, 8),
(12, 7),
(12, 8),
(13, 7),
(13, 8),
(13, 9),
(13, 68),
(14, 68),
(18, 10),
(18, 11),
(18, 12),
(18, 13),
(18, 14),
(18, 23),
(19, 10),
(19, 11),
(19, 12),
(19, 13),
(19, 14),
(19, 23),
(20, 17),
(21, 15),
(21, 16),
(21, 19),
(22, 15),
(22, 16),
(22, 19),
(23, 15),
(23, 16),
(23, 19),
(24, 15),
(24, 16),
(25, 18),
(26, 19),
(29, 22),
(30, 28),
(31, 28),
(32, 28),
(33, 28),
(35, 29),
(35, 30),
(36, 29),
(36, 30),
(37, 29),
(37, 30),
(38, 29),
(38, 30),
(39, 29),
(39, 30),
(40, 31),
(41, 31),
(42, 32),
(43, 32),
(44, 32),
(46, 24),
(46, 35),
(49, 10),
(49, 11),
(49, 12),
(49, 13),
(49, 14),
(49, 23),
(50, 10),
(50, 11),
(50, 12),
(50, 13),
(50, 14),
(50, 23),
(51, 10),
(51, 11),
(51, 12),
(51, 13),
(51, 14),
(51, 23),
(52, 10),
(52, 11),
(52, 12),
(52, 13),
(52, 14),
(52, 23),
(53, 10),
(53, 11),
(53, 12),
(53, 13),
(53, 14),
(53, 23),
(54, 10),
(54, 11),
(54, 12),
(54, 13),
(54, 14),
(54, 23),
(55, 12),
(55, 13),
(55, 14),
(55, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dss_solicitud`
--

DROP TABLE IF EXISTS `dss_solicitud`;
CREATE TABLE IF NOT EXISTS `dss_solicitud` (
  `id_dat_sec_sol` int(11) NOT NULL,
  `id_solicitud` bigint(20) NOT NULL,
  `valor_capturado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dss_solicitud`
--

INSERT INTO `dss_solicitud` (`id_dat_sec_sol`, `id_solicitud`, `valor_capturado`) VALUES
(18, 1, 'OSCAR MANUEL'),
(18, 2, 'MAXIMILIANO'),
(18, 3, 'MAXIMILIANO'),
(49, 1, 'LOPEZ '),
(49, 2, 'CARIDAD'),
(49, 3, 'CARIDAD'),
(50, 1, 'JIMENEZ'),
(50, 2, 'CIENFUEGOS'),
(50, 3, 'CIENFUEGOS'),
(51, 1, '99'),
(51, 2, '99'),
(51, 3, '99'),
(52, 1, 'MASCULINO'),
(52, 2, 'MASCULINO'),
(52, 3, 'MASCULINO'),
(53, 1, 'MUERTE NATURAL'),
(53, 2, 'INFARTO'),
(53, 3, 'MUERTE NATURAL'),
(54, 1, '2015-10-01'),
(54, 2, '2015-10-01'),
(54, 3, '2015-10-02'),
(55, 2, 'NIETO'),
(55, 3, 'NIETO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL,
  `em_nombres` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `em_apaterno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `em_amaterno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `em_tipo_empleado` enum('Interno','Externo') COLLATE utf8_unicode_ci NOT NULL,
  `id_puesto` smallint(6) NOT NULL,
  `id_oficina` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `em_nombres`, `em_apaterno`, `em_amaterno`, `em_tipo_empleado`, `id_puesto`, `id_oficina`) VALUES
(1, 'ANTONIO', 'ZEPEDA', 'MENDOZA', 'Interno', 3, 2),
(2, 'ARELIO', 'REYES', 'VILLALOBOS', 'Interno', 1, 6),
(3, 'MARIANA', 'RODRIGUEZ', 'GONZALEZ', 'Externo', 4, 2),
(4, 'ALEJANDRO', 'LOPERZ', 'PEREZ', 'Externo', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` smallint(6) NOT NULL,
  `es_nombre` char(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `es_nombre`) VALUES
(2, 'Jalisco'),
(3, 'Michoacan'),
(4, 'Monterrey'),
(6, 'Colima');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` bigint(20) NOT NULL,
  `id_folio` bigint(20) NOT NULL,
  `fc_estatus` tinyint(1) NOT NULL,
  `fc_tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_folio`, `fc_estatus`, `fc_tipo`) VALUES
(1, 1, 0, 1),
(2, 2, 0, 1),
(3, 3, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato`
--

DROP TABLE IF EXISTS `formato`;
CREATE TABLE IF NOT EXISTS `formato` (
  `id_formato` smallint(6) NOT NULL,
  `fr_nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fr_contenido` text CHARACTER SET utf8 NOT NULL,
  `fr_tipo` enum('Solicitud','Orden','Recibo','Autorización') CHARACTER SET latin1 NOT NULL,
  `estatus` enum('Habilitado','Inhabilitado') CHARACTER SET latin1 NOT NULL,
  `fr_ruta` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `fr_ruta_pdf` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `formato`
--

INSERT INTO `formato` (`id_formato`, `fr_nombre`, `fr_contenido`, `fr_tipo`, `estatus`, `fr_ruta`, `fr_ruta_pdf`) VALUES
(1, 'Autorizacion de Planos de Construccion', '<P style=''text-align:justify;''>			Se le devuelven los planos debidamente requisitados, en la inteligencia de que se servirá notificar a			estas oficinas la terminación de la obra antes de ser utilizada.		</P>		<P style=''text-align:justify;''>			Asimismo se hace de su conocimiento, que  deberá informar a esta dependencia cualquier cambio o			modificación al proyecto autorizado.		</P>		<P style=''text-align:justify;''>			Esta autorización no le exime de los trámites Municipales necesarios para dar inicio a su obra.			<b><big>Esta autorización deberá permanecer en obra y ser presentada a los verificadores sanitarios</big></b>		</P>', 'Autorización', 'Habilitado', 'formatos/Planos de Construccion.doc', 'AutorizacionPCPDF.php'),
(2, 'ORDEN DE PAGO PLANOS', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por la revision y autorizacion de planos de construccion.doc', 'reporte.php'),
(3, 'Autorización de libros de banco de sangre y transfusión de sanguinea.', '<p>Los servicios de transfusión pueden omitir anotar los resultados de hemoglobina, hematocrito y de pruebas serológicas, así como el tipo de donación, excepto cuando se trate de actos de disposición con fines de transfusión autóloga por deposito previo realizado en el establecimiento.</p><p>El libro para el registro de control de ingresos y egresos de sangre y sus componentes, de los bancos de sangre y servicios de transfusión, deberá conservarse durante 5 años en archivo activo y 5 años en archivomuerto.</p><p><b>INSTRUCTIVO DE LLENADO</b></p><p>La información mínima almacenada deberá ser equivalente a la de los libros de registro de ingresos y egresos de conformidad con el apartado C. 19.3.2 de la Norma Oficial Mexicana NOM-253-SSA1-2012. “Para la disposición de sangre humana y sus componentes con fines terapéuticos.” y por cada sesión de trabajo deberá de generarse una bitácora electrónica donde se almacene todo registro, proceso o modificación, relativo a las actividades de disposición de sangre y sus componentes efectuados, de manera que la información sea auditable y que incluya la fecha, hora y nombre del usuario.</p>', 'Autorización', 'Habilitado', 'formatos/Libros Bancos de Sangre y Servicios de Transfusion.doc', 'autorizacion_bancos.php'),
(5, 'RECIBO DE PAGO', 'PRUEBA DE RECIBO DE PAGO', 'Recibo', 'Habilitado', '', 'recibodes.php'),
(6, 'SOLICITUD DE AUTORIZACION DE PLANOS DE CONSTRUCCION', 'CON FUNDAMENTO EN LOS ARTICULOS: 7°, 22 FRACCION I, 30, 31, 32, 93, 94, 95, 96 Y 99 DE LA LEY DE SALUD DEL ESTADO DE COLIMA, TITULO SEGUNDO, CAPITULO I DEL REGLAMENTO DE LA LEY DE SALUD DEL ESTADO DE COLIMA, EN MATERIA DE SALUBRIDAD LOCAL; EL  SUSCRITO SOLICITA LE SEAN CONCEDIDOS 365 DIAS A PARTIR DE LA FECHA DEL OTORGAMIENTO DEL PERMISO PARA REALIZAR UNA CONSTRUCCION EN EL PREDIO DE SU PROPIEDAD EN:', 'Solicitud', 'Habilitado', 'formatos/Solicitud de Autorizacion de Planos de Construccion.doc', 'solicitud_planos.php'),
(8, 'SOLICITUD DE LIBROS BANCOS DE SANGRE Y SERVICIOS DE TRANSFUSION ', 'De conformidad al Artículo 61 del Decreto No. 252, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima y la Tarifa Para el Cobro De Productos, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima, el suscrito solicita Autorización de Libros de: ', 'Solicitud', 'Habilitado', 'formatos/Solicitud Libros B.S. y S.T.doc', 'solicitud_libros_banco.php'),
(9, 'SOLICITUD DE OPINIÓN TÉCNICA PARA EL ETIQUETADO DE PRODUCTOS', 'De conformidad al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”, el suscrito solicita Opinión técnica para el etiquetado de productos de:', 'Solicitud', 'Habilitado', 'formatos/Solicitud Opinión técnica para el etiquetado de productos.doc', 'solicitud_etiquetado.php'),
(10, 'SOLICITUD AUTORIZACIÓN DE LIBROS DE CONTROL DE ESTUPEFACIENTES Y PSICOTRÓPICOS', 'De conformidad al Artículo 61 del Decreto No. 252, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima y la Tarifa Para el Cobro de Productos, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima, el suscrito solicita Autorización de Libros de Control de: ', 'Solicitud', 'Habilitado', 'formatos/Solicitud Libros de Control Estupefacientes y Psicotropicos.doc', 'solicitud_libros_estupefa.php'),
(11, 'SOLICITUD PERMISO SANITARIO PARA EXHUMACIÓN O TRASLADO DE CADÁVERES', 'De conformidad al Artículo 61 del Decreto No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011 en el Periódico Oficial “El Estado de Colima”, solicito el:', 'Solicitud', 'Habilitado', 'formatos/Solicitud Traslado, cremacion o exhumacion.doc', 'solicitud_traslado_cadaveres.php'),
(12, 'ASESORÍA PARA LA ELABORACIÓN DE LA ETIQUETA DE PRODUCTOS DE USO  Y CONSUMO HUMANO', 'De conformidad al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”, el suscrito solicita la asesoría de la (s) etiqueta (s) de: ', 'Solicitud', 'Habilitado', 'formatos/Asesoría para la elaboración de la etiqueta de productos de uso  y consumo humano.doc', 'solicitud_etiquetado.php'),
(13, 'SOLICITUD AUTORIZACIÓN DE CLAVE PARA LA IMPARTICIÓN DEL CURSO DE MANEJO Y DISPENSACIÓN DE MEDICAMENTOS POR INSTRUCTOR AUTORIZADO', 'De conformidad al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima', 'Solicitud', 'Habilitado', 'formatos/Autorización de clave para la impartición del curso de manejo y dispensación de medicamentos por instructor autorizado.doc', 'solicitud_imparticion_clave.php'),
(14, ' SOLICITUD DE CURSOS DE CAPACITACIÓN ', 'De conformidad al Artículo 61 del Decreto No. 252 y No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima y el sábado 26 de noviembre del año 2011, respectivamente,  publicados en el Periódico Oficial “El Estado de Colima”, el  C', 'Solicitud', 'Habilitado', 'formatos/Solicitud  de cursos de capacitación.doc', 'solicitud_curso_capacitacion.php'),
(15, 'SOLICITUD CONSTANCIA DE DESTRUCCIÓN DE PRODUCTOS QUE PUEDAN SER NOCIVOS PARA LA SALUD PÚBLICA.', 'De conformidad al Artículo 61 del Decreto No. 252, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima y la Tarifa Para el Cobro de Productos, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima, el C.', 'Solicitud', 'Habilitado', 'formatos/Solicitud Constancia de destrucción de productos que puedan ser nocivos.doc', 'solicitud_constancia_destruccion.php'),
(17, 'SOLICITUD DE CONSTANCIA DE NO INCONVENIENTE DE AVISO SANITARIO DE IMPORTACIÓN Y/O CONSULTA EN MATERIA DE SANIDAD INTERNACIONAL', 'De conformidad al Artículo 61 del Decreto No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011 en el Periódico Oficial “El Estado de Colima”, el C', 'Solicitud', 'Habilitado', 'formatos/Solicitud de Constancia de no inconveniente de aviso sanitario de importación o Consulta en materia de sanidad internacional.doc', 'solicitud_constancia_incoveniente.php'),
(18, 'SOLICITUD POR REPOSICIÓN DE AVISO DE APERTURA O FUNCIONAMIENTO', 'De conformidad al Artículo 61 del Decreto No. 252, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima y la Tarifa para el Cobro de Productos, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima, el suscrito solicita Reposición de Aviso de Apertura o Funcionamiento de: ', 'Solicitud', 'Habilitado', 'formatos/Solicitud Reposición de Aviso de Apertura o Funcionamiento.doc', 'solicitud_reposicion_apertura.php'),
(19, 'SOLICITUD DE VISITA DE VERIFICACIÓN', 'De conformidad al Artículo 61 del Decreto No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, respectivamente,  publicados en el Periódico Oficial “El Estado de Colima”, solicito Visita de Verificación Sanitaria al establecimiento de:', 'Solicitud', 'Habilitado', 'formatos/Solicitud de visita de verificación con o sin toma de muestra.doc', 'solicitud_visita_verificacion.php'),
(20, 'Orden pago etiquetado de productos', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro Asesoria para etiqueta.doc', 'orden_asesoriaxetiqueta.php'),
(21, 'SOLICITUD CONSTANCIA DE MANEJO HIGIENICO DE ALIMENTOS ', 'De conformidad al Artículo 61 del Decreto No. 252 y No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima y el sábado 26 de noviembre del año 2011, respectivamente,  publicados en el Periódico Oficial “El Estado de Colima”, el C. ', 'Solicitud', 'Habilitado', 'formatos/Solicitud Constancia de manejo higienico de alimentos.doc', 'solicitud_constancia_manejo.php'),
(22, 'SOLICITUD OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS', 'De conformidad al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”, el suscrito solicita Opinión técnica para el funcionamiento de su establecimiento de: ', 'Solicitud', 'Habilitado', 'formatos/Solicitud Opinion tecnica para el funcionamiento de establecimientos.doc', 'solicitud_establecimientos.php'),
(23, 'ORDEN DE PAGO CAPACITACION MDMF', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro capacitacion en MDMF por persona.doc', 'orden_capacitacionmdmf.php'),
(24, 'ORDEN DE PAGO CLAVE CURSO MDMF', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro clave curso MDMF.doc', 'orden_clavecursomdf.php'),
(25, 'ORDEN DE PAGO COSTANCIA BUENAS PRACTICAS O MANEJO HIGIENICO DE ALIMENTOS', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro constancia buenas practicas y o manejo hijienoco de alimentos.doc', 'orden_bnaspractymnejohig.php'),
(26, 'ORDEN DE PAGO CONSTANCIA DE DESTRUCION DE PRODUCTOS NOCIVOS PARA LA SALUD', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro constancia de destruccion de productos nocivos para la salud.doc', 'orden_destruccionxproductosnocivos.php'),
(27, 'ORDEN DE PAGO VISITA DE VERIFICACION SIN TOMA DE MUESTRA O CON TOMA DE MUESTRA', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro de visita de verificacion sin toma de muestra o con toma de muestra.doc', 'orden_verificacionmuestra.php'),
(28, 'ORDEN DE PAGO EXPEDICION DE COSTANCIA MDMF POR PERSONA ', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro expedicion de constancia MDMF por persona.doc', 'orden_constanciamdfmxpersona.php'),
(29, 'ORDEN DE PAGO POR SOLICITUD DE AUTORIZACIÓN DE LIBROS DE BANCO DE SANGRE', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por autorizacion de libros banco de sangre ......doc', 'orden_bancosangre.php'),
(30, 'ORDEN DE PAGO LIBRO DE CONTROL DE ESTUPEFACIENTES Y PSICOTROPICOS', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por autorizacion de libros de control de estupefacientes y psicotropicos.doc', 'orden_psicotropicos.php'),
(31, 'ORDEN DE PAGO POR CONSTANCIA DE NO INCONVENIENTE DE AVISO SANITARIO DE IMPORTACION ', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por constancia de no inconveniente de aviso sanitario de importacion.doc', 'orden_avisosanitarioximportacion.php'),
(32, 'ORDEN DE PAGO POR CONSULTA EN MATERIA DE SANIDAD INTERNACIONAL', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por consulta en materia de sanidad internacional.doc', 'orden_consultaxmateria.php'),
(33, 'ORDEN DE PAGO POR EMISION CODIGOS DE BARRAS', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por emision codigos de barras.doc', 'orden_barras.php'),
(34, 'ORDEN DE PAGO POR REPOSICION DE AVISO DE APERTURA O ESTABLECIMIENTO ', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por reposicion de aviso de apertura o establecimiento.doc', 'orden_reposicion.php'),
(35, 'ORDEN DE PAGO POR REPOSOCION DE LICENCIA SANITARIA', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por reposicion de licencia sanitaria.doc', 'orden_licenciasanitaria.php'),
(36, 'ORDEN DE PAGO POR SOLICITUD DE CURSO DE CAPACITACION DEL INTERESADO ', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro por solicitud de curso de capacitacion del interesado.doc', 'orden_curso_del_interesado.php'),
(37, 'ORDEN DE PAGO OPINION TECNICA PARA EL FUNCIONAMIENTO RECIBO FISCAL ', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro Opinion tecnica para el funcionamientos RECIBO FISCAL.docx', 'orden_opinion.php'),
(38, 'ORDEN DE PAGO OPINION TECNICA PARA EL FUNCIONAMIENTO', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro Opinion tecnica para el funcionamientos.docx', 'orden_opinion.php'),
(39, 'ORDEN DE PAGO PARA LA CREMACION, TRASLADO O EXHUMACION ', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente a la ', 'Orden', 'Habilitado', 'formatos/Cobro para Cremacion, Traslado o Exhumacion.docx', 'orden_cadaver.php'),
(40, 'AUTORIZACION LIBROS DE CONTROL DE ESTUPEFACIENTES Y PSICOTROPICOS', '', 'Autorización', 'Habilitado', 'formatos/Libros de Control de Estupefacientes y Psicotropicos.doc', 'autorizacion_estupefacientes_psicotropicos.php'),
(41, 'AUTORIZACION DE LICENCIAS DE FARMACIAS', '', 'Autorización', 'Habilitado', 'formatos/Licencias Farmacia.doc', 'aut_licencias_farmacia.php'),
(42, 'AUTORIZACION DE REPOSICION DE AVISO DE FUNCIONAMIENTO', '<p style=''text-align:justify;''>EL PROPIETARIO BAJO PROTESTA DE DECIR VERDAD DECLARA QUE LA INFORMACION PROPORCIONADA ES CIERTA Y ASUME LA RESPONSABILIDAD DE LAS CONDICIONES SANITARIAS EN QUE OPERE SU ESTABLECIMIENTO.</p><p style=''text-align:justify;''>LA SECRETARIA DE SALUD SE RESERVA LA FACULTAD DE VERIFICAR EN CUALQUIER MOMENTO, EL CUMPLIMIENTO DE LA LEGISLACION EN MATERIA DE SERVICIOS DE SALUD.</p><p style=''text-align:justify;''>ESTA SECRETARIA NO PREJUZGA SOBRE EL USO LEGAL DEL NOMBRE COMERCIAL CON QUE SE IDENTIFICA AL ESTABLECIMIENTO.</p><p style=''text-align:justify;''>ESTE AVISO DEBERA PERMANECER EN BUEN ESTADO Y PROTEGIDO DEL MEDIO AMBIENTE.</p><p style=''text-align:justify;''>EN CASO DE SOLICITAR UN DUPLICADO DEL PRESENTE DOCUMENTO, DEBERA CUBRIR EL PAGO ESTIPULADO EN LA LEY FEDERAL DE DERECHOS VIGENTE.</p><p style=''text-align:justify;''>DEBERA DAR AVISO A ESTA COMISION DE CUALQUIER MODIFICACION A LA INFORMACION NOTIFICADA, DENTRO DE LOS TREINTA DIAS HABILES POSTERIORES A QUE ESTO OCURRA, DE ACUERDO CON EL ART. 208 DE LA LEY GENERAL DE SALUD.</p>', 'Autorización', 'Habilitado', 'formatos/Reposicion de Aviso de Funcionamiento.doc', 'autorizacion_avisoreposicion.php'),
(43, 'AUTORIZACION DE TRASLADO DE CADAVERES Y EXHUMACIONES', '', 'Autorización', 'Habilitado', 'formatos/Traslado de Cadaveres y Exhumaciones.docx', 'autorizacion_traslado_cadaveres.php'),
(44, 'ORDEN PAGO DICTAMEN TECNICO DE LA INFRAESTRUCTURA FISICA, FUNCIONAL Y OPERATIVA, DE ESTABLECIMIENTOS DE SERVICIOS DE SALUD', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente al ', 'Orden', 'Habilitado', 'formatos/cobro por Dictamen técnico de la infraestructura física, funcional y operativa, de establecimientos de servicios de salud.doc', 'orden_dictamen.php'),
(45, 'SOLICITUD DE DICTAMEN TECNICO DE INFRAESTRUCTURA', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente al ', 'Solicitud', 'Habilitado', 'formatos/Solicitud de Dictamen Tecnico de infrestructura.doc', 'solicitud_dictamen.php'),
(46, 'SOLICITUD PARA LA EMISION DE CODIGOS DE BARRAS', 'Con fundamento en el al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado; referente <u>a la <b>solicitud para emisión de código de barras para prescribir estupefacientes</b></u>', 'Solicitud', 'Habilitado', 'formatos/Solicitud para la emision de Codigos de barras.doc', 'solicitud_emision_codigo.php'),
(47, 'SOLICITUD DE REPOSICION DE LICENCIA SANITARIA', 'Con fundamento en el al Artículo 61 del Decreto No. 252, por el que se Reforman, Adicionan y Derogan, diversos artículos del código fiscal de la Ley de Hacienda del Estado de Colima, publicado el sábado 25 de diciembre del año 2010, en el Periódico Oficial “El Estado de Colima”; y el Decreto que Reforma el artículo 25, fracción XX y se Adiciona la fracción XXI y XXII, del Reglamento Interior de los Servicios de Salud del Estado, el suscrito solicita Reposición de Licencia Sanitaria de: ', 'Solicitud', 'Habilitado', 'formatos/Solicitud de Reposicion de Licencia Sanitaria.doc', 'solicitud_licencia.php'),
(48, 'AUTORIZACION DE LICENCIAS DE FARMACIAS', '', 'Autorización', 'Habilitado', 'formatos/PORTADA_DIPROV[1].doc', 'autorizacion_fumigacion_desinfeccion.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id_grupo` bigint(20) NOT NULL,
  `det_fecha_inicio` date NOT NULL,
  `det_fecha_fin` date NOT NULL,
  `det_sede` char(20) CHARACTER SET latin1 NOT NULL,
  `id_curso` smallint(6) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `det_estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `det_fecha_inicio`, `det_fecha_fin`, `det_sede`, `id_curso`, `id_empleado`, `det_estatus`) VALUES
(1, '2015-09-29', '2015-10-10', 'Tec de Colima', 1, 4, 1),
(2, '2015-09-29', '2015-10-05', 'UDC', 2, 4, 1),
(3, '2015-10-01', '2015-10-11', 'Sala de Videoconfere', 3, 4, 1),
(4, '2015-10-05', '2015-10-18', 'Salon de la Paz', 4, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lema`
--

DROP TABLE IF EXISTS `lema`;
CREATE TABLE IF NOT EXISTS `lema` (
  `id_lema` int(11) NOT NULL,
  `anio_lema` date NOT NULL,
  `lema_texto` text CHARACTER SET utf8 NOT NULL,
  `lema_estatus` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lema`
--

INSERT INTO `lema` (`id_lema`, `anio_lema`, `lema_texto`, `lema_estatus`) VALUES
(1, '2015-08-20', '"2015, A&ntilde;o del General&iacute;simo Jos&eacute; Maria Morelos y Pav&oacute;n".', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
  `id_localidad` int(11) NOT NULL,
  `lc_nombre` char(30) CHARACTER SET latin1 NOT NULL,
  `id_municipio` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id_localidad`, `lc_nombre`, `id_municipio`) VALUES
(1, 'Rancho de Villa', 2),
(2, 'Cofradia de Juarez', 1),
(3, 'Manzanillo', 7),
(4, 'Colima', 2),
(5, 'Tepames', 2),
(6, 'Venustiano Carranza', 7),
(7, 'Suchitlan', 2),
(8, 'Queseria', 5),
(9, 'Tecoman', 9),
(10, 'Villa de Alvarez', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id_municipio` smallint(6) NOT NULL,
  `mp_nombre` char(20) CHARACTER SET latin1 NOT NULL,
  `id_estado` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `mp_nombre`, `id_estado`) VALUES
(1, 'Armeria', 6),
(2, 'Colima', 6),
(3, 'Comala', 6),
(4, 'Coquimatlan', 6),
(5, 'Cuauhtemoc', 6),
(6, 'Ixtlahuacan', 6),
(7, 'Manzanillo', 6),
(8, 'Minatitlan', 6),
(9, 'Tecoman', 6),
(10, 'Villa de Alvarez', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

DROP TABLE IF EXISTS `oficina`;
CREATE TABLE IF NOT EXISTS `oficina` (
  `id_oficina` int(11) NOT NULL,
  `of_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `of_calle` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `of_numero` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `id_colonia` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `of_nomenclatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `of_dir_relativa` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`id_oficina`, `of_nombre`, `of_calle`, `of_numero`, `id_colonia`, `id_cuenta`, `of_nomenclatura`, `of_dir_relativa`) VALUES
(1, 'CENTRO MUNICIPAL DE NEGOCIOS DEL MUNICIPIO DE MANZANILLO, CO', 'OCTAVIO PAZ', 'S/N', 7, 1, 'CMM', 'FRACC. NUEVO SALAHUA, MANZANILLO, COL.'),
(2, 'CENTRO MUNICIPAL DE NEGOCIOS DEL MUNICIPIO DE COLIMA, COL.', 'VENUSTANIO CARRANZA', 'NO.90', 2, 1, 'CMC', 'ESQUINA MANUEL ALVAREZ, COLIMA, COL.'),
(3, 'CENTRO MUNICIPAL DE NEGOCIOS DEL MUNICIPIO DE TECOMAN, COL.', 'HIDALGO', 'S/N', 3, 1, 'CMT', 'PRESIDENCIA MUNICIPAL'),
(4, 'GERENCIA DE TRAMITES Y AUTORIZACIONES', 'AVENIDA AYUNTAMIENTO', 'S/N', 4, 1, 'GTA', 'ESQ. ARNOLDO VOGEL, COL. BUROCRATAS MUNICIPALES,COLIMA,COL.'),
(5, 'COORDINACIÓN DE OFICINA DE LA JURISDICCIÓN SANITARIA NO. 1', 'AV. 20 DE NOVIEMBRE', 'S/N', 5, 1, 'CS1', 'ESQ. JUAREZ, COL. CENTRO,COLIMA, COL.'),
(6, 'COORDINACIÓN DE OFICINA DE LA JURISDICCIÓN SANITARIA NO. 2', 'MORELOS', 'NO.411', 6, 1, 'CS2', 'COL. CENTRO,TECOMAN, COL.'),
(7, 'COORDINACIÓN DE OFICINA DE LA JURISDICCIÓN SANITARIA NO. 3', 'ELIAS ZAMORA VERDUZCO', 'S/N', 7, 1, 'CS3', 'COL. SALAHUA,MANZANILLO, COL.'),
(8, 'CENTRO MUNICIPAL DE NEGOCIOS DEL MUNICIPIO DE VILLA DE ALVAREZ, COL.', 'J. MERCED CABRERA', 'NO.55', 8, 1, 'CMV', 'PRESIDENCIA MUNICIPAL, VILLA DE ALVAREZ, COL.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pago`
--

DROP TABLE IF EXISTS `orden_pago`;
CREATE TABLE IF NOT EXISTS `orden_pago` (
  `id_folio_orden` bigint(20) NOT NULL,
  `op_fecha` datetime NOT NULL,
  `op_importe` float NOT NULL,
  `op_total` float NOT NULL,
  `id_solicitud` bigint(20) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `id_formato` smallint(6) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orden_pago`
--

INSERT INTO `orden_pago` (`id_folio_orden`, `op_fecha`, `op_importe`, `op_total`, `id_solicitud`, `id_cuenta`, `id_formato`, `id_empleado`) VALUES
(1, '2015-10-01 23:13:06', 132.9, 132.9, 1, 1, 39, 2),
(2, '2015-10-01 23:41:34', 664.5, 664.5, 2, 1, 39, 2),
(3, '2015-10-02 00:18:43', 265.8, 265.8, 3, 1, 39, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

DROP TABLE IF EXISTS `permiso`;
CREATE TABLE IF NOT EXISTS `permiso` (
  `id_permiso` smallint(6) NOT NULL,
  `per_nombre` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `per_archivo` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `per_nombre`, `per_archivo`) VALUES
(1, 'consultar', 'registrar, consultar, actualizar'),
(2, 'registrar', 'actualizar, consultar'),
(3, 'actualizar', 'archivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

DROP TABLE IF EXISTS `permiso_rol`;
CREATE TABLE IF NOT EXISTS `permiso_rol` (
  `id_permiso` smallint(6) NOT NULL,
  `id_rol` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permiso_rol`
--

INSERT INTO `permiso_rol` (`id_permiso`, `id_rol`) VALUES
(1, 2),
(1, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

DROP TABLE IF EXISTS `permiso_usuario`;
CREATE TABLE IF NOT EXISTS `permiso_usuario` (
  `id_permiso` smallint(6) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permiso_usuario`
--

INSERT INTO `permiso_usuario` (`id_permiso`, `id_usuario`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE IF NOT EXISTS `puesto` (
  `id_puesto` smallint(6) NOT NULL,
  `pu_nombre` char(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id_puesto`, `pu_nombre`) VALUES
(2, 'INSTRUCTOR AUTORIZADO'),
(3, 'ADMINISTRACION'),
(4, 'VENTANILLA'),
(5, 'CONTADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_pago`
--

DROP TABLE IF EXISTS `recibo_pago`;
CREATE TABLE IF NOT EXISTS `recibo_pago` (
  `id_folio` bigint(20) NOT NULL,
  `rp_fecha_emision` datetime NOT NULL,
  `rp_fecha_voucher` date NOT NULL,
  `rp_referencia` char(10) CHARACTER SET latin1 NOT NULL,
  `rp_importe_voucher` float NOT NULL,
  `id_orden_pago` bigint(20) NOT NULL,
  `id_formato` smallint(6) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_autorizo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recibo_pago`
--

INSERT INTO `recibo_pago` (`id_folio`, `rp_fecha_emision`, `rp_fecha_voucher`, `rp_referencia`, `rp_importe_voucher`, `id_orden_pago`, `id_formato`, `id_empleado`, `id_autorizo`) VALUES
(1, '2015-10-01 23:13:53', '2015-10-01', '1234567890', 132.9, 1, 5, 2, 0),
(2, '2015-10-01 23:42:47', '2015-10-01', '1234567890', 664.5, 2, 5, 2, 0),
(3, '2015-10-02 00:19:14', '2015-10-02', '1234567890', 265.8, 3, 5, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisito`
--

DROP TABLE IF EXISTS `requisito`;
CREATE TABLE IF NOT EXISTS `requisito` (
  `id_requisito` smallint(6) NOT NULL,
  `rq_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `requisito`
--

INSERT INTO `requisito` (`id_requisito`, `rq_nombre`) VALUES
(1, 'COPIA DE PLANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisito_servicio`
--

DROP TABLE IF EXISTS `requisito_servicio`;
CREATE TABLE IF NOT EXISTS `requisito_servicio` (
  `id_requisito` smallint(6) NOT NULL,
  `id_servicio` smallint(6) NOT NULL,
  `rsv_cantidad` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `requisito_servicio`
--

INSERT INTO `requisito_servicio` (`id_requisito`, `id_servicio`, `rsv_cantidad`) VALUES
(1, 7, 2),
(1, 8, 2),
(1, 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisito_solicitud`
--

DROP TABLE IF EXISTS `requisito_solicitud`;
CREATE TABLE IF NOT EXISTS `requisito_solicitud` (
  `id_requisito` smallint(6) NOT NULL,
  `id_solicitud` bigint(20) NOT NULL,
  `rso_cantidad` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `requisito_solicitud`
--

INSERT INTO `requisito_solicitud` (`id_requisito`, `id_solicitud`, `rso_cantidad`) VALUES
(1, 7, 2),
(1, 8, 2),
(1, 15, 2),
(1, 73, 2),
(1, 74, 2),
(1, 81, 2),
(4, 1, 6),
(4, 2, 7),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` smallint(6) NOT NULL,
  `rol_nombre` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'VENTANILLA'),
(3, 'CONTADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario_minimo`
--

DROP TABLE IF EXISTS `salario_minimo`;
CREATE TABLE IF NOT EXISTS `salario_minimo` (
  `id_salario_minimo` smallint(6) NOT NULL,
  `sm_importe` float NOT NULL,
  `sm_anio_vigencia` date NOT NULL,
  `vigente` bit(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `salario_minimo`
--

INSERT INTO `salario_minimo` (`id_salario_minimo`, `sm_importe`, `sm_anio_vigencia`, `vigente`) VALUES
(1, 59.08, '2012-11-27', b'0'),
(2, 61.38, '2013-01-01', b'0'),
(3, 63.77, '2014-01-01', b'0'),
(4, 66.45, '2015-01-01', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` smallint(6) NOT NULL,
  `sr_nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `sr_cant_sal_min` float NOT NULL DEFAULT '1',
  `id_salario_minimo` smallint(6) NOT NULL,
  `id_folio_orden` smallint(6) DEFAULT NULL,
  `id_formato_recibo` smallint(6) DEFAULT NULL,
  `id_formato_autoriza` smallint(6) DEFAULT NULL,
  `id_formato_solicitud` smallint(6) DEFAULT NULL,
  `sr_tipo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sr_imagen` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `sr_nombre`, `sr_cant_sal_min`, `id_salario_minimo`, `id_folio_orden`, `id_formato_recibo`, `id_formato_autoriza`, `id_formato_solicitud`, `sr_tipo`, `sr_imagen`) VALUES
(1, 'OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS CON VENTA DE ALIMENTOS', 4, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-cutlery'),
(2, 'OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS CON VENTA DE ALIMENTOS Y BEBIDAS ALCOHOLICAS', 8, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-glass '),
(3, 'OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS CON VENTA DE BEBIDAS ALCOHOLICAS', 12, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-beer '),
(4, 'OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS DE SERVICIOS DE SALUD', 6, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-plus '),
(5, 'OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS DE INSUMOS PARA LA SALUD', 4, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-medkit'),
(6, 'OPINION TECNICA PARA EL FUNCIONAMIENTO DE ESTABLECIMIENTOS DE SALUD AMBIENTAL', 8, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-leaf'),
(7, 'REVISI&Oacute;N Y AUTORIZACI&Oacute;N DE PLANOS DE CONSTRUCCI&Oacute;N DE CASA HABITACI&Oacute;N, EDIFICIOS PARA VIVIENDAS Y ESCUELAS, POR METRO CUADRADO', 0.03, 4, 2, 5, 1, 6, 'autorizacion', 'fa fa-home'),
(8, 'REVISI&Oacute;N Y AUTORIZACI&Oacute;N DE PLANOS DE CONSTRUCCI&Oacute;N DE ESTABLECIMIENTOS COMERCIALES, INDISTRIALES, DE SERVICIO Y SIMILARES, POR METRO CUADRADO', 0.2, 4, 2, 5, 1, 6, 'autorizacion', 'fa fa-building-o'),
(9, 'REVISI&Oacute;N Y AUTORIZACI&Oacute;N DE PLANOS DE CONSTRUCCI&Oacute;N DE FRACCIONAMIENTOS, POR METRO CUADRADO', 0.1, 4, 2, 5, 1, 6, 'autorizacion', 'fa fa-arrows'),
(10, 'AUTORIZACION PARA TRASLADO DE CADAVERES DE UN MUNICIPIO A OTRO MUNICIPIO DEL ESTADO', 2, 4, 39, 5, 43, 11, 'autorizacion', 'fa fa-map-marker'),
(11, 'AUTORIZACION PARA TRASLADO DE CADAVERES A OTRA ENTIDAD FEDERATIVA', 4, 4, 39, 5, 43, 11, 'autorizacion', 'fa fa-plane'),
(12, 'AUTORIZACION DE CREMACION DE CADAVERES, DE SERES HUMANOS, SUS PARTES Y RESTOS ARIDOS', 4, 4, 39, 5, 43, 11, 'autorizacion', 'fa fa-fire'),
(13, 'AUTORIZACION PARA EXHUMACION DE CADAVERES Y RESTOS ARIDOS PARA SER REINHUMADOS EN EL MISMO PANTEON', 4, 4, 39, 5, 43, 11, 'autorizacion', 'fa fa-male'),
(14, 'AUTORIZACION PARA EXHUMACION DE CADAVERES Y RESTOS ARIDOS PARA SER REINHUMADOS EN OTROS MUNICIPIOS DEL ESTADO', 7, 4, 39, 5, 43, 11, 'autorizacion', 'fa fa-truck'),
(15, 'SOLICITUD DE VISITA DE VERIFICACION CON TOMA DE MUESTRA', 13, 4, 27, 5, NULL, 19, 'visita', 'fa fa-eye'),
(16, 'SOLICITUD DE VISITA DE VERIFICACION SIN TOMA DE MUESTRA', 10, 4, 27, 5, NULL, 19, 'visita', 'fa fa-eye-slash'),
(17, 'AUTORIZACION DE LIBROS DE ESTUPEFACIENTES Y PSICOTROPICOS POR CADA LIBRO', 6, 4, 30, 5, 40, 10, 'autorizacion', 'fa fa-book'),
(18, 'ASESORIA PARA LA ELABORACION DE LA ETIQUETA DE PRODUCTOS DE USO Y CONSUMO HUMANO', 4, 4, 20, 5, NULL, 22, 'asesoria', 'fa fa-comments'),
(19, 'REPOSICION DE AVISO DE APERTURA O ESTABLECIMIENTO', 2, 4, 34, 5, 42, 18, 'autorizacion', 'fa fa-envelope'),
(20, 'CONSTANCIA DEL CURSO DE CAPACITACION DE BUENAS PRACTICAS DE HIGIENE Y/O MANEJO HIGIENICO DE ALIMENTOS', 2, 4, 25, 5, NULL, 21, 'curso', 'fa fa-folder'),
(21, 'SOLICITUD PARA EMISION DE CODIGO DE BARRAS PARA PRESCRIBIR ESTUPEFACIENTES', 15, 4, 33, 5, NULL, 46, 'autorizacion', 'fa fa-file'),
(22, 'AUTORIZACION DE LIBROS DE BANCO DE SANGRE Y TRANSFUCION SANGUINEA', 10, 4, 29, 5, 3, 8, 'autorizacion', 'fa fa-tint'),
(23, 'AUTORIZACION PARA TRASLADO DE CADAVERES A OTRO PAIS ', 10, 4, 39, 5, 43, 11, 'autorizacion', 'fa fa-plane'),
(24, 'REPOSICION DE LICENCIA SANITARIAS (INSUMOS PARA LA SALUD)', 6, 4, 35, 5, 41, 47, 'autorizacion', 'fa fa-folder-open'),
(25, 'CAPACITACION DE MANEJO Y DISPENSACION DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS,DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL, POR PERSONA', 16, 4, 23, 5, NULL, 14, 'curso', 'fa fa-comments'),
(26, 'EXPEDICION DE CONSTANCIA POR PERSONA DEL CURSO DE MANEJO Y DISPENSACION DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS, DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL, IMPARTIDA POR INSTRUCTOR AUTORIZADO QUE CUENTE CON CLAVE ALFANUMERICA', 8, 4, 28, 5, NULL, 14, 'curso', 'fa fa-file-text'),
(27, 'OPINION TECNICA PARA  EL FUNCIONAMIENTO DE ESTABLECIMIENTOS EN MATERIA DE PUBLICIDAD ', 5, 4, 37, 5, NULL, 22, 'opinion', 'fa fa-info-circle'),
(28, 'AUTORIZACION DE CLAVE PARA LA IMPARTICION DEL CURSO DE MANEJO Y DISPENSACION DE MEDICAMENTOS POR INSTRUCTOR AUTORIZADO ', 25, 4, 24, 5, 3, 13, 'autorizacion', 'fa fa-medkit'),
(29, 'CONSTANCIA DE NO INCONVENIENTE DE AVISO SANITARIO DE IMPORTACION', 4, 4, 31, 5, NULL, 17, 'constancia', 'fa fa-folder'),
(30, 'CONSULTA EN MATERIA DE SANIDAD INTERNACIONAL', 4, 4, 32, 5, NULL, 17, 'autorizacion', 'fa fa-globe'),
(31, 'CONSTANCIA DE DESTRUCCION DE PRODUCTOS QUE PUEDEN SER NOCIVOS PARA LA SALUD PUBLICA', 10, 4, 26, 5, NULL, 15, 'autorizacion', 'fa fa-ban'),
(32, 'SOLICITUD DE CURSOS DE CAPACITACION DEL INTERESADO POR PERSONA', 30, 4, 36, 5, NULL, 14, 'autorizacion', 'fa fa-user'),
(33, 'DICTAMEN TECNICO DE LA INFRAESTRUCTURA FISICA, FUNCIONAL Y OPERATIVA, DE ESTABLECIMIENTOS DE SERVICIOS DE SALUD', 45, 4, 44, 5, NULL, 45, 'autorizacion', 'fa fa-hospital-o'),
(34, 'SOLICITUD DE CURSO DE CAPACITACION DEL INTERESADO POR PERSONA', 30, 4, 23, 5, NULL, 14, 'curso', 'fa fa-comments'),
(35, 'REPOSICION DE LICENCIA SANITARIAS (SALUD AMBIENTAL)', 6, 4, 35, 5, 48, 47, 'autorizacion', 'fa fa-folder-open');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_curso`
--

DROP TABLE IF EXISTS `servicio_curso`;
CREATE TABLE IF NOT EXISTS `servicio_curso` (
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `id_servicio` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_curso`
--

INSERT INTO `servicio_curso` (`id_curso`, `id_servicio`) VALUES
(1, 20),
(2, 26),
(3, 25),
(4, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
CREATE TABLE IF NOT EXISTS `solicitud` (
  `id_solicitud` bigint(20) NOT NULL,
  `s_fecha` datetime NOT NULL,
  `s_cantidad` smallint(6) NOT NULL DEFAULT '1',
  `id_cliente` int(11) NOT NULL,
  `id_oficina` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_servicio` smallint(6) NOT NULL,
  `s_estatus` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `s_fecha`, `s_cantidad`, `id_cliente`, `id_oficina`, `id_empleado`, `id_servicio`, `s_estatus`) VALUES
(1, '2015-10-01 23:01:05', 1, 1, 6, 2, 10, 'PAGADO'),
(2, '2015-10-01 23:41:30', 1, 1, 6, 2, 23, 'PAGADO'),
(3, '2015-10-02 00:18:41', 1, 1, 6, 2, 12, 'PAGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_grupo`
--

DROP TABLE IF EXISTS `solicitud_grupo`;
CREATE TABLE IF NOT EXISTS `solicitud_grupo` (
  `id_solicitud` bigint(20) NOT NULL,
  `id_grupo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contrasenia` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `habilitado` bit(1) NOT NULL DEFAULT b'1',
  `id_empleado` int(11) NOT NULL,
  `id_rol` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `contrasenia`, `habilitado`, `id_empleado`, `id_rol`) VALUES
(1, 'Carlos', 'cont45', b'1', 1, 3),
(2, 'Juan', 'soloyo68', b'1', 3, 2),
(3, 'Karla', 'inforifa', b'1', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id_grupo`,`id_cliente`);

--
-- Indices de la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  ADD PRIMARY KEY (`id_autorizacion`),
  ADD KEY `id_formato` (`id_formato`),
  ADD KEY `id_folio` (`id_folio`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_colonia` (`id_colonia`);

--
-- Indices de la tabla `codigo_postal`
--
ALTER TABLE `codigo_postal`
  ADD PRIMARY KEY (`id_cod_pos`);

--
-- Indices de la tabla `colonia`
--
ALTER TABLE `colonia`
  ADD PRIMARY KEY (`id_colonia`),
  ADD KEY `id_localidad` (`id_localidad`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD UNIQUE KEY `cn_clabe` (`cn_clabe`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `datos_fiscales`
--
ALTER TABLE `datos_fiscales`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_colonia` (`id_colonia`);

--
-- Indices de la tabla `datos_secundarios_autorizacion`
--
ALTER TABLE `datos_secundarios_autorizacion`
  ADD PRIMARY KEY (`id_dat_sec_autorizacion`);

--
-- Indices de la tabla `datos_secundarios_solicitud`
--
ALTER TABLE `datos_secundarios_solicitud`
  ADD PRIMARY KEY (`id_dat_sec_sol`);

--
-- Indices de la tabla `dsa_autorizacion`
--
ALTER TABLE `dsa_autorizacion`
  ADD PRIMARY KEY (`id_dat_sec_aut`,`id_autorizacion`),
  ADD KEY `FK_dss_autorizacion_Autorizacion` (`id_autorizacion`);

--
-- Indices de la tabla `dsa_servicio`
--
ALTER TABLE `dsa_servicio`
  ADD PRIMARY KEY (`id_servicio`,`id_dat_sec_aut`);

--
-- Indices de la tabla `dss_servicio`
--
ALTER TABLE `dss_servicio`
  ADD PRIMARY KEY (`id_dat_sec_sol`,`id_servicio`);

--
-- Indices de la tabla `dss_solicitud`
--
ALTER TABLE `dss_solicitud`
  ADD PRIMARY KEY (`id_dat_sec_sol`,`id_solicitud`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `formato`
--
ALTER TABLE `formato`
  ADD PRIMARY KEY (`id_formato`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `lema`
--
ALTER TABLE `lema`
  ADD PRIMARY KEY (`id_lema`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`id_oficina`),
  ADD KEY `id_colonia` (`id_colonia`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `orden_pago`
--
ALTER TABLE `orden_pago`
  ADD PRIMARY KEY (`id_folio_orden`),
  ADD KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_cuenta` (`id_cuenta`),
  ADD KEY `id_formato` (`id_formato`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD UNIQUE KEY `UQ_permisos_per_archivo` (`per_archivo`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD PRIMARY KEY (`id_permiso`,`id_rol`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD PRIMARY KEY (`id_permiso`,`id_usuario`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `recibo_pago`
--
ALTER TABLE `recibo_pago`
  ADD PRIMARY KEY (`id_folio`),
  ADD KEY `id_orden_pago` (`id_orden_pago`),
  ADD KEY `id_formato` (`id_formato`);

--
-- Indices de la tabla `requisito`
--
ALTER TABLE `requisito`
  ADD PRIMARY KEY (`id_requisito`),
  ADD UNIQUE KEY `UQ_Requisitos_id_requisito` (`id_requisito`);

--
-- Indices de la tabla `requisito_servicio`
--
ALTER TABLE `requisito_servicio`
  ADD PRIMARY KEY (`id_requisito`,`id_servicio`);

--
-- Indices de la tabla `requisito_solicitud`
--
ALTER TABLE `requisito_solicitud`
  ADD PRIMARY KEY (`id_requisito`,`id_solicitud`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salario_minimo`
--
ALTER TABLE `salario_minimo`
  ADD PRIMARY KEY (`id_salario_minimo`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_salario_minimo` (`id_salario_minimo`),
  ADD KEY `id_formato_orden` (`id_folio_orden`),
  ADD KEY `id_formato_recibo` (`id_formato_recibo`),
  ADD KEY `id_formato_autoriza` (`id_formato_autoriza`);

--
-- Indices de la tabla `servicio_curso`
--
ALTER TABLE `servicio_curso`
  ADD PRIMARY KEY (`id_curso`,`id_servicio`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_oficina` (`id_oficina`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `solicitud_grupo`
--
ALTER TABLE `solicitud_grupo`
  ADD PRIMARY KEY (`id_solicitud`,`id_grupo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `UQ_usuario_usuario` (`usuario`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  MODIFY `id_autorizacion` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `codigo_postal`
--
ALTER TABLE `codigo_postal`
  MODIFY `id_cod_pos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `colonia`
--
ALTER TABLE `colonia`
  MODIFY `id_colonia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `datos_secundarios_autorizacion`
--
ALTER TABLE `datos_secundarios_autorizacion`
  MODIFY `id_dat_sec_autorizacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `datos_secundarios_solicitud`
--
ALTER TABLE `datos_secundarios_solicitud`
  MODIFY `id_dat_sec_sol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `formato`
--
ALTER TABLE `formato`
  MODIFY `id_formato` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `lema`
--
ALTER TABLE `lema`
  MODIFY `id_lema` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `orden_pago`
--
ALTER TABLE `orden_pago`
  MODIFY `id_folio_orden` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id_puesto` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `recibo_pago`
--
ALTER TABLE `recibo_pago`
  MODIFY `id_folio` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `requisito`
--
ALTER TABLE `requisito`
  MODIFY `id_requisito` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `salario_minimo`
--
ALTER TABLE `salario_minimo`
  MODIFY `id_salario_minimo` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
