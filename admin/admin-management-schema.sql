USE `get-coffee`;

-- Struktur tabel admin tambahan
ALTER TABLE `admin`
    ADD COLUMN IF NOT EXISTS `nama_lengkap` VARCHAR(255) NULL AFTER `username`,
    ADD COLUMN IF NOT EXISTS `role` ENUM('superadmin','admin','operator') NOT NULL DEFAULT 'admin' AFTER `password`,
    ADD COLUMN IF NOT EXISTS `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `role`,
    ADD COLUMN IF NOT EXISTS `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

-- Riwayat aktivitas admin
CREATE TABLE IF NOT EXISTS `admin_history` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` INT UNSIGNED NOT NULL,
  `target_admin_id` INT UNSIGNED NULL,
  `activity` VARCHAR(255) NOT NULL,
  `details` TEXT NULL,
  `ip_address` VARCHAR(45) NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_admin_history_admin_id` (`admin_id`),
  INDEX `idx_admin_history_target_admin_id` (`target_admin_id`),
  CONSTRAINT `fk_admin_history_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin`(`id_admin`) ON DELETE CASCADE,
  CONSTRAINT `fk_admin_history_target_admin` FOREIGN KEY (`target_admin_id`) REFERENCES `admin`(`id_admin`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
