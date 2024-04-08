UPDATE `business_settings` SET `value` = '1.5' WHERE `business_settings`.`type` = 'current_version';

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'instamojo_payment', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP), (NULL, 'instamojo_sandbox', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP), (NULL, 'razorpay', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE `sellers` ADD `instamojo_status` INT(1) NOT NULL DEFAULT '0' AFTER `stripe_secret`, ADD `instamojo_api_key` VARCHAR(255) NULL DEFAULT NULL AFTER `instamojo_status`, ADD `instamojo_token` VARCHAR(255) NULL DEFAULT NULL AFTER `instamojo_api_key`, ADD `razorpay_status` INT(1) NOT NULL DEFAULT '0' AFTER `instamojo_token`, ADD `razorpay_api_key` VARCHAR(255) NULL DEFAULT NULL AFTER `razorpay_status`, ADD `razorpay_secret` VARCHAR(255) NULL DEFAULT NULL AFTER `razorpay_api_key`;
