ALTER TABLE `orders` ADD `seller_id` INT(11) NULL DEFAULT NULL AFTER `guest_id`;
ALTER TABLE `orders` ADD `delivery_status` VARCHAR(20) NULL DEFAULT 'pending' AFTER `shipping_address`;
ALTER TABLE `categories` ADD `order_level` INT(11) NOT NULL DEFAULT '0' AFTER `name`;
ALTER TABLE `products` ADD `is_quantity_multiplied` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '1 = Mutiplied with shipping cost' AFTER `shipping_cost`;

UPDATE `business_settings` SET `value` = '4.2' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
