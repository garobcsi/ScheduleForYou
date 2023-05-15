-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Gép: db
-- Létrehozás ideje: 2023. Máj 15. 14:35
-- Kiszolgáló verziója: 8.0.30
-- PHP verzió: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Adatbázis: `database`
--
CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `database`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `companies`
--

TRUNCATE TABLE `companies`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_approved_types`
--

DROP TABLE IF EXISTS `company_approved_types`;
CREATE TABLE IF NOT EXISTS `company_approved_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_approved_types`
--

TRUNCATE TABLE `company_approved_types`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_opening_hours`
--

DROP TABLE IF EXISTS `company_opening_hours`;
CREATE TABLE IF NOT EXISTS `company_opening_hours` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `companies_id` bigint UNSIGNED NOT NULL,
  `monday_start` time DEFAULT NULL,
  `monday_end` time DEFAULT NULL,
  `tuesday_start` time DEFAULT NULL,
  `tuesday_end` time DEFAULT NULL,
  `wednesday_start` time DEFAULT NULL,
  `wednesday_end` time DEFAULT NULL,
  `thursday_start` time DEFAULT NULL,
  `thursday_end` time DEFAULT NULL,
  `friday_start` time DEFAULT NULL,
  `friday_end` time DEFAULT NULL,
  `saturday_start` time DEFAULT NULL,
  `saturday_end` time DEFAULT NULL,
  `sunday_start` time DEFAULT NULL,
  `sunday_end` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_opening_hours`
--

TRUNCATE TABLE `company_opening_hours`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_permissions`
--

DROP TABLE IF EXISTS `company_permissions`;
CREATE TABLE IF NOT EXISTS `company_permissions` (
  `user_id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `permission` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `company_permissions_user_id_foreign` (`user_id`),
  KEY `company_permissions_company_id_foreign` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_permissions`
--

TRUNCATE TABLE `company_permissions`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_request_type`
--

DROP TABLE IF EXISTS `company_request_type`;
CREATE TABLE IF NOT EXISTS `company_request_type` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `requested_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `renamed_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_request_type_company_id_foreign` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_request_type`
--

TRUNCATE TABLE `company_request_type`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_reservations`
--

DROP TABLE IF EXISTS `company_reservations`;
CREATE TABLE IF NOT EXISTS `company_reservations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_reservations_company_id_foreign` (`company_id`),
  KEY `company_reservations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_reservations`
--

TRUNCATE TABLE `company_reservations`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_settings`
--

DROP TABLE IF EXISTS `company_settings`;
CREATE TABLE IF NOT EXISTS `company_settings` (
  `company_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_settings`
--

TRUNCATE TABLE `company_settings`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_special_opening_hours`
--

DROP TABLE IF EXISTS `company_special_opening_hours`;
CREATE TABLE IF NOT EXISTS `company_special_opening_hours` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `opening_hours_id` bigint UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `open_or_close` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_special_opening_hours_opening_hours_id_foreign` (`opening_hours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_special_opening_hours`
--

TRUNCATE TABLE `company_special_opening_hours`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company_types`
--

DROP TABLE IF EXISTS `company_types`;
CREATE TABLE IF NOT EXISTS `company_types` (
  `company_id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  KEY `company_types_company_id_foreign` (`company_id`),
  KEY `company_types_type_id_foreign` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `company_types`
--

TRUNCATE TABLE `company_types`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_16_082105_alter_user_table', 1),
(6, '2023_04_08_102632_create_user_time_groups_table', 1),
(7, '2023_04_08_102737_create_user_routines_table', 1),
(8, '2023_04_08_102738_create_user_dates_table', 1),
(9, '2023_04_08_102915_create_companies_table', 1),
(10, '2023_04_08_102939_create_company_reservations_table', 1),
(11, '2023_04_08_103157_create_company_permissions_table', 1),
(12, '2023_04_08_103158_create_user_company_favourite_table', 1),
(13, '2023_04_08_103254_create_company_opening_hours_table', 1),
(14, '2023_04_08_103255_create_company_special_opening_hours_table', 1),
(15, '2023_04_08_104055_create_user_settings_table', 1),
(16, '2023_04_08_104105_create_company_settings_table', 1),
(17, '2023_04_23_071514_create_company_approved_types_table', 1),
(18, '2023_04_23_071541_create_company_types_table', 1),
(19, '2023_04_23_071643_create_company_request_type_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `users`
--

TRUNCATE TABLE `users`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_company_favourite`
--

DROP TABLE IF EXISTS `user_company_favourite`;
CREATE TABLE IF NOT EXISTS `user_company_favourite` (
  `user_id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  KEY `user_company_favourite_user_id_foreign` (`user_id`),
  KEY `user_company_favourite_company_id_foreign` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `user_company_favourite`
--

TRUNCATE TABLE `user_company_favourite`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_dates`
--

DROP TABLE IF EXISTS `user_dates`;
CREATE TABLE IF NOT EXISTS `user_dates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `allDay` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_dates_user_id_foreign` (`user_id`),
  KEY `user_dates_group_id_foreign` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `user_dates`
--

TRUNCATE TABLE `user_dates`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_routines`
--

DROP TABLE IF EXISTS `user_routines`;
CREATE TABLE IF NOT EXISTS `user_routines` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `repeat_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `allDay` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_routines_user_id_foreign` (`user_id`),
  KEY `user_routines_group_id_foreign` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `user_routines`
--

TRUNCATE TABLE `user_routines`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE IF NOT EXISTS `user_settings` (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hu',
  `theme` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dark',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `user_settings`
--

TRUNCATE TABLE `user_settings`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_time_groups`
--

DROP TABLE IF EXISTS `user_time_groups`;
CREATE TABLE IF NOT EXISTS `user_time_groups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_time_groups_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tábla csonkolása beszúrás előtt `user_time_groups`
--

TRUNCATE TABLE `user_time_groups`;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `company_permissions`
--
ALTER TABLE `company_permissions`
  ADD CONSTRAINT `company_permissions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `company_request_type`
--
ALTER TABLE `company_request_type`
  ADD CONSTRAINT `company_request_type_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `company_reservations`
--
ALTER TABLE `company_reservations`
  ADD CONSTRAINT `company_reservations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `company_special_opening_hours`
--
ALTER TABLE `company_special_opening_hours`
  ADD CONSTRAINT `company_special_opening_hours_opening_hours_id_foreign` FOREIGN KEY (`opening_hours_id`) REFERENCES `company_opening_hours` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `company_types`
--
ALTER TABLE `company_types`
  ADD CONSTRAINT `company_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `company_approved_types` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `user_company_favourite`
--
ALTER TABLE `user_company_favourite`
  ADD CONSTRAINT `user_company_favourite_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_company_favourite_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `user_dates`
--
ALTER TABLE `user_dates`
  ADD CONSTRAINT `user_dates_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_time_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_dates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `user_routines`
--
ALTER TABLE `user_routines`
  ADD CONSTRAINT `user_routines_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_time_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_routines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `user_time_groups`
--
ALTER TABLE `user_time_groups`
  ADD CONSTRAINT `user_time_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;