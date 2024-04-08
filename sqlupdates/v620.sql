ALTER TABLE `products` ADD `weight` DOUBLE(8,2) NOT NULL DEFAULT '0.00' AFTER `unit`;
ALTER TABLE `carts` ADD `carrier_id` INT NULL AFTER `pickup_point`;
ALTER TABLE `orders` ADD `carrier_id` INT NULL AFTER `pickup_point_id`;

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Inactive, 1 = Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `countries` ADD `zone_id` INT(11) NOT NULL DEFAULT '0' AFTER `name`;



--
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` int(11) DEFAULT NULL,
  `transit_time` varchar(255) NOT NULL,
  `free_shipping` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


-- Carrier Ranges
CREATE TABLE `carrier_ranges` (
  `id` int(11) NOT NULL,
  `carrier_id` int(11) NOT NULL,
  `billing_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `delimiter1` int(11) NOT NULL,
  `delimiter2` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `carrier_ranges`
--

ALTER TABLE `carrier_ranges`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for table `carrier_ranges`
--
ALTER TABLE `carrier_ranges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Carrier Range Prices
CREATE TABLE `carrier_range_prices` (
  `id` int(11) NOT NULL,
  `carrier_id` int(11) NOT NULL,
  `carrier_range_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `carrier_range_prices`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `carrier_range_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

UPDATE `business_settings` SET `value` = '6.2.0' WHERE `business_settings`.`type` = 'current_version';

COMMIT;