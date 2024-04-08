INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'iyzico_sandbox', '1', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'iyzico', '1', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'decimal_separator', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE `page_translations` CHANGE `content` `content` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

UPDATE `business_settings` SET `value` = '3.8' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
