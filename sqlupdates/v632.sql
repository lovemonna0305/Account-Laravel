ALTER TABLE `carrier_ranges` CHANGE `delimiter1` `delimiter1` DOUBLE(25,2) NOT NULL, CHANGE `delimiter2` `delimiter2` DOUBLE(25,2) NOT NULL;
INSERT INTO `business_settings` (`id`, `type`, `value`, `lang`, `created_at`, `updated_at`) VALUES (NULL, 'item_name', 'eCommerce', NULL, '2022-04-17 12:57:17', '2022-04-17 12:57:17');


UPDATE `business_settings` SET `value` = '6.3.2' WHERE `business_settings`.`type` = 'current_version';

COMMIT;