ALTER TABLE `reviews` ADD `photos` VARCHAR(191) NULL DEFAULT NULL AFTER `comment`;

CREATE TABLE `follow_sellers` (
  `user_id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `categories` ADD `cover_image` VARCHAR(100) NULL DEFAULT NULL AFTER `icon`;

ALTER TABLE `shops` ADD `top_banner` VARCHAR(191) NULL DEFAULT NULL AFTER `sliders`, 
                    ADD `banner_full_width_1` VARCHAR(191) NULL DEFAULT NULL AFTER `top_banner`, 
                    ADD `banners_half_width` VARCHAR(191) NULL DEFAULT NULL AFTER `banner_full_width_1`, 
                    ADD `banner_full_width_2` VARCHAR(191) NULL DEFAULT NULL AFTER `banners_half_width`;

UPDATE `business_settings` SET `value` = '7.0.0' WHERE `business_settings`.`type` = 'current_version';

COMMIT;