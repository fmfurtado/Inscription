
--
-- Table structure for table `tb_inscription`
--

CREATE TABLE `tb_inscription` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL,
 `familyName` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `ipaddress` varchar(100) NOT NULL,
 `selectedOption` varchar(100) DEFAULT '',
 `timestamp` datetime NOT NULL,
 `payment` bool DEFAULT false,
 `paymentDate` datetime DEFAULT NULL,
 `paymentValue` DECIMAL(10, 2) DEFAULT 0, 
 `paymentMethod` varchar (20) DEFAULT NULL,
 `canceled` bool DEFAULT false,
 PRIMARY KEY (`id`),
 UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;