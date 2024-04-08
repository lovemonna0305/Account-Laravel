ALTER TABLE `products` ADD INDEX(`unit_price`);

ALTER TABLE `products` ADD INDEX(`created_at`);

ALTER TABLE `products` CHANGE `tags` `tags` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `shops` ADD `delivery_pickup_latitude` FLOAT NULL DEFAULT NULL AFTER `shipping_cost`, 
ADD `delivery_pickup_longitude` FLOAT NULL DEFAULT NULL AFTER `delivery_pickup_latitude`;

ALTER TABLE `sellers` ADD `rating` DOUBLE(3,2) NOT NULL DEFAULT '0' AFTER `user_id`;
ALTER TABLE `sellers` ADD `num_of_sale` INT NOT NULL DEFAULT '0' AFTER `rating`;
ALTER TABLE `sellers` ADD `num_of_reviews` INT NOT NULL DEFAULT '0' AFTER `rating`;

ALTER TABLE `addons` ADD `purchase_code` VARCHAR(255) NULL DEFAULT NULL AFTER `image`;

UPDATE `business_settings` SET `value` = '5.3' WHERE `business_settings`.`type` = 'current_version';

COMMIT;