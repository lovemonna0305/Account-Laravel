ALTER TABLE `users` ADD `banned` TINYINT NOT NULL DEFAULT '0' AFTER `balance`;

ALTER TABLE `general_settings` ADD `footer_logo` VARCHAR(255) NULL DEFAULT NULL AFTER `logo`;

CREATE TABLE `customer_package_payments` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `customer_package_id` int(11) NOT NULL,
    `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
    `approval` int(1) NOT NULL,
    `offline_payment` int(1) NOT NULL COMMENT '1=offline payment\r\n2=online paymnet',
    `reciept` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `customer_package_payments`
ADD PRIMARY KEY (`id`);

ALTER TABLE `customer_package_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

UPDATE `business_settings` SET `value` = '3.3' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
