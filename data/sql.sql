======================================15/07/2022===========================================
ALTER TABLE `posts` CHANGE `status` `status` ENUM('Pending', 'Draft', 'Publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending';
ALTER TABLE `posts` CHANGE `type` `type` ENUM('Article', 'News', 'Videos') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Article';

=======================================25/07/2022==========================================
ALTER TABLE `posts` CHANGE `tag_id` `tag_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL;
ALTER TABLE `posts` CHANGE `tag_id` `tag_id` JSON NULL DEFAULT NULL;