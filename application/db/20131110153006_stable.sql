SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `bitauth_userdata` ADD COLUMN `clan`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `fullname`;
ALTER TABLE `bitauth_userdata` ADD COLUMN `puntos`  bigint(20) NOT NULL DEFAULT 0 AFTER `email`;
ALTER TABLE `bitauth_userdata` ADD COLUMN `racha`  int(255) NOT NULL DEFAULT 0 AFTER `puntos`;
ALTER TABLE `bitauth_userdata` ADD COLUMN `participante`  int(11) NOT NULL DEFAULT 0 AFTER `racha`;
ALTER TABLE `bitauth_userdata` ADD COLUMN `status`  int(11) NOT NULL DEFAULT 0 AFTER `participante`;
CREATE TABLE `log` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`from_user_id`  int(11) NULL DEFAULT NULL ,
`to_user_id`  int(11) NULL DEFAULT NULL ,
`vitamina_id`  int(11) NULL DEFAULT NULL ,
`fecha`  datetime NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
ROW_FORMAT=Compact
;
CREATE TABLE `migrations_history` (
`id`  int(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`timestamp`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact
;
CREATE TABLE `pastillero` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`vitamina_id`  int(11) NOT NULL ,
`user_id`  int(11) NOT NULL ,
`timeout`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
ROW_FORMAT=Compact
;
CREATE TABLE `vitamina` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`nombre`  varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`descripcion`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
`time`  int(11) NULL DEFAULT NULL ,
`categoria`  int(11) NULL DEFAULT NULL ,
`fichero`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
ROW_FORMAT=Compact
;
SET FOREIGN_KEY_CHECKS=1;