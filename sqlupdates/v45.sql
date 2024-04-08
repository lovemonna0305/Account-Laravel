ALTER TABLE `products` CHANGE `purchase_price` `purchase_price` DOUBLE(20,2) NULL DEFAULT NULL;
ALTER TABLE `product_stocks` CHANGE `variant` `variant` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `products` DROP `subcategory_id`, DROP `subsubcategory_id`;

ALTER TABLE `carts` ADD `shipping_type` VARCHAR(30) NOT NULL DEFAULT '' AFTER `shipping_cost`;
ALTER TABLE `carts` ADD `pickup_point` INT(11) NULL DEFAULT NULL AFTER `shipping_type`;
ALTER TABLE `seller_withdraw_requests` CHANGE `message` `message` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `carts` ADD `temp_user_id` VARCHAR(255) NULL DEFAULT NULL AFTER `user_id`;

UPDATE `business_settings` SET `value` = '4.5' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
