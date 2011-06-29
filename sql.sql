INSERT INTO `jos_components` (`name`,`link`,`menuid`,`parent`,`admin_menu_link`,`admin_menu_alt`,`option`,`ordering`,`admin_menu_img`,`iscore`,`params`,`enabled`)
VALUES ('Adverts', 'option=com_adverts', 0, 0, 'option=com_adverts', 'Adverts', 'com_adverts', 0, '', 0, '', 1);

CREATE TABLE `#__adverts_sites` (
  `adverts_site_id` SERIAL,
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
);

CREATE TABLE `#__adverts_zones` (
  `adverts_zone_id` SERIAL,
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
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `#__adverts_clients` (
  `adverts_client_id` SERIAL,
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
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `#__adverts_campaigns` (
  `adverts_campaign_id` SERIAL,
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
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `#__adverts_advertisements` (
  `adverts_advertisement_id` SERIAL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `alt_file_url` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target` varchar(20) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `enabled` tinyint(3) NOT NULL,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `custom_banner_code` text NOT NULL,
  `impressions` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `notes` mediumtext NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `#__adverts_campaign_zones` (
  `adverts_campaign_zone_id` SERIAL,
  `cid` bigint(20) NOT NULL,
  `zid` bigint(20) NOT NULL
);

CREATE TABLE `#__adverts_advertisement_zones` (
  `adverts_advertisement_zone_id` SERIAL,
  `aid` bigint(20) NOT NULL,
  `zid` bigint(20) NOT NULL
);