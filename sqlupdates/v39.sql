ALTER TABLE `categories` ADD INDEX(`slug`);

ALTER TABLE `products` ADD INDEX(`name`);

ALTER TABLE `products` CHANGE `tags` `tags` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `products` ADD INDEX(`tags`);

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'nagad', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'bkash', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'bkash_sandbox', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `city_translations` (
    `id` int(11) NOT NULL,
    `city_id` int(11) NOT NULL,
    `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `lang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `city_translations`
    ADD PRIMARY KEY (`id`);
ALTER TABLE `city_translations`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products` ADD `seller_featured` INT NOT NULL DEFAULT '0' AFTER `featured`;

UPDATE `business_settings` SET `value` = '3.9' WHERE `business_settings`.`type` = 'current_version';

ALTER TABLE `sellers` ADD UNIQUE(`user_id`);

COMMIT;
