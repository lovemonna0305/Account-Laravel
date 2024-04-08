ALTER TABLE `categories` CHANGE `name` `name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

UPDATE `business_settings` SET `value` = '5.4.2' WHERE `business_settings`.`type` = 'current_version';

COMMIT;