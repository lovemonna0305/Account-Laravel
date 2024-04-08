ALTER TABLE `products` ADD `auction_product` INT(1) NOT NULL DEFAULT '0' AFTER `digital`;

UPDATE `business_settings` SET `value` = '5.1' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
