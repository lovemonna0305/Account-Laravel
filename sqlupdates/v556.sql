ALTER TABLE `uploads` ADD `external_link` VARCHAR(500) NULL DEFAULT NULL AFTER `type`;

ALTER TABLE `shops` ADD `instagram` VARCHAR(255) NULL DEFAULT NULL AFTER `facebook`;

UPDATE `business_settings` SET `value` = '5.5.6' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
