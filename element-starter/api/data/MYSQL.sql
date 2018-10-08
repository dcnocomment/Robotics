CREATE TABLE `cloudserver` (
    `user_id` varchar(255) NOT NULL,
    `user_token` varchar(255) NOT NULL,
    `project_name` varchar(50) NOT NULL,
    `region` varchar(50) NOT NULL,
    `project_token` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE `members` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `active` varchar(255) NOT NULL,
    `invited` varchar(3) DEFAULT 'No' NOT NULL,
    `resetToken` varchar(255) DEFAULT NULL,
    `resetComplete` varchar(3) DEFAULT 'No',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
