-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: dental_clean
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `PacienteServico`
--

DROP TABLE IF EXISTS `PacienteServico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PacienteServico` (
  `id_paciente_servico` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  PRIMARY KEY (`id_paciente_servico`),
  KEY `PacienteServico_paciente_FK` (`id_paciente`),
  KEY `PacienteServico_servico_FK` (`id_servico`),
  CONSTRAINT `PacienteServico_paciente_FK` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`),
  CONSTRAINT `PacienteServico_servico_FK` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PacienteServico`
--

LOCK TABLES `PacienteServico` WRITE;
/*!40000 ALTER TABLE `PacienteServico` DISABLE KEYS */;
INSERT INTO `PacienteServico` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `PacienteServico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agendamento`
--

DROP TABLE IF EXISTS `agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agendamento` (
  `id_agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id_paciente` int(11) NOT NULL,
  `dentista_id_dentista` int(11) NOT NULL,
  `servico_id_servico` int(11) NOT NULL,
  `data_2` date DEFAULT NULL,
  `horario` int(11) DEFAULT NULL,
  `cod_servico` int(11) NOT NULL,
  `registro_historico` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_agendamento`),
  KEY `fk_agendamento_paciente` (`paciente_id_paciente`),
  KEY `fk_agendamento_dentista` (`dentista_id_dentista`),
  KEY `fk_agendamento_servico` (`servico_id_servico`),
  CONSTRAINT `fk_agendamento_dentista` FOREIGN KEY (`dentista_id_dentista`) REFERENCES `dentista` (`id_dentista`),
  CONSTRAINT `fk_agendamento_paciente` FOREIGN KEY (`paciente_id_paciente`) REFERENCES `paciente` (`id_paciente`),
  CONSTRAINT `fk_agendamento_servico` FOREIGN KEY (`servico_id_servico`) REFERENCES `servico` (`id_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendamento`
--

LOCK TABLES `agendamento` WRITE;
/*!40000 ALTER TABLE `agendamento` DISABLE KEYS */;
INSERT INTO `agendamento` VALUES (1,1,1,3,'2018-04-25',10,0,''),(2,1,1,3,'2018-04-18',7,0,''),(4,1,1,3,'2018-04-17',6,0,''),(5,1,1,3,'2018-04-19',7,0,'');
/*!40000 ALTER TABLE `agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dentista`
--

DROP TABLE IF EXISTS `dentista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dentista` (
  `id_dentista` int(11) NOT NULL AUTO_INCREMENT,
  `login_id_login` int(11) NOT NULL,
  `nome_completo` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_2` date DEFAULT NULL,
  `cro` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_dentista`),
  KEY `fk_dentista` (`login_id_login`),
  CONSTRAINT `fk_dentista` FOREIGN KEY (`login_id_login`) REFERENCES `login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dentista`
--

LOCK TABLES `dentista` WRITE;
/*!40000 ALTER TABLE `dentista` DISABLE KEYS */;
INSERT INTO `dentista` VALUES (1,3,'Dentista','dentista@mail.com','123','123','123','123','123','123','123','123','123','0000-00-00','');
/*!40000 ALTER TABLE `dentista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerente`
--

DROP TABLE IF EXISTS `gerente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerente` (
  `id_gerente` int(11) NOT NULL AUTO_INCREMENT,
  `login_id_login` int(11) NOT NULL,
  `nome_completo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_2` date DEFAULT NULL,
  PRIMARY KEY (`id_gerente`),
  KEY `fk_gerente` (`login_id_login`),
  CONSTRAINT `fk_gerente` FOREIGN KEY (`login_id_login`) REFERENCES `login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerente`
--

LOCK TABLES `gerente` WRITE;
/*!40000 ALTER TABLE `gerente` DISABLE KEYS */;
INSERT INTO `gerente` VALUES (2,1,'Gerente','gerente@mail.com','123123123','123123','123123','123','123','123','123','123','123','0000-00-00');
/*!40000 ALTER TABLE `gerente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `senha` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `papel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paciente',
  PRIMARY KEY (`id_login`),
  UNIQUE KEY `login_UN` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'teste','admin','Gerente'),(2,'teste','usr','Paciente'),(3,'teste','dent','Dentista'),(4,'teste','secretaria','Secretaria');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `login_id_login` int(11) NOT NULL,
  `nome_completo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_2` date DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `fk_paciente` (`login_id_login`),
  CONSTRAINT `fk_paciente` FOREIGN KEY (`login_id_login`) REFERENCES `login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (1,2,'Paciente da Silva','v05443248443930743714@sandbox.pagseguro.com.br','123.123.123','59125000','RN','Natal','Potengi','Girua','Girua','34','(84) 99957-6893','0000-00-00');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `data_pagamento` date DEFAULT NULL,
  `data_vencimento` date NOT NULL,
  `tipo_pagamento` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_pagamento` double NOT NULL,
  `confirmar_pagamento` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_pagamento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paciente_id_paciente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `pagamento_paciente_FK` (`paciente_id_paciente`),
  CONSTRAINT `pagamento_paciente_FK` FOREIGN KEY (`paciente_id_paciente`) REFERENCES `paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamento`
--

LOCK TABLES `pagamento` WRITE;
/*!40000 ALTER TABLE `pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretaria`
--

DROP TABLE IF EXISTS `secretaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretaria` (
  `id_secretaria` int(11) NOT NULL AUTO_INCREMENT,
  `login_id_login` int(11) NOT NULL,
  `nome_completo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_2` date DEFAULT NULL,
  PRIMARY KEY (`id_secretaria`),
  KEY `fk_secretaria` (`login_id_login`),
  CONSTRAINT `fk_secretaria` FOREIGN KEY (`login_id_login`) REFERENCES `login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretaria`
--

LOCK TABLES `secretaria` WRITE;
/*!40000 ALTER TABLE `secretaria` DISABLE KEYS */;
INSERT INTO `secretaria` VALUES (1,4,'Secretaria da Silva','123','123','123','123','123','123','123','123','123','123',NULL);
/*!40000 ALTER TABLE `secretaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `gerente_id_gerente` int(11) NOT NULL,
  `valor_servico` double DEFAULT NULL,
  `tipo_servico` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao_servico` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `fk_servico_gerente` (`gerente_id_gerente`),
  CONSTRAINT `fk_servico_gerente` FOREIGN KEY (`gerente_id_gerente`) REFERENCES `gerente` (`id_gerente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (1,2,500,'Ortodontia',''),(2,2,1000,'Protese',''),(3,2,600,'Clareamento',NULL);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-08 15:49:34
