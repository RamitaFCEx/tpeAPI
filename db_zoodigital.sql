-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 01:45:41
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_zoodigital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id` int(255) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`id`, `nombre`, `descripcion`) VALUES
(7, 'Oso', 'Los osos o úrsidos (Ursidae) son una familia de mamíferos omnívoros.​ Son animales de gran tamaño, generalmente omnívoros ya que, a pesar de su temible dentadura, comen frutos, raíces e insectos, además de carne. Con sus pesados cuerpos y sus poderosas mandíbulas, los osos se encuentran entre los mayores carnívoros que viven en la Tierra.'),
(9, 'Perro', 'El perro (Canis familiaris o Canis lupus familiaris, dependiendo de si se lo considera una especie por derecho propio o una subespecie del lobo),​ llamado perro doméstico o can; es un mamífero carnívoro de la familia de los cánidos y constituye una especie del género Canis.'),
(10, 'Ave', 'Las aves son animales vertebrados, de sangre caliente, que caminan, saltan o se mantienen solo sobre las extremidades posteriores,​ mientras que las extremidades anteriores han evolucionado hasta convertirse en alas que, al igual que muchas otras características anatómicas únicas, les permiten, en la mayoría de los casos, volar, si bien no todas vuelan. '),
(11, 'Cocodrilo', 'Los crocodilios (Crocodilia) son un orden de grandes reptiles predadores semiacuáticos. El orden incluye a los cocodrilos (familia Crocodylidae), a los gaviales (familia Gavialidae) y a los aligátores y caimanes (familia Alligatoridae). Aunque a menudo se utiliza para referirse a todos ellos, de forma estricta el término \'cocodrilo\' se refiere solo a los miembros de la familia Crocodylidae.'),
(12, 'Cetaceo', 'Los cetáceos (Cetacea) son un infraorden de mamíferos placentarios completamente adaptados a la vida acuática. El nombre cetáceo deriva del griego κῆτος, kētos, que significa ballena o monstruo marino y fue acuñado por Aristóteles para referirse a los animales acuáticos dotados de respiración pulmonar. '),
(13, 'Pez', 'Los peces (del latín pisces) son animales vertebrados primariamente acuáticos, generalmente ectotérmicos (regulan su temperatura a partir del medio ambiente) y con respiración por branquias. Suelen estar recubiertos por escamas, y están dotados de aletas, que permiten su movimiento continuo en los medios acuáticos, y branquias, con las que captan el oxígeno disuelto en el agua. '),
(14, 'Molusco', 'Los moluscos (Mollusca, del latín mollis \"blando\") conforman uno de los grandes filos del reino animal. Son invertebrados protóstomos celomados, triblásticos de simetría bilateral (aunque algunos pueden tener una asimetría secundaria) no segmentados, de cuerpo blando, desnudo o protegido por una concha.'),
(15, 'Octopodo', 'Los octópodos (Octopoda, del griego ὀκτώ oktṓ \'ocho\' y ‒́podo \'pie\') son un orden de moluscos cefalópodos octopodiformes conocidos comúnmente como pulpos. Al igual que otros cefalópodos, el pulpo tiene simetría bilateral, con la boca y el pico situados en el punto central de sus ocho extremidades.'),
(16, 'Escualo', 'Los selaquimorfos o selacimorfos (Selachimorpha, del griego , tiburón, forma) son un superorden de condrictios (peces cartilaginosos) conocidos comúnmente con el nombre de tiburones o escualos. Algunos grandes escualos, como el tiburón blanco y el toro, son conocidos a veces con el nombre de jaquetones.'),
(29, 'Elefante', 'Los elefantes son los animales terrestres más grandes que existen en la actualidad. El periodo de gestación es de veintidós meses, el más largo en cualquier animal terrestre. El peso al nacer usualmente es 118 kg. Normalmente viven de cincuenta a ochenta años.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id` int(255) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `id_especie_fk` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `nombre`, `color`, `descripcion`, `id_especie_fk`) VALUES
(3, 'Panda', 'blancoNegro', 'El panda, oso panda o panda gigante (Ailuropoda melanoleuca) es una especie de mamífero del orden de los carnívoros. El estudio de su ADN lo engloba entre los miembros de la familia de los osos (Ursidae),​ siendo el oso de anteojos su pariente más cercano, que pertenece a la subfamilia de los tremarctinos. ', 7),
(4, 'Border Collie', 'blancoNegro', 'El Border Collie es una raza de perro de trabajo incluido dentro de la denominación Collie. La raza surgió en la frontera entre Escocia e Inglaterra como perro pastor, sobre todo para trabajar con rebaños de ovejas. El border collie fue seleccionado sobre todo para enfatizar su inteligencia y su obediencia; debido a esto, son uno de los perros pastores más populares en la actualidad.', 9),
(5, 'Hornero', 'marronRojizo', 'Los horneros (Furnarius) son un género de aves paseriformes perteneciente a la familia Furnariidae que agrupa a especies nativas de América del Sur donde se distribuyen desde el norte de Colombia y Venezuela hasta el norte de la Patagonia en Argentina. Son llamadas así debido a que su nido tiene la forma de un horno de barro.', 10),
(6, 'Orca', 'negroBlanco', 'La orca (Orcinus orca) es una especie de cetáceo odontoceto perteneciente a la familia Delphinidae (delfines oceánicos), que habita en todos los océanos del planeta. Es la especie más grande de delfínido y la única existente actual reconocida dentro del género Orcinus.', 12),
(7, 'Yacare', 'azabacheAmarillento', 'Caiman es un género de cocodrilos de la familia de los aligatóridos, conocidos vulgarmente como yacarés. Se distribuyen en las regiones subtropicales y tropicales de América, desde Florida hasta el sur de Sudamérica. Nótese que el nombre científico del género es Caiman, sin tilde (ya que en latín no se usa), el cual fue tomado del nombre común, “caimán”, con tilde.', 11),
(8, 'Calamar', 'rosaceoPurpura', 'Los téutidos (Teuthida) son un orden de moluscos cefalópodos conocidos vulgarmente como calamares (debido a su \"hueso\" calcáreo, conocido como pluma o caña = calamus en latín).​ Contiene dos subórdenes, Myopsina y Oegopsina (el último incluye a Architeuthis dux, el calamar gigante y a Mesonychoteuthis hamiltoni o calamar colosal). Son animales marinos y carnívoros.', 14),
(9, 'Tiburon Blanco', 'grisAzuladoBlanco', 'El gran tiburón blanco (Carcharodon carcharias) o jaquetón es una especie de pez cartilaginoso lamniforme de la familia Lamnidae (escualo). Vive en las aguas cálidas y templadas de casi todos los océanos. Esta especie es la única del género Carcharodon que sobrevive en la actualidad. A nivel mundial se considera Vulnerable (IUCN).', 16),
(10, 'Pulpo de anillos azules', 'amarilloAzul', 'Hapalochlaena es un género de moluscos cefalópodos del orden de los octópodos conocidos comúnmente como pulpos de anillos azules. Incluye cuatro especies de pequeños pulpos que viven en las pozas de agua de mar en el océano Pacífico, desde Japón hasta Australia.​ A pesar de su pequeño tamaño, son comúnmente reconocidos como uno de los animales más venenosos del mundo. Son fácilmente reconocidos por su piel amarillenta con característicos anillos de color azul y negro.', 15),
(11, 'Payaso', 'naranjaBlanco', 'Amphiprioninae es una subfamilia de peces marinos de la familia Pomacentridae, que engloba únicamente a los géneros Amphiprion y Premnas, cuyos componentes son conocidos como peces payaso o peces de las anémonas.', 13),
(12, 'Grizzly', 'marron', 'El oso grizzly u oso gris (Ursus arctos horribilis) es una de las subespecies del oso pardo (Ursus arctos) más grandes del planeta, que suele vivir en las tierras altas del territorio norteamericano. Es un animal solitario, excepto durante la temporada del desove del salmón, cuando se junta un enorme número de osos en arroyos y zonas costeras para alimentarse.', 7),
(13, 'Dogo Argentino', 'blanco', 'El dogo argentino es una raza de perro de presa utilizada para la caza mayor, es originaria de la Provincia de Córdoba, República Argentina.\r\nJunto con el Perro Pila Argentino, el Galgo Barbucho Patagónico y el nuevo Perro Pampa Argentino son las únicas razas de perros desarrolladas en la República Argentina que aún existen. Las otras dos, el perro polar argentino y el perro de pelea cordobés, se encuentran extintas.', 9),
(14, 'Pica Flor', 'verdeAzul', 'Los troquilinos (Trochilinae) son una subfamilia de aves apodiformes de la familia Trochilidae, conocidas comúnmente como picaflores, colibríes, quindes, tucusitos, chupamirtos, chuparrosas, huitzitzilin (en náhuatl), mainumby (en guaraní) o guanumby. Conjuntamente con las ermitas, que pertenecen a la subfamilia Phaethornithinae, conforman la familia Trochilidae que, en la sistemática de Charles Sibley, se clasifica en un orden propio: Trochiliformes, independiente de los vencejos del orden Apodiformes.', 10),
(15, 'Cachalote', 'gris', 'El cachalote (Physeter macrocephalus) es una especie de mamífero marino del infraorden Cetacea del parvorden Odontoceti. El cachalote es el único miembro del género Physeter y es una de las tres especies vivientes de la familia Physeteridae, junto al cachalote pigmeo y cachalote enano.', 12),
(16, 'Gavial', 'azabacheAmarillento', 'El gavial (Gavialis gangeticus) es una especie de saurópsido del orden Crocodilia, la única especie viva del género Gavialis. Se caracteriza por una boca (hocico) muy flaca, adaptación a una dieta a base de peces, ya que no sirve para cazar grandes mamíferos; podría llegar a partirse si se ejerce demasiada presión.', 11),
(17, 'Tiburon Martillo', 'grisBlanco', 'Los esfírnidos (Sphyrnidae) son una familia de elasmobranquios del orden Carcharhiniformes conocidos como tiburones martillo, peces martillo o cornudas. Tienen la cabeza prolongada hacia los lados con los ojos en cada extremo.', 16),
(18, 'Nautilus', 'blancoRojizo', 'Nautilus (del griego ναυτίλος, \"marinero\") es un género de moluscos cefalópodos del que sobreviven hoy en día tres especies. Reciben el nombre común de nautilos, nombre que comparten con las especies del género Allonautilus, de las que difieren de manera significativa.\r\nSe considera al Nautilus un fósil viviente.', 14),
(19, 'Pulpo Imitador', 'blancoNegro', 'El pulpo mimo, pulpo imitador o pulpo mimético (Thaumoctopus mimicus) es una especie de molusco cefalópodo del orden Octopoda. Este pulpo es reconocido debido a que tiene la asombrosa habilidad de imitar al menos a otros 15 animales marinos.\r\nVive en los mares tropicales del Sudeste de Asia, y no fue oficialmente descubierto sino hasta 1998, frente a la costa de Célebes, Indonesia.', 15),
(20, 'Pez Linterna', 'rojizo', 'El pez linterna cornudo es la especie Centrophryne spinulosa, única de su género y única de su familia Centrophrynidae, distribuido por todo el fondo abisal del océano Atlántico y del océano Pacífico.​ El nombre de la familia procede del griego: kentron (aguijón o pica) + phrynos (sapo).', 13),
(58, 'Polar', 'blanco', 'ZZZ', 7),
(61, 'Tiburon tigre', 'atigrado', 'chanchanchanchanchan', 16),
(62, 'Peresozo', 'gris', 'zzzz', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(45) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `password`) VALUES
('carlitos@gmail.com', '$2y$10$4/RfjLU60Faur.9wS9ROsOpGTWvUl52flfGKeulmXFkTSXzCFC5ki');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_especie_fk` (`id_especie_fk`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`id_especie_fk`) REFERENCES `especie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
