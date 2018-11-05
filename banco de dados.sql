DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PR_SolicitaNegativacao`(
Cpf_var varchar (50),
Nome_var varchar (150),
Email_var varchar (100),
cep_var varchar (10),
endereco_var varchar (200),
cidade_var varchar (50),
bairro_var varchar (50),
estado_var varchar (2),
complemento_var varchar (100),
numero_var int,
telefone_var varchar (20),
tipo_var varchar (50),
valor_var decimal(10,2),
descricao_var varchar (300),
comprovante_var varchar (100),
solicitante int
)
BEGIN
  DECLARE qtde int;
  DECLARE id int;
   select count(ID_Pessoa) into qtde from tb_pessoa where cpf = Cpf_var;
   
   
     IF(qtde = 0)
     THEN 
    INSERT INTO tb_pessoa (Nome,Email,cep,endereco,cidade,bairro,estado,complemento,numero,telefone,ativo,cpf)
    values (Nome_var,Email_var,cep_var,endereco_var,cidade_var,bairro_var,estado_var,complemento_var,
    numero_var,telefone_var,qtde,Cpf_var);
     END IF;
   
    
    select ID_Pessoa into id from tb_pessoa where cpf = Cpf_var;
    

    Insert into tb_divida (FK_Pessoa,FK_Solicitante,Tipo,descricao,valor,comprovante) values (id,solicitante,tipo_var,
    descricao_var,valor_var,comprovante_var);
 END$$
DELIMITER ;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PR_AprovaRejeitaNegativacao`(

divida_var int,
usuario_var int,
aprovado_var int
)
BEGIN
     
      Insert into tb_historico_negativacao (`FK_Divida`,`FK_Usuario`,`data`)
       values (divida_var,usuario_var,now());
       
       update tb_divida set aprovado = aprovado_var where ID_Divida = divida_var;
    


 END
 $$
DELIMITER ;

CREATE DATABASE `ConsomeDados` /*!40100 DEFAULT CHARACTER SET utf8 */; 
use ConsomeDados;

CREATE TABLE `tb_cadastro` (
  `ID_Cadastro` int(11) NOT NULL AUTO_INCREMENT,
  `Razao_Social` varchar(150) NOT NULL,
  `Nome_Fantasia` varchar(100) NOT NULL,
  `CNPJ` bigint(20) NOT NULL,
  `Inscricao_Estadual` bigint(20) NOT NULL,
  `Cep` int(11) NOT NULL,
  `Logradouro` varchar(150) NOT NULL,
  `Avatar` varchar(150) NOT NULL,
  `Numero` varchar(6) NOT NULL,
  `Bairro` varchar(30) NOT NULL,
  `Complemento` varchar(30) DEFAULT NULL,
  `Cidade` varchar(30) NOT NULL,
  `Estado` varchar(2) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefone` varchar(20) NOT NULL,
  `Bloqueado` int(11) NOT NULL DEFAULT '0',
   CONSTRAINT `PK_ID_Cadastro` PRIMARY KEY (`ID_Cadastro`),
   CONSTRAINT `UK_CNPJ_Cadastro`UNIQUE KEY (`CNPJ`),
   CONSTRAINT `UK_EMAIL_Cadastro`UNIQUE KEY (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `tb_usuario`(
`ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
`FK_Cadastro` int (11) NULL,
`Nome` varchar (150) NOT NULL,
`Tipo` varchar (20) NOT NULL,
`Email`varchar (50) NOT NULL,
`Senha`varchar (50) NOT NULL,
`Bloqueado` int(1) NOT NULL,
`Avatar` varchar (150) NOT NULL,
 CONSTRAINT `PK_ID_Usuario` PRIMARY KEY (`ID_Usuario`),
 CONSTRAINT `FK_ID_Cadastro` FOREIGN KEY (`FK_Cadastro`) references `TB_Cadastro` (`ID_Cadastro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_permissao`(
`ID_Permissao` int(11) NOT NULL AUTO_INCREMENT,
`Nome` varchar (100) NOT NULL,
 CONSTRAINT `PK_ID_Permissao` PRIMARY KEY (`ID_Permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_permissao_usuario`(
`ID_Permissao_usuario` int(11) NOT NULL AUTO_INCREMENT,
`FK_Usuario` int (11) NOT NULL,
`FK_Permissao` int (11) NULL,
 CONSTRAINT `PK_ID_Permissao_usuario` PRIMARY KEY (`ID_Permissao_usuario`),
 CONSTRAINT `FK_Usuario_permissao` FOREIGN KEY (`FK_Usuario`) references `TB_usuario` (`ID_Usuario`),
 CONSTRAINT `FK_Permissao_permissao` FOREIGN KEY (`FK_Permissao`) references `TB_Permissao` (`ID_Permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_pessoa`(
`ID_Pessoa` int(11) NOT NULL AUTO_INCREMENT,
`Nome` varchar (100) NOT NULL,
`Cpf` varchar (150) NOT NULL,
`Cep` varchar (20) NOT NULL,
`Endereco`varchar (50) NOT NULL,
`Cidade`varchar (50) NOT NULL,
`Estado` varchar(2) NOT NULL,
`Complemento` varchar(30) DEFAULT NULL,
`Bairro` varchar(30) DEFAULT NULL,
`Numero`int (11) NOT NULL,
`Telefone` varchar(50) NOT NULL,
`Ativo` int(1),
`Email` varchar (150) NOT NULL,
 CONSTRAINT `PK_ID_Pessoa` PRIMARY KEY (`ID_Pessoa`),
    CONSTRAINT `UK_CPF_Cadastro`UNIQUE KEY (`Cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tb_divida`(
`ID_Divida` int (11) NOT NULL AUTO_INCREMENT,
`FK_Pessoa` int (11) NOT NULL,
`Tipo` varchar (100) not null,
`descricao` varchar (300) not null,
`valor` decimal (10,2) not null,
`comprovante` varchar (150) not null,
`aprovada` int not null default 0,
CONSTRAINT `PK_ID_Divida` PRIMARY KEY(`ID_Divida`),
CONSTRAINT `FK_Pessoa_Divida` FOREIGN KEY(`FK_Pessoa`) references `tb_pessoa`(`ID_Pessoa`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tb_historico_negativacao`(
`ID_Historico` int (11) NOT NULL AUTO_INCREMENT,
`FK_Divida` int (11) NOT NULL,
`FK_Usuario` int (11) not null,
`data` date not null,
CONSTRAINT `PK_ID_Historico` PRIMARY KEY(`ID_Historico`),
CONSTRAINT `FK_Divida_Historico` FOREIGN KEY(`FK_Divida`) references `tb_divida`(`ID_Divida`),
CONSTRAINT `FK_Usuario_Historico` FOREIGN KEY(`FK_Usuario`) references `tb_usuario`(`ID_Usuario`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


