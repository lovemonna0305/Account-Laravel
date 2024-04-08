ALTER TABLE `orders` ADD `additional_info` LONGTEXT NULL AFTER `shipping_address`;
UPDATE `business_settings` SET `value` = '6.1.1' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
