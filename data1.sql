-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server-Version:               8.4.3 - MySQL Community Server - GPL
-- Server-Betriebssystem:        Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Exportiere Daten aus Tabelle cial.cache: ~0 rows (ungefähr)

-- Exportiere Daten aus Tabelle cial.cache_locks: ~0 rows (ungefähr)

-- Exportiere Daten aus Tabelle cial.courses: ~1 rows (ungefähr)
INSERT INTO `courses` (`id`, `title`, `description`, `level`, `teacher_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
	(1, 'B2', 'B2', 'B2', 1, '2025-07-03', '2025-07-25', '2025-07-03 18:31:44', '2025-07-03 18:31:44');

-- Exportiere Daten aus Tabelle cial.daily_reports: ~2 rows (ungefähr)
INSERT INTO `daily_reports` (`id`, `user_id`, `report_date`, `title`, `content`, `created_at`, `updated_at`) VALUES
	(1, 2, '2025-07-02', 'test', 'Gemini 2.5 constantly has problems with applying changes to the files, it claims that it implemented something, but there are no changes to the files. You have to tell him explicitly and even then it says it has implemented, but fails to do so. How can I apply for a refund for such requests? It burns so much limit.', '2025-07-03 11:48:13', '2025-07-03 12:25:35'),
	(2, 2, '2025-07-06', 'Avancement', 'ragruoögetileo-hptelöthoatehgkpmrölgfkrgrpeögotlgmfg\r\ngrgariorlgokergamroaujgroifkapöigkjrmfvfv fvkvnoevqöeoewrf\r\nfrwofgrlgformklggjreg0qoifkanvnavro \r\neragiktihgtorlhikd\r\ntysjtgitrkhikowoiskhjt', '2025-07-06 08:18:15', '2025-07-06 08:18:36');

-- Exportiere Daten aus Tabelle cial.failed_jobs: ~0 rows (ungefähr)

-- Exportiere Daten aus Tabelle cial.jobs: ~0 rows (ungefähr)

-- Exportiere Daten aus Tabelle cial.job_batches: ~0 rows (ungefähr)

-- Exportiere Daten aus Tabelle cial.migrations: ~8 rows (ungefähr)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_07_02_092327_create_students_table', 1),
	(5, '2025_07_02_203426_add_role_to_users_table', 1),
	(6, '2025_07_02_222324_create_teachers_table', 1),
	(7, '2025_07_03_064012_create_courses_table', 1),
	(8, '2025_07_03_132444_create_daily_reports_table', 2);

-- Exportiere Daten aus Tabelle cial.password_reset_tokens: ~0 rows (ungefähr)

-- Exportiere Daten aus Tabelle cial.sessions: ~2 rows (ungefähr)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('DmBLP8PsWbnjaFfrwg1NWccJhDBBiIQbhX53u5bT', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGdzUGVhdEZoeWp6dmpzOGZONHdCelA3NEJweUxrWm5wTXhabURkQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1751798020),
	('DyTiY8rwj1IzBsYBltuv735gSohGnMerAMxDbzpx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHZGVzQ0bzRob1lRRkdOc3lzcHRVV20yZXZlM2NUcUNIckFYRjRlcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1751814405),
	('gJsrYqBO5dRGD78BxnqZdOrXZul0VQegdgpTjJxD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSThwemlONWVpckZtYlVqNUprQjJ1QzZGU0ZrcHptZHJlWVp6eFpydyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vY291cnNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1751837250);

-- Exportiere Daten aus Tabelle cial.students: ~7 rows (ungefähr)
INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `date_of_birth`, `profile_photo_path`, `language_level`, `emergency_contact_name`, `emergency_contact_relationship`, `emergency_contact_phone`, `emergency_contact_email`, `created_at`, `updated_at`) VALUES
	(1, 'kodjo', 'wonu', 'koguegilbert@gmail.com', '1999-12-31', 'profile-photos/9b9SAkMsz95BpBG6eaX3FKYqkFCRCmev9Sa59W3u.jpg', 'B2', NULL, NULL, NULL, NULL, '2025-07-03 10:27:45', '2025-07-03 15:15:07'),
	(2, 'bau', 'leon', 'bau@bau.com', '2000-08-11', NULL, 'C1', NULL, NULL, NULL, NULL, '2025-07-03 18:32:49', '2025-07-03 18:32:49'),
	(3, 'ayiniu', 'basile', 'basile@basile.com', '2002-07-26', NULL, 'A2', NULL, NULL, NULL, NULL, '2025-07-03 18:33:44', '2025-07-03 18:33:44'),
	(4, 'piere', 'jean', 'jean@jean.com', '1980-08-08', NULL, 'B1', NULL, NULL, NULL, NULL, '2025-07-03 18:34:41', '2025-07-03 18:34:41'),
	(5, 'fworilr', 'eiouferir', 'ti@ti.com', '2000-07-18', NULL, 'A1', NULL, NULL, NULL, NULL, '2025-07-03 18:35:24', '2025-07-03 18:35:24'),
	(6, 'kascal', 'Meyer', 'meyer@pascal.com', '1998-03-13', NULL, 'A2', NULL, NULL, NULL, NULL, '2025-07-06 08:13:03', '2025-07-06 08:17:01'),
	(7, 'kolokolo', 'zak', 'zakkolokolo@cial.com', '2006-08-19', NULL, 'B1', 'zak', 'pere', '123456789', NULL, '2025-07-06 08:31:10', '2025-07-06 08:31:10');

-- Exportiere Daten aus Tabelle cial.teachers: ~1 rows (ungefähr)
INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `email`, `phone`, `specialty`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'Bella', 'Franck', 'bella@bella.com', '123456789', 'B2', 'profile-photos/teachers/yOcdqgrO4yvtGiMEfbhZNZHwvByOLzZ8z2cqbfsB.jpg', '2025-07-03 18:30:52', '2025-07-03 18:57:04');

-- Exportiere Daten aus Tabelle cial.users: ~10 rows (ungefähr)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$1yq8IN9rrKuk76PZutrD7.CvH2TBFZRFuTE2STOtaQ50txLY7cwjq', 'admin', NULL, '2025-07-03 08:09:43', '2025-07-03 08:09:43'),
	(2, 'Secretaire', 'secre@secre.com', NULL, '$2y$12$k5StykqQo9/50mpNtvM7iObPsej2b7QnLx3H0Db2GP07tkLJEo6Z2', 'secretary', NULL, '2025-07-03 08:09:43', '2025-07-03 17:29:54'),
	(3, 'kodjo wonu', 'koguegilbert@gmail.com', NULL, '$2y$12$Yuxdj0/UlOTdbbSCgOda5uuHuErTzUZ4iBOqMKJ4fFqafu6E8HRn6', 'student', NULL, '2025-07-03 10:27:46', '2025-07-03 18:04:35'),
	(4, 'Bella Franck', 'bella@bella.com', NULL, '$2y$12$Ihdnghy85PpGYMzoAsykQec/xNo47A3KpOkcQPcEXDubVGXWx61yi', 'teacher', NULL, '2025-07-03 18:30:52', '2025-07-03 18:30:52'),
	(5, 'bau leon', 'bau@bau.com', NULL, '$2y$12$P/4ZYKngTffE1lLxxaQIs.tJqRi1Qs/HzU4zP5EzzmH2azRDdcw7O', 'student', NULL, '2025-07-03 18:32:50', '2025-07-03 18:32:50'),
	(6, 'ayiniu basile', 'basile@basile.com', NULL, '$2y$12$k07mF8svsONxawctaz9buugElnbu5EBgc71pTVAMFlUCvMVEXjSri', 'student', NULL, '2025-07-03 18:33:45', '2025-07-03 18:33:45'),
	(7, 'piere jean', 'jean@jean.com', NULL, '$2y$12$zTXkRAxjSy026S7Crwnh2ePEsbN4AJb7UfzRUArCKc0K1FvCvJ54a', 'student', NULL, '2025-07-03 18:34:42', '2025-07-03 18:34:42'),
	(8, 'fworilr eiouferir', 'ti@ti.com', NULL, '$2y$12$Iuw6RUVBQuGuUFiIBXlTGu9Mmqc2rkBJUqwcH.TdaMX.wr/kV/Xdu', 'student', NULL, '2025-07-03 18:35:24', '2025-07-03 18:35:24'),
	(9, 'pascal Meyer', 'meyer@pascal.com', NULL, '$2y$12$wdh1PhorLG1KTKWAfI1KbuikEN.XOGOdOSMkcCuVIv77i22K7YCCu', 'student', NULL, '2025-07-06 08:13:04', '2025-07-06 08:13:04'),
	(10, 'kolokolo zak', 'zakkolokolo@cial.com', NULL, '$2y$12$XLh7Y4t822uXjol18C.coeTySjpYJVXvMW6oKjvzQOPsi14FgoHgO', 'student', NULL, '2025-07-06 08:31:10', '2025-07-06 08:31:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
