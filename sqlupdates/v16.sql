UPDATE `business_settings` SET `value` = '1.6' WHERE `business_settings`.`type` = 'current_version';

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'paystack', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE `sellers` ADD `paystack_status` INT(1) NOT NULL DEFAULT '0' AFTER `razorpay_secret`, ADD `paystack_public_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_status`, ADD `paystack_secret_key` VARCHAR(255) NULL DEFAULT NULL AFTER `paystack_public_key`;

ALTER TABLE `tickets` ADD `files` TEXT NULL DEFAULT NULL AFTER `details`, ADD `status` VARCHAR(10) NOT NULL DEFAULT 'pending' AFTER `files`;

ALTER TABLE `tickets` ADD `code` INT(6) NOT NULL AFTER `id`;

ALTER TABLE `ticket_replies` ADD `files` TEXT NULL DEFAULT NULL AFTER `reply`;

ALTER TABLE `brands` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `top`, ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `slug`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_title`;

ALTER TABLE `categories` CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `categories` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `top`, ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `slug`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_title`;

ALTER TABLE `sub_categories` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `category_id`, ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `slug`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_title`;

ALTER TABLE `sub_sub_categories` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `brands`, ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `slug`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_title`;

ALTER TABLE `shops` ADD `meta_title` VARCHAR(255) NULL DEFAULT NULL AFTER `slug`, ADD `meta_description` TEXT NULL DEFAULT NULL AFTER `meta_title`;
