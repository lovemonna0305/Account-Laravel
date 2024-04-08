ALTER TABLE `products` ADD `wholesale_product` INT(1) NOT NULL DEFAULT '0' AFTER `external_link`;

UPDATE `business_settings` SET `value` = '5.4.4' WHERE `business_settings`.`type` = 'current_version';

COMMIT;