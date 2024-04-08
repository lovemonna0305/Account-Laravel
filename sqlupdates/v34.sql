INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'ngenius', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

UPDATE `business_settings` SET `value` = '3.4' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
