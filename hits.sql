--
-- Table structure for table `hits`
--

CREATE TABLE IF NOT EXISTS `hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `uri` varchar(4096) DEFAULT NULL,
  `agent` varchar(4096) DEFAULT NULL,
  `referer` varchar(4096) DEFAULT NULL,
  `domain` varchar(512) DEFAULT NULL,
  `filename` varchar(1024) DEFAULT NULL,
  `method` varchar(16) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

