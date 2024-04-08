ALTER TABLE `products` CHANGE `brand_id` `brand_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `products` CHANGE `subsubcategory_id` `subsubcategory_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `orders` ADD `commission_calculated` INT NOT NULL DEFAULT '0' AFTER `payment_status_viewed`;

UPDATE `business_settings` SET `value` = '2.4' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
