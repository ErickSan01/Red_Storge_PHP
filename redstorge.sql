
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `contestacion` (
  `ID_CONTESTACION` int(8) NOT NULL,
  `ID_ESTUDIANTE` int(8) NOT NULL,
  `ID_PREGUNTA` int(8) NOT NULL,
  `ID_NUMERO_DE_INTENTO` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `encargado_plantel` (
  `ID_ENCARGADO` int(1) NOT NULL,
  `ID_USUARIO` int(1) NOT NULL,
  `ID_PLANTEL` int(1) NOT NULL,
  `NUMERO_TELEFONO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `estudiante` (
  `ID_ESTUDIANTE` int(8) NOT NULL,
  `ID_USUARIO` int(8) NOT NULL,
  `GENERO` char(1) NOT NULL,
  `EDAD` int(3) NOT NULL,
  `CONTEXTO` varchar(200) NOT NULL,
  `TIPO_FAMILIA` varchar(50) NOT NULL,
  `ID_GRUPO` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `ID_GRUPO` int(8) NOT NULL,
  `GRADO` int(2) NOT NULL,
  `LETRA` char(1) NOT NULL,
  `ID_PLANTEL` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantel`
--

CREATE TABLE `plantel` (
  `id_plantel` int(1) NOT NULL,
  `nombre_plantel` varchar(100) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `numero_telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `ID_PREGUNTA` int(8) NOT NULL,
  `PLANTEAMIENTO` varchar(200) NOT NULL,
  `MODULO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `opcion` (
  `ID_OPCION` int(8) NOT NULL,
  `ID_PREGUNTA` int(8) NOT NULL,
  `INCISO` varchar(1) NOT NULL,
  `DESCRIPCION` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE_USUARIO` varchar(50) NOT NULL,
  `NOMBRE_COMPLETO` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `TIPO_USUARIO` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `modulo` (
  `ID_MODULO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `fase` (
  `ID_FASE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cursar_modulo` (
  `ID_MODULO` int(11) NOT NULL AUTO_INCREMENT,
  'ID_ESTUDIANTE' int(8) NOT NULL,
  `ID_FASE` int(11) NOT NULL,
  `TIEMPO` float(6,3) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






--
-- Volcado de datos para la tabla `usuario`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contestacion`
--
ALTER TABLE `contestacion`
  ADD PRIMARY KEY (`ID_CONTESTACION`),
  ADD KEY `fk_contestacion_estudiante` (`ID_ESTUDIANTE`),
  ADD KEY `fk_contestacion_pregunta` (`ID_PREGUNTA`),
  ADD KEY `fk_contestacion_respuesta` (`ID_PRIMERA_RESPUESTA`);

--
-- Indices de la tabla `encargado_plantel`
--
ALTER TABLE `encargado_plantel`
  ADD PRIMARY KEY (`ID_ENCARGADO`),
  ADD KEY `fk_encargado_usuario` (`ID_USUARIO`),
  ADD KEY `fk_encargado_plantel` (`ID_PLANTEL`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`ID_ESTUDIANTE`),
  ADD KEY `fk_estudiante_usuario` (`ID_USUARIO`),
  ADD KEY `fk_estudiante_grupo` (`ID_GRUPO`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`ID_GRUPO`),
  ADD KEY `fk_grupo_plantel` (`ID_PLANTEL`);

--
-- Indices de la tabla `plantel`
--
ALTER TABLE `plantel`
  ADD PRIMARY KEY (`id_plantel`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`ID_PREGUNTA`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`ID_RESPUESTA`),
  ADD KEY `fk_respuesta_pregunta` (`ID_PREGUNTA`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
-- Indices de la tabla `fase`
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`ID_MODULO`);

-- Indices de la tabla `modulo`
ALTER TABLE 'fase'
  ADD PRIMARY KEY (`ID_FASE`);

-- Indices de la tabla `cursar_modulo`
ALTER TABLE `cursar_modulo`
  ADD PRIMARY KEY (`ID_MODULO`, 'ID_JUGADOR', `ID_FASE`),
  ADD KEY `fk_cursar_modulo_estudiante` (`ID_ESTUDIANTE`),
  ADD KEY `fk_cursar_modulo_modulo` (`ID_MODULO`),
  ADD KEY `fk_cursar_modulo_fase` (`ID_FASE`);
--
-- AUTO_INCREMENT de la tabla `contestacion`
--
ALTER TABLE `contestacion`
  MODIFY `ID_CONTESTACION` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encargado_plantel`
--
ALTER TABLE `encargado_plantel`
  MODIFY `ID_ENCARGADO` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `ID_ESTUDIANTE` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `ID_GRUPO` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plantel`
--
ALTER TABLE `plantel`
  MODIFY `id_plantel` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `ID_PREGUNTA` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `ID_RESPUESTA` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contestacion`
--
ALTER TABLE `contestacion`
  ADD CONSTRAINT `fk_contestacion_estudiante` FOREIGN KEY (`ID_ESTUDIANTE`) REFERENCES `estudiante` (`ID_ESTUDIANTE`),
  ADD CONSTRAINT `fk_contestacion_pregunta` FOREIGN KEY (`ID_PREGUNTA`) REFERENCES `pregunta` (`ID_PREGUNTA`),
  ADD CONSTRAINT `fk_contestacion_respuesta` FOREIGN KEY (`ID_PRIMERA_RESPUESTA`) REFERENCES `respuesta` (`ID_RESPUESTA`);


ALTER TABLE `encargado_plantel`
  ADD CONSTRAINT `fk_encargado_plantel` FOREIGN KEY (`ID_PLANTEL`) REFERENCES `plantel` (`id_plantel`),
  ADD CONSTRAINT `fk_encargado_usuario` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_grupo` FOREIGN KEY (`ID_GRUPO`) REFERENCES `grupo` (`ID_GRUPO`),
  ADD CONSTRAINT `fk_estudiante_usuario` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_grupo_plantel` FOREIGN KEY (`ID_PLANTEL`) REFERENCES `plantel` (`id_plantel`);


ALTER TABLE `respuesta`
  ADD CONSTRAINT `fk_respuesta_pregunta` FOREIGN KEY (`ID_PREGUNTA`) REFERENCES `pregunta` (`ID_PREGUNTA`);


ALTER TABLE `cursar_modulo`
  ADD CONSTRAINT `fk_cursar_modulo_estudiante` FOREIGN KEY (`ID_ESTUDIANTE`) REFERENCES `estudiante` (`ID_ESTUDIANTE`),
  ADD CONSTRAINT `fk_cursar_modulo_modulo` FOREIGN KEY (`ID_MODULO`) REFERENCES `modulo` (`ID_MODULO`),
  ADD CONSTRAINT `fk_cursar_modulo_fase` FOREIGN KEY (`ID_FASE`) REFERENCES `fase` (`ID_FASE`)
  COMMIT;