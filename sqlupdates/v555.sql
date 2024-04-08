ALTER TABLE `orders` ADD `shipping_type` VARCHAR(50) NOT NULL AFTER `shipping_address`, ADD `pickup_point_id` INT(11) NOT NULL DEFAULT '0' AFTER `shipping_type`; 

ALTER TABLE `transactions` ADD `status` INT(1) NOT NULL DEFAULT '0' AFTER `mpesa_receipt`;

UPDATE `business_settings` SET `value` = '5.5.5' WHERE `business_settings`.`type` = 'current_version';

COMMIT;