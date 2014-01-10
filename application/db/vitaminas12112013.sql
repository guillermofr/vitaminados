/*
Navicat MySQL Data Transfer

Source Server         : w
Source Server Version : 50531
Source Host           : localhost:3306
Source Database       : vitaminados

Target Server Type    : MYSQL
Target Server Version : 50531
File Encoding         : 65001

Date: 2014-01-10 14:42:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `vitamina`
-- ----------------------------
DROP TABLE IF EXISTS `vitamina`;
CREATE TABLE `vitamina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(222) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `time` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `fichero` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of vitamina
-- ----------------------------
INSERT INTO `vitamina` VALUES ('1', 'Un buen pellizco', '<p>Al usarse la puntuación aumenta en 10000 puntos</p>', '20', '1', 'suma10000.php');
INSERT INTO `vitamina` VALUES ('2', 'Mile Mile Mile', '<p>Al usarse la puntuación aumenta en 1000 puntos</p>', '600', '2', 'suma1000.php');
INSERT INTO `vitamina` VALUES ('3', 'Toma mis dies', '<p>Al usarse la puntuación aumenta en 10 puntos</p>', '1200', '3', 'suma10.php');
INSERT INTO `vitamina` VALUES ('4', 'Spain, ten points!', '<p>Al usarse la puntuación aumenta en 10 puntos</p>', '1200', '3', 'suma10.php');
INSERT INTO `vitamina` VALUES ('5', '¿Esto sirve para algo?', '<p>Al usarse la puntuación aumenta en 10 puntos</p>', '1200', '3', 'suma10.php');
INSERT INTO `vitamina` VALUES ('6', 'Intercambio', '<p>Esta vitamina intercambia los puntos y la racha de combos por las de tu objetivo</p>', '20', '1', 'ErrorDePuntero.php');
INSERT INTO `vitamina` VALUES ('7', 'Ira de Dios', '<p>Esta vitamina pondrá el marcador y la racha de tu objetivo a 0, zas!</p>', '20', '1', 'IraDeDios.php');
INSERT INTO `vitamina` VALUES ('8', 'Una ayudita', '<p>Suma una cantidad aleatoria de puntos a tu objetivo, entre 100 y 10000</p>', '120', '3', 'PuntuacionAzarBenevolo.php');
INSERT INTO `vitamina` VALUES ('9', 'No se que estoy haciendo', '<p>Esta vitamina puede ser muy buena o muy mala, dará una puntuación entre -10.000 y 10.000 puntos, ¿te atreves? </p>', '60', '2', 'PuntuacionAzarCruel.php');
INSERT INTO `vitamina` VALUES ('10', '¡Toma corte!', '<p>Divide la puntuación de alguien por la mitad</p>', '10', '2', 'PuntuacionDivide2.php');
INSERT INTO `vitamina` VALUES ('11', '¡Ponmelo doble!', '<p>Duplica la puntuación</p>', '10', '1', 'PuntuacionMultiplica2.php');
INSERT INTO `vitamina` VALUES ('12', 'Rasguño', '<p>Resta 100 puntos a tu objetivo</p>', '120', '3', 'PuntuacionRestar100.php');
INSERT INTO `vitamina` VALUES ('13', 'No tan deprisa!', '<p>Resta 1000 puntos a tu objetivo</p>', '120', '3', 'PuntuacionRestar1000.php');
INSERT INTO `vitamina` VALUES ('14', 'Más Rachas!!', '<p>Aumenta el combo una cantidad aleatoria entre 1 y 9</p>', '120', '3', 'RachaAzarBenevolo.php');
INSERT INTO `vitamina` VALUES ('15', 'Un pasito palante, un pasito patrás', '<p>Suma un valor aleatorio entre -9 y +9 la racha del objetivo</p>', '120', '3', 'RachaAzarCruel.php');
INSERT INTO `vitamina` VALUES ('16', 'Vuelve a tirar', '<p>Resta 2 a la racha del objetivo</p>', '15', '3', 'RachaRestar2.php');
INSERT INTO `vitamina` VALUES ('17', 'Vamos para atrás...', '<p>Resta 5 a la racha del objetivo</p>', '100', '3', 'RachaRestar5.php');
INSERT INTO `vitamina` VALUES ('18', 'Avanza!', '<p>Suma 2 combos a la racha del objetivo</p>', '15', '3', 'RachaSumar2.php');
INSERT INTO `vitamina` VALUES ('19', 'Avanza más!', '<p>Suma 5 combos a la racha del objetivo</p>', '100', '3', 'RachaSumar5.php');
INSERT INTO `vitamina` VALUES ('20', 'Ruleta rusa!', '<p>50% de posibilidades de poner a 0 los puntos del objetivo... cuidado! que si falla te pones a 0 tu!!!</p>', '30', '1', 'RuletaRusa.php');
INSERT INTO `vitamina` VALUES ('21', 'Vamos a medias...', '<p>Iguala tu puntuación y la del objetivo a la cantidad media de los dos</p>', '30', '2', 'Salomon.php');
INSERT INTO `vitamina` VALUES ('22', 'Te cambio las vitaminas!', '<p>Intercambia todas tus vitaminas por las de tu objetivo</p>', '20', '2', 'IntercambioVitaminas.php');
INSERT INTO `vitamina` VALUES ('23', 'Te quito todo', '<p>Borra todas las vitaminas de tu adversario!</p>', '20', '1', 'BorraVitaminas.php');
INSERT INTO `vitamina` VALUES ('24', 'Te borro una vitamina', '<p>Se borrará una vitamia aleatoria de tu adversario</p>', '30', '3', 'Borra1Vitamina.php');
INSERT INTO `vitamina` VALUES ('25', 'Te borro dos vitaminas!', '<p>Se borrarán dos vitaminas aleatorias de tu adversario!</p>', '30', '2', 'Borra2Vitaminas.php');
INSERT INTO `vitamina` VALUES ('26', 'Toma un rosco!', '<p>Si ves que alguien está haciendo un combo muy alto, cortale el rollo y que se coma un rosco!, ponle el combo a 0 y que empiece de nuevo XD</p>', '340', '3', 'RachaResetea.php');
INSERT INTO `vitamina` VALUES ('27', 'Rachea el doble!', '<p>Multiplica por 2 el combo del objetivo! </p>', '120', '3', 'RachaMultiplica2.php');
INSERT INTO `vitamina` VALUES ('28', 'Divide y perderás', '<p>Divide por 2 la cantidad de combos del jugador seleccionado</p>', '120', '3', 'RachaDivide2.php');
INSERT INTO `vitamina` VALUES ('29', 'El karma', '<p>El karma siempre te lo devuelve, esta vitamina hace que el jugador seleccionado sufra el efecto de la última vitamina que haya utilizado contra alguien, aplicándoselo a él mismo</p>', '40', '3', 'KarmaRepite.php');
INSERT INTO `vitamina` VALUES ('30', 'ONG', '<p>Hoy te sientes generoso y optas por donar a cualquier persona todos tus puntos, ¿por què? porque sí.</p>', '30', '3', 'ONG.php');
INSERT INTO `vitamina` VALUES ('31', 'Salvaculos', '<p>Esta vitamina es una de las más importantes estratégicamente hablando.</p><p>Si posees esta vitamina en el inventario y alguien te tira una vitamina, el escudo se rompe y te salvará de la vitamina.</p><p>Si ya tienes escudos en el inventario y quieres proteger a alguien  puedes usar esta vitamina con alguien y la vitamina pasará al inventario de ese jugador</p>', '30', '3', 'Escudo.php');
INSERT INTO `vitamina` VALUES ('32', 'Humble bundle weekly', '<p>Al usar esta vitamina contra ti o alguien, generará 5 vitaminas nuevas en el inventario del objetivo</p>', '10', '2', '1x5.php');
INSERT INTO `vitamina` VALUES ('33', 'Humble bundle ', '<p>Al usar esta vitamina contra ti o alguien, generará 10 vitaminas nuevas en el inventario del objetivo</p>', '10', '2', '1x10.php');
INSERT INTO `vitamina` VALUES ('34', 'Oye que monto un kickstarter', '<p>Al usar esta vitamina en un objetivo, todos los demás participantes les darán 1000 puntos al objetivo seleccionado</p>', '10', '1', 'kickstarter.php');
INSERT INTO `vitamina` VALUES ('36', 'Ese clan no me gusta', '<p>Al usarse sobre un objetivo, se le restarán 100 puntos a el y a sus compañeros de clan</p>', '60', '3', 'ClanPuntuacionRestar100.php');
INSERT INTO `vitamina` VALUES ('37', 'Dime con quien andas...', '<p>Al usarse sobre un objetivo, se le restarán 1000 puntos a el y a sus compañeros de clan</p>', '60', '3', 'ClanPuntuacionRestar1000.php');
INSERT INTO `vitamina` VALUES ('38', 'Vamos chicos!!! ', '<p>Al usarse sobre un objetivo, se le sumarán 100 puntos a el y a sus compañeros de clan</p>', '60', '3', 'ClanPuntuacionSumar100.php');
INSERT INTO `vitamina` VALUES ('39', 'Camaradas!!', '<p>Al usarse sobre un objetivo, se le sumarán 1000 puntos a el y a sus compañeros de clan</p>', '60', '3', 'ClanPuntuacionSumar1000.php');
INSERT INTO `vitamina` VALUES ('40', 'Ponte en mi lugar...', '<p>Ah claro! con tantos puntos si que te ríes pero me gustaría verte la cara si tuvieras mis puntos</p><p>Con esta vitamina le pones tus puntos a tu objetivo y te pones 0 puntos tu</p><p>Así sabrá lo que se siente en tu posición...</p>', '5', '2', 'PonteEnMiLugar.php');
INSERT INTO `vitamina` VALUES ('41', 'Un clan unido avanza unido', '<p>Al usarla sobre un objetivo con clan, todos los miembros del clan del objetivo tendrán la puntuación media de su clan</p><p>Así estarán juntitos en la tabla de clasificaciones</p>', '10', '1', 'ClanUnido.php');
INSERT INTO `vitamina` VALUES ('42', 'Cria cuervos... ', '<p>Y te sacarán los ojos...</p><p>Al usarse sobre un objetivo con clan, cada uno de sus \"amigos\" o \"compañeros de clan\" le robarán 2000 puntos</p>', '40', '2', 'CriaCuervos.php');
INSERT INTO `vitamina` VALUES ('43', 'Paliza gitana', '<p>Al usarla sobre un objetivo, le restarás 1000 puntos por cada compañero de clan que tengas tu</p><p>Así aprenderá a no meterse con nosotros....</p>', '30', '2', 'PalizaGitana.php');
