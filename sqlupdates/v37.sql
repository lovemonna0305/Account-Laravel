ALTER TABLE `categories` ADD `parent_id` INT NULL DEFAULT '0' AFTER `id`;

ALTER TABLE `categories` ADD `level` INT NOT NULL DEFAULT '0' AFTER `parent_id`;

ALTER TABLE `products` CHANGE `subcategory_id` `subcategory_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `product_translations` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

UPDATE `business_settings` SET `value` = '3.7' WHERE `business_settings`.`type` = 'current_version';

INSERT INTO `business_settings` (`type`, `value`, `created_at`, `updated_at`) VALUES ('payfast', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP), ('payfast_sandbox', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

COMMIT;
