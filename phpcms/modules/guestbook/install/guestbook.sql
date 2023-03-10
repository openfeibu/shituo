DROP TABLE IF EXISTS `phpcms_guestbook`;
CREATE TABLE `phpcms_guestbook` (
  `guestid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `sex` varchar(50) NOT NULL DEFAULT '',
  `lxqq` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(50) NULL DEFAULT '',
  `content` text NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `elite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `reply` varchar(1000) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`guestid`),
  KEY `typeid` (`typeid`,`passed`,`listorder`,`guestid`)
) TYPE=MyISAM;