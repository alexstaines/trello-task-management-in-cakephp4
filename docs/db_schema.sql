-- Server version: 10.4.13-MariaDB

CREATE TABLE `lanes` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `position` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,

  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=innodb DEFAULT CHARSET=utf8;


CREATE TABLE `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `position` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `lane_id` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL,

  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),

  `due_date` datetime DEFAULT NULL,
  `archived` tinyint(1) DEFAULT '0'
) ENGINE=innodb DEFAULT CHARSET=utf8;



CREATE TABLE `checklists` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `position` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `card_id` int(11) NOT NULL,

  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=innodb DEFAULT CHARSET=utf8;


CREATE TABLE `checklist_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `position` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `state` tinyint(1) DEFAULT '0',

  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=innodb DEFAULT CHARSET=utf8;





ALTER TABLE `cards`
  ADD CONSTRAINT FOREIGN KEY `cards_lanes_id_fk` (`lane_id`) REFERENCES `lanes` (`id`) ON DELETE CASCADE;

ALTER TABLE `checklists`
  ADD CONSTRAINT FOREIGN KEY `checklists_cards_id_fk` (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE;

ALTER TABLE `checklist_items`
  ADD CONSTRAINT FOREIGN KEY `checklist_items_checklists_id_fk` (`checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE;

 