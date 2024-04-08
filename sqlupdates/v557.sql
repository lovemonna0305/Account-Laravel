ALTER TABLE `languages` ADD `status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `rtl`; 

UPDATE `business_settings` SET `value` = '5.5.7' WHERE `business_settings`.`type` = 'current_version';

COMMIT;
