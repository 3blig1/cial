
-- -------------------------------------------------------
-- Table : pending_students
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pending_students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `profile_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_level` enum('A1','A2','B1','B2','C1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pending_students_email_unique` (`email`)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Données
-- --------------------------------------------------------
INSERT INTO `pending_students`
(`id`, `first_name`, `last_name`, `email`, `date_of_birth`, `profile_photo_path`,
 `language_level`, `emergency_contact_name`, `emergency_contact_relationship`,
 `emergency_contact_phone`, `emergency_contact_email`, `created_at`, `updated_at`)
VALUES
(2, 'rieore', 'dsfuziort', 'ezrui4@oep9etr.ert', '1222-12-12', NULL, 'B2',
 NULL, NULL, NULL, NULL, '2025-12-25 07:19:38', '2025-12-25 07:19:38');

SET FOREIGN_KEY_CHECKS = 1;
