UPDATE `business_settings` SET `value` = '5.0' WHERE `business_settings`.`type` = 'current_version';

CREATE TABLE `firebase_notifications` (
  `id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `firebase_notification`
--
ALTER TABLE `firebase_notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `firebase_notification`
--
ALTER TABLE `firebase_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `firebase_notifications` CHANGE `is_read` `is_read` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `firebase_notifications` ADD `title` VARCHAR(255) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `firebase_notifications` ADD `text` TEXT NULL DEFAULT NULL AFTER `title`;

COMMIT;
