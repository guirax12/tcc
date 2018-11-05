CREATE DATABASE cliente;


CREATE TABLE `tb_usuario` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(150) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(50) NOT NULL,
  `Bloqueado` int(1) NOT NULL,
  `Credito` decimal(10,2) NOT NULL,
  `Avatar` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
