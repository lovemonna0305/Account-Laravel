ALTER TABLE `pages` CHANGE `content` `content` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'google_recaptcha', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE `users` ADD `new_email_verificiation_code` TEXT NULL DEFAULT NULL AFTER `email_verified_at`;

ALTER TABLE `products` ADD `min_qty` INT NOT NULL DEFAULT '1' AFTER `unit`;

UPDATE `business_settings` SET `value` = '3.2' WHERE `business_settings`.`type` = 'current_version';

ALTER TABLE `users` ADD COLUMN `verification_code` TEXT NULL DEFAULT NULL AFTER `email_verified_at`;

ALTER TABLE `users` CHANGE `verification_code` `verification_code` TEXT NULL DEFAULT NULL;

COMMIT;
