INSERT INTO `jos_components` (`name`,`link`,`menuid`,`parent`,`admin_menu_link`,`admin_menu_alt`,`option`,`ordering`,`admin_menu_img`,`iscore`,`params`,`enabled`)
VALUES ('Adverts', 'option=com_adverts', 0, 0, 'option=com_adverts', 'Adverts', 'com_adverts', 0, '', 0, '', 1);

-- Create syntax for TABLE 'jos_adverts_advertisement_zones'
CREATE TABLE `jos_adverts_advertisement_zones` (
  `adverts_advertisement_zone_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `aid` bigint(20) NOT NULL,
  `zid` bigint(20) NOT NULL,
  UNIQUE KEY `adverts_advertisement_zone_id` (`adverts_advertisement_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_advertisements'
CREATE TABLE `jos_adverts_advertisements` (
  `adverts_advertisement_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `primary_file` varchar(255) NOT NULL DEFAULT '',
  `alternative_file` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL,
  `target` varchar(20) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `custom_banner_code` text NOT NULL,
  `impressions` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT '',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `notes` mediumtext NOT NULL,
  `size` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  UNIQUE KEY `adverts_advertisement_id` (`adverts_advertisement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_campaign_zones'
CREATE TABLE `jos_adverts_campaign_zones` (
  `adverts_campaign_zone_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) NOT NULL,
  `zid` bigint(20) NOT NULL,
  UNIQUE KEY `id` (`adverts_campaign_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_campaigns'
CREATE TABLE `jos_adverts_campaigns` (
  `adverts_campaign_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price_model` tinyint(1) NOT NULL,
  `rate` int(11) NOT NULL,
  `impressions` int(12) NOT NULL,
  `clicks` int(12) NOT NULL,
  `weight` int(11) NOT NULL,
  `notes` mediumtext NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `adverts_campaign_id` (`adverts_campaign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_clients'
CREATE TABLE `jos_adverts_clients` (
  `adverts_client_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `fax_number` varchar(255) NOT NULL,
  `notes` mediumtext NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `adverts_client_id` (`adverts_client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_sites'
CREATE TABLE `jos_adverts_sites` (
  `adverts_site_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`adverts_site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_sizes'
CREATE TABLE `jos_adverts_sizes` (
  `adverts_size_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `checked_out_time` datetime DEFAULT NULL,
  `checked_out` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`adverts_size_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_statistics_clicks'
CREATE TABLE `jos_adverts_statistics_clicks` (
  `adverts_statistics_clicks_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `advertisement_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` tinytext NOT NULL,
  UNIQUE KEY `id` (`adverts_statistics_clicks_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_statistics_impressions'
CREATE TABLE `jos_adverts_statistics_impressions` (
  `adverts_statistics_impression_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `advertisement_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` tinytext NOT NULL,
  UNIQUE KEY `id` (`adverts_statistics_impression_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'jos_adverts_zones'
CREATE TABLE `jos_adverts_zones` (
  `adverts_zone_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `size` int(11) NOT NULL DEFAULT '-1',
  `notes` mediumtext NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enabled` tinyint(1) NOT NULL,
  `site_id` int(11) NOT NULL,
  `chained_zone_id` int(11) NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `adverts_zone_id` (`adverts_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;