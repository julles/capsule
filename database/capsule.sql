-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.9-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Dumping data for table capsule.actions: ~5 rows (approximately)
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` (`id`, `code`, `label`, `created_at`, `updated_at`) VALUES
	(1, 'index', 'Index', NULL, NULL),
	(2, 'create', 'Create', NULL, NULL),
	(3, 'update', 'Update', NULL, NULL),
	(6, 'view', 'View', '2016-02-28 17:10:11', '2016-02-28 17:10:11'),
	(7, 'delete', 'Delete', '2016-02-28 17:40:33', '2016-02-28 17:40:33');
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;

-- Dumping data for table capsule.cruds: ~9 rows (approximately)
/*!40000 ALTER TABLE `cruds` DISABLE KEYS */;
INSERT INTO `cruds` (`id`, `name`, `company`, `gender`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 'Dr. Jackeline Veum', 'Frami, Windler and Glover', 'woman', '', NULL, NULL),
	(2, 'Dorris Davis', 'Huel, Green and Steuber', 'men', '', NULL, NULL),
	(3, 'Prof. Mariana Sanford', 'Kassulke, O\'Keefe and Schuster', 'men', '', NULL, NULL),
	(5, 'Dr. Khalil Stoltenberg', 'Bartell-Witting', 'men', '', NULL, NULL),
	(6, 'Karianne Kertzmann', 'Smith, Prosacco and Koch', 'woman', '', NULL, NULL),
	(7, 'Alec Lemke', 'Roberts Inc', 'woman', '', NULL, NULL),
	(8, 'Prof. Kristin Collier DDS', 'Yundt Ltd', 'men', '', NULL, NULL),
	(9, 'Ms. Alexandra Witting', 'Gleason Ltd', 'woman', '', NULL, NULL),
	(10, 'Anastasia Satterfield', 'Olson, DuBuque and Hettinger', 'men', '', NULL, NULL);
/*!40000 ALTER TABLE `cruds` ENABLE KEYS */;

-- Dumping data for table capsule.menus: ~8 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `parent_id`, `title`, `permalink`, `icon`, `controller`, `order`, `created_at`, `updated_at`) VALUES
	(1, 0, 'Dashboard', 'dashboard', 'fa fa-dashboard', 'Backend\\DashboardController', 0, NULL, NULL),
	(2, 0, 'User', '#', 'fa fa-user', '#', 1, NULL, NULL),
	(3, 0, 'Sandbox', '#', 'fa fa-caret-square-o-right', '#', 99, NULL, NULL),
	(4, 3, 'Crud Example', 'crud-example', '', 'Backend\\CrudController', 1, NULL, NULL),
	(5, 2, 'Role ', 'role', '', 'Backend\\RoleController', 1, NULL, NULL),
	(6, 2, 'User', 'user', '', 'Backend\\UserController', 1, NULL, NULL),
	(7, 3, 'Action Management', 'action-management', '', 'Backend\\ActionController', 2, NULL, NULL),
	(8, 3, 'Menu Management', 'menu-management', '', 'Backend\\MenuController', 3, NULL, NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping data for table capsule.menu_actions: ~23 rows (approximately)
/*!40000 ALTER TABLE `menu_actions` DISABLE KEYS */;
INSERT INTO `menu_actions` (`id`, `menu_id`, `action_id`, `created_at`, `updated_at`) VALUES
	(19, 5, 1, '2016-02-28 17:40:43', '2016-02-28 17:40:43'),
	(20, 5, 2, '2016-02-28 17:40:43', '2016-02-28 17:40:43'),
	(21, 5, 3, '2016-02-28 17:40:43', '2016-02-28 17:40:43'),
	(22, 5, 6, '2016-02-28 17:40:43', '2016-02-28 17:40:43'),
	(23, 5, 7, '2016-02-28 17:40:43', '2016-02-28 17:40:43'),
	(24, 6, 1, '2016-02-28 17:40:55', '2016-02-28 17:40:55'),
	(25, 6, 2, '2016-02-28 17:40:55', '2016-02-28 17:40:55'),
	(26, 6, 3, '2016-02-28 17:40:55', '2016-02-28 17:40:55'),
	(27, 6, 7, '2016-02-28 17:40:55', '2016-02-28 17:40:55'),
	(28, 1, 1, '2016-02-28 17:41:16', '2016-02-28 17:41:16'),
	(42, 4, 1, '2016-02-28 17:42:12', '2016-02-28 17:42:12'),
	(43, 4, 2, '2016-02-28 17:42:12', '2016-02-28 17:42:12'),
	(44, 4, 3, '2016-02-28 17:42:12', '2016-02-28 17:42:12'),
	(45, 4, 7, '2016-02-28 17:42:12', '2016-02-28 17:42:12'),
	(46, 7, 1, '2016-02-28 17:42:43', '2016-02-28 17:42:43'),
	(47, 7, 2, '2016-02-28 17:42:43', '2016-02-28 17:42:43'),
	(48, 7, 3, '2016-02-28 17:42:44', '2016-02-28 17:42:44'),
	(49, 7, 7, '2016-02-28 17:42:44', '2016-02-28 17:42:44'),
	(50, 8, 1, '2016-02-28 17:42:55', '2016-02-28 17:42:55'),
	(51, 8, 2, '2016-02-28 17:42:55', '2016-02-28 17:42:55'),
	(52, 8, 3, '2016-02-28 17:42:55', '2016-02-28 17:42:55'),
	(53, 8, 6, '2016-02-28 17:42:55', '2016-02-28 17:42:55'),
	(54, 8, 7, '2016-02-28 17:42:55', '2016-02-28 17:42:55');
/*!40000 ALTER TABLE `menu_actions` ENABLE KEYS */;



-- Dumping data for table capsule.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', NULL, NULL),
	(2, 'Administrator', '2016-02-21 12:39:38', '2016-02-21 12:39:38');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping data for table capsule.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `twitter_id`, `facebook_id`, `username`, `password`, `name`, `email`, `avatar`, `status`, `created_at`, `updated_at`, `remember_token`) VALUES
	(1, 1, '', '', 'reza', '$2y$10$XbAZjQh5E1xWuoaP0Q6NcuCBpTgeMW0fT9FNF45RZ0ocvxGGDBdJ6', 'Muhamad Reza AR', 'reza.wikrama3@gmail.com', 'T0aM3XnkPK20160223163453.jpg', 'y', NULL, '2016-02-28 17:30:21', 'kUA7q8HmB2hdr8HT4wrbEKmir9Bf92qwOGuTUgvhzihgtPyFF8LZQPCTDhsm'),
	(2, 2, '', '', 'admin', '$2y$10$9znuFHSXSNhhXSZN5.lIVed48wduE0ypBmqcEctEkLNQ8hA4nTyNK', 'Administrator', 'ultramantigar@gmail.com', 'Akm7NALs1q20160223171954.jpg', 'y', '2016-02-23 17:19:54', '2016-02-23 17:45:06', '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
