INSERT INTO `permissions` (`id`, `name`, `section`, `guard_name`, `created_at`, `updated_at`) VALUES
(NULL, 'view_all_product_conversations', 'support', 'web', '2022-06-22 06:20:16', '2022-06-22 06:20:16'),
(NULL, 'reply_to_product_conversations', 'support', 'web', '2022-06-22 06:20:16', '2022-06-22 06:20:16'),
(NULL, 'delete_product_conversations', 'support', 'web', '2022-06-22 06:20:16', '2022-06-22 06:20:16');

DELETE FROM `permissions` WHERE `name`='delete_product_queries';

UPDATE `business_settings` SET `value` = '6.3.1' WHERE `business_settings`.`type` = 'current_version';

COMMIT;