INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'payhere_sandbox', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'payhere', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

UPDATE `business_settings` SET `value` = '3.1' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
