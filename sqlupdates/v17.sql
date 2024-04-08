UPDATE `business_settings` SET `value` = '1.7' WHERE `business_settings`.`type` = 'current_version';

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'pickup_point', '0', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'maintenance_mode', '0', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'voguepay', '0', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'voguepay_sandbox', '0', current_timestamp(), current_timestamp());

CREATE TABLE `pickup_points` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pick_up_status` int(1) DEFAULT NULL,
  `cash_on_pickup_status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `pickup_points` ADD PRIMARY KEY (`id`);

ALTER TABLE `pickup_points` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tickets` ADD `client_viewed` INT(1) NOT NULL DEFAULT '0' AFTER `viewed`;

ALTER TABLE `sellers` ADD `voguepay_status` INT(1) NOT NULL DEFAULT '0' AFTER `paystack_secret_key`;

ALTER TABLE `sellers` ADD `voguepay_merchand_id` VARCHAR(255) NULL DEFAULT NULL AFTER `voguepay_status`;

CREATE TABLE `seller_withdraw_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `viewed` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `seller_withdraw_requests` ADD PRIMARY KEY (`id`);

ALTER TABLE `seller_withdraw_requests` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reviews` ADD `viewed` INT(1) NOT NULL DEFAULT '0' AFTER `status`;

ALTER TABLE `orders` ADD `delivery_viewed` INT(1) NOT NULL DEFAULT '0' AFTER `viewed`;

ALTER TABLE `orders` ADD `payment_status_viewed` INT(1) NULL DEFAULT '0' AFTER `delivery_viewed`;

ALTER TABLE `order_details` ADD `shipping_type` VARCHAR(255) NULL DEFAULT NULL AFTER `delivery_status`;

ALTER TABLE `order_details` ADD `pickup_point_id` INT(11) NULL DEFAULT NULL AFTER `shipping_type`;
