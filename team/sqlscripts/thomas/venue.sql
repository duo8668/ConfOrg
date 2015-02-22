CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `available` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
