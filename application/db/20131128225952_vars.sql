SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `bitauth_userdata` MODIFY COLUMN `clan`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER `fullname`;
CREATE TABLE `vars` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`fin`  datetime NULL DEFAULT NULL ,
`first`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`second`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
ROW_FORMAT=Compact
;
INSERT INTO `vars` VALUES ('1', '2013-12-07 22:00:00', null, null);

SET FOREIGN_KEY_CHECKS=1;