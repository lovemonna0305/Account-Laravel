CREATE TABLE `attribute_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `attribute_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `attribute_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


ALTER TABLE `coupons` ADD `user_id` INT NOT NULL AFTER `id`;
ALTER TABLE `carts` CHANGE `coupon_code` `coupon_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `carts` CHANGE `price` `price` DOUBLE(20,2) NULL DEFAULT '0.00';
ALTER TABLE `carts` CHANGE `tax` `tax` DOUBLE(20,2) NULL DEFAULT '0.00';
ALTER TABLE `carts` CHANGE `shipping_cost` `shipping_cost` DOUBLE(20,2) NULL DEFAULT '0.00';

CREATE TABLE `combined_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shipping_address` text COLLATE utf8_unicode_ci,
  `grand_total` double(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `combined_orders`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `combined_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `orders` ADD `combined_order_id` INT NULL DEFAULT NULL AFTER `id`;

UPDATE `business_settings` SET `value` = '5.2' WHERE `business_settings`.`type` = 'current_version';

COMMIT;