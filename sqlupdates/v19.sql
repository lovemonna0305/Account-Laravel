
UPDATE `business_settings` SET `value` = '1.9' WHERE `business_settings`.`type` = 'current_version';

ALTER TABLE `flash_deals` ADD `featured` INT(1) NOT NULL DEFAULT '0' AFTER `status`, ADD `background_color` VARCHAR(255) NULL DEFAULT NULL AFTER `featured`, ADD `text_color` VARCHAR(255) NULL DEFAULT NULL AFTER `background_color`, ADD `banner` VARCHAR(255) NULL DEFAULT NULL AFTER `text_color`, ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `banner`;


COMMIT;
