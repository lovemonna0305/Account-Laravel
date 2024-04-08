ALTER TABLE `products` ADD `external_link` VARCHAR(500) NULL DEFAULT NULL AFTER `file_path`;

UPDATE `business_settings` SET `value` = '5.4' WHERE `business_settings`.`type` = 'current_version';

COMMIT;