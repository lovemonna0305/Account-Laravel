DROP TABLE `customers`;

UPDATE `carts` SET `shipping_cost`=0.00 WHERE shipping_cost is null;
UPDATE `products` SET `shipping_cost`=0.00 WHERE shipping_cost is null;

ALTER TABLE `products` CHANGE `shipping_cost` `shipping_cost` DOUBLE(20,2) NOT NULL DEFAULT '0.00';
ALTER TABLE `carts` CHANGE `shipping_cost` `shipping_cost` DOUBLE(20,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `shops` 
ADD `rating` double(3,2) NOT NULL DEFAULT 0.00 AFTER `address`,
ADD `num_of_reviews` int(11) NOT NULL DEFAULT 0 AFTER `rating`,
ADD `num_of_sale` int(11) NOT NULL DEFAULT 0 AFTER `num_of_reviews`,
ADD `seller_package_id` int(11) DEFAULT NULL AFTER `num_of_sale`,
ADD `product_upload_limit` int(11) NOT NULL DEFAULT 0 AFTER `seller_package_id`,
ADD `package_invalid_at` date DEFAULT NULL AFTER `product_upload_limit`,
ADD `verification_status` int(1) NOT NULL DEFAULT 0 AFTER `package_invalid_at`,
ADD `verification_info` longtext COLLATE utf8_unicode_ci DEFAULT NULL AFTER `verification_status`,
ADD `cash_on_delivery_status` int(1) NOT NULL DEFAULT 0 AFTER `verification_info`,
ADD `admin_to_pay` double(20,2) NOT NULL DEFAULT 0.00 AFTER `cash_on_delivery_status`,
ADD `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL AFTER `delivery_pickup_longitude`,
ADD `bank_acc_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL AFTER `bank_name`,
ADD `bank_acc_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL AFTER `bank_acc_name`,
ADD `bank_routing_no` int(50) DEFAULT NULL AFTER `bank_acc_no`,
ADD `bank_payment_status` int(11) NOT NULL DEFAULT 0 AFTER `bank_routing_no`;

ALTER TABLE `products` CHANGE `cash_on_delivery` `cash_on_delivery` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '1 = On, 0 = Off'; 

INSERT INTO `business_settings` (`id`, `type`, `value`, `lang`, `created_at`, `updated_at`) 
VALUES 
(NULL, 'min_order_amount_check_activation', NULL, NULL, current_timestamp(), current_timestamp()),
(NULL, 'minimum_order_amount', NULL, NULL, current_timestamp(), current_timestamp());

UPDATE `business_settings` SET `value` = '6.0' WHERE `business_settings`.`type` = 'current_version';


COMMIT;