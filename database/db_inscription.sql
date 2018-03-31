
--
-- Table structure for table `tb_inscription`
--

CREATE TABLE `tb_inscription` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL,
 `famillyName` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `ipaddress` varchar(100) NOT NULL,
 `timestamp` datetime NOT NULL,
 `paymentReceived` bool DEFAULT false,
 `paymentReceivedValue` DECIMAL(10, 2) DEFAULT 0, 
 `paymentReceivedDate` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;