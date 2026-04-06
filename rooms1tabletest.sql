
-- Exportiere Struktur von Tabelle cial.chat_rooms
CREATE TABLE IF NOT EXISTS `chat_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'group',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_rooms_user_id_foreign` (`user_id`),
  CONSTRAINT `chat_rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle cial.chat_rooms: ~4 rows (ungefähr)
INSERT IGNORE INTO `chat_rooms` (`id`, `user_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
	(13, NULL, 'moi et mia', 'private', '2025-12-26 20:59:43', '2025-12-26 20:59:43'),
	(14, NULL, 'Administration', 'group', '2025-12-27 13:02:17', '2025-12-27 13:02:17'),
	(15, NULL, 'test', 'group', '2025-12-27 13:07:23', '2025-12-27 13:07:23'),
	(16, NULL, 'toto', 'group', '2025-12-27 13:11:20', '2025-12-27 13:11:20');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
