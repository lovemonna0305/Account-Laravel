DROP TABLE `roles`;

-- roles
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-06-13 06:29:58', '2022-06-12 18:00:00');

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- permissions
CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `section`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add_new_product', 'product', 'web', '2022-06-12 15:31:31', '2022-06-12 15:31:31'),
(2, 'show_all_products', 'product', 'web', '2022-06-12 15:32:34', '2022-06-12 15:32:34'),
(3, 'show_in_house_products', 'product', 'web', '2022-06-12 15:33:08', '2022-06-12 15:33:08'),
(4, 'show_seller_products', 'product', 'web', '2022-06-12 15:33:40', '2022-06-12 15:33:40'),
(5, 'product_edit', 'product', 'web', '2022-06-13 19:50:06', '2022-06-13 19:50:06'),
(6, 'product_duplicate', 'product', 'web', '2022-06-13 21:24:20', '2022-06-13 21:24:20'),
(7, 'product_delete', 'product', 'web', '2022-06-13 21:24:47', '2022-06-13 21:24:47'),
(8, 'show_digital_products', 'product', 'web', '2022-06-13 22:48:13', '2022-06-13 22:48:13'),
(9, 'add_digital_product', 'product', 'web', '2022-06-13 22:48:28', '2022-06-13 22:48:28'),
(10, 'edit_digital_product', 'product', 'web', '2022-06-13 22:48:40', '2022-06-13 22:48:40'),
(11, 'delete_digital_product', 'product', 'web', '2022-06-13 22:48:47', '2022-06-13 22:48:47'),
(12, 'download_digital_product', 'product', 'web', '2022-06-13 22:48:57', '2022-06-13 22:48:57'),
(13, 'product_bulk_import', 'product', 'web', '2022-06-14 00:18:52', '2022-06-14 00:18:52'),
(14, 'product_bulk_export', 'product', 'web', '2022-06-14 00:19:19', '2022-06-14 00:19:19'),
(15, 'view_product_categories', 'product_category', 'web', '2022-06-14 00:24:33', '2022-06-14 00:24:33'),
(16, 'add_product_category', 'product_category', 'web', '2022-06-14 00:25:56', '2022-06-14 00:25:56'),
(17, 'edit_product_category', 'product_category', 'web', '2022-06-14 00:26:17', '2022-06-14 00:26:17'),
(18, 'delete_product_category', 'product_category', 'web', '2022-06-14 00:26:42', '2022-06-14 00:26:42'),
(19, 'view_all_brands', 'brand', 'web', '2022-06-14 17:31:46', '2022-06-14 17:31:46'),
(20, 'add_brand', 'brand', 'web', '2022-06-14 17:32:08', '2022-06-14 17:32:08'),
(21, 'edit_brand', 'brand', 'web', '2022-06-14 17:32:16', '2022-06-14 17:32:16'),
(22, 'delete_brand', 'brand', 'web', '2022-06-14 17:32:25', '2022-06-14 17:32:25'),
(23, 'view_product_attributes', 'product_attribute', 'web', '2022-06-14 17:34:47', '2022-06-14 17:34:47'),
(24, 'add_product_attribute', 'product_attribute', 'web', '2022-06-14 17:35:20', '2022-06-14 17:35:20'),
(25, 'edit_product_attribute', 'product_attribute', 'web', '2022-06-14 17:35:26', '2022-06-14 17:35:26'),
(26, 'delete_product_attribute', 'product_attribute', 'web', '2022-06-14 17:35:33', '2022-06-14 17:35:33'),
(27, 'view_product_attribute_values', 'product_attribute', 'web', '2022-06-14 17:38:12', '2022-06-14 17:38:12'),
(28, 'add_product_attribute_values', 'product_attribute', 'web', '2022-06-14 17:38:20', '2022-06-14 17:38:20'),
(29, 'edit_product_attribute_value', 'product_attribute', 'web', '2022-06-14 17:38:50', '2022-06-14 17:38:50'),
(30, 'delete_product_attribute_value', 'product_attribute', 'web', '2022-06-14 17:39:06', '2022-06-14 17:39:06'),
(31, 'view_colors', 'product_attribute', 'web', '2022-06-14 17:44:16', '2022-06-14 17:44:16'),
(32, 'add_color', 'product_attribute', 'web', '2022-06-14 17:44:41', '2022-06-14 17:44:41'),
(33, 'edit_color', 'product_attribute', 'web', '2022-06-14 17:44:50', '2022-06-14 17:44:50'),
(34, 'delete_color', 'product_attribute', 'web', '2022-06-14 17:44:59', '2022-06-14 17:44:59'),
(35, 'view_product_reviews', 'product_review', 'web', '2022-06-14 17:55:04', '2022-06-14 17:55:04'),
(36, 'publish_product_review', 'product_review', 'web', '2022-06-14 17:57:37', '2022-06-14 17:57:37'),
(37, 'view_all_orders', 'sale', 'web', '2022-06-14 23:49:04', '2022-06-14 23:49:04'),
(38, 'view_inhouse_orders', 'sale', 'web', '2022-06-14 23:49:30', '2022-06-14 23:49:30'),
(39, 'view_seller_orders', 'sale', 'web', '2022-06-14 23:50:06', '2022-06-14 23:50:06'),
(40, 'view_pickup_point_orders', 'sale', 'web', '2022-06-14 23:51:17', '2022-06-14 23:51:17'),
(41, 'view_order_details', 'sale', 'web', '2022-06-14 23:53:13', '2022-06-14 23:53:13'),
(42, 'update_order_payment_status', 'sale', 'web', '2022-06-14 23:53:55', '2022-06-14 23:53:55'),
(43, 'update_order_delivery_status', 'sale', 'web', '2022-06-14 23:54:02', '2022-06-14 23:54:02'),
(44, 'delete_order', 'sale', 'web', '2022-06-14 23:55:02', '2022-06-14 23:55:02'),
(45, 'view_all_customers', 'customer', 'web', '2022-06-14 23:59:28', '2022-06-14 23:59:28'),
(46, 'login_as_customer', 'customer', 'web', '2022-06-14 23:59:58', '2022-06-14 23:59:58'),
(47, 'ban_customer', 'customer', 'web', '2022-06-15 00:00:12', '2022-06-15 00:00:12'),
(48, 'delete_customer', 'customer', 'web', '2022-06-15 00:00:45', '2022-06-15 00:00:45'),
(49, 'view_classified_products', 'customer', 'web', '2022-06-15 00:02:38', '2022-06-15 00:02:38'),
(50, 'publish_classified_product', 'customer', 'web', '2022-06-15 00:06:23', '2022-06-15 00:06:23'),
(51, 'delete_classified_product', 'customer', 'web', '2022-06-15 00:06:39', '2022-06-15 00:06:39'),
(52, 'view_classified_packages', 'customer', 'web', '2022-06-15 00:08:11', '2022-06-15 00:08:11'),
(53, 'add_classified_package', 'customer', 'web', '2022-06-15 00:08:22', '2022-06-15 00:08:22'),
(54, 'edit_classified_package', 'customer', 'web', '2022-06-15 00:08:35', '2022-06-15 00:08:35'),
(55, 'delete_classified_package', 'customer', 'web', '2022-06-15 00:08:44', '2022-06-15 00:08:44'),
(56, 'view_all_seller', 'seller', 'web', '2022-06-15 18:49:56', '2022-06-15 18:49:56'),
(57, 'view_seller_profile', 'seller', 'web', '2022-06-15 18:58:07', '2022-06-15 18:58:07'),
(58, 'login_as_seller', 'seller', 'web', '2022-06-15 18:58:22', '2022-06-15 18:58:22'),
(59, 'pay_to_seller', 'seller', 'web', '2022-06-15 20:21:28', '2022-06-15 20:21:28'),
(60, 'seller_payment_history', 'seller', 'web', '2022-06-15 20:22:14', '2022-06-15 20:22:14'),
(61, 'edit_seller', 'seller', 'web', '2022-06-15 20:22:28', '2022-06-15 20:22:28'),
(62, 'delete_seller', 'seller', 'web', '2022-06-15 20:22:37', '2022-06-15 20:22:37'),
(63, 'ban_seller', 'seller', 'web', '2022-06-15 20:22:48', '2022-06-15 20:22:48'),
(64, 'approve_seller', 'seller', 'web', '2022-06-15 20:24:17', '2022-06-15 20:24:17'),
(65, 'view_seller_payout_requests', 'seller', 'web', '2022-06-15 20:33:37', '2022-06-15 20:33:37'),
(66, 'seller_commission_configuration', 'seller', 'web', '2022-06-15 20:37:18', '2022-06-15 20:37:18'),
(67, 'seller_verification_form_configuration', 'seller', 'web', '2022-06-15 20:38:43', '2022-06-15 20:38:43'),
(68, 'in_house_product_sale_report', 'report', 'web', '2022-06-18 21:43:02', '2022-06-18 21:43:02'),
(69, 'seller_products_sale_report', 'report', 'web', '2022-06-18 21:43:32', '2022-06-18 21:43:32'),
(70, 'products_stock_report', 'report', 'web', '2022-06-18 21:43:51', '2022-06-18 21:43:51'),
(71, 'product_wishlist_report', 'report', 'web', '2022-06-18 21:46:18', '2022-06-18 21:46:18'),
(72, 'user_search_report', 'report', 'web', '2022-06-18 21:46:39', '2022-06-18 21:46:39'),
(73, 'commission_history_report', 'report', 'web', '2022-06-18 21:47:17', '2022-06-18 21:47:17'),
(74, 'wallet_transaction_report', 'report', 'web', '2022-06-18 21:48:00', '2022-06-18 21:48:00'),
(75, 'view_blogs', 'blog', 'web', '2022-06-19 06:08:14', '2022-06-19 06:08:14'),
(76, 'add_blog', 'blog', 'web', '2022-06-19 06:08:43', '2022-06-19 06:08:43'),
(77, 'edit_blog', 'blog', 'web', '2022-06-19 06:08:56', '2022-06-19 06:08:56'),
(78, 'delete_blog', 'blog', 'web', '2022-06-19 06:09:08', '2022-06-19 06:09:08'),
(79, 'publish_blog', 'blog', 'web', '2022-06-19 06:11:09', '2022-06-19 06:11:09'),
(80, 'view_blog_categories', 'blog', 'web', '2022-06-19 06:12:55', '2022-06-19 06:12:55'),
(81, 'add_blog_category', 'blog', 'web', '2022-06-19 06:13:24', '2022-06-19 06:13:24'),
(82, 'edit_blog_category', 'blog', 'web', '2022-06-19 06:13:37', '2022-06-19 06:13:37'),
(83, 'delete_blog_category', 'blog', 'web', '2022-06-19 06:14:06', '2022-06-19 06:14:06'),
(84, 'view_all_flash_deals', 'marketing', 'web', '2022-06-19 07:18:52', '2022-06-19 07:18:52'),
(85, 'add_flash_deal', 'marketing', 'web', '2022-06-19 07:19:22', '2022-06-19 07:19:22'),
(86, 'edit_flash_deal', 'marketing', 'web', '2022-06-19 07:19:32', '2022-06-19 07:19:32'),
(87, 'delete_flash_deal', 'marketing', 'web', '2022-06-19 07:19:44', '2022-06-19 07:19:44'),
(88, 'publish_flash_deal', 'marketing', 'web', '2022-06-19 07:20:45', '2022-06-19 07:20:45'),
(89, 'featured_flash_deal', 'marketing', 'web', '2022-06-19 07:23:07', '2022-06-19 07:23:07'),
(90, 'view_all_coupons', 'marketing', 'web', '2022-06-19 07:23:47', '2022-06-19 07:23:47'),
(91, 'add_coupon', 'marketing', 'web', '2022-06-19 07:24:07', '2022-06-19 07:24:07'),
(92, 'edit_coupon', 'marketing', 'web', '2022-06-19 07:24:24', '2022-06-19 07:24:24'),
(93, 'delete_coupon', 'marketing', 'web', '2022-06-19 07:24:34', '2022-06-19 07:24:34'),
(94, 'send_newsletter', 'marketing', 'web', '2022-06-19 07:25:53', '2022-06-19 07:25:53'),
(95, 'view_all_subscribers', 'marketing', 'web', '2022-06-19 07:32:13', '2022-06-19 07:32:13'),
(96, 'delete_subscriber', 'marketing', 'web', '2022-06-19 07:32:35', '2022-06-19 07:32:35'),
(97, 'view_all_support_tickets', 'support', 'web', '2022-06-19 23:31:53', '2022-06-19 23:31:53'),
(98, 'reply_to_support_tickets', 'support', 'web', '2022-06-19 23:33:13', '2022-06-19 23:33:13'),
(99, 'view_all_product_queries', 'support', 'web', '2022-06-19 23:38:45', '2022-06-19 23:38:45'),
(100, 'reply_to_product_queries', 'support', 'web', '2022-06-19 23:40:02', '2022-06-19 23:40:02'),
(101, 'delete_product_queries', 'support', 'web', '2022-06-19 23:40:48', '2022-06-19 23:40:48'),
(102, 'header_setup', 'website_setup', 'web', '2022-06-19 23:45:24', '2022-06-19 23:45:24'),
(103, 'footer_setup', 'website_setup', 'web', '2022-06-19 23:45:37', '2022-06-19 23:45:37'),
(104, 'website_appearance', 'website_setup', 'web', '2022-06-19 23:46:49', '2022-06-19 23:46:49'),
(105, 'view_all_website_pages', 'website_setup', 'web', '2022-06-19 23:50:04', '2022-06-19 23:50:04'),
(106, 'add_website_page', 'website_setup', 'web', '2022-06-19 23:50:38', '2022-06-19 23:50:38'),
(107, 'edit_website_page', 'website_setup', 'web', '2022-06-19 23:50:47', '2022-06-19 23:50:47'),
(108, 'delete_website_page', 'website_setup', 'web', '2022-06-19 23:52:09', '2022-06-19 23:52:09'),
(109, 'general_settings', 'setup_configurations', 'web', '2022-06-20 00:38:36', '2022-06-20 00:38:36'),
(110, 'features_activation', 'setup_configurations', 'web', '2022-06-20 00:39:42', '2022-06-20 00:39:42'),
(111, 'language_setup', 'setup_configurations', 'web', '2022-06-20 04:13:30', '2022-06-20 04:13:30'),
(112, 'currency_setup', 'setup_configurations', 'web', '2022-06-20 04:14:33', '2022-06-20 04:14:33'),
(113, 'vat_&_tax_setup', 'setup_configurations', 'web', '2022-06-20 04:15:21', '2022-06-20 04:15:21'),
(114, 'pickup_point_setup', 'setup_configurations', 'web', '2022-06-20 04:15:46', '2022-06-20 04:15:46'),
(115, 'smtp_settings', 'setup_configurations', 'web', '2022-06-20 04:16:05', '2022-06-20 04:16:05'),
(116, 'payment_methods_configurations', 'setup_configurations', 'web', '2022-06-20 04:25:27', '2022-06-20 04:25:27'),
(117, 'order_configuration', 'setup_configurations', 'web', '2022-06-20 04:26:26', '2022-06-20 04:26:26'),
(118, 'file_system_&_cache_configuration', 'setup_configurations', 'web', '2022-06-20 04:26:59', '2022-06-20 04:26:59'),
(119, 'social_media_logins', 'setup_configurations', 'web', '2022-06-20 04:27:22', '2022-06-20 04:27:22'),
(120, 'facebook_chat', 'setup_configurations', 'web', '2022-06-20 04:28:31', '2022-06-20 04:28:31'),
(121, 'facebook_comment', 'setup_configurations', 'web', '2022-06-20 04:28:51', '2022-06-20 04:28:51'),
(122, 'analytics_tools_configuration', 'setup_configurations', 'web', '2022-06-20 04:29:57', '2022-06-20 04:29:57'),
(123, 'google_recaptcha_configuration', 'setup_configurations', 'web', '2022-06-20 04:30:55', '2022-06-20 04:30:55'),
(124, 'google_map_setting', 'setup_configurations', 'web', '2022-06-20 04:31:28', '2022-06-20 04:31:28'),
(125, 'google_firebase_setting', 'setup_configurations', 'web', '2022-06-20 04:32:00', '2022-06-20 04:32:00'),
(126, 'shipping_configuration', 'setup_configurations', 'web', '2022-06-20 04:41:29', '2022-06-20 04:41:29'),
(127, 'shipping_country_setting', 'setup_configurations', 'web', '2022-06-20 04:42:14', '2022-06-20 04:42:14'),
(128, 'manage_shipping_states', 'setup_configurations', 'web', '2022-06-20 04:43:43', '2022-06-20 04:43:43'),
(129, 'manage_shipping_cities', 'setup_configurations', 'web', '2022-06-20 04:44:17', '2022-06-20 04:44:17'),
(130, 'view_all_staffs', 'staff', 'web', '2022-06-20 04:45:00', '2022-06-20 04:45:00'),
(131, 'add_staff', 'staff', 'web', '2022-06-20 04:45:09', '2022-06-20 04:45:09'),
(132, 'edit_staff', 'staff', 'web', '2022-06-20 04:45:21', '2022-06-20 04:45:21'),
(133, 'delete_staff', 'staff', 'web', '2022-06-20 04:45:36', '2022-06-20 04:45:36'),
(134, 'view_staff_roles', 'staff', 'web', '2022-06-20 04:46:27', '2022-06-20 04:46:27'),
(135, 'add_staff_role', 'staff', 'web', '2022-06-20 04:53:00', '2022-06-20 04:53:00'),
(136, 'edit_staff_role', 'staff', 'web', '2022-06-20 04:53:11', '2022-06-20 04:53:11'),
(137, 'delete_staff_role', 'staff', 'web', '2022-06-20 04:53:22', '2022-06-20 04:53:22'),
(138, 'system_update', 'system', 'web', '2022-06-20 04:57:15', '2022-06-20 04:57:15'),
(139, 'server_status', 'system', 'web', '2022-06-20 04:57:58', '2022-06-20 04:57:58'),
(140, 'manage_addons', 'system', 'web', '2022-06-20 05:15:43', '2022-06-20 05:15:43'),
(141, 'admin_dashboard', 'system', 'web', '2022-06-21 00:26:52', '2022-06-21 00:26:52'),
(142, 'pos_manager', 'pos_system', 'web', '2022-06-21 01:46:20', '2022-06-21 01:46:20'),
(143, 'pos_configuration', 'pos_system', 'web', '2022-06-21 01:56:00', '2022-06-21 01:56:00'),
(144, 'view_all_auction_products', 'auction', 'web', '2022-06-21 02:05:54', '2022-06-21 02:05:54'),
(145, 'view_inhouse_auction_products', 'auction', 'web', '2022-06-21 02:09:29', '2022-06-21 02:09:29'),
(146, 'view_seller_auction_products', 'auction', 'web', '2022-06-21 02:09:51', '2022-06-21 02:09:51'),
(147, 'add_auction_product', 'auction', 'web', '2022-06-21 02:11:19', '2022-06-21 02:11:19'),
(148, 'edit_auction_product', 'auction', 'web', '2022-06-21 02:12:57', '2022-06-21 02:12:57'),
(149, 'delete_auction_product', 'auction', 'web', '2022-06-21 02:17:35', '2022-06-21 02:17:35'),
(150, 'view_auction_product_bids', 'auction', 'web', '2022-06-21 02:25:29', '2022-06-21 02:25:29'),
(151, 'delete_auction_product_bids', 'auction', 'web', '2022-06-21 02:33:55', '2022-06-21 02:33:55'),
(152, 'view_auction_product_orders', 'auction', 'web', '2022-06-21 02:44:11', '2022-06-21 02:44:11'),
(153, 'view_all_wholesale_products', 'wholesale', 'web', '2022-06-21 04:06:26', '2022-06-21 04:06:26'),
(154, 'view_inhouse_wholesale_products', 'wholesale', 'web', '2022-06-21 04:09:18', '2022-06-21 04:09:18'),
(155, 'view_sellers_wholesale_products', 'wholesale', 'web', '2022-06-21 04:09:48', '2022-06-21 04:09:48'),
(156, 'add_wholesale_product', 'wholesale', 'web', '2022-06-21 04:56:35', '2022-06-21 04:56:35'),
(157, 'edit_wholesale_product', 'wholesale', 'web', '2022-06-21 04:56:55', '2022-06-21 04:56:55'),
(158, 'delete_wholesale_product', 'wholesale', 'web', '2022-06-21 04:57:07', '2022-06-21 04:57:07'),
(159, 'view_all_delivery_boy', 'delivery_boy', 'web', '2022-06-21 05:41:57', '2022-06-21 05:41:57'),
(160, 'add_delivery_boy', 'delivery_boy', 'web', '2022-06-21 05:43:13', '2022-06-21 05:43:13'),
(161, 'edit_delivery_boy', 'delivery_boy', 'web', '2022-06-21 05:43:32', '2022-06-21 05:43:32'),
(162, 'ban_delivery_boy', 'delivery_boy', 'web', '2022-06-22 00:55:57', '2022-06-22 00:55:57'),
(163, 'collect_from_delivery_boy', 'delivery_boy', 'web', '2022-06-22 00:58:23', '2022-06-22 00:58:23'),
(164, 'pay_to_delivery_boy', 'delivery_boy', 'web', '2022-06-22 00:58:35', '2022-06-22 00:58:35'),
(165, 'delivery_boy_payment_history', 'delivery_boy', 'web', '2022-06-22 01:38:43', '2022-06-22 01:38:43'),
(166, 'collected_histories_from_delivery_boy', 'delivery_boy', 'web', '2022-06-22 01:40:04', '2022-06-22 01:40:04'),
(167, 'order_cancle_request_by_delivery_boy', 'delivery_boy', 'web', '2022-06-22 02:06:37', '2022-06-22 02:06:37'),
(168, 'delivery_boy_configuration', 'delivery_boy', 'web', '2022-06-22 02:07:07', '2022-06-22 02:07:07'),
(169, 'view_refund_requests', 'refund_request', 'web', '2022-06-22 02:21:11', '2022-06-22 02:21:11'),
(170, 'accept_refund_request', 'refund_request', 'web', '2022-06-22 02:21:55', '2022-06-22 02:21:55'),
(171, 'reject_refund_request', 'refund_request', 'web', '2022-06-22 02:23:20', '2022-06-22 02:23:20'),
(172, 'view_approved_refund_requests', 'refund_request', 'web', '2022-06-22 02:24:09', '2022-06-22 02:24:09'),
(173, 'view_rejected_refund_requests', 'refund_request', 'web', '2022-06-22 02:33:40', '2022-06-22 02:33:40'),
(174, 'refund_request_configuration', 'refund_request', 'web', '2022-06-22 02:34:21', '2022-06-22 02:34:21'),
(175, 'affiliate_registration_form_config', 'affiliate_system', 'web', '2022-06-22 04:52:18', '2022-06-22 04:52:18'),
(176, 'affiliate_configurations', 'affiliate_system', 'web', '2022-06-22 04:52:35', '2022-06-22 04:52:35'),
(177, 'view_affiliate_users', 'affiliate_system', 'web', '2022-06-22 04:53:19', '2022-06-22 04:53:19'),
(178, 'pay_to_affiliate_user', 'affiliate_system', 'web', '2022-06-22 04:54:49', '2022-06-22 04:54:49'),
(179, 'affiliate_users_payment_history', 'affiliate_system', 'web', '2022-06-22 04:55:51', '2022-06-22 04:55:51'),
(180, 'view_all_referral_users', 'affiliate_system', 'web', '2022-06-22 04:56:46', '2022-06-22 04:56:46'),
(181, 'view_affiliate_withdraw_requests', 'affiliate_system', 'web', '2022-06-22 04:58:01', '2022-06-22 04:58:01'),
(182, 'accept_affiliate_withdraw_requests', 'affiliate_system', 'web', '2022-06-22 04:59:38', '2022-06-22 04:59:38'),
(183, 'reject_affiliate_withdraw_request', 'affiliate_system', 'web', '2022-06-22 05:00:04', '2022-06-22 05:00:04'),
(184, 'view_affiliate_logs', 'affiliate_system', 'web', '2022-06-22 05:00:51', '2022-06-22 05:00:51'),
(185, 'view_all_manual_payment_methods', 'offline_payment', 'web', '2022-06-22 05:02:50', '2022-06-22 05:02:50'),
(186, 'add_manual_payment_method', 'offline_payment', 'web', '2022-06-22 05:03:25', '2022-06-22 05:03:25'),
(187, 'edit_manual_payment_method', 'offline_payment', 'web', '2022-06-22 05:03:56', '2022-06-22 05:03:56'),
(188, 'delete_manual_payment_method', 'offline_payment', 'web', '2022-06-22 05:04:10', '2022-06-22 05:04:10'),
(189, 'view_all_offline_wallet_recharges', 'offline_payment', 'web', '2022-06-22 05:09:09', '2022-06-22 05:09:09'),
(190, 'approve_offline_wallet_recharge', 'offline_payment', 'web', '2022-06-22 05:11:29', '2022-06-22 05:11:29'),
(191, 'view_all_offline_customer_package_payments', 'offline_payment', 'web', '2022-06-22 05:12:49', '2022-06-22 05:12:49'),
(192, 'approve_offline_customer_package_payment', 'offline_payment', 'web', '2022-06-22 05:13:24', '2022-06-22 05:13:24'),
(193, 'view_all_offline_seller_package_payments', 'offline_payment', 'web', '2022-06-22 05:14:02', '2022-06-22 05:14:02'),
(194, 'approve_offline_seller_package_payment', 'offline_payment', 'web', '2022-06-22 05:14:29', '2022-06-22 05:14:29'),
(195, 'asian_payment_gateway_configuration', 'paytm', 'web', '2022-06-22 05:15:56', '2022-06-22 05:15:56'),
(196, 'club_point_configurations', 'club_point', 'web', '2022-06-22 05:16:57', '2022-06-22 05:16:57'),
(197, 'set_club_points', 'club_point', 'web', '2022-06-22 05:17:21', '2022-06-22 05:17:21'),
(198, 'view_users_club_points', 'club_point', 'web', '2022-06-22 05:18:14', '2022-06-22 05:18:14'),
(199, 'otp_configurations', 'otp_system', 'web', '2022-06-22 06:07:28', '2022-06-22 06:07:28'),
(200, 'sms_templates', 'otp_system', 'web', '2022-06-22 06:08:13', '2022-06-22 06:08:13'),
(201, 'sms_providers_configurations', 'otp_system', 'web', '2022-06-22 06:08:44', '2022-06-22 06:08:44'),
(202, 'african_pg_configuration', 'african_pg', 'web', '2022-06-22 06:13:41', '2022-06-22 06:13:41'),
(203, 'african_pg_credentials_configuration', 'african_pg', 'web', '2022-06-22 06:16:12', '2022-06-22 06:16:12'),
(204, 'view_all_seller_packages', 'seller_subscription', 'web', '2022-06-22 06:17:45', '2022-06-22 06:17:45'),
(205, 'add_seller_package', 'seller_subscription', 'web', '2022-06-22 06:18:14', '2022-06-22 06:18:14'),
(206, 'edit_seller_package', 'seller_subscription', 'web', '2022-06-22 06:18:24', '2022-06-22 06:18:24'),
(207, 'delete_seller_package', 'seller_subscription', 'web', '2022-06-22 06:18:36', '2022-06-22 06:18:36'),
(208, 'send_bulk_sms', 'otp_system', 'web', '2022-06-22 06:19:06', '2022-06-22 06:19:06'),
(209, 'assign_delivery_boy_for_orders', 'delivery_boy', 'web', '2022-06-22 06:20:16', '2022-06-22 06:20:16'),
(210, 'manage_zones', 'setup_configurations', 'web', '2022-06-22 06:20:16', '2022-06-22 06:20:16'),
(211, 'manage_carriers', 'setup_configurations', 'web', '2022-06-22 06:20:16', '2022-06-22 06:20:16');


ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- role_has_permissions
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;


-- model_has_permissions
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

-- model_has_roles
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;


UPDATE `business_settings` SET `value` = '6.3.0' WHERE `business_settings`.`type` = 'current_version';

COMMIT;