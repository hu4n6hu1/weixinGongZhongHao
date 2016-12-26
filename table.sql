CREATE TABLE IF NOT EXISTS `wx_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` char(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

INSERT INTO `wx_admin`(`email`, `password`) VALUES ( 'admin@qq.com', '21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE IF NOT EXISTS `wx_token` (
	`type_id` int(11) Not NULL primary key ,
	`token` varchar(1024) not null ,
	`expires` int(11) not null
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `wx_exchange_rate` (
	`type_id` int(11) Not NULL primary key ,
	`rate` float(11) not null ,
	`expires` int(11) not null
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

create table if not exists `wx_config`(
 id int(11) not null auto_increment ,
 key_name char(120)  UNIQUE,
 config_value char(255),
 primary key (`id`)
);

create table if not exists `wx_menu_list`(
 menu_id int auto_increment not null,
 parent_id int not null default 0,
 menu_name varchar(50) not null,
 primary key( `menu_id`),
 index `parent_id`(`parent_id`)
)

create table if not exists `now_menu_list`(
 menu_id int auto_increment not null,
 `pid` int not null default 0,
 `name` varchar(41) not null,
 `type` char(50) not null,
 `url` varchar(1024)  default '',
 `key` char(128),
 `media_id`  varchar(1024),
 primary key( `menu_id`),
 index `parent_id`(`pid`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;