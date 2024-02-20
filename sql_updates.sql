ALTER TABLE `questions` ADD `canceled` TINYINT(1) NOT NULL DEFAULT '0' AFTER `finished_datetime`;
