'CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_session_id` varchar(255) NOT NULL,
  `user_last_seen` datetime NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `online_user_session_id_UNIQUE` (`user_session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8'