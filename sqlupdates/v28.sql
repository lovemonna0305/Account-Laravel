ALTER TABLE `order_details` ADD `product_referral_code` VARCHAR(255) NULL DEFAULT NULL AFTER `pickup_point_id`;

ALTER TABLE `categories` ADD `digital` INT(1) NOT NULL DEFAULT '0' AFTER `top`;

ALTER TABLE `products` ADD `digital` INT(1) NOT NULL DEFAULT '0' AFTER `barcode`, ADD `file_name` VARCHAR(255) NULL DEFAULT NULL AFTER `digital`, ADD `file_path` VARCHAR(255) NULL DEFAULT NULL AFTER `file_name`;

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'pos_activation_for_seller', '1', current_timestamp(), current_timestamp());

UPDATE `business_settings` SET `value` = '2.8' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
