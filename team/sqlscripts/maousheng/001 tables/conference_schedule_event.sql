CREATE TABLE `conference_schedule_event` (
  `conference_schedule_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `conference_room_schedule_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `day` date NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `className` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`conference_schedule_event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
