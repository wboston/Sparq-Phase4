-- --------------------------------------------------------

CREATE TABLE `#__subscriptions_coupons` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `discount` float NOT NULL,
  `code` varchar(255) NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `usage` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` bigint(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` bigint(11) unsigned DEFAULT NULL,
  `expires_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

CREATE TABLE `#__subscriptions_packages` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` bigint(20) NOT NULL,
  `duration` bigint(11) NOT NULL,
  `price` float NOT NULL,
  `recurring` tinyint(1) NOT NULL,
  `billing_period` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

CREATE TABLE `#__subscriptions_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `actor_id` bigint(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_id` bigint(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `country` varchar(10) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `item_amount` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `discount_amount` float DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `upgrade` tinyint(1) NOT NULL DEFAULT '0',
  `recurring` tinyint(1) NOT NULL,
  `billing_period` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `actor_id` (`actor_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

CREATE TABLE `#__subscriptions_vats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `data` text,
  `created_on` datetime DEFAULT NULL,
  `created_by` bigint(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` bigint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `modified_by` (`modified_by`)
) ENGINE=InnoDB;

INSERT INTO #__migrator_versions (`version`,`component`) VALUES(4, 'subscriptions') ON DUPLICATE KEY UPDATE `version` = 4;
