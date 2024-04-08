INSERT INTO `business_settings` (`id`, `type`, `value`, `lang`, `created_at`, `updated_at`) VALUES (NULL, 'authorizenet_sandbox', '1', NULL, '2021-02-16 08:43:11', '2021-06-14 11:00:23'); 
ALTER TABLE `users` ADD `state` VARCHAR(30) NULL DEFAULT NULL AFTER `country`;

UPDATE `business_settings` SET `value` = '5.4.5' WHERE `business_settings`.`type` = 'current_version';

COMMIT;