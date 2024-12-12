-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET NAMES utf8 */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

-- Dumping structure for table filmfinder.admin
CREATE TABLE IF NOT EXISTS `admin` (
    `id_admin` int NOT NULL AUTO_INCREMENT,
    `id_users` int DEFAULT NULL,
    `id_film` int DEFAULT NULL,
    `id_review` int DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_admin`),
    KEY `FK_admin_film` (`id_film`),
    KEY `FK_admin_reviewrating` (`id_review`),
    KEY `FK_admin_users` (`id_users`),
    CONSTRAINT `FK_admin_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
    CONSTRAINT `FK_admin_reviewrating` FOREIGN KEY (`id_review`) REFERENCES `reviewrating` (`id_review`),
    CONSTRAINT `FK_admin_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Dumping data for table filmfinder.admin: ~2 rows (approximately)
INSERT INTO
    `admin` (
        `id_admin`,
        `id_users`,
        `id_film`,
        `id_review`,
        `password`,
        `email`,
        `created_at`
    )
VALUES (
        1,
        NULL,
        NULL,
        NULL,
        'adminpass',
        'admin1@example.com',
        '2024-12-10 13:38:58'
    ),
    (
        2,
        NULL,
        NULL,
        NULL,
        'adminpass2',
        'admin2@example.com',
        '2024-12-10 13:38:58'
    );

-- Dumping structure for table filmfinder.film
CREATE TABLE IF NOT EXISTS `film` (
    `id_film` int NOT NULL AUTO_INCREMENT,
    `id_review` int DEFAULT NULL,
    `title_film` varchar(100) NOT NULL,
    `synopsis` varchar(1000) NOT NULL,
    `genre` varchar(100) NOT NULL,
    `release_year` int NOT NULL,
    `director` varchar(100) NOT NULL,
    `duration` float NOT NULL,
    PRIMARY KEY (`id_film`),
    KEY `FK_film_reviewrating` (`id_review`),
    CONSTRAINT `FK_film_reviewrating` FOREIGN KEY (`id_review`) REFERENCES `reviewrating` (`id_review`)
)
-- Dumping data for table filmfinder.film: ~3 rows (approximately)
INSERT INTO
    `film` (
        `id_film`,
        `id_review`,
        `title_film`,
        `synopsis`,
        `genre`,
        `release_year`,
        `director`,
        `duration`
    )
VALUES (
        1,
        NULL,
        'Inception',
        'Seorang pencuri yang mencuri rahasia perusahaan melalui penggunaan teknologi berbagi mimpi.',
        'Sci-Fi',
        2010,
        'Christopher Nolan',
        2.8
    ),
    (
        2,
        NULL,
        'The Matrix',
        'Seorang hacker menemukan kenyataan bahwa hidupnya adalah simulasi dan berjuang melawan pengendalinya.',
        'Sci-Fi',
        1999,
        'The Wachowskis',
        2.3
    ),
    (
        3,
        NULL,
        'Interstellar',
        'Sebuah tim penjelajah melakukan perjalanan melalui lubang cacing di ruang angkasa dalam upaya untuk memastikan kelangsungan hidup umat manusia.',
        'Sci-Fi',
        2014,
        'Christopher Nolan',
        2.9
    );

-- Dumping structure for table filmfinder.reviewrating
CREATE TABLE IF NOT EXISTS `reviewrating` (
    `id_review` int NOT NULL AUTO_INCREMENT,
    `id_users` int NOT NULL,
    `id_film` int NOT NULL,
    `review` text,
    `rating` decimal(2, 1) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_review`),
    KEY `id_users` (`id_users`),
    KEY `id_film` (`id_film`),
    CONSTRAINT `reviewrating_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
    CONSTRAINT `reviewrating_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`)
)
-- Dumping data for table filmfinder.reviewrating: ~3 rows (approximately)
INSERT INTO
    `reviewrating` (
        `id_review`,
        `id_users`,
        `id_film`,
        `review`,
        `rating`,
        `created_at`
    )
VALUES (
        1,
        1,
        1,
        'Film yang menakjubkan dengan alur cerita kompleks.',
        9.0,
        '2024-12-10 13:38:58'
    ),
    (
        2,
        2,
        2,
        'Film revolusioner yang mengubah genre sci-fi.',
        8.5,
        '2024-12-10 13:38:58'
    ),
    (
        3,
        3,
        3,
        'Visual yang menakjubkan dan cerita yang menarik.',
        9.0,
        '2024-12-10 13:38:58'
    );

-- Dumping structure for table filmfinder.users
CREATE TABLE IF NOT EXISTS `users` (
    `id_users` int NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_users`)
)
-- Dumping data for table filmfinder.users: ~3 rows (approximately)
INSERT INTO
    `users` (
        `id_users`,
        `password`,
        `email`,
        `created_at`
    )
VALUES (
        1,
        'password123',
        'user1@example.com',
        '2024-12-10 13:38:58'
    ),
    (
        2,
        'password456',
        'user2@example.com',
        '2024-12-10 13:38:58'
    ),
    (
        3,
        'password789',
        'user3@example.com',
        '2024-12-10 13:38:58'
    );

-- Dumping structure for table filmfinder.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
    `id_watchlist` int NOT NULL AUTO_INCREMENT,
    `id_users` int NOT NULL,
    `id_film` int NOT NULL,
    `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_watchlist`),
    KEY `id_users` (`id_users`),
    KEY `id_film` (`id_film`),
    CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
    CONSTRAINT `watchlist_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`)
)
-- Dumping data for table filmfinder.watchlist: ~5 rows (approximately)
INSERT INTO
    `watchlist` (
        `id_watchlist`,
        `id_users`,
        `id_film`,
        `added_at`
    )
VALUES (
        1,
        1,
        2,
        '2024-12-10 13:38:58'
    ),
    (
        2,
        1,
        3,
        '2024-12-10 13:38:58'
    ),
    (
        3,
        2,
        1,
        '2024-12-10 13:38:58'
    ),
    (
        4,
        3,
        1,
        '2024-12-10 13:38:58'
    ),
    (
        5,
        3,
        2,
        '2024-12-10 13:38:58'
    );

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */
;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;