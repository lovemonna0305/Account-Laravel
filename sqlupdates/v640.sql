ALTER TABLE `shops` CHANGE `delivery_pickup_latitude` `delivery_pickup_latitude` FLOAT(17,15) NULL DEFAULT NULL, CHANGE `delivery_pickup_longitude` `delivery_pickup_longitude` FLOAT(17,15) NULL DEFAULT NULL;
ALTER TABLE `addresses` CHANGE `longitude` `longitude` FLOAT(17,15) NULL DEFAULT NULL, CHANGE `latitude` `latitude` FLOAT(17,15) NULL DEFAULT NULL;
ALTER TABLE `users` ADD `provider` VARCHAR(255) NULL DEFAULT NULL AFTER `referred_by`;
ALTER TABLE `users` ADD `refresh_token` TEXT NULL DEFAULT NULL AFTER `provider_id`, ADD `access_token` LONGTEXT NULL DEFAULT NULL AFTER `refresh_token`;

UPDATE `business_settings` SET `value` = '6.4.0' WHERE `business_settings`.`type` = 'current_version';

COMMIT;