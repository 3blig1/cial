
-- Exportiere Struktur von Tabelle cial.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_room_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `attachment_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_chat_room_id_foreign` (`chat_room_id`),
  KEY `messages_user_id_foreign` (`user_id`),
  KEY `messages_attachment_id_foreign` (`attachment_id`),
  CONSTRAINT `messages_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `messages_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle cial.messages: ~4 rows (ungefähr)
INSERT IGNORE INTO `messages` (`id`, `chat_room_id`, `user_id`, `content`, `attachment_id`, `created_at`, `updated_at`) VALUES
	(15, 13, 3, 'hi', NULL, '2025-12-26 21:00:01', '2025-12-26 21:00:01'),
	(20, 16, 3, 'hallo', NULL, '2025-12-27 18:30:23', '2025-12-27 18:30:23'),
	(21, 16, 1, 'hi', NULL, '2025-12-27 18:33:14', '2025-12-27 18:33:14'),
	(22, 14, 1, 'hi', NULL, '2025-12-27 18:33:37', '2025-12-27 18:33:37');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
