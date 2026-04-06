

-- Exportiere Struktur von Tabelle cial.chat_room_user
CREATE TABLE IF NOT EXISTS `chat_room_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_room_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `last_read_message_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_room_user_chat_room_id_foreign` (`chat_room_id`),
  KEY `chat_room_user_user_id_foreign` (`user_id`),
  CONSTRAINT `chat_room_user_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_room_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle cial.chat_room_user: ~8 rows (ungefähr)
INSERT IGNORE INTO `chat_room_user` (`id`, `chat_room_id`, `user_id`, `last_read_message_id`, `created_at`, `updated_at`) VALUES
	(16, 13, 2, 15, '2025-12-27 09:44:03', '2025-12-27 09:44:03'),
	(19, 14, 1, 22, '2025-12-27 13:02:17', '2025-12-29 20:39:09'),
	(20, 14, 2, 22, '2025-12-27 13:02:17', '2025-12-27 18:57:45'),
	(22, 15, 1, NULL, '2025-12-27 13:07:23', '2025-12-27 13:07:23'),
	(23, 15, 2, NULL, '2025-12-27 13:07:23', '2025-12-27 13:07:23'),
	(25, 16, 1, 21, '2025-12-27 13:11:20', '2025-12-27 18:33:14'),
	(26, 16, 2, 21, '2025-12-27 13:11:20', '2025-12-27 18:59:30'),
	(27, 16, 3, 21, '2025-12-27 13:11:20', '2025-12-29 12:08:12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
