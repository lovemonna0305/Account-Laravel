ALTER TABLE `order_details` ADD `earn_point` DOUBLE(25,2) NOT NULL DEFAULT '0.00' AFTER `product_referral_code`;

UPDATE `business_settings` SET `value` = '6.5.0' WHERE `business_settings`.`type` = 'current_version';

COMMIT;