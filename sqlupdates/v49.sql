UPDATE `business_settings` SET `value` = '4.9' WHERE `business_settings`.`type` = 'current_version';

ALTER TABLE `addresses` ADD `longitude` FLOAT NULL AFTER `city`, ADD `latitude` FLOAT NULL AFTER `longitude`;
ALTER TABLE `users` ADD `device_token` VARCHAR(255) NULL DEFAULT NULL AFTER `remember_token`;
ALTER TABLE `carts` ADD `product_referral_code` VARCHAR(255) NULL DEFAULT NULL AFTER `discount`;
ALTER TABLE `products` ADD `approved` TINYINT(1) NOT NULL DEFAULT '1' AFTER `published`;
ALTER TABLE `business_settings` ADD `lang` varchar(30) DEFAULT NULL AFTER `value`;

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'google_map', '0', current_timestamp(), current_timestamp());
INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'google_firebase', '0', current_timestamp(), current_timestamp());
--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

COMMIT;
