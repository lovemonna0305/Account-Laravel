ALTER TABLE `orders` ADD `tracking_code` VARCHAR(255) NULL DEFAULT NULL AFTER `code`;

UPDATE `business_settings` SET `value` = '5.5.3' WHERE `business_settings`.`type` = 'current_version';

COMMIT;