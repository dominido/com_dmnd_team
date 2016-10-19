CREATE TABLE IF NOT EXISTS `#__dmnd_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(512) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__dmnd_team_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__dmnd_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(512) NOT NULL,
  `subtitle` varchar(512) NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `image` varchar(512) NOT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;