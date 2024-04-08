UPDATE `business_settings` SET `value` = '1.8' WHERE `business_settings`.`type` = 'current_version';

 CREATE TABLE `conversations`
 ( `id` int(11) NOT NULL,
    `sender_id` int(11) NOT NULL,
    `receiver_id` int(11) NOT NULL,
    `title` varchar(1000) COLLATE utf32_unicode_ci DEFAULT NULL,
    `sender_viewed` int(11) NOT NULL DEFAULT 1,
    `receiver_viewed` int(11) NOT NULL DEFAULT 0,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

ALTER TABLE `conversations` ADD PRIMARY KEY (`id`);

ALTER TABLE `conversations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

 CREATE TABLE `messages`
( `id` int(11) NOT NULL,
    `conversation_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `message` text COLLATE utf32_unicode_ci DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

ALTER TABLE `messages` ADD PRIMARY KEY (`id`);

ALTER TABLE `messages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `categories` ADD `commision_rate` FLOAT(8,2) NOT NULL DEFAULT 0 AFTER `name`;

ALTER TABLE `sliders` ADD `link` VARCHAR(255) NULL DEFAULT NULL AFTER `published`;

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'category_wise_commission', '0', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'conversation_system', '0', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'guest_checkout_active', '1', current_timestamp(), current_timestamp());

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'facebook_pixel', '0', current_timestamp(), current_timestamp());
