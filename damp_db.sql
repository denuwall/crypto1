-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 08 2018 г., 18:21
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `premium`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pr_adminpanelcaptcha`
--

CREATE TABLE IF NOT EXISTS `pr_adminpanelcaptcha` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `sess_hash` varchar(150) NOT NULL,
  `num1` varchar(10) NOT NULL DEFAULT '0',
  `num2` varchar(10) NOT NULL DEFAULT '0',
  `symbol` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `createdate` (`createdate`),
  KEY `sess_hash` (`sess_hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pr_adminpanelcaptcha`
--

INSERT INTO `pr_adminpanelcaptcha` (`id`, `createdate`, `sess_hash`, `num1`, `num2`, `symbol`) VALUES
(1, '2018-11-08 17:16:11', '103bf26942f603c0d67bf7b1123f1ea1', '7', '3', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_archive_bids`
--

CREATE TABLE IF NOT EXISTS `pr_archive_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `archive_date` datetime NOT NULL,
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `account1` varchar(250) NOT NULL,
  `account2` varchar(250) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `second_name` varchar(150) NOT NULL,
  `user_phone` varchar(150) NOT NULL,
  `user_skype` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_passport` varchar(250) NOT NULL,
  `archive_content` longtext NOT NULL,
  `archive_meta` longtext NOT NULL,
  `status` varchar(35) NOT NULL,
  `createdate` datetime NOT NULL,
  `editdate` datetime NOT NULL,
  `valut1i` bigint(20) NOT NULL DEFAULT '0',
  `valut2i` bigint(20) NOT NULL DEFAULT '0',
  `valut1` longtext NOT NULL,
  `valut2` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_archive_data`
--

CREATE TABLE IF NOT EXISTS `pr_archive_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(250) NOT NULL,
  `meta_key2` varchar(250) NOT NULL,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `meta_value` varchar(20) NOT NULL DEFAULT '0',
  `meta_key3` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_archive_exchange_bids`
--

CREATE TABLE IF NOT EXISTS `pr_archive_exchange_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `archive_date` datetime NOT NULL,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `archive_content` longtext NOT NULL,
  `account_give` varchar(250) NOT NULL,
  `account_get` varchar(250) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `second_name` varchar(150) NOT NULL,
  `user_phone` varchar(150) NOT NULL,
  `user_skype` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_passport` varchar(250) NOT NULL,
  `psys_give` longtext NOT NULL,
  `psys_get` longtext NOT NULL,
  `currency_id_give` bigint(20) NOT NULL DEFAULT '0',
  `currency_id_get` bigint(20) NOT NULL DEFAULT '0',
  `status` varchar(35) NOT NULL,
  `direction_id` bigint(20) NOT NULL DEFAULT '0',
  `course_give` varchar(50) NOT NULL DEFAULT '0',
  `course_get` varchar(50) NOT NULL DEFAULT '0',
  `user_ip` varchar(150) NOT NULL,
  `currency_code_give` varchar(35) NOT NULL,
  `currency_code_get` varchar(35) NOT NULL,
  `currency_code_id_give` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_id_get` bigint(20) NOT NULL DEFAULT '0',
  `psys_id_give` bigint(20) NOT NULL DEFAULT '0',
  `psys_id_get` bigint(20) NOT NULL DEFAULT '0',
  `user_discount` varchar(10) NOT NULL DEFAULT '0',
  `user_discount_sum` varchar(50) NOT NULL DEFAULT '0',
  `exsum` varchar(50) NOT NULL DEFAULT '0',
  `profit` varchar(50) NOT NULL DEFAULT '0',
  `trans_in` varchar(250) NOT NULL DEFAULT '0',
  `trans_out` varchar(250) NOT NULL DEFAULT '0',
  `to_account` varchar(250) NOT NULL,
  `from_account` varchar(250) NOT NULL,
  `pay_ac` varchar(250) NOT NULL,
  `pay_sum` varchar(50) NOT NULL DEFAULT '0',
  `sum1` varchar(50) NOT NULL DEFAULT '0',
  `dop_com1` varchar(50) NOT NULL DEFAULT '0',
  `sum1dc` varchar(50) NOT NULL DEFAULT '0',
  `com_ps1` varchar(50) NOT NULL DEFAULT '0',
  `com_ps2` varchar(50) NOT NULL DEFAULT '0',
  `sum1c` varchar(50) NOT NULL DEFAULT '0',
  `sum1r` varchar(50) NOT NULL DEFAULT '0',
  `sum2t` varchar(50) NOT NULL DEFAULT '0',
  `sum2` varchar(50) NOT NULL DEFAULT '0',
  `dop_com2` varchar(50) NOT NULL DEFAULT '0',
  `sum2dc` varchar(50) NOT NULL DEFAULT '0',
  `sum2r` varchar(50) NOT NULL DEFAULT '0',
  `sum2c` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_auth_logs`
--

CREATE TABLE IF NOT EXISTS `pr_auth_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_login` varchar(250) NOT NULL,
  `old_user_ip` varchar(250) NOT NULL,
  `old_user_browser` varchar(250) NOT NULL,
  `now_user_ip` varchar(250) NOT NULL,
  `now_user_browser` varchar(250) NOT NULL,
  `auth_status` int(1) NOT NULL DEFAULT '0',
  `auth_status_text` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `auth_date` (`auth_date`),
  KEY `auth_status` (`auth_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `pr_auth_logs`
--

INSERT INTO `pr_auth_logs` (`id`, `auth_date`, `user_id`, `user_login`, `old_user_ip`, `old_user_browser`, `now_user_ip`, `now_user_browser`, `auth_status`, `auth_status_text`) VALUES
(2, '2018-10-23 10:29:06', 1, 'superboss', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36', 1, ''),
(3, '2018-10-26 13:24:09', 1, 'superboss', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 1, ''),
(4, '2018-11-08 17:16:23', 1, 'superboss', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_autobroker_lite`
--

CREATE TABLE IF NOT EXISTS `pr_autobroker_lite` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `site_id` bigint(20) NOT NULL DEFAULT '0',
  `step_column` int(20) NOT NULL DEFAULT '0',
  `step` varchar(20) NOT NULL DEFAULT '0',
  `min_sum` varchar(20) NOT NULL DEFAULT '0',
  `max_sum` varchar(20) NOT NULL DEFAULT '0',
  `cours1` varchar(20) NOT NULL DEFAULT '0',
  `cours2` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_autodel_bids_time`
--

CREATE TABLE IF NOT EXISTS `pr_autodel_bids_time` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `enable_autodel` int(1) NOT NULL DEFAULT '0',
  `cou_hour` varchar(20) NOT NULL DEFAULT '0',
  `cou_minute` varchar(20) NOT NULL DEFAULT '0',
  `statused` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_auto_removal_bids`
--

CREATE TABLE IF NOT EXISTS `pr_auto_removal_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `direction_id` bigint(20) NOT NULL DEFAULT '0',
  `enable_autodel` int(1) NOT NULL DEFAULT '0',
  `cou_hour` varchar(20) NOT NULL DEFAULT '0',
  `cou_minute` varchar(20) NOT NULL DEFAULT '0',
  `statused` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bcbroker_currency_codes`
--

CREATE TABLE IF NOT EXISTS `pr_bcbroker_currency_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency_code_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_title` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bcbroker_directions`
--

CREATE TABLE IF NOT EXISTS `pr_bcbroker_directions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `direction_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_id_give` bigint(20) NOT NULL DEFAULT '0',
  `currency_id_get` bigint(20) NOT NULL DEFAULT '0',
  `v1` bigint(20) NOT NULL DEFAULT '0',
  `v2` bigint(20) NOT NULL DEFAULT '0',
  `now_sort` int(1) NOT NULL DEFAULT '0',
  `name_column` int(20) NOT NULL DEFAULT '0',
  `pars_position` bigint(20) NOT NULL DEFAULT '0',
  `min_res` varchar(250) NOT NULL DEFAULT '0',
  `step` varchar(250) NOT NULL DEFAULT '0',
  `reset_course` int(1) NOT NULL DEFAULT '0',
  `standart_course_give` varchar(250) NOT NULL DEFAULT '0',
  `standart_course_get` varchar(250) NOT NULL DEFAULT '0',
  `min_sum` varchar(250) NOT NULL DEFAULT '0',
  `max_sum` varchar(250) NOT NULL DEFAULT '0',
  `standart_parser` bigint(20) NOT NULL DEFAULT '0',
  `standart_parser_actions_give` varchar(150) NOT NULL DEFAULT '0',
  `standart_parser_actions_get` varchar(150) NOT NULL DEFAULT '0',
  `minsum_parser` bigint(20) NOT NULL DEFAULT '0',
  `minsum_parser_actions` varchar(150) NOT NULL DEFAULT '0',
  `maxsum_parser` bigint(20) NOT NULL DEFAULT '0',
  `maxsum_parser_actions` varchar(150) NOT NULL DEFAULT '0',
  `standart_new_parser` bigint(20) NOT NULL DEFAULT '0',
  `standart_new_parser_actions_give` varchar(150) NOT NULL DEFAULT '0',
  `standart_new_parser_actions_get` varchar(150) NOT NULL DEFAULT '0',
  `minsum_new_parser` bigint(20) NOT NULL DEFAULT '0',
  `minsum_new_parser_actions` varchar(150) NOT NULL DEFAULT '0',
  `maxsum_new_parser` bigint(20) NOT NULL DEFAULT '0',
  `maxsum_new_parser_actions` varchar(150) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bcc_logs`
--

CREATE TABLE IF NOT EXISTS `pr_bcc_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  `counter` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bids`
--

CREATE TABLE IF NOT EXISTS `pr_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `editdate` datetime NOT NULL,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `curs1` varchar(50) NOT NULL DEFAULT '0',
  `curs2` varchar(50) NOT NULL DEFAULT '0',
  `valut1` longtext NOT NULL,
  `valut2` longtext NOT NULL,
  `valut1i` bigint(20) NOT NULL DEFAULT '0',
  `valut2i` bigint(20) NOT NULL DEFAULT '0',
  `vtype1` varchar(35) NOT NULL,
  `vtype2` varchar(35) NOT NULL,
  `vtype1i` bigint(20) NOT NULL DEFAULT '0',
  `vtype2i` bigint(20) NOT NULL DEFAULT '0',
  `psys1i` bigint(20) NOT NULL DEFAULT '0',
  `psys2i` bigint(20) NOT NULL DEFAULT '0',
  `exsum` varchar(50) NOT NULL DEFAULT '0',
  `summ1` varchar(50) NOT NULL DEFAULT '0',
  `dop_com1` varchar(50) NOT NULL DEFAULT '0',
  `summ1_dc` varchar(50) NOT NULL DEFAULT '0',
  `com_ps1` varchar(50) NOT NULL DEFAULT '0',
  `summ1c` varchar(50) NOT NULL DEFAULT '0',
  `summ1cr` varchar(50) NOT NULL DEFAULT '0',
  `summ2t` varchar(50) NOT NULL DEFAULT '0',
  `summ2` varchar(50) NOT NULL DEFAULT '0',
  `dop_com2` varchar(50) NOT NULL DEFAULT '0',
  `com_ps2` varchar(50) NOT NULL DEFAULT '0',
  `summ2_dc` varchar(50) NOT NULL DEFAULT '0',
  `summ2c` varchar(50) NOT NULL DEFAULT '0',
  `summ2cr` varchar(50) NOT NULL DEFAULT '0',
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `profit` varchar(50) NOT NULL DEFAULT '0',
  `summp` varchar(50) NOT NULL DEFAULT '0',
  `partpr` varchar(50) NOT NULL DEFAULT '0',
  `pcalc` int(1) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_sk` varchar(10) NOT NULL DEFAULT '0',
  `user_sksumm` varchar(50) NOT NULL DEFAULT '0',
  `user_country` varchar(10) NOT NULL,
  `user_ip` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `second_name` varchar(150) NOT NULL,
  `user_phone` varchar(150) NOT NULL,
  `user_skype` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_passport` varchar(250) NOT NULL,
  `metas` longtext NOT NULL,
  `dmetas` longtext NOT NULL,
  `account1` varchar(250) NOT NULL,
  `account2` varchar(250) NOT NULL,
  `account1h` varchar(250) NOT NULL,
  `account2h` varchar(250) NOT NULL,
  `naschet` varchar(250) NOT NULL,
  `status` varchar(35) NOT NULL,
  `mystatus` bigint(20) NOT NULL DEFAULT '0',
  `hashed` varchar(35) NOT NULL,
  `user_hash` varchar(150) NOT NULL,
  `bid_locale` varchar(10) NOT NULL,
  `m_in` varchar(150) NOT NULL DEFAULT '0',
  `m_out` varchar(150) NOT NULL DEFAULT '0',
  `naschet_h` varchar(250) NOT NULL,
  `soschet` varchar(250) NOT NULL,
  `trans_in` varchar(250) NOT NULL DEFAULT '0',
  `trans_in_h` varchar(250) NOT NULL,
  `trans_out` varchar(250) NOT NULL DEFAULT '0',
  `trans_out_h` varchar(250) NOT NULL,
  `check_purse1` varchar(20) NOT NULL DEFAULT '0',
  `check_purse2` varchar(20) NOT NULL DEFAULT '0',
  `domacc` int(1) NOT NULL DEFAULT '0',
  `new_user` int(2) NOT NULL DEFAULT '0',
  `exceed_pay` int(1) NOT NULL DEFAULT '0',
  `device` int(1) NOT NULL DEFAULT '0',
  `napsidenty` varchar(250) NOT NULL,
  `touap_date` datetime NOT NULL,
  `domacc1` int(1) NOT NULL DEFAULT '0',
  `domacc2` int(1) NOT NULL DEFAULT '0',
  `unmetas` longtext NOT NULL,
  `hashdata` longtext NOT NULL,
  `sumbonus` varchar(50) NOT NULL DEFAULT '0',
  `recalcdate` datetime NOT NULL,
  `pay_ac` varchar(250) NOT NULL,
  `pay_sum` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bidstatus`
--

CREATE TABLE IF NOT EXISTS `pr_bidstatus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `status_title` longtext NOT NULL,
  `status_text` longtext NOT NULL,
  `status_descr` longtext NOT NULL,
  `send_mail` int(1) NOT NULL DEFAULT '0',
  `sender_mail` varchar(250) NOT NULL,
  `sender_name` varchar(250) NOT NULL,
  `letter_subject` longtext NOT NULL,
  `letter_text` longtext NOT NULL,
  `status_order` bigint(20) NOT NULL DEFAULT '0',
  `refresh_page` int(1) NOT NULL DEFAULT '0',
  `bg_color` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bids_meta`
--

CREATE TABLE IF NOT EXISTS `pr_bids_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `meta_key` longtext NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bids_operators`
--

CREATE TABLE IF NOT EXISTS `pr_bids_operators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bid_logs`
--

CREATE TABLE IF NOT EXISTS `pr_bid_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(150) NOT NULL,
  `old_status` varchar(150) NOT NULL,
  `new_status` varchar(150) NOT NULL,
  `place` varchar(50) NOT NULL,
  `who` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_blackbrokers`
--

CREATE TABLE IF NOT EXISTS `pr_blackbrokers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `url` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_blackbrokers_naps`
--

CREATE TABLE IF NOT EXISTS `pr_blackbrokers_naps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `site_id` bigint(20) NOT NULL DEFAULT '0',
  `step_column` int(20) NOT NULL DEFAULT '0',
  `step` varchar(150) NOT NULL DEFAULT '0',
  `min_sum` varchar(150) NOT NULL DEFAULT '0',
  `max_sum` varchar(150) NOT NULL DEFAULT '0',
  `cours1` varchar(150) NOT NULL DEFAULT '0',
  `cours2` varchar(150) NOT NULL DEFAULT '0',
  `item_from` varchar(150) NOT NULL,
  `item_to` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_blacklist`
--

CREATE TABLE IF NOT EXISTS `pr_blacklist` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(12) NOT NULL DEFAULT '0',
  `meta_value` tinytext NOT NULL,
  `comment_text` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bonus_adj`
--

CREATE TABLE IF NOT EXISTS `pr_bonus_adj` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `adj_title` longtext NOT NULL,
  `adj_create` datetime NOT NULL,
  `adj_edit` datetime NOT NULL,
  `user_creator` bigint(20) NOT NULL DEFAULT '0',
  `user_editor` bigint(20) NOT NULL DEFAULT '0',
  `adj_sum` varchar(50) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_bonus_payouts`
--

CREATE TABLE IF NOT EXISTS `pr_bonus_payouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pay_date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `bonus_sum` varchar(250) NOT NULL DEFAULT '0',
  `pay_sum` varchar(250) NOT NULL DEFAULT '0',
  `pay_sum_or` varchar(250) NOT NULL DEFAULT '0',
  `valut_id` bigint(20) NOT NULL DEFAULT '0',
  `psys_title` longtext NOT NULL,
  `vtype_id` bigint(20) NOT NULL DEFAULT '0',
  `vtype_title` varchar(250) NOT NULL,
  `pay_account` varchar(250) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `comment` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_captcha`
--

CREATE TABLE IF NOT EXISTS `pr_captcha` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `sess_hash` varchar(150) NOT NULL,
  `num1` varchar(10) NOT NULL DEFAULT '0',
  `num2` varchar(10) NOT NULL DEFAULT '0',
  `symbol` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `createdate` (`createdate`),
  KEY `sess_hash` (`sess_hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `pr_captcha`
--

INSERT INTO `pr_captcha` (`id`, `createdate`, `sess_hash`, `num1`, `num2`, `symbol`) VALUES
(40, '2018-11-08 17:15:54', '103bf26942f603c0d67bf7b1123f1ea1', '9', '8', 0),
(41, '2018-11-08 17:15:56', '0460e92bdb76df67e2de69551d5a6057', '4', '5', 0),
(42, '2018-11-08 17:19:55', 'cd488428bd8e3f5fa293eccce2b16cfc', '8', '9', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_cf_directions`
--

CREATE TABLE IF NOT EXISTS `pr_cf_directions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `direction_id` bigint(20) NOT NULL DEFAULT '0',
  `cf_id` bigint(20) NOT NULL DEFAULT '0',
  `place_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `pr_cf_directions`
--

INSERT INTO `pr_cf_directions` (`id`, `direction_id`, `cf_id`, `place_id`) VALUES
(1, 0, 1, 0),
(2, 0, 2, 0),
(3, 0, 3, 0),
(4, 0, 6, 0),
(5, 0, 4, 0),
(6, 0, 5, 0),
(7, 0, 1, 0),
(8, 0, 2, 0),
(9, 0, 3, 0),
(10, 0, 6, 0),
(11, 0, 4, 0),
(12, 0, 5, 0),
(13, 0, 1, 0),
(14, 0, 2, 0),
(15, 0, 3, 0),
(16, 0, 6, 0),
(17, 0, 4, 0),
(18, 0, 5, 0),
(19, 0, 1, 0),
(20, 0, 2, 0),
(21, 0, 3, 0),
(22, 0, 6, 0),
(23, 0, 4, 0),
(24, 0, 5, 0),
(25, 5, 6, 0),
(26, 4, 6, 0),
(27, 3, 6, 0),
(28, 2, 6, 0),
(29, 1, 6, 0),
(30, 11, 6, 0),
(31, 12, 6, 0),
(32, 13, 6, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_commentmeta`
--

CREATE TABLE IF NOT EXISTS `pr_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_comments`
--

CREATE TABLE IF NOT EXISTS `pr_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_course_logs`
--

CREATE TABLE IF NOT EXISTS `pr_course_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(150) NOT NULL,
  `naps_id` bigint(20) DEFAULT '0',
  `v1` bigint(20) NOT NULL DEFAULT '0',
  `v2` bigint(20) NOT NULL DEFAULT '0',
  `lcurs1` varchar(150) NOT NULL DEFAULT '0',
  `lcurs2` varchar(150) NOT NULL DEFAULT '0',
  `curs1` varchar(150) NOT NULL DEFAULT '0',
  `curs2` varchar(150) NOT NULL DEFAULT '0',
  `who` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- Дамп данных таблицы `pr_course_logs`
--

INSERT INTO `pr_course_logs` (`id`, `createdate`, `user_id`, `user_login`, `naps_id`, `v1`, `v2`, `lcurs1`, `lcurs2`, `curs1`, `curs2`, `who`) VALUES
(108, '2018-10-23 10:28:38', 0, '', 3, 1, 5, '1', '26.1415', '1', '27.16', 'constructor_parser'),
(109, '2018-10-23 10:28:38', 0, '', 11, 13, 1, '1', '7342.706', '1', '6373.967', 'constructor_parser'),
(110, '2018-10-23 10:28:38', 0, '', 12, 16, 1, '1', '401.7934', '1', '199.529', 'constructor_parser'),
(111, '2018-10-23 10:28:38', 0, '', 13, 17, 1, '1', '76.766', '1', '52.993', 'constructor_parser');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_currency`
--

CREATE TABLE IF NOT EXISTS `pr_currency` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_logo` longtext NOT NULL,
  `psys_logo` longtext NOT NULL,
  `psys_id` bigint(20) NOT NULL DEFAULT '0',
  `psys_title` longtext NOT NULL,
  `currency_code_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_title` longtext NOT NULL,
  `currency_decimal` int(2) NOT NULL DEFAULT '8',
  `minzn` int(5) NOT NULL DEFAULT '0',
  `maxzn` int(5) NOT NULL DEFAULT '100',
  `txt_give` longtext NOT NULL,
  `txt_get` longtext NOT NULL,
  `show_give` int(2) NOT NULL DEFAULT '1',
  `show_get` int(2) NOT NULL DEFAULT '1',
  `cf_hidden` int(2) NOT NULL DEFAULT '0',
  `firstzn` varchar(20) NOT NULL,
  `cifrzn` int(2) NOT NULL DEFAULT '0',
  `backspace` int(1) NOT NULL DEFAULT '0',
  `vidzn` int(2) NOT NULL DEFAULT '0',
  `helps_give` longtext NOT NULL,
  `helps_get` longtext NOT NULL,
  `site_order` bigint(20) NOT NULL DEFAULT '0',
  `reserv_order` bigint(20) NOT NULL DEFAULT '0',
  `currency_reserv` varchar(50) NOT NULL DEFAULT '0',
  `currency_status` int(1) NOT NULL DEFAULT '1',
  `lead_num` varchar(20) NOT NULL DEFAULT '0',
  `reserv_place` varchar(150) NOT NULL DEFAULT '0',
  `xml_value` varchar(250) NOT NULL,
  `check_text` longtext NOT NULL,
  `check_purse` varchar(150) NOT NULL DEFAULT '0',
  `inday1` varchar(50) NOT NULL DEFAULT '0',
  `inday2` varchar(50) NOT NULL DEFAULT '0',
  `inmon1` varchar(50) NOT NULL DEFAULT '0',
  `inmon2` varchar(50) NOT NULL DEFAULT '0',
  `max_reserv` varchar(50) NOT NULL DEFAULT '0',
  `p_payout` int(2) NOT NULL DEFAULT '1',
  `payout_com` varchar(50) NOT NULL DEFAULT '0',
  `user_wallets` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `pr_currency`
--

INSERT INTO `pr_currency` (`id`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`, `currency_logo`, `psys_logo`, `psys_id`, `psys_title`, `currency_code_id`, `currency_code_title`, `currency_decimal`, `minzn`, `maxzn`, `txt_give`, `txt_get`, `show_give`, `show_get`, `cf_hidden`, `firstzn`, `cifrzn`, `backspace`, `vidzn`, `helps_give`, `helps_get`, `site_order`, `reserv_order`, `currency_reserv`, `currency_status`, `lead_num`, `reserv_place`, `xml_value`, `check_text`, `check_purse`, `inday1`, `inday2`, `inmon1`, `inmon2`, `max_reserv`, `p_payout`, `payout_com`, `user_wallets`) VALUES
(1, '0000-00-00 00:00:00', '2018-07-20 18:07:15', 1, 0, 'a:2:{s:5:"logo1";s:106:"[ru_RU:]/wp-content/uploads/Perfect-Money.png[:ru_RU][en_US:]/wp-content/uploads/Perfect-Money.png[:en_US]";s:5:"logo2";s:106:"[ru_RU:]/wp-content/uploads/Perfect-Money.png[:ru_RU][en_US:]/wp-content/uploads/Perfect-Money.png[:en_US]";}', 'a:2:{s:5:"logo1";s:106:"[ru_RU:]/wp-content/uploads/Perfect-Money.png[:ru_RU][en_US:]/wp-content/uploads/Perfect-Money.png[:en_US]";s:5:"logo2";s:106:"[ru_RU:]/wp-content/uploads/Perfect-Money.png[:ru_RU][en_US:]/wp-content/uploads/Perfect-Money.png[:en_US]";}', 2, '[ru_RU:]Perfect Money[:ru_RU][en_US:]Perfect Money[:en_US]', 3, 'USD', 4, 0, 0, '', '', 1, 1, 0, '', 0, 0, 0, '', '', 10, 10, '0', 1, '1', '0', 'PMUSD', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(3, '0000-00-00 00:00:00', '2018-07-20 18:07:47', 1, 0, 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/WebMoney.png[:ru_RU][en_US:]/wp-content/uploads/WebMoney.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/WebMoney.png[:ru_RU][en_US:]/wp-content/uploads/WebMoney.png[:en_US]";}', 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/WebMoney.png[:ru_RU][en_US:]/wp-content/uploads/WebMoney.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/WebMoney.png[:ru_RU][en_US:]/wp-content/uploads/WebMoney.png[:en_US]";}', 1, '[ru_RU:]Webmoney[:ru_RU][en_US:]Webmoney[:en_US]', 3, 'USD', 4, 0, 0, '', '', 1, 1, 0, '', 0, 0, 0, '', '', 13, 13, '0', 1, '1', '0', 'WMZ', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(5, '0000-00-00 00:00:00', '2018-07-20 18:08:05', 1, 0, 'a:2:{s:5:"logo1";s:100:"[ru_RU:]/wp-content/uploads/Privatbank.png[:ru_RU][en_US:]/wp-content/uploads/Privatbank.png[:en_US]";s:5:"logo2";s:100:"[ru_RU:]/wp-content/uploads/Privatbank.png[:ru_RU][en_US:]/wp-content/uploads/Privatbank.png[:en_US]";}', 'a:2:{s:5:"logo1";s:100:"[ru_RU:]/wp-content/uploads/Privatbank.png[:ru_RU][en_US:]/wp-content/uploads/Privatbank.png[:en_US]";s:5:"logo2";s:100:"[ru_RU:]/wp-content/uploads/Privatbank.png[:ru_RU][en_US:]/wp-content/uploads/Privatbank.png[:en_US]";}', 5, '[ru_RU:]Приват24[:ru_RU][en_US:]Privat24[:en_US]', 4, 'UAH', 4, 0, 0, '', '', 1, 1, 0, '', 0, 0, 0, '', '', 17, 17, '0', 1, '1000', '0', 'P24UAH', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(6, '0000-00-00 00:00:00', '2018-07-20 18:07:54', 1, 0, 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/Yandex.png[:ru_RU][en_US:]/wp-content/uploads/Yandex.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/Yandex.png[:ru_RU][en_US:]/wp-content/uploads/Yandex.png[:en_US]";}', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/Yandex.png[:ru_RU][en_US:]/wp-content/uploads/Yandex.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/Yandex.png[:ru_RU][en_US:]/wp-content/uploads/Yandex.png[:en_US]";}', 3, '[ru_RU:]Яндекс.Деньги[:ru_RU][en_US:]Yandex.Money[:en_US]', 1, 'RUB', 4, 0, 0, '', '', 1, 1, 0, '', 0, 0, 0, '', '', 15, 14, '0', 1, '100', '0', 'YAMRUB', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(7, '0000-00-00 00:00:00', '2018-07-20 18:08:00', 1, 0, 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/Sberbank.png[:ru_RU][en_US:]/wp-content/uploads/Sberbank.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/Sberbank.png[:ru_RU][en_US:]/wp-content/uploads/Sberbank.png[:en_US]";}', 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/Sberbank.png[:ru_RU][en_US:]/wp-content/uploads/Sberbank.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/Sberbank.png[:ru_RU][en_US:]/wp-content/uploads/Sberbank.png[:en_US]";}', 6, '[ru_RU:]Сбербанк[:ru_RU][en_US:]Sberbank[:en_US]', 1, 'RUB', 4, 0, 0, '', '', 1, 1, 0, '', 1, 0, 1, '', '', 16, 16, '0', 1, '100', '0', 'SBERRUB', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(10, '2018-07-20 17:55:46', '2018-07-20 18:05:34', 1, 0, 'a:2:{s:5:"logo1";s:94:"[ru_RU:]/wp-content/uploads/Advcash.png[:ru_RU][en_US:]/wp-content/uploads/Advcash.png[:en_US]";s:5:"logo2";s:94:"[ru_RU:]/wp-content/uploads/Advcash.png[:ru_RU][en_US:]/wp-content/uploads/Advcash.png[:en_US]";}', 'a:2:{s:5:"logo1";s:94:"[ru_RU:]/wp-content/uploads/Advcash.png[:ru_RU][en_US:]/wp-content/uploads/Advcash.png[:en_US]";s:5:"logo2";s:94:"[ru_RU:]/wp-content/uploads/Advcash.png[:ru_RU][en_US:]/wp-content/uploads/Advcash.png[:en_US]";}', 16, '[ru_RU:]Advcash[:ru_RU][en_US:]Advcash[:en_US]', 3, 'USD', 4, 0, 100, '', '', 1, 1, 0, '', 0, 0, 0, '', '', 11, 11, '0', 1, '0', '0', 'ADVCUSD', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(11, '2018-07-20 17:56:29', '2018-07-20 18:05:48', 1, 0, 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/Payeer.png[:ru_RU][en_US:]/wp-content/uploads/Payeer.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/Payeer.png[:ru_RU][en_US:]/wp-content/uploads/Payeer.png[:en_US]";}', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/Payeer.png[:ru_RU][en_US:]/wp-content/uploads/Payeer.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/Payeer.png[:ru_RU][en_US:]/wp-content/uploads/Payeer.png[:en_US]";}', 17, '[ru_RU:]Payeer[:ru_RU][en_US:]Payeer[:en_US]', 3, 'USD', 4, 0, 100, '', '', 1, 1, 0, '', 0, 0, 0, '', '', 12, 12, '0', 1, '0', '0', 'PRUSD', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(12, '2018-07-20 17:57:34', '2018-07-20 18:06:15', 1, 0, 'a:2:{s:5:"logo1";s:88:"[ru_RU:]/wp-content/uploads/Qiwi.png[:ru_RU][en_US:]/wp-content/uploads/Qiwi.png[:en_US]";s:5:"logo2";s:88:"[ru_RU:]/wp-content/uploads/Qiwi.png[:ru_RU][en_US:]/wp-content/uploads/Qiwi.png[:en_US]";}', 'a:2:{s:5:"logo1";s:88:"[ru_RU:]/wp-content/uploads/Qiwi.png[:ru_RU][en_US:]/wp-content/uploads/Qiwi.png[:en_US]";s:5:"logo2";s:88:"[ru_RU:]/wp-content/uploads/Qiwi.png[:ru_RU][en_US:]/wp-content/uploads/Qiwi.png[:en_US]";}', 18, '[ru_RU:]Qiwi[:ru_RU][en_US:]Qiwi[:en_US]', 1, 'RUB', 4, 0, 100, '', '', 1, 1, 0, '', 4, 0, 0, '', '', 14, 15, '0', 1, '0', '0', 'QWRUB', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(13, '2018-07-20 17:58:35', '2018-10-26 13:34:50', 1, 0, 'a:2:{s:5:"logo1";s:94:"[ru_RU:]/wp-content/uploads/Bitcoin.png[:ru_RU][en_US:]/wp-content/uploads/Bitcoin.png[:en_US]";s:5:"logo2";s:94:"[ru_RU:]/wp-content/uploads/Bitcoin.png[:ru_RU][en_US:]/wp-content/uploads/Bitcoin.png[:en_US]";}', 'a:2:{s:5:"logo1";s:94:"[ru_RU:]/wp-content/uploads/Bitcoin.png[:ru_RU][en_US:]/wp-content/uploads/Bitcoin.png[:en_US]";s:5:"logo2";s:94:"[ru_RU:]/wp-content/uploads/Bitcoin.png[:ru_RU][en_US:]/wp-content/uploads/Bitcoin.png[:en_US]";}', 7, '[ru_RU:]Bitcoin[:ru_RU][en_US:]Bitcoin[:en_US]', 10, 'BTC', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 1, 1, '0', 1, '0', '0', 'BTC', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(14, '2018-07-20 17:59:14', '2018-10-26 13:35:24', 1, 0, 'a:2:{s:5:"logo1";s:102:"[ru_RU:]/wp-content/uploads/bitcoincash.png[:ru_RU][en_US:]/wp-content/uploads/bitcoincash.png[:en_US]";s:5:"logo2";s:102:"[ru_RU:]/wp-content/uploads/bitcoincash.png[:ru_RU][en_US:]/wp-content/uploads/bitcoincash.png[:en_US]";}', 'a:2:{s:5:"logo1";s:102:"[ru_RU:]/wp-content/uploads/bitcoincash.png[:ru_RU][en_US:]/wp-content/uploads/bitcoincash.png[:en_US]";s:5:"logo2";s:102:"[ru_RU:]/wp-content/uploads/bitcoincash.png[:ru_RU][en_US:]/wp-content/uploads/bitcoincash.png[:en_US]";}', 14, '[ru_RU:]Bitcoin Cash[:ru_RU][en_US:]Bitcoin Cash[:en_US]', 18, 'BCH', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 2, 2, '0', 1, '0', '0', 'BCH', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(15, '2018-07-20 18:00:00', '2018-10-26 13:35:48', 1, 0, 'a:2:{s:5:"logo1";s:88:"[ru_RU:]/wp-content/uploads/dash.png[:ru_RU][en_US:]/wp-content/uploads/dash.png[:en_US]";s:5:"logo2";s:88:"[ru_RU:]/wp-content/uploads/dash.png[:ru_RU][en_US:]/wp-content/uploads/dash.png[:en_US]";}', 'a:2:{s:5:"logo1";s:88:"[ru_RU:]/wp-content/uploads/dash.png[:ru_RU][en_US:]/wp-content/uploads/dash.png[:en_US]";s:5:"logo2";s:88:"[ru_RU:]/wp-content/uploads/dash.png[:ru_RU][en_US:]/wp-content/uploads/dash.png[:en_US]";}', 13, '[ru_RU:]Dash[:ru_RU][en_US:]Dash[:en_US]', 14, 'DSH', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 5, 3, '0', 1, '0', '0', 'DSH', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(16, '2018-07-20 18:01:07', '2018-10-26 13:35:31', 1, 0, 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/ether.png[:ru_RU][en_US:]/wp-content/uploads/ether.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/ether.png[:ru_RU][en_US:]/wp-content/uploads/ether.png[:en_US]";}', 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/ether.png[:ru_RU][en_US:]/wp-content/uploads/ether.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/ether.png[:ru_RU][en_US:]/wp-content/uploads/ether.png[:en_US]";}', 8, '[ru_RU:]Ethereum[:ru_RU][en_US:]Ethereum[:en_US]', 13, 'ETH', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 3, 4, '0', 1, '0', '0', 'ETH', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(17, '2018-07-20 18:01:51', '2018-10-26 13:35:42', 1, 0, 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/Litecoin.png[:ru_RU][en_US:]/wp-content/uploads/Litecoin.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/Litecoin.png[:ru_RU][en_US:]/wp-content/uploads/Litecoin.png[:en_US]";}', 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/Litecoin.png[:ru_RU][en_US:]/wp-content/uploads/Litecoin.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/Litecoin.png[:ru_RU][en_US:]/wp-content/uploads/Litecoin.png[:en_US]";}', 9, '[ru_RU:]Litecoin[:ru_RU][en_US:]Litecoin[:en_US]', 12, 'LTC', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 4, 5, '0', 1, '0', '0', 'LTC', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(18, '2018-07-20 18:02:35', '2018-10-26 13:35:53', 1, 0, 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/monero.png[:ru_RU][en_US:]/wp-content/uploads/monero.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/monero.png[:ru_RU][en_US:]/wp-content/uploads/monero.png[:en_US]";}', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/monero.png[:ru_RU][en_US:]/wp-content/uploads/monero.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/monero.png[:ru_RU][en_US:]/wp-content/uploads/monero.png[:en_US]";}', 10, '[ru_RU:]Monero[:ru_RU][en_US:]Monero[:en_US]', 16, 'XMR', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 6, 6, '0', 1, '0', '0', 'XMR', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(19, '2018-07-20 18:03:21', '2018-10-26 13:35:58', 1, 0, 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/ripple.png[:ru_RU][en_US:]/wp-content/uploads/ripple.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/ripple.png[:ru_RU][en_US:]/wp-content/uploads/ripple.png[:en_US]";}', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/ripple.png[:ru_RU][en_US:]/wp-content/uploads/ripple.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/ripple.png[:ru_RU][en_US:]/wp-content/uploads/ripple.png[:en_US]";}', 12, '[ru_RU:]Ripple[:ru_RU][en_US:]Ripple[:en_US]', 15, 'XRP', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 7, 7, '0', 1, '0', '0', 'XRP', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(20, '2018-07-20 18:04:10', '2018-10-26 13:36:10', 1, 0, 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/wawes.png[:ru_RU][en_US:]/wp-content/uploads/wawes.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/wawes.png[:ru_RU][en_US:]/wp-content/uploads/wawes.png[:en_US]";}', 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/wawes.png[:ru_RU][en_US:]/wp-content/uploads/wawes.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/wawes.png[:ru_RU][en_US:]/wp-content/uploads/wawes.png[:en_US]";}', 15, '[ru_RU:]Waves[:ru_RU][en_US:]Waves[:en_US]', 20, 'WAVES', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 9, 8, '0', 1, '0', '0', 'WAVES', '', '0', '0', '0', '0', '0', '0', 1, '0', 1),
(21, '2018-07-20 18:04:53', '2018-10-26 13:36:04', 1, 0, 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/zcash.png[:ru_RU][en_US:]/wp-content/uploads/zcash.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/zcash.png[:ru_RU][en_US:]/wp-content/uploads/zcash.png[:en_US]";}', 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/zcash.png[:ru_RU][en_US:]/wp-content/uploads/zcash.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/zcash.png[:ru_RU][en_US:]/wp-content/uploads/zcash.png[:en_US]";}', 11, '[ru_RU:]Zcash[:ru_RU][en_US:]Zcash[:en_US]', 17, 'ZEC', 10, 0, 100, '', '', 0, 1, 0, '', 0, 0, 0, '', '', 8, 9, '0', 1, '0', '0', 'ZEC', '', '0', '0', '0', '0', '0', '0', 1, '0', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_currency_codes`
--

CREATE TABLE IF NOT EXISTS `pr_currency_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_title` longtext NOT NULL,
  `internal_rate` varchar(50) NOT NULL DEFAULT '0',
  `parser` bigint(20) NOT NULL DEFAULT '0',
  `parser_actions` varchar(150) NOT NULL DEFAULT '0',
  `new_parser` bigint(20) NOT NULL DEFAULT '0',
  `new_parser_actions` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `pr_currency_codes`
--

INSERT INTO `pr_currency_codes` (`id`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`, `currency_code_title`, `internal_rate`, `parser`, `parser_actions`, `new_parser`, `new_parser_actions`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'RUB', '65.6345', 1, '0', 665, '0'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'EUR', '0.8549931601', 51, '0', 678, '0'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'USD', '1', 0, '0', 0, '0'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'UAH', '28.1', 101, '0', 697, '0'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'KZT', '368.54', 151, '0', 719, '0'),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'BYN', '2.1109', 201, '0', 711, '0'),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'BTC', '0.0001540008', 352, '0', 808, '0'),
(12, '2018-07-20 17:34:23', '2018-07-20 17:34:45', 1, 0, 'LTC', '0.0191850203', 0, '0', 812, '0'),
(13, '2018-07-20 17:35:15', '2018-07-20 17:35:15', 1, 0, 'ETH', '0.0049111089', 0, '0', 814, '0'),
(14, '2018-07-20 17:35:40', '2018-07-20 17:35:40', 1, 0, 'DSH', '0.0064437142', 0, '0', 820, '0'),
(15, '2018-07-20 17:36:16', '2018-07-20 17:36:16', 1, 0, 'XRP', '2.1510624937', 0, '0', 796, '0'),
(16, '2018-07-20 17:36:38', '2018-07-20 17:36:38', 1, 0, 'XMR', '0.0095102235', 0, '0', 824, '0'),
(17, '2018-07-20 17:37:06', '2018-07-20 17:37:06', 1, 0, 'ZEC', '0.0082637799', 0, '0', 822, '0'),
(18, '2018-07-20 17:37:38', '2018-07-20 17:37:38', 1, 0, 'BCH', '0.0022727273', 0, '0', 828, '0'),
(20, '2018-07-20 17:41:37', '2018-07-20 17:41:37', 1, 0, 'WAVES', '0.509386884', 0, '0', 882, '0'),
(21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'AMD', '1', 0, '0', 0, '0'),
(22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'GLD', '1', 0, '0', 0, '0'),
(23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'UZS', '1', 0, '0', 0, '0'),
(24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'TRY', '1', 0, '0', 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_currency_codes_course_logs`
--

CREATE TABLE IF NOT EXISTS `pr_currency_codes_course_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(150) NOT NULL,
  `currency_code_id` bigint(20) DEFAULT '0',
  `currency_code_title` longtext NOT NULL,
  `last_internal_rate` varchar(150) NOT NULL DEFAULT '0',
  `internal_rate` varchar(150) NOT NULL DEFAULT '0',
  `who` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Дамп данных таблицы `pr_currency_codes_course_logs`
--

INSERT INTO `pr_currency_codes_course_logs` (`id`, `create_date`, `user_id`, `user_login`, `currency_code_id`, `currency_code_title`, `last_internal_rate`, `internal_rate`, `who`) VALUES
(116, '2018-10-23 10:28:38', 0, '', 4, 'UAH', '26.9', '28', 'update_to_parser'),
(117, '2018-10-23 10:28:38', 0, '', 6, 'KZT', '346.7', '365.49', 'update_to_parser'),
(118, '2018-10-23 10:28:38', 0, '', 8, 'BYN', '1.9853', '2.0988', 'update_to_parser'),
(119, '2018-10-23 10:28:38', 0, '', 10, 'BTC', '0.000132165', '0.0001521815', 'update_to_parser'),
(120, '2018-10-23 10:28:38', 0, '', 12, 'LTC', '0.0128438953', '0.0188704168', 'update_to_parser'),
(121, '2018-10-23 10:28:38', 0, '', 13, 'ETH', '0.0023706232', '0.0048614487', 'update_to_parser'),
(122, '2018-10-23 10:28:38', 0, '', 14, 'DSH', '0.0044929685', '0.0063975433', 'update_to_parser'),
(123, '2018-10-23 10:28:39', 0, '', 15, 'XRP', '2.2321428571', '2.1751419987', 'update_to_parser'),
(124, '2018-10-23 10:28:39', 0, '', 16, 'XMR', '0.0081980653', '0.0092148913', 'update_to_parser'),
(125, '2018-10-23 10:28:39', 0, '', 17, 'ZEC', '0.0049217443', '0.0080263264', 'update_to_parser'),
(126, '2018-10-23 10:28:39', 0, '', 18, 'BCH', '0.0013103927', '0.0022129769', 'update_to_parser');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_currency_custom_fields`
--

CREATE TABLE IF NOT EXISTS `pr_currency_custom_fields` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `tech_name` longtext NOT NULL,
  `cf_name` longtext NOT NULL,
  `vid` int(1) NOT NULL DEFAULT '0',
  `currency_id` bigint(20) NOT NULL DEFAULT '0',
  `cf_req` int(1) NOT NULL DEFAULT '0',
  `place_id` int(1) NOT NULL DEFAULT '0',
  `minzn` int(2) NOT NULL DEFAULT '0',
  `maxzn` int(5) NOT NULL DEFAULT '100',
  `firstzn` varchar(20) NOT NULL,
  `cifrzn` int(2) NOT NULL DEFAULT '0',
  `backspace` int(1) NOT NULL DEFAULT '0',
  `uniqueid` varchar(250) NOT NULL,
  `helps` longtext NOT NULL,
  `datas` longtext NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `cf_hidden` int(2) NOT NULL DEFAULT '0',
  `cf_order` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_currency_meta`
--

CREATE TABLE IF NOT EXISTS `pr_currency_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `meta_key` longtext NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `pr_currency_meta`
--

INSERT INTO `pr_currency_meta` (`id`, `item_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'has_verify', '0'),
(2, 1, 'verify_files', '0'),
(3, 1, 'help_verify', ''),
(4, 7, 'has_verify', '1'),
(5, 7, 'verify_files', '2'),
(6, 7, 'help_verify', '[ru_RU:]Тест[:ru_RU]'),
(7, 10, 'has_verify', '0'),
(8, 10, 'verify_files', '0'),
(9, 10, 'help_verify', ''),
(10, 11, 'has_verify', '0'),
(11, 11, 'verify_files', '0'),
(12, 11, 'help_verify', ''),
(13, 12, 'has_verify', '0'),
(14, 12, 'verify_files', '0'),
(15, 12, 'help_verify', ''),
(16, 13, 'has_verify', '0'),
(17, 13, 'verify_files', '0'),
(18, 13, 'help_verify', ''),
(19, 14, 'has_verify', '0'),
(20, 14, 'verify_files', '0'),
(21, 14, 'help_verify', ''),
(22, 15, 'has_verify', '0'),
(23, 15, 'verify_files', '0'),
(24, 15, 'help_verify', ''),
(25, 16, 'has_verify', '0'),
(26, 16, 'verify_files', '0'),
(27, 16, 'help_verify', ''),
(28, 17, 'has_verify', '0'),
(29, 17, 'verify_files', '0'),
(30, 17, 'help_verify', ''),
(31, 18, 'has_verify', '0'),
(32, 18, 'verify_files', '0'),
(33, 18, 'help_verify', ''),
(34, 19, 'has_verify', '0'),
(35, 19, 'verify_files', '0'),
(36, 19, 'help_verify', ''),
(37, 20, 'has_verify', '0'),
(38, 20, 'verify_files', '0'),
(39, 20, 'help_verify', ''),
(40, 21, 'has_verify', '0'),
(41, 21, 'verify_files', '0'),
(42, 21, 'help_verify', ''),
(43, 3, 'has_verify', '0'),
(44, 3, 'verify_files', '0'),
(45, 3, 'help_verify', ''),
(46, 6, 'has_verify', '0'),
(47, 6, 'verify_files', '0'),
(48, 6, 'help_verify', ''),
(49, 5, 'has_verify', '0'),
(50, 5, 'verify_files', '0'),
(51, 5, 'help_verify', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_currency_reserv`
--

CREATE TABLE IF NOT EXISTS `pr_currency_reserv` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `trans_title` longtext NOT NULL,
  `user_creator` bigint(20) NOT NULL DEFAULT '0',
  `user_editor` bigint(20) NOT NULL DEFAULT '0',
  `trans_sum` varchar(50) NOT NULL DEFAULT '0',
  `currency_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_title` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_db_admin_logs`
--

CREATE TABLE IF NOT EXISTS `pr_db_admin_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `tbl_name` varchar(250) NOT NULL DEFAULT '0',
  `trans_type` int(1) NOT NULL DEFAULT '0',
  `trans_date` datetime NOT NULL,
  `old_data` longtext NOT NULL,
  `new_data` longtext NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_directions`
--

CREATE TABLE IF NOT EXISTS `pr_directions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_id_give` bigint(20) NOT NULL DEFAULT '0',
  `currency_id_get` bigint(20) NOT NULL DEFAULT '0',
  `psys_id_give` bigint(20) NOT NULL DEFAULT '0',
  `psys_id_get` bigint(20) NOT NULL DEFAULT '0',
  `tech_name` longtext NOT NULL,
  `direction_name` varchar(350) NOT NULL,
  `site_order1` bigint(20) NOT NULL DEFAULT '0',
  `course_give` varchar(50) NOT NULL DEFAULT '0',
  `course_get` varchar(50) NOT NULL DEFAULT '0',
  `direction_status` int(2) NOT NULL DEFAULT '1',
  `check_purse` int(1) NOT NULL DEFAULT '0',
  `req_check_purse` int(1) NOT NULL DEFAULT '0',
  `enable_user_discount` int(1) NOT NULL DEFAULT '1',
  `max_user_discount` varchar(5) NOT NULL DEFAULT '50',
  `min_sum1` varchar(250) NOT NULL DEFAULT '0',
  `min_sum2` varchar(250) NOT NULL DEFAULT '0',
  `max_sum1` varchar(250) NOT NULL DEFAULT '0',
  `max_sum2` varchar(250) NOT NULL DEFAULT '0',
  `com_box_sum1` varchar(250) NOT NULL DEFAULT '0',
  `com_box_pers1` varchar(250) NOT NULL DEFAULT '0',
  `com_box_min1` varchar(250) NOT NULL DEFAULT '0',
  `com_box_sum2` varchar(250) NOT NULL DEFAULT '0',
  `com_box_pers2` varchar(250) NOT NULL DEFAULT '0',
  `com_box_min2` varchar(250) NOT NULL DEFAULT '0',
  `profit_sum1` varchar(50) NOT NULL DEFAULT '0',
  `profit_sum2` varchar(50) NOT NULL DEFAULT '0',
  `profit_pers1` varchar(20) NOT NULL DEFAULT '0',
  `profit_pers2` varchar(20) NOT NULL DEFAULT '0',
  `com_sum1` varchar(50) NOT NULL DEFAULT '0',
  `com_sum2` varchar(50) NOT NULL DEFAULT '0',
  `com_pers1` varchar(20) NOT NULL DEFAULT '0',
  `com_pers2` varchar(20) NOT NULL DEFAULT '0',
  `com_sum1_check` varchar(50) NOT NULL DEFAULT '0',
  `com_sum2_check` varchar(50) NOT NULL DEFAULT '0',
  `com_pers1_check` varchar(20) NOT NULL DEFAULT '0',
  `com_pers2_check` varchar(20) NOT NULL DEFAULT '0',
  `pay_com1` int(1) NOT NULL DEFAULT '0',
  `pay_com2` int(1) NOT NULL DEFAULT '0',
  `nscom1` int(1) NOT NULL DEFAULT '0',
  `nscom2` int(1) NOT NULL DEFAULT '0',
  `maxsum1com` varchar(250) NOT NULL DEFAULT '0',
  `maxsum2com` varchar(250) NOT NULL DEFAULT '0',
  `minsum1com` varchar(50) NOT NULL DEFAULT '0',
  `minsum2com` varchar(50) NOT NULL DEFAULT '0',
  `m_in` varchar(150) NOT NULL DEFAULT '0',
  `m_out` varchar(150) NOT NULL DEFAULT '0',
  `to1` bigint(20) NOT NULL DEFAULT '0',
  `to2_1` bigint(20) NOT NULL DEFAULT '0',
  `to2_2` bigint(20) NOT NULL DEFAULT '0',
  `to3_1` bigint(20) NOT NULL DEFAULT '0',
  `filecourse` varchar(250) NOT NULL DEFAULT '0',
  `not_country` longtext NOT NULL,
  `only_country` longtext NOT NULL,
  `masschange` bigint(20) NOT NULL DEFAULT '0',
  `mnums1` varchar(50) NOT NULL DEFAULT '0',
  `mnums2` varchar(50) NOT NULL DEFAULT '0',
  `mobile` int(1) NOT NULL DEFAULT '0',
  `hidegost` int(1) NOT NULL DEFAULT '0',
  `maxnaps` varchar(50) NOT NULL DEFAULT '0',
  `direction_reserv` varchar(250) NOT NULL DEFAULT '0',
  `reserv_place` varchar(250) NOT NULL DEFAULT '0',
  `show_file` int(1) NOT NULL DEFAULT '1',
  `xml_city` longtext NOT NULL,
  `xml_manual` int(1) NOT NULL DEFAULT '0',
  `xml_juridical` int(1) NOT NULL DEFAULT '0',
  `xml_show1` varchar(50) NOT NULL,
  `xml_show2` varchar(50) NOT NULL,
  `not_ip` longtext NOT NULL,
  `naps_lang` longtext NOT NULL,
  `parser` bigint(20) NOT NULL DEFAULT '0',
  `nums1` varchar(150) NOT NULL DEFAULT '0',
  `nums2` varchar(150) NOT NULL DEFAULT '0',
  `new_parser` bigint(20) NOT NULL DEFAULT '0',
  `new_parser_actions_give` varchar(150) NOT NULL DEFAULT '0',
  `new_parser_actions_get` varchar(150) NOT NULL DEFAULT '0',
  `xml_param` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `pr_directions`
--

INSERT INTO `pr_directions` (`id`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`, `currency_id_give`, `currency_id_get`, `psys_id_give`, `psys_id_get`, `tech_name`, `direction_name`, `site_order1`, `course_give`, `course_get`, `direction_status`, `check_purse`, `req_check_purse`, `enable_user_discount`, `max_user_discount`, `min_sum1`, `min_sum2`, `max_sum1`, `max_sum2`, `com_box_sum1`, `com_box_pers1`, `com_box_min1`, `com_box_sum2`, `com_box_pers2`, `com_box_min2`, `profit_sum1`, `profit_sum2`, `profit_pers1`, `profit_pers2`, `com_sum1`, `com_sum2`, `com_pers1`, `com_pers2`, `com_sum1_check`, `com_sum2_check`, `com_pers1_check`, `com_pers2_check`, `pay_com1`, `pay_com2`, `nscom1`, `nscom2`, `maxsum1com`, `maxsum2com`, `minsum1com`, `minsum2com`, `m_in`, `m_out`, `to1`, `to2_1`, `to2_2`, `to3_1`, `filecourse`, `not_country`, `only_country`, `masschange`, `mnums1`, `mnums2`, `mobile`, `hidegost`, `maxnaps`, `direction_reserv`, `reserv_place`, `show_file`, `xml_city`, `xml_manual`, `xml_juridical`, `xml_show1`, `xml_show2`, `not_ip`, `naps_lang`, `parser`, `nums1`, `nums2`, `new_parser`, `new_parser_actions_give`, `new_parser_actions_get`, `xml_param`) VALUES
(1, '0000-00-00 00:00:00', '2018-10-27 18:57:18', 1, 0, 1, 7, 2, 6, 'Perfect Money USD → Сбербанк RUB', 'PMUSD-to-SBERRUB', 0, '1', '63.6655', 1, 0, 0, 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '1.99', '1', '0', '0', '1.99', '1', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 1, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 1, '0', '-3 %', 665, '0', '-3%', ''),
(2, '0000-00-00 00:00:00', '2018-10-27 18:57:18', 1, 0, 1, 6, 2, 3, 'Perfect Money USD → Яндекс.Деньги RUB', 'PMUSD-to-YAMRUB', 0, '1', '63.6655', 1, 0, 0, 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '1.99', '0.5', '0', '0', '1.99', '0.5', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 1, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 1, '0', '-2 %', 665, '0', '-3%', ''),
(3, '0000-00-00 00:00:00', '2018-10-26 20:40:19', 1, 0, 1, 5, 2, 5, 'Perfect Money USD → Приват24 UAH', 'PMUSD-to-P24UAH', 0, '1', '27.257', 1, 0, 0, 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '1.99', '0', '0', '0', '1.99', '0', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 1, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 101, '0', '-3 %', 697, '0', '-3%', ''),
(4, '0000-00-00 00:00:00', '2018-10-27 18:57:18', 1, 0, 6, 1, 3, 2, 'Яндекс.Деньги RUB → Perfect Money USD', 'YAMRUB-to-PMUSD', 0, '67.6035', '1', 1, 0, 0, 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0.5', '1.99', '0', '0', '0.5', '1.99', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 5, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '1', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 2, '3 %', '0', 666, '3%', '0', ''),
(5, '0000-00-00 00:00:00', '2018-10-27 18:57:18', 1, 0, 7, 1, 6, 2, 'Сбербанк RUB → Perfect Money USD', 'SBERRUB-to-PMUSD', 0, '67.6035', '1', 1, 0, 0, 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '1', '1.99', '0', '0', '1', '1.99', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 6, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 2, '2', '0', 666, '3%', '0', ''),
(11, '2018-07-21 13:22:09', '2018-10-27 18:57:18', 1, 0, 13, 1, 7, 2, 'Bitcoin BTC → Perfect Money USD', 'BTC-to-PMUSD', 0, '1', '6298.6675', 1, 0, 0, 1, '50', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '1.99', '0', '0', '0', '1.99', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 2, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 0, '0', '0', 807, '0', '-3%', ''),
(12, '2018-07-21 13:23:52', '2018-10-27 18:57:18', 1, 0, 16, 1, 8, 2, 'Ethereum ETH → Perfect Money USD', 'ETH-to-PMUSD', 0, '1', '197.5114', 1, 0, 0, 1, '50', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '1.99', '0', '0', '0', '1.99', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 3, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 0, '0', '0', 813, '0', '-3%', ''),
(13, '2018-07-21 13:25:41', '2018-10-27 18:57:18', 1, 0, 17, 1, 9, 2, 'Litecoin LTC → Perfect Money USD', 'LTC-to-PMUSD', 0, '1', '52.124', 1, 0, 0, 1, '50', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '1.99', '0', '0', '0', '1.99', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 4, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '0:0', '0:0', '', '[d]ru_RU[/d][d]en_US[/d]', 0, '0', '0', 811, '0', '0', ''),
(15, '2018-10-26 20:35:49', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, '', '', 0, '0', '0', 1, 0, 0, 1, '50', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', 0, 0, 0, 0, '0', '', '', 0, '0', '0', 0, 0, '0', '0', '0', 1, '', 0, 0, '', '', '', '', 0, '0', '0', 0, '0', '0', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_directions_meta`
--

CREATE TABLE IF NOT EXISTS `pr_directions_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `meta_key` longtext NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=188 ;

--
-- Дамп данных таблицы `pr_directions_meta`
--

INSERT INTO `pr_directions_meta` (`id`, `item_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'seo_exch_title', ''),
(2, 1, 'seo_title', ''),
(3, 1, 'seo_key', ''),
(4, 1, 'seo_descr', ''),
(5, 1, 'ogp_title', ''),
(6, 1, 'ogp_descr', ''),
(7, 1, 'p_enable', '1'),
(8, 1, 'p_pers', '0'),
(9, 1, 'p_max', '0'),
(10, 2, 'seo_exch_title', ''),
(11, 2, 'seo_title', ''),
(12, 2, 'seo_key', ''),
(13, 2, 'seo_descr', ''),
(14, 2, 'ogp_title', ''),
(15, 2, 'ogp_descr', ''),
(16, 2, 'p_enable', '1'),
(17, 2, 'p_pers', '0'),
(18, 2, 'p_max', '0'),
(19, 3, 'seo_exch_title', ''),
(20, 3, 'seo_title', ''),
(21, 3, 'seo_key', ''),
(22, 3, 'seo_descr', ''),
(23, 3, 'ogp_title', ''),
(24, 3, 'ogp_descr', ''),
(25, 3, 'p_enable', '1'),
(26, 3, 'p_pers', '0'),
(27, 3, 'p_max', '0'),
(28, 4, 'seo_exch_title', ''),
(29, 4, 'seo_title', ''),
(30, 4, 'seo_key', ''),
(31, 4, 'seo_descr', ''),
(32, 4, 'ogp_title', ''),
(33, 4, 'ogp_descr', ''),
(34, 4, 'p_enable', '1'),
(35, 4, 'p_pers', '0'),
(36, 4, 'p_max', '0'),
(37, 5, 'seo_exch_title', ''),
(38, 5, 'seo_title', ''),
(39, 5, 'seo_key', ''),
(40, 5, 'seo_descr', ''),
(41, 5, 'ogp_title', ''),
(42, 5, 'ogp_descr', ''),
(43, 5, 'p_enable', '1'),
(44, 5, 'p_pers', '0'),
(45, 5, 'p_max', '0'),
(46, 5, 'p_ind_sum', '0'),
(47, 5, 'p_min_sum', '0'),
(48, 5, 'p_max_sum', '0'),
(49, 4, 'p_ind_sum', '0'),
(50, 4, 'p_min_sum', '0'),
(51, 4, 'p_max_sum', '0'),
(52, 3, 'p_ind_sum', '0'),
(53, 3, 'p_min_sum', '0'),
(54, 3, 'p_max_sum', '0'),
(55, 2, 'p_ind_sum', '0'),
(56, 2, 'p_min_sum', '0'),
(57, 2, 'p_max_sum', '0'),
(58, 1, 'p_ind_sum', '0'),
(59, 1, 'p_min_sum', '0'),
(60, 1, 'p_max_sum', '0'),
(81, 4, 'verify_account', '0'),
(82, 4, 'email_button', '0'),
(83, 4, 'email_button_verify', '0'),
(84, 4, 'enable_naps_identy', '0'),
(85, 4, 'naps_identy_text', ''),
(86, 4, 'sms_button', '0'),
(87, 4, 'sms_button_verify', '0'),
(88, 4, 'sb_gb', 'a:5:{i:1;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:2;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:3;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:4;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:5;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}}'),
(89, 4, 'verify', '0'),
(90, 4, 'verify_sum', '0'),
(91, 4, 'x19mod', '0'),
(92, 4, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(93, 5, 'verify_account', '0'),
(94, 5, 'email_button', '0'),
(95, 5, 'email_button_verify', '0'),
(96, 5, 'enable_naps_identy', '0'),
(97, 5, 'naps_identy_text', ''),
(98, 5, 'sms_button', '0'),
(99, 5, 'sms_button_verify', '0'),
(100, 5, 'sb_gb', 'a:5:{i:1;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:2;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:3;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:4;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:5;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}}'),
(101, 5, 'verify', '0'),
(102, 5, 'verify_sum', '0'),
(103, 5, 'x19mod', '0'),
(104, 5, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(105, 1, 'verify_account', '0'),
(106, 1, 'email_button', '0'),
(107, 1, 'email_button_verify', '0'),
(108, 1, 'enable_naps_identy', '0'),
(109, 1, 'naps_identy_text', ''),
(110, 1, 'sms_button', '0'),
(111, 1, 'sms_button_verify', '0'),
(112, 1, 'sb_gb', 'a:5:{i:1;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:2;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:3;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:4;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}i:5;a:6:{s:4:"sum1";i:0;s:2:"s1";i:0;s:2:"b1";i:0;s:4:"sum2";i:0;s:2:"s2";i:0;s:2:"b2";i:0;}}'),
(113, 1, 'verify', '0'),
(114, 1, 'verify_sum', '0'),
(115, 1, 'x19mod', '0'),
(116, 1, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(117, 3, 'sms_button', '0'),
(118, 3, 'sms_button_verify', '0'),
(119, 3, 'verify_account', '0'),
(120, 3, 'verify', '0'),
(121, 3, 'verify_sum', '0'),
(122, 3, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(123, 2, 'sms_button', '0'),
(124, 2, 'sms_button_verify', '0'),
(125, 2, 'verify_account', '0'),
(126, 2, 'verify', '0'),
(127, 2, 'verify_sum', '0'),
(128, 2, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(129, 11, 'sms_button', '0'),
(130, 11, 'sms_button_verify', '0'),
(131, 11, 'p_enable', '1'),
(132, 11, 'p_pers', '0'),
(133, 11, 'p_max', '0'),
(134, 11, 'p_ind_sum', '0'),
(135, 11, 'p_min_sum', '0'),
(136, 11, 'p_max_sum', '0'),
(137, 11, 'seo_exch_title', ''),
(138, 11, 'seo_title', ''),
(139, 11, 'seo_key', ''),
(140, 11, 'seo_descr', ''),
(141, 11, 'ogp_title', ''),
(142, 11, 'ogp_descr', ''),
(143, 11, 'verify', '0'),
(144, 11, 'verify_sum', '0'),
(145, 11, 'verify_account', '0'),
(146, 11, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(147, 12, 'sms_button', '0'),
(148, 12, 'sms_button_verify', '0'),
(149, 12, 'p_enable', '1'),
(150, 12, 'p_pers', '0'),
(151, 12, 'p_max', '0'),
(152, 12, 'p_ind_sum', '0'),
(153, 12, 'p_min_sum', '0'),
(154, 12, 'p_max_sum', '0'),
(155, 12, 'seo_exch_title', ''),
(156, 12, 'seo_title', ''),
(157, 12, 'seo_key', ''),
(158, 12, 'seo_descr', ''),
(159, 12, 'ogp_title', ''),
(160, 12, 'ogp_descr', ''),
(161, 12, 'verify', '0'),
(162, 12, 'verify_sum', '0'),
(163, 12, 'verify_account', '0'),
(164, 12, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(165, 13, 'sms_button', '0'),
(166, 13, 'sms_button_verify', '0'),
(167, 13, 'p_enable', '1'),
(168, 13, 'p_pers', '0'),
(169, 13, 'p_max', '0'),
(170, 13, 'p_ind_sum', '0'),
(171, 13, 'p_min_sum', '0'),
(172, 13, 'p_max_sum', '0'),
(173, 13, 'seo_exch_title', ''),
(174, 13, 'seo_title', ''),
(175, 13, 'seo_key', ''),
(176, 13, 'seo_descr', ''),
(177, 13, 'ogp_title', ''),
(178, 13, 'ogp_descr', ''),
(179, 13, 'verify', '0'),
(180, 13, 'verify_sum', '0'),
(181, 13, 'verify_account', '0'),
(182, 13, 'paymerch_data', 'a:6:{s:13:"m_out_realpay";i:0;s:12:"m_out_verify";i:0;s:9:"m_out_max";i:0;s:13:"m_out_max_sum";i:0;s:13:"m_out_timeout";i:0;s:18:"m_out_timeout_user";i:0;}'),
(183, 13, 'x19mod', '0'),
(184, 12, 'x19mod', '0'),
(185, 11, 'x19mod', '0'),
(186, 3, 'x19mod', '0'),
(187, 2, 'x19mod', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_directions_order`
--

CREATE TABLE IF NOT EXISTS `pr_directions_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `direction_id` bigint(20) NOT NULL DEFAULT '0',
  `c_id` bigint(20) NOT NULL DEFAULT '0',
  `order1` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=152 ;

--
-- Дамп данных таблицы `pr_directions_order`
--

INSERT INTO `pr_directions_order` (`id`, `direction_id`, `c_id`, `order1`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 0),
(3, 3, 1, 0),
(4, 4, 1, 0),
(5, 5, 1, 0),
(11, 1, 3, 0),
(12, 2, 3, 0),
(13, 3, 3, 0),
(14, 4, 3, 0),
(15, 5, 3, 0),
(21, 1, 5, 0),
(22, 2, 5, 0),
(23, 3, 5, 0),
(24, 4, 5, 0),
(25, 5, 5, 0),
(26, 1, 6, 0),
(27, 2, 6, 0),
(28, 3, 6, 0),
(29, 4, 6, 0),
(30, 5, 6, 0),
(31, 1, 7, 0),
(32, 2, 7, 0),
(33, 3, 7, 0),
(34, 4, 7, 0),
(35, 5, 7, 0),
(41, 1, 15, 0),
(42, 2, 15, 0),
(43, 3, 15, 0),
(44, 4, 15, 0),
(45, 5, 15, 0),
(46, 1, 10, 0),
(47, 2, 10, 0),
(48, 3, 10, 0),
(49, 4, 10, 0),
(50, 5, 10, 0),
(51, 1, 11, 0),
(52, 2, 11, 0),
(53, 3, 11, 0),
(54, 4, 11, 0),
(55, 5, 11, 0),
(56, 1, 12, 0),
(57, 2, 12, 0),
(58, 3, 12, 0),
(59, 4, 12, 0),
(60, 5, 12, 0),
(61, 1, 13, 0),
(62, 2, 13, 0),
(63, 3, 13, 0),
(64, 4, 13, 0),
(65, 5, 13, 0),
(66, 1, 14, 0),
(67, 2, 14, 0),
(68, 3, 14, 0),
(69, 4, 14, 0),
(70, 5, 14, 0),
(71, 5, 16, 0),
(72, 5, 17, 0),
(73, 5, 18, 0),
(74, 5, 19, 0),
(75, 5, 20, 0),
(76, 5, 21, 0),
(77, 4, 16, 0),
(78, 4, 17, 0),
(79, 4, 18, 0),
(80, 4, 19, 0),
(81, 4, 20, 0),
(82, 4, 21, 0),
(83, 3, 16, 0),
(84, 3, 17, 0),
(85, 3, 18, 0),
(86, 3, 19, 0),
(87, 3, 20, 0),
(88, 3, 21, 0),
(89, 2, 16, 0),
(90, 2, 17, 0),
(91, 2, 18, 0),
(92, 2, 19, 0),
(93, 2, 20, 0),
(94, 2, 21, 0),
(95, 1, 16, 0),
(96, 1, 17, 0),
(97, 1, 18, 0),
(98, 1, 19, 0),
(99, 1, 20, 0),
(100, 1, 21, 0),
(101, 11, 1, 0),
(102, 11, 3, 0),
(103, 11, 5, 0),
(104, 11, 6, 0),
(105, 11, 7, 0),
(106, 11, 10, 0),
(107, 11, 11, 0),
(108, 11, 12, 0),
(109, 11, 13, 0),
(110, 11, 14, 0),
(111, 11, 15, 0),
(112, 11, 16, 0),
(113, 11, 17, 0),
(114, 11, 18, 0),
(115, 11, 19, 0),
(116, 11, 20, 0),
(117, 11, 21, 0),
(118, 12, 1, 0),
(119, 12, 3, 0),
(120, 12, 5, 0),
(121, 12, 6, 0),
(122, 12, 7, 0),
(123, 12, 10, 0),
(124, 12, 11, 0),
(125, 12, 12, 0),
(126, 12, 13, 0),
(127, 12, 14, 0),
(128, 12, 15, 0),
(129, 12, 16, 0),
(130, 12, 17, 0),
(131, 12, 18, 0),
(132, 12, 19, 0),
(133, 12, 20, 0),
(134, 12, 21, 0),
(135, 13, 1, 0),
(136, 13, 3, 0),
(137, 13, 5, 0),
(138, 13, 6, 0),
(139, 13, 7, 0),
(140, 13, 10, 0),
(141, 13, 11, 0),
(142, 13, 12, 0),
(143, 13, 13, 0),
(144, 13, 14, 0),
(145, 13, 15, 0),
(146, 13, 16, 0),
(147, 13, 17, 0),
(148, 13, 18, 0),
(149, 13, 19, 0),
(150, 13, 20, 0),
(151, 13, 21, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_direction_custom_fields`
--

CREATE TABLE IF NOT EXISTS `pr_direction_custom_fields` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `tech_name` longtext NOT NULL,
  `cf_name` longtext NOT NULL,
  `vid` int(1) NOT NULL DEFAULT '0',
  `cf_req` int(1) NOT NULL DEFAULT '0',
  `minzn` int(2) NOT NULL DEFAULT '0',
  `maxzn` int(5) NOT NULL DEFAULT '100',
  `firstzn` varchar(20) NOT NULL,
  `cifrzn` int(2) NOT NULL DEFAULT '0',
  `backspace` int(1) NOT NULL DEFAULT '0',
  `uniqueid` varchar(250) NOT NULL,
  `helps` longtext NOT NULL,
  `cf_auto` varchar(250) NOT NULL,
  `datas` longtext NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `cf_hidden` int(2) NOT NULL DEFAULT '0',
  `cf_order` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `pr_direction_custom_fields`
--

INSERT INTO `pr_direction_custom_fields` (`id`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`, `tech_name`, `cf_name`, `vid`, `cf_req`, `minzn`, `maxzn`, `firstzn`, `cifrzn`, `backspace`, `uniqueid`, `helps`, `cf_auto`, `datas`, `status`, `cf_hidden`, `cf_order`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]Фамилия[:ru_RU][en_US:]Surname[:en_US]', '[ru_RU:]Фамилия[:ru_RU][en_US:]Surname[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите вашу фамилию как в паспорте[:ru_RU][en_US:]Enter your surname as in passport[:en_US]', 'last_name', '', 1, 0, 1),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]Имя[:ru_RU][en_US:]Name[:en_US]', '[ru_RU:]Имя[:ru_RU][en_US:]Name[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите ваше имя как в паспорте[:ru_RU][en_US:]Enter your name as in passport[:en_US]', 'first_name', '', 1, 0, 2),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]Отчество[:ru_RU][en_US:]Middle name[:en_US]', '[ru_RU:]Отчество[:ru_RU][en_US:]Middle name[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите ваше отчество как в паспорте[:ru_RU][en_US:]Enter your middle name as in passport[:en_US]', 'second_name', '', 1, 0, 3),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]Телефон[:ru_RU][en_US:]Phone number[:en_US]', '[ru_RU:]Телефон[:ru_RU][en_US:]Phone number[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите ваш номер телефона для связи[:ru_RU][en_US:]Enter your phone number[:en_US]', 'user_phone', '', 1, 3, 5),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]Skype[:ru_RU][en_US:]Skype[:en_US]', '[ru_RU:]Skype[:ru_RU][en_US:]Skype[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите ваш логин skype[:ru_RU][en_US:]Enter your skype login[:en_US]', 'user_skype', '', 1, 0, 6),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]E-mail[:ru_RU][en_US:]E-mail[:en_US]', '[ru_RU:]E-mail[:ru_RU][en_US:]E-mail[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите ваш e-mail[:ru_RU][en_US:]Enter your e-mail[:en_US]', 'user_email', '', 1, 0, 4),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '[ru_RU:]Номер паспорта[:ru_RU][en_US:]Passport number[:en_US]', '[ru_RU:]Номер паспорта[:ru_RU][en_US:]Passport number[:en_US]', 0, 1, 0, 0, '', 4, 0, '', '[ru_RU:]Введите номер вашего паспорта[:ru_RU][en_US:]Enter number of your passport[:en_US]', 'user_passport', '', 1, 3, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_exchange_bids`
--

CREATE TABLE IF NOT EXISTS `pr_exchange_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `direction_id` bigint(20) NOT NULL DEFAULT '0',
  `course_give` varchar(50) NOT NULL DEFAULT '0',
  `course_get` varchar(50) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_ip` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `second_name` varchar(150) NOT NULL,
  `user_phone` varchar(150) NOT NULL,
  `user_skype` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_passport` varchar(250) NOT NULL,
  `account_give` varchar(250) NOT NULL,
  `account_get` varchar(250) NOT NULL,
  `metas` longtext NOT NULL,
  `dmetas` longtext NOT NULL,
  `unmetas` longtext NOT NULL,
  `status` varchar(35) NOT NULL,
  `bid_locale` varchar(10) NOT NULL,
  `check_purse1` varchar(20) NOT NULL DEFAULT '0',
  `check_purse2` varchar(20) NOT NULL DEFAULT '0',
  `psys_give` longtext NOT NULL,
  `psys_get` longtext NOT NULL,
  `currency_id_give` bigint(20) NOT NULL DEFAULT '0',
  `currency_id_get` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_give` varchar(35) NOT NULL,
  `currency_code_get` varchar(35) NOT NULL,
  `currency_code_id_give` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_id_get` bigint(20) NOT NULL DEFAULT '0',
  `psys_id_give` bigint(20) NOT NULL DEFAULT '0',
  `psys_id_get` bigint(20) NOT NULL DEFAULT '0',
  `user_discount` varchar(10) NOT NULL DEFAULT '0',
  `user_discount_sum` varchar(50) NOT NULL DEFAULT '0',
  `sum1` varchar(50) NOT NULL DEFAULT '0',
  `dop_com1` varchar(50) NOT NULL DEFAULT '0',
  `sum1dc` varchar(50) NOT NULL DEFAULT '0',
  `com_ps1` varchar(50) NOT NULL DEFAULT '0',
  `com_ps2` varchar(50) NOT NULL DEFAULT '0',
  `sum1c` varchar(50) NOT NULL DEFAULT '0',
  `sum1r` varchar(50) NOT NULL DEFAULT '0',
  `sum2t` varchar(50) NOT NULL DEFAULT '0',
  `sum2` varchar(50) NOT NULL DEFAULT '0',
  `dop_com2` varchar(50) NOT NULL DEFAULT '0',
  `sum2dc` varchar(50) NOT NULL DEFAULT '0',
  `sum2r` varchar(50) NOT NULL DEFAULT '0',
  `sum2c` varchar(50) NOT NULL DEFAULT '0',
  `exsum` varchar(50) NOT NULL DEFAULT '0',
  `profit` varchar(50) NOT NULL DEFAULT '0',
  `hashed` varchar(35) NOT NULL,
  `m_in` varchar(150) NOT NULL DEFAULT '0',
  `m_out` varchar(150) NOT NULL DEFAULT '0',
  `user_hash` varchar(150) NOT NULL,
  `trans_in` varchar(250) NOT NULL DEFAULT '0',
  `trans_out` varchar(250) NOT NULL DEFAULT '0',
  `to_account` varchar(250) NOT NULL,
  `from_account` varchar(250) NOT NULL,
  `hashdata` longtext NOT NULL,
  `pay_ac` varchar(250) NOT NULL,
  `pay_sum` varchar(50) NOT NULL DEFAULT '0',
  `exceed_pay` int(1) NOT NULL DEFAULT '0',
  `touap_date` datetime NOT NULL,
  `domacc1` int(1) NOT NULL DEFAULT '0',
  `domacc2` int(1) NOT NULL DEFAULT '0',
  `user_country` varchar(10) NOT NULL,
  `device` int(1) NOT NULL DEFAULT '0',
  `new_user` int(2) NOT NULL DEFAULT '0',
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `partner_sum` varchar(50) NOT NULL DEFAULT '0',
  `partner_pers` varchar(50) NOT NULL DEFAULT '0',
  `pcalc` int(1) NOT NULL DEFAULT '0',
  `recalc_date` datetime NOT NULL,
  `user_verify` int(1) NOT NULL DEFAULT '0',
  `identy` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_geoip_blackip`
--

CREATE TABLE IF NOT EXISTS `pr_geoip_blackip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_geoip_country`
--

CREATE TABLE IF NOT EXISTS `pr_geoip_country` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attr` varchar(20) NOT NULL,
  `title` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `temp_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_geoip_iplist`
--

CREATE TABLE IF NOT EXISTS `pr_geoip_iplist` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `before_cip` bigint(20) NOT NULL DEFAULT '0',
  `after_cip` bigint(20) NOT NULL DEFAULT '0',
  `before_ip` varchar(250) NOT NULL,
  `after_ip` varchar(250) NOT NULL,
  `country_attr` varchar(20) NOT NULL,
  `place_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_geoip_template`
--

CREATE TABLE IF NOT EXISTS `pr_geoip_template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `temptitle` longtext NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `default_temp` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_geoip_whiteip`
--

CREATE TABLE IF NOT EXISTS `pr_geoip_whiteip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_inex_change`
--

CREATE TABLE IF NOT EXISTS `pr_inex_change` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(250) NOT NULL,
  `meta_key2` varchar(250) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_inex_deposit`
--

CREATE TABLE IF NOT EXISTS `pr_inex_deposit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `indate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `outdate` datetime NOT NULL,
  `couday` int(5) NOT NULL DEFAULT '0',
  `pers` varchar(250) NOT NULL,
  `insumm` varchar(250) NOT NULL DEFAULT '0',
  `outsumm` varchar(250) NOT NULL DEFAULT '0',
  `plussumm` varchar(250) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_schet` varchar(250) NOT NULL,
  `gid` varchar(250) NOT NULL,
  `gtitle` tinytext NOT NULL,
  `gvalut` varchar(250) NOT NULL,
  `paystatus` int(3) NOT NULL DEFAULT '0',
  `vipstatus` int(3) NOT NULL DEFAULT '0',
  `zakstatus` int(3) NOT NULL DEFAULT '0',
  `locale` varchar(20) NOT NULL,
  `mail1` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_inex_system`
--

CREATE TABLE IF NOT EXISTS `pr_inex_system` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `valut` varchar(250) NOT NULL,
  `gid` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_inex_tars`
--

CREATE TABLE IF NOT EXISTS `pr_inex_tars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `minsum` varchar(250) NOT NULL DEFAULT '0',
  `maxsum` varchar(250) NOT NULL DEFAULT '0',
  `gid` varchar(250) NOT NULL,
  `gtitle` tinytext NOT NULL,
  `gvalut` varchar(250) NOT NULL,
  `mpers` varchar(250) NOT NULL,
  `cdays` bigint(20) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `maxsumtar` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_links`
--

CREATE TABLE IF NOT EXISTS `pr_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_maintrance`
--

CREATE TABLE IF NOT EXISTS `pr_maintrance` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `the_title` tinytext NOT NULL,
  `operator_status` varchar(150) NOT NULL DEFAULT '-1',
  `show_text` longtext NOT NULL,
  `for_whom` int(1) NOT NULL DEFAULT '0',
  `pages_law` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pr_maintrance`
--

INSERT INTO `pr_maintrance` (`id`, `the_title`, `operator_status`, `show_text`, `for_whom`, `pages_law`) VALUES
(1, '[ru_RU:]Тех. обслуживание[:ru_RU]', '0', '[ru_RU:]Тех. обслуживание[:ru_RU]', 1, 'a:6:{s:4:"home";s:1:"2";s:8:"exchange";s:1:"2";s:2:"sm";s:1:"2";s:5:"files";s:1:"2";s:5:"smxml";s:1:"2";s:3:"tar";s:1:"2";}');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_merchant_logs`
--

CREATE TABLE IF NOT EXISTS `pr_merchant_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `mdata` longtext NOT NULL,
  `merchant` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_naps`
--

CREATE TABLE IF NOT EXISTS `pr_naps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valut_id1` bigint(20) NOT NULL DEFAULT '0',
  `valut_id2` bigint(20) NOT NULL DEFAULT '0',
  `psys_id1` bigint(20) NOT NULL DEFAULT '0',
  `psys_id2` bigint(20) NOT NULL DEFAULT '0',
  `curs1` varchar(50) NOT NULL DEFAULT '0',
  `curs2` varchar(50) NOT NULL DEFAULT '0',
  `minsumm1` varchar(250) NOT NULL DEFAULT '0',
  `minsumm2` varchar(250) NOT NULL DEFAULT '0',
  `maxsumm1` varchar(250) NOT NULL DEFAULT '0',
  `maxsumm2` varchar(250) NOT NULL DEFAULT '0',
  `com_box_summ1` varchar(250) NOT NULL DEFAULT '0',
  `com_box_pers1` varchar(250) NOT NULL DEFAULT '0',
  `com_box_min1` varchar(250) NOT NULL DEFAULT '0',
  `com_box_summ2` varchar(250) NOT NULL DEFAULT '0',
  `com_box_pers2` varchar(250) NOT NULL DEFAULT '0',
  `com_box_min2` varchar(250) NOT NULL DEFAULT '0',
  `com_summ1` varchar(50) NOT NULL DEFAULT '0',
  `com_summ2` varchar(50) NOT NULL DEFAULT '0',
  `com_pers1` varchar(20) NOT NULL DEFAULT '0',
  `com_pers2` varchar(20) NOT NULL DEFAULT '0',
  `pay_com1` int(1) NOT NULL DEFAULT '0',
  `pay_com2` int(1) NOT NULL DEFAULT '0',
  `nscom1` int(1) NOT NULL DEFAULT '0',
  `nscom2` int(1) NOT NULL DEFAULT '0',
  `maxsumm1com` varchar(250) NOT NULL DEFAULT '0',
  `maxsumm2com` varchar(250) NOT NULL DEFAULT '0',
  `minsumm1com` varchar(50) NOT NULL DEFAULT '0',
  `minsumm2com` varchar(50) NOT NULL DEFAULT '0',
  `profit_summ1` varchar(50) NOT NULL DEFAULT '0',
  `profit_summ2` varchar(50) NOT NULL DEFAULT '0',
  `profit_pers1` varchar(20) NOT NULL DEFAULT '0',
  `profit_pers2` varchar(20) NOT NULL DEFAULT '0',
  `parser` bigint(20) NOT NULL DEFAULT '0',
  `nums1` varchar(50) NOT NULL DEFAULT '0',
  `elem1` int(2) NOT NULL DEFAULT '0',
  `nums2` varchar(50) NOT NULL DEFAULT '0',
  `elem2` int(2) NOT NULL DEFAULT '0',
  `masschange` bigint(20) NOT NULL DEFAULT '0',
  `mnums1` varchar(50) NOT NULL DEFAULT '0',
  `melem1` int(2) NOT NULL DEFAULT '0',
  `mnums2` varchar(50) NOT NULL DEFAULT '0',
  `melem2` int(2) NOT NULL DEFAULT '0',
  `max_user_sk` varchar(5) NOT NULL DEFAULT '50',
  `maxnaps` varchar(50) NOT NULL DEFAULT '0',
  `user_sk` int(1) NOT NULL DEFAULT '1',
  `not_country` longtext NOT NULL,
  `not_ip` longtext NOT NULL,
  `hidegost` int(1) NOT NULL DEFAULT '0',
  `naps_lang` longtext NOT NULL,
  `site_order1` bigint(20) NOT NULL DEFAULT '0',
  `site_order2` bigint(20) NOT NULL DEFAULT '0',
  `naps_status` int(2) NOT NULL DEFAULT '1',
  `m_in` varchar(150) NOT NULL DEFAULT '0',
  `m_out` varchar(150) NOT NULL DEFAULT '0',
  `naps_name` varchar(250) NOT NULL,
  `createdate` datetime NOT NULL,
  `autostatus` int(1) NOT NULL DEFAULT '1',
  `editdate` datetime NOT NULL,
  `show_file` int(1) NOT NULL DEFAULT '1',
  `com_summ1_check` varchar(50) NOT NULL DEFAULT '0',
  `com_summ2_check` varchar(50) NOT NULL DEFAULT '0',
  `com_pers1_check` varchar(20) NOT NULL DEFAULT '0',
  `com_pers2_check` varchar(20) NOT NULL DEFAULT '0',
  `check_purse` int(1) NOT NULL DEFAULT '0',
  `req_check_purse` int(1) NOT NULL DEFAULT '0',
  `to1` bigint(20) NOT NULL DEFAULT '0',
  `to2_1` bigint(20) NOT NULL DEFAULT '0',
  `to2_2` bigint(20) NOT NULL DEFAULT '0',
  `to3_1` bigint(20) NOT NULL DEFAULT '0',
  `maxexip` bigint(20) NOT NULL DEFAULT '0',
  `xml_city` varchar(150) NOT NULL,
  `xml_manual` int(1) NOT NULL DEFAULT '0',
  `xml_juridical` int(1) NOT NULL DEFAULT '0',
  `xml_show1` varchar(50) NOT NULL,
  `xml_show2` varchar(50) NOT NULL,
  `tech_name` longtext NOT NULL,
  `mobile` int(1) NOT NULL DEFAULT '0',
  `only_country` longtext NOT NULL,
  `naps_reserv` varchar(250) NOT NULL DEFAULT '0',
  `reserv_place` varchar(250) NOT NULL DEFAULT '0',
  `filecourse` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pr_naps`
--

INSERT INTO `pr_naps` (`id`, `valut_id1`, `valut_id2`, `psys_id1`, `psys_id2`, `curs1`, `curs2`, `minsumm1`, `minsumm2`, `maxsumm1`, `maxsumm2`, `com_box_summ1`, `com_box_pers1`, `com_box_min1`, `com_box_summ2`, `com_box_pers2`, `com_box_min2`, `com_summ1`, `com_summ2`, `com_pers1`, `com_pers2`, `pay_com1`, `pay_com2`, `nscom1`, `nscom2`, `maxsumm1com`, `maxsumm2com`, `minsumm1com`, `minsumm2com`, `profit_summ1`, `profit_summ2`, `profit_pers1`, `profit_pers2`, `parser`, `nums1`, `elem1`, `nums2`, `elem2`, `masschange`, `mnums1`, `melem1`, `mnums2`, `melem2`, `max_user_sk`, `maxnaps`, `user_sk`, `not_country`, `not_ip`, `hidegost`, `naps_lang`, `site_order1`, `site_order2`, `naps_status`, `m_in`, `m_out`, `naps_name`, `createdate`, `autostatus`, `editdate`, `show_file`, `com_summ1_check`, `com_summ2_check`, `com_pers1_check`, `com_pers2_check`, `check_purse`, `req_check_purse`, `to1`, `to2_1`, `to2_2`, `to3_1`, `maxexip`, `xml_city`, `xml_manual`, `xml_juridical`, `xml_show1`, `xml_show2`, `tech_name`, `mobile`, `only_country`, `naps_reserv`, `reserv_place`, `filecourse`) VALUES
(1, 1, 7, 2, 6, '1', '61.584136', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2', '1', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', 1, '0', 0, '-3 %', 1, 0, '0', 0, '0', 0, '0', '0', 1, '', '', 0, '[d]ru_RU[/d][d]en_US[/d]', 0, 0, 1, '0', '0', 'PMUSD_to_SBERRUB', '0000-00-00 00:00:00', 1, '2018-07-20 13:27:26', 1, '0', '0', '0.5', '1', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '0:0', '0:0', 'Perfect Money USD → Сбербанк RUB', 0, '', '0', '0', '0'),
(2, 1, 6, 2, 3, '1', '62.219024', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2', '0.5', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', 1, '0', 0, '-2 %', 1, 0, '0', 0, '0', 0, '0', '0', 1, '', '', 0, '[d]ru_RU[/d][d]en_US[/d]', 0, 0, 1, '0', '0', 'PMUSD_to_YAMRUB', '0000-00-00 00:00:00', 1, '2018-07-20 13:27:26', 1, '0', '0', '0.5', '0.5', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', '', 'Perfect Money USD &rarr; Яндекс.Деньги RUB', 0, '', '0', '0', '0'),
(3, 1, 5, 2, 5, '100', '2567.82571', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2', '0', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', 101, '0', 0, '-3 %', 1, 0, '0', 0, '0', 0, '0', '0', 1, '', '', 0, '[d]ru_RU[/d][d]en_US[/d]', 0, 0, 1, '0', '0', 'PMUSD_to_P24UAH', '0000-00-00 00:00:00', 1, '2018-07-20 13:27:26', 1, '0', '0', '0.5', '0', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', '', 'Perfect Money USD &rarr; Приват24 UAH', 0, '', '0', '0', '0'),
(4, 6, 1, 3, 2, '1030', '15.75080959', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.5', '2', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', 2, '3 %', 1, '0', 0, 0, '0', 0, '0', 0, '0', '0', 1, '', '', 0, '[d]ru_RU[/d][d]en_US[/d]', 0, 0, 1, '0', '0', 'YAMRUB_to_PMUSD', '0000-00-00 00:00:00', 1, '2018-07-20 13:27:26', 1, '0', '0', '0.5', '0.5', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '0:0', '0:0', 'Яндекс.Деньги RUB → Perfect Money USD', 0, '', '0', '1', '0'),
(5, 7, 1, 6, 2, '1002', '15.75080959', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '2', 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', 2, '2', 0, '0', 0, 0, '0', 0, '0', 0, '0', '0', 1, '', '', 0, '[d]ru_RU[/d][d]en_US[/d]', 0, 0, 1, '0', '0', 'SBERRUB_to_PMUSD', '0000-00-00 00:00:00', 1, '2018-07-20 13:27:26', 1, '0', '0', '1', '0.5', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '0:0', '0:0', 'Сбербанк RUB → Perfect Money USD', 0, '', '0', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_naps_dopsumcomis`
--

CREATE TABLE IF NOT EXISTS `pr_naps_dopsumcomis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `sum_val` varchar(150) NOT NULL DEFAULT '0',
  `com_box_summ1` varchar(150) NOT NULL DEFAULT '0',
  `com_box_pers1` varchar(150) NOT NULL DEFAULT '0',
  `com_box_summ2` varchar(150) NOT NULL DEFAULT '0',
  `com_box_pers2` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_naps_reservcurs`
--

CREATE TABLE IF NOT EXISTS `pr_naps_reservcurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `sum_val` varchar(50) NOT NULL DEFAULT '0',
  `curs1` varchar(50) NOT NULL DEFAULT '0',
  `curs2` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_naps_sumcomis`
--

CREATE TABLE IF NOT EXISTS `pr_naps_sumcomis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `sum_val` varchar(150) NOT NULL DEFAULT '0',
  `com_pers1` varchar(150) NOT NULL DEFAULT '0',
  `com_summ1` varchar(150) NOT NULL DEFAULT '0',
  `com_pers1_check` varchar(150) NOT NULL DEFAULT '0',
  `com_summ1_check` varchar(150) NOT NULL DEFAULT '0',
  `com_pers2` varchar(150) NOT NULL DEFAULT '0',
  `com_summ2` varchar(150) NOT NULL DEFAULT '0',
  `com_pers2_check` varchar(150) NOT NULL DEFAULT '0',
  `com_summ2_check` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_naps_sumcurs`
--

CREATE TABLE IF NOT EXISTS `pr_naps_sumcurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `sum_val` varchar(50) NOT NULL DEFAULT '0',
  `curs1` varchar(50) NOT NULL DEFAULT '0',
  `curs2` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_notice_head`
--

CREATE TABLE IF NOT EXISTS `pr_notice_head` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `notice_type` int(1) NOT NULL DEFAULT '0',
  `datestart` datetime NOT NULL,
  `dateend` datetime NOT NULL,
  `op_status` int(5) NOT NULL DEFAULT '-1',
  `h1` varchar(5) NOT NULL DEFAULT '0',
  `m1` varchar(5) NOT NULL DEFAULT '0',
  `h2` varchar(5) NOT NULL DEFAULT '0',
  `m2` varchar(5) NOT NULL DEFAULT '0',
  `d1` int(1) NOT NULL DEFAULT '0',
  `d2` int(1) NOT NULL DEFAULT '0',
  `d3` int(1) NOT NULL DEFAULT '0',
  `d4` int(1) NOT NULL DEFAULT '0',
  `d5` int(1) NOT NULL DEFAULT '0',
  `d6` int(1) NOT NULL DEFAULT '0',
  `d7` int(1) NOT NULL DEFAULT '0',
  `url` longtext NOT NULL,
  `text` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `theclass` varchar(250) NOT NULL,
  `site_order` bigint(20) NOT NULL DEFAULT '0',
  `notice_display` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_options`
--

CREATE TABLE IF NOT EXISTS `pr_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) DEFAULT NULL,
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=542 ;

--
-- Дамп данных таблицы `pr_options`
--

INSERT INTO `pr_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://premiumexchanger.ru', 'yes'),
(2, 'home', 'http://premiumexchanger.ru', 'yes'),
(3, 'blogname', '[ru_RU:]Обменный пункт электронных валют[:ru_RU][en_US:]Electronic currencies exchanger[:en_US]', 'yes'),
(4, 'blogdescription', '[ru_RU:]Обменный пункт электронных валют[:ru_RU][en_US:]Electronic currencies exchanger[:en_US]', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'info@premium.ru', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '0', 'yes'),
(12, 'posts_per_rss', '5', 'yes'),
(13, 'rss_use_excerpt', '1', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'closed', 'yes'),
(21, 'default_pingback_flag', '0', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'd.m.Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'd.m.Y H:i', 'yes'),
(26, 'comment_moderation', '1', 'yes'),
(27, 'moderation_notify', '0', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:2:{i:0;s:25:"premiumbox/premiumbox.php";i:1;s:27:"premiumhook/premiumhook.php";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(37, 'comment_max_links', '2', 'yes'),
(38, 'gmt_offset', '3', 'yes'),
(39, 'default_email_category', '1', 'yes'),
(40, 'recently_edited', '', 'no'),
(41, 'template', 'exchanger', 'yes'),
(42, 'stylesheet', 'exchanger', 'yes'),
(43, 'comment_whitelist', '1', 'yes'),
(44, 'blacklist_keys', '', 'no'),
(45, 'comment_registration', '0', 'yes'),
(46, 'html_type', 'text/html', 'yes'),
(47, 'use_trackback', '0', 'yes'),
(48, 'default_role', 'users', 'yes'),
(49, 'db_version', '38590', 'yes'),
(50, 'uploads_use_yearmonth_folders', '', 'yes'),
(51, 'upload_path', '', 'yes'),
(52, 'blog_public', '1', 'yes'),
(53, 'default_link_category', '2', 'yes'),
(54, 'show_on_front', 'page', 'yes'),
(55, 'tag_base', '', 'yes'),
(56, 'show_avatars', '1', 'yes'),
(57, 'avatar_rating', 'G', 'yes'),
(58, 'upload_url_path', '', 'yes'),
(59, 'thumbnail_size_w', '150', 'yes'),
(60, 'thumbnail_size_h', '150', 'yes'),
(61, 'thumbnail_crop', '1', 'yes'),
(62, 'medium_size_w', '300', 'yes'),
(63, 'medium_size_h', '300', 'yes'),
(64, 'avatar_default', 'mystery', 'yes'),
(65, 'large_size_w', '1024', 'yes'),
(66, 'large_size_h', '1024', 'yes'),
(67, 'image_default_link_type', 'file', 'yes'),
(68, 'image_default_size', '', 'yes'),
(69, 'image_default_align', '', 'yes'),
(70, 'close_comments_for_old_posts', '0', 'yes'),
(71, 'close_comments_days_old', '14', 'yes'),
(72, 'thread_comments', '1', 'yes'),
(73, 'thread_comments_depth', '5', 'yes'),
(74, 'page_comments', '0', 'yes'),
(75, 'comments_per_page', '50', 'yes'),
(76, 'default_comments_page', 'newest', 'yes'),
(77, 'comment_order', 'asc', 'yes'),
(78, 'sticky_posts', 'a:0:{}', 'yes'),
(79, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(80, 'widget_text', 'a:0:{}', 'yes'),
(81, 'widget_rss', 'a:0:{}', 'yes'),
(82, 'uninstall_plugins', 'a:1:{s:26:"wp-security-scan/index.php";a:2:{i:0;s:9:"WsdPlugin";i:1;s:9:"uninstall";}}', 'no'),
(83, 'timezone_string', '', 'yes'),
(84, 'page_for_posts', '5', 'yes'),
(85, 'page_on_front', '4', 'yes'),
(86, 'default_post_format', '0', 'yes'),
(87, 'link_manager_enabled', '0', 'yes'),
(88, 'finished_splitting_shared_terms', '1', 'yes'),
(89, 'initial_db_version', '33056', 'yes'),
(90, 'pr_user_roles', 'a:4:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:10:"topmeneger";a:2:{s:4:"name";s:16:"Менеджер";s:12:"capabilities";a:0:{}}s:7:"meneger";a:2:{s:4:"name";s:16:"Оператор";s:12:"capabilities";a:0:{}}s:5:"users";a:2:{s:4:"name";s:5:"users";s:12:"capabilities";a:0:{}}}', 'yes'),
(91, 'WPLANG', 'ru_RU', 'yes'),
(92, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(93, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(94, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(96, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'sidebars_widgets', 'a:3:{s:19:"wp_inactive_widgets";a:0:{}s:17:"unique-sidebar-id";a:3:{i:0;s:14:"get_pn_login-3";i:1;s:11:"get_pn_lk-2";i:2;s:16:"get_pn_reviews-2";}s:13:"array_version";i:3;}', 'yes'),
(99, 'cron', 'a:6:{i:1541687105;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1541687421;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1541690365;a:1:{s:34:"wp_privacy_delete_old_export_files";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"hourly";s:4:"args";a:0:{}s:8:"interval";i:3600;}}}i:1541705596;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1541753222;a:1:{s:25:"delete_expired_transients";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(110, '_transient_random_seed', '3350443e7f9bd30bc9deb22934d7df29', 'yes'),
(112, '_site_transient_update_plugins', 'O:8:"stdClass":4:{s:12:"last_checked";i:1541686558;s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:0:{}}', 'no'),
(113, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1541686560;s:7:"checked";a:1:{s:9:"exchanger";s:3:"1.5";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'no'),
(123, '_transient_timeout_feed_d117b5738fbd35bd8c0391cda1f2b5d9', '1445567124', 'no'),
(134, 'recently_activated', 'a:0:{}', 'yes'),
(136, 'theme_mods_twentyfifteen', 'a:1:{s:16:"sidebars_widgets";a:2:{s:4:"time";i:1445524265;s:4:"data";a:2:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}}}}', 'yes'),
(137, 'current_theme', 'Premium Exchanger Theme', 'yes'),
(138, 'theme_mods_exchanger', 'a:3:{i:0;b:0;s:18:"nav_menu_locations";a:8:{s:8:"top_menu";i:2;s:11:"bottom_menu";i:3;s:13:"top_menu_user";i:2;s:15:"mobile_top_menu";i:4;s:20:"mobile_top_menu_user";i:4;s:12:"the_top_menu";i:2;s:17:"the_top_menu_user";i:2;s:15:"the_bottom_menu";i:3;}s:18:"custom_css_post_id";i:-1;}', 'yes'),
(139, 'theme_switched', '', 'yes'),
(140, 'first_pn', '1', 'yes'),
(141, 'the_pages', 'a:36:{s:4:"home";i:4;s:4:"news";i:5;s:3:"tos";i:6;s:6:"notice";i:7;s:11:"partnersfaq";i:8;s:8:"feedback";i:10;s:5:"login";i:11;s:8:"register";i:12;s:8:"lostpass";i:13;s:7:"account";i:14;s:8:"security";i:15;s:7:"sitemap";i:16;s:6:"tarifs";i:17;s:7:"reviews";i:18;s:11:"userwallets";i:19;s:10:"userverify";i:20;s:7:"userxch";i:21;s:8:"exchange";i:206;s:12:"exchangestep";i:23;s:8:"paccount";i:24;s:11:"promotional";i:25;s:5:"pexch";i:26;s:6:"plinks";i:27;s:9:"preferals";i:28;s:7:"payouts";i:29;s:6:"domacc";i:90;s:2:"ex";i:146;s:3:"hst";i:181;s:12:"bonusarchive";i:184;s:12:"bonuspayouts";i:185;s:7:"support";i:186;s:7:"reservs";i:187;s:5:"terms";i:200;i:0;i:182;s:11:"checkstatus";i:183;s:19:"terms_personal_data";i:213;}', 'yes'),
(143, 'lcurs_parser', 'a:313:{i:8;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:7:"13.2131";}i:9;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:12:"7568.2466643";}i:10;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"31.7794";}i:1;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"63.4888";}i:2;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"15.75080959";}i:3;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"73.9327";}i:4;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"13.52581469";}i:7;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:7:"18.3126";}i:5;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:7:"240.124";}i:6;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:11:"41.64515001";}i:51;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"1.1588";}i:52;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.86296168";}i:101;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:8:"2647.243";}i:102;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"37.77514947";}i:103;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:6:"41.837";}i:104;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:13:"2390.22874489";}i:151;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"346.68";}i:152;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.88450444";}i:153;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"404.02";}i:154;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.47512499";}i:155;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:4:"5.47";}i:156;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:11:"18.28153565";}i:201;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:5:"1.996";}i:202;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";s:10:"5.01002004";}i:203;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"2.3176";}i:204;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";s:10:"4.31480842";}i:205;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:6:"3.1527";}i:251;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:60.867100000000001;}i:252;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.016400000000000001;}i:253;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:70.055199999999999;}i:254;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.014200000000000001;}i:301;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7449.8400000000001;}i:351;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:8938.7279999999992;}i:352;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.11187274";}i:353;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:520546.16262999998;}i:354;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"0.01921059";}i:355;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7641.6553400000003;}i:356;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"0.1308617";}i:357;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";s:10:"690541.355";}i:358;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.01448139";}i:359;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:104.2238;}i:360;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"9.59473748";}i:361;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:89.268000000000001;}i:362;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"11.20222252";}i:363;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6099.6235800000004;}i:364;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"1.63944543";}i:365;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.011639999999999999;}i:366;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"85.91065292";}i:367;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00042999999999999999;}i:368;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00021000000000000001;}i:369;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:3.8999999999999999;}i:370;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.8959999999999999;}i:107;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:4:"3040";}i:108;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"32.89473684";}i:105;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:4:"2625";}i:106;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"38.0952381";}i:400;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"58.205";}i:401;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.8528";}i:402;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:5:"26.99";}i:403;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"1.1732";}i:404;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"68.181";}i:405;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"31.5267";}i:406;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0172";}i:407;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0147";}i:408;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.4641";}i:409;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0374";}i:410;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0319";}i:411;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"2.1767";}i:255;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.86380000000000001;}i:257;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:27.989899999999999;}i:258;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0356;}i:259;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45810000000000001;}i:260;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2.1732999999999998;}i:261;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0304;}i:262;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:31.838100000000001;}i:263;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.025499999999999998;}i:264;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:39.001600000000003;}i:265;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.029600000000000001;}i:266;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:33.524999999999999;}i:267;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00040000000000000002;}i:268;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:2410;}i:269;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00069999999999999999;}i:270;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:935.90570000000002;}i:272;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7.3800999999999997;}i:273;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.15379999999999999;}i:274;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6.1985999999999999;}i:275;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0022000000000000001;}i:276;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:446.4692;}i:277;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0045999999999999999;}i:280;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:324.07639999999998;}i:281;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0025000000000000001;}i:283;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5.2123999999999997;}i:284;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.18590000000000001;}i:371;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.037260000000000001;}i:372;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"26.83843264";}i:373;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.06225;}i:374;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.06425703";}i:375;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:556.34500000000003;}i:376;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00179745";}i:377;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5.3254799999999998;}i:378;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.1877765";}i:379;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:32433.338479999999;}i:380;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.03083247";}i:256;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.1538999999999999;}i:271;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.13469999999999999;}i:278;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:195.69669999999999;}i:279;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0030000000000000001;}i:282;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:361.79450000000003;}i:412;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"6.6542";}i:413;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.1503";}i:414;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.2488";}i:415;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"4.0567";}i:416;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:5:"8.749";}i:417;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.1149";}i:381;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:58.256;}i:382;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"17.16561384";}i:383;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:68.025170000000003;}i:384;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"14.70044103";}i:385;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.1667000000000001;}i:386;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.85711837";}i:421;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.2488";}i:420;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"4.0567";}i:418;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.1281";}i:419;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"7.8073";}i:422;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.2916";}i:423;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:4:"3.43";}i:424;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"51.6097";}i:425;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0194";}i:285;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.9500999999999999;}i:286;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.51249999999999996;}i:288;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.43490000000000001;}i:290;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.032099999999999997;}i:291;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.060199999999999997;}i:293;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:13.6966;}i:294;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.064500000000000002;}i:295;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:73.440799999999996;}i:296;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.012699999999999999;}i:297;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0057000000000000002;}i:298;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:157.38380000000001;}i:388;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:331;}i:389;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.02114804";}i:390;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:19327.664000000001;}i:391;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.05173931";}i:392;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:284.24299999999999;}i:393;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.51811654";}i:287;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2.2711999999999999;}i:289;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:31.049700000000001;}i:292;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:14.0839;}i:551;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:7428;}i:552;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13462574";}i:553;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6424.4715088499997;}i:554;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.15565483";}i:555;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:452369.59010804002;}i:556;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"0.02210582";}i:557;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:188395.53;}i:558;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"0.05307982";}i:559;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0367059;}i:560;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"27.24357665";}i:561;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:272.08999999999997;}i:562;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.67525451";}i:563;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";d:0.6204944;}i:564;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"16.1161809";}i:565;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:460.00000002000002;}i:566;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.17391304";}i:567;a:2:{s:5:"curs1";s:7:"1000000";s:5:"curs2";d:0.5;}i:568;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"2000000";}i:569;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0113315;}i:570;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"88.24956978";}i:571;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:28231;}i:572;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.03542205";}i:573;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:398.83436159000001;}i:574;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00250731";}i:575;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5168.8999999999996;}i:576;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.19346476";}i:577;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:16810.02128361;}i:578;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.05948832";}i:579;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5.4791999999999996;}i:580;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.1825084";}i:581;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:61.600000000000001;}i:582;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.01623377";}i:583;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:0.40582999999999997;}i:584;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:13:"2464.08594732";}i:585;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:11500.01;}i:587;a:2:{s:5:"curs1";i:1;s:5:"curs2";s:13:"2152.59615887";}i:589;a:2:{s:5:"curs1";i:1;s:5:"curs2";s:9:"7142.3625";}i:586;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.08695645";}i:588;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.46455532";}i:590;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"0.1400097";}i:591;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:84.121799999999993;}i:593;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:72.905000000000001;}i:595;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";d:2.6001699999999999;}i:597;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:193.84200000000001;}i:598;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00515884";}i:600;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00596413";}i:602;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.08423181";}i:592;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:9:"1.1887525";}i:594;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:10:"1.37164804";}i:596;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"38.78709646";}i:599;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:165.34263512999999;}i:601;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:11872;}i:11;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"9.36565";}i:12;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.10677316";}i:302;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13423107";}i:700;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7450.8999999999996;}i:701;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13421197";}i:702;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:84.390000000000001;}i:703;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"11.84974523";}i:704;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.01132;}i:705;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"88.33922261";}i:706;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:461.33999999999997;}i:707;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.16759873";}i:708;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.061919000000000002;}i:709;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.15013162";}i:710;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:2.2671000000000001;}i:711;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:12:"441.09214415";}i:712;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:16.908999999999999;}i:713;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"59.1401029";}i:714;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:136.03999999999999;}i:715;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"7.35077918";}i:716;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45774999999999999;}i:717;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.18459858";}i:718;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:793.87;}i:719;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"1.25965208";}i:720;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:17777;}i:721;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.05625246";}i:722;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:284.10000000000002;}i:723;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.51988736";}i:724;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:273.27999999999997;}i:725;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.65925059";}i:726;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";d:3.6741000000000001;}i:727;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"27.21754988";}i:603;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1032.63528765;}i:604;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.96839611";}i:605;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:183.744;}i:606;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"5.44235458";}i:607;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";d:0.024034;}i:608;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:13:"4160.77223933";}i:609;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";d:0.14899999999999999;}i:610;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:14:"67114.09395973";}i:611;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:61.241;}i:612;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"16.32892997";}i:613;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.997892;}i:614;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"1.00211245";}i:615;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:462.30000000000001;}i:616;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.16309756";}i:617;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7445.8000000000002;}i:618;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"0.1343039";}i:619;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:117.23999999999999;}i:620;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"8.52951211";}i:621;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:135.16999999999999;}i:622;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"7.39809129";}i:623;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:18.241099999999999;}i:624;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"54.8212553";}i:625;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:28.077578240000001;}i:626;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.03561561";}i:627;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45710000000000001;}i:628;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"2.1877051";}i:629;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:0.061500000000000006;}i:630;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:14:"16260.16260163";}i:631;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.10659747;}i:632;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"9.38108569";}i:633;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:790.34900000000005;}i:634;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00126526";}i:635;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:48534.756598499996;}i:636;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.0000206";}i:637;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.7138;}i:638;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.58349866";}i:303;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6377.4899999999998;}i:304;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"0.1568015";}i:305;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.1679999999999999;}i:306;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.85616438";}i:307;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45739999999999997;}i:308;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.18627022";}i:309;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.39157999999999998;}i:310;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.55375658";}i:311;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6.1409999999999996E-5;}i:312;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:14:"16283.99283504";}i:313;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:84.340000000000003;}i:314;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.01185677";}i:315;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:72.299999999999997;}i:316;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.01383126";}i:317;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.011344999999999999;}i:318;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"88.14455707";}i:319;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:460.60000000000002;}i:320;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00217108";}i:321;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:394.94;}i:322;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00253203";}i:323;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.061880009999999999;}i:324;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.16030767";}i:325;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:792;}i:326;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00126263";}i:327;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:679.29999999999995;}i:328;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.0014721";}i:329;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.10667500000000001;}i:330;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"9.37426764";}i:394;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:956.14999999999998;}i:395;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"1.04586101";}i:396;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:55700.394;}i:397;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.01795319";}i:398;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:820.11400000000003;}i:399;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"1.21934268";}i:800;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.1071;}i:801;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"9.33706816";}i:802;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:9.1780000000000008;}i:803;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.1089562";}i:804;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.7190000000000001;}i:805;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.58173357";}i:806;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2.8900000000000001;}i:807;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.34602076";}i:808;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.032500000000000001;}i:809;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"30.76923077";}i:810;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:288.62;}i:811;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00346476";}}', 'yes'),
(144, 'curs_parser', 'a:313:{i:8;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:7:"13.2131";}i:9;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:12:"7568.2466643";}i:10;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"31.7794";}i:1;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"63.4888";}i:2;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"15.75080959";}i:3;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"73.9327";}i:4;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"13.52581469";}i:7;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:7:"18.3126";}i:5;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:7:"240.124";}i:6;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:11:"41.64515001";}i:51;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"1.1588";}i:52;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.86296168";}i:101;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:8:"2647.243";}i:102;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"37.77514947";}i:103;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:6:"41.837";}i:104;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:13:"2390.22874489";}i:151;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"346.68";}i:152;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.88450444";}i:153;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"404.02";}i:154;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.47512499";}i:155;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:4:"5.47";}i:156;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:11:"18.28153565";}i:201;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:5:"1.996";}i:202;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";s:10:"5.01002004";}i:203;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"2.3176";}i:204;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";s:10:"4.31480842";}i:205;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:6:"3.1527";}i:251;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:60.7575;}i:252;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.016400000000000001;}i:253;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:69.876099999999994;}i:254;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0141;}i:301;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7467.9499999999998;}i:351;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:8876.4840000000004;}i:352;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.11265722";}i:353;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:519948.35525999998;}i:354;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"0.01923268";}i:355;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7607.1701599999997;}i:356;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13145493";}i:357;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";s:10:"690541.355";}i:358;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.01448139";}i:359;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:103.5308;}i:360;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"9.65896139";}i:361;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:88.513999999999996;}i:362;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"11.29764783";}i:363;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6055.3239800000001;}i:364;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:9:"1.6514393";}i:365;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.01166;}i:366;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"85.76329331";}i:367;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00042999999999999999;}i:368;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00021000000000000001;}i:369;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:3.8999999999999999;}i:370;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.907;}i:107;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:4:"3050";}i:108;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"32.78688525";}i:105;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:4:"2625";}i:106;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"38.0952381";}i:400;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"58.205";}i:401;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.8528";}i:402;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:5:"26.99";}i:403;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"1.1732";}i:404;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"68.181";}i:405;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"31.5267";}i:406;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0172";}i:407;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0147";}i:408;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.4641";}i:409;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0374";}i:410;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0319";}i:411;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"2.1767";}i:255;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.86380000000000001;}i:257;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:28.0425;}i:258;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.035499999999999997;}i:259;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.4607;}i:260;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2.1524999999999999;}i:261;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0304;}i:262;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:31.838100000000001;}i:263;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.025499999999999998;}i:264;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:39.001600000000003;}i:265;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.029600000000000001;}i:266;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:33.524999999999999;}i:267;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00040000000000000002;}i:268;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2388.3672000000001;}i:269;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.00069999999999999999;}i:270;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:935.90570000000002;}i:272;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7.4043999999999999;}i:273;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.15379999999999999;}i:274;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6.1985999999999999;}i:275;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0022000000000000001;}i:276;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:445.86750000000001;}i:277;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0045999999999999999;}i:280;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:323.83629999999999;}i:281;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0025000000000000001;}i:283;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5.2122999999999999;}i:284;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.18590000000000001;}i:371;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.037060000000000003;}i:372;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"26.98327037";}i:373;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.062230000000000001;}i:374;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.06941989";}i:375;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:553.02000999999996;}i:376;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00180825";}i:377;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5.3555799999999998;}i:378;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.18672114";}i:379;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:32391.221229999999;}i:380;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.03087256";}i:256;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.1536;}i:271;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.1343;}i:278;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:196.2329;}i:279;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0030000000000000001;}i:282;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:361.79450000000003;}i:412;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"6.6542";}i:413;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.1503";}i:414;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.2488";}i:415;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"4.0567";}i:416;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:5:"8.749";}i:417;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.1149";}i:381;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:58.5;}i:382;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"17.09401709";}i:383;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:68.098179999999999;}i:384;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"14.68468027";}i:385;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.16656;}i:386;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.85722123";}i:421;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.2488";}i:420;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"4.0567";}i:418;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.1281";}i:419;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"7.8073";}i:422;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.2916";}i:423;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:4:"3.43";}i:424;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"51.6097";}i:425;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:6:"0.0194";}i:285;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.9394;}i:286;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.51280000000000003;}i:288;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.435;}i:290;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.032099999999999997;}i:291;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.060199999999999997;}i:293;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:13.705299999999999;}i:294;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.064500000000000002;}i:295;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:73.440799999999996;}i:296;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.012699999999999999;}i:297;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0057000000000000002;}i:298;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:157.38380000000001;}i:388;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:330.92946999999998;}i:389;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.02179192";}i:390;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:19259.482;}i:391;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.05192248";}i:392;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:282.93400000000003;}i:393;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.53439318";}i:287;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2.2711999999999999;}i:289;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:31.060700000000001;}i:292;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:13.333299999999999;}i:551;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7437.2299999999996;}i:552;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13445866";}i:553;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:6416;}i:554;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.15586035";}i:555;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:456000;}i:556;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"0.02192982";}i:557;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:187445;}i:558;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";s:10:"0.05334898";}i:559;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.036662;}i:560;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"27.27619879";}i:561;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:273.79000000000002;}i:562;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.65243435";}i:563;a:2:{s:5:"curs1";s:2:"10";s:5:"curs2";d:0.61928899999999998;}i:564;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.14754985";}i:565;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:460.52999999999997;}i:566;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"2.1714112";}i:567;a:2:{s:5:"curs1";s:7:"1000000";s:5:"curs2";d:0.5;}i:568;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"2000000";}i:569;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.011287999999999999;}i:570;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"88.58965273";}i:571;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:28122.939999999999;}i:572;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.03555816";}i:573;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:399.47000000000003;}i:574;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00250332";}i:575;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5143.8999999999996;}i:576;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.19440502";}i:577;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:16743.799999999999;}i:578;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"0.0597236";}i:579;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:5.4612999999999996;}i:580;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.18310659";}i:581;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:61.43;}i:582;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.01627869";}i:583;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:0.40193000000000001;}i:584;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:13:"2487.99542209";}i:585;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:11500.01;}i:587;a:2:{s:5:"curs1";i:1;s:5:"curs2";s:13:"2142.18487136";}i:589;a:2:{s:5:"curs1";i:1;s:5:"curs2";s:9:"7186.9875";}i:586;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.08695645";}i:588;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.46681312";}i:590;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13914036";}i:591;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:84.049599999999998;}i:593;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:72.384;}i:595;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";d:2.601;}i:597;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:193.85900000000001;}i:598;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00515839";}i:600;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00599039";}i:602;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.08486811";}i:592;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:10:"1.18977366";}i:594;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";s:10:"1.38152078";}i:596;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"38.78709646";}i:599;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:165.34263512999999;}i:601;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:11782.988738370001;}i:11;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:7:"9.36565";}i:12;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.10677316";}i:302;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13390556";}i:700;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7473.1999999999998;}i:701;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13381149";}i:702;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:84.188999999999993;}i:703;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"11.87803632";}i:704;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.011261;}i:705;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"88.80206021";}i:706;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:463.22000000000003;}i:707;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.15880143";}i:708;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.061969999999999997;}i:709;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.13684041";}i:710;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:2.246;}i:711;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:12:"445.23597507";}i:712;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:16.800000000000001;}i:713;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"59.52380952";}i:714;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:136.61000000000001;}i:715;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"7.32010834";}i:716;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45798;}i:717;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.18350146";}i:718;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:792.12;}i:719;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"1.26243498";}i:720;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:17777;}i:721;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.05625246";}i:722;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:284.10000000000002;}i:723;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.51988736";}i:724;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:274.32999999999998;}i:725;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"3.64524478";}i:726;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";d:3.6692;}i:727;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"27.25389731";}i:603;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:1024;}i:604;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"0.9765625";}i:605;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:183.27000000000001;}i:606;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:9:"5.4564304";}i:607;a:2:{s:5:"curs1";s:3:"100";s:5:"curs2";d:0.023911000000000002;}i:608;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:13:"4182.17556773";}i:609;a:2:{s:5:"curs1";s:5:"10000";s:5:"curs2";d:0.14699999999999999;}i:610;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:14:"68027.21088435";}i:611;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:61.512;}i:612;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:11:"16.25699051";}i:613;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.99818499999999999;}i:614;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"1.0018183";}i:615;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:463.09300000000002;}i:616;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"2.15939347";}i:617;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:7440.5;}i:618;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.13439957";}i:619;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:117.77104006;}i:620;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"8.49105179";}i:621;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:135.65000000000001;}i:622;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"7.37191301";}i:623;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:18.217600000000001;}i:624;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"54.8919726";}i:625;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:28.170999999999999;}i:626;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.0354975";}i:627;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45885587999999999;}i:628;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.17933352";}i:629;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";d:0.061580000000000003;}i:630;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:14:"16239.03864891";}i:631;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.1061058;}i:632;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"9.42455549";}i:633;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:791.99603965999995;}i:634;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00126263";}i:635;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:48454;}i:636;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00002064";}i:637;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.7159;}i:638;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.58278454";}i:303;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6390.75;}i:304;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.15647616";}i:305;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.1714899999999999;}i:306;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.85361377";}i:307;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.45854;}i:308;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.18083482";}i:309;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.39012000000000002;}i:310;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"2.56331385";}i:311;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:6.122E-5;}i:312;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:14:"16334.53119895";}i:313;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:84.310000000000002;}i:314;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.01186099";}i:315;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:71.709999999999994;}i:316;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.01394506";}i:317;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.01124442;}i:318;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"88.93299966";}i:319;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:463.31;}i:320;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00215838";}i:321;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:395.89999999999998;}i:322;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00252589";}i:323;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.062010000000000003;}i:324;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"16.12643122";}i:325;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:792.63;}i:326;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00126162";}i:327;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";i:676;}i:328;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00147929";}i:329;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.10616304;}i:330;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"9.41947405";}i:394;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:945.84500000000003;}i:395;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"1.05725568";}i:396;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:55459.800000000003;}i:397;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"0.01803108";}i:398;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:815.625;}i:399;a:2:{s:5:"curs1";s:4:"1000";s:5:"curs2";s:10:"1.22605364";}i:800;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.1065;}i:801;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"9.38967136";}i:802;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:9.1850000000000005;}i:803;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.10887316";}i:804;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:1.7150000000000001;}i:805;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.58309038";}i:806;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:2.8809999999999998;}i:807;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:9:"0.3471017";}i:808;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:0.0315;}i:809;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:11:"31.74603175";}i:810;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";d:281.92700000000002;}i:811;a:2:{s:5:"curs1";s:1:"1";s:5:"curs2";s:10:"0.00354702";}}', 'yes'),
(145, 'time_parser', '1532105326', 'yes'),
(146, 'the_cron', 'a:9:{s:3:"now";i:1532093896;s:4:"2min";i:1532093823;s:4:"5min";i:1532093643;s:5:"10min";i:1532093823;s:5:"30min";i:1532093343;s:5:"1hour";i:1532093223;s:5:"3hour";i:1532089551;s:5:"05day";i:1532089551;s:4:"1day";i:1532089551;}', 'yes'),
(147, 'pn_lang', 'a:4:{s:10:"admin_lang";s:5:"ru_RU";s:9:"site_lang";s:5:"ru_RU";s:12:"multilingual";i:1;s:14:"multisite_lang";a:2:{i:0;s:5:"ru_RU";i:1;s:5:"en_US";}}', 'yes'),
(148, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:"auto_add";a:0:{}}', 'yes'),
(149, 'check_new_user', 'a:5:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";}', 'yes'),
(150, 'reserv_out', 'a:8:{i:0;s:3:"new";i:1;s:7:"techpay";i:2;s:5:"payed";i:3;s:7:"coldpay";i:4;s:7:"realpay";i:5;s:6:"verify";i:6;s:11:"coldsuccess";i:7;s:7:"success";}', 'yes'),
(151, 'reserv_in', 'a:5:{i:0;s:5:"payed";i:1;s:7:"coldpay";i:2;s:7:"realpay";i:3;s:6:"verify";i:4;s:7:"success";}', 'yes'),
(152, 'widget_get_pn_login', 'a:2:{i:3;a:2:{s:10:"titleru_RU";s:0:"";s:10:"titleen_US";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `pr_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(153, 'widget_get_pn_lk', 'a:2:{i:2;a:2:{s:10:"titleru_RU";s:0:"";s:10:"titleen_US";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(154, 'widget_get_pn_lastobmen', 'a:2:{i:2;a:2:{s:10:"titleru_RU";s:0:"";s:10:"titleen_US";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(155, 'widget_get_pn_reviews', 'a:2:{i:2;a:3:{s:10:"titleru_RU";s:0:"";s:10:"titleen_US";s:0:"";s:5:"count";s:1:"3";}s:12:"_multiwidget";i:1;}', 'yes'),
(156, 'widget_get_pn_cbr', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(157, 'widget_get_userverify', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(158, 'h_change', 'a:10:{s:9:"fixheader";i:1;s:8:"linkhead";i:0;s:5:"phone";s:62:"[ru_RU:]8 800 123 45 67[:ru_RU][en_US:]8 800 123 45 67[:en_US]";s:3:"icq";s:0:"";s:5:"skype";s:46:"[ru_RU:]premium[:ru_RU][en_US:]premium[:en_US]";s:5:"email";s:56:"[ru_RU:]info@premium[:ru_RU][en_US:]info@premium[:en_US]";s:8:"telegram";s:48:"[ru_RU:]@premium[:ru_RU][en_US:]@premium[:en_US]";s:5:"viber";s:0:"";s:7:"whatsup";s:0:"";s:6:"jabber";s:0:"";}', 'yes'),
(159, 'ho_change', 'a:11:{s:9:"blocknews";i:1;s:7:"catnews";i:0;s:11:"blocreviews";i:1;s:13:"blockarticles";i:0;s:6:"wtitle";s:0:"";s:6:"ititle";s:117:"[ru_RU:]Приветствуем на сайте обменного пункта![:ru_RU][en_US:]Dear guests![:en_US]";s:5:"wtext";s:0:"";s:5:"itext";s:3182:"[ru_RU:]Наш On-line сервис предназначен для тех, кто хочет быстро, безопасно и по выгодному курсу обменять такие виды электронных валют: Webmoney, Perfect Money, Qiwi, PayPal, Яндекс. Деньги, Альфа-Банк, ВТБ 24, Приват24, Visa/Master Card, Western uniоn, MoneyGram.\r\n\r\nЭтим возможности нашего сервиса не ограничиваются. В рамках проекта действуют программа лояльности, накопительная скидка и партнерская программа, воспользовавшись преимуществами которых, вы сможете совершать обмен электронных валют на более выгодных условиях. Для этого нужно просто зарегистрироваться на сайте.\r\n\r\nНаш пункт обмена электронных валют – система, созданная на базе современного программного обеспечения и содержащая весь набор необходимых функций для удобной и безопасной конвертации наиболее распространенных видов электронных денег. За время работы мы приобрели репутацию проверенного партнера и делаем все возможное, чтобы ваши впечатления от нашего сервиса были только благоприятными.[:ru_RU][en_US:]ur website is dedicated to those who wish to exchange own currency in a luxurious way! We welcome you on our grounds and hope that our online service will deliver you the most awesome experience you ever had. Our major point is to provide our clients the safest and quickest method to make transactions using each of the following payment systems: Webmoney, Perfect Money, LiqPay, Pecunix, Payza, Visa/Master Card, Western uniоn, MoneyGram. \r\n\r\nMoreover, we are also pleased to inform you that here you are to encounter the best rates on the whole net. Be sure to know that we provide much more useful and popular up-to-date services among which you are to encounter affiliate programs and additional discounts as well as loyalty program. All these services will provide you to trade your currency in the most profitable ways and under the best conditions. All you need to do is register on our website and start to burn financial skies.\r\n\r\nAt last, we are pleased to announce you that our exchange system of electronic currencies based on the up-to-date software and willing to provide you with the most awesome functions, you might need for convenient and safest converting any type of electronic currency you possess. Note that our team already gained a reputation as a trusted partner and is well known worldwide. For now, we are willing to do our best for you as well as for your wallet to provide the next-level experience and positive emotions.[:en_US]";s:9:"lastobmen";i:1;s:8:"hidecurr";s:0:"";s:8:"partners";i:1;}', 'yes'),
(160, 'f_change', 'a:7:{s:5:"ctext";s:120:"[ru_RU:]Сервис обмена электронных валют.[:ru_RU][en_US:]E-currency exchange service.[:en_US]";s:9:"timetable";s:188:"[ru_RU:]Пн. — Пт. с 10:00 до 23:00 по мск.\r\nСб. — Вск. свободный график.[:ru_RU][en_US:]Mon – Fri 10 a.m. till 11 p.m.\r\nSat – Sun free time.[:en_US]";s:5:"phone";s:62:"[ru_RU:]8 800 123 45 67[:ru_RU][en_US:]8 800 123 45 67[:en_US]";s:2:"vk";s:10:"[soc_link]";s:2:"fb";s:10:"[soc_link]";s:2:"gp";s:10:"[soc_link]";s:2:"tw";s:10:"[soc_link]";}', 'yes'),
(163, 'work_parser', 'a:311:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;i:5;i:1;i:6;i:1;i:8;i:1;i:9;i:1;i:10;i:1;i:51;i:1;i:52;i:1;i:101;i:1;i:102;i:1;i:103;i:1;i:104;i:1;i:151;i:1;i:152;i:1;i:153;i:1;i:154;i:1;i:155;i:1;i:156;i:1;i:201;i:1;i:202;i:1;i:203;i:1;i:204;i:1;i:205;i:1;i:301;i:1;i:352;i:1;i:351;i:1;i:353;i:1;i:354;i:1;i:355;i:1;i:356;i:1;i:357;i:1;i:359;i:1;i:358;i:1;i:360;i:1;i:361;i:1;i:362;i:1;i:363;i:1;i:364;i:1;i:365;i:1;i:366;i:1;i:367;i:1;i:368;i:1;i:370;i:1;i:369;i:1;i:253;i:1;i:251;i:1;i:252;i:1;i:254;i:1;i:7;i:1;i:105;i:1;i:106;i:1;i:107;i:1;i:108;i:1;i:255;i:1;i:257;i:1;i:258;i:1;i:259;i:1;i:260;i:1;i:261;i:1;i:262;i:1;i:263;i:1;i:264;i:1;i:265;i:1;i:266;i:1;i:267;i:1;i:268;i:1;i:269;i:1;i:270;i:1;i:272;i:1;i:273;i:1;i:274;i:1;i:275;i:1;i:276;i:1;i:277;i:1;i:280;i:1;i:281;i:1;i:283;i:1;i:284;i:1;i:371;i:1;i:372;i:1;i:374;i:1;i:375;i:1;i:376;i:1;i:377;i:1;i:378;i:1;i:379;i:1;i:380;i:1;i:400;i:1;i:401;i:1;i:402;i:1;i:403;i:1;i:404;i:1;i:405;i:1;i:406;i:1;i:407;i:1;i:408;i:1;i:409;i:1;i:410;i:1;i:411;i:1;i:256;i:1;i:271;i:1;i:278;i:1;i:279;i:1;i:282;i:1;i:373;i:1;i:381;i:1;i:382;i:1;i:383;i:1;i:384;i:1;i:385;i:1;i:386;i:1;i:412;i:1;i:414;i:1;i:416;i:1;i:417;i:1;i:285;i:1;i:286;i:1;i:288;i:1;i:290;i:1;i:291;i:1;i:293;i:1;i:294;i:1;i:295;i:1;i:296;i:1;i:297;i:1;i:298;i:1;i:388;i:1;i:389;i:1;i:391;i:1;i:392;i:1;i:393;i:1;i:415;i:1;i:413;i:1;i:418;i:1;i:419;i:1;i:420;i:1;i:422;i:1;i:424;i:1;i:425;i:1;i:289;i:1;i:287;i:1;i:292;i:1;i:551;i:1;i:552;i:1;i:553;i:1;i:554;i:1;i:555;i:1;i:556;i:1;i:557;i:1;i:558;i:1;i:559;i:1;i:560;i:1;i:561;i:1;i:562;i:1;i:563;i:1;i:564;i:1;i:565;i:1;i:566;i:1;i:585;i:1;i:567;i:1;i:568;i:1;i:569;i:1;i:570;i:1;i:587;i:1;i:571;i:1;i:572;i:1;i:573;i:1;i:574;i:1;i:575;i:1;i:576;i:1;i:577;i:1;i:578;i:1;i:579;i:1;i:580;i:1;i:581;i:1;i:582;i:1;i:583;i:1;i:584;i:1;i:589;i:1;i:588;i:1;i:590;i:1;i:591;i:1;i:593;i:1;i:595;i:1;i:597;i:1;i:598;i:1;i:600;i:1;i:602;i:1;i:601;i:1;i:599;i:1;i:596;i:1;i:594;i:1;i:592;i:1;i:11;i:1;i:12;i:1;i:302;i:1;i:303;i:1;i:304;i:1;i:305;i:1;i:306;i:1;i:307;i:1;i:308;i:1;i:309;i:1;i:310;i:1;i:311;i:1;i:312;i:1;i:313;i:1;i:314;i:1;i:315;i:1;i:316;i:1;i:317;i:1;i:318;i:1;i:319;i:1;i:320;i:1;i:321;i:1;i:322;i:1;i:323;i:1;i:324;i:1;i:325;i:1;i:326;i:1;i:327;i:1;i:328;i:1;i:329;i:1;i:330;i:1;i:390;i:1;i:394;i:1;i:395;i:1;i:396;i:1;i:397;i:1;i:398;i:1;i:399;i:1;i:800;i:1;i:801;i:1;i:802;i:1;i:803;i:1;i:804;i:1;i:805;i:1;i:806;i:1;i:807;i:1;i:808;i:1;i:809;i:1;i:810;i:1;i:811;i:1;i:586;i:1;i:603;i:1;i:604;i:1;i:605;i:1;i:606;i:1;i:607;i:1;i:608;i:1;i:609;i:1;i:610;i:1;i:611;i:1;i:612;i:1;i:613;i:1;i:614;i:1;i:615;i:1;i:616;i:1;i:617;i:1;i:618;i:1;i:619;i:1;i:620;i:1;i:621;i:1;i:622;i:1;i:623;i:1;i:624;i:1;i:625;i:1;i:626;i:1;i:627;i:1;i:628;i:1;i:629;i:1;i:630;i:1;i:631;i:1;i:632;i:1;i:633;i:1;i:634;i:1;i:635;i:1;i:636;i:1;i:637;i:1;i:638;i:1;i:700;i:1;i:701;i:1;i:702;i:1;i:703;i:1;i:704;i:1;i:705;i:1;i:706;i:1;i:707;i:1;i:708;i:1;i:709;i:1;i:710;i:1;i:711;i:1;i:712;i:1;i:713;i:1;i:714;i:1;i:715;i:1;i:716;i:1;i:717;i:1;i:718;i:1;i:719;i:1;i:720;i:1;i:721;i:1;i:722;i:1;i:723;i:1;i:724;i:1;i:725;i:1;i:726;i:1;i:727;i:1;}', 'yes'),
(164, 'config_parser', 'a:127:{i:301;s:4:"last";i:351;s:4:"last";i:353;s:4:"last";i:355;s:4:"last";i:357;s:4:"last";i:359;s:4:"last";i:361;s:4:"last";i:363;s:4:"last";i:365;s:4:"last";i:367;s:4:"last";i:368;s:4:"last";i:369;s:4:"last";i:370;s:4:"last";i:371;s:4:"last";i:373;s:4:"last";i:375;s:4:"last";i:377;s:4:"last";i:379;s:4:"last";i:388;s:4:"last";i:551;s:10:"last_trade";i:552;s:10:"last_trade";i:553;s:10:"last_trade";i:554;s:10:"last_trade";i:555;s:10:"last_trade";i:556;s:10:"last_trade";i:557;s:10:"last_trade";i:558;s:10:"last_trade";i:559;s:10:"last_trade";i:560;s:10:"last_trade";i:561;s:10:"last_trade";i:562;s:10:"last_trade";i:563;s:10:"last_trade";i:564;s:10:"last_trade";i:565;s:10:"last_trade";i:566;s:10:"last_trade";i:567;s:10:"last_trade";i:568;s:10:"last_trade";i:569;s:10:"last_trade";i:570;s:10:"last_trade";i:571;s:10:"last_trade";i:572;s:10:"last_trade";i:573;s:10:"last_trade";i:574;s:10:"last_trade";i:575;s:10:"last_trade";i:576;s:10:"last_trade";i:577;s:10:"last_trade";i:578;s:10:"last_trade";i:579;s:10:"last_trade";i:580;s:10:"last_trade";i:581;s:10:"last_trade";i:582;s:10:"last_trade";i:583;s:10:"last_trade";i:584;s:10:"last_trade";i:591;s:10:"last_trade";i:592;s:10:"last_trade";i:593;s:10:"last_trade";i:594;s:10:"last_trade";i:595;s:10:"last_trade";i:597;s:10:"last_trade";i:598;s:10:"last_trade";i:600;s:10:"last_trade";i:602;s:10:"last_trade";i:601;s:10:"last_trade";i:603;s:10:"last_trade";i:604;s:10:"last_trade";i:605;s:10:"last_trade";i:606;s:10:"last_trade";i:607;s:10:"last_trade";i:608;s:10:"last_trade";i:609;s:10:"last_trade";i:610;s:10:"last_trade";i:611;s:10:"last_trade";i:612;s:10:"last_trade";i:613;s:10:"last_trade";i:614;s:10:"last_trade";i:615;s:10:"last_trade";i:616;s:10:"last_trade";i:617;s:10:"last_trade";i:618;s:10:"last_trade";i:619;s:10:"last_trade";i:620;s:10:"last_trade";i:621;s:10:"last_trade";i:622;s:10:"last_trade";i:623;s:10:"last_trade";i:624;s:10:"last_trade";i:625;s:10:"last_trade";i:626;s:10:"last_trade";i:627;s:10:"last_trade";i:628;s:10:"last_trade";i:629;s:10:"last_trade";i:630;s:10:"last_trade";i:631;s:10:"last_trade";i:632;s:10:"last_trade";i:633;s:10:"last_trade";i:634;s:10:"last_trade";i:635;s:10:"last_trade";i:636;s:10:"last_trade";i:637;s:10:"last_trade";i:638;s:10:"last_trade";i:700;s:10:"last_price";i:701;s:10:"last_price";i:702;s:10:"last_price";i:703;s:10:"last_price";i:704;s:10:"last_price";i:705;s:10:"last_price";i:706;s:10:"last_price";i:707;s:10:"last_price";i:708;s:10:"last_price";i:709;s:10:"last_price";i:710;s:10:"last_price";i:711;s:10:"last_price";i:712;s:10:"last_price";i:713;s:10:"last_price";i:714;s:10:"last_price";i:715;s:10:"last_price";i:716;s:10:"last_price";i:717;s:10:"last_price";i:718;s:10:"last_price";i:719;s:10:"last_price";i:720;s:10:"last_price";i:721;s:10:"last_price";i:722;s:10:"last_price";i:723;s:10:"last_price";i:724;s:10:"last_price";i:725;s:10:"last_price";i:726;s:10:"last_price";i:727;s:10:"last_price";}', 'yes'),
(166, 'banners', 'a:5:{s:7:"banner1";a:1:{i:0;s:211:"<a href="[partner_link]"><img src="[url]/wp-content/plugins/premiumbox/images/banners/468x60_1.gif" alt="Обменный пункт" title="Обменный пункт" width="468" height="60" border="0" /></a>";}s:7:"banner2";a:1:{i:0;s:213:"<a href="[partner_link]"><img src="[url]/wp-content/plugins/premiumbox/images/banners/200x200_1.gif" alt="Обменный пункт" title="Обменный пункт" width="200" height="200" border="0" /></a>";}s:7:"banner3";a:1:{i:0;s:213:"<a href="[partner_link]"><img src="[url]/wp-content/plugins/premiumbox/images/banners/120x600_1.gif" alt="Обменный пункт" title="Обменный пункт" width="120" height="600" border="0" /></a>";}s:7:"banner4";a:1:{i:0;s:213:"<a href="[partner_link]"><img src="[url]/wp-content/plugins/premiumbox/images/banners/100x100_1.gif" alt="Обменный пункт" title="Обменный пункт" width="100" height="100" border="0" /></a>";}s:7:"banner5";a:1:{i:0;s:209:"<a href="[partner_link]"><img src="[url]/wp-content/plugins/premiumbox/images/banners/88x31_1.gif" alt="Обменный пункт" title="Обменный пункт" width="88" height="31" border="0" /></a>";}}', 'yes'),
(194, 'WPS_KEEP_NUM_ENTRIES_LT', '500', 'yes'),
(195, 'WPS_REFRESH_RATE_AJAX_LT', '10', 'yes'),
(231, 'inex_pages', 'a:2:{s:8:"toinvest";i:136;s:9:"indeposit";i:85;}', 'yes'),
(234, 'widget_get_pn_news', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(235, 'widget_get_pn_register', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(236, 'widget_get_pn_reserv', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(237, 'widget_get_pn_text', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(238, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(239, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(240, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(241, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(242, 'site_icon', '0', 'yes'),
(243, 'medium_large_size_w', '768', 'yes'),
(244, 'medium_large_size_h', '0', 'yes'),
(245, 'db_upgraded', '', 'yes'),
(259, 'widget_get_pn_lastobmens', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(262, 'pn_extended', 'a:3:{s:6:"moduls";a:62:{s:12:"finstats_bid";s:12:"finstats_bid";s:12:"admincaptcha";s:12:"admincaptcha";s:9:"apbd_logs";s:9:"apbd_logs";s:12:"archive_bids";s:12:"archive_bids";s:12:"autodel_bids";s:12:"autodel_bids";s:8:"bcbroker";s:8:"bcbroker";s:3:"bcc";s:3:"bcc";s:13:"beautyaccount";s:13:"beautyaccount";s:9:"beautynum";s:9:"beautynum";s:7:"bidlogs";s:7:"bidlogs";s:12:"bids_comment";s:12:"bids_comment";s:9:"blacklist";s:9:"blacklist";s:7:"captcha";s:7:"captcha";s:8:"contacts";s:8:"contacts";s:11:"cron_reserv";s:11:"cron_reserv";s:9:"currlimit";s:9:"currlimit";s:9:"currtable";s:9:"currtable";s:14:"direction_copy";s:14:"direction_copy";s:9:"discounts";s:9:"discounts";s:13:"dop_bidfilter";s:13:"dop_bidfilter";s:8:"editbids";s:8:"editbids";s:3:"fav";s:3:"fav";s:8:"finstats";s:8:"finstats";s:5:"geoip";s:5:"geoip";s:6:"hotkey";s:6:"hotkey";s:7:"htmlmap";s:7:"htmlmap";s:8:"js_timer";s:8:"js_timer";s:4:"live";s:4:"live";s:10:"livestatus";s:10:"livestatus";s:8:"mailsmtp";s:8:"mailsmtp";s:9:"mailtemps";s:9:"mailtemps";s:10:"maintrance";s:10:"maintrance";s:14:"many_operators";s:14:"many_operators";s:12:"maxpaybutton";s:12:"maxpaybutton";s:6:"mobile";s:6:"mobile";s:10:"naps_guest";s:10:"naps_guest";s:8:"naps_sms";s:8:"naps_sms";s:9:"napsfiles";s:9:"napsfiles";s:9:"napslangs";s:9:"napslangs";s:12:"napsredirect";s:12:"napsredirect";s:7:"newuser";s:7:"newuser";s:13:"notice_header";s:13:"notice_header";s:7:"numsymb";s:7:"numsymb";s:8:"operator";s:8:"operator";s:15:"parser_settings";s:15:"parser_settings";s:8:"partners";s:8:"partners";s:15:"paymerchantlogs";s:15:"paymerchantlogs";s:11:"payouterror";s:11:"payouterror";s:17:"payouterror_check";s:17:"payouterror_check";s:2:"pp";s:2:"pp";s:9:"qr_adress";s:9:"qr_adress";s:7:"reviews";s:7:"reviews";s:3:"seo";s:3:"seo";s:6:"tarifs";s:6:"tarifs";s:10:"user_login";s:10:"user_login";s:10:"userverify";s:10:"userverify";s:11:"userwallets";s:11:"userwallets";s:7:"userxch";s:7:"userxch";s:9:"vaccounts";s:9:"vaccounts";s:13:"walletsverify";s:13:"walletsverify";s:3:"x19";s:3:"x19";s:8:"zreserve";s:8:"zreserve";}s:12:"paymerchants";a:0:{}s:9:"merchants";a:0:{}}', 'yes'),
(265, 'paymerchants', 'a:13:{s:7:"blockio";i:0;s:4:"btce";i:0;s:6:"domacc";i:0;s:6:"edinar";i:0;s:8:"livecoin";i:0;s:8:"nixmoney";i:0;s:5:"okpay";i:0;s:12:"perfectmoney";i:0;s:6:"privat";i:0;s:8:"webmoney";i:0;s:7:"yamoney";i:0;s:4:"exmo";i:0;s:7:"advcash";i:0;}', 'yes'),
(275, 'merchants', 'a:23:{s:7:"advcash";i:0;s:10:"blockchain";i:0;s:7:"blockio";i:0;s:4:"btce";i:0;s:6:"domacc";i:0;s:6:"edinar";i:0;s:10:"helixmoney";i:0;s:6:"liqpay";i:0;s:8:"livecoin";i:0;s:8:"nixmoney";i:0;s:5:"okpay";i:0;s:6:"ooopay";i:0;s:5:"paxum";i:0;s:6:"payeer";i:0;s:6:"paymer";i:0;s:6:"paypal";i:0;s:12:"perfectmoney";i:0;s:6:"privat";i:0;s:8:"qiwishop";i:0;s:6:"webfin";i:0;s:8:"webmoney";i:0;s:7:"yamoney";i:0;s:8:"zpayment";i:0;}', 'yes'),
(278, 'rewrite_rules', 'a:86:{s:27:"exchange-([\\-_A-Za-z0-9]+)$";s:46:"index.php?pagename=exchange&pnhash=$matches[1]";s:22:"hst_([A-Za-z0-9]{35})$";s:41:"index.php?pagename=hst&hashed=$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:23:"category/(.+?)/embed/?$";s:46:"index.php?category_name=$matches[1]&embed=true";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:20:"tag/([^/]+)/embed/?$";s:36:"index.php?tag=$matches[1]&embed=true";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:21:"type/([^/]+)/embed/?$";s:44:"index.php?post_format=$matches[1]&embed=true";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:12:"robots\\.txt$";s:18:"index.php?robots=1";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:8:"embed/?$";s:21:"index.php?&embed=true";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:27:"comment-page-([0-9]{1,})/?$";s:38:"index.php?&page_id=4&cpage=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:17:"comments/embed/?$";s:21:"index.php?&embed=true";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:20:"search/(.+)/embed/?$";s:34:"index.php?s=$matches[1]&embed=true";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:23:"author/([^/]+)/embed/?$";s:44:"index.php?author_name=$matches[1]&embed=true";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:45:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$";s:74:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:32:"([0-9]{4})/([0-9]{1,2})/embed/?$";s:58:"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:19:"([0-9]{4})/embed/?$";s:37:"index.php?year=$matches[1]&embed=true";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";s:27:"[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:"[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:"[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"([^/]+)/embed/?$";s:37:"index.php?name=$matches[1]&embed=true";s:20:"([^/]+)/trackback/?$";s:31:"index.php?name=$matches[1]&tb=1";s:40:"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:28:"([^/]+)/page/?([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&paged=$matches[2]";s:35:"([^/]+)/comment-page-([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&cpage=$matches[2]";s:24:"([^/]+)(?:/([0-9]+))?/?$";s:43:"index.php?name=$matches[1]&page=$matches[2]";s:16:"[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:26:"[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:46:"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:22:"[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";}', 'yes'),
(284, 'pn_version', 'a:3:{s:4:"text";s:328:"[ru_RU:]Доступно обновление 1.5. Обновитесь по инструкции, которая доступна в личном кабинете на нашем сайте.[:ru_RU][en_US:]Updаte 1.5 is available. updаte according to the instructions that is available in your account on our website.[:en_US]";s:7:"version";s:3:"1.5";s:4:"news";a:1:{i:6;a:2:{s:5:"title";s:76:"[ru_RU:]Внимание! Рассылка от мошенников[:ru_RU]";s:4:"text";s:435:"[ru_RU:]Внимание! От нашего имени мошенники предлагают услугу по добавлению в мониторинг Bestchange и рассылают соответствующие письма. Такая услуга у нас действительно есть, но заказать ее можно только через наш сайт https://premiumexchanger.com/uslugi/#usl17[:ru_RU]";}}}', 'yes'),
(294, 'reserv_auto', 'a:7:{i:0;s:3:"new";i:1;s:7:"techpay";i:2;s:5:"payed";i:3;s:7:"coldpay";i:4;s:7:"realpay";i:5;s:6:"verify";i:6;s:11:"coldsuccess";}', 'yes'),
(295, 'pn_mailtemp_modul', 'a:2:{s:4:"mail";s:0:"";s:4:"name";s:0:"";}', 'yes'),
(296, 'pn_update_plugin_text', '', 'yes'),
(303, 'widget_get_investbox_menu_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(354, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:65:"https://downloads.wordpress.org/release/ru_RU/wordpress-4.9.8.zip";s:6:"locale";s:5:"ru_RU";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:65:"https://downloads.wordpress.org/release/ru_RU/wordpress-4.9.8.zip";s:10:"no_content";b:0;s:11:"new_bundled";b:0;s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.9.8";s:7:"version";s:5:"4.9.8";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.7";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1541686557;s:15:"version_checked";s:5:"4.9.8";s:12:"translations";a:1:{i:0;a:7:{s:4:"type";s:4:"core";s:4:"slug";s:7:"default";s:8:"language";s:5:"ru_RU";s:7:"version";s:5:"4.9.8";s:7:"updated";s:19:"2018-10-28 16:21:25";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.9.8/ru_RU.zip";s:10:"autoupdate";b:1;}}}', 'no'),
(359, 'can_compress_scripts', '1', 'no'),
(380, 'fresh_site', '0', 'yes'),
(381, 'widget_get_pn_stats', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(390, 'widget_get_pn_checkstatus', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(402, 'napsip', 'a:8:{i:0;s:3:"new";i:1;s:7:"techpay";i:2;s:5:"payed";i:3;s:7:"coldpay";i:4;s:7:"realpay";i:5;s:6:"verify";i:6;s:11:"coldsuccess";i:7;s:7:"success";}', 'yes'),
(408, 'widget_media_audio', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(409, 'widget_media_image', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(410, 'widget_media_video', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(411, 'widget_custom_html', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(443, 'widget_media_gallery', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(447, 'av_status_button', 'a:3:{i:0;s:5:"payed";i:1;s:7:"realpay";i:2;s:6:"verify";}', 'yes'),
(448, 'av_status_timeout', 'a:0:{}', 'yes'),
(476, 'pn_cron', 'a:2:{s:12:"update_times";a:1:{s:4:"site";a:9:{s:3:"now";i:1541697654;s:4:"2min";i:1541697593;s:4:"5min";i:1541697654;s:5:"10min";i:1541697340;s:5:"30min";i:1541697340;s:5:"1hour";i:1541697340;s:5:"3hour";i:1541697340;s:5:"05day";i:1541697340;s:4:"1day";i:1541697340;}}s:4:"site";a:32:{s:11:"acp_del_img";a:1:{s:11:"last_update";i:1541697340;}s:16:"delete_auto_bids";a:1:{s:11:"last_update";i:1541697654;}s:8:"del_apbd";a:1:{s:11:"last_update";i:1541697654;}s:18:"delete_notpay_bids";a:1:{s:11:"last_update";i:1541697654;}s:13:"del_operworks";a:1:{s:11:"last_update";i:1541697654;}s:18:"recalculation_bids";a:1:{s:11:"last_update";i:1540290594;}s:15:"premiumbox_chkv";a:1:{s:11:"last_update";i:1541697465;}s:16:"pn_archives_bids";a:1:{s:11:"last_update";i:1541697340;}s:15:"captcha_del_img";a:1:{s:11:"last_update";i:1541697340;}s:18:"parser_upload_data";a:1:{s:11:"last_update";i:1532105326;}s:22:"new_parser_upload_data";a:1:{s:11:"last_update";i:1541697340;}s:24:"clear_visible_userverify";a:1:{s:11:"last_update";i:1541697340;}s:12:"del_autologs";a:1:{s:11:"last_update";i:1541697340;}s:22:"delete_auto_directions";a:1:{s:11:"last_update";i:1541697340;}s:14:"delete_auto_cf";a:1:{s:11:"last_update";i:1541697340;}s:20:"delete_auto_currency";a:1:{s:11:"last_update";i:1541697340;}s:16:"delete_auto_psys";a:1:{s:11:"last_update";i:1541697340;}s:26:"delete_auto_currency_codes";a:1:{s:11:"last_update";i:1541697340;}s:15:"delete_auto_cfc";a:1:{s:11:"last_update";i:1541697340;}s:27:"delete_auto_currency_reserv";a:1:{s:11:"last_update";i:1541697340;}s:11:"del_bcclogs";a:1:{s:11:"last_update";i:1541697340;}s:14:"delete_bidlogs";a:1:{s:11:"last_update";i:1541697340;}s:16:"del_cccourselogs";a:1:{s:11:"last_update";i:1540290512;}s:14:"del_courselogs";a:1:{s:11:"last_update";i:1540290512;}s:23:"delete_auto_notice_head";a:1:{s:11:"last_update";i:1541697340;}s:29:"delete_auto_scheduleoperators";a:1:{s:11:"last_update";i:1541697340;}s:20:"delete_auto_partners";a:1:{s:11:"last_update";i:1541697340;}s:19:"del_paymerchantlogs";a:1:{s:11:"last_update";i:1541697340;}s:14:"archive_plinks";a:1:{s:11:"last_update";i:1541697340;}s:19:"delete_auto_reviews";a:1:{s:11:"last_update";i:1541697340;}s:22:"delete_last_userverify";a:1:{s:11:"last_update";i:1541697340;}s:11:"sci_del_img";a:1:{s:11:"last_update";i:1540293206;}}}', 'yes'),
(477, 'widget_get_pn_parsers', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `pr_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(478, 'pn_notify', 'a:1:{s:5:"email";a:54:{s:11:"userverify1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:122:"[ru_RU:]Запрос на верификацию личности[:ru_RU][en_US:]Request for identity verification[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:207:"[ru_RU:]На сайте [sitename] поступил запрос на верификацию личности.[:ru_RU][en_US:]You received a request for identity verification on the site [site name].[:en_US]";}s:11:"userverify2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:107:"[ru_RU:]Запрос на верификацию счета[:ru_RU][en_US:]Request for verification[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:200:"[ru_RU:]На сайте [sitename] поступил запрос на верификацию счета.[:ru_RU][en_US:]You received a request for account verification on the site [site name].[:en_US]";}s:9:"newreview";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:63:"[ru_RU:]Новый отзыв[:ru_RU][en_US:]New review[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:251:"[ru_RU:]Пользователь [user] оставил отзыв на сайте [sitename] .<br>\r\nУправление отзывом [management][:ru_RU][en_US:]User [user] write a review on site [site name].\r\nTo control review [management][:en_US]";}s:6:"payout";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:152:"[ru_RU:]Запрос выплаты партнерского вознаграждения[:ru_RU][en_US:]Request for аffiliate money withdrawal[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:206:"[ru_RU:]Пользователь [user] запросил выплату в размере [sum] на сайте [sitename].[:ru_RU][en_US:]User [user] requested payment of [sum] on site [site name].[:en_US]";}s:11:"contactform";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:67:"[ru_RU:]Обратная связь[:ru_RU][en_US:]Feedback[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:199:"[ru_RU:]Имя: [name]<br>\r\nID обмена: [idz]<br>\r\nE-mail: [email]<br>\r\nСообщение:<br>\r\n[text][:ru_RU][en_US:]Name: [name]\r\nExchange ID: [idz]\r\nE-mail: [email]\r\nMessage:\r\n[text][:en_US]";}s:9:"new_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:88:"[ru_RU:]Заявка на обмен [id][:ru_RU][en_US:]Order for exchange [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1113:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl] <br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email] <br>\r\nSkype: [user_skype]<br>[:en_US]";}s:12:"cancel_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:89:"[ru_RU:]Отмененная заявка [id][:ru_RU][en_US:]Canceled order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1113:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl] <br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email] <br>\r\nSkype: [user_skype]<br>[:en_US]";}s:11:"payed_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:103:"[ru_RU:]Оплата заявки [id] (вручную)[:ru_RU][en_US:]Paid order [id] (manual)[:en_US]";s:4:"name";s:0:"";s:4:"text";s:1110:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Orderinformation</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:13:"realpay_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:86:"[ru_RU:]Оплата заявки [id] (merchant)[:ru_RU][en_US:]Paid bid [id][:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:1110:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Bid information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to bid: [bidurl]  <br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email] <br>\r\nSkype: [user_skype]<br>[:en_US]";}s:12:"verify_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:108:"[ru_RU:]Оплата заявки [id] (на проверке)[:ru_RU][en_US:]Paid order [id] (hold)[:en_US]";s:4:"name";s:0:"";s:4:"text";s:1112:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl] <br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:11:"error_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:84:"[ru_RU:]Ошибка в заявке [id][:ru_RU][en_US:]Error in order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1112:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br> \r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:13:"success_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:92:"[ru_RU:]Выполненная заявка [id][:ru_RU][en_US:]Completed order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1112:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email] <br>\r\nSkype: [user_skype]<br>[:en_US]";}s:16:"realdelete_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:107:"[ru_RU:]Полностью удалена заявка [id][:ru_RU][en_US:]Fully deleted order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1112:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br> \r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:12:"delete_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:78:"[ru_RU:]Удалена заявка [id][:ru_RU][en_US:]Order bid [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1111:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:9:"new_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:88:"[ru_RU:]Заявка на обмен [id][:ru_RU][en_US:]Order for exchange [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:871:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: новая<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: new<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:12:"cancel_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:89:"[ru_RU:]Отмененная заявка [id][:ru_RU][en_US:]Canceled order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:890:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: отмененная<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: canceled<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:13:"userverify1_u";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:120:"[ru_RU:]Успешная верификация личности[:ru_RU][en_US:]Successful identity verification[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:159:"[ru_RU:]Ваш аккаунт верифицирован на сайте [sitename].[:ru_RU][en_US:]Your account has been verified on site [site name].[:en_US]";}s:13:"userverify2_u";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:111:"[ru_RU:]Отказ верификации личности[:ru_RU][en_US:]Refused identity verification[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:237:"[ru_RU:]Вам было отказано в верификации аккаунта на сайте [sitename] по причине: [text][:ru_RU][en_US:]You were refused verify your account on site [site name] because of: [text][:en_US]";}s:11:"payed_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:77:"[ru_RU:]Оплата заявки [id][:ru_RU][en_US:]Paid order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:891:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: оплаченная<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: paid<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:13:"realpay_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:77:"[ru_RU:]Оплата заявки [id][:ru_RU][en_US:]Paid order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:891:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: оплаченная<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: paid<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:12:"verify_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:77:"[ru_RU:]Оплата заявки [id][:ru_RU][en_US:]Paid order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:891:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: оплаченная<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: paid<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:11:"error_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:84:"[ru_RU:]Ошибка в заявке [id][:ru_RU][en_US:]Error in order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:884:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: ошибка<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: error<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:13:"success_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:92:"[ru_RU:]Выполненная заявка [id][:ru_RU][en_US:]Completed order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:898:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: выполненная<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: completed<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:16:"realdelete_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:111:"[ru_RU:]Полностью удаленная заявка [id][:ru_RU][en_US:]Fully deleted order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:913:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: полностью удалена<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: fully deleted<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:12:"delete_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:82:"[ru_RU:]Удалена заявка [id][:ru_RU][en_US:]Deleted order [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:879:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: удалена<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: deleted<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:16:"autoregisterform";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:96:"[ru_RU:]Регистрация пользователя[:ru_RU][en_US:]User registration[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:276:"[ru_RU:]Вы зарегистрировались на сайте [sitename].<br>\r\nЛогин: [login]<br>\r\nПароль: [pass]<br>\r\nEmail: [email]<br>[:ru_RU][en_US:]You registered on site [sitename].<br>\r\nLogin: [login]<br>\r\nPassword: [pass]<br>\r\nEmail: [email]<br>[:en_US]";}s:12:"lostpassform";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:90:"[ru_RU:]Восстановление пароля[:ru_RU][en_US:]Password recovery[:en_US]";s:4:"name";s:0:"";s:4:"text";s:192:"[ru_RU:]Для восстановления пароля перейдите по ссылке: <a href="[link]">[link]</a>[:ru_RU][en_US:]To recover your password click on link: [link][:en_US]";}s:12:"registerform";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:96:"[ru_RU:]Регистрация пользователя[:ru_RU][en_US:]User registration[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:276:"[ru_RU:]Вы зарегистрировались на сайте [sitename].<br>\r\nЛогин: [login]<br>\r\nПароль: [pass]<br>\r\nEmail: [email]<br>[:ru_RU][en_US:]You registered on site [sitename].<br>\r\nLogin: [login]<br>\r\nPassword: [pass]<br>\r\nEmail: [email]<br>[:en_US]";}s:13:"userverify3_u";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:113:"[ru_RU:]Успешная верификация счета[:ru_RU][en_US:]Successful account verification[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:169:"[ru_RU:]Ваш счет [purse] верифицирован на сайте [sitename].[:ru_RU][en_US:]Your account [purse] has been verified on site [site name].[:en_US]";}s:13:"userverify4_u";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:104:"[ru_RU:]Отказ верификации счета[:ru_RU][en_US:]Refused account verification[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:143:"[ru_RU:]Ваш отказано в верификации счета [purse].[:ru_RU][en_US:]Your account verification refused [purse].[:en_US]";}s:7:"zreserv";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:74:"[ru_RU:]Запрос резерва[:ru_RU][en_US:]Request reserve[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:447:"[ru_RU:]На сайте [sitename] вы оставляли запрос на резерв в размере [sum] для направления обмена [direction]. В данный момент доступен резерв в размере [summrez].[:ru_RU][en_US:]You leave a request to reserve the amount [sum] [valut] for the exchange direction [direction] on site [site name].  Currently available reserve is [summrez] [valut].[:en_US]";}s:13:"confirmreview";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:79:"[ru_RU:]Подтвердите отзыв[:ru_RU][en_US:]Confirm review[:en_US]";s:4:"name";s:0:"";s:4:"text";s:152:"[ru_RU:]Для подтверждения отзывы перейдите по ссылке [link][:ru_RU][en_US:]To confirm review go to [link][:en_US]";}s:10:"partprofit";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:120:"[ru_RU:]Начислено партнерское вознаграждение[:ru_RU][en_US:]Charge your profit[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:247:"[ru_RU:]На сайте [sitename] вам было начислено партнерского вознаграждение в размере [sum] [ctype].[:ru_RU][en_US:]You received profit in the amount [sum] [ctype] on site [sitename].[:en_US]";}s:10:"letterauth";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:67:"[ru_RU:]Авторизация[:ru_RU][en_US:]Authorization[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:133:"[ru_RU:]Для авторизации перейдите по ссылке [link][:ru_RU][en_US:]To login please go to [link][:en_US]";}s:5:"alogs";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:95:"[ru_RU:]Зафиксирован вход в аккаунт[:ru_RU][en_US:]Login report[:en_US]";s:4:"name";s:27:"Обменный пункт";s:4:"text";s:292:"[ru_RU:][date] был зафиксирован вход в ваш аккаунта на сайте [sitename] с IP адреса [ip] и браузера [browser].[:ru_RU][en_US:][date] was fixed log in into your account on site [sitename] with IP address [ip] and browser [browser].[:en_US]";}s:17:"paymerchant_error";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:85:"[ru_RU:]Ошибка авто выплаты[:ru_RU][en_US:]Auto payout error[:en_US]";s:4:"name";s:0:"";s:4:"text";s:217:"[ru_RU:]Для заявки [bid_id] во время авто выплаты произошла ошибка: [error_txt][:ru_RU][en_US:]An error occurred for the [bid_id] order during auto payout: [error_txt][:en_US]";}s:13:"coldpay_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:145:"[ru_RU:]Ожидание подтверждения от мерчанта [id][:ru_RU][en_US:]Waiting for confirmation from merchant [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1111:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:17:"coldsuccess_bids1";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:176:"[ru_RU:]Ожидание подтверждения от модуля автовыплат [id][:ru_RU][en_US:]Waiting for confirmation from the auto payout module [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1112:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br> \r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:13:"coldpay_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:175:"[ru_RU:]Ожидание подтверждения оплаты от платежной системы [id][:ru_RU][en_US:]Waiting for confirmation from merchant [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:998:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: ожидаем подтверждения оплаты от платежной системы<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: waiting for confirmation from merchant<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:17:"coldsuccess_bids2";a:6:{s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"send";i:0;s:5:"title";s:207:"[ru_RU:]Ожидание подтверждения статуса транзакции от платежной системы[:ru_RU][en_US:]Waiting for confirmation from the auto payout module [id][:en_US]";s:4:"name";s:0:"";s:4:"text";s:1035:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: ожидаем подтверждения статуса транзакции от платежной системы<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: waiting for confirmation from the auto payout module<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:13:"zreserv_admin";a:4:{s:4:"send";i:0;s:5:"title";s:74:"[ru_RU:]Запрос резерва[:ru_RU][en_US:]Reserve request[:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:386:"[ru_RU:]Пользователь ([email]) отставил запрос на резерв в размере [sum] для направления обмена [direction]. Комментарий пользователя: [comment][:ru_RU][en_US:]User ([email]) left a request for a reserve in the amount of [sum] for the exchange of direction [direction]. User comment: [comment][:en_US]";}s:25:"generate_Address2_blockio";a:4:{s:4:"send";i:0;s:5:"title";s:133:"[ru_RU:]Создан адрес для оплаты заявки [id][:ru_RU][en_US:]Address was created for payment bid [id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:162:"[ru_RU:]Создан адрес [Address] для оплаты заявки ID [bid_id].[:ru_RU][en_US:]Address [Address] was created for payment bid [id].[:en_US]";}s:28:"generate_Address2_blockchain";a:4:{s:4:"send";i:0;s:5:"title";s:133:"[ru_RU:]Создан адрес для оплаты заявки [id][:ru_RU][en_US:]Address was created for payment bid [id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:162:"[ru_RU:]Создан адрес [Address] для оплаты заявки ID [bid_id].[:ru_RU][en_US:]Address [Address] was created for payment bid [id].[:en_US]";}s:25:"generate_Address1_blockio";a:4:{s:4:"send";i:0;s:5:"title";s:133:"[ru_RU:]Создан адрес для оплаты заявки [id][:ru_RU][en_US:]Address was created for payment bid [id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:478:"[ru_RU:]Создан адрес [Address] для оплаты заявки ID [bid_id]. Необходимо оплатить сумму [sum]. Заявка будет считаться оплаченной при следующем количеств подтверждений: [count].[:ru_RU][en_US:]Address [Address] was created for payment bid [id]. You hav to pay the amount [sum]. The bid will be considered as paid in the next number of confirmations: [count].[:en_US]";}s:28:"generate_Address1_blockchain";a:4:{s:4:"send";i:0;s:5:"title";s:133:"[ru_RU:]Создан адрес для оплаты заявки [id][:ru_RU][en_US:]Address was created for payment bid [id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:478:"[ru_RU:]Создан адрес [Address] для оплаты заявки ID [bid_id]. Необходимо оплатить сумму [sum]. Заявка будет считаться оплаченной при следующем количеств подтверждений: [count].[:ru_RU][en_US:]Address [Address] was created for payment bid [id]. You hav to pay the amount [sum]. The bid will be considered as paid in the next number of confirmations: [count].[:en_US]";}s:14:"btce_paycoupon";a:4:{s:4:"send";i:0;s:5:"title";s:120:"[ru_RU:]Ваш код купона для заявки [bid_id][:ru_RU][en_US:]Your coupon code for bid [bid_id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:131:"[ru_RU:]Ваш код купона [id] для заявки [bid_id].[:ru_RU][en_US:]Your coupon [id] code for bid [bid_id][:en_US]";}s:14:"exmo_paycoupon";a:4:{s:4:"send";i:0;s:5:"title";s:120:"[ru_RU:]Ваш код купона для заявки [bid_id][:ru_RU][en_US:]Your coupon code for bid [bid_id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:131:"[ru_RU:]Ваш код купона [id] для заявки [bid_id].[:ru_RU][en_US:]Your coupon [id] code for bid [bid_id][:en_US]";}s:18:"livecoin_paycoupon";a:4:{s:4:"send";i:0;s:5:"title";s:120:"[ru_RU:]Ваш код купона для заявки [bid_id][:ru_RU][en_US:]Your coupon code for bid [bid_id][:en_US]";s:6:"tomail";s:0:"";s:4:"text";s:131:"[ru_RU:]Ваш код купона [id] для заявки [bid_id].[:ru_RU][en_US:]Your coupon [id] code for bid [bid_id][:en_US]";}s:16:"contactform_auto";a:6:{s:4:"send";i:0;s:5:"title";s:105:"[ru_RU:]Мы получили ваше сообщение[:ru_RU][en_US:]We received your message[:en_US]";s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"name";s:0:"";s:4:"text";s:189:"[ru_RU:]Мы получили ваше сообщение. Ожидайте пожалуйста ответа.[:ru_RU][en_US:]We have received your message. Expect an answer please.[:en_US]";}s:13:"techpay_bids1";a:6:{s:4:"send";i:0;s:5:"title";s:166:"[ru_RU:]Пользователь перешел на страницу оплаты по заявка [id][:ru_RU][en_US:]User go to the payment for order [id][:en_US]";s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"name";s:0:"";s:4:"text";s:1111:"[ru_RU:]<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong><br>\r\nСсылка на заявку: [bidurl] <br><br>\r\n\r\n<strong>Информация о клиенте</strong><br>\r\nИмя: [last_name] [first_name] [second_name]<br>\r\nТелефон: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:ru_RU][en_US:]<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Customer information</strong><br>\r\nName: [last_name] [first_name] [second_name]<br>\r\nPhone: [user_phone]<br>\r\nEmail: [user_email]<br>\r\nSkype: [user_skype]<br>[:en_US]";}s:13:"techpay_bids2";a:6:{s:4:"send";i:0;s:5:"title";s:166:"[ru_RU:]Пользователь перешел на страницу оплаты по заявка [id][:ru_RU][en_US:]User go to the payment for order [id][:en_US]";s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"name";s:0:"";s:4:"text";s:935:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: пользователь перешел к оплате<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: user go to the payment<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]<br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:17:"payouterror_bids2";a:6:{s:4:"send";i:0;s:5:"title";s:125:"[ru_RU:]Ошибка авто выплаты в заявке [id][:ru_RU][en_US:]Automatic payout error in order [id][:en_US]";s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"name";s:0:"";s:4:"text";s:925:"[ru_RU:]Здравствуйте.<br><br>\r\n\r\nСтатус заявки: ошибка авто выплаты<br>\r\nСсылка на заявку: [bidurl]<br><br>\r\n\r\n<strong>Информация о заявке</strong><br>\r\nID [id] от [createdate]<br>\r\nКурс обмена: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nСумма обмена: <strong>[summ1] [valut1] [vtype1] со счета [account1] -> [summ2c] [valut2] [vtype2] на счет [account2]</strong>[:ru_RU][en_US:]Hello.<br><br>\r\n\r\nOrder status: automatic payout error<br>\r\nLink to order: [bidurl]<br><br>\r\n\r\n<strong>Order information</strong><br>\r\nID [id] by [createdate]<br>\r\nExchange rate: <strong>[curs1] [valut1] [vtype1] -> [curs2] [valut2] [vtype2]</strong><br>\r\nAmount of exchange: <strong>[summ1] [valut1] [vtype1] account [account1] -> [summ2c] [valut2] [vtype2] on account of [account2]</strong><br>[:en_US]";}s:14:"newreview_auto";a:6:{s:4:"send";i:0;s:5:"title";s:94:"[ru_RU:]Мы получили ваш отзыв[:ru_RU][en_US:]We received your review[:en_US]";s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"name";s:0:"";s:4:"text";s:187:"[ru_RU:]Мы получили ваш отзыв. Ожидайте пожалуйста модерации.[:ru_RU][en_US:]We have received your review. Expect a moderation please.[:en_US]";}s:9:"napsemail";a:6:{s:4:"send";i:0;s:5:"title";s:53:"[ru_RU:]Пин код[:ru_RU][en_US:]Pin code[:en_US]";s:4:"mail";s:0:"";s:6:"tomail";s:0:"";s:4:"name";s:0:"";s:4:"text";s:69:"[ru_RU:]Пин код: [code][:ru_RU][en_US:]Pin code: [code][:en_US]";}}}', 'yes'),
(484, 'work_birgs', 'a:25:{i:0;s:3:"cbr";i:1;s:3:"ecb";i:2;s:9:"privatnbu";i:3;s:6:"privat";i:4;s:10:"nationalkz";i:5;s:4:"nbrb";i:6;s:3:"wex";i:7;s:4:"exmo";i:8;s:8:"bitfinex";i:9;s:7:"binance";i:10;s:15:"bitstamp_btcusd";i:11;s:15:"bitstamp_btceur";i:12;s:15:"bitstamp_eurusd";i:13;s:15:"bitstamp_xrpusd";i:14;s:15:"bitstamp_xrpeur";i:15;s:15:"bitstamp_xrpbtc";i:16;s:15:"bitstamp_ltcusd";i:17;s:15:"bitstamp_ltceur";i:18;s:15:"bitstamp_ltcbtc";i:19;s:15:"bitstamp_ethusd";i:20;s:15:"bitstamp_etheur";i:21;s:15:"bitstamp_ethbtc";i:22;s:15:"bitstamp_bchusd";i:23;s:15:"bitstamp_bcheur";i:24;s:15:"bitstamp_bchbtc";}', 'yes');
INSERT INTO `pr_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(485, 'parser_pairs', 'a:3108:{i:0;a:4:{s:5:"title";s:8:"AUD- RUB";s:6:"course";s:7:"46.1345";s:4:"code";s:10:"cbr_audrub";s:4:"birg";s:3:"cbr";}i:1;a:4:{s:5:"title";s:8:"AZN- RUB";s:6:"course";s:7:"38.6882";s:4:"code";s:10:"cbr_aznrub";s:4:"birg";s:3:"cbr";}i:2;a:4:{s:5:"title";s:8:"GBP- RUB";s:6:"course";s:7:"84.0909";s:4:"code";s:10:"cbr_gbprub";s:4:"birg";s:3:"cbr";}i:3;a:4:{s:5:"title";s:8:"AMD- RUB";s:6:"course";s:8:"0.135078";s:4:"code";s:10:"cbr_amdrub";s:4:"birg";s:3:"cbr";}i:4;a:4:{s:5:"title";s:8:"BYN- RUB";s:6:"course";s:7:"31.0769";s:4:"code";s:10:"cbr_bynrub";s:4:"birg";s:3:"cbr";}i:5;a:4:{s:5:"title";s:8:"BGN- RUB";s:6:"course";s:7:"38.1441";s:4:"code";s:10:"cbr_bgnrub";s:4:"birg";s:3:"cbr";}i:6;a:4:{s:5:"title";s:8:"BRL- RUB";s:6:"course";s:7:"17.7089";s:4:"code";s:10:"cbr_brlrub";s:4:"birg";s:3:"cbr";}i:7;a:4:{s:5:"title";s:8:"HUF- RUB";s:6:"course";s:8:"0.230127";s:4:"code";s:10:"cbr_hufrub";s:4:"birg";s:3:"cbr";}i:8;a:4:{s:5:"title";s:8:"HKD- RUB";s:6:"course";s:7:"8.37089";s:4:"code";s:10:"cbr_hkdrub";s:4:"birg";s:3:"cbr";}i:9;a:4:{s:5:"title";s:8:"DKK- RUB";s:6:"course";s:7:"10.0004";s:4:"code";s:10:"cbr_dkkrub";s:4:"birg";s:3:"cbr";}i:10;a:4:{s:5:"title";s:8:"USD- RUB";s:6:"course";s:7:"65.6345";s:4:"code";s:10:"cbr_usdrub";s:4:"birg";s:3:"cbr";}i:11;a:4:{s:5:"title";s:8:"EUR- RUB";s:6:"course";s:7:"74.6658";s:4:"code";s:10:"cbr_eurrub";s:4:"birg";s:3:"cbr";}i:12;a:4:{s:5:"title";s:8:"INR- RUB";s:6:"course";s:8:"0.895118";s:4:"code";s:10:"cbr_inrrub";s:4:"birg";s:3:"cbr";}i:13;a:4:{s:5:"title";s:8:"KZT- RUB";s:6:"course";s:7:"0.17805";s:4:"code";s:10:"cbr_kztrub";s:4:"birg";s:3:"cbr";}i:14;a:4:{s:5:"title";s:8:"CAD- RUB";s:6:"course";s:7:"49.9426";s:4:"code";s:10:"cbr_cadrub";s:4:"birg";s:3:"cbr";}i:15;a:4:{s:5:"title";s:8:"KGS- RUB";s:6:"course";s:8:"0.943702";s:4:"code";s:10:"cbr_kgsrub";s:4:"birg";s:3:"cbr";}i:16;a:4:{s:5:"title";s:8:"CNY- RUB";s:6:"course";s:7:"9.44612";s:4:"code";s:10:"cbr_cnyrub";s:4:"birg";s:3:"cbr";}i:17;a:4:{s:5:"title";s:8:"MDL- RUB";s:6:"course";s:7:"3.82708";s:4:"code";s:10:"cbr_mdlrub";s:4:"birg";s:3:"cbr";}i:18;a:4:{s:5:"title";s:8:"NOK- RUB";s:6:"course";s:7:"7.83911";s:4:"code";s:10:"cbr_nokrub";s:4:"birg";s:3:"cbr";}i:19;a:4:{s:5:"title";s:8:"PLN- RUB";s:6:"course";s:7:"17.3046";s:4:"code";s:10:"cbr_plnrub";s:4:"birg";s:3:"cbr";}i:20;a:4:{s:5:"title";s:8:"RON- RUB";s:6:"course";s:7:"16.0053";s:4:"code";s:10:"cbr_ronrub";s:4:"birg";s:3:"cbr";}i:21;a:4:{s:5:"title";s:8:"XDR- RUB";s:6:"course";s:6:"91.014";s:4:"code";s:10:"cbr_xdrrub";s:4:"birg";s:3:"cbr";}i:22;a:4:{s:5:"title";s:8:"SGD- RUB";s:6:"course";s:7:"47.4478";s:4:"code";s:10:"cbr_sgdrub";s:4:"birg";s:3:"cbr";}i:23;a:4:{s:5:"title";s:8:"TJS- RUB";s:6:"course";s:7:"6.96387";s:4:"code";s:10:"cbr_tjsrub";s:4:"birg";s:3:"cbr";}i:24;a:4:{s:5:"title";s:8:"TRY- RUB";s:6:"course";s:7:"11.6396";s:4:"code";s:10:"cbr_tryrub";s:4:"birg";s:3:"cbr";}i:25;a:4:{s:5:"title";s:8:"TMT- RUB";s:6:"course";s:7:"18.7795";s:4:"code";s:10:"cbr_tmtrub";s:4:"birg";s:3:"cbr";}i:26;a:4:{s:5:"title";s:8:"UZS- RUB";s:6:"course";s:10:"0.00797886";s:4:"code";s:10:"cbr_uzsrub";s:4:"birg";s:3:"cbr";}i:27;a:4:{s:5:"title";s:8:"UAH- RUB";s:6:"course";s:6:"2.3217";s:4:"code";s:10:"cbr_uahrub";s:4:"birg";s:3:"cbr";}i:28;a:4:{s:5:"title";s:8:"CZK- RUB";s:6:"course";s:7:"2.88389";s:4:"code";s:10:"cbr_czkrub";s:4:"birg";s:3:"cbr";}i:29;a:4:{s:5:"title";s:8:"SEK- RUB";s:6:"course";s:7:"7.17482";s:4:"code";s:10:"cbr_sekrub";s:4:"birg";s:3:"cbr";}i:30;a:4:{s:5:"title";s:8:"CHF- RUB";s:6:"course";s:7:"65.6279";s:4:"code";s:10:"cbr_chfrub";s:4:"birg";s:3:"cbr";}i:31;a:4:{s:5:"title";s:8:"ZAR- RUB";s:6:"course";s:7:"4.47699";s:4:"code";s:10:"cbr_zarrub";s:4:"birg";s:3:"cbr";}i:32;a:4:{s:5:"title";s:8:"KRW- RUB";s:6:"course";s:9:"0.0574577";s:4:"code";s:10:"cbr_krwrub";s:4:"birg";s:3:"cbr";}i:33;a:4:{s:5:"title";s:8:"JPY- RUB";s:6:"course";s:8:"0.585839";s:4:"code";s:10:"cbr_jpyrub";s:4:"birg";s:3:"cbr";}i:34;a:4:{s:5:"title";s:15:"EUR - UAH (buy)";s:6:"course";s:8:"31.26079";s:4:"code";s:21:"privatnbu_eur_uah_buy";s:4:"birg";s:9:"privatnbu";}i:35;a:4:{s:5:"title";s:16:"EUR - UAH (sale)";s:6:"course";s:8:"31.11025";s:4:"code";s:22:"privatnbu_eur_uah_sale";s:4:"birg";s:9:"privatnbu";}i:36;a:4:{s:5:"title";s:15:"RUR - UAH (buy)";s:6:"course";s:7:"0.42617";s:4:"code";s:21:"privatnbu_rur_uah_buy";s:4:"birg";s:9:"privatnbu";}i:37;a:4:{s:5:"title";s:16:"RUR - UAH (sale)";s:6:"course";s:7:"0.42497";s:4:"code";s:22:"privatnbu_rur_uah_sale";s:4:"birg";s:9:"privatnbu";}i:38;a:4:{s:5:"title";s:15:"USD - UAH (buy)";s:6:"course";s:8:"26.75521";s:4:"code";s:21:"privatnbu_usd_uah_buy";s:4:"birg";s:9:"privatnbu";}i:39;a:4:{s:5:"title";s:16:"USD - UAH (sale)";s:6:"course";s:8:"26.76151";s:4:"code";s:22:"privatnbu_usd_uah_sale";s:4:"birg";s:9:"privatnbu";}i:40;a:4:{s:5:"title";s:15:"BTC - UAH (buy)";s:6:"course";s:9:"7687.6636";s:4:"code";s:21:"privatnbu_btc_uah_buy";s:4:"birg";s:9:"privatnbu";}i:41;a:4:{s:5:"title";s:16:"BTC - UAH (sale)";s:6:"course";s:9:"8496.8914";s:4:"code";s:22:"privatnbu_btc_uah_sale";s:4:"birg";s:9:"privatnbu";}i:42;a:4:{s:5:"title";s:15:"USD - UAH (buy)";s:6:"course";s:4:"28.1";s:4:"code";s:18:"privat_usd_uah_buy";s:4:"birg";s:6:"privat";}i:43;a:4:{s:5:"title";s:16:"USD - UAH (sale)";s:6:"course";s:4:"28.3";s:4:"code";s:19:"privat_usd_uah_sale";s:4:"birg";s:6:"privat";}i:44;a:4:{s:5:"title";s:15:"EUR - UAH (buy)";s:6:"course";s:4:"31.8";s:4:"code";s:18:"privat_eur_uah_buy";s:4:"birg";s:6:"privat";}i:45;a:4:{s:5:"title";s:16:"EUR - UAH (sale)";s:6:"course";s:5:"32.35";s:4:"code";s:19:"privat_eur_uah_sale";s:4:"birg";s:6:"privat";}i:46;a:4:{s:5:"title";s:15:"RUR - UAH (buy)";s:6:"course";s:5:"0.415";s:4:"code";s:18:"privat_rur_uah_buy";s:4:"birg";s:6:"privat";}i:47;a:4:{s:5:"title";s:16:"RUR - UAH (sale)";s:6:"course";s:5:"0.435";s:4:"code";s:19:"privat_rur_uah_sale";s:4:"birg";s:6:"privat";}i:48;a:4:{s:5:"title";s:15:"BTC - UAH (buy)";s:6:"course";s:9:"6098.7601";s:4:"code";s:18:"privat_btc_uah_buy";s:4:"birg";s:6:"privat";}i:49;a:4:{s:5:"title";s:16:"BTC - UAH (sale)";s:6:"course";s:9:"6740.7349";s:4:"code";s:19:"privat_btc_uah_sale";s:4:"birg";s:6:"privat";}i:50;a:4:{s:5:"title";s:8:"AUD- KZT";s:6:"course";s:6:"258.86";s:4:"code";s:17:"nationalkz_audkzt";s:4:"birg";s:10:"nationalkz";}i:51;a:4:{s:5:"title";s:8:"GBP- KZT";s:6:"course";s:6:"471.84";s:4:"code";s:17:"nationalkz_gbpkzt";s:4:"birg";s:10:"nationalkz";}i:52;a:4:{s:5:"title";s:8:"DKK- KZT";s:6:"course";s:4:"56.1";s:4:"code";s:17:"nationalkz_dkkkzt";s:4:"birg";s:10:"nationalkz";}i:53;a:4:{s:5:"title";s:8:"AED- KZT";s:6:"course";s:6:"100.34";s:4:"code";s:17:"nationalkz_aedkzt";s:4:"birg";s:10:"nationalkz";}i:54;a:4:{s:5:"title";s:8:"USD- KZT";s:6:"course";s:6:"368.54";s:4:"code";s:17:"nationalkz_usdkzt";s:4:"birg";s:10:"nationalkz";}i:55;a:4:{s:5:"title";s:8:"EUR- KZT";s:6:"course";s:6:"418.44";s:4:"code";s:17:"nationalkz_eurkzt";s:4:"birg";s:10:"nationalkz";}i:56;a:4:{s:5:"title";s:8:"CAD- KZT";s:6:"course";s:6:"280.32";s:4:"code";s:17:"nationalkz_cadkzt";s:4:"birg";s:10:"nationalkz";}i:57;a:4:{s:5:"title";s:8:"CNY- KZT";s:6:"course";s:5:"53.06";s:4:"code";s:17:"nationalkz_cnykzt";s:4:"birg";s:10:"nationalkz";}i:58;a:4:{s:5:"title";s:8:"KWD- KZT";s:6:"course";s:7:"1213.74";s:4:"code";s:17:"nationalkz_kwdkzt";s:4:"birg";s:10:"nationalkz";}i:59;a:4:{s:5:"title";s:8:"KGS- KZT";s:6:"course";s:4:"5.31";s:4:"code";s:17:"nationalkz_kgskzt";s:4:"birg";s:10:"nationalkz";}i:60;a:4:{s:5:"title";s:8:"LVL- KZT";s:6:"course";s:6:"300.96";s:4:"code";s:17:"nationalkz_lvlkzt";s:4:"birg";s:10:"nationalkz";}i:61;a:4:{s:5:"title";s:8:"MDL- KZT";s:6:"course";s:5:"21.58";s:4:"code";s:17:"nationalkz_mdlkzt";s:4:"birg";s:10:"nationalkz";}i:62;a:4:{s:5:"title";s:8:"NOK- KZT";s:6:"course";s:5:"43.96";s:4:"code";s:17:"nationalkz_nokkzt";s:4:"birg";s:10:"nationalkz";}i:63;a:4:{s:5:"title";s:8:"SAR- KZT";s:6:"course";s:5:"98.25";s:4:"code";s:17:"nationalkz_sarkzt";s:4:"birg";s:10:"nationalkz";}i:64;a:4:{s:5:"title";s:8:"RUB- KZT";s:6:"course";s:3:"5.6";s:4:"code";s:17:"nationalkz_rubkzt";s:4:"birg";s:10:"nationalkz";}i:65;a:4:{s:5:"title";s:8:"XDR- KZT";s:6:"course";s:6:"511.05";s:4:"code";s:17:"nationalkz_xdrkzt";s:4:"birg";s:10:"nationalkz";}i:66;a:4:{s:5:"title";s:8:"SGD- KZT";s:6:"course";s:6:"266.38";s:4:"code";s:17:"nationalkz_sgdkzt";s:4:"birg";s:10:"nationalkz";}i:67;a:4:{s:5:"title";s:8:"TRL- KZT";s:6:"course";s:6:"0.0001";s:4:"code";s:17:"nationalkz_trlkzt";s:4:"birg";s:10:"nationalkz";}i:68;a:4:{s:5:"title";s:8:"UZS- KZT";s:6:"course";s:6:"0.0448";s:4:"code";s:17:"nationalkz_uzskzt";s:4:"birg";s:10:"nationalkz";}i:69;a:4:{s:5:"title";s:8:"UAH- KZT";s:6:"course";s:5:"13.04";s:4:"code";s:17:"nationalkz_uahkzt";s:4:"birg";s:10:"nationalkz";}i:70;a:4:{s:5:"title";s:8:"SEK- KZT";s:6:"course";s:5:"40.27";s:4:"code";s:17:"nationalkz_sekkzt";s:4:"birg";s:10:"nationalkz";}i:71;a:4:{s:5:"title";s:8:"CHF- KZT";s:6:"course";s:6:"368.32";s:4:"code";s:17:"nationalkz_chfkzt";s:4:"birg";s:10:"nationalkz";}i:72;a:4:{s:5:"title";s:8:"EEK- KZT";s:6:"course";s:5:"12.48";s:4:"code";s:17:"nationalkz_eekkzt";s:4:"birg";s:10:"nationalkz";}i:73;a:4:{s:5:"title";s:8:"KRW- KZT";s:6:"course";s:6:"0.3227";s:4:"code";s:17:"nationalkz_krwkzt";s:4:"birg";s:10:"nationalkz";}i:74;a:4:{s:5:"title";s:8:"JPY- KZT";s:6:"course";s:4:"3.29";s:4:"code";s:17:"nationalkz_jpykzt";s:4:"birg";s:10:"nationalkz";}i:75;a:4:{s:5:"title";s:8:"BYN- KZT";s:6:"course";s:6:"174.37";s:4:"code";s:17:"nationalkz_bynkzt";s:4:"birg";s:10:"nationalkz";}i:76;a:4:{s:5:"title";s:8:"PLN- KZT";s:6:"course";s:5:"96.96";s:4:"code";s:17:"nationalkz_plnkzt";s:4:"birg";s:10:"nationalkz";}i:77;a:4:{s:5:"title";s:8:"ZAR- KZT";s:6:"course";s:5:"25.06";s:4:"code";s:17:"nationalkz_zarkzt";s:4:"birg";s:10:"nationalkz";}i:78;a:4:{s:5:"title";s:8:"TRY- KZT";s:6:"course";s:5:"65.46";s:4:"code";s:17:"nationalkz_trykzt";s:4:"birg";s:10:"nationalkz";}i:79;a:4:{s:5:"title";s:8:"HUF- KZT";s:6:"course";s:5:"1.291";s:4:"code";s:17:"nationalkz_hufkzt";s:4:"birg";s:10:"nationalkz";}i:80;a:4:{s:5:"title";s:8:"CZK- KZT";s:6:"course";s:5:"16.18";s:4:"code";s:17:"nationalkz_czkkzt";s:4:"birg";s:10:"nationalkz";}i:81;a:4:{s:5:"title";s:8:"TJS- KZT";s:6:"course";s:5:"39.12";s:4:"code";s:17:"nationalkz_tjskzt";s:4:"birg";s:10:"nationalkz";}i:82;a:4:{s:5:"title";s:8:"HKD- KZT";s:6:"course";s:2:"47";s:4:"code";s:17:"nationalkz_hkdkzt";s:4:"birg";s:10:"nationalkz";}i:83;a:4:{s:5:"title";s:8:"BRL- KZT";s:6:"course";s:5:"99.44";s:4:"code";s:17:"nationalkz_brlkzt";s:4:"birg";s:10:"nationalkz";}i:84;a:4:{s:5:"title";s:8:"MYR- KZT";s:6:"course";s:5:"88.32";s:4:"code";s:17:"nationalkz_myrkzt";s:4:"birg";s:10:"nationalkz";}i:85;a:4:{s:5:"title";s:8:"AZN- KZT";s:6:"course";s:6:"217.68";s:4:"code";s:17:"nationalkz_aznkzt";s:4:"birg";s:10:"nationalkz";}i:86;a:4:{s:5:"title";s:8:"INR- KZT";s:6:"course";s:4:"5.02";s:4:"code";s:17:"nationalkz_inrkzt";s:4:"birg";s:10:"nationalkz";}i:87;a:4:{s:5:"title";s:8:"THB- KZT";s:6:"course";s:5:"11.13";s:4:"code";s:17:"nationalkz_thbkzt";s:4:"birg";s:10:"nationalkz";}i:88;a:4:{s:5:"title";s:8:"AMD- KZT";s:6:"course";s:4:"0.76";s:4:"code";s:17:"nationalkz_amdkzt";s:4:"birg";s:10:"nationalkz";}i:89;a:4:{s:5:"title";s:8:"GEL- KZT";s:6:"course";s:6:"137.62";s:4:"code";s:17:"nationalkz_gelkzt";s:4:"birg";s:10:"nationalkz";}i:90;a:4:{s:5:"title";s:8:"IRR- KZT";s:6:"course";s:6:"0.0088";s:4:"code";s:17:"nationalkz_irrkzt";s:4:"birg";s:10:"nationalkz";}i:91;a:4:{s:5:"title";s:8:"MXN- KZT";s:6:"course";s:5:"18.84";s:4:"code";s:17:"nationalkz_mxnkzt";s:4:"birg";s:10:"nationalkz";}i:92;a:4:{s:5:"title";s:8:"AUD- BYN";s:6:"course";s:6:"1.4833";s:4:"code";s:11:"nbrb_audbyn";s:4:"birg";s:4:"nbrb";}i:93;a:4:{s:5:"title";s:8:"BGN- BYN";s:6:"course";s:6:"1.2259";s:4:"code";s:11:"nbrb_bgnbyn";s:4:"birg";s:4:"nbrb";}i:94;a:4:{s:5:"title";s:8:"UAH- BYN";s:6:"course";s:8:"0.074669";s:4:"code";s:11:"nbrb_uahbyn";s:4:"birg";s:4:"nbrb";}i:95;a:4:{s:5:"title";s:8:"DKK- BYN";s:6:"course";s:7:"0.32136";s:4:"code";s:11:"nbrb_dkkbyn";s:4:"birg";s:4:"nbrb";}i:96;a:4:{s:5:"title";s:8:"USD- BYN";s:6:"course";s:6:"2.1109";s:4:"code";s:11:"nbrb_usdbyn";s:4:"birg";s:4:"nbrb";}i:97;a:4:{s:5:"title";s:8:"EUR- BYN";s:6:"course";s:6:"2.3997";s:4:"code";s:11:"nbrb_eurbyn";s:4:"birg";s:4:"nbrb";}i:98;a:4:{s:5:"title";s:8:"PLN- BYN";s:6:"course";s:7:"0.55548";s:4:"code";s:11:"nbrb_plnbyn";s:4:"birg";s:4:"nbrb";}i:99;a:4:{s:5:"title";s:8:"IRR- BYN";s:6:"course";s:10:"0.00005026";s:4:"code";s:11:"nbrb_irrbyn";s:4:"birg";s:4:"nbrb";}i:100;a:4:{s:5:"title";s:8:"ISK- BYN";s:6:"course";s:8:"0.017515";s:4:"code";s:11:"nbrb_iskbyn";s:4:"birg";s:4:"nbrb";}i:101;a:4:{s:5:"title";s:8:"JPY- BYN";s:6:"course";s:8:"0.018863";s:4:"code";s:11:"nbrb_jpybyn";s:4:"birg";s:4:"nbrb";}i:102;a:4:{s:5:"title";s:8:"CAD- BYN";s:6:"course";s:6:"1.6052";s:4:"code";s:11:"nbrb_cadbyn";s:4:"birg";s:4:"nbrb";}i:103;a:4:{s:5:"title";s:8:"CNY- BYN";s:6:"course";s:7:"0.30394";s:4:"code";s:11:"nbrb_cnybyn";s:4:"birg";s:4:"nbrb";}i:104;a:4:{s:5:"title";s:8:"KWD- BYN";s:6:"course";s:6:"6.9498";s:4:"code";s:11:"nbrb_kwdbyn";s:4:"birg";s:4:"nbrb";}i:105;a:4:{s:5:"title";s:8:"MDL- BYN";s:6:"course";s:7:"0.12308";s:4:"code";s:11:"nbrb_mdlbyn";s:4:"birg";s:4:"nbrb";}i:106;a:4:{s:5:"title";s:8:"NZD- BYN";s:6:"course";s:6:"1.3662";s:4:"code";s:11:"nbrb_nzdbyn";s:4:"birg";s:4:"nbrb";}i:107;a:4:{s:5:"title";s:8:"NOK- BYN";s:6:"course";s:7:"0.25186";s:4:"code";s:11:"nbrb_nokbyn";s:4:"birg";s:4:"nbrb";}i:108;a:4:{s:5:"title";s:8:"RUB- BYN";s:6:"course";s:8:"0.032165";s:4:"code";s:11:"nbrb_rubbyn";s:4:"birg";s:4:"nbrb";}i:109;a:4:{s:5:"title";s:8:"XDR- BYN";s:6:"course";s:6:"2.9271";s:4:"code";s:11:"nbrb_xdrbyn";s:4:"birg";s:4:"nbrb";}i:110;a:4:{s:5:"title";s:8:"SGD- BYN";s:6:"course";s:5:"1.526";s:4:"code";s:11:"nbrb_sgdbyn";s:4:"birg";s:4:"nbrb";}i:111;a:4:{s:5:"title";s:8:"KGS- BYN";s:6:"course";s:8:"0.030351";s:4:"code";s:11:"nbrb_kgsbyn";s:4:"birg";s:4:"nbrb";}i:112;a:4:{s:5:"title";s:8:"KZT- BYN";s:6:"course";s:9:"0.0057333";s:4:"code";s:11:"nbrb_kztbyn";s:4:"birg";s:4:"nbrb";}i:113;a:4:{s:5:"title";s:8:"TRY- BYN";s:6:"course";s:7:"0.37509";s:4:"code";s:11:"nbrb_trybyn";s:4:"birg";s:4:"nbrb";}i:114;a:4:{s:5:"title";s:8:"GBP- BYN";s:6:"course";s:6:"2.7022";s:4:"code";s:11:"nbrb_gbpbyn";s:4:"birg";s:4:"nbrb";}i:115;a:4:{s:5:"title";s:8:"CZK- BYN";s:6:"course";s:8:"0.092685";s:4:"code";s:11:"nbrb_czkbyn";s:4:"birg";s:4:"nbrb";}i:116;a:4:{s:5:"title";s:8:"SEK- BYN";s:6:"course";s:7:"0.23056";s:4:"code";s:11:"nbrb_sekbyn";s:4:"birg";s:4:"nbrb";}i:117;a:4:{s:5:"title";s:8:"CHF- BYN";s:6:"course";s:6:"2.1095";s:4:"code";s:11:"nbrb_chfbyn";s:4:"birg";s:4:"nbrb";}i:118;a:4:{s:5:"title";s:14:"BTC-USD (high)";s:6:"course";s:7:"8694.99";s:4:"code";s:15:"wex_btcusd_high";s:4:"birg";s:3:"wex";}i:119;a:4:{s:5:"title";s:13:"BTC-USD (low)";s:6:"course";s:7:"8607.01";s:4:"code";s:14:"wex_btcusd_low";s:4:"birg";s:3:"wex";}i:120;a:4:{s:5:"title";s:13:"BTC-USD (avg)";s:6:"course";s:4:"8651";s:4:"code";s:14:"wex_btcusd_avg";s:4:"birg";s:3:"wex";}i:121;a:4:{s:5:"title";s:14:"BTC-USD (last)";s:6:"course";s:8:"8644.522";s:4:"code";s:15:"wex_btcusd_last";s:4:"birg";s:3:"wex";}i:122;a:4:{s:5:"title";s:13:"BTC-USD (buy)";s:6:"course";s:8:"8644.522";s:4:"code";s:14:"wex_btcusd_buy";s:4:"birg";s:3:"wex";}i:123;a:4:{s:5:"title";s:14:"BTC-USD (sell)";s:6:"course";s:6:"8607.1";s:4:"code";s:15:"wex_btcusd_sell";s:4:"birg";s:3:"wex";}i:124;a:4:{s:5:"title";s:14:"BTC-RUR (high)";s:6:"course";s:6:"540000";s:4:"code";s:15:"wex_btcrur_high";s:4:"birg";s:3:"wex";}i:125;a:4:{s:5:"title";s:13:"BTC-RUR (low)";s:6:"course";s:12:"529058.90924";s:4:"code";s:14:"wex_btcrur_low";s:4:"birg";s:3:"wex";}i:126;a:4:{s:5:"title";s:13:"BTC-RUR (avg)";s:6:"course";s:12:"534529.45462";s:4:"code";s:14:"wex_btcrur_avg";s:4:"birg";s:3:"wex";}i:127;a:4:{s:5:"title";s:14:"BTC-RUR (last)";s:6:"course";s:12:"531177.26112";s:4:"code";s:15:"wex_btcrur_last";s:4:"birg";s:3:"wex";}i:128;a:4:{s:5:"title";s:13:"BTC-RUR (buy)";s:6:"course";s:12:"533836.46727";s:4:"code";s:14:"wex_btcrur_buy";s:4:"birg";s:3:"wex";}i:129;a:4:{s:5:"title";s:14:"BTC-RUR (sell)";s:6:"course";s:12:"531177.26111";s:4:"code";s:15:"wex_btcrur_sell";s:4:"birg";s:3:"wex";}i:130;a:4:{s:5:"title";s:14:"BTC-EUR (high)";s:6:"course";s:10:"7680.99241";s:4:"code";s:15:"wex_btceur_high";s:4:"birg";s:3:"wex";}i:131;a:4:{s:5:"title";s:13:"BTC-EUR (low)";s:6:"course";s:10:"7584.18185";s:4:"code";s:14:"wex_btceur_low";s:4:"birg";s:3:"wex";}i:132;a:4:{s:5:"title";s:13:"BTC-EUR (avg)";s:6:"course";s:10:"7632.58713";s:4:"code";s:14:"wex_btceur_avg";s:4:"birg";s:3:"wex";}i:133;a:4:{s:5:"title";s:14:"BTC-EUR (last)";s:6:"course";s:10:"7622.15016";s:4:"code";s:15:"wex_btceur_last";s:4:"birg";s:3:"wex";}i:134;a:4:{s:5:"title";s:13:"BTC-EUR (buy)";s:6:"course";s:10:"7637.39446";s:4:"code";s:14:"wex_btceur_buy";s:4:"birg";s:3:"wex";}i:135;a:4:{s:5:"title";s:14:"BTC-EUR (sell)";s:6:"course";s:10:"7622.15016";s:4:"code";s:15:"wex_btceur_sell";s:4:"birg";s:3:"wex";}i:136;a:4:{s:5:"title";s:14:"LTC-USD (high)";s:6:"course";s:8:"83.97073";s:4:"code";s:15:"wex_ltcusd_high";s:4:"birg";s:3:"wex";}i:137;a:4:{s:5:"title";s:13:"LTC-USD (low)";s:6:"course";s:2:"83";s:4:"code";s:14:"wex_ltcusd_low";s:4:"birg";s:3:"wex";}i:138;a:4:{s:5:"title";s:13:"LTC-USD (avg)";s:6:"course";s:9:"83.485365";s:4:"code";s:14:"wex_ltcusd_avg";s:4:"birg";s:3:"wex";}i:139;a:4:{s:5:"title";s:14:"LTC-USD (last)";s:6:"course";s:8:"83.63585";s:4:"code";s:15:"wex_ltcusd_last";s:4:"birg";s:3:"wex";}i:140;a:4:{s:5:"title";s:13:"LTC-USD (buy)";s:6:"course";s:9:"83.635847";s:4:"code";s:14:"wex_ltcusd_buy";s:4:"birg";s:3:"wex";}i:141;a:4:{s:5:"title";s:14:"LTC-USD (sell)";s:6:"course";s:9:"83.635846";s:4:"code";s:15:"wex_ltcusd_sell";s:4:"birg";s:3:"wex";}i:142;a:4:{s:5:"title";s:14:"LTC-EUR (high)";s:6:"course";s:6:"74.001";s:4:"code";s:15:"wex_ltceur_high";s:4:"birg";s:3:"wex";}i:143;a:4:{s:5:"title";s:13:"LTC-EUR (low)";s:6:"course";s:5:"73.34";s:4:"code";s:14:"wex_ltceur_low";s:4:"birg";s:3:"wex";}i:144;a:4:{s:5:"title";s:13:"LTC-EUR (avg)";s:6:"course";s:7:"73.6705";s:4:"code";s:14:"wex_ltceur_avg";s:4:"birg";s:3:"wex";}i:145;a:4:{s:5:"title";s:14:"LTC-EUR (last)";s:6:"course";s:6:"73.854";s:4:"code";s:15:"wex_ltceur_last";s:4:"birg";s:3:"wex";}i:146;a:4:{s:5:"title";s:13:"LTC-EUR (buy)";s:6:"course";s:6:"73.854";s:4:"code";s:14:"wex_ltceur_buy";s:4:"birg";s:3:"wex";}i:147;a:4:{s:5:"title";s:14:"LTC-EUR (sell)";s:6:"course";s:6:"73.486";s:4:"code";s:15:"wex_ltceur_sell";s:4:"birg";s:3:"wex";}i:148;a:4:{s:5:"title";s:14:"LTC-RUR (high)";s:6:"course";s:10:"5189.99965";s:4:"code";s:15:"wex_ltcrur_high";s:4:"birg";s:3:"wex";}i:149;a:4:{s:5:"title";s:13:"LTC-RUR (low)";s:6:"course";s:6:"5126.5";s:4:"code";s:14:"wex_ltcrur_low";s:4:"birg";s:3:"wex";}i:150;a:4:{s:5:"title";s:13:"LTC-RUR (avg)";s:6:"course";s:11:"5158.249825";s:4:"code";s:14:"wex_ltcrur_avg";s:4:"birg";s:3:"wex";}i:151;a:4:{s:5:"title";s:14:"LTC-RUR (last)";s:6:"course";s:10:"5146.75709";s:4:"code";s:15:"wex_ltcrur_last";s:4:"birg";s:3:"wex";}i:152;a:4:{s:5:"title";s:13:"LTC-RUR (buy)";s:6:"course";s:9:"5166.4692";s:4:"code";s:14:"wex_ltcrur_buy";s:4:"birg";s:3:"wex";}i:153;a:4:{s:5:"title";s:14:"LTC-RUR (sell)";s:6:"course";s:10:"5146.75708";s:4:"code";s:15:"wex_ltcrur_sell";s:4:"birg";s:3:"wex";}i:154;a:4:{s:5:"title";s:14:"LTC-BTC (high)";s:6:"course";s:7:"0.00967";s:4:"code";s:15:"wex_ltcbtc_high";s:4:"birg";s:3:"wex";}i:155;a:4:{s:5:"title";s:13:"LTC-BTC (low)";s:6:"course";s:7:"0.00956";s:4:"code";s:14:"wex_ltcbtc_low";s:4:"birg";s:3:"wex";}i:156;a:4:{s:5:"title";s:13:"LTC-BTC (avg)";s:6:"course";s:8:"0.009615";s:4:"code";s:14:"wex_ltcbtc_avg";s:4:"birg";s:3:"wex";}i:157;a:4:{s:5:"title";s:14:"LTC-BTC (last)";s:6:"course";s:7:"0.00967";s:4:"code";s:15:"wex_ltcbtc_last";s:4:"birg";s:3:"wex";}i:158;a:4:{s:5:"title";s:13:"LTC-BTC (buy)";s:6:"course";s:7:"0.00966";s:4:"code";s:14:"wex_ltcbtc_buy";s:4:"birg";s:3:"wex";}i:159;a:4:{s:5:"title";s:14:"LTC-BTC (sell)";s:6:"course";s:7:"0.00963";s:4:"code";s:15:"wex_ltcbtc_sell";s:4:"birg";s:3:"wex";}i:160;a:4:{s:5:"title";s:14:"DSH-BTC (high)";s:6:"course";s:7:"0.02925";s:4:"code";s:15:"wex_dshbtc_high";s:4:"birg";s:3:"wex";}i:161;a:4:{s:5:"title";s:13:"DSH-BTC (low)";s:6:"course";s:7:"0.02898";s:4:"code";s:14:"wex_dshbtc_low";s:4:"birg";s:3:"wex";}i:162;a:4:{s:5:"title";s:13:"DSH-BTC (avg)";s:6:"course";s:8:"0.029115";s:4:"code";s:14:"wex_dshbtc_avg";s:4:"birg";s:3:"wex";}i:163;a:4:{s:5:"title";s:14:"DSH-BTC (last)";s:6:"course";s:7:"0.02919";s:4:"code";s:15:"wex_dshbtc_last";s:4:"birg";s:3:"wex";}i:164;a:4:{s:5:"title";s:13:"DSH-BTC (buy)";s:6:"course";s:7:"0.02925";s:4:"code";s:14:"wex_dshbtc_buy";s:4:"birg";s:3:"wex";}i:165;a:4:{s:5:"title";s:14:"DSH-BTC (sell)";s:6:"course";s:6:"0.0291";s:4:"code";s:15:"wex_dshbtc_sell";s:4:"birg";s:3:"wex";}i:166;a:4:{s:5:"title";s:14:"ETH-BTC (high)";s:6:"course";s:7:"0.03731";s:4:"code";s:15:"wex_ethbtc_high";s:4:"birg";s:3:"wex";}i:167;a:4:{s:5:"title";s:13:"ETH-BTC (low)";s:6:"course";s:7:"0.03683";s:4:"code";s:14:"wex_ethbtc_low";s:4:"birg";s:3:"wex";}i:168;a:4:{s:5:"title";s:13:"ETH-BTC (avg)";s:6:"course";s:7:"0.03707";s:4:"code";s:14:"wex_ethbtc_avg";s:4:"birg";s:3:"wex";}i:169;a:4:{s:5:"title";s:14:"ETH-BTC (last)";s:6:"course";s:7:"0.03731";s:4:"code";s:15:"wex_ethbtc_last";s:4:"birg";s:3:"wex";}i:170;a:4:{s:5:"title";s:13:"ETH-BTC (buy)";s:6:"course";s:7:"0.03731";s:4:"code";s:14:"wex_ethbtc_buy";s:4:"birg";s:3:"wex";}i:171;a:4:{s:5:"title";s:14:"ETH-BTC (sell)";s:6:"course";s:7:"0.03713";s:4:"code";s:15:"wex_ethbtc_sell";s:4:"birg";s:3:"wex";}i:172;a:4:{s:5:"title";s:14:"ETH-USD (high)";s:6:"course";s:9:"322.28754";s:4:"code";s:15:"wex_ethusd_high";s:4:"birg";s:3:"wex";}i:173;a:4:{s:5:"title";s:13:"ETH-USD (low)";s:6:"course";s:3:"321";s:4:"code";s:14:"wex_ethusd_low";s:4:"birg";s:3:"wex";}i:174;a:4:{s:5:"title";s:13:"ETH-USD (avg)";s:6:"course";s:9:"321.64377";s:4:"code";s:14:"wex_ethusd_avg";s:4:"birg";s:3:"wex";}i:175;a:4:{s:5:"title";s:14:"ETH-USD (last)";s:6:"course";s:3:"321";s:4:"code";s:15:"wex_ethusd_last";s:4:"birg";s:3:"wex";}i:176;a:4:{s:5:"title";s:13:"ETH-USD (buy)";s:6:"course";s:9:"321.56518";s:4:"code";s:14:"wex_ethusd_buy";s:4:"birg";s:3:"wex";}i:177;a:4:{s:5:"title";s:14:"ETH-USD (sell)";s:6:"course";s:3:"321";s:4:"code";s:15:"wex_ethusd_sell";s:4:"birg";s:3:"wex";}i:178;a:4:{s:5:"title";s:14:"ETH-LTC (high)";s:6:"course";s:6:"3.8582";s:4:"code";s:15:"wex_ethltc_high";s:4:"birg";s:3:"wex";}i:179;a:4:{s:5:"title";s:13:"ETH-LTC (low)";s:6:"course";s:7:"3.82715";s:4:"code";s:14:"wex_ethltc_low";s:4:"birg";s:3:"wex";}i:180;a:4:{s:5:"title";s:13:"ETH-LTC (avg)";s:6:"course";s:8:"3.842675";s:4:"code";s:14:"wex_ethltc_avg";s:4:"birg";s:3:"wex";}i:181;a:4:{s:5:"title";s:14:"ETH-LTC (last)";s:6:"course";s:7:"3.84247";s:4:"code";s:15:"wex_ethltc_last";s:4:"birg";s:3:"wex";}i:182;a:4:{s:5:"title";s:13:"ETH-LTC (buy)";s:6:"course";s:4:"3.86";s:4:"code";s:14:"wex_ethltc_buy";s:4:"birg";s:3:"wex";}i:183;a:4:{s:5:"title";s:14:"ETH-LTC (sell)";s:6:"course";s:7:"3.84247";s:4:"code";s:15:"wex_ethltc_sell";s:4:"birg";s:3:"wex";}i:184;a:4:{s:5:"title";s:14:"ETH-RUR (high)";s:6:"course";s:11:"19875.21122";s:4:"code";s:15:"wex_ethrur_high";s:4:"birg";s:3:"wex";}i:185;a:4:{s:5:"title";s:13:"ETH-RUR (low)";s:6:"course";s:11:"19714.36527";s:4:"code";s:14:"wex_ethrur_low";s:4:"birg";s:3:"wex";}i:186;a:4:{s:5:"title";s:13:"ETH-RUR (avg)";s:6:"course";s:12:"19794.788245";s:4:"code";s:14:"wex_ethrur_avg";s:4:"birg";s:3:"wex";}i:187;a:4:{s:5:"title";s:14:"ETH-RUR (last)";s:6:"course";s:11:"19832.54665";s:4:"code";s:15:"wex_ethrur_last";s:4:"birg";s:3:"wex";}i:188;a:4:{s:5:"title";s:13:"ETH-RUR (buy)";s:6:"course";s:11:"19860.52146";s:4:"code";s:14:"wex_ethrur_buy";s:4:"birg";s:3:"wex";}i:189;a:4:{s:5:"title";s:14:"ETH-RUR (sell)";s:6:"course";s:11:"19773.22205";s:4:"code";s:15:"wex_ethrur_sell";s:4:"birg";s:3:"wex";}i:190;a:4:{s:5:"title";s:14:"USD-RUR (high)";s:6:"course";s:8:"61.98999";s:4:"code";s:15:"wex_usdrur_high";s:4:"birg";s:3:"wex";}i:191;a:4:{s:5:"title";s:13:"USD-RUR (low)";s:6:"course";s:8:"61.55121";s:4:"code";s:14:"wex_usdrur_low";s:4:"birg";s:3:"wex";}i:192;a:4:{s:5:"title";s:13:"USD-RUR (avg)";s:6:"course";s:7:"61.7706";s:4:"code";s:14:"wex_usdrur_avg";s:4:"birg";s:3:"wex";}i:193;a:4:{s:5:"title";s:14:"USD-RUR (last)";s:6:"course";s:8:"61.98125";s:4:"code";s:15:"wex_usdrur_last";s:4:"birg";s:3:"wex";}i:194;a:4:{s:5:"title";s:13:"USD-RUR (buy)";s:6:"course";s:8:"61.98125";s:4:"code";s:14:"wex_usdrur_buy";s:4:"birg";s:3:"wex";}i:195;a:4:{s:5:"title";s:14:"USD-RUR (sell)";s:6:"course";s:8:"61.70001";s:4:"code";s:15:"wex_usdrur_sell";s:4:"birg";s:3:"wex";}i:196;a:4:{s:5:"title";s:14:"EUR-RUR (high)";s:6:"course";s:8:"70.21001";s:4:"code";s:15:"wex_eurrur_high";s:4:"birg";s:3:"wex";}i:197;a:4:{s:5:"title";s:13:"EUR-RUR (low)";s:6:"course";s:8:"69.66877";s:4:"code";s:14:"wex_eurrur_low";s:4:"birg";s:3:"wex";}i:198;a:4:{s:5:"title";s:13:"EUR-RUR (avg)";s:6:"course";s:8:"69.93939";s:4:"code";s:14:"wex_eurrur_avg";s:4:"birg";s:3:"wex";}i:199;a:4:{s:5:"title";s:14:"EUR-RUR (last)";s:6:"course";s:2:"70";s:4:"code";s:15:"wex_eurrur_last";s:4:"birg";s:3:"wex";}i:200;a:4:{s:5:"title";s:13:"EUR-RUR (buy)";s:6:"course";s:8:"70.21001";s:4:"code";s:14:"wex_eurrur_buy";s:4:"birg";s:3:"wex";}i:201;a:4:{s:5:"title";s:14:"EUR-RUR (sell)";s:6:"course";s:8:"69.86028";s:4:"code";s:15:"wex_eurrur_sell";s:4:"birg";s:3:"wex";}i:202;a:4:{s:5:"title";s:14:"EUR-USD (high)";s:6:"course";s:7:"1.13424";s:4:"code";s:15:"wex_eurusd_high";s:4:"birg";s:3:"wex";}i:203;a:4:{s:5:"title";s:13:"EUR-USD (low)";s:6:"course";s:7:"1.12862";s:4:"code";s:14:"wex_eurusd_low";s:4:"birg";s:3:"wex";}i:204;a:4:{s:5:"title";s:13:"EUR-USD (avg)";s:6:"course";s:7:"1.13143";s:4:"code";s:14:"wex_eurusd_avg";s:4:"birg";s:3:"wex";}i:205;a:4:{s:5:"title";s:14:"EUR-USD (last)";s:6:"course";s:6:"1.1342";s:4:"code";s:15:"wex_eurusd_last";s:4:"birg";s:3:"wex";}i:206;a:4:{s:5:"title";s:13:"EUR-USD (buy)";s:6:"course";s:6:"1.1342";s:4:"code";s:14:"wex_eurusd_buy";s:4:"birg";s:3:"wex";}i:207;a:4:{s:5:"title";s:14:"EUR-USD (sell)";s:6:"course";s:7:"1.13062";s:4:"code";s:15:"wex_eurusd_sell";s:4:"birg";s:3:"wex";}i:208;a:4:{s:5:"title";s:14:"NVC-BTC (high)";s:6:"course";s:6:"0.0007";s:4:"code";s:15:"wex_nvcbtc_high";s:4:"birg";s:3:"wex";}i:209;a:4:{s:5:"title";s:13:"NVC-BTC (low)";s:6:"course";s:7:"0.00065";s:4:"code";s:14:"wex_nvcbtc_low";s:4:"birg";s:3:"wex";}i:210;a:4:{s:5:"title";s:13:"NVC-BTC (avg)";s:6:"course";s:8:"0.000675";s:4:"code";s:14:"wex_nvcbtc_avg";s:4:"birg";s:3:"wex";}i:211;a:4:{s:5:"title";s:14:"NVC-BTC (last)";s:6:"course";s:7:"0.00069";s:4:"code";s:15:"wex_nvcbtc_last";s:4:"birg";s:3:"wex";}i:212;a:4:{s:5:"title";s:13:"NVC-BTC (buy)";s:6:"course";s:7:"0.00069";s:4:"code";s:14:"wex_nvcbtc_buy";s:4:"birg";s:3:"wex";}i:213;a:4:{s:5:"title";s:14:"NVC-BTC (sell)";s:6:"course";s:7:"0.00068";s:4:"code";s:15:"wex_nvcbtc_sell";s:4:"birg";s:3:"wex";}i:214;a:4:{s:5:"title";s:14:"NMC-BTC (high)";s:6:"course";s:7:"0.00053";s:4:"code";s:15:"wex_nmcbtc_high";s:4:"birg";s:3:"wex";}i:215;a:4:{s:5:"title";s:13:"NMC-BTC (low)";s:6:"course";s:7:"0.00052";s:4:"code";s:14:"wex_nmcbtc_low";s:4:"birg";s:3:"wex";}i:216;a:4:{s:5:"title";s:13:"NMC-BTC (avg)";s:6:"course";s:8:"0.000525";s:4:"code";s:14:"wex_nmcbtc_avg";s:4:"birg";s:3:"wex";}i:217;a:4:{s:5:"title";s:14:"NMC-BTC (last)";s:6:"course";s:7:"0.00053";s:4:"code";s:15:"wex_nmcbtc_last";s:4:"birg";s:3:"wex";}i:218;a:4:{s:5:"title";s:13:"NMC-BTC (buy)";s:6:"course";s:7:"0.00053";s:4:"code";s:14:"wex_nmcbtc_buy";s:4:"birg";s:3:"wex";}i:219;a:4:{s:5:"title";s:14:"NMC-BTC (sell)";s:6:"course";s:7:"0.00052";s:4:"code";s:15:"wex_nmcbtc_sell";s:4:"birg";s:3:"wex";}i:220;a:4:{s:5:"title";s:14:"NVC-USD (high)";s:6:"course";s:5:"6.196";s:4:"code";s:15:"wex_nvcusd_high";s:4:"birg";s:3:"wex";}i:221;a:4:{s:5:"title";s:13:"NVC-USD (low)";s:6:"course";s:3:"5.9";s:4:"code";s:14:"wex_nvcusd_low";s:4:"birg";s:3:"wex";}i:222;a:4:{s:5:"title";s:13:"NVC-USD (avg)";s:6:"course";s:5:"6.048";s:4:"code";s:14:"wex_nvcusd_avg";s:4:"birg";s:3:"wex";}i:223;a:4:{s:5:"title";s:14:"NVC-USD (last)";s:6:"course";s:5:"5.955";s:4:"code";s:15:"wex_nvcusd_last";s:4:"birg";s:3:"wex";}i:224;a:4:{s:5:"title";s:13:"NVC-USD (buy)";s:6:"course";s:5:"5.955";s:4:"code";s:14:"wex_nvcusd_buy";s:4:"birg";s:3:"wex";}i:225;a:4:{s:5:"title";s:14:"NVC-USD (sell)";s:6:"course";s:4:"5.95";s:4:"code";s:15:"wex_nvcusd_sell";s:4:"birg";s:3:"wex";}i:226;a:4:{s:5:"title";s:14:"NMC-USD (high)";s:6:"course";s:4:"4.59";s:4:"code";s:15:"wex_nmcusd_high";s:4:"birg";s:3:"wex";}i:227;a:4:{s:5:"title";s:13:"NMC-USD (low)";s:6:"course";s:5:"4.511";s:4:"code";s:14:"wex_nmcusd_low";s:4:"birg";s:3:"wex";}i:228;a:4:{s:5:"title";s:13:"NMC-USD (avg)";s:6:"course";s:6:"4.5505";s:4:"code";s:14:"wex_nmcusd_avg";s:4:"birg";s:3:"wex";}i:229;a:4:{s:5:"title";s:14:"NMC-USD (last)";s:6:"course";s:5:"4.585";s:4:"code";s:15:"wex_nmcusd_last";s:4:"birg";s:3:"wex";}i:230;a:4:{s:5:"title";s:13:"NMC-USD (buy)";s:6:"course";s:5:"4.585";s:4:"code";s:14:"wex_nmcusd_buy";s:4:"birg";s:3:"wex";}i:231;a:4:{s:5:"title";s:14:"NMC-USD (sell)";s:6:"course";s:5:"4.544";s:4:"code";s:15:"wex_nmcusd_sell";s:4:"birg";s:3:"wex";}i:232;a:4:{s:5:"title";s:14:"DSH-USD (high)";s:6:"course";s:3:"254";s:4:"code";s:15:"wex_dshusd_high";s:4:"birg";s:3:"wex";}i:233;a:4:{s:5:"title";s:13:"DSH-USD (low)";s:6:"course";s:3:"251";s:4:"code";s:14:"wex_dshusd_low";s:4:"birg";s:3:"wex";}i:234;a:4:{s:5:"title";s:13:"DSH-USD (avg)";s:6:"course";s:5:"252.5";s:4:"code";s:14:"wex_dshusd_avg";s:4:"birg";s:3:"wex";}i:235;a:4:{s:5:"title";s:14:"DSH-USD (last)";s:6:"course";s:8:"251.2971";s:4:"code";s:15:"wex_dshusd_last";s:4:"birg";s:3:"wex";}i:236;a:4:{s:5:"title";s:13:"DSH-USD (buy)";s:6:"course";s:9:"252.55515";s:4:"code";s:14:"wex_dshusd_buy";s:4:"birg";s:3:"wex";}i:237;a:4:{s:5:"title";s:14:"DSH-USD (sell)";s:6:"course";s:8:"251.2971";s:4:"code";s:15:"wex_dshusd_sell";s:4:"birg";s:3:"wex";}i:238;a:4:{s:5:"title";s:14:"DSH-RUR (high)";s:6:"course";s:9:"15620.465";s:4:"code";s:15:"wex_dshrur_high";s:4:"birg";s:3:"wex";}i:239;a:4:{s:5:"title";s:13:"DSH-RUR (low)";s:6:"course";s:9:"15465.193";s:4:"code";s:14:"wex_dshrur_low";s:4:"birg";s:3:"wex";}i:240;a:4:{s:5:"title";s:13:"DSH-RUR (avg)";s:6:"course";s:9:"15542.829";s:4:"code";s:14:"wex_dshrur_avg";s:4:"birg";s:3:"wex";}i:241;a:4:{s:5:"title";s:14:"DSH-RUR (last)";s:6:"course";s:9:"15569.554";s:4:"code";s:15:"wex_dshrur_last";s:4:"birg";s:3:"wex";}i:242;a:4:{s:5:"title";s:13:"DSH-RUR (buy)";s:6:"course";s:9:"15569.554";s:4:"code";s:14:"wex_dshrur_buy";s:4:"birg";s:3:"wex";}i:243;a:4:{s:5:"title";s:14:"DSH-RUR (sell)";s:6:"course";s:9:"15496.123";s:4:"code";s:15:"wex_dshrur_sell";s:4:"birg";s:3:"wex";}i:244;a:4:{s:5:"title";s:14:"DSH-EUR (high)";s:6:"course";s:7:"223.476";s:4:"code";s:15:"wex_dsheur_high";s:4:"birg";s:3:"wex";}i:245;a:4:{s:5:"title";s:13:"DSH-EUR (low)";s:6:"course";s:7:"221.255";s:4:"code";s:14:"wex_dsheur_low";s:4:"birg";s:3:"wex";}i:246;a:4:{s:5:"title";s:13:"DSH-EUR (avg)";s:6:"course";s:8:"222.3655";s:4:"code";s:14:"wex_dsheur_avg";s:4:"birg";s:3:"wex";}i:247;a:4:{s:5:"title";s:14:"DSH-EUR (last)";s:6:"course";s:7:"222.141";s:4:"code";s:15:"wex_dsheur_last";s:4:"birg";s:3:"wex";}i:248;a:4:{s:5:"title";s:13:"DSH-EUR (buy)";s:6:"course";s:7:"223.252";s:4:"code";s:14:"wex_dsheur_buy";s:4:"birg";s:3:"wex";}i:249;a:4:{s:5:"title";s:14:"DSH-EUR (sell)";s:6:"course";s:7:"222.141";s:4:"code";s:15:"wex_dsheur_sell";s:4:"birg";s:3:"wex";}i:250;a:4:{s:5:"title";s:14:"BCH-USD (high)";s:6:"course";s:7:"717.047";s:4:"code";s:15:"wex_bchusd_high";s:4:"birg";s:3:"wex";}i:251;a:4:{s:5:"title";s:13:"BCH-USD (low)";s:6:"course";s:7:"705.001";s:4:"code";s:14:"wex_bchusd_low";s:4:"birg";s:3:"wex";}i:252;a:4:{s:5:"title";s:13:"BCH-USD (avg)";s:6:"course";s:7:"711.024";s:4:"code";s:14:"wex_bchusd_avg";s:4:"birg";s:3:"wex";}i:253;a:4:{s:5:"title";s:14:"BCH-USD (last)";s:6:"course";s:7:"715.052";s:4:"code";s:15:"wex_bchusd_last";s:4:"birg";s:3:"wex";}i:254;a:4:{s:5:"title";s:13:"BCH-USD (buy)";s:6:"course";s:7:"715.052";s:4:"code";s:14:"wex_bchusd_buy";s:4:"birg";s:3:"wex";}i:255;a:4:{s:5:"title";s:14:"BCH-USD (sell)";s:6:"course";s:7:"712.051";s:4:"code";s:15:"wex_bchusd_sell";s:4:"birg";s:3:"wex";}i:256;a:4:{s:5:"title";s:14:"BCH-RUR (high)";s:6:"course";s:9:"44271.448";s:4:"code";s:15:"wex_bchrur_high";s:4:"birg";s:3:"wex";}i:257;a:4:{s:5:"title";s:13:"BCH-RUR (low)";s:6:"course";s:9:"43909.171";s:4:"code";s:14:"wex_bchrur_low";s:4:"birg";s:3:"wex";}i:258;a:4:{s:5:"title";s:13:"BCH-RUR (avg)";s:6:"course";s:10:"44090.3095";s:4:"code";s:14:"wex_bchrur_avg";s:4:"birg";s:3:"wex";}i:259;a:4:{s:5:"title";s:14:"BCH-RUR (last)";s:6:"course";s:8:"44139.02";s:4:"code";s:15:"wex_bchrur_last";s:4:"birg";s:3:"wex";}i:260;a:4:{s:5:"title";s:13:"BCH-RUR (buy)";s:6:"course";s:9:"44271.448";s:4:"code";s:14:"wex_bchrur_buy";s:4:"birg";s:3:"wex";}i:261;a:4:{s:5:"title";s:14:"BCH-RUR (sell)";s:6:"course";s:9:"44050.918";s:4:"code";s:15:"wex_bchrur_sell";s:4:"birg";s:3:"wex";}i:262;a:4:{s:5:"title";s:14:"BCH-EUR (high)";s:6:"course";s:7:"633.657";s:4:"code";s:15:"wex_bcheur_high";s:4:"birg";s:3:"wex";}i:263;a:4:{s:5:"title";s:13:"BCH-EUR (low)";s:6:"course";s:7:"628.962";s:4:"code";s:14:"wex_bcheur_low";s:4:"birg";s:3:"wex";}i:264;a:4:{s:5:"title";s:13:"BCH-EUR (avg)";s:6:"course";s:8:"631.3095";s:4:"code";s:14:"wex_bcheur_avg";s:4:"birg";s:3:"wex";}i:265;a:4:{s:5:"title";s:14:"BCH-EUR (last)";s:6:"course";s:7:"628.962";s:4:"code";s:15:"wex_bcheur_last";s:4:"birg";s:3:"wex";}i:266;a:4:{s:5:"title";s:13:"BCH-EUR (buy)";s:6:"course";s:7:"630.849";s:4:"code";s:14:"wex_bcheur_buy";s:4:"birg";s:3:"wex";}i:267;a:4:{s:5:"title";s:14:"BCH-EUR (sell)";s:6:"course";s:7:"628.805";s:4:"code";s:15:"wex_bcheur_sell";s:4:"birg";s:3:"wex";}i:268;a:4:{s:5:"title";s:14:"BCH-BTC (high)";s:6:"course";s:6:"0.0829";s:4:"code";s:15:"wex_bchbtc_high";s:4:"birg";s:3:"wex";}i:269;a:4:{s:5:"title";s:13:"BCH-BTC (low)";s:6:"course";s:6:"0.0821";s:4:"code";s:14:"wex_bchbtc_low";s:4:"birg";s:3:"wex";}i:270;a:4:{s:5:"title";s:13:"BCH-BTC (avg)";s:6:"course";s:6:"0.0825";s:4:"code";s:14:"wex_bchbtc_avg";s:4:"birg";s:3:"wex";}i:271;a:4:{s:5:"title";s:14:"BCH-BTC (last)";s:6:"course";s:6:"0.0825";s:4:"code";s:15:"wex_bchbtc_last";s:4:"birg";s:3:"wex";}i:272;a:4:{s:5:"title";s:13:"BCH-BTC (buy)";s:6:"course";s:6:"0.0826";s:4:"code";s:14:"wex_bchbtc_buy";s:4:"birg";s:3:"wex";}i:273;a:4:{s:5:"title";s:14:"BCH-BTC (sell)";s:6:"course";s:6:"0.0822";s:4:"code";s:15:"wex_bchbtc_sell";s:4:"birg";s:3:"wex";}i:274;a:4:{s:5:"title";s:14:"BCH-LTC (high)";s:6:"course";s:5:"8.595";s:4:"code";s:15:"wex_bchltc_high";s:4:"birg";s:3:"wex";}i:275;a:4:{s:5:"title";s:13:"BCH-LTC (low)";s:6:"course";s:5:"8.501";s:4:"code";s:14:"wex_bchltc_low";s:4:"birg";s:3:"wex";}i:276;a:4:{s:5:"title";s:13:"BCH-LTC (avg)";s:6:"course";s:5:"8.548";s:4:"code";s:14:"wex_bchltc_avg";s:4:"birg";s:3:"wex";}i:277;a:4:{s:5:"title";s:14:"BCH-LTC (last)";s:6:"course";s:4:"8.56";s:4:"code";s:15:"wex_bchltc_last";s:4:"birg";s:3:"wex";}i:278;a:4:{s:5:"title";s:13:"BCH-LTC (buy)";s:6:"course";s:4:"8.56";s:4:"code";s:14:"wex_bchltc_buy";s:4:"birg";s:3:"wex";}i:279;a:4:{s:5:"title";s:14:"BCH-LTC (sell)";s:6:"course";s:5:"8.531";s:4:"code";s:15:"wex_bchltc_sell";s:4:"birg";s:3:"wex";}i:280;a:4:{s:5:"title";s:14:"BCH-ETH (high)";s:6:"course";s:5:"2.231";s:4:"code";s:15:"wex_bcheth_high";s:4:"birg";s:3:"wex";}i:281;a:4:{s:5:"title";s:13:"BCH-ETH (low)";s:6:"course";s:5:"2.218";s:4:"code";s:14:"wex_bcheth_low";s:4:"birg";s:3:"wex";}i:282;a:4:{s:5:"title";s:13:"BCH-ETH (avg)";s:6:"course";s:6:"2.2245";s:4:"code";s:14:"wex_bcheth_avg";s:4:"birg";s:3:"wex";}i:283;a:4:{s:5:"title";s:14:"BCH-ETH (last)";s:6:"course";s:5:"2.218";s:4:"code";s:15:"wex_bcheth_last";s:4:"birg";s:3:"wex";}i:284;a:4:{s:5:"title";s:13:"BCH-ETH (buy)";s:6:"course";s:5:"2.227";s:4:"code";s:14:"wex_bcheth_buy";s:4:"birg";s:3:"wex";}i:285;a:4:{s:5:"title";s:14:"BCH-ETH (sell)";s:6:"course";s:5:"2.218";s:4:"code";s:15:"wex_bcheth_sell";s:4:"birg";s:3:"wex";}i:286;a:4:{s:5:"title";s:14:"BCH-DSH (high)";s:6:"course";s:5:"2.846";s:4:"code";s:15:"wex_bchdsh_high";s:4:"birg";s:3:"wex";}i:287;a:4:{s:5:"title";s:13:"BCH-DSH (low)";s:6:"course";s:4:"2.81";s:4:"code";s:14:"wex_bchdsh_low";s:4:"birg";s:3:"wex";}i:288;a:4:{s:5:"title";s:13:"BCH-DSH (avg)";s:6:"course";s:5:"2.828";s:4:"code";s:14:"wex_bchdsh_avg";s:4:"birg";s:3:"wex";}i:289;a:4:{s:5:"title";s:14:"BCH-DSH (last)";s:6:"course";s:5:"2.838";s:4:"code";s:15:"wex_bchdsh_last";s:4:"birg";s:3:"wex";}i:290;a:4:{s:5:"title";s:13:"BCH-DSH (buy)";s:6:"course";s:5:"2.846";s:4:"code";s:14:"wex_bchdsh_buy";s:4:"birg";s:3:"wex";}i:291;a:4:{s:5:"title";s:14:"BCH-DSH (sell)";s:6:"course";s:5:"2.832";s:4:"code";s:15:"wex_bchdsh_sell";s:4:"birg";s:3:"wex";}i:292;a:4:{s:5:"title";s:14:"ZEC-BTC (high)";s:6:"course";s:6:"0.1077";s:4:"code";s:15:"wex_zecbtc_high";s:4:"birg";s:3:"wex";}i:293;a:4:{s:5:"title";s:13:"ZEC-BTC (low)";s:6:"course";s:6:"0.1047";s:4:"code";s:14:"wex_zecbtc_low";s:4:"birg";s:3:"wex";}i:294;a:4:{s:5:"title";s:13:"ZEC-BTC (avg)";s:6:"course";s:6:"0.1062";s:4:"code";s:14:"wex_zecbtc_avg";s:4:"birg";s:3:"wex";}i:295;a:4:{s:5:"title";s:14:"ZEC-BTC (last)";s:6:"course";s:6:"0.1053";s:4:"code";s:15:"wex_zecbtc_last";s:4:"birg";s:3:"wex";}i:296;a:4:{s:5:"title";s:13:"ZEC-BTC (buy)";s:6:"course";s:6:"0.1062";s:4:"code";s:14:"wex_zecbtc_buy";s:4:"birg";s:3:"wex";}i:297;a:4:{s:5:"title";s:14:"ZEC-BTC (sell)";s:6:"course";s:6:"0.1054";s:4:"code";s:15:"wex_zecbtc_sell";s:4:"birg";s:3:"wex";}i:298;a:4:{s:5:"title";s:14:"ZEC-USD (high)";s:6:"course";s:7:"921.273";s:4:"code";s:15:"wex_zecusd_high";s:4:"birg";s:3:"wex";}i:299;a:4:{s:5:"title";s:13:"ZEC-USD (low)";s:6:"course";s:7:"901.835";s:4:"code";s:14:"wex_zecusd_low";s:4:"birg";s:3:"wex";}i:300;a:4:{s:5:"title";s:13:"ZEC-USD (avg)";s:6:"course";s:7:"911.554";s:4:"code";s:14:"wex_zecusd_avg";s:4:"birg";s:3:"wex";}i:301;a:4:{s:5:"title";s:14:"ZEC-USD (last)";s:6:"course";s:6:"915.21";s:4:"code";s:15:"wex_zecusd_last";s:4:"birg";s:3:"wex";}i:302;a:4:{s:5:"title";s:13:"ZEC-USD (buy)";s:6:"course";s:7:"915.313";s:4:"code";s:14:"wex_zecusd_buy";s:4:"birg";s:3:"wex";}i:303;a:4:{s:5:"title";s:14:"ZEC-USD (sell)";s:6:"course";s:6:"915.21";s:4:"code";s:15:"wex_zecusd_sell";s:4:"birg";s:3:"wex";}i:304;a:4:{s:5:"title";s:19:"BTC-USD (buy_price)";s:6:"course";s:6:"6580.1";s:4:"code";s:21:"exmo_btcusd_buy_price";s:4:"birg";s:4:"exmo";}i:305;a:4:{s:5:"title";s:20:"BTC-USD (sell_price)";s:6:"course";s:13:"6592.33999999";s:4:"code";s:22:"exmo_btcusd_sell_price";s:4:"birg";s:4:"exmo";}i:306;a:4:{s:5:"title";s:20:"BTC-USD (last_trade)";s:6:"course";s:13:"6592.33999999";s:4:"code";s:22:"exmo_btcusd_last_trade";s:4:"birg";s:4:"exmo";}i:307;a:4:{s:5:"title";s:14:"BTC-USD (high)";s:6:"course";s:4:"6643";s:4:"code";s:16:"exmo_btcusd_high";s:4:"birg";s:4:"exmo";}i:308;a:4:{s:5:"title";s:13:"BTC-USD (low)";s:6:"course";s:4:"6580";s:4:"code";s:15:"exmo_btcusd_low";s:4:"birg";s:4:"exmo";}i:309;a:4:{s:5:"title";s:13:"BTC-USD (avg)";s:6:"course";s:13:"6605.80503826";s:4:"code";s:15:"exmo_btcusd_avg";s:4:"birg";s:4:"exmo";}i:310;a:4:{s:5:"title";s:19:"BTC-EUR (buy_price)";s:6:"course";s:13:"5765.20201755";s:4:"code";s:21:"exmo_btceur_buy_price";s:4:"birg";s:4:"exmo";}i:311;a:4:{s:5:"title";s:20:"BTC-EUR (sell_price)";s:6:"course";s:13:"5789.39469896";s:4:"code";s:22:"exmo_btceur_sell_price";s:4:"birg";s:4:"exmo";}i:312;a:4:{s:5:"title";s:20:"BTC-EUR (last_trade)";s:6:"course";s:13:"5789.39469787";s:4:"code";s:22:"exmo_btceur_last_trade";s:4:"birg";s:4:"exmo";}i:313;a:4:{s:5:"title";s:14:"BTC-EUR (high)";s:6:"course";s:4:"5823";s:4:"code";s:16:"exmo_btceur_high";s:4:"birg";s:4:"exmo";}i:314;a:4:{s:5:"title";s:13:"BTC-EUR (low)";s:6:"course";s:13:"5755.80653011";s:4:"code";s:15:"exmo_btceur_low";s:4:"birg";s:4:"exmo";}i:315;a:4:{s:5:"title";s:13:"BTC-EUR (avg)";s:6:"course";s:13:"5789.04158579";s:4:"code";s:15:"exmo_btceur_avg";s:4:"birg";s:4:"exmo";}i:316;a:4:{s:5:"title";s:19:"BTC-RUB (buy_price)";s:6:"course";s:13:"431754.727951";s:4:"code";s:21:"exmo_btcrub_buy_price";s:4:"birg";s:4:"exmo";}i:317;a:4:{s:5:"title";s:20:"BTC-RUB (sell_price)";s:6:"course";s:15:"433479.97165896";s:4:"code";s:22:"exmo_btcrub_sell_price";s:4:"birg";s:4:"exmo";}i:318;a:4:{s:5:"title";s:20:"BTC-RUB (last_trade)";s:6:"course";s:13:"431759.227978";s:4:"code";s:22:"exmo_btcrub_last_trade";s:4:"birg";s:4:"exmo";}i:319;a:4:{s:5:"title";s:14:"BTC-RUB (high)";s:6:"course";s:6:"446000";s:4:"code";s:16:"exmo_btcrub_high";s:4:"birg";s:4:"exmo";}i:320;a:4:{s:5:"title";s:13:"BTC-RUB (low)";s:6:"course";s:15:"431000.00000001";s:4:"code";s:15:"exmo_btcrub_low";s:4:"birg";s:4:"exmo";}i:321;a:4:{s:5:"title";s:13:"BTC-RUB (avg)";s:6:"course";s:15:"434458.52198418";s:4:"code";s:15:"exmo_btcrub_avg";s:4:"birg";s:4:"exmo";}i:322;a:4:{s:5:"title";s:19:"BTC-UAH (buy_price)";s:6:"course";s:13:"183317.198879";s:4:"code";s:21:"exmo_btcuah_buy_price";s:4:"birg";s:4:"exmo";}i:323;a:4:{s:5:"title";s:20:"BTC-UAH (sell_price)";s:6:"course";s:11:"184129.3169";s:4:"code";s:22:"exmo_btcuah_sell_price";s:4:"birg";s:4:"exmo";}i:324;a:4:{s:5:"title";s:20:"BTC-UAH (last_trade)";s:6:"course";s:6:"183666";s:4:"code";s:22:"exmo_btcuah_last_trade";s:4:"birg";s:4:"exmo";}i:325;a:4:{s:5:"title";s:14:"BTC-UAH (high)";s:6:"course";s:15:"184999.99999999";s:4:"code";s:16:"exmo_btcuah_high";s:4:"birg";s:4:"exmo";}i:326;a:4:{s:5:"title";s:13:"BTC-UAH (low)";s:6:"course";s:6:"182800";s:4:"code";s:15:"exmo_btcuah_low";s:4:"birg";s:4:"exmo";}i:327;a:4:{s:5:"title";s:13:"BTC-UAH (avg)";s:6:"course";s:15:"183854.48788433";s:4:"code";s:15:"exmo_btcuah_avg";s:4:"birg";s:4:"exmo";}i:328;a:4:{s:5:"title";s:19:"BTC-PLN (buy_price)";s:6:"course";s:5:"23755";s:4:"code";s:21:"exmo_btcpln_buy_price";s:4:"birg";s:4:"exmo";}i:329;a:4:{s:5:"title";s:20:"BTC-PLN (sell_price)";s:6:"course";s:14:"24235.93642984";s:4:"code";s:22:"exmo_btcpln_sell_price";s:4:"birg";s:4:"exmo";}i:330;a:4:{s:5:"title";s:20:"BTC-PLN (last_trade)";s:6:"course";s:7:"24047.2";s:4:"code";s:22:"exmo_btcpln_last_trade";s:4:"birg";s:4:"exmo";}i:331;a:4:{s:5:"title";s:14:"BTC-PLN (high)";s:6:"course";s:7:"24423.6";s:4:"code";s:16:"exmo_btcpln_high";s:4:"birg";s:4:"exmo";}i:332;a:4:{s:5:"title";s:13:"BTC-PLN (low)";s:6:"course";s:14:"23418.44279021";s:4:"code";s:15:"exmo_btcpln_low";s:4:"birg";s:4:"exmo";}i:333;a:4:{s:5:"title";s:13:"BTC-PLN (avg)";s:6:"course";s:14:"24003.32818844";s:4:"code";s:15:"exmo_btcpln_avg";s:4:"birg";s:4:"exmo";}i:334;a:4:{s:5:"title";s:19:"BTC-TRY (buy_price)";s:6:"course";s:13:"34397.2261566";s:4:"code";s:21:"exmo_btctry_buy_price";s:4:"birg";s:4:"exmo";}i:335;a:4:{s:5:"title";s:20:"BTC-TRY (sell_price)";s:6:"course";s:14:"34569.42726988";s:4:"code";s:22:"exmo_btctry_sell_price";s:4:"birg";s:4:"exmo";}i:336;a:4:{s:5:"title";s:20:"BTC-TRY (last_trade)";s:6:"course";s:5:"34447";s:4:"code";s:22:"exmo_btctry_last_trade";s:4:"birg";s:4:"exmo";}i:337;a:4:{s:5:"title";s:14:"BTC-TRY (high)";s:6:"course";s:5:"34937";s:4:"code";s:16:"exmo_btctry_high";s:4:"birg";s:4:"exmo";}i:338;a:4:{s:5:"title";s:13:"BTC-TRY (low)";s:6:"course";s:13:"32396.0287637";s:4:"code";s:15:"exmo_btctry_low";s:4:"birg";s:4:"exmo";}i:339;a:4:{s:5:"title";s:13:"BTC-TRY (avg)";s:6:"course";s:14:"33922.96926362";s:4:"code";s:15:"exmo_btctry_avg";s:4:"birg";s:4:"exmo";}i:340;a:4:{s:5:"title";s:19:"ETH-TRY (buy_price)";s:6:"course";s:12:"1077.5518722";s:4:"code";s:21:"exmo_ethtry_buy_price";s:4:"birg";s:4:"exmo";}i:341;a:4:{s:5:"title";s:20:"ETH-TRY (sell_price)";s:6:"course";s:13:"1082.94636589";s:4:"code";s:22:"exmo_ethtry_sell_price";s:4:"birg";s:4:"exmo";}i:342;a:4:{s:5:"title";s:20:"ETH-TRY (last_trade)";s:6:"course";s:6:"1081.7";s:4:"code";s:22:"exmo_ethtry_last_trade";s:4:"birg";s:4:"exmo";}i:343;a:4:{s:5:"title";s:14:"ETH-TRY (high)";s:6:"course";s:4:"1100";s:4:"code";s:16:"exmo_ethtry_high";s:4:"birg";s:4:"exmo";}i:344;a:4:{s:5:"title";s:13:"ETH-TRY (low)";s:6:"course";s:13:"1018.92444833";s:4:"code";s:15:"exmo_ethtry_low";s:4:"birg";s:4:"exmo";}i:345;a:4:{s:5:"title";s:13:"ETH-TRY (avg)";s:6:"course";s:12:"1062.7442873";s:4:"code";s:15:"exmo_ethtry_avg";s:4:"birg";s:4:"exmo";}i:346;a:4:{s:5:"title";s:19:"XRP-TRY (buy_price)";s:6:"course";s:10:"2.43644091";s:4:"code";s:21:"exmo_xrptry_buy_price";s:4:"birg";s:4:"exmo";}i:347;a:4:{s:5:"title";s:20:"XRP-TRY (sell_price)";s:6:"course";s:10:"2.44863834";s:4:"code";s:22:"exmo_xrptry_sell_price";s:4:"birg";s:4:"exmo";}i:348;a:4:{s:5:"title";s:20:"XRP-TRY (last_trade)";s:6:"course";s:10:"2.43644091";s:4:"code";s:22:"exmo_xrptry_last_trade";s:4:"birg";s:4:"exmo";}i:349;a:4:{s:5:"title";s:14:"XRP-TRY (high)";s:6:"course";s:6:"2.4987";s:4:"code";s:16:"exmo_xrptry_high";s:4:"birg";s:4:"exmo";}i:350;a:4:{s:5:"title";s:13:"XRP-TRY (low)";s:6:"course";s:10:"2.31310381";s:4:"code";s:15:"exmo_xrptry_low";s:4:"birg";s:4:"exmo";}i:351;a:4:{s:5:"title";s:13:"XRP-TRY (avg)";s:6:"course";s:10:"2.40870713";s:4:"code";s:15:"exmo_xrptry_avg";s:4:"birg";s:4:"exmo";}i:352;a:4:{s:5:"title";s:19:"XLM-TRY (buy_price)";s:6:"course";s:9:"1.2490486";s:4:"code";s:21:"exmo_xlmtry_buy_price";s:4:"birg";s:4:"exmo";}i:353;a:4:{s:5:"title";s:20:"XLM-TRY (sell_price)";s:6:"course";s:10:"1.25530164";s:4:"code";s:22:"exmo_xlmtry_sell_price";s:4:"birg";s:4:"exmo";}i:354;a:4:{s:5:"title";s:20:"XLM-TRY (last_trade)";s:6:"course";s:6:"1.2519";s:4:"code";s:22:"exmo_xlmtry_last_trade";s:4:"birg";s:4:"exmo";}i:355;a:4:{s:5:"title";s:14:"XLM-TRY (high)";s:6:"course";s:10:"1.26284852";s:4:"code";s:16:"exmo_xlmtry_high";s:4:"birg";s:4:"exmo";}i:356;a:4:{s:5:"title";s:13:"XLM-TRY (low)";s:6:"course";s:10:"1.18345255";s:4:"code";s:15:"exmo_xlmtry_low";s:4:"birg";s:4:"exmo";}i:357;a:4:{s:5:"title";s:13:"XLM-TRY (avg)";s:6:"course";s:9:"1.2331312";s:4:"code";s:15:"exmo_xlmtry_avg";s:4:"birg";s:4:"exmo";}i:358;a:4:{s:5:"title";s:19:"XEM-BTC (buy_price)";s:6:"course";s:10:"0.00001457";s:4:"code";s:21:"exmo_xembtc_buy_price";s:4:"birg";s:4:"exmo";}i:359;a:4:{s:5:"title";s:20:"XEM-BTC (sell_price)";s:6:"course";s:10:"0.00001477";s:4:"code";s:22:"exmo_xembtc_sell_price";s:4:"birg";s:4:"exmo";}i:360;a:4:{s:5:"title";s:20:"XEM-BTC (last_trade)";s:6:"course";s:9:"0.0000146";s:4:"code";s:22:"exmo_xembtc_last_trade";s:4:"birg";s:4:"exmo";}i:361;a:4:{s:5:"title";s:14:"XEM-BTC (high)";s:6:"course";s:8:"0.000016";s:4:"code";s:16:"exmo_xembtc_high";s:4:"birg";s:4:"exmo";}i:362;a:4:{s:5:"title";s:13:"XEM-BTC (low)";s:6:"course";s:9:"0.0000145";s:4:"code";s:15:"exmo_xembtc_low";s:4:"birg";s:4:"exmo";}i:363;a:4:{s:5:"title";s:13:"XEM-BTC (avg)";s:6:"course";s:10:"0.00001499";s:4:"code";s:15:"exmo_xembtc_avg";s:4:"birg";s:4:"exmo";}i:364;a:4:{s:5:"title";s:19:"XEM-USD (buy_price)";s:6:"course";s:10:"0.09520001";s:4:"code";s:21:"exmo_xemusd_buy_price";s:4:"birg";s:4:"exmo";}i:365;a:4:{s:5:"title";s:20:"XEM-USD (sell_price)";s:6:"course";s:7:"0.09665";s:4:"code";s:22:"exmo_xemusd_sell_price";s:4:"birg";s:4:"exmo";}i:366;a:4:{s:5:"title";s:20:"XEM-USD (last_trade)";s:6:"course";s:9:"0.0961845";s:4:"code";s:22:"exmo_xemusd_last_trade";s:4:"birg";s:4:"exmo";}i:367;a:4:{s:5:"title";s:14:"XEM-USD (high)";s:6:"course";s:5:"0.102";s:4:"code";s:16:"exmo_xemusd_high";s:4:"birg";s:4:"exmo";}i:368;a:4:{s:5:"title";s:13:"XEM-USD (low)";s:6:"course";s:5:"0.095";s:4:"code";s:15:"exmo_xemusd_low";s:4:"birg";s:4:"exmo";}i:369;a:4:{s:5:"title";s:13:"XEM-USD (avg)";s:6:"course";s:10:"0.09849046";s:4:"code";s:15:"exmo_xemusd_avg";s:4:"birg";s:4:"exmo";}i:370;a:4:{s:5:"title";s:19:"XEM-EUR (buy_price)";s:6:"course";s:6:"0.0845";s:4:"code";s:21:"exmo_xemeur_buy_price";s:4:"birg";s:4:"exmo";}i:371;a:4:{s:5:"title";s:20:"XEM-EUR (sell_price)";s:6:"course";s:10:"0.08803515";s:4:"code";s:22:"exmo_xemeur_sell_price";s:4:"birg";s:4:"exmo";}i:372;a:4:{s:5:"title";s:20:"XEM-EUR (last_trade)";s:6:"course";s:8:"0.085221";s:4:"code";s:22:"exmo_xemeur_last_trade";s:4:"birg";s:4:"exmo";}i:373;a:4:{s:5:"title";s:14:"XEM-EUR (high)";s:6:"course";s:10:"0.09187665";s:4:"code";s:16:"exmo_xemeur_high";s:4:"birg";s:4:"exmo";}i:374;a:4:{s:5:"title";s:13:"XEM-EUR (low)";s:6:"course";s:8:"0.084798";s:4:"code";s:15:"exmo_xemeur_low";s:4:"birg";s:4:"exmo";}i:375;a:4:{s:5:"title";s:13:"XEM-EUR (avg)";s:6:"course";s:10:"0.08782953";s:4:"code";s:15:"exmo_xemeur_avg";s:4:"birg";s:4:"exmo";}i:376;a:4:{s:5:"title";s:20:"GUSD-BTC (buy_price)";s:6:"course";s:10:"0.00015516";s:4:"code";s:22:"exmo_gusdbtc_buy_price";s:4:"birg";s:4:"exmo";}i:377;a:4:{s:5:"title";s:21:"GUSD-BTC (sell_price)";s:6:"course";s:9:"0.0001561";s:4:"code";s:23:"exmo_gusdbtc_sell_price";s:4:"birg";s:4:"exmo";}i:378;a:4:{s:5:"title";s:21:"GUSD-BTC (last_trade)";s:6:"course";s:10:"0.00015592";s:4:"code";s:23:"exmo_gusdbtc_last_trade";s:4:"birg";s:4:"exmo";}i:379;a:4:{s:5:"title";s:15:"GUSD-BTC (high)";s:6:"course";s:9:"0.0001562";s:4:"code";s:17:"exmo_gusdbtc_high";s:4:"birg";s:4:"exmo";}i:380;a:4:{s:5:"title";s:14:"GUSD-BTC (low)";s:6:"course";s:10:"0.00015314";s:4:"code";s:16:"exmo_gusdbtc_low";s:4:"birg";s:4:"exmo";}i:381;a:4:{s:5:"title";s:14:"GUSD-BTC (avg)";s:6:"course";s:10:"0.00015493";s:4:"code";s:16:"exmo_gusdbtc_avg";s:4:"birg";s:4:"exmo";}i:382;a:4:{s:5:"title";s:20:"GUSD-USD (buy_price)";s:6:"course";s:10:"1.01342579";s:4:"code";s:22:"exmo_gusdusd_buy_price";s:4:"birg";s:4:"exmo";}i:383;a:4:{s:5:"title";s:21:"GUSD-USD (sell_price)";s:6:"course";s:10:"1.02999999";s:4:"code";s:23:"exmo_gusdusd_sell_price";s:4:"birg";s:4:"exmo";}i:384;a:4:{s:5:"title";s:21:"GUSD-USD (last_trade)";s:6:"course";s:7:"1.02704";s:4:"code";s:23:"exmo_gusdusd_last_trade";s:4:"birg";s:4:"exmo";}i:385;a:4:{s:5:"title";s:15:"GUSD-USD (high)";s:6:"course";s:10:"1.03189999";s:4:"code";s:17:"exmo_gusdusd_high";s:4:"birg";s:4:"exmo";}i:386;a:4:{s:5:"title";s:14:"GUSD-USD (low)";s:6:"course";s:10:"1.01300232";s:4:"code";s:16:"exmo_gusdusd_low";s:4:"birg";s:4:"exmo";}i:387;a:4:{s:5:"title";s:14:"GUSD-USD (avg)";s:6:"course";s:9:"1.0223467";s:4:"code";s:16:"exmo_gusdusd_avg";s:4:"birg";s:4:"exmo";}i:388;a:4:{s:5:"title";s:20:"GUSD-RUB (buy_price)";s:6:"course";s:8:"67.00067";s:4:"code";s:22:"exmo_gusdrub_buy_price";s:4:"birg";s:4:"exmo";}i:389;a:4:{s:5:"title";s:21:"GUSD-RUB (sell_price)";s:6:"course";s:11:"67.79979999";s:4:"code";s:23:"exmo_gusdrub_sell_price";s:4:"birg";s:4:"exmo";}i:390;a:4:{s:5:"title";s:21:"GUSD-RUB (last_trade)";s:6:"course";s:7:"67.3638";s:4:"code";s:23:"exmo_gusdrub_last_trade";s:4:"birg";s:4:"exmo";}i:391;a:4:{s:5:"title";s:15:"GUSD-RUB (high)";s:6:"course";s:8:"67.99976";s:4:"code";s:17:"exmo_gusdrub_high";s:4:"birg";s:4:"exmo";}i:392;a:4:{s:5:"title";s:14:"GUSD-RUB (low)";s:6:"course";s:2:"67";s:4:"code";s:16:"exmo_gusdrub_low";s:4:"birg";s:4:"exmo";}i:393;a:4:{s:5:"title";s:14:"GUSD-RUB (avg)";s:6:"course";s:11:"67.47350626";s:4:"code";s:16:"exmo_gusdrub_avg";s:4:"birg";s:4:"exmo";}i:394;a:4:{s:5:"title";s:19:"LSK-BTC (buy_price)";s:6:"course";s:10:"0.00042103";s:4:"code";s:21:"exmo_lskbtc_buy_price";s:4:"birg";s:4:"exmo";}i:395;a:4:{s:5:"title";s:20:"LSK-BTC (sell_price)";s:6:"course";s:9:"0.0004479";s:4:"code";s:22:"exmo_lskbtc_sell_price";s:4:"birg";s:4:"exmo";}i:396;a:4:{s:5:"title";s:20:"LSK-BTC (last_trade)";s:6:"course";s:7:"0.00044";s:4:"code";s:22:"exmo_lskbtc_last_trade";s:4:"birg";s:4:"exmo";}i:397;a:4:{s:5:"title";s:14:"LSK-BTC (high)";s:6:"course";s:8:"0.000455";s:4:"code";s:16:"exmo_lskbtc_high";s:4:"birg";s:4:"exmo";}i:398;a:4:{s:5:"title";s:13:"LSK-BTC (low)";s:6:"course";s:10:"0.00041702";s:4:"code";s:15:"exmo_lskbtc_low";s:4:"birg";s:4:"exmo";}i:399;a:4:{s:5:"title";s:13:"LSK-BTC (avg)";s:6:"course";s:10:"0.00044425";s:4:"code";s:15:"exmo_lskbtc_avg";s:4:"birg";s:4:"exmo";}i:400;a:4:{s:5:"title";s:19:"LSK-USD (buy_price)";s:6:"course";s:6:"2.9213";s:4:"code";s:21:"exmo_lskusd_buy_price";s:4:"birg";s:4:"exmo";}i:401;a:4:{s:5:"title";s:20:"LSK-USD (sell_price)";s:6:"course";s:10:"3.00482026";s:4:"code";s:22:"exmo_lskusd_sell_price";s:4:"birg";s:4:"exmo";}i:402;a:4:{s:5:"title";s:20:"LSK-USD (last_trade)";s:6:"course";s:6:"2.9562";s:4:"code";s:22:"exmo_lskusd_last_trade";s:4:"birg";s:4:"exmo";}i:403;a:4:{s:5:"title";s:14:"LSK-USD (high)";s:6:"course";s:6:"3.0899";s:4:"code";s:16:"exmo_lskusd_high";s:4:"birg";s:4:"exmo";}i:404;a:4:{s:5:"title";s:13:"LSK-USD (low)";s:6:"course";s:6:"2.9213";s:4:"code";s:15:"exmo_lskusd_low";s:4:"birg";s:4:"exmo";}i:405;a:4:{s:5:"title";s:13:"LSK-USD (avg)";s:6:"course";s:10:"2.98495679";s:4:"code";s:15:"exmo_lskusd_avg";s:4:"birg";s:4:"exmo";}i:406;a:4:{s:5:"title";s:19:"LSK-RUB (buy_price)";s:6:"course";s:12:"189.00000001";s:4:"code";s:21:"exmo_lskrub_buy_price";s:4:"birg";s:4:"exmo";}i:407;a:4:{s:5:"title";s:20:"LSK-RUB (sell_price)";s:6:"course";s:12:"196.49989999";s:4:"code";s:22:"exmo_lskrub_sell_price";s:4:"birg";s:4:"exmo";}i:408;a:4:{s:5:"title";s:20:"LSK-RUB (last_trade)";s:6:"course";s:7:"192.819";s:4:"code";s:22:"exmo_lskrub_last_trade";s:4:"birg";s:4:"exmo";}i:409;a:4:{s:5:"title";s:14:"LSK-RUB (high)";s:6:"course";s:3:"204";s:4:"code";s:16:"exmo_lskrub_high";s:4:"birg";s:4:"exmo";}i:410;a:4:{s:5:"title";s:13:"LSK-RUB (low)";s:6:"course";s:3:"189";s:4:"code";s:15:"exmo_lskrub_low";s:4:"birg";s:4:"exmo";}i:411;a:4:{s:5:"title";s:13:"LSK-RUB (avg)";s:6:"course";s:12:"196.67630449";s:4:"code";s:15:"exmo_lskrub_avg";s:4:"birg";s:4:"exmo";}i:412;a:4:{s:5:"title";s:19:"NEO-BTC (buy_price)";s:6:"course";s:10:"0.00252669";s:4:"code";s:21:"exmo_neobtc_buy_price";s:4:"birg";s:4:"exmo";}i:413;a:4:{s:5:"title";s:20:"NEO-BTC (sell_price)";s:6:"course";s:10:"0.00256783";s:4:"code";s:22:"exmo_neobtc_sell_price";s:4:"birg";s:4:"exmo";}i:414;a:4:{s:5:"title";s:20:"NEO-BTC (last_trade)";s:6:"course";s:10:"0.00254058";s:4:"code";s:22:"exmo_neobtc_last_trade";s:4:"birg";s:4:"exmo";}i:415;a:4:{s:5:"title";s:14:"NEO-BTC (high)";s:6:"course";s:10:"0.00257499";s:4:"code";s:16:"exmo_neobtc_high";s:4:"birg";s:4:"exmo";}i:416;a:4:{s:5:"title";s:13:"NEO-BTC (low)";s:6:"course";s:9:"0.0025069";s:4:"code";s:15:"exmo_neobtc_low";s:4:"birg";s:4:"exmo";}i:417;a:4:{s:5:"title";s:13:"NEO-BTC (avg)";s:6:"course";s:10:"0.00254732";s:4:"code";s:15:"exmo_neobtc_avg";s:4:"birg";s:4:"exmo";}i:418;a:4:{s:5:"title";s:19:"NEO-USD (buy_price)";s:6:"course";s:10:"16.6801668";s:4:"code";s:21:"exmo_neousd_buy_price";s:4:"birg";s:4:"exmo";}i:419;a:4:{s:5:"title";s:20:"NEO-USD (sell_price)";s:6:"course";s:11:"16.86354129";s:4:"code";s:22:"exmo_neousd_sell_price";s:4:"birg";s:4:"exmo";}i:420;a:4:{s:5:"title";s:20:"NEO-USD (last_trade)";s:6:"course";s:11:"16.86354129";s:4:"code";s:22:"exmo_neousd_last_trade";s:4:"birg";s:4:"exmo";}i:421;a:4:{s:5:"title";s:14:"NEO-USD (high)";s:6:"course";s:7:"16.9826";s:4:"code";s:16:"exmo_neousd_high";s:4:"birg";s:4:"exmo";}i:422;a:4:{s:5:"title";s:13:"NEO-USD (low)";s:6:"course";s:11:"16.65000001";s:4:"code";s:15:"exmo_neousd_low";s:4:"birg";s:4:"exmo";}i:423;a:4:{s:5:"title";s:13:"NEO-USD (avg)";s:6:"course";s:10:"16.8010454";s:4:"code";s:15:"exmo_neousd_avg";s:4:"birg";s:4:"exmo";}i:424;a:4:{s:5:"title";s:19:"NEO-RUB (buy_price)";s:6:"course";s:13:"1090.00000003";s:4:"code";s:21:"exmo_neorub_buy_price";s:4:"birg";s:4:"exmo";}i:425;a:4:{s:5:"title";s:20:"NEO-RUB (sell_price)";s:6:"course";s:4:"1105";s:4:"code";s:22:"exmo_neorub_sell_price";s:4:"birg";s:4:"exmo";}i:426;a:4:{s:5:"title";s:20:"NEO-RUB (last_trade)";s:6:"course";s:13:"1090.00000003";s:4:"code";s:22:"exmo_neorub_last_trade";s:4:"birg";s:4:"exmo";}i:427;a:4:{s:5:"title";s:14:"NEO-RUB (high)";s:6:"course";s:4:"1125";s:4:"code";s:16:"exmo_neorub_high";s:4:"birg";s:4:"exmo";}i:428;a:4:{s:5:"title";s:13:"NEO-RUB (low)";s:6:"course";s:4:"1090";s:4:"code";s:15:"exmo_neorub_low";s:4:"birg";s:4:"exmo";}i:429;a:4:{s:5:"title";s:13:"NEO-RUB (avg)";s:6:"course";s:13:"1108.03839512";s:4:"code";s:15:"exmo_neorub_avg";s:4:"birg";s:4:"exmo";}i:430;a:4:{s:5:"title";s:19:"ADA-BTC (buy_price)";s:6:"course";s:10:"0.00001136";s:4:"code";s:21:"exmo_adabtc_buy_price";s:4:"birg";s:4:"exmo";}i:431;a:4:{s:5:"title";s:20:"ADA-BTC (sell_price)";s:6:"course";s:10:"0.00001141";s:4:"code";s:22:"exmo_adabtc_sell_price";s:4:"birg";s:4:"exmo";}i:432;a:4:{s:5:"title";s:20:"ADA-BTC (last_trade)";s:6:"course";s:10:"0.00001137";s:4:"code";s:22:"exmo_adabtc_last_trade";s:4:"birg";s:4:"exmo";}i:433;a:4:{s:5:"title";s:14:"ADA-BTC (high)";s:6:"course";s:10:"0.00001162";s:4:"code";s:16:"exmo_adabtc_high";s:4:"birg";s:4:"exmo";}i:434;a:4:{s:5:"title";s:13:"ADA-BTC (low)";s:6:"course";s:10:"0.00000015";s:4:"code";s:15:"exmo_adabtc_low";s:4:"birg";s:4:"exmo";}i:435;a:4:{s:5:"title";s:13:"ADA-BTC (avg)";s:6:"course";s:10:"0.00001044";s:4:"code";s:15:"exmo_adabtc_avg";s:4:"birg";s:4:"exmo";}i:436;a:4:{s:5:"title";s:19:"ADA-USD (buy_price)";s:6:"course";s:5:"0.075";s:4:"code";s:21:"exmo_adausd_buy_price";s:4:"birg";s:4:"exmo";}i:437;a:4:{s:5:"title";s:20:"ADA-USD (sell_price)";s:6:"course";s:10:"0.07575543";s:4:"code";s:22:"exmo_adausd_sell_price";s:4:"birg";s:4:"exmo";}i:438;a:4:{s:5:"title";s:20:"ADA-USD (last_trade)";s:6:"course";s:5:"0.075";s:4:"code";s:22:"exmo_adausd_last_trade";s:4:"birg";s:4:"exmo";}i:439;a:4:{s:5:"title";s:14:"ADA-USD (high)";s:6:"course";s:8:"0.076185";s:4:"code";s:16:"exmo_adausd_high";s:4:"birg";s:4:"exmo";}i:440;a:4:{s:5:"title";s:13:"ADA-USD (low)";s:6:"course";s:5:"0.075";s:4:"code";s:15:"exmo_adausd_low";s:4:"birg";s:4:"exmo";}i:441;a:4:{s:5:"title";s:13:"ADA-USD (avg)";s:6:"course";s:10:"0.07544106";s:4:"code";s:15:"exmo_adausd_avg";s:4:"birg";s:4:"exmo";}i:442;a:4:{s:5:"title";s:19:"ADA-ETH (buy_price)";s:6:"course";s:10:"0.00036344";s:4:"code";s:21:"exmo_adaeth_buy_price";s:4:"birg";s:4:"exmo";}i:443;a:4:{s:5:"title";s:20:"ADA-ETH (sell_price)";s:6:"course";s:10:"0.00036834";s:4:"code";s:22:"exmo_adaeth_sell_price";s:4:"birg";s:4:"exmo";}i:444;a:4:{s:5:"title";s:20:"ADA-ETH (last_trade)";s:6:"course";s:10:"0.00036934";s:4:"code";s:22:"exmo_adaeth_last_trade";s:4:"birg";s:4:"exmo";}i:445;a:4:{s:5:"title";s:14:"ADA-ETH (high)";s:6:"course";s:10:"0.00037011";s:4:"code";s:16:"exmo_adaeth_high";s:4:"birg";s:4:"exmo";}i:446;a:4:{s:5:"title";s:13:"ADA-ETH (low)";s:6:"course";s:8:"0.000361";s:4:"code";s:15:"exmo_adaeth_low";s:4:"birg";s:4:"exmo";}i:447;a:4:{s:5:"title";s:13:"ADA-ETH (avg)";s:6:"course";s:10:"0.00036383";s:4:"code";s:15:"exmo_adaeth_avg";s:4:"birg";s:4:"exmo";}i:448;a:4:{s:5:"title";s:19:"ZRX-BTC (buy_price)";s:6:"course";s:10:"0.00012354";s:4:"code";s:21:"exmo_zrxbtc_buy_price";s:4:"birg";s:4:"exmo";}i:449;a:4:{s:5:"title";s:20:"ZRX-BTC (sell_price)";s:6:"course";s:10:"0.00012464";s:4:"code";s:22:"exmo_zrxbtc_sell_price";s:4:"birg";s:4:"exmo";}i:450;a:4:{s:5:"title";s:20:"ZRX-BTC (last_trade)";s:6:"course";s:10:"0.00012465";s:4:"code";s:22:"exmo_zrxbtc_last_trade";s:4:"birg";s:4:"exmo";}i:451;a:4:{s:5:"title";s:14:"ZRX-BTC (high)";s:6:"course";s:10:"0.00012759";s:4:"code";s:16:"exmo_zrxbtc_high";s:4:"birg";s:4:"exmo";}i:452;a:4:{s:5:"title";s:13:"ZRX-BTC (low)";s:6:"course";s:9:"0.0001135";s:4:"code";s:15:"exmo_zrxbtc_low";s:4:"birg";s:4:"exmo";}i:453;a:4:{s:5:"title";s:13:"ZRX-BTC (avg)";s:6:"course";s:10:"0.00012451";s:4:"code";s:15:"exmo_zrxbtc_avg";s:4:"birg";s:4:"exmo";}i:454;a:4:{s:5:"title";s:19:"ZRX-ETH (buy_price)";s:6:"course";s:10:"0.00397803";s:4:"code";s:21:"exmo_zrxeth_buy_price";s:4:"birg";s:4:"exmo";}i:455;a:4:{s:5:"title";s:20:"ZRX-ETH (sell_price)";s:6:"course";s:10:"0.00399363";s:4:"code";s:22:"exmo_zrxeth_sell_price";s:4:"birg";s:4:"exmo";}i:456;a:4:{s:5:"title";s:20:"ZRX-ETH (last_trade)";s:6:"course";s:10:"0.00398885";s:4:"code";s:22:"exmo_zrxeth_last_trade";s:4:"birg";s:4:"exmo";}i:457;a:4:{s:5:"title";s:14:"ZRX-ETH (high)";s:6:"course";s:6:"0.0041";s:4:"code";s:16:"exmo_zrxeth_high";s:4:"birg";s:4:"exmo";}i:458;a:4:{s:5:"title";s:13:"ZRX-ETH (low)";s:6:"course";s:9:"0.0039672";s:4:"code";s:15:"exmo_zrxeth_low";s:4:"birg";s:4:"exmo";}i:459;a:4:{s:5:"title";s:13:"ZRX-ETH (avg)";s:6:"course";s:10:"0.00400927";s:4:"code";s:15:"exmo_zrxeth_avg";s:4:"birg";s:4:"exmo";}i:460;a:4:{s:5:"title";s:19:"GNT-BTC (buy_price)";s:6:"course";s:10:"0.00002696";s:4:"code";s:21:"exmo_gntbtc_buy_price";s:4:"birg";s:4:"exmo";}i:461;a:4:{s:5:"title";s:20:"GNT-BTC (sell_price)";s:6:"course";s:10:"0.00002769";s:4:"code";s:22:"exmo_gntbtc_sell_price";s:4:"birg";s:4:"exmo";}i:462;a:4:{s:5:"title";s:20:"GNT-BTC (last_trade)";s:6:"course";s:10:"0.00002731";s:4:"code";s:22:"exmo_gntbtc_last_trade";s:4:"birg";s:4:"exmo";}i:463;a:4:{s:5:"title";s:14:"GNT-BTC (high)";s:6:"course";s:10:"0.00002919";s:4:"code";s:16:"exmo_gntbtc_high";s:4:"birg";s:4:"exmo";}i:464;a:4:{s:5:"title";s:13:"GNT-BTC (low)";s:6:"course";s:9:"0.0000272";s:4:"code";s:15:"exmo_gntbtc_low";s:4:"birg";s:4:"exmo";}i:465;a:4:{s:5:"title";s:13:"GNT-BTC (avg)";s:6:"course";s:10:"0.00002838";s:4:"code";s:15:"exmo_gntbtc_avg";s:4:"birg";s:4:"exmo";}i:466;a:4:{s:5:"title";s:19:"GNT-ETH (buy_price)";s:6:"course";s:10:"0.00087777";s:4:"code";s:21:"exmo_gnteth_buy_price";s:4:"birg";s:4:"exmo";}i:467;a:4:{s:5:"title";s:20:"GNT-ETH (sell_price)";s:6:"course";s:10:"0.00089396";s:4:"code";s:22:"exmo_gnteth_sell_price";s:4:"birg";s:4:"exmo";}i:468;a:4:{s:5:"title";s:20:"GNT-ETH (last_trade)";s:6:"course";s:10:"0.00088946";s:4:"code";s:22:"exmo_gnteth_last_trade";s:4:"birg";s:4:"exmo";}i:469;a:4:{s:5:"title";s:14:"GNT-ETH (high)";s:6:"course";s:10:"0.00093999";s:4:"code";s:16:"exmo_gnteth_high";s:4:"birg";s:4:"exmo";}i:470;a:4:{s:5:"title";s:13:"GNT-ETH (low)";s:6:"course";s:10:"0.00087777";s:4:"code";s:15:"exmo_gnteth_low";s:4:"birg";s:4:"exmo";}i:471;a:4:{s:5:"title";s:13:"GNT-ETH (avg)";s:6:"course";s:10:"0.00091206";s:4:"code";s:15:"exmo_gnteth_avg";s:4:"birg";s:4:"exmo";}i:472;a:4:{s:5:"title";s:19:"TRX-BTC (buy_price)";s:6:"course";s:10:"0.00000362";s:4:"code";s:21:"exmo_trxbtc_buy_price";s:4:"birg";s:4:"exmo";}i:473;a:4:{s:5:"title";s:20:"TRX-BTC (sell_price)";s:6:"course";s:10:"0.00000364";s:4:"code";s:22:"exmo_trxbtc_sell_price";s:4:"birg";s:4:"exmo";}i:474;a:4:{s:5:"title";s:20:"TRX-BTC (last_trade)";s:6:"course";s:10:"0.00000363";s:4:"code";s:22:"exmo_trxbtc_last_trade";s:4:"birg";s:4:"exmo";}i:475;a:4:{s:5:"title";s:14:"TRX-BTC (high)";s:6:"course";s:10:"0.00000367";s:4:"code";s:16:"exmo_trxbtc_high";s:4:"birg";s:4:"exmo";}i:476;a:4:{s:5:"title";s:13:"TRX-BTC (low)";s:6:"course";s:10:"0.00000357";s:4:"code";s:15:"exmo_trxbtc_low";s:4:"birg";s:4:"exmo";}i:477;a:4:{s:5:"title";s:13:"TRX-BTC (avg)";s:6:"course";s:10:"0.00000364";s:4:"code";s:15:"exmo_trxbtc_avg";s:4:"birg";s:4:"exmo";}i:478;a:4:{s:5:"title";s:19:"TRX-USD (buy_price)";s:6:"course";s:7:"0.02381";s:4:"code";s:21:"exmo_trxusd_buy_price";s:4:"birg";s:4:"exmo";}i:479;a:4:{s:5:"title";s:20:"TRX-USD (sell_price)";s:6:"course";s:10:"0.02396444";s:4:"code";s:22:"exmo_trxusd_sell_price";s:4:"birg";s:4:"exmo";}i:480;a:4:{s:5:"title";s:20:"TRX-USD (last_trade)";s:6:"course";s:9:"0.0238446";s:4:"code";s:22:"exmo_trxusd_last_trade";s:4:"birg";s:4:"exmo";}i:481;a:4:{s:5:"title";s:14:"TRX-USD (high)";s:6:"course";s:6:"0.0242";s:4:"code";s:16:"exmo_trxusd_high";s:4:"birg";s:4:"exmo";}i:482;a:4:{s:5:"title";s:13:"TRX-USD (low)";s:6:"course";s:10:"0.02360003";s:4:"code";s:15:"exmo_trxusd_low";s:4:"birg";s:4:"exmo";}i:483;a:4:{s:5:"title";s:13:"TRX-USD (avg)";s:6:"course";s:10:"0.02400589";s:4:"code";s:15:"exmo_trxusd_avg";s:4:"birg";s:4:"exmo";}i:484;a:4:{s:5:"title";s:19:"TRX-RUB (buy_price)";s:6:"course";s:8:"1.564212";s:4:"code";s:21:"exmo_trxrub_buy_price";s:4:"birg";s:4:"exmo";}i:485;a:4:{s:5:"title";s:20:"TRX-RUB (sell_price)";s:6:"course";s:9:"1.5759273";s:4:"code";s:22:"exmo_trxrub_sell_price";s:4:"birg";s:4:"exmo";}i:486;a:4:{s:5:"title";s:20:"TRX-RUB (last_trade)";s:6:"course";s:5:"1.573";s:4:"code";s:22:"exmo_trxrub_last_trade";s:4:"birg";s:4:"exmo";}i:487;a:4:{s:5:"title";s:14:"TRX-RUB (high)";s:6:"course";s:7:"1.58496";s:4:"code";s:16:"exmo_trxrub_high";s:4:"birg";s:4:"exmo";}i:488;a:4:{s:5:"title";s:13:"TRX-RUB (low)";s:6:"course";s:10:"1.55062822";s:4:"code";s:15:"exmo_trxrub_low";s:4:"birg";s:4:"exmo";}i:489;a:4:{s:5:"title";s:13:"TRX-RUB (avg)";s:6:"course";s:10:"1.57501059";s:4:"code";s:15:"exmo_trxrub_avg";s:4:"birg";s:4:"exmo";}i:490;a:4:{s:5:"title";s:19:"GAS-BTC (buy_price)";s:6:"course";s:10:"0.00079777";s:4:"code";s:21:"exmo_gasbtc_buy_price";s:4:"birg";s:4:"exmo";}i:491;a:4:{s:5:"title";s:20:"GAS-BTC (sell_price)";s:6:"course";s:10:"0.00080487";s:4:"code";s:22:"exmo_gasbtc_sell_price";s:4:"birg";s:4:"exmo";}i:492;a:4:{s:5:"title";s:20:"GAS-BTC (last_trade)";s:6:"course";s:10:"0.00080159";s:4:"code";s:22:"exmo_gasbtc_last_trade";s:4:"birg";s:4:"exmo";}i:493;a:4:{s:5:"title";s:14:"GAS-BTC (high)";s:6:"course";s:10:"0.00080571";s:4:"code";s:16:"exmo_gasbtc_high";s:4:"birg";s:4:"exmo";}i:494;a:4:{s:5:"title";s:13:"GAS-BTC (low)";s:6:"course";s:10:"0.00079567";s:4:"code";s:15:"exmo_gasbtc_low";s:4:"birg";s:4:"exmo";}i:495;a:4:{s:5:"title";s:13:"GAS-BTC (avg)";s:6:"course";s:10:"0.00080113";s:4:"code";s:15:"exmo_gasbtc_avg";s:4:"birg";s:4:"exmo";}i:496;a:4:{s:5:"title";s:19:"GAS-USD (buy_price)";s:6:"course";s:5:"5.255";s:4:"code";s:21:"exmo_gasusd_buy_price";s:4:"birg";s:4:"exmo";}i:497;a:4:{s:5:"title";s:20:"GAS-USD (sell_price)";s:6:"course";s:8:"5.309469";s:4:"code";s:22:"exmo_gasusd_sell_price";s:4:"birg";s:4:"exmo";}i:498;a:4:{s:5:"title";s:20:"GAS-USD (last_trade)";s:6:"course";s:7:"5.26598";s:4:"code";s:22:"exmo_gasusd_last_trade";s:4:"birg";s:4:"exmo";}i:499;a:4:{s:5:"title";s:14:"GAS-USD (high)";s:6:"course";s:7:"5.33299";s:4:"code";s:16:"exmo_gasusd_high";s:4:"birg";s:4:"exmo";}i:500;a:4:{s:5:"title";s:13:"GAS-USD (low)";s:6:"course";s:6:"5.2629";s:4:"code";s:15:"exmo_gasusd_low";s:4:"birg";s:4:"exmo";}i:501;a:4:{s:5:"title";s:13:"GAS-USD (avg)";s:6:"course";s:10:"5.29305443";s:4:"code";s:15:"exmo_gasusd_avg";s:4:"birg";s:4:"exmo";}i:502;a:4:{s:5:"title";s:19:"INK-BTC (buy_price)";s:6:"course";s:10:"0.00000283";s:4:"code";s:21:"exmo_inkbtc_buy_price";s:4:"birg";s:4:"exmo";}i:503;a:4:{s:5:"title";s:20:"INK-BTC (sell_price)";s:6:"course";s:10:"0.00000285";s:4:"code";s:22:"exmo_inkbtc_sell_price";s:4:"birg";s:4:"exmo";}i:504;a:4:{s:5:"title";s:20:"INK-BTC (last_trade)";s:6:"course";s:10:"0.00000284";s:4:"code";s:22:"exmo_inkbtc_last_trade";s:4:"birg";s:4:"exmo";}i:505;a:4:{s:5:"title";s:14:"INK-BTC (high)";s:6:"course";s:10:"0.00000284";s:4:"code";s:16:"exmo_inkbtc_high";s:4:"birg";s:4:"exmo";}i:506;a:4:{s:5:"title";s:13:"INK-BTC (low)";s:6:"course";s:10:"0.00000283";s:4:"code";s:15:"exmo_inkbtc_low";s:4:"birg";s:4:"exmo";}i:507;a:4:{s:5:"title";s:13:"INK-BTC (avg)";s:6:"course";s:10:"0.00000283";s:4:"code";s:15:"exmo_inkbtc_avg";s:4:"birg";s:4:"exmo";}i:508;a:4:{s:5:"title";s:19:"INK-ETH (buy_price)";s:6:"course";s:9:"0.0000908";s:4:"code";s:21:"exmo_inketh_buy_price";s:4:"birg";s:4:"exmo";}i:509;a:4:{s:5:"title";s:20:"INK-ETH (sell_price)";s:6:"course";s:10:"0.00009108";s:4:"code";s:22:"exmo_inketh_sell_price";s:4:"birg";s:4:"exmo";}i:510;a:4:{s:5:"title";s:20:"INK-ETH (last_trade)";s:6:"course";s:10:"0.00009094";s:4:"code";s:22:"exmo_inketh_last_trade";s:4:"birg";s:4:"exmo";}i:511;a:4:{s:5:"title";s:14:"INK-ETH (high)";s:6:"course";s:10:"0.00009136";s:4:"code";s:16:"exmo_inketh_high";s:4:"birg";s:4:"exmo";}i:512;a:4:{s:5:"title";s:13:"INK-ETH (low)";s:6:"course";s:10:"0.00009087";s:4:"code";s:15:"exmo_inketh_low";s:4:"birg";s:4:"exmo";}i:513;a:4:{s:5:"title";s:13:"INK-ETH (avg)";s:6:"course";s:10:"0.00009106";s:4:"code";s:15:"exmo_inketh_avg";s:4:"birg";s:4:"exmo";}i:514;a:4:{s:5:"title";s:19:"INK-USD (buy_price)";s:6:"course";s:6:"0.0186";s:4:"code";s:21:"exmo_inkusd_buy_price";s:4:"birg";s:4:"exmo";}i:515;a:4:{s:5:"title";s:20:"INK-USD (sell_price)";s:6:"course";s:10:"0.01877287";s:4:"code";s:22:"exmo_inkusd_sell_price";s:4:"birg";s:4:"exmo";}i:516;a:4:{s:5:"title";s:20:"INK-USD (last_trade)";s:6:"course";s:9:"0.0187041";s:4:"code";s:22:"exmo_inkusd_last_trade";s:4:"birg";s:4:"exmo";}i:517;a:4:{s:5:"title";s:14:"INK-USD (high)";s:6:"course";s:7:"0.01884";s:4:"code";s:16:"exmo_inkusd_high";s:4:"birg";s:4:"exmo";}i:518;a:4:{s:5:"title";s:13:"INK-USD (low)";s:6:"course";s:6:"0.0184";s:4:"code";s:15:"exmo_inkusd_low";s:4:"birg";s:4:"exmo";}i:519;a:4:{s:5:"title";s:13:"INK-USD (avg)";s:6:"course";s:10:"0.01872806";s:4:"code";s:15:"exmo_inkusd_avg";s:4:"birg";s:4:"exmo";}i:520;a:4:{s:5:"title";s:19:"MNX-BTC (buy_price)";s:6:"course";s:10:"0.00034897";s:4:"code";s:21:"exmo_mnxbtc_buy_price";s:4:"birg";s:4:"exmo";}i:521;a:4:{s:5:"title";s:20:"MNX-BTC (sell_price)";s:6:"course";s:10:"0.00035622";s:4:"code";s:22:"exmo_mnxbtc_sell_price";s:4:"birg";s:4:"exmo";}i:522;a:4:{s:5:"title";s:20:"MNX-BTC (last_trade)";s:6:"course";s:10:"0.00035045";s:4:"code";s:22:"exmo_mnxbtc_last_trade";s:4:"birg";s:4:"exmo";}i:523;a:4:{s:5:"title";s:14:"MNX-BTC (high)";s:6:"course";s:8:"0.000374";s:4:"code";s:16:"exmo_mnxbtc_high";s:4:"birg";s:4:"exmo";}i:524;a:4:{s:5:"title";s:13:"MNX-BTC (low)";s:6:"course";s:10:"0.00033113";s:4:"code";s:15:"exmo_mnxbtc_low";s:4:"birg";s:4:"exmo";}i:525;a:4:{s:5:"title";s:13:"MNX-BTC (avg)";s:6:"course";s:10:"0.00034356";s:4:"code";s:15:"exmo_mnxbtc_avg";s:4:"birg";s:4:"exmo";}i:526;a:4:{s:5:"title";s:19:"MNX-ETH (buy_price)";s:6:"course";s:10:"0.01080578";s:4:"code";s:21:"exmo_mnxeth_buy_price";s:4:"birg";s:4:"exmo";}i:527;a:4:{s:5:"title";s:20:"MNX-ETH (sell_price)";s:6:"course";s:10:"0.01139999";s:4:"code";s:22:"exmo_mnxeth_sell_price";s:4:"birg";s:4:"exmo";}i:528;a:4:{s:5:"title";s:20:"MNX-ETH (last_trade)";s:6:"course";s:9:"0.0112463";s:4:"code";s:22:"exmo_mnxeth_last_trade";s:4:"birg";s:4:"exmo";}i:529;a:4:{s:5:"title";s:14:"MNX-ETH (high)";s:6:"course";s:6:"0.0114";s:4:"code";s:16:"exmo_mnxeth_high";s:4:"birg";s:4:"exmo";}i:530;a:4:{s:5:"title";s:13:"MNX-ETH (low)";s:6:"course";s:10:"0.01065091";s:4:"code";s:15:"exmo_mnxeth_low";s:4:"birg";s:4:"exmo";}i:531;a:4:{s:5:"title";s:13:"MNX-ETH (avg)";s:6:"course";s:10:"0.01097458";s:4:"code";s:15:"exmo_mnxeth_avg";s:4:"birg";s:4:"exmo";}i:532;a:4:{s:5:"title";s:19:"MNX-USD (buy_price)";s:6:"course";s:10:"2.28898431";s:4:"code";s:21:"exmo_mnxusd_buy_price";s:4:"birg";s:4:"exmo";}i:533;a:4:{s:5:"title";s:20:"MNX-USD (sell_price)";s:6:"course";s:3:"2.3";s:4:"code";s:22:"exmo_mnxusd_sell_price";s:4:"birg";s:4:"exmo";}i:534;a:4:{s:5:"title";s:20:"MNX-USD (last_trade)";s:6:"course";s:6:"2.2943";s:4:"code";s:22:"exmo_mnxusd_last_trade";s:4:"birg";s:4:"exmo";}i:535;a:4:{s:5:"title";s:14:"MNX-USD (high)";s:6:"course";s:4:"2.35";s:4:"code";s:16:"exmo_mnxusd_high";s:4:"birg";s:4:"exmo";}i:536;a:4:{s:5:"title";s:13:"MNX-USD (low)";s:6:"course";s:4:"2.12";s:4:"code";s:15:"exmo_mnxusd_low";s:4:"birg";s:4:"exmo";}i:537;a:4:{s:5:"title";s:13:"MNX-USD (avg)";s:6:"course";s:10:"2.24122587";s:4:"code";s:15:"exmo_mnxusd_avg";s:4:"birg";s:4:"exmo";}i:538;a:4:{s:5:"title";s:19:"OMG-BTC (buy_price)";s:6:"course";s:10:"0.00049931";s:4:"code";s:21:"exmo_omgbtc_buy_price";s:4:"birg";s:4:"exmo";}i:539;a:4:{s:5:"title";s:20:"OMG-BTC (sell_price)";s:6:"course";s:10:"0.00050187";s:4:"code";s:22:"exmo_omgbtc_sell_price";s:4:"birg";s:4:"exmo";}i:540;a:4:{s:5:"title";s:20:"OMG-BTC (last_trade)";s:6:"course";s:10:"0.00050169";s:4:"code";s:22:"exmo_omgbtc_last_trade";s:4:"birg";s:4:"exmo";}i:541;a:4:{s:5:"title";s:14:"OMG-BTC (high)";s:6:"course";s:10:"0.00051515";s:4:"code";s:16:"exmo_omgbtc_high";s:4:"birg";s:4:"exmo";}i:542;a:4:{s:5:"title";s:13:"OMG-BTC (low)";s:6:"course";s:10:"0.00049931";s:4:"code";s:15:"exmo_omgbtc_low";s:4:"birg";s:4:"exmo";}i:543;a:4:{s:5:"title";s:13:"OMG-BTC (avg)";s:6:"course";s:10:"0.00050979";s:4:"code";s:15:"exmo_omgbtc_avg";s:4:"birg";s:4:"exmo";}i:544;a:4:{s:5:"title";s:19:"OMG-ETH (buy_price)";s:6:"course";s:5:"0.016";s:4:"code";s:21:"exmo_omgeth_buy_price";s:4:"birg";s:4:"exmo";}i:545;a:4:{s:5:"title";s:20:"OMG-ETH (sell_price)";s:6:"course";s:10:"0.01607995";s:4:"code";s:22:"exmo_omgeth_sell_price";s:4:"birg";s:4:"exmo";}i:546;a:4:{s:5:"title";s:20:"OMG-ETH (last_trade)";s:6:"course";s:7:"0.01616";s:4:"code";s:22:"exmo_omgeth_last_trade";s:4:"birg";s:4:"exmo";}i:547;a:4:{s:5:"title";s:14:"OMG-ETH (high)";s:6:"course";s:8:"0.016501";s:4:"code";s:16:"exmo_omgeth_high";s:4:"birg";s:4:"exmo";}i:548;a:4:{s:5:"title";s:13:"OMG-ETH (low)";s:6:"course";s:7:"0.01616";s:4:"code";s:15:"exmo_omgeth_low";s:4:"birg";s:4:"exmo";}i:549;a:4:{s:5:"title";s:13:"OMG-ETH (avg)";s:6:"course";s:10:"0.01632303";s:4:"code";s:15:"exmo_omgeth_avg";s:4:"birg";s:4:"exmo";}i:550;a:4:{s:5:"title";s:19:"OMG-USD (buy_price)";s:6:"course";s:10:"3.26106806";s:4:"code";s:21:"exmo_omgusd_buy_price";s:4:"birg";s:4:"exmo";}i:551;a:4:{s:5:"title";s:20:"OMG-USD (sell_price)";s:6:"course";s:10:"3.31555985";s:4:"code";s:22:"exmo_omgusd_sell_price";s:4:"birg";s:4:"exmo";}i:552;a:4:{s:5:"title";s:20:"OMG-USD (last_trade)";s:6:"course";s:7:"3.32535";s:4:"code";s:22:"exmo_omgusd_last_trade";s:4:"birg";s:4:"exmo";}i:553;a:4:{s:5:"title";s:14:"OMG-USD (high)";s:6:"course";s:6:"3.4293";s:4:"code";s:16:"exmo_omgusd_high";s:4:"birg";s:4:"exmo";}i:554;a:4:{s:5:"title";s:13:"OMG-USD (low)";s:6:"course";s:10:"3.26062376";s:4:"code";s:15:"exmo_omgusd_low";s:4:"birg";s:4:"exmo";}i:555;a:4:{s:5:"title";s:13:"OMG-USD (avg)";s:6:"course";s:10:"3.36247103";s:4:"code";s:15:"exmo_omgusd_avg";s:4:"birg";s:4:"exmo";}i:556;a:4:{s:5:"title";s:19:"XLM-BTC (buy_price)";s:6:"course";s:10:"0.00003615";s:4:"code";s:21:"exmo_xlmbtc_buy_price";s:4:"birg";s:4:"exmo";}i:557;a:4:{s:5:"title";s:20:"XLM-BTC (sell_price)";s:6:"course";s:9:"0.0000363";s:4:"code";s:22:"exmo_xlmbtc_sell_price";s:4:"birg";s:4:"exmo";}i:558;a:4:{s:5:"title";s:20:"XLM-BTC (last_trade)";s:6:"course";s:10:"0.00003621";s:4:"code";s:22:"exmo_xlmbtc_last_trade";s:4:"birg";s:4:"exmo";}i:559;a:4:{s:5:"title";s:14:"XLM-BTC (high)";s:6:"course";s:10:"0.00003655";s:4:"code";s:16:"exmo_xlmbtc_high";s:4:"birg";s:4:"exmo";}i:560;a:4:{s:5:"title";s:13:"XLM-BTC (low)";s:6:"course";s:8:"0.000036";s:4:"code";s:15:"exmo_xlmbtc_low";s:4:"birg";s:4:"exmo";}i:561;a:4:{s:5:"title";s:13:"XLM-BTC (avg)";s:6:"course";s:10:"0.00003624";s:4:"code";s:15:"exmo_xlmbtc_avg";s:4:"birg";s:4:"exmo";}i:562;a:4:{s:5:"title";s:19:"XLM-USD (buy_price)";s:6:"course";s:10:"0.23850238";s:4:"code";s:21:"exmo_xlmusd_buy_price";s:4:"birg";s:4:"exmo";}i:563;a:4:{s:5:"title";s:20:"XLM-USD (sell_price)";s:6:"course";s:10:"0.23906091";s:4:"code";s:22:"exmo_xlmusd_sell_price";s:4:"birg";s:4:"exmo";}i:564;a:4:{s:5:"title";s:20:"XLM-USD (last_trade)";s:6:"course";s:6:"0.2385";s:4:"code";s:22:"exmo_xlmusd_last_trade";s:4:"birg";s:4:"exmo";}i:565;a:4:{s:5:"title";s:14:"XLM-USD (high)";s:6:"course";s:6:"0.2511";s:4:"code";s:16:"exmo_xlmusd_high";s:4:"birg";s:4:"exmo";}i:566;a:4:{s:5:"title";s:13:"XLM-USD (low)";s:6:"course";s:5:"0.236";s:4:"code";s:15:"exmo_xlmusd_low";s:4:"birg";s:4:"exmo";}i:567;a:4:{s:5:"title";s:13:"XLM-USD (avg)";s:6:"course";s:8:"0.240293";s:4:"code";s:15:"exmo_xlmusd_avg";s:4:"birg";s:4:"exmo";}i:568;a:4:{s:5:"title";s:19:"XLM-RUB (buy_price)";s:6:"course";s:11:"15.58439144";s:4:"code";s:21:"exmo_xlmrub_buy_price";s:4:"birg";s:4:"exmo";}i:569;a:4:{s:5:"title";s:20:"XLM-RUB (sell_price)";s:6:"course";s:10:"15.6624108";s:4:"code";s:22:"exmo_xlmrub_sell_price";s:4:"birg";s:4:"exmo";}i:570;a:4:{s:5:"title";s:20:"XLM-RUB (last_trade)";s:6:"course";s:6:"15.646";s:4:"code";s:22:"exmo_xlmrub_last_trade";s:4:"birg";s:4:"exmo";}i:571;a:4:{s:5:"title";s:14:"XLM-RUB (high)";s:6:"course";s:6:"15.875";s:4:"code";s:16:"exmo_xlmrub_high";s:4:"birg";s:4:"exmo";}i:572;a:4:{s:5:"title";s:13:"XLM-RUB (low)";s:6:"course";s:4:"15.5";s:4:"code";s:15:"exmo_xlmrub_low";s:4:"birg";s:4:"exmo";}i:573;a:4:{s:5:"title";s:13:"XLM-RUB (avg)";s:6:"course";s:11:"15.72345251";s:4:"code";s:15:"exmo_xlmrub_avg";s:4:"birg";s:4:"exmo";}i:574;a:4:{s:5:"title";s:19:"EOS-BTC (buy_price)";s:6:"course";s:10:"0.00082827";s:4:"code";s:21:"exmo_eosbtc_buy_price";s:4:"birg";s:4:"exmo";}i:575;a:4:{s:5:"title";s:20:"EOS-BTC (sell_price)";s:6:"course";s:10:"0.00083166";s:4:"code";s:22:"exmo_eosbtc_sell_price";s:4:"birg";s:4:"exmo";}i:576;a:4:{s:5:"title";s:20:"EOS-BTC (last_trade)";s:6:"course";s:10:"0.00083001";s:4:"code";s:22:"exmo_eosbtc_last_trade";s:4:"birg";s:4:"exmo";}i:577;a:4:{s:5:"title";s:14:"EOS-BTC (high)";s:6:"course";s:10:"0.00083583";s:4:"code";s:16:"exmo_eosbtc_high";s:4:"birg";s:4:"exmo";}i:578;a:4:{s:5:"title";s:13:"EOS-BTC (low)";s:6:"course";s:10:"0.00081365";s:4:"code";s:15:"exmo_eosbtc_low";s:4:"birg";s:4:"exmo";}i:579;a:4:{s:5:"title";s:13:"EOS-BTC (avg)";s:6:"course";s:10:"0.00082896";s:4:"code";s:15:"exmo_eosbtc_avg";s:4:"birg";s:4:"exmo";}i:580;a:4:{s:5:"title";s:19:"EOS-USD (buy_price)";s:6:"course";s:10:"5.43552541";s:4:"code";s:21:"exmo_eosusd_buy_price";s:4:"birg";s:4:"exmo";}i:581;a:4:{s:5:"title";s:20:"EOS-USD (sell_price)";s:6:"course";s:8:"5.465009";s:4:"code";s:22:"exmo_eosusd_sell_price";s:4:"birg";s:4:"exmo";}i:582;a:4:{s:5:"title";s:20:"EOS-USD (last_trade)";s:6:"course";s:7:"5.45978";s:4:"code";s:22:"exmo_eosusd_last_trade";s:4:"birg";s:4:"exmo";}i:583;a:4:{s:5:"title";s:14:"EOS-USD (high)";s:6:"course";s:10:"5.50952724";s:4:"code";s:16:"exmo_eosusd_high";s:4:"birg";s:4:"exmo";}i:584;a:4:{s:5:"title";s:13:"EOS-USD (low)";s:6:"course";s:10:"5.40010006";s:4:"code";s:15:"exmo_eosusd_low";s:4:"birg";s:4:"exmo";}i:585;a:4:{s:5:"title";s:13:"EOS-USD (avg)";s:6:"course";s:9:"5.4708952";s:4:"code";s:15:"exmo_eosusd_avg";s:4:"birg";s:4:"exmo";}i:586;a:4:{s:5:"title";s:19:"STQ-BTC (buy_price)";s:6:"course";s:10:"0.00000036";s:4:"code";s:21:"exmo_stqbtc_buy_price";s:4:"birg";s:4:"exmo";}i:587;a:4:{s:5:"title";s:20:"STQ-BTC (sell_price)";s:6:"course";s:10:"0.00000037";s:4:"code";s:22:"exmo_stqbtc_sell_price";s:4:"birg";s:4:"exmo";}i:588;a:4:{s:5:"title";s:20:"STQ-BTC (last_trade)";s:6:"course";s:10:"0.00000036";s:4:"code";s:22:"exmo_stqbtc_last_trade";s:4:"birg";s:4:"exmo";}i:589;a:4:{s:5:"title";s:14:"STQ-BTC (high)";s:6:"course";s:10:"0.00000037";s:4:"code";s:16:"exmo_stqbtc_high";s:4:"birg";s:4:"exmo";}i:590;a:4:{s:5:"title";s:13:"STQ-BTC (low)";s:6:"course";s:10:"0.00000035";s:4:"code";s:15:"exmo_stqbtc_low";s:4:"birg";s:4:"exmo";}i:591;a:4:{s:5:"title";s:13:"STQ-BTC (avg)";s:6:"course";s:10:"0.00000035";s:4:"code";s:15:"exmo_stqbtc_avg";s:4:"birg";s:4:"exmo";}i:592;a:4:{s:5:"title";s:19:"STQ-USD (buy_price)";s:6:"course";s:10:"0.00237638";s:4:"code";s:21:"exmo_stqusd_buy_price";s:4:"birg";s:4:"exmo";}i:593;a:4:{s:5:"title";s:20:"STQ-USD (sell_price)";s:6:"course";s:10:"0.00238807";s:4:"code";s:22:"exmo_stqusd_sell_price";s:4:"birg";s:4:"exmo";}i:594;a:4:{s:5:"title";s:20:"STQ-USD (last_trade)";s:6:"course";s:9:"0.0023827";s:4:"code";s:22:"exmo_stqusd_last_trade";s:4:"birg";s:4:"exmo";}i:595;a:4:{s:5:"title";s:14:"STQ-USD (high)";s:6:"course";s:10:"0.00241997";s:4:"code";s:16:"exmo_stqusd_high";s:4:"birg";s:4:"exmo";}i:596;a:4:{s:5:"title";s:13:"STQ-USD (low)";s:6:"course";s:7:"0.00234";s:4:"code";s:15:"exmo_stqusd_low";s:4:"birg";s:4:"exmo";}i:597;a:4:{s:5:"title";s:13:"STQ-USD (avg)";s:6:"course";s:10:"0.00237351";s:4:"code";s:15:"exmo_stqusd_avg";s:4:"birg";s:4:"exmo";}i:598;a:4:{s:5:"title";s:19:"STQ-EUR (buy_price)";s:6:"course";s:10:"0.00204025";s:4:"code";s:21:"exmo_stqeur_buy_price";s:4:"birg";s:4:"exmo";}i:599;a:4:{s:5:"title";s:20:"STQ-EUR (sell_price)";s:6:"course";s:7:"0.00211";s:4:"code";s:22:"exmo_stqeur_sell_price";s:4:"birg";s:4:"exmo";}i:600;a:4:{s:5:"title";s:20:"STQ-EUR (last_trade)";s:6:"course";s:10:"0.00205123";s:4:"code";s:22:"exmo_stqeur_last_trade";s:4:"birg";s:4:"exmo";}i:601;a:4:{s:5:"title";s:14:"STQ-EUR (high)";s:6:"course";s:9:"0.0021291";s:4:"code";s:16:"exmo_stqeur_high";s:4:"birg";s:4:"exmo";}i:602;a:4:{s:5:"title";s:13:"STQ-EUR (low)";s:6:"course";s:10:"0.00204578";s:4:"code";s:15:"exmo_stqeur_low";s:4:"birg";s:4:"exmo";}i:603;a:4:{s:5:"title";s:13:"STQ-EUR (avg)";s:6:"course";s:10:"0.00207797";s:4:"code";s:15:"exmo_stqeur_avg";s:4:"birg";s:4:"exmo";}i:604;a:4:{s:5:"title";s:19:"STQ-RUB (buy_price)";s:6:"course";s:5:"0.156";s:4:"code";s:21:"exmo_stqrub_buy_price";s:4:"birg";s:4:"exmo";}i:605;a:4:{s:5:"title";s:20:"STQ-RUB (sell_price)";s:6:"course";s:10:"0.15699996";s:4:"code";s:22:"exmo_stqrub_sell_price";s:4:"birg";s:4:"exmo";}i:606;a:4:{s:5:"title";s:20:"STQ-RUB (last_trade)";s:6:"course";s:8:"0.156176";s:4:"code";s:22:"exmo_stqrub_last_trade";s:4:"birg";s:4:"exmo";}i:607;a:4:{s:5:"title";s:14:"STQ-RUB (high)";s:6:"course";s:5:"0.158";s:4:"code";s:16:"exmo_stqrub_high";s:4:"birg";s:4:"exmo";}i:608;a:4:{s:5:"title";s:13:"STQ-RUB (low)";s:6:"course";s:4:"0.15";s:4:"code";s:15:"exmo_stqrub_low";s:4:"birg";s:4:"exmo";}i:609;a:4:{s:5:"title";s:13:"STQ-RUB (avg)";s:6:"course";s:10:"0.15557092";s:4:"code";s:15:"exmo_stqrub_avg";s:4:"birg";s:4:"exmo";}i:610;a:4:{s:5:"title";s:19:"BTG-BTC (buy_price)";s:6:"course";s:10:"0.00410435";s:4:"code";s:21:"exmo_btgbtc_buy_price";s:4:"birg";s:4:"exmo";}i:611;a:4:{s:5:"title";s:20:"BTG-BTC (sell_price)";s:6:"course";s:10:"0.00415034";s:4:"code";s:22:"exmo_btgbtc_sell_price";s:4:"birg";s:4:"exmo";}i:612;a:4:{s:5:"title";s:20:"BTG-BTC (last_trade)";s:6:"course";s:10:"0.00411575";s:4:"code";s:22:"exmo_btgbtc_last_trade";s:4:"birg";s:4:"exmo";}i:613;a:4:{s:5:"title";s:14:"BTG-BTC (high)";s:6:"course";s:10:"0.00415405";s:4:"code";s:16:"exmo_btgbtc_high";s:4:"birg";s:4:"exmo";}i:614;a:4:{s:5:"title";s:13:"BTG-BTC (low)";s:6:"course";s:7:"0.00407";s:4:"code";s:15:"exmo_btgbtc_low";s:4:"birg";s:4:"exmo";}i:615;a:4:{s:5:"title";s:13:"BTG-BTC (avg)";s:6:"course";s:10:"0.00412691";s:4:"code";s:15:"exmo_btgbtc_avg";s:4:"birg";s:4:"exmo";}i:616;a:4:{s:5:"title";s:19:"BTG-USD (buy_price)";s:6:"course";s:4:"27.1";s:4:"code";s:21:"exmo_btgusd_buy_price";s:4:"birg";s:4:"exmo";}i:617;a:4:{s:5:"title";s:20:"BTG-USD (sell_price)";s:6:"course";s:11:"27.24986279";s:4:"code";s:22:"exmo_btgusd_sell_price";s:4:"birg";s:4:"exmo";}i:618;a:4:{s:5:"title";s:20:"BTG-USD (last_trade)";s:6:"course";s:6:"27.117";s:4:"code";s:22:"exmo_btgusd_last_trade";s:4:"birg";s:4:"exmo";}i:619;a:4:{s:5:"title";s:14:"BTG-USD (high)";s:6:"course";s:4:"27.4";s:4:"code";s:16:"exmo_btgusd_high";s:4:"birg";s:4:"exmo";}i:620;a:4:{s:5:"title";s:13:"BTG-USD (low)";s:6:"course";s:11:"27.08550196";s:4:"code";s:15:"exmo_btgusd_low";s:4:"birg";s:4:"exmo";}i:621;a:4:{s:5:"title";s:13:"BTG-USD (avg)";s:6:"course";s:11:"27.19478163";s:4:"code";s:15:"exmo_btgusd_avg";s:4:"birg";s:4:"exmo";}i:622;a:4:{s:5:"title";s:19:"HBZ-BTC (buy_price)";s:6:"course";s:10:"0.00000041";s:4:"code";s:21:"exmo_hbzbtc_buy_price";s:4:"birg";s:4:"exmo";}i:623;a:4:{s:5:"title";s:20:"HBZ-BTC (sell_price)";s:6:"course";s:10:"0.00000042";s:4:"code";s:22:"exmo_hbzbtc_sell_price";s:4:"birg";s:4:"exmo";}i:624;a:4:{s:5:"title";s:20:"HBZ-BTC (last_trade)";s:6:"course";s:10:"0.00000041";s:4:"code";s:22:"exmo_hbzbtc_last_trade";s:4:"birg";s:4:"exmo";}i:625;a:4:{s:5:"title";s:14:"HBZ-BTC (high)";s:6:"course";s:10:"0.00000043";s:4:"code";s:16:"exmo_hbzbtc_high";s:4:"birg";s:4:"exmo";}i:626;a:4:{s:5:"title";s:13:"HBZ-BTC (low)";s:6:"course";s:9:"0.0000004";s:4:"code";s:15:"exmo_hbzbtc_low";s:4:"birg";s:4:"exmo";}i:627;a:4:{s:5:"title";s:13:"HBZ-BTC (avg)";s:6:"course";s:10:"0.00000041";s:4:"code";s:15:"exmo_hbzbtc_avg";s:4:"birg";s:4:"exmo";}i:628;a:4:{s:5:"title";s:19:"HBZ-ETH (buy_price)";s:6:"course";s:10:"0.00001336";s:4:"code";s:21:"exmo_hbzeth_buy_price";s:4:"birg";s:4:"exmo";}i:629;a:4:{s:5:"title";s:20:"HBZ-ETH (sell_price)";s:6:"course";s:9:"0.0000139";s:4:"code";s:22:"exmo_hbzeth_sell_price";s:4:"birg";s:4:"exmo";}i:630;a:4:{s:5:"title";s:20:"HBZ-ETH (last_trade)";s:6:"course";s:10:"0.00001393";s:4:"code";s:22:"exmo_hbzeth_last_trade";s:4:"birg";s:4:"exmo";}i:631;a:4:{s:5:"title";s:14:"HBZ-ETH (high)";s:6:"course";s:10:"0.00001393";s:4:"code";s:16:"exmo_hbzeth_high";s:4:"birg";s:4:"exmo";}i:632;a:4:{s:5:"title";s:13:"HBZ-ETH (low)";s:6:"course";s:10:"0.00001295";s:4:"code";s:15:"exmo_hbzeth_low";s:4:"birg";s:4:"exmo";}i:633;a:4:{s:5:"title";s:13:"HBZ-ETH (avg)";s:6:"course";s:10:"0.00001336";s:4:"code";s:15:"exmo_hbzeth_avg";s:4:"birg";s:4:"exmo";}i:634;a:4:{s:5:"title";s:19:"HBZ-USD (buy_price)";s:6:"course";s:10:"0.00273667";s:4:"code";s:21:"exmo_hbzusd_buy_price";s:4:"birg";s:4:"exmo";}i:635;a:4:{s:5:"title";s:20:"HBZ-USD (sell_price)";s:6:"course";s:10:"0.00276532";s:4:"code";s:22:"exmo_hbzusd_sell_price";s:4:"birg";s:4:"exmo";}i:636;a:4:{s:5:"title";s:20:"HBZ-USD (last_trade)";s:6:"course";s:10:"0.00276532";s:4:"code";s:22:"exmo_hbzusd_last_trade";s:4:"birg";s:4:"exmo";}i:637;a:4:{s:5:"title";s:14:"HBZ-USD (high)";s:6:"course";s:7:"0.00279";s:4:"code";s:16:"exmo_hbzusd_high";s:4:"birg";s:4:"exmo";}i:638;a:4:{s:5:"title";s:13:"HBZ-USD (low)";s:6:"course";s:10:"0.00265103";s:4:"code";s:15:"exmo_hbzusd_low";s:4:"birg";s:4:"exmo";}i:639;a:4:{s:5:"title";s:13:"HBZ-USD (avg)";s:6:"course";s:10:"0.00270883";s:4:"code";s:15:"exmo_hbzusd_avg";s:4:"birg";s:4:"exmo";}i:640;a:4:{s:5:"title";s:19:"DXT-BTC (buy_price)";s:6:"course";s:10:"0.00000134";s:4:"code";s:21:"exmo_dxtbtc_buy_price";s:4:"birg";s:4:"exmo";}i:641;a:4:{s:5:"title";s:20:"DXT-BTC (sell_price)";s:6:"course";s:10:"0.00000141";s:4:"code";s:22:"exmo_dxtbtc_sell_price";s:4:"birg";s:4:"exmo";}i:642;a:4:{s:5:"title";s:20:"DXT-BTC (last_trade)";s:6:"course";s:10:"0.00000134";s:4:"code";s:22:"exmo_dxtbtc_last_trade";s:4:"birg";s:4:"exmo";}i:643;a:4:{s:5:"title";s:14:"DXT-BTC (high)";s:6:"course";s:10:"0.00000144";s:4:"code";s:16:"exmo_dxtbtc_high";s:4:"birg";s:4:"exmo";}i:644;a:4:{s:5:"title";s:13:"DXT-BTC (low)";s:6:"course";s:9:"0.0000013";s:4:"code";s:15:"exmo_dxtbtc_low";s:4:"birg";s:4:"exmo";}i:645;a:4:{s:5:"title";s:13:"DXT-BTC (avg)";s:6:"course";s:10:"0.00000136";s:4:"code";s:15:"exmo_dxtbtc_avg";s:4:"birg";s:4:"exmo";}i:646;a:4:{s:5:"title";s:19:"DXT-USD (buy_price)";s:6:"course";s:6:"0.0091";s:4:"code";s:21:"exmo_dxtusd_buy_price";s:4:"birg";s:4:"exmo";}i:647;a:4:{s:5:"title";s:20:"DXT-USD (sell_price)";s:6:"course";s:10:"0.00911234";s:4:"code";s:22:"exmo_dxtusd_sell_price";s:4:"birg";s:4:"exmo";}i:648;a:4:{s:5:"title";s:20:"DXT-USD (last_trade)";s:6:"course";s:9:"0.0091055";s:4:"code";s:22:"exmo_dxtusd_last_trade";s:4:"birg";s:4:"exmo";}i:649;a:4:{s:5:"title";s:14:"DXT-USD (high)";s:6:"course";s:9:"0.0093904";s:4:"code";s:16:"exmo_dxtusd_high";s:4:"birg";s:4:"exmo";}i:650;a:4:{s:5:"title";s:13:"DXT-USD (low)";s:6:"course";s:9:"0.0076525";s:4:"code";s:15:"exmo_dxtusd_low";s:4:"birg";s:4:"exmo";}i:651;a:4:{s:5:"title";s:13:"DXT-USD (avg)";s:6:"course";s:10:"0.00908822";s:4:"code";s:15:"exmo_dxtusd_avg";s:4:"birg";s:4:"exmo";}i:652;a:4:{s:5:"title";s:20:"BTCZ-BTC (buy_price)";s:6:"course";s:10:"0.00000008";s:4:"code";s:22:"exmo_btczbtc_buy_price";s:4:"birg";s:4:"exmo";}i:653;a:4:{s:5:"title";s:21:"BTCZ-BTC (sell_price)";s:6:"course";s:10:"0.00000009";s:4:"code";s:23:"exmo_btczbtc_sell_price";s:4:"birg";s:4:"exmo";}i:654;a:4:{s:5:"title";s:21:"BTCZ-BTC (last_trade)";s:6:"course";s:10:"0.00000008";s:4:"code";s:23:"exmo_btczbtc_last_trade";s:4:"birg";s:4:"exmo";}i:655;a:4:{s:5:"title";s:15:"BTCZ-BTC (high)";s:6:"course";s:10:"0.00000009";s:4:"code";s:17:"exmo_btczbtc_high";s:4:"birg";s:4:"exmo";}i:656;a:4:{s:5:"title";s:14:"BTCZ-BTC (low)";s:6:"course";s:10:"0.00000008";s:4:"code";s:16:"exmo_btczbtc_low";s:4:"birg";s:4:"exmo";}i:657;a:4:{s:5:"title";s:14:"BTCZ-BTC (avg)";s:6:"course";s:10:"0.00000008";s:4:"code";s:16:"exmo_btczbtc_avg";s:4:"birg";s:4:"exmo";}i:658;a:4:{s:5:"title";s:19:"BCH-BTC (buy_price)";s:6:"course";s:10:"0.06770706";s:4:"code";s:21:"exmo_bchbtc_buy_price";s:4:"birg";s:4:"exmo";}i:659;a:4:{s:5:"title";s:20:"BCH-BTC (sell_price)";s:6:"course";s:6:"0.0679";s:4:"code";s:22:"exmo_bchbtc_sell_price";s:4:"birg";s:4:"exmo";}i:660;a:4:{s:5:"title";s:20:"BCH-BTC (last_trade)";s:6:"course";s:9:"0.0679046";s:4:"code";s:22:"exmo_bchbtc_last_trade";s:4:"birg";s:4:"exmo";}i:661;a:4:{s:5:"title";s:14:"BCH-BTC (high)";s:6:"course";s:10:"0.06802773";s:4:"code";s:16:"exmo_bchbtc_high";s:4:"birg";s:4:"exmo";}i:662;a:4:{s:5:"title";s:13:"BCH-BTC (low)";s:6:"course";s:10:"0.06748172";s:4:"code";s:15:"exmo_bchbtc_low";s:4:"birg";s:4:"exmo";}i:663;a:4:{s:5:"title";s:13:"BCH-BTC (avg)";s:6:"course";s:10:"0.06775217";s:4:"code";s:15:"exmo_bchbtc_avg";s:4:"birg";s:4:"exmo";}i:664;a:4:{s:5:"title";s:19:"BCH-USD (buy_price)";s:6:"course";s:9:"445.00001";s:4:"code";s:21:"exmo_bchusd_buy_price";s:4:"birg";s:4:"exmo";}i:665;a:4:{s:5:"title";s:20:"BCH-USD (sell_price)";s:6:"course";s:12:"447.09763617";s:4:"code";s:22:"exmo_bchusd_sell_price";s:4:"birg";s:4:"exmo";}i:666;a:4:{s:5:"title";s:20:"BCH-USD (last_trade)";s:6:"course";s:7:"446.403";s:4:"code";s:22:"exmo_bchusd_last_trade";s:4:"birg";s:4:"exmo";}i:667;a:4:{s:5:"title";s:14:"BCH-USD (high)";s:6:"course";s:12:"449.49775215";s:4:"code";s:16:"exmo_bchusd_high";s:4:"birg";s:4:"exmo";}i:668;a:4:{s:5:"title";s:13:"BCH-USD (low)";s:6:"course";s:12:"444.99394486";s:4:"code";s:15:"exmo_bchusd_low";s:4:"birg";s:4:"exmo";}i:669;a:4:{s:5:"title";s:13:"BCH-USD (avg)";s:6:"course";s:12:"447.03391271";s:4:"code";s:15:"exmo_bchusd_avg";s:4:"birg";s:4:"exmo";}i:670;a:4:{s:5:"title";s:19:"BCH-RUB (buy_price)";s:6:"course";s:13:"29187.4984026";s:4:"code";s:21:"exmo_bchrub_buy_price";s:4:"birg";s:4:"exmo";}i:671;a:4:{s:5:"title";s:20:"BCH-RUB (sell_price)";s:6:"course";s:14:"29333.47164771";s:4:"code";s:22:"exmo_bchrub_sell_price";s:4:"birg";s:4:"exmo";}i:672;a:4:{s:5:"title";s:20:"BCH-RUB (last_trade)";s:6:"course";s:5:"29318";s:4:"code";s:22:"exmo_bchrub_last_trade";s:4:"birg";s:4:"exmo";}i:673;a:4:{s:5:"title";s:14:"BCH-RUB (high)";s:6:"course";s:14:"29509.97226439";s:4:"code";s:16:"exmo_bchrub_high";s:4:"birg";s:4:"exmo";}i:674;a:4:{s:5:"title";s:13:"BCH-RUB (low)";s:6:"course";s:14:"29100.00000001";s:4:"code";s:15:"exmo_bchrub_low";s:4:"birg";s:4:"exmo";}i:675;a:4:{s:5:"title";s:13:"BCH-RUB (avg)";s:6:"course";s:14:"29344.30462654";s:4:"code";s:15:"exmo_bchrub_avg";s:4:"birg";s:4:"exmo";}i:676;a:4:{s:5:"title";s:19:"BCH-ETH (buy_price)";s:6:"course";s:7:"2.16568";s:4:"code";s:21:"exmo_bcheth_buy_price";s:4:"birg";s:4:"exmo";}i:677;a:4:{s:5:"title";s:20:"BCH-ETH (sell_price)";s:6:"course";s:10:"2.17304119";s:4:"code";s:22:"exmo_bcheth_sell_price";s:4:"birg";s:4:"exmo";}i:678;a:4:{s:5:"title";s:20:"BCH-ETH (last_trade)";s:6:"course";s:7:"2.16568";s:4:"code";s:22:"exmo_bcheth_last_trade";s:4:"birg";s:4:"exmo";}i:679;a:4:{s:5:"title";s:14:"BCH-ETH (high)";s:6:"course";s:10:"2.18039416";s:4:"code";s:16:"exmo_bcheth_high";s:4:"birg";s:4:"exmo";}i:680;a:4:{s:5:"title";s:13:"BCH-ETH (low)";s:6:"course";s:10:"2.16520255";s:4:"code";s:15:"exmo_bcheth_low";s:4:"birg";s:4:"exmo";}i:681;a:4:{s:5:"title";s:13:"BCH-ETH (avg)";s:6:"course";s:10:"2.16893773";s:4:"code";s:15:"exmo_bcheth_avg";s:4:"birg";s:4:"exmo";}i:682;a:4:{s:5:"title";s:20:"DASH-BTC (buy_price)";s:6:"course";s:10:"0.02384483";s:4:"code";s:22:"exmo_dashbtc_buy_price";s:4:"birg";s:4:"exmo";}i:683;a:4:{s:5:"title";s:21:"DASH-BTC (sell_price)";s:6:"course";s:9:"0.0239403";s:4:"code";s:23:"exmo_dashbtc_sell_price";s:4:"birg";s:4:"exmo";}i:684;a:4:{s:5:"title";s:21:"DASH-BTC (last_trade)";s:6:"course";s:10:"0.02389252";s:4:"code";s:23:"exmo_dashbtc_last_trade";s:4:"birg";s:4:"exmo";}i:685;a:4:{s:5:"title";s:15:"DASH-BTC (high)";s:6:"course";s:10:"0.02416828";s:4:"code";s:17:"exmo_dashbtc_high";s:4:"birg";s:4:"exmo";}i:686;a:4:{s:5:"title";s:14:"DASH-BTC (low)";s:6:"course";s:10:"0.02385594";s:4:"code";s:16:"exmo_dashbtc_low";s:4:"birg";s:4:"exmo";}i:687;a:4:{s:5:"title";s:14:"DASH-BTC (avg)";s:6:"course";s:10:"0.02400829";s:4:"code";s:16:"exmo_dashbtc_avg";s:4:"birg";s:4:"exmo";}i:688;a:4:{s:5:"title";s:20:"DASH-USD (buy_price)";s:6:"course";s:12:"157.14198581";s:4:"code";s:22:"exmo_dashusd_buy_price";s:4:"birg";s:4:"exmo";}i:689;a:4:{s:5:"title";s:21:"DASH-USD (sell_price)";s:6:"course";s:12:"157.61266261";s:4:"code";s:23:"exmo_dashusd_sell_price";s:4:"birg";s:4:"exmo";}i:690;a:4:{s:5:"title";s:21:"DASH-USD (last_trade)";s:6:"course";s:12:"157.61266216";s:4:"code";s:23:"exmo_dashusd_last_trade";s:4:"birg";s:4:"exmo";}i:691;a:4:{s:5:"title";s:15:"DASH-USD (high)";s:6:"course";s:6:"159.09";s:4:"code";s:17:"exmo_dashusd_high";s:4:"birg";s:4:"exmo";}i:692;a:4:{s:5:"title";s:14:"DASH-USD (low)";s:6:"course";s:12:"157.14198581";s:4:"code";s:16:"exmo_dashusd_low";s:4:"birg";s:4:"exmo";}i:693;a:4:{s:5:"title";s:14:"DASH-USD (avg)";s:6:"course";s:12:"158.24969341";s:4:"code";s:16:"exmo_dashusd_avg";s:4:"birg";s:4:"exmo";}i:694;a:4:{s:5:"title";s:20:"DASH-RUB (buy_price)";s:6:"course";s:13:"10302.6411891";s:4:"code";s:22:"exmo_dashrub_buy_price";s:4:"birg";s:4:"exmo";}i:695;a:4:{s:5:"title";s:21:"DASH-RUB (sell_price)";s:6:"course";s:14:"10354.16701511";s:4:"code";s:23:"exmo_dashrub_sell_price";s:4:"birg";s:4:"exmo";}i:696;a:4:{s:5:"title";s:21:"DASH-RUB (last_trade)";s:6:"course";s:5:"10340";s:4:"code";s:23:"exmo_dashrub_last_trade";s:4:"birg";s:4:"exmo";}i:697;a:4:{s:5:"title";s:15:"DASH-RUB (high)";s:6:"course";s:5:"10433";s:4:"code";s:17:"exmo_dashrub_high";s:4:"birg";s:4:"exmo";}i:698;a:4:{s:5:"title";s:14:"DASH-RUB (low)";s:6:"course";s:5:"10311";s:4:"code";s:16:"exmo_dashrub_low";s:4:"birg";s:4:"exmo";}i:699;a:4:{s:5:"title";s:14:"DASH-RUB (avg)";s:6:"course";s:14:"10394.83285608";s:4:"code";s:16:"exmo_dashrub_avg";s:4:"birg";s:4:"exmo";}i:700;a:4:{s:5:"title";s:19:"ETH-BTC (buy_price)";s:6:"course";s:10:"0.03122141";s:4:"code";s:21:"exmo_ethbtc_buy_price";s:4:"birg";s:4:"exmo";}i:701;a:4:{s:5:"title";s:20:"ETH-BTC (sell_price)";s:6:"course";s:10:"0.03130692";s:4:"code";s:22:"exmo_ethbtc_sell_price";s:4:"birg";s:4:"exmo";}i:702;a:4:{s:5:"title";s:20:"ETH-BTC (last_trade)";s:6:"course";s:10:"0.03122143";s:4:"code";s:22:"exmo_ethbtc_last_trade";s:4:"birg";s:4:"exmo";}i:703;a:4:{s:5:"title";s:14:"ETH-BTC (high)";s:6:"course";s:10:"0.03142717";s:4:"code";s:16:"exmo_ethbtc_high";s:4:"birg";s:4:"exmo";}i:704;a:4:{s:5:"title";s:13:"ETH-BTC (low)";s:6:"course";s:10:"0.03109228";s:4:"code";s:15:"exmo_ethbtc_low";s:4:"birg";s:4:"exmo";}i:705;a:4:{s:5:"title";s:13:"ETH-BTC (avg)";s:6:"course";s:10:"0.03124338";s:4:"code";s:15:"exmo_ethbtc_avg";s:4:"birg";s:4:"exmo";}i:706;a:4:{s:5:"title";s:19:"ETH-LTC (buy_price)";s:6:"course";s:10:"3.88249413";s:4:"code";s:21:"exmo_ethltc_buy_price";s:4:"birg";s:4:"exmo";}i:707;a:4:{s:5:"title";s:20:"ETH-LTC (sell_price)";s:6:"course";s:10:"3.89689999";s:4:"code";s:22:"exmo_ethltc_sell_price";s:4:"birg";s:4:"exmo";}i:708;a:4:{s:5:"title";s:20:"ETH-LTC (last_trade)";s:6:"course";s:10:"3.88249413";s:4:"code";s:22:"exmo_ethltc_last_trade";s:4:"birg";s:4:"exmo";}i:709;a:4:{s:5:"title";s:14:"ETH-LTC (high)";s:6:"course";s:6:"3.8969";s:4:"code";s:16:"exmo_ethltc_high";s:4:"birg";s:4:"exmo";}i:710;a:4:{s:5:"title";s:13:"ETH-LTC (low)";s:6:"course";s:10:"3.86030358";s:4:"code";s:15:"exmo_ethltc_low";s:4:"birg";s:4:"exmo";}i:711;a:4:{s:5:"title";s:13:"ETH-LTC (avg)";s:6:"course";s:10:"3.88568472";s:4:"code";s:15:"exmo_ethltc_avg";s:4:"birg";s:4:"exmo";}i:712;a:4:{s:5:"title";s:19:"ETH-USD (buy_price)";s:6:"course";s:3:"205";s:4:"code";s:21:"exmo_ethusd_buy_price";s:4:"birg";s:4:"exmo";}i:713;a:4:{s:5:"title";s:20:"ETH-USD (sell_price)";s:6:"course";s:11:"205.7499997";s:4:"code";s:22:"exmo_ethusd_sell_price";s:4:"birg";s:4:"exmo";}i:714;a:4:{s:5:"title";s:20:"ETH-USD (last_trade)";s:6:"course";s:3:"205";s:4:"code";s:22:"exmo_ethusd_last_trade";s:4:"birg";s:4:"exmo";}i:715;a:4:{s:5:"title";s:14:"ETH-USD (high)";s:6:"course";s:12:"206.99992999";s:4:"code";s:16:"exmo_ethusd_high";s:4:"birg";s:4:"exmo";}i:716;a:4:{s:5:"title";s:13:"ETH-USD (low)";s:6:"course";s:3:"205";s:4:"code";s:15:"exmo_ethusd_low";s:4:"birg";s:4:"exmo";}i:717;a:4:{s:5:"title";s:13:"ETH-USD (avg)";s:6:"course";s:12:"206.00489978";s:4:"code";s:15:"exmo_ethusd_avg";s:4:"birg";s:4:"exmo";}i:718;a:4:{s:5:"title";s:19:"ETH-EUR (buy_price)";s:6:"course";s:12:"180.06706882";s:4:"code";s:21:"exmo_etheur_buy_price";s:4:"birg";s:4:"exmo";}i:719;a:4:{s:5:"title";s:20:"ETH-EUR (sell_price)";s:6:"course";s:12:"180.96762407";s:4:"code";s:22:"exmo_etheur_sell_price";s:4:"birg";s:4:"exmo";}i:720;a:4:{s:5:"title";s:20:"ETH-EUR (last_trade)";s:6:"course";s:12:"180.06706882";s:4:"code";s:22:"exmo_etheur_last_trade";s:4:"birg";s:4:"exmo";}i:721;a:4:{s:5:"title";s:14:"ETH-EUR (high)";s:6:"course";s:12:"182.63329532";s:4:"code";s:16:"exmo_etheur_high";s:4:"birg";s:4:"exmo";}i:722;a:4:{s:5:"title";s:13:"ETH-EUR (low)";s:6:"course";s:12:"180.24228539";s:4:"code";s:15:"exmo_etheur_low";s:4:"birg";s:4:"exmo";}i:723;a:4:{s:5:"title";s:13:"ETH-EUR (avg)";s:6:"course";s:11:"181.2829085";s:4:"code";s:15:"exmo_etheur_avg";s:4:"birg";s:4:"exmo";}i:724;a:4:{s:5:"title";s:19:"ETH-RUB (buy_price)";s:6:"course";s:14:"13450.06727137";s:4:"code";s:21:"exmo_ethrub_buy_price";s:4:"birg";s:4:"exmo";}i:725;a:4:{s:5:"title";s:20:"ETH-RUB (sell_price)";s:6:"course";s:5:"13470";s:4:"code";s:22:"exmo_ethrub_sell_price";s:4:"birg";s:4:"exmo";}i:726;a:4:{s:5:"title";s:20:"ETH-RUB (last_trade)";s:6:"course";s:5:"13464";s:4:"code";s:22:"exmo_ethrub_last_trade";s:4:"birg";s:4:"exmo";}i:727;a:4:{s:5:"title";s:14:"ETH-RUB (high)";s:6:"course";s:14:"13638.46898159";s:4:"code";s:16:"exmo_ethrub_high";s:4:"birg";s:4:"exmo";}i:728;a:4:{s:5:"title";s:13:"ETH-RUB (low)";s:6:"course";s:5:"13450";s:4:"code";s:15:"exmo_ethrub_low";s:4:"birg";s:4:"exmo";}i:729;a:4:{s:5:"title";s:13:"ETH-RUB (avg)";s:6:"course";s:14:"13529.37682299";s:4:"code";s:15:"exmo_ethrub_avg";s:4:"birg";s:4:"exmo";}i:730;a:4:{s:5:"title";s:19:"ETH-UAH (buy_price)";s:6:"course";s:4:"5729";s:4:"code";s:21:"exmo_ethuah_buy_price";s:4:"birg";s:4:"exmo";}i:731;a:4:{s:5:"title";s:20:"ETH-UAH (sell_price)";s:6:"course";s:13:"5747.22495484";s:4:"code";s:22:"exmo_ethuah_sell_price";s:4:"birg";s:4:"exmo";}i:732;a:4:{s:5:"title";s:20:"ETH-UAH (last_trade)";s:6:"course";s:4:"5729";s:4:"code";s:22:"exmo_ethuah_last_trade";s:4:"birg";s:4:"exmo";}i:733;a:4:{s:5:"title";s:14:"ETH-UAH (high)";s:6:"course";s:4:"5800";s:4:"code";s:16:"exmo_ethuah_high";s:4:"birg";s:4:"exmo";}i:734;a:4:{s:5:"title";s:13:"ETH-UAH (low)";s:6:"course";s:4:"5008";s:4:"code";s:15:"exmo_ethuah_low";s:4:"birg";s:4:"exmo";}i:735;a:4:{s:5:"title";s:13:"ETH-UAH (avg)";s:6:"course";s:13:"5736.56567538";s:4:"code";s:15:"exmo_ethuah_avg";s:4:"birg";s:4:"exmo";}i:736;a:4:{s:5:"title";s:19:"ETH-PLN (buy_price)";s:6:"course";s:11:"724.2164153";s:4:"code";s:21:"exmo_ethpln_buy_price";s:4:"birg";s:4:"exmo";}i:737;a:4:{s:5:"title";s:20:"ETH-PLN (sell_price)";s:6:"course";s:12:"748.19066076";s:4:"code";s:22:"exmo_ethpln_sell_price";s:4:"birg";s:4:"exmo";}i:738;a:4:{s:5:"title";s:20:"ETH-PLN (last_trade)";s:6:"course";s:6:"735.72";s:4:"code";s:22:"exmo_ethpln_last_trade";s:4:"birg";s:4:"exmo";}i:739;a:4:{s:5:"title";s:14:"ETH-PLN (high)";s:6:"course";s:6:"761.64";s:4:"code";s:16:"exmo_ethpln_high";s:4:"birg";s:4:"exmo";}i:740;a:4:{s:5:"title";s:13:"ETH-PLN (low)";s:6:"course";s:6:"726.43";s:4:"code";s:15:"exmo_ethpln_low";s:4:"birg";s:4:"exmo";}i:741;a:4:{s:5:"title";s:13:"ETH-PLN (avg)";s:6:"course";s:12:"739.96572549";s:4:"code";s:15:"exmo_ethpln_avg";s:4:"birg";s:4:"exmo";}i:742;a:4:{s:5:"title";s:19:"ETC-BTC (buy_price)";s:6:"course";s:10:"0.00148367";s:4:"code";s:21:"exmo_etcbtc_buy_price";s:4:"birg";s:4:"exmo";}i:743;a:4:{s:5:"title";s:20:"ETC-BTC (sell_price)";s:6:"course";s:10:"0.00148709";s:4:"code";s:22:"exmo_etcbtc_sell_price";s:4:"birg";s:4:"exmo";}i:744;a:4:{s:5:"title";s:20:"ETC-BTC (last_trade)";s:6:"course";s:10:"0.00148416";s:4:"code";s:22:"exmo_etcbtc_last_trade";s:4:"birg";s:4:"exmo";}i:745;a:4:{s:5:"title";s:14:"ETC-BTC (high)";s:6:"course";s:10:"0.00149116";s:4:"code";s:16:"exmo_etcbtc_high";s:4:"birg";s:4:"exmo";}i:746;a:4:{s:5:"title";s:13:"ETC-BTC (low)";s:6:"course";s:9:"0.0014789";s:4:"code";s:15:"exmo_etcbtc_low";s:4:"birg";s:4:"exmo";}i:747;a:4:{s:5:"title";s:13:"ETC-BTC (avg)";s:6:"course";s:10:"0.00148493";s:4:"code";s:15:"exmo_etcbtc_avg";s:4:"birg";s:4:"exmo";}i:748;a:4:{s:5:"title";s:19:"ETC-USD (buy_price)";s:6:"course";s:10:"9.76122222";s:4:"code";s:21:"exmo_etcusd_buy_price";s:4:"birg";s:4:"exmo";}i:749;a:4:{s:5:"title";s:20:"ETC-USD (sell_price)";s:6:"course";s:3:"9.8";s:4:"code";s:22:"exmo_etcusd_sell_price";s:4:"birg";s:4:"exmo";}i:750;a:4:{s:5:"title";s:20:"ETC-USD (last_trade)";s:6:"course";s:3:"9.8";s:4:"code";s:22:"exmo_etcusd_last_trade";s:4:"birg";s:4:"exmo";}i:751;a:4:{s:5:"title";s:14:"ETC-USD (high)";s:6:"course";s:10:"9.85999999";s:4:"code";s:16:"exmo_etcusd_high";s:4:"birg";s:4:"exmo";}i:752;a:4:{s:5:"title";s:13:"ETC-USD (low)";s:6:"course";s:5:"9.751";s:4:"code";s:15:"exmo_etcusd_low";s:4:"birg";s:4:"exmo";}i:753;a:4:{s:5:"title";s:13:"ETC-USD (avg)";s:6:"course";s:10:"9.79952175";s:4:"code";s:15:"exmo_etcusd_avg";s:4:"birg";s:4:"exmo";}i:754;a:4:{s:5:"title";s:19:"ETC-RUB (buy_price)";s:6:"course";s:11:"635.8548391";s:4:"code";s:21:"exmo_etcrub_buy_price";s:4:"birg";s:4:"exmo";}i:755;a:4:{s:5:"title";s:20:"ETC-RUB (sell_price)";s:6:"course";s:12:"640.97756408";s:4:"code";s:22:"exmo_etcrub_sell_price";s:4:"birg";s:4:"exmo";}i:756;a:4:{s:5:"title";s:20:"ETC-RUB (last_trade)";s:6:"course";s:12:"635.84848004";s:4:"code";s:22:"exmo_etcrub_last_trade";s:4:"birg";s:4:"exmo";}i:757;a:4:{s:5:"title";s:14:"ETC-RUB (high)";s:6:"course";s:12:"643.99355302";s:4:"code";s:16:"exmo_etcrub_high";s:4:"birg";s:4:"exmo";}i:758;a:4:{s:5:"title";s:13:"ETC-RUB (low)";s:6:"course";s:12:"635.76581157";s:4:"code";s:15:"exmo_etcrub_low";s:4:"birg";s:4:"exmo";}i:759;a:4:{s:5:"title";s:13:"ETC-RUB (avg)";s:6:"course";s:12:"641.29250671";s:4:"code";s:15:"exmo_etcrub_avg";s:4:"birg";s:4:"exmo";}i:760;a:4:{s:5:"title";s:19:"LTC-BTC (buy_price)";s:6:"course";s:7:"0.00802";s:4:"code";s:21:"exmo_ltcbtc_buy_price";s:4:"birg";s:4:"exmo";}i:761;a:4:{s:5:"title";s:20:"LTC-BTC (sell_price)";s:6:"course";s:10:"0.00803225";s:4:"code";s:22:"exmo_ltcbtc_sell_price";s:4:"birg";s:4:"exmo";}i:762;a:4:{s:5:"title";s:20:"LTC-BTC (last_trade)";s:6:"course";s:10:"0.00803443";s:4:"code";s:22:"exmo_ltcbtc_last_trade";s:4:"birg";s:4:"exmo";}i:763;a:4:{s:5:"title";s:14:"LTC-BTC (high)";s:6:"course";s:6:"0.0081";s:4:"code";s:16:"exmo_ltcbtc_high";s:4:"birg";s:4:"exmo";}i:764;a:4:{s:5:"title";s:13:"LTC-BTC (low)";s:6:"course";s:10:"0.00800746";s:4:"code";s:15:"exmo_ltcbtc_low";s:4:"birg";s:4:"exmo";}i:765;a:4:{s:5:"title";s:13:"LTC-BTC (avg)";s:6:"course";s:10:"0.00803806";s:4:"code";s:15:"exmo_ltcbtc_avg";s:4:"birg";s:4:"exmo";}i:766;a:4:{s:5:"title";s:19:"LTC-USD (buy_price)";s:6:"course";s:11:"52.65189246";s:4:"code";s:21:"exmo_ltcusd_buy_price";s:4:"birg";s:4:"exmo";}i:767;a:4:{s:5:"title";s:20:"LTC-USD (sell_price)";s:6:"course";s:10:"52.8897148";s:4:"code";s:22:"exmo_ltcusd_sell_price";s:4:"birg";s:4:"exmo";}i:768;a:4:{s:5:"title";s:20:"LTC-USD (last_trade)";s:6:"course";s:11:"52.89447931";s:4:"code";s:22:"exmo_ltcusd_last_trade";s:4:"birg";s:4:"exmo";}i:769;a:4:{s:5:"title";s:14:"LTC-USD (high)";s:6:"course";s:11:"53.34717192";s:4:"code";s:16:"exmo_ltcusd_high";s:4:"birg";s:4:"exmo";}i:770;a:4:{s:5:"title";s:13:"LTC-USD (low)";s:6:"course";s:11:"52.40000001";s:4:"code";s:15:"exmo_ltcusd_low";s:4:"birg";s:4:"exmo";}i:771;a:4:{s:5:"title";s:13:"LTC-USD (avg)";s:6:"course";s:11:"53.00318687";s:4:"code";s:15:"exmo_ltcusd_avg";s:4:"birg";s:4:"exmo";}i:772;a:4:{s:5:"title";s:19:"LTC-EUR (buy_price)";s:6:"course";s:11:"46.23589506";s:4:"code";s:21:"exmo_ltceur_buy_price";s:4:"birg";s:4:"exmo";}i:773;a:4:{s:5:"title";s:20:"LTC-EUR (sell_price)";s:6:"course";s:11:"46.45963335";s:4:"code";s:22:"exmo_ltceur_sell_price";s:4:"birg";s:4:"exmo";}i:774;a:4:{s:5:"title";s:20:"LTC-EUR (last_trade)";s:6:"course";s:6:"46.269";s:4:"code";s:22:"exmo_ltceur_last_trade";s:4:"birg";s:4:"exmo";}i:775;a:4:{s:5:"title";s:14:"LTC-EUR (high)";s:6:"course";s:4:"46.8";s:4:"code";s:16:"exmo_ltceur_high";s:4:"birg";s:4:"exmo";}i:776;a:4:{s:5:"title";s:13:"LTC-EUR (low)";s:6:"course";s:6:"46.269";s:4:"code";s:15:"exmo_ltceur_low";s:4:"birg";s:4:"exmo";}i:777;a:4:{s:5:"title";s:13:"LTC-EUR (avg)";s:6:"course";s:11:"46.60990339";s:4:"code";s:15:"exmo_ltceur_avg";s:4:"birg";s:4:"exmo";}i:778;a:4:{s:5:"title";s:19:"LTC-RUB (buy_price)";s:6:"course";s:13:"3463.91888779";s:4:"code";s:21:"exmo_ltcrub_buy_price";s:4:"birg";s:4:"exmo";}i:779;a:4:{s:5:"title";s:20:"LTC-RUB (sell_price)";s:6:"course";s:13:"3469.97917974";s:4:"code";s:22:"exmo_ltcrub_sell_price";s:4:"birg";s:4:"exmo";}i:780;a:4:{s:5:"title";s:20:"LTC-RUB (last_trade)";s:6:"course";s:13:"3469.97917999";s:4:"code";s:22:"exmo_ltcrub_last_trade";s:4:"birg";s:4:"exmo";}i:781;a:4:{s:5:"title";s:14:"LTC-RUB (high)";s:6:"course";s:13:"3519.66141842";s:4:"code";s:16:"exmo_ltcrub_high";s:4:"birg";s:4:"exmo";}i:782;a:4:{s:5:"title";s:13:"LTC-RUB (low)";s:6:"course";s:13:"3458.01729029";s:4:"code";s:15:"exmo_ltcrub_low";s:4:"birg";s:4:"exmo";}i:783;a:4:{s:5:"title";s:13:"LTC-RUB (avg)";s:6:"course";s:13:"3482.67996729";s:4:"code";s:15:"exmo_ltcrub_avg";s:4:"birg";s:4:"exmo";}i:784;a:4:{s:5:"title";s:19:"ZEC-BTC (buy_price)";s:6:"course";s:7:"0.01865";s:4:"code";s:21:"exmo_zecbtc_buy_price";s:4:"birg";s:4:"exmo";}i:785;a:4:{s:5:"title";s:20:"ZEC-BTC (sell_price)";s:6:"course";s:10:"0.01868178";s:4:"code";s:22:"exmo_zecbtc_sell_price";s:4:"birg";s:4:"exmo";}i:786;a:4:{s:5:"title";s:20:"ZEC-BTC (last_trade)";s:6:"course";s:7:"0.01868";s:4:"code";s:22:"exmo_zecbtc_last_trade";s:4:"birg";s:4:"exmo";}i:787;a:4:{s:5:"title";s:14:"ZEC-BTC (high)";s:6:"course";s:10:"0.01888758";s:4:"code";s:16:"exmo_zecbtc_high";s:4:"birg";s:4:"exmo";}i:788;a:4:{s:5:"title";s:13:"ZEC-BTC (low)";s:6:"course";s:10:"0.01849315";s:4:"code";s:15:"exmo_zecbtc_low";s:4:"birg";s:4:"exmo";}i:789;a:4:{s:5:"title";s:13:"ZEC-BTC (avg)";s:6:"course";s:10:"0.01868945";s:4:"code";s:15:"exmo_zecbtc_avg";s:4:"birg";s:4:"exmo";}i:790;a:4:{s:5:"title";s:19:"ZEC-USD (buy_price)";s:6:"course";s:12:"122.77589722";s:4:"code";s:21:"exmo_zecusd_buy_price";s:4:"birg";s:4:"exmo";}i:791;a:4:{s:5:"title";s:20:"ZEC-USD (sell_price)";s:6:"course";s:12:"123.16849925";s:4:"code";s:22:"exmo_zecusd_sell_price";s:4:"birg";s:4:"exmo";}i:792;a:4:{s:5:"title";s:20:"ZEC-USD (last_trade)";s:6:"course";s:12:"123.16726726";s:4:"code";s:22:"exmo_zecusd_last_trade";s:4:"birg";s:4:"exmo";}i:793;a:4:{s:5:"title";s:14:"ZEC-USD (high)";s:6:"course";s:12:"127.99583892";s:4:"code";s:16:"exmo_zecusd_high";s:4:"birg";s:4:"exmo";}i:794;a:4:{s:5:"title";s:13:"ZEC-USD (low)";s:6:"course";s:9:"121.98111";s:4:"code";s:15:"exmo_zecusd_low";s:4:"birg";s:4:"exmo";}i:795;a:4:{s:5:"title";s:13:"ZEC-USD (avg)";s:6:"course";s:12:"123.61575448";s:4:"code";s:15:"exmo_zecusd_avg";s:4:"birg";s:4:"exmo";}i:796;a:4:{s:5:"title";s:19:"ZEC-EUR (buy_price)";s:6:"course";s:12:"107.39530707";s:4:"code";s:21:"exmo_zeceur_buy_price";s:4:"birg";s:4:"exmo";}i:797;a:4:{s:5:"title";s:20:"ZEC-EUR (sell_price)";s:6:"course";s:12:"107.83006029";s:4:"code";s:22:"exmo_zeceur_sell_price";s:4:"birg";s:4:"exmo";}i:798;a:4:{s:5:"title";s:20:"ZEC-EUR (last_trade)";s:6:"course";s:12:"107.39530726";s:4:"code";s:22:"exmo_zeceur_last_trade";s:4:"birg";s:4:"exmo";}i:799;a:4:{s:5:"title";s:14:"ZEC-EUR (high)";s:6:"course";s:12:"109.54875838";s:4:"code";s:16:"exmo_zeceur_high";s:4:"birg";s:4:"exmo";}i:800;a:4:{s:5:"title";s:13:"ZEC-EUR (low)";s:6:"course";s:12:"107.39476999";s:4:"code";s:15:"exmo_zeceur_low";s:4:"birg";s:4:"exmo";}i:801;a:4:{s:5:"title";s:13:"ZEC-EUR (avg)";s:6:"course";s:12:"108.32308324";s:4:"code";s:15:"exmo_zeceur_avg";s:4:"birg";s:4:"exmo";}i:802;a:4:{s:5:"title";s:19:"ZEC-RUB (buy_price)";s:6:"course";s:13:"8042.73848142";s:4:"code";s:21:"exmo_zecrub_buy_price";s:4:"birg";s:4:"exmo";}i:803;a:4:{s:5:"title";s:20:"ZEC-RUB (sell_price)";s:6:"course";s:13:"8078.87766054";s:4:"code";s:22:"exmo_zecrub_sell_price";s:4:"birg";s:4:"exmo";}i:804;a:4:{s:5:"title";s:20:"ZEC-RUB (last_trade)";s:6:"course";s:7:"8073.83";s:4:"code";s:22:"exmo_zecrub_last_trade";s:4:"birg";s:4:"exmo";}i:805;a:4:{s:5:"title";s:14:"ZEC-RUB (high)";s:6:"course";s:13:"8192.99999999";s:4:"code";s:16:"exmo_zecrub_high";s:4:"birg";s:4:"exmo";}i:806;a:4:{s:5:"title";s:13:"ZEC-RUB (low)";s:6:"course";s:12:"7993.9293409";s:4:"code";s:15:"exmo_zecrub_low";s:4:"birg";s:4:"exmo";}i:807;a:4:{s:5:"title";s:13:"ZEC-RUB (avg)";s:6:"course";s:13:"8100.39474858";s:4:"code";s:15:"exmo_zecrub_avg";s:4:"birg";s:4:"exmo";}i:808;a:4:{s:5:"title";s:19:"XRP-BTC (buy_price)";s:6:"course";s:10:"0.00007071";s:4:"code";s:21:"exmo_xrpbtc_buy_price";s:4:"birg";s:4:"exmo";}i:809;a:4:{s:5:"title";s:20:"XRP-BTC (sell_price)";s:6:"course";s:8:"0.000071";s:4:"code";s:22:"exmo_xrpbtc_sell_price";s:4:"birg";s:4:"exmo";}i:810;a:4:{s:5:"title";s:20:"XRP-BTC (last_trade)";s:6:"course";s:10:"0.00007094";s:4:"code";s:22:"exmo_xrpbtc_last_trade";s:4:"birg";s:4:"exmo";}i:811;a:4:{s:5:"title";s:14:"XRP-BTC (high)";s:6:"course";s:10:"0.00007143";s:4:"code";s:16:"exmo_xrpbtc_high";s:4:"birg";s:4:"exmo";}i:812;a:4:{s:5:"title";s:13:"XRP-BTC (low)";s:6:"course";s:10:"0.00007042";s:4:"code";s:15:"exmo_xrpbtc_low";s:4:"birg";s:4:"exmo";}i:813;a:4:{s:5:"title";s:13:"XRP-BTC (avg)";s:6:"course";s:10:"0.00007095";s:4:"code";s:15:"exmo_xrpbtc_avg";s:4:"birg";s:4:"exmo";}i:814;a:4:{s:5:"title";s:19:"XRP-USD (buy_price)";s:6:"course";s:10:"0.46488654";s:4:"code";s:21:"exmo_xrpusd_buy_price";s:4:"birg";s:4:"exmo";}i:815;a:4:{s:5:"title";s:20:"XRP-USD (sell_price)";s:6:"course";s:10:"0.46694028";s:4:"code";s:22:"exmo_xrpusd_sell_price";s:4:"birg";s:4:"exmo";}i:816;a:4:{s:5:"title";s:20:"XRP-USD (last_trade)";s:6:"course";s:10:"0.46488654";s:4:"code";s:22:"exmo_xrpusd_last_trade";s:4:"birg";s:4:"exmo";}i:817;a:4:{s:5:"title";s:14:"XRP-USD (high)";s:6:"course";s:7:"0.47179";s:4:"code";s:16:"exmo_xrpusd_high";s:4:"birg";s:4:"exmo";}i:818;a:4:{s:5:"title";s:13:"XRP-USD (low)";s:6:"course";s:10:"0.46488608";s:4:"code";s:15:"exmo_xrpusd_low";s:4:"birg";s:4:"exmo";}i:819;a:4:{s:5:"title";s:13:"XRP-USD (avg)";s:6:"course";s:10:"0.46834954";s:4:"code";s:15:"exmo_xrpusd_avg";s:4:"birg";s:4:"exmo";}i:820;a:4:{s:5:"title";s:19:"XRP-RUB (buy_price)";s:6:"course";s:5:"30.43";s:4:"code";s:21:"exmo_xrprub_buy_price";s:4:"birg";s:4:"exmo";}i:821;a:4:{s:5:"title";s:20:"XRP-RUB (sell_price)";s:6:"course";s:10:"30.5398465";s:4:"code";s:22:"exmo_xrprub_sell_price";s:4:"birg";s:4:"exmo";}i:822;a:4:{s:5:"title";s:20:"XRP-RUB (last_trade)";s:6:"course";s:11:"30.44849342";s:4:"code";s:22:"exmo_xrprub_last_trade";s:4:"birg";s:4:"exmo";}i:823;a:4:{s:5:"title";s:14:"XRP-RUB (high)";s:6:"course";s:10:"31.0532929";s:4:"code";s:16:"exmo_xrprub_high";s:4:"birg";s:4:"exmo";}i:824;a:4:{s:5:"title";s:13:"XRP-RUB (low)";s:6:"course";s:11:"30.43000001";s:4:"code";s:15:"exmo_xrprub_low";s:4:"birg";s:4:"exmo";}i:825;a:4:{s:5:"title";s:13:"XRP-RUB (avg)";s:6:"course";s:11:"30.73217973";s:4:"code";s:15:"exmo_xrprub_avg";s:4:"birg";s:4:"exmo";}i:826;a:4:{s:5:"title";s:19:"XMR-BTC (buy_price)";s:6:"course";s:10:"0.01609956";s:4:"code";s:21:"exmo_xmrbtc_buy_price";s:4:"birg";s:4:"exmo";}i:827;a:4:{s:5:"title";s:20:"XMR-BTC (sell_price)";s:6:"course";s:8:"0.016135";s:4:"code";s:22:"exmo_xmrbtc_sell_price";s:4:"birg";s:4:"exmo";}i:828;a:4:{s:5:"title";s:20:"XMR-BTC (last_trade)";s:6:"course";s:8:"0.016116";s:4:"code";s:22:"exmo_xmrbtc_last_trade";s:4:"birg";s:4:"exmo";}i:829;a:4:{s:5:"title";s:14:"XMR-BTC (high)";s:6:"course";s:10:"0.01634995";s:4:"code";s:16:"exmo_xmrbtc_high";s:4:"birg";s:4:"exmo";}i:830;a:4:{s:5:"title";s:13:"XMR-BTC (low)";s:6:"course";s:10:"0.01603739";s:4:"code";s:15:"exmo_xmrbtc_low";s:4:"birg";s:4:"exmo";}i:831;a:4:{s:5:"title";s:13:"XMR-BTC (avg)";s:6:"course";s:10:"0.01618055";s:4:"code";s:15:"exmo_xmrbtc_avg";s:4:"birg";s:4:"exmo";}i:832;a:4:{s:5:"title";s:19:"XMR-USD (buy_price)";s:6:"course";s:12:"105.75052915";s:4:"code";s:21:"exmo_xmrusd_buy_price";s:4:"birg";s:4:"exmo";}i:833;a:4:{s:5:"title";s:20:"XMR-USD (sell_price)";s:6:"course";s:3:"106";s:4:"code";s:22:"exmo_xmrusd_sell_price";s:4:"birg";s:4:"exmo";}i:834;a:4:{s:5:"title";s:20:"XMR-USD (last_trade)";s:6:"course";s:12:"105.75052978";s:4:"code";s:22:"exmo_xmrusd_last_trade";s:4:"birg";s:4:"exmo";}i:835;a:4:{s:5:"title";s:14:"XMR-USD (high)";s:6:"course";s:11:"108.4521705";s:4:"code";s:16:"exmo_xmrusd_high";s:4:"birg";s:4:"exmo";}i:836;a:4:{s:5:"title";s:13:"XMR-USD (low)";s:6:"course";s:6:"105.75";s:4:"code";s:15:"exmo_xmrusd_low";s:4:"birg";s:4:"exmo";}i:837;a:4:{s:5:"title";s:13:"XMR-USD (avg)";s:6:"course";s:12:"106.77821368";s:4:"code";s:15:"exmo_xmrusd_avg";s:4:"birg";s:4:"exmo";}i:838;a:4:{s:5:"title";s:19:"XMR-EUR (buy_price)";s:6:"course";s:11:"92.58520785";s:4:"code";s:21:"exmo_xmreur_buy_price";s:4:"birg";s:4:"exmo";}i:839;a:4:{s:5:"title";s:20:"XMR-EUR (sell_price)";s:6:"course";s:11:"93.04824664";s:4:"code";s:22:"exmo_xmreur_sell_price";s:4:"birg";s:4:"exmo";}i:840;a:4:{s:5:"title";s:20:"XMR-EUR (last_trade)";s:6:"course";s:11:"93.04824664";s:4:"code";s:22:"exmo_xmreur_last_trade";s:4:"birg";s:4:"exmo";}i:841;a:4:{s:5:"title";s:14:"XMR-EUR (high)";s:6:"course";s:6:"95.003";s:4:"code";s:16:"exmo_xmreur_high";s:4:"birg";s:4:"exmo";}i:842;a:4:{s:5:"title";s:13:"XMR-EUR (low)";s:6:"course";s:11:"92.59288454";s:4:"code";s:15:"exmo_xmreur_low";s:4:"birg";s:4:"exmo";}i:843;a:4:{s:5:"title";s:13:"XMR-EUR (avg)";s:6:"course";s:11:"93.59812126";s:4:"code";s:15:"exmo_xmreur_avg";s:4:"birg";s:4:"exmo";}i:844;a:4:{s:5:"title";s:20:"BTC-USDT (buy_price)";s:6:"course";s:13:"6505.28824066";s:4:"code";s:22:"exmo_btcusdt_buy_price";s:4:"birg";s:4:"exmo";}i:845;a:4:{s:5:"title";s:21:"BTC-USDT (sell_price)";s:6:"course";s:13:"6537.85533679";s:4:"code";s:23:"exmo_btcusdt_sell_price";s:4:"birg";s:4:"exmo";}i:846;a:4:{s:5:"title";s:21:"BTC-USDT (last_trade)";s:6:"course";s:6:"6510.8";s:4:"code";s:23:"exmo_btcusdt_last_trade";s:4:"birg";s:4:"exmo";}i:847;a:4:{s:5:"title";s:15:"BTC-USDT (high)";s:6:"course";s:13:"6766.99999997";s:4:"code";s:17:"exmo_btcusdt_high";s:4:"birg";s:4:"exmo";}i:848;a:4:{s:5:"title";s:14:"BTC-USDT (low)";s:6:"course";s:13:"6505.28824066";s:4:"code";s:16:"exmo_btcusdt_low";s:4:"birg";s:4:"exmo";}i:849;a:4:{s:5:"title";s:14:"BTC-USDT (avg)";s:6:"course";s:13:"6571.31000358";s:4:"code";s:16:"exmo_btcusdt_avg";s:4:"birg";s:4:"exmo";}i:850;a:4:{s:5:"title";s:20:"ETH-USDT (buy_price)";s:6:"course";s:12:"203.95107737";s:4:"code";s:22:"exmo_ethusdt_buy_price";s:4:"birg";s:4:"exmo";}i:851;a:4:{s:5:"title";s:21:"ETH-USDT (sell_price)";s:6:"course";s:12:"204.37631941";s:4:"code";s:23:"exmo_ethusdt_sell_price";s:4:"birg";s:4:"exmo";}i:852;a:4:{s:5:"title";s:21:"ETH-USDT (last_trade)";s:6:"course";s:7:"204.087";s:4:"code";s:23:"exmo_ethusdt_last_trade";s:4:"birg";s:4:"exmo";}i:853;a:4:{s:5:"title";s:15:"ETH-USDT (high)";s:6:"course";s:6:"205.43";s:4:"code";s:17:"exmo_ethusdt_high";s:4:"birg";s:4:"exmo";}i:854;a:4:{s:5:"title";s:14:"ETH-USDT (low)";s:6:"course";s:12:"203.95107737";s:4:"code";s:16:"exmo_ethusdt_low";s:4:"birg";s:4:"exmo";}i:855;a:4:{s:5:"title";s:14:"ETH-USDT (avg)";s:6:"course";s:12:"204.82806324";s:4:"code";s:16:"exmo_ethusdt_avg";s:4:"birg";s:4:"exmo";}i:856;a:4:{s:5:"title";s:20:"USDT-USD (buy_price)";s:6:"course";s:10:"1.00400001";s:4:"code";s:22:"exmo_usdtusd_buy_price";s:4:"birg";s:4:"exmo";}i:857;a:4:{s:5:"title";s:21:"USDT-USD (sell_price)";s:6:"course";s:10:"1.00614304";s:4:"code";s:23:"exmo_usdtusd_sell_price";s:4:"birg";s:4:"exmo";}i:858;a:4:{s:5:"title";s:21:"USDT-USD (last_trade)";s:6:"course";s:7:"1.00436";s:4:"code";s:23:"exmo_usdtusd_last_trade";s:4:"birg";s:4:"exmo";}i:859;a:4:{s:5:"title";s:15:"USDT-USD (high)";s:6:"course";s:4:"1.01";s:4:"code";s:17:"exmo_usdtusd_high";s:4:"birg";s:4:"exmo";}i:860;a:4:{s:5:"title";s:14:"USDT-USD (low)";s:6:"course";s:8:"1.000877";s:4:"code";s:16:"exmo_usdtusd_low";s:4:"birg";s:4:"exmo";}i:861;a:4:{s:5:"title";s:14:"USDT-USD (avg)";s:6:"course";s:9:"1.0058819";s:4:"code";s:16:"exmo_usdtusd_avg";s:4:"birg";s:4:"exmo";}i:862;a:4:{s:5:"title";s:20:"USDT-RUB (buy_price)";s:6:"course";s:11:"65.91965919";s:4:"code";s:22:"exmo_usdtrub_buy_price";s:4:"birg";s:4:"exmo";}i:863;a:4:{s:5:"title";s:21:"USDT-RUB (sell_price)";s:6:"course";s:6:"66.185";s:4:"code";s:23:"exmo_usdtrub_sell_price";s:4:"birg";s:4:"exmo";}i:864;a:4:{s:5:"title";s:21:"USDT-RUB (last_trade)";s:6:"course";s:7:"66.1548";s:4:"code";s:23:"exmo_usdtrub_last_trade";s:4:"birg";s:4:"exmo";}i:865;a:4:{s:5:"title";s:15:"USDT-RUB (high)";s:6:"course";s:5:"66.49";s:4:"code";s:17:"exmo_usdtrub_high";s:4:"birg";s:4:"exmo";}i:866;a:4:{s:5:"title";s:14:"USDT-RUB (low)";s:6:"course";s:4:"65.7";s:4:"code";s:16:"exmo_usdtrub_low";s:4:"birg";s:4:"exmo";}i:867;a:4:{s:5:"title";s:14:"USDT-RUB (avg)";s:6:"course";s:11:"66.08608862";s:4:"code";s:16:"exmo_usdtrub_avg";s:4:"birg";s:4:"exmo";}i:868;a:4:{s:5:"title";s:19:"USD-RUB (buy_price)";s:6:"course";s:5:"65.46";s:4:"code";s:21:"exmo_usdrub_buy_price";s:4:"birg";s:4:"exmo";}i:869;a:4:{s:5:"title";s:20:"USD-RUB (sell_price)";s:6:"course";s:11:"65.65009847";s:4:"code";s:22:"exmo_usdrub_sell_price";s:4:"birg";s:4:"exmo";}i:870;a:4:{s:5:"title";s:20:"USD-RUB (last_trade)";s:6:"course";s:10:"65.4539347";s:4:"code";s:22:"exmo_usdrub_last_trade";s:4:"birg";s:4:"exmo";}i:871;a:4:{s:5:"title";s:14:"USD-RUB (high)";s:6:"course";s:5:"65.82";s:4:"code";s:16:"exmo_usdrub_high";s:4:"birg";s:4:"exmo";}i:872;a:4:{s:5:"title";s:13:"USD-RUB (low)";s:6:"course";s:11:"65.45282231";s:4:"code";s:15:"exmo_usdrub_low";s:4:"birg";s:4:"exmo";}i:873;a:4:{s:5:"title";s:13:"USD-RUB (avg)";s:6:"course";s:11:"65.60820508";s:4:"code";s:15:"exmo_usdrub_avg";s:4:"birg";s:4:"exmo";}i:874;a:4:{s:5:"title";s:20:"DOGE-BTC (buy_price)";s:6:"course";s:10:"0.00000064";s:4:"code";s:22:"exmo_dogebtc_buy_price";s:4:"birg";s:4:"exmo";}i:875;a:4:{s:5:"title";s:21:"DOGE-BTC (sell_price)";s:6:"course";s:10:"0.00000065";s:4:"code";s:23:"exmo_dogebtc_sell_price";s:4:"birg";s:4:"exmo";}i:876;a:4:{s:5:"title";s:21:"DOGE-BTC (last_trade)";s:6:"course";s:10:"0.00000065";s:4:"code";s:23:"exmo_dogebtc_last_trade";s:4:"birg";s:4:"exmo";}i:877;a:4:{s:5:"title";s:15:"DOGE-BTC (high)";s:6:"course";s:10:"0.00000067";s:4:"code";s:17:"exmo_dogebtc_high";s:4:"birg";s:4:"exmo";}i:878;a:4:{s:5:"title";s:14:"DOGE-BTC (low)";s:6:"course";s:10:"0.00000059";s:4:"code";s:16:"exmo_dogebtc_low";s:4:"birg";s:4:"exmo";}i:879;a:4:{s:5:"title";s:14:"DOGE-BTC (avg)";s:6:"course";s:10:"0.00000063";s:4:"code";s:16:"exmo_dogebtc_avg";s:4:"birg";s:4:"exmo";}i:880;a:4:{s:5:"title";s:21:"WAVES-BTC (buy_price)";s:6:"course";s:10:"0.00029674";s:4:"code";s:23:"exmo_wavesbtc_buy_price";s:4:"birg";s:4:"exmo";}i:881;a:4:{s:5:"title";s:22:"WAVES-BTC (sell_price)";s:6:"course";s:8:"0.000298";s:4:"code";s:24:"exmo_wavesbtc_sell_price";s:4:"birg";s:4:"exmo";}i:882;a:4:{s:5:"title";s:22:"WAVES-BTC (last_trade)";s:6:"course";s:10:"0.00029673";s:4:"code";s:24:"exmo_wavesbtc_last_trade";s:4:"birg";s:4:"exmo";}i:883;a:4:{s:5:"title";s:16:"WAVES-BTC (high)";s:6:"course";s:9:"0.0003045";s:4:"code";s:18:"exmo_wavesbtc_high";s:4:"birg";s:4:"exmo";}i:884;a:4:{s:5:"title";s:15:"WAVES-BTC (low)";s:6:"course";s:10:"0.00029421";s:4:"code";s:17:"exmo_wavesbtc_low";s:4:"birg";s:4:"exmo";}i:885;a:4:{s:5:"title";s:15:"WAVES-BTC (avg)";s:6:"course";s:10:"0.00029807";s:4:"code";s:17:"exmo_wavesbtc_avg";s:4:"birg";s:4:"exmo";}i:886;a:4:{s:5:"title";s:21:"WAVES-RUB (buy_price)";s:6:"course";s:12:"128.59980139";s:4:"code";s:23:"exmo_wavesrub_buy_price";s:4:"birg";s:4:"exmo";}i:887;a:4:{s:5:"title";s:22:"WAVES-RUB (sell_price)";s:6:"course";s:5:"129.2";s:4:"code";s:24:"exmo_wavesrub_sell_price";s:4:"birg";s:4:"exmo";}i:888;a:4:{s:5:"title";s:22:"WAVES-RUB (last_trade)";s:6:"course";s:6:"128.85";s:4:"code";s:24:"exmo_wavesrub_last_trade";s:4:"birg";s:4:"exmo";}i:889;a:4:{s:5:"title";s:16:"WAVES-RUB (high)";s:6:"course";s:5:"135.5";s:4:"code";s:18:"exmo_wavesrub_high";s:4:"birg";s:4:"exmo";}i:890;a:4:{s:5:"title";s:15:"WAVES-RUB (low)";s:6:"course";s:12:"128.59980139";s:4:"code";s:17:"exmo_wavesrub_low";s:4:"birg";s:4:"exmo";}i:891;a:4:{s:5:"title";s:15:"WAVES-RUB (avg)";s:6:"course";s:12:"130.25443696";s:4:"code";s:17:"exmo_wavesrub_avg";s:4:"birg";s:4:"exmo";}i:892;a:4:{s:5:"title";s:20:"KICK-BTC (buy_price)";s:6:"course";s:10:"0.00000347";s:4:"code";s:22:"exmo_kickbtc_buy_price";s:4:"birg";s:4:"exmo";}i:893;a:4:{s:5:"title";s:21:"KICK-BTC (sell_price)";s:6:"course";s:10:"0.00000349";s:4:"code";s:23:"exmo_kickbtc_sell_price";s:4:"birg";s:4:"exmo";}i:894;a:4:{s:5:"title";s:21:"KICK-BTC (last_trade)";s:6:"course";s:10:"0.00000347";s:4:"code";s:23:"exmo_kickbtc_last_trade";s:4:"birg";s:4:"exmo";}i:895;a:4:{s:5:"title";s:15:"KICK-BTC (high)";s:6:"course";s:10:"0.00000354";s:4:"code";s:17:"exmo_kickbtc_high";s:4:"birg";s:4:"exmo";}i:896;a:4:{s:5:"title";s:14:"KICK-BTC (low)";s:6:"course";s:10:"0.00000347";s:4:"code";s:16:"exmo_kickbtc_low";s:4:"birg";s:4:"exmo";}i:897;a:4:{s:5:"title";s:14:"KICK-BTC (avg)";s:6:"course";s:10:"0.00000349";s:4:"code";s:16:"exmo_kickbtc_avg";s:4:"birg";s:4:"exmo";}i:898;a:4:{s:5:"title";s:20:"KICK-ETH (buy_price)";s:6:"course";s:9:"0.0001106";s:4:"code";s:22:"exmo_kicketh_buy_price";s:4:"birg";s:4:"exmo";}i:899;a:4:{s:5:"title";s:21:"KICK-ETH (sell_price)";s:6:"course";s:10:"0.00011296";s:4:"code";s:23:"exmo_kicketh_sell_price";s:4:"birg";s:4:"exmo";}i:900;a:4:{s:5:"title";s:21:"KICK-ETH (last_trade)";s:6:"course";s:10:"0.00011179";s:4:"code";s:23:"exmo_kicketh_last_trade";s:4:"birg";s:4:"exmo";}i:901;a:4:{s:5:"title";s:15:"KICK-ETH (high)";s:6:"course";s:10:"0.00011398";s:4:"code";s:17:"exmo_kicketh_high";s:4:"birg";s:4:"exmo";}i:902;a:4:{s:5:"title";s:14:"KICK-ETH (low)";s:6:"course";s:9:"0.0001108";s:4:"code";s:16:"exmo_kicketh_low";s:4:"birg";s:4:"exmo";}i:903;a:4:{s:5:"title";s:14:"KICK-ETH (avg)";s:6:"course";s:10:"0.00011225";s:4:"code";s:16:"exmo_kicketh_avg";s:4:"birg";s:4:"exmo";}i:904;a:4:{s:5:"title";s:19:"EOS-EUR (buy_price)";s:6:"course";s:10:"4.77297389";s:4:"code";s:21:"exmo_eoseur_buy_price";s:4:"birg";s:4:"exmo";}i:905;a:4:{s:5:"title";s:20:"EOS-EUR (sell_price)";s:6:"course";s:10:"4.84048752";s:4:"code";s:22:"exmo_eoseur_sell_price";s:4:"birg";s:4:"exmo";}i:906;a:4:{s:5:"title";s:20:"EOS-EUR (last_trade)";s:6:"course";s:7:"4.79883";s:4:"code";s:22:"exmo_eoseur_last_trade";s:4:"birg";s:4:"exmo";}i:907;a:4:{s:5:"title";s:14:"EOS-EUR (high)";s:6:"course";s:7:"4.90879";s:4:"code";s:16:"exmo_eoseur_high";s:4:"birg";s:4:"exmo";}i:908;a:4:{s:5:"title";s:13:"EOS-EUR (low)";s:6:"course";s:7:"4.76649";s:4:"code";s:15:"exmo_eoseur_low";s:4:"birg";s:4:"exmo";}i:909;a:4:{s:5:"title";s:13:"EOS-EUR (avg)";s:6:"course";s:10:"4.81681216";s:4:"code";s:15:"exmo_eoseur_avg";s:4:"birg";s:4:"exmo";}i:910;a:4:{s:5:"title";s:19:"BCH-EUR (buy_price)";s:6:"course";s:3:"392";s:4:"code";s:21:"exmo_bcheur_buy_price";s:4:"birg";s:4:"exmo";}i:911;a:4:{s:5:"title";s:20:"BCH-EUR (sell_price)";s:6:"course";s:9:"393.23706";s:4:"code";s:22:"exmo_bcheur_sell_price";s:4:"birg";s:4:"exmo";}i:912;a:4:{s:5:"title";s:20:"BCH-EUR (last_trade)";s:6:"course";s:7:"392.307";s:4:"code";s:22:"exmo_bcheur_last_trade";s:4:"birg";s:4:"exmo";}i:913;a:4:{s:5:"title";s:14:"BCH-EUR (high)";s:6:"course";s:6:"394.62";s:4:"code";s:16:"exmo_bcheur_high";s:4:"birg";s:4:"exmo";}i:914;a:4:{s:5:"title";s:13:"BCH-EUR (low)";s:6:"course";s:3:"392";s:4:"code";s:15:"exmo_bcheur_low";s:4:"birg";s:4:"exmo";}i:915;a:4:{s:5:"title";s:13:"BCH-EUR (avg)";s:6:"course";s:12:"393.16338138";s:4:"code";s:15:"exmo_bcheur_avg";s:4:"birg";s:4:"exmo";}i:916;a:4:{s:5:"title";s:19:"XRP-EUR (buy_price)";s:6:"course";s:10:"0.40836309";s:4:"code";s:21:"exmo_xrpeur_buy_price";s:4:"birg";s:4:"exmo";}i:917;a:4:{s:5:"title";s:20:"XRP-EUR (sell_price)";s:6:"course";s:10:"0.41040745";s:4:"code";s:22:"exmo_xrpeur_sell_price";s:4:"birg";s:4:"exmo";}i:918;a:4:{s:5:"title";s:20:"XRP-EUR (last_trade)";s:6:"course";s:7:"0.40877";s:4:"code";s:22:"exmo_xrpeur_last_trade";s:4:"birg";s:4:"exmo";}i:919;a:4:{s:5:"title";s:14:"XRP-EUR (high)";s:6:"course";s:7:"0.41472";s:4:"code";s:16:"exmo_xrpeur_high";s:4:"birg";s:4:"exmo";}i:920;a:4:{s:5:"title";s:13:"XRP-EUR (low)";s:6:"course";s:10:"0.40836309";s:4:"code";s:15:"exmo_xrpeur_low";s:4:"birg";s:4:"exmo";}i:921;a:4:{s:5:"title";s:13:"XRP-EUR (avg)";s:6:"course";s:10:"0.41139457";s:4:"code";s:15:"exmo_xrpeur_avg";s:4:"birg";s:4:"exmo";}i:922;a:4:{s:5:"title";s:19:"XRP-UAH (buy_price)";s:6:"course";s:11:"12.95889444";s:4:"code";s:21:"exmo_xrpuah_buy_price";s:4:"birg";s:4:"exmo";}i:923;a:4:{s:5:"title";s:20:"XRP-UAH (sell_price)";s:6:"course";s:5:"12.98";s:4:"code";s:22:"exmo_xrpuah_sell_price";s:4:"birg";s:4:"exmo";}i:924;a:4:{s:5:"title";s:20:"XRP-UAH (last_trade)";s:6:"course";s:6:"12.974";s:4:"code";s:22:"exmo_xrpuah_last_trade";s:4:"birg";s:4:"exmo";}i:925;a:4:{s:5:"title";s:14:"XRP-UAH (high)";s:6:"course";s:5:"13.39";s:4:"code";s:16:"exmo_xrpuah_high";s:4:"birg";s:4:"exmo";}i:926;a:4:{s:5:"title";s:13:"XRP-UAH (low)";s:6:"course";s:11:"12.95889445";s:4:"code";s:15:"exmo_xrpuah_low";s:4:"birg";s:4:"exmo";}i:927;a:4:{s:5:"title";s:13:"XRP-UAH (avg)";s:6:"course";s:11:"13.11830942";s:4:"code";s:15:"exmo_xrpuah_avg";s:4:"birg";s:4:"exmo";}i:928;a:4:{s:5:"title";s:13:"BTC-USD (mid)";s:6:"course";s:7:"6493.45";s:4:"code";s:19:"bitfinex_btcusd_mid";s:4:"birg";s:8:"bitfinex";}i:929;a:4:{s:5:"title";s:13:"BTC-USD (bid)";s:6:"course";s:6:"6493.4";s:4:"code";s:19:"bitfinex_btcusd_bid";s:4:"birg";s:8:"bitfinex";}i:930;a:4:{s:5:"title";s:13:"BTC-USD (ask)";s:6:"course";s:6:"6493.5";s:4:"code";s:19:"bitfinex_btcusd_ask";s:4:"birg";s:8:"bitfinex";}i:931;a:4:{s:5:"title";s:20:"BTC-USD (last_price)";s:6:"course";s:11:"6493.471614";s:4:"code";s:26:"bitfinex_btcusd_last_price";s:4:"birg";s:8:"bitfinex";}i:932;a:4:{s:5:"title";s:13:"BTC-USD (low)";s:6:"course";s:6:"6480.1";s:4:"code";s:19:"bitfinex_btcusd_low";s:4:"birg";s:8:"bitfinex";}i:933;a:4:{s:5:"title";s:14:"BTC-USD (high)";s:6:"course";s:4:"6560";s:4:"code";s:20:"bitfinex_btcusd_high";s:4:"birg";s:8:"bitfinex";}i:934;a:4:{s:5:"title";s:13:"LTC-USD (mid)";s:6:"course";s:6:"52.117";s:4:"code";s:19:"bitfinex_ltcusd_mid";s:4:"birg";s:8:"bitfinex";}i:935;a:4:{s:5:"title";s:13:"LTC-USD (bid)";s:6:"course";s:6:"52.111";s:4:"code";s:19:"bitfinex_ltcusd_bid";s:4:"birg";s:8:"bitfinex";}i:936;a:4:{s:5:"title";s:13:"LTC-USD (ask)";s:6:"course";s:6:"52.123";s:4:"code";s:19:"bitfinex_ltcusd_ask";s:4:"birg";s:8:"bitfinex";}i:937;a:4:{s:5:"title";s:20:"LTC-USD (last_price)";s:6:"course";s:6:"52.124";s:4:"code";s:26:"bitfinex_ltcusd_last_price";s:4:"birg";s:8:"bitfinex";}i:938;a:4:{s:5:"title";s:13:"LTC-USD (low)";s:6:"course";s:2:"52";s:4:"code";s:19:"bitfinex_ltcusd_low";s:4:"birg";s:8:"bitfinex";}i:939;a:4:{s:5:"title";s:14:"LTC-USD (high)";s:6:"course";s:6:"52.901";s:4:"code";s:20:"bitfinex_ltcusd_high";s:4:"birg";s:8:"bitfinex";}i:940;a:4:{s:5:"title";s:13:"LTC-BTC (mid)";s:6:"course";s:9:"0.0080271";s:4:"code";s:19:"bitfinex_ltcbtc_mid";s:4:"birg";s:8:"bitfinex";}i:941;a:4:{s:5:"title";s:13:"LTC-BTC (bid)";s:6:"course";s:8:"0.008025";s:4:"code";s:19:"bitfinex_ltcbtc_bid";s:4:"birg";s:8:"bitfinex";}i:942;a:4:{s:5:"title";s:13:"LTC-BTC (ask)";s:6:"course";s:9:"0.0080292";s:4:"code";s:19:"bitfinex_ltcbtc_ask";s:4:"birg";s:8:"bitfinex";}i:943;a:4:{s:5:"title";s:20:"LTC-BTC (last_price)";s:6:"course";s:9:"0.0080291";s:4:"code";s:26:"bitfinex_ltcbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:944;a:4:{s:5:"title";s:13:"LTC-BTC (low)";s:6:"course";s:9:"0.0080185";s:4:"code";s:19:"bitfinex_ltcbtc_low";s:4:"birg";s:8:"bitfinex";}i:945;a:4:{s:5:"title";s:14:"LTC-BTC (high)";s:6:"course";s:7:"0.00809";s:4:"code";s:20:"bitfinex_ltcbtc_high";s:4:"birg";s:8:"bitfinex";}i:946;a:4:{s:5:"title";s:13:"ETH-USD (mid)";s:6:"course";s:7:"203.615";s:4:"code";s:19:"bitfinex_ethusd_mid";s:4:"birg";s:8:"bitfinex";}i:947;a:4:{s:5:"title";s:13:"ETH-USD (bid)";s:6:"course";s:6:"203.61";s:4:"code";s:19:"bitfinex_ethusd_bid";s:4:"birg";s:8:"bitfinex";}i:948;a:4:{s:5:"title";s:13:"ETH-USD (ask)";s:6:"course";s:6:"203.62";s:4:"code";s:19:"bitfinex_ethusd_ask";s:4:"birg";s:8:"bitfinex";}i:949;a:4:{s:5:"title";s:20:"ETH-USD (last_price)";s:6:"course";s:6:"203.62";s:4:"code";s:26:"bitfinex_ethusd_last_price";s:4:"birg";s:8:"bitfinex";}i:950;a:4:{s:5:"title";s:13:"ETH-USD (low)";s:6:"course";s:6:"203.06";s:4:"code";s:19:"bitfinex_ethusd_low";s:4:"birg";s:8:"bitfinex";}i:951;a:4:{s:5:"title";s:14:"ETH-USD (high)";s:6:"course";s:6:"205.89";s:4:"code";s:20:"bitfinex_ethusd_high";s:4:"birg";s:8:"bitfinex";}i:952;a:4:{s:5:"title";s:13:"ETH-BTC (mid)";s:6:"course";s:9:"0.0313585";s:4:"code";s:19:"bitfinex_ethbtc_mid";s:4:"birg";s:8:"bitfinex";}i:953;a:4:{s:5:"title";s:13:"ETH-BTC (bid)";s:6:"course";s:8:"0.031358";s:4:"code";s:19:"bitfinex_ethbtc_bid";s:4:"birg";s:8:"bitfinex";}i:954;a:4:{s:5:"title";s:13:"ETH-BTC (ask)";s:6:"course";s:8:"0.031359";s:4:"code";s:19:"bitfinex_ethbtc_ask";s:4:"birg";s:8:"bitfinex";}i:955;a:4:{s:5:"title";s:20:"ETH-BTC (last_price)";s:6:"course";s:8:"0.031358";s:4:"code";s:26:"bitfinex_ethbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:956;a:4:{s:5:"title";s:13:"ETH-BTC (low)";s:6:"course";s:8:"0.031228";s:4:"code";s:19:"bitfinex_ethbtc_low";s:4:"birg";s:8:"bitfinex";}i:957;a:4:{s:5:"title";s:14:"ETH-BTC (high)";s:6:"course";s:8:"0.031392";s:4:"code";s:20:"bitfinex_ethbtc_high";s:4:"birg";s:8:"bitfinex";}i:958;a:4:{s:5:"title";s:13:"ETC-BTC (mid)";s:6:"course";s:10:"0.00148905";s:4:"code";s:19:"bitfinex_etcbtc_mid";s:4:"birg";s:8:"bitfinex";}i:959;a:4:{s:5:"title";s:13:"ETC-BTC (bid)";s:6:"course";s:9:"0.0014887";s:4:"code";s:19:"bitfinex_etcbtc_bid";s:4:"birg";s:8:"bitfinex";}i:960;a:4:{s:5:"title";s:13:"ETC-BTC (ask)";s:6:"course";s:9:"0.0014894";s:4:"code";s:19:"bitfinex_etcbtc_ask";s:4:"birg";s:8:"bitfinex";}i:961;a:4:{s:5:"title";s:20:"ETC-BTC (last_price)";s:6:"course";s:9:"0.0014903";s:4:"code";s:26:"bitfinex_etcbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:962;a:4:{s:5:"title";s:13:"ETC-BTC (low)";s:6:"course";s:9:"0.0014837";s:4:"code";s:19:"bitfinex_etcbtc_low";s:4:"birg";s:8:"bitfinex";}i:963;a:4:{s:5:"title";s:14:"ETC-BTC (high)";s:6:"course";s:9:"0.0014923";s:4:"code";s:20:"bitfinex_etcbtc_high";s:4:"birg";s:8:"bitfinex";}i:964;a:4:{s:5:"title";s:13:"ETC-USD (mid)";s:6:"course";s:6:"9.6724";s:4:"code";s:19:"bitfinex_etcusd_mid";s:4:"birg";s:8:"bitfinex";}i:965;a:4:{s:5:"title";s:13:"ETC-USD (bid)";s:6:"course";s:6:"9.6702";s:4:"code";s:19:"bitfinex_etcusd_bid";s:4:"birg";s:8:"bitfinex";}i:966;a:4:{s:5:"title";s:13:"ETC-USD (ask)";s:6:"course";s:6:"9.6746";s:4:"code";s:19:"bitfinex_etcusd_ask";s:4:"birg";s:8:"bitfinex";}i:967;a:4:{s:5:"title";s:20:"ETC-USD (last_price)";s:6:"course";s:6:"9.6744";s:4:"code";s:26:"bitfinex_etcusd_last_price";s:4:"birg";s:8:"bitfinex";}i:968;a:4:{s:5:"title";s:13:"ETC-USD (low)";s:6:"course";s:4:"9.65";s:4:"code";s:19:"bitfinex_etcusd_low";s:4:"birg";s:8:"bitfinex";}i:969;a:4:{s:5:"title";s:14:"ETC-USD (high)";s:6:"course";s:6:"9.7725";s:4:"code";s:20:"bitfinex_etcusd_high";s:4:"birg";s:8:"bitfinex";}i:970;a:4:{s:5:"title";s:13:"RRT-USD (mid)";s:6:"course";s:9:"0.0358015";s:4:"code";s:19:"bitfinex_rrtusd_mid";s:4:"birg";s:8:"bitfinex";}i:971;a:4:{s:5:"title";s:13:"RRT-USD (bid)";s:6:"course";s:8:"0.035004";s:4:"code";s:19:"bitfinex_rrtusd_bid";s:4:"birg";s:8:"bitfinex";}i:972;a:4:{s:5:"title";s:13:"RRT-USD (ask)";s:6:"course";s:8:"0.036599";s:4:"code";s:19:"bitfinex_rrtusd_ask";s:4:"birg";s:8:"bitfinex";}i:973;a:4:{s:5:"title";s:20:"RRT-USD (last_price)";s:6:"course";s:7:"0.03535";s:4:"code";s:26:"bitfinex_rrtusd_last_price";s:4:"birg";s:8:"bitfinex";}i:974;a:4:{s:5:"title";s:13:"RRT-USD (low)";s:6:"course";s:7:"0.03535";s:4:"code";s:19:"bitfinex_rrtusd_low";s:4:"birg";s:8:"bitfinex";}i:975;a:4:{s:5:"title";s:14:"RRT-USD (high)";s:6:"course";s:8:"0.036779";s:4:"code";s:20:"bitfinex_rrtusd_high";s:4:"birg";s:8:"bitfinex";}i:976;a:4:{s:5:"title";s:13:"RRT-BTC (mid)";s:6:"course";s:9:"0.0000054";s:4:"code";s:19:"bitfinex_rrtbtc_mid";s:4:"birg";s:8:"bitfinex";}i:977;a:4:{s:5:"title";s:13:"RRT-BTC (bid)";s:6:"course";s:10:"0.00000516";s:4:"code";s:19:"bitfinex_rrtbtc_bid";s:4:"birg";s:8:"bitfinex";}i:978;a:4:{s:5:"title";s:13:"RRT-BTC (ask)";s:6:"course";s:10:"0.00000564";s:4:"code";s:19:"bitfinex_rrtbtc_ask";s:4:"birg";s:8:"bitfinex";}i:979;a:4:{s:5:"title";s:20:"RRT-BTC (last_price)";s:6:"course";s:10:"0.00000535";s:4:"code";s:26:"bitfinex_rrtbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:980;a:4:{s:5:"title";s:13:"ZEC-USD (mid)";s:6:"course";s:7:"121.205";s:4:"code";s:19:"bitfinex_zecusd_mid";s:4:"birg";s:8:"bitfinex";}i:981;a:4:{s:5:"title";s:13:"ZEC-USD (bid)";s:6:"course";s:6:"121.13";s:4:"code";s:19:"bitfinex_zecusd_bid";s:4:"birg";s:8:"bitfinex";}i:982;a:4:{s:5:"title";s:13:"ZEC-USD (ask)";s:6:"course";s:6:"121.28";s:4:"code";s:19:"bitfinex_zecusd_ask";s:4:"birg";s:8:"bitfinex";}i:983;a:4:{s:5:"title";s:20:"ZEC-USD (last_price)";s:6:"course";s:6:"121.01";s:4:"code";s:26:"bitfinex_zecusd_last_price";s:4:"birg";s:8:"bitfinex";}i:984;a:4:{s:5:"title";s:13:"ZEC-USD (low)";s:6:"course";s:6:"120.42";s:4:"code";s:19:"bitfinex_zecusd_low";s:4:"birg";s:8:"bitfinex";}i:985;a:4:{s:5:"title";s:14:"ZEC-USD (high)";s:6:"course";s:6:"123.51";s:4:"code";s:20:"bitfinex_zecusd_high";s:4:"birg";s:8:"bitfinex";}i:986;a:4:{s:5:"title";s:13:"ZEC-BTC (mid)";s:6:"course";s:9:"0.0186685";s:4:"code";s:19:"bitfinex_zecbtc_mid";s:4:"birg";s:8:"bitfinex";}i:987;a:4:{s:5:"title";s:13:"ZEC-BTC (bid)";s:6:"course";s:8:"0.018644";s:4:"code";s:19:"bitfinex_zecbtc_bid";s:4:"birg";s:8:"bitfinex";}i:988;a:4:{s:5:"title";s:13:"ZEC-BTC (ask)";s:6:"course";s:8:"0.018693";s:4:"code";s:19:"bitfinex_zecbtc_ask";s:4:"birg";s:8:"bitfinex";}i:989;a:4:{s:5:"title";s:20:"ZEC-BTC (last_price)";s:6:"course";s:8:"0.018712";s:4:"code";s:26:"bitfinex_zecbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:990;a:4:{s:5:"title";s:13:"ZEC-BTC (low)";s:6:"course";s:8:"0.018484";s:4:"code";s:19:"bitfinex_zecbtc_low";s:4:"birg";s:8:"bitfinex";}i:991;a:4:{s:5:"title";s:14:"ZEC-BTC (high)";s:6:"course";s:8:"0.018835";s:4:"code";s:20:"bitfinex_zecbtc_high";s:4:"birg";s:8:"bitfinex";}i:992;a:4:{s:5:"title";s:13:"XMR-USD (mid)";s:6:"course";s:7:"105.145";s:4:"code";s:19:"bitfinex_xmrusd_mid";s:4:"birg";s:8:"bitfinex";}i:993;a:4:{s:5:"title";s:13:"XMR-USD (bid)";s:6:"course";s:6:"105.14";s:4:"code";s:19:"bitfinex_xmrusd_bid";s:4:"birg";s:8:"bitfinex";}i:994;a:4:{s:5:"title";s:13:"XMR-USD (ask)";s:6:"course";s:6:"105.15";s:4:"code";s:19:"bitfinex_xmrusd_ask";s:4:"birg";s:8:"bitfinex";}i:995;a:4:{s:5:"title";s:20:"XMR-USD (last_price)";s:6:"course";s:6:"105.15";s:4:"code";s:26:"bitfinex_xmrusd_last_price";s:4:"birg";s:8:"bitfinex";}i:996;a:4:{s:5:"title";s:13:"XMR-USD (low)";s:6:"course";s:6:"105.01";s:4:"code";s:19:"bitfinex_xmrusd_low";s:4:"birg";s:8:"bitfinex";}i:997;a:4:{s:5:"title";s:14:"XMR-USD (high)";s:6:"course";s:6:"107.78";s:4:"code";s:20:"bitfinex_xmrusd_high";s:4:"birg";s:8:"bitfinex";}i:998;a:4:{s:5:"title";s:13:"XMR-BTC (mid)";s:6:"course";s:9:"0.0161915";s:4:"code";s:19:"bitfinex_xmrbtc_mid";s:4:"birg";s:8:"bitfinex";}i:999;a:4:{s:5:"title";s:13:"XMR-BTC (bid)";s:6:"course";s:8:"0.016184";s:4:"code";s:19:"bitfinex_xmrbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1000;a:4:{s:5:"title";s:13:"XMR-BTC (ask)";s:6:"course";s:8:"0.016199";s:4:"code";s:19:"bitfinex_xmrbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1001;a:4:{s:5:"title";s:20:"XMR-BTC (last_price)";s:6:"course";s:8:"0.016184";s:4:"code";s:26:"bitfinex_xmrbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1002;a:4:{s:5:"title";s:13:"XMR-BTC (low)";s:6:"course";s:8:"0.016096";s:4:"code";s:19:"bitfinex_xmrbtc_low";s:4:"birg";s:8:"bitfinex";}i:1003;a:4:{s:5:"title";s:14:"XMR-BTC (high)";s:6:"course";s:8:"0.016436";s:4:"code";s:20:"bitfinex_xmrbtc_high";s:4:"birg";s:8:"bitfinex";}i:1004;a:4:{s:5:"title";s:13:"DSH-USD (mid)";s:6:"course";s:6:"155.34";s:4:"code";s:19:"bitfinex_dshusd_mid";s:4:"birg";s:8:"bitfinex";}i:1005;a:4:{s:5:"title";s:13:"DSH-USD (bid)";s:6:"course";s:6:"155.33";s:4:"code";s:19:"bitfinex_dshusd_bid";s:4:"birg";s:8:"bitfinex";}i:1006;a:4:{s:5:"title";s:13:"DSH-USD (ask)";s:6:"course";s:6:"155.35";s:4:"code";s:19:"bitfinex_dshusd_ask";s:4:"birg";s:8:"bitfinex";}i:1007;a:4:{s:5:"title";s:20:"DSH-USD (last_price)";s:6:"course";s:6:"155.19";s:4:"code";s:26:"bitfinex_dshusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1008;a:4:{s:5:"title";s:13:"DSH-USD (low)";s:6:"course";s:6:"155.18";s:4:"code";s:19:"bitfinex_dshusd_low";s:4:"birg";s:8:"bitfinex";}i:1009;a:4:{s:5:"title";s:14:"DSH-USD (high)";s:6:"course";s:6:"158.22";s:4:"code";s:20:"bitfinex_dshusd_high";s:4:"birg";s:8:"bitfinex";}i:1010;a:4:{s:5:"title";s:13:"DSH-BTC (mid)";s:6:"course";s:9:"0.0239245";s:4:"code";s:19:"bitfinex_dshbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1011;a:4:{s:5:"title";s:13:"DSH-BTC (bid)";s:6:"course";s:8:"0.023915";s:4:"code";s:19:"bitfinex_dshbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1012;a:4:{s:5:"title";s:13:"DSH-BTC (ask)";s:6:"course";s:8:"0.023934";s:4:"code";s:19:"bitfinex_dshbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1013;a:4:{s:5:"title";s:20:"DSH-BTC (last_price)";s:6:"course";s:8:"0.023938";s:4:"code";s:26:"bitfinex_dshbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1014;a:4:{s:5:"title";s:13:"DSH-BTC (low)";s:6:"course";s:8:"0.023852";s:4:"code";s:19:"bitfinex_dshbtc_low";s:4:"birg";s:8:"bitfinex";}i:1015;a:4:{s:5:"title";s:14:"DSH-BTC (high)";s:6:"course";s:8:"0.024178";s:4:"code";s:20:"bitfinex_dshbtc_high";s:4:"birg";s:8:"bitfinex";}i:1016;a:4:{s:5:"title";s:13:"BTC-EUR (mid)";s:6:"course";s:6:"5683.8";s:4:"code";s:19:"bitfinex_btceur_mid";s:4:"birg";s:8:"bitfinex";}i:1017;a:4:{s:5:"title";s:13:"BTC-EUR (bid)";s:6:"course";s:6:"5683.7";s:4:"code";s:19:"bitfinex_btceur_bid";s:4:"birg";s:8:"bitfinex";}i:1018;a:4:{s:5:"title";s:13:"BTC-EUR (ask)";s:6:"course";s:6:"5683.9";s:4:"code";s:19:"bitfinex_btceur_ask";s:4:"birg";s:8:"bitfinex";}i:1019;a:4:{s:5:"title";s:20:"BTC-EUR (last_price)";s:6:"course";s:4:"5685";s:4:"code";s:26:"bitfinex_btceur_last_price";s:4:"birg";s:8:"bitfinex";}i:1020;a:4:{s:5:"title";s:13:"BTC-EUR (low)";s:6:"course";s:4:"5673";s:4:"code";s:19:"bitfinex_btceur_low";s:4:"birg";s:8:"bitfinex";}i:1021;a:4:{s:5:"title";s:14:"BTC-EUR (high)";s:6:"course";s:13:"5746.89997595";s:4:"code";s:20:"bitfinex_btceur_high";s:4:"birg";s:8:"bitfinex";}i:1022;a:4:{s:5:"title";s:13:"BTC-JPY (mid)";s:6:"course";s:6:"726595";s:4:"code";s:19:"bitfinex_btcjpy_mid";s:4:"birg";s:8:"bitfinex";}i:1023;a:4:{s:5:"title";s:13:"BTC-JPY (bid)";s:6:"course";s:6:"726590";s:4:"code";s:19:"bitfinex_btcjpy_bid";s:4:"birg";s:8:"bitfinex";}i:1024;a:4:{s:5:"title";s:13:"BTC-JPY (ask)";s:6:"course";s:6:"726600";s:4:"code";s:19:"bitfinex_btcjpy_ask";s:4:"birg";s:8:"bitfinex";}i:1025;a:4:{s:5:"title";s:20:"BTC-JPY (last_price)";s:6:"course";s:6:"726600";s:4:"code";s:26:"bitfinex_btcjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1026;a:4:{s:5:"title";s:13:"BTC-JPY (low)";s:6:"course";s:6:"725520";s:4:"code";s:19:"bitfinex_btcjpy_low";s:4:"birg";s:8:"bitfinex";}i:1027;a:4:{s:5:"title";s:14:"BTC-JPY (high)";s:6:"course";s:6:"733450";s:4:"code";s:20:"bitfinex_btcjpy_high";s:4:"birg";s:8:"bitfinex";}i:1028;a:4:{s:5:"title";s:13:"XRP-USD (mid)";s:6:"course";s:8:"0.459895";s:4:"code";s:19:"bitfinex_xrpusd_mid";s:4:"birg";s:8:"bitfinex";}i:1029;a:4:{s:5:"title";s:13:"XRP-USD (bid)";s:6:"course";s:7:"0.45989";s:4:"code";s:19:"bitfinex_xrpusd_bid";s:4:"birg";s:8:"bitfinex";}i:1030;a:4:{s:5:"title";s:13:"XRP-USD (ask)";s:6:"course";s:6:"0.4599";s:4:"code";s:19:"bitfinex_xrpusd_ask";s:4:"birg";s:8:"bitfinex";}i:1031;a:4:{s:5:"title";s:20:"XRP-USD (last_price)";s:6:"course";s:6:"0.4599";s:4:"code";s:26:"bitfinex_xrpusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1032;a:4:{s:5:"title";s:13:"XRP-USD (low)";s:6:"course";s:7:"0.45655";s:4:"code";s:19:"bitfinex_xrpusd_low";s:4:"birg";s:8:"bitfinex";}i:1033;a:4:{s:5:"title";s:14:"XRP-USD (high)";s:6:"course";s:7:"0.46761";s:4:"code";s:20:"bitfinex_xrpusd_high";s:4:"birg";s:8:"bitfinex";}i:1034;a:4:{s:5:"title";s:13:"XRP-BTC (mid)";s:6:"course";s:11:"0.000070785";s:4:"code";s:19:"bitfinex_xrpbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1035;a:4:{s:5:"title";s:13:"XRP-BTC (bid)";s:6:"course";s:10:"0.00007077";s:4:"code";s:19:"bitfinex_xrpbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1036;a:4:{s:5:"title";s:13:"XRP-BTC (ask)";s:6:"course";s:9:"0.0000708";s:4:"code";s:19:"bitfinex_xrpbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1037;a:4:{s:5:"title";s:20:"XRP-BTC (last_price)";s:6:"course";s:10:"0.00007081";s:4:"code";s:26:"bitfinex_xrpbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1038;a:4:{s:5:"title";s:13:"XRP-BTC (low)";s:6:"course";s:10:"0.00006936";s:4:"code";s:19:"bitfinex_xrpbtc_low";s:4:"birg";s:8:"bitfinex";}i:1039;a:4:{s:5:"title";s:14:"XRP-BTC (high)";s:6:"course";s:9:"0.0000715";s:4:"code";s:20:"bitfinex_xrpbtc_high";s:4:"birg";s:8:"bitfinex";}i:1040;a:4:{s:5:"title";s:13:"IOT-USD (mid)";s:6:"course";s:7:"0.49225";s:4:"code";s:19:"bitfinex_iotusd_mid";s:4:"birg";s:8:"bitfinex";}i:1041;a:4:{s:5:"title";s:13:"IOT-USD (bid)";s:6:"course";s:7:"0.49221";s:4:"code";s:19:"bitfinex_iotusd_bid";s:4:"birg";s:8:"bitfinex";}i:1042;a:4:{s:5:"title";s:13:"IOT-USD (ask)";s:6:"course";s:7:"0.49229";s:4:"code";s:19:"bitfinex_iotusd_ask";s:4:"birg";s:8:"bitfinex";}i:1043;a:4:{s:5:"title";s:20:"IOT-USD (last_price)";s:6:"course";s:7:"0.49329";s:4:"code";s:26:"bitfinex_iotusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1044;a:4:{s:5:"title";s:13:"IOT-USD (low)";s:6:"course";s:6:"0.4917";s:4:"code";s:19:"bitfinex_iotusd_low";s:4:"birg";s:8:"bitfinex";}i:1045;a:4:{s:5:"title";s:14:"IOT-USD (high)";s:6:"course";s:7:"0.50057";s:4:"code";s:20:"bitfinex_iotusd_high";s:4:"birg";s:8:"bitfinex";}i:1046;a:4:{s:5:"title";s:13:"IOT-BTC (mid)";s:6:"course";s:11:"0.000075775";s:4:"code";s:19:"bitfinex_iotbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1047;a:4:{s:5:"title";s:13:"IOT-BTC (bid)";s:6:"course";s:10:"0.00007572";s:4:"code";s:19:"bitfinex_iotbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1048;a:4:{s:5:"title";s:13:"IOT-BTC (ask)";s:6:"course";s:10:"0.00007583";s:4:"code";s:19:"bitfinex_iotbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1049;a:4:{s:5:"title";s:20:"IOT-BTC (last_price)";s:6:"course";s:10:"0.00007571";s:4:"code";s:26:"bitfinex_iotbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1050;a:4:{s:5:"title";s:13:"IOT-BTC (low)";s:6:"course";s:10:"0.00007523";s:4:"code";s:19:"bitfinex_iotbtc_low";s:4:"birg";s:8:"bitfinex";}i:1051;a:4:{s:5:"title";s:14:"IOT-BTC (high)";s:6:"course";s:10:"0.00007656";s:4:"code";s:20:"bitfinex_iotbtc_high";s:4:"birg";s:8:"bitfinex";}i:1052;a:4:{s:5:"title";s:13:"IOT-ETH (mid)";s:6:"course";s:10:"0.00241425";s:4:"code";s:19:"bitfinex_ioteth_mid";s:4:"birg";s:8:"bitfinex";}i:1053;a:4:{s:5:"title";s:13:"IOT-ETH (bid)";s:6:"course";s:9:"0.0024117";s:4:"code";s:19:"bitfinex_ioteth_bid";s:4:"birg";s:8:"bitfinex";}i:1054;a:4:{s:5:"title";s:13:"IOT-ETH (ask)";s:6:"course";s:9:"0.0024168";s:4:"code";s:19:"bitfinex_ioteth_ask";s:4:"birg";s:8:"bitfinex";}i:1055;a:4:{s:5:"title";s:20:"IOT-ETH (last_price)";s:6:"course";s:9:"0.0024168";s:4:"code";s:26:"bitfinex_ioteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1056;a:4:{s:5:"title";s:13:"IOT-ETH (low)";s:6:"course";s:9:"0.0023902";s:4:"code";s:19:"bitfinex_ioteth_low";s:4:"birg";s:8:"bitfinex";}i:1057;a:4:{s:5:"title";s:14:"IOT-ETH (high)";s:6:"course";s:9:"0.0024372";s:4:"code";s:20:"bitfinex_ioteth_high";s:4:"birg";s:8:"bitfinex";}i:1058;a:4:{s:5:"title";s:13:"EOS-USD (mid)";s:6:"course";s:6:"5.4195";s:4:"code";s:19:"bitfinex_eosusd_mid";s:4:"birg";s:8:"bitfinex";}i:1059;a:4:{s:5:"title";s:13:"EOS-USD (bid)";s:6:"course";s:6:"5.4172";s:4:"code";s:19:"bitfinex_eosusd_bid";s:4:"birg";s:8:"bitfinex";}i:1060;a:4:{s:5:"title";s:13:"EOS-USD (ask)";s:6:"course";s:6:"5.4218";s:4:"code";s:19:"bitfinex_eosusd_ask";s:4:"birg";s:8:"bitfinex";}i:1061;a:4:{s:5:"title";s:20:"EOS-USD (last_price)";s:6:"course";s:6:"5.4172";s:4:"code";s:26:"bitfinex_eosusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1062;a:4:{s:5:"title";s:13:"EOS-USD (low)";s:6:"course";s:6:"5.4039";s:4:"code";s:19:"bitfinex_eosusd_low";s:4:"birg";s:8:"bitfinex";}i:1063;a:4:{s:5:"title";s:14:"EOS-USD (high)";s:6:"course";s:6:"5.4658";s:4:"code";s:20:"bitfinex_eosusd_high";s:4:"birg";s:8:"bitfinex";}i:1064;a:4:{s:5:"title";s:13:"EOS-BTC (mid)";s:6:"course";s:11:"0.000834655";s:4:"code";s:19:"bitfinex_eosbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1065;a:4:{s:5:"title";s:13:"EOS-BTC (bid)";s:6:"course";s:10:"0.00083451";s:4:"code";s:19:"bitfinex_eosbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1066;a:4:{s:5:"title";s:13:"EOS-BTC (ask)";s:6:"course";s:9:"0.0008348";s:4:"code";s:19:"bitfinex_eosbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1067;a:4:{s:5:"title";s:20:"EOS-BTC (last_price)";s:6:"course";s:10:"0.00083477";s:4:"code";s:26:"bitfinex_eosbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1068;a:4:{s:5:"title";s:13:"EOS-BTC (low)";s:6:"course";s:9:"0.0008295";s:4:"code";s:19:"bitfinex_eosbtc_low";s:4:"birg";s:8:"bitfinex";}i:1069;a:4:{s:5:"title";s:14:"EOS-BTC (high)";s:6:"course";s:9:"0.0008351";s:4:"code";s:20:"bitfinex_eosbtc_high";s:4:"birg";s:8:"bitfinex";}i:1070;a:4:{s:5:"title";s:13:"EOS-ETH (mid)";s:6:"course";s:9:"0.0265925";s:4:"code";s:19:"bitfinex_eoseth_mid";s:4:"birg";s:8:"bitfinex";}i:1071;a:4:{s:5:"title";s:13:"EOS-ETH (bid)";s:6:"course";s:8:"0.026585";s:4:"code";s:19:"bitfinex_eoseth_bid";s:4:"birg";s:8:"bitfinex";}i:1072;a:4:{s:5:"title";s:13:"EOS-ETH (ask)";s:6:"course";s:6:"0.0266";s:4:"code";s:19:"bitfinex_eoseth_ask";s:4:"birg";s:8:"bitfinex";}i:1073;a:4:{s:5:"title";s:20:"EOS-ETH (last_price)";s:6:"course";s:6:"0.0266";s:4:"code";s:26:"bitfinex_eoseth_last_price";s:4:"birg";s:8:"bitfinex";}i:1074;a:4:{s:5:"title";s:13:"EOS-ETH (low)";s:6:"course";s:8:"0.026374";s:4:"code";s:19:"bitfinex_eoseth_low";s:4:"birg";s:8:"bitfinex";}i:1075;a:4:{s:5:"title";s:14:"EOS-ETH (high)";s:6:"course";s:8:"0.026636";s:4:"code";s:20:"bitfinex_eoseth_high";s:4:"birg";s:8:"bitfinex";}i:1076;a:4:{s:5:"title";s:13:"SAN-USD (mid)";s:6:"course";s:8:"0.479855";s:4:"code";s:19:"bitfinex_sanusd_mid";s:4:"birg";s:8:"bitfinex";}i:1077;a:4:{s:5:"title";s:13:"SAN-USD (bid)";s:6:"course";s:7:"0.47868";s:4:"code";s:19:"bitfinex_sanusd_bid";s:4:"birg";s:8:"bitfinex";}i:1078;a:4:{s:5:"title";s:13:"SAN-USD (ask)";s:6:"course";s:7:"0.48103";s:4:"code";s:19:"bitfinex_sanusd_ask";s:4:"birg";s:8:"bitfinex";}i:1079;a:4:{s:5:"title";s:20:"SAN-USD (last_price)";s:6:"course";s:7:"0.47903";s:4:"code";s:26:"bitfinex_sanusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1080;a:4:{s:5:"title";s:13:"SAN-USD (low)";s:6:"course";s:5:"0.475";s:4:"code";s:19:"bitfinex_sanusd_low";s:4:"birg";s:8:"bitfinex";}i:1081;a:4:{s:5:"title";s:14:"SAN-USD (high)";s:6:"course";s:7:"0.48911";s:4:"code";s:20:"bitfinex_sanusd_high";s:4:"birg";s:8:"bitfinex";}i:1082;a:4:{s:5:"title";s:13:"SAN-BTC (mid)";s:6:"course";s:10:"0.00007405";s:4:"code";s:19:"bitfinex_sanbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1083;a:4:{s:5:"title";s:13:"SAN-BTC (bid)";s:6:"course";s:10:"0.00007281";s:4:"code";s:19:"bitfinex_sanbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1084;a:4:{s:5:"title";s:13:"SAN-BTC (ask)";s:6:"course";s:10:"0.00007529";s:4:"code";s:19:"bitfinex_sanbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1085;a:4:{s:5:"title";s:20:"SAN-BTC (last_price)";s:6:"course";s:9:"0.0000753";s:4:"code";s:26:"bitfinex_sanbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1086;a:4:{s:5:"title";s:13:"SAN-BTC (low)";s:6:"course";s:10:"0.00007246";s:4:"code";s:19:"bitfinex_sanbtc_low";s:4:"birg";s:8:"bitfinex";}i:1087;a:4:{s:5:"title";s:14:"SAN-BTC (high)";s:6:"course";s:9:"0.0000753";s:4:"code";s:20:"bitfinex_sanbtc_high";s:4:"birg";s:8:"bitfinex";}i:1088;a:4:{s:5:"title";s:13:"SAN-ETH (mid)";s:6:"course";s:9:"0.0023549";s:4:"code";s:19:"bitfinex_saneth_mid";s:4:"birg";s:8:"bitfinex";}i:1089;a:4:{s:5:"title";s:13:"SAN-ETH (bid)";s:6:"course";s:7:"0.00222";s:4:"code";s:19:"bitfinex_saneth_bid";s:4:"birg";s:8:"bitfinex";}i:1090;a:4:{s:5:"title";s:13:"SAN-ETH (ask)";s:6:"course";s:9:"0.0024898";s:4:"code";s:19:"bitfinex_saneth_ask";s:4:"birg";s:8:"bitfinex";}i:1091;a:4:{s:5:"title";s:20:"SAN-ETH (last_price)";s:6:"course";s:9:"0.0023075";s:4:"code";s:26:"bitfinex_saneth_last_price";s:4:"birg";s:8:"bitfinex";}i:1092;a:4:{s:5:"title";s:13:"SAN-ETH (low)";s:6:"course";s:9:"0.0023012";s:4:"code";s:19:"bitfinex_saneth_low";s:4:"birg";s:8:"bitfinex";}i:1093;a:4:{s:5:"title";s:14:"SAN-ETH (high)";s:6:"course";s:9:"0.0024476";s:4:"code";s:20:"bitfinex_saneth_high";s:4:"birg";s:8:"bitfinex";}i:1094;a:4:{s:5:"title";s:13:"OMG-USD (mid)";s:6:"course";s:7:"3.23315";s:4:"code";s:19:"bitfinex_omgusd_mid";s:4:"birg";s:8:"bitfinex";}i:1095;a:4:{s:5:"title";s:13:"OMG-USD (bid)";s:6:"course";s:6:"3.2316";s:4:"code";s:19:"bitfinex_omgusd_bid";s:4:"birg";s:8:"bitfinex";}i:1096;a:4:{s:5:"title";s:13:"OMG-USD (ask)";s:6:"course";s:6:"3.2347";s:4:"code";s:19:"bitfinex_omgusd_ask";s:4:"birg";s:8:"bitfinex";}i:1097;a:4:{s:5:"title";s:20:"OMG-USD (last_price)";s:6:"course";s:6:"3.2317";s:4:"code";s:26:"bitfinex_omgusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1098;a:4:{s:5:"title";s:13:"OMG-USD (low)";s:6:"course";s:6:"3.2314";s:4:"code";s:19:"bitfinex_omgusd_low";s:4:"birg";s:8:"bitfinex";}i:1099;a:4:{s:5:"title";s:14:"OMG-USD (high)";s:6:"course";s:6:"3.3665";s:4:"code";s:20:"bitfinex_omgusd_high";s:4:"birg";s:8:"bitfinex";}i:1100;a:4:{s:5:"title";s:13:"OMG-BTC (mid)";s:6:"course";s:11:"0.000497935";s:4:"code";s:19:"bitfinex_omgbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1101;a:4:{s:5:"title";s:13:"OMG-BTC (bid)";s:6:"course";s:10:"0.00049689";s:4:"code";s:19:"bitfinex_omgbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1102;a:4:{s:5:"title";s:13:"OMG-BTC (ask)";s:6:"course";s:10:"0.00049898";s:4:"code";s:19:"bitfinex_omgbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1103;a:4:{s:5:"title";s:20:"OMG-BTC (last_price)";s:6:"course";s:10:"0.00050036";s:4:"code";s:26:"bitfinex_omgbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1104;a:4:{s:5:"title";s:13:"OMG-BTC (low)";s:6:"course";s:10:"0.00049835";s:4:"code";s:19:"bitfinex_omgbtc_low";s:4:"birg";s:8:"bitfinex";}i:1105;a:4:{s:5:"title";s:14:"OMG-BTC (high)";s:6:"course";s:10:"0.00051293";s:4:"code";s:20:"bitfinex_omgbtc_high";s:4:"birg";s:8:"bitfinex";}i:1106;a:4:{s:5:"title";s:13:"OMG-ETH (mid)";s:6:"course";s:9:"0.0159245";s:4:"code";s:19:"bitfinex_omgeth_mid";s:4:"birg";s:8:"bitfinex";}i:1107;a:4:{s:5:"title";s:13:"OMG-ETH (bid)";s:6:"course";s:7:"0.01591";s:4:"code";s:19:"bitfinex_omgeth_bid";s:4:"birg";s:8:"bitfinex";}i:1108;a:4:{s:5:"title";s:13:"OMG-ETH (ask)";s:6:"course";s:8:"0.015939";s:4:"code";s:19:"bitfinex_omgeth_ask";s:4:"birg";s:8:"bitfinex";}i:1109;a:4:{s:5:"title";s:20:"OMG-ETH (last_price)";s:6:"course";s:7:"0.01591";s:4:"code";s:26:"bitfinex_omgeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1110;a:4:{s:5:"title";s:13:"OMG-ETH (low)";s:6:"course";s:7:"0.01591";s:4:"code";s:19:"bitfinex_omgeth_low";s:4:"birg";s:8:"bitfinex";}i:1111;a:4:{s:5:"title";s:14:"OMG-ETH (high)";s:6:"course";s:8:"0.016365";s:4:"code";s:20:"bitfinex_omgeth_high";s:4:"birg";s:8:"bitfinex";}i:1112;a:4:{s:5:"title";s:13:"BCH-USD (mid)";s:6:"course";s:7:"440.005";s:4:"code";s:19:"bitfinex_bchusd_mid";s:4:"birg";s:8:"bitfinex";}i:1113;a:4:{s:5:"title";s:13:"BCH-USD (bid)";s:6:"course";s:3:"440";s:4:"code";s:19:"bitfinex_bchusd_bid";s:4:"birg";s:8:"bitfinex";}i:1114;a:4:{s:5:"title";s:13:"BCH-USD (ask)";s:6:"course";s:6:"440.01";s:4:"code";s:19:"bitfinex_bchusd_ask";s:4:"birg";s:8:"bitfinex";}i:1115;a:4:{s:5:"title";s:20:"BCH-USD (last_price)";s:6:"course";s:3:"440";s:4:"code";s:26:"bitfinex_bchusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1116;a:4:{s:5:"title";s:13:"BCH-USD (low)";s:6:"course";s:3:"440";s:4:"code";s:19:"bitfinex_bchusd_low";s:4:"birg";s:8:"bitfinex";}i:1117;a:4:{s:5:"title";s:14:"BCH-USD (high)";s:6:"course";s:6:"445.45";s:4:"code";s:20:"bitfinex_bchusd_high";s:4:"birg";s:8:"bitfinex";}i:1118;a:4:{s:5:"title";s:13:"BCH-BTC (mid)";s:6:"course";s:9:"0.0677365";s:4:"code";s:19:"bitfinex_bchbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1119;a:4:{s:5:"title";s:13:"BCH-BTC (bid)";s:6:"course";s:8:"0.067714";s:4:"code";s:19:"bitfinex_bchbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1120;a:4:{s:5:"title";s:13:"BCH-BTC (ask)";s:6:"course";s:8:"0.067759";s:4:"code";s:19:"bitfinex_bchbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1121;a:4:{s:5:"title";s:20:"BCH-BTC (last_price)";s:6:"course";s:8:"0.067827";s:4:"code";s:26:"bitfinex_bchbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1122;a:4:{s:5:"title";s:13:"BCH-BTC (low)";s:6:"course";s:7:"0.06762";s:4:"code";s:19:"bitfinex_bchbtc_low";s:4:"birg";s:8:"bitfinex";}i:1123;a:4:{s:5:"title";s:14:"BCH-BTC (high)";s:6:"course";s:8:"0.068075";s:4:"code";s:20:"bitfinex_bchbtc_high";s:4:"birg";s:8:"bitfinex";}i:1124;a:4:{s:5:"title";s:13:"BCH-ETH (mid)";s:6:"course";s:6:"2.1608";s:4:"code";s:19:"bitfinex_bcheth_mid";s:4:"birg";s:8:"bitfinex";}i:1125;a:4:{s:5:"title";s:13:"BCH-ETH (bid)";s:6:"course";s:6:"2.1586";s:4:"code";s:19:"bitfinex_bcheth_bid";s:4:"birg";s:8:"bitfinex";}i:1126;a:4:{s:5:"title";s:13:"BCH-ETH (ask)";s:6:"course";s:5:"2.163";s:4:"code";s:19:"bitfinex_bcheth_ask";s:4:"birg";s:8:"bitfinex";}i:1127;a:4:{s:5:"title";s:20:"BCH-ETH (last_price)";s:6:"course";s:6:"2.1656";s:4:"code";s:26:"bitfinex_bcheth_last_price";s:4:"birg";s:8:"bitfinex";}i:1128;a:4:{s:5:"title";s:13:"BCH-ETH (low)";s:6:"course";s:6:"2.1601";s:4:"code";s:19:"bitfinex_bcheth_low";s:4:"birg";s:8:"bitfinex";}i:1129;a:4:{s:5:"title";s:14:"BCH-ETH (high)";s:6:"course";s:5:"2.162";s:4:"code";s:20:"bitfinex_bcheth_high";s:4:"birg";s:8:"bitfinex";}i:1130;a:4:{s:5:"title";s:13:"NEO-USD (mid)";s:6:"course";s:7:"16.1255";s:4:"code";s:19:"bitfinex_neousd_mid";s:4:"birg";s:8:"bitfinex";}i:1131;a:4:{s:5:"title";s:13:"NEO-USD (bid)";s:6:"course";s:6:"16.121";s:4:"code";s:19:"bitfinex_neousd_bid";s:4:"birg";s:8:"bitfinex";}i:1132;a:4:{s:5:"title";s:13:"NEO-USD (ask)";s:6:"course";s:5:"16.13";s:4:"code";s:19:"bitfinex_neousd_ask";s:4:"birg";s:8:"bitfinex";}i:1133;a:4:{s:5:"title";s:20:"NEO-USD (last_price)";s:6:"course";s:6:"16.129";s:4:"code";s:26:"bitfinex_neousd_last_price";s:4:"birg";s:8:"bitfinex";}i:1134;a:4:{s:5:"title";s:13:"NEO-USD (low)";s:6:"course";s:6:"15.962";s:4:"code";s:19:"bitfinex_neousd_low";s:4:"birg";s:8:"bitfinex";}i:1135;a:4:{s:5:"title";s:14:"NEO-USD (high)";s:6:"course";s:5:"16.53";s:4:"code";s:20:"bitfinex_neousd_high";s:4:"birg";s:8:"bitfinex";}i:1136;a:4:{s:5:"title";s:13:"NEO-BTC (mid)";s:6:"course";s:8:"0.002484";s:4:"code";s:19:"bitfinex_neobtc_mid";s:4:"birg";s:8:"bitfinex";}i:1137;a:4:{s:5:"title";s:13:"NEO-BTC (bid)";s:6:"course";s:9:"0.0024827";s:4:"code";s:19:"bitfinex_neobtc_bid";s:4:"birg";s:8:"bitfinex";}i:1138;a:4:{s:5:"title";s:13:"NEO-BTC (ask)";s:6:"course";s:9:"0.0024853";s:4:"code";s:19:"bitfinex_neobtc_ask";s:4:"birg";s:8:"bitfinex";}i:1139;a:4:{s:5:"title";s:20:"NEO-BTC (last_price)";s:6:"course";s:8:"0.002486";s:4:"code";s:26:"bitfinex_neobtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1140;a:4:{s:5:"title";s:13:"NEO-BTC (low)";s:6:"course";s:9:"0.0024809";s:4:"code";s:19:"bitfinex_neobtc_low";s:4:"birg";s:8:"bitfinex";}i:1141;a:4:{s:5:"title";s:14:"NEO-BTC (high)";s:6:"course";s:9:"0.0025267";s:4:"code";s:20:"bitfinex_neobtc_high";s:4:"birg";s:8:"bitfinex";}i:1142;a:4:{s:5:"title";s:13:"NEO-ETH (mid)";s:6:"course";s:7:"0.07917";s:4:"code";s:19:"bitfinex_neoeth_mid";s:4:"birg";s:8:"bitfinex";}i:1143;a:4:{s:5:"title";s:13:"NEO-ETH (bid)";s:6:"course";s:8:"0.079049";s:4:"code";s:19:"bitfinex_neoeth_bid";s:4:"birg";s:8:"bitfinex";}i:1144;a:4:{s:5:"title";s:13:"NEO-ETH (ask)";s:6:"course";s:8:"0.079291";s:4:"code";s:19:"bitfinex_neoeth_ask";s:4:"birg";s:8:"bitfinex";}i:1145;a:4:{s:5:"title";s:20:"NEO-ETH (last_price)";s:6:"course";s:8:"0.079199";s:4:"code";s:26:"bitfinex_neoeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1146;a:4:{s:5:"title";s:13:"NEO-ETH (low)";s:6:"course";s:8:"0.079205";s:4:"code";s:19:"bitfinex_neoeth_low";s:4:"birg";s:8:"bitfinex";}i:1147;a:4:{s:5:"title";s:14:"NEO-ETH (high)";s:6:"course";s:8:"0.080541";s:4:"code";s:20:"bitfinex_neoeth_high";s:4:"birg";s:8:"bitfinex";}i:1148;a:4:{s:5:"title";s:13:"ETP-USD (mid)";s:6:"course";s:7:"3.19845";s:4:"code";s:19:"bitfinex_etpusd_mid";s:4:"birg";s:8:"bitfinex";}i:1149;a:4:{s:5:"title";s:13:"ETP-USD (bid)";s:6:"course";s:6:"3.1984";s:4:"code";s:19:"bitfinex_etpusd_bid";s:4:"birg";s:8:"bitfinex";}i:1150;a:4:{s:5:"title";s:13:"ETP-USD (ask)";s:6:"course";s:6:"3.1985";s:4:"code";s:19:"bitfinex_etpusd_ask";s:4:"birg";s:8:"bitfinex";}i:1151;a:4:{s:5:"title";s:20:"ETP-USD (last_price)";s:6:"course";s:6:"3.1984";s:4:"code";s:26:"bitfinex_etpusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1152;a:4:{s:5:"title";s:13:"ETP-USD (low)";s:6:"course";s:6:"3.1641";s:4:"code";s:19:"bitfinex_etpusd_low";s:4:"birg";s:8:"bitfinex";}i:1153;a:4:{s:5:"title";s:14:"ETP-USD (high)";s:6:"course";s:4:"3.23";s:4:"code";s:20:"bitfinex_etpusd_high";s:4:"birg";s:8:"bitfinex";}i:1154;a:4:{s:5:"title";s:13:"ETP-BTC (mid)";s:6:"course";s:11:"0.000491875";s:4:"code";s:19:"bitfinex_etpbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1155;a:4:{s:5:"title";s:13:"ETP-BTC (bid)";s:6:"course";s:10:"0.00049131";s:4:"code";s:19:"bitfinex_etpbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1156;a:4:{s:5:"title";s:13:"ETP-BTC (ask)";s:6:"course";s:10:"0.00049244";s:4:"code";s:19:"bitfinex_etpbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1157;a:4:{s:5:"title";s:20:"ETP-BTC (last_price)";s:6:"course";s:10:"0.00049185";s:4:"code";s:26:"bitfinex_etpbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1158;a:4:{s:5:"title";s:13:"ETP-BTC (low)";s:6:"course";s:10:"0.00048072";s:4:"code";s:19:"bitfinex_etpbtc_low";s:4:"birg";s:8:"bitfinex";}i:1159;a:4:{s:5:"title";s:14:"ETP-BTC (high)";s:6:"course";s:10:"0.00049185";s:4:"code";s:20:"bitfinex_etpbtc_high";s:4:"birg";s:8:"bitfinex";}i:1160;a:4:{s:5:"title";s:13:"ETP-ETH (mid)";s:6:"course";s:7:"0.01552";s:4:"code";s:19:"bitfinex_etpeth_mid";s:4:"birg";s:8:"bitfinex";}i:1161;a:4:{s:5:"title";s:13:"ETP-ETH (bid)";s:6:"course";s:8:"0.015343";s:4:"code";s:19:"bitfinex_etpeth_bid";s:4:"birg";s:8:"bitfinex";}i:1162;a:4:{s:5:"title";s:13:"ETP-ETH (ask)";s:6:"course";s:8:"0.015697";s:4:"code";s:19:"bitfinex_etpeth_ask";s:4:"birg";s:8:"bitfinex";}i:1163;a:4:{s:5:"title";s:20:"ETP-ETH (last_price)";s:6:"course";s:8:"0.015623";s:4:"code";s:26:"bitfinex_etpeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1164;a:4:{s:5:"title";s:13:"ETP-ETH (low)";s:6:"course";s:8:"0.015315";s:4:"code";s:19:"bitfinex_etpeth_low";s:4:"birg";s:8:"bitfinex";}i:1165;a:4:{s:5:"title";s:14:"ETP-ETH (high)";s:6:"course";s:8:"0.015697";s:4:"code";s:20:"bitfinex_etpeth_high";s:4:"birg";s:8:"bitfinex";}i:1166;a:4:{s:5:"title";s:13:"QTM-USD (mid)";s:6:"course";s:7:"4.05785";s:4:"code";s:19:"bitfinex_qtmusd_mid";s:4:"birg";s:8:"bitfinex";}i:1167;a:4:{s:5:"title";s:13:"QTM-USD (bid)";s:6:"course";s:6:"4.0466";s:4:"code";s:19:"bitfinex_qtmusd_bid";s:4:"birg";s:8:"bitfinex";}i:1168;a:4:{s:5:"title";s:13:"QTM-USD (ask)";s:6:"course";s:6:"4.0691";s:4:"code";s:19:"bitfinex_qtmusd_ask";s:4:"birg";s:8:"bitfinex";}i:1169;a:4:{s:5:"title";s:20:"QTM-USD (last_price)";s:6:"course";s:5:"4.022";s:4:"code";s:26:"bitfinex_qtmusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1170;a:4:{s:5:"title";s:13:"QTM-USD (low)";s:6:"course";s:6:"4.0172";s:4:"code";s:19:"bitfinex_qtmusd_low";s:4:"birg";s:8:"bitfinex";}i:1171;a:4:{s:5:"title";s:14:"QTM-USD (high)";s:6:"course";s:6:"4.1565";s:4:"code";s:20:"bitfinex_qtmusd_high";s:4:"birg";s:8:"bitfinex";}i:1172;a:4:{s:5:"title";s:13:"QTM-BTC (mid)";s:6:"course";s:11:"0.000624525";s:4:"code";s:19:"bitfinex_qtmbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1173;a:4:{s:5:"title";s:13:"QTM-BTC (bid)";s:6:"course";s:10:"0.00062225";s:4:"code";s:19:"bitfinex_qtmbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1174;a:4:{s:5:"title";s:13:"QTM-BTC (ask)";s:6:"course";s:9:"0.0006268";s:4:"code";s:19:"bitfinex_qtmbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1175;a:4:{s:5:"title";s:20:"QTM-BTC (last_price)";s:6:"course";s:10:"0.00062749";s:4:"code";s:26:"bitfinex_qtmbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1176;a:4:{s:5:"title";s:13:"QTM-BTC (low)";s:6:"course";s:10:"0.00061792";s:4:"code";s:19:"bitfinex_qtmbtc_low";s:4:"birg";s:8:"bitfinex";}i:1177;a:4:{s:5:"title";s:14:"QTM-BTC (high)";s:6:"course";s:10:"0.00063703";s:4:"code";s:20:"bitfinex_qtmbtc_high";s:4:"birg";s:8:"bitfinex";}i:1178;a:4:{s:5:"title";s:13:"QTM-ETH (mid)";s:6:"course";s:9:"0.0199335";s:4:"code";s:19:"bitfinex_qtmeth_mid";s:4:"birg";s:8:"bitfinex";}i:1179;a:4:{s:5:"title";s:13:"QTM-ETH (bid)";s:6:"course";s:8:"0.019841";s:4:"code";s:19:"bitfinex_qtmeth_bid";s:4:"birg";s:8:"bitfinex";}i:1180;a:4:{s:5:"title";s:13:"QTM-ETH (ask)";s:6:"course";s:8:"0.020026";s:4:"code";s:19:"bitfinex_qtmeth_ask";s:4:"birg";s:8:"bitfinex";}i:1181;a:4:{s:5:"title";s:20:"QTM-ETH (last_price)";s:6:"course";s:8:"0.019782";s:4:"code";s:26:"bitfinex_qtmeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1182;a:4:{s:5:"title";s:13:"QTM-ETH (low)";s:6:"course";s:8:"0.019782";s:4:"code";s:19:"bitfinex_qtmeth_low";s:4:"birg";s:8:"bitfinex";}i:1183;a:4:{s:5:"title";s:14:"QTM-ETH (high)";s:6:"course";s:8:"0.020202";s:4:"code";s:20:"bitfinex_qtmeth_high";s:4:"birg";s:8:"bitfinex";}i:1184;a:4:{s:5:"title";s:13:"AVT-USD (mid)";s:6:"course";s:7:"0.38949";s:4:"code";s:19:"bitfinex_avtusd_mid";s:4:"birg";s:8:"bitfinex";}i:1185;a:4:{s:5:"title";s:13:"AVT-USD (bid)";s:6:"course";s:4:"0.38";s:4:"code";s:19:"bitfinex_avtusd_bid";s:4:"birg";s:8:"bitfinex";}i:1186;a:4:{s:5:"title";s:13:"AVT-USD (ask)";s:6:"course";s:7:"0.39898";s:4:"code";s:19:"bitfinex_avtusd_ask";s:4:"birg";s:8:"bitfinex";}i:1187;a:4:{s:5:"title";s:20:"AVT-USD (last_price)";s:6:"course";s:4:"0.38";s:4:"code";s:26:"bitfinex_avtusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1188;a:4:{s:5:"title";s:13:"AVT-USD (low)";s:6:"course";s:4:"0.38";s:4:"code";s:19:"bitfinex_avtusd_low";s:4:"birg";s:8:"bitfinex";}i:1189;a:4:{s:5:"title";s:14:"AVT-USD (high)";s:6:"course";s:7:"0.39682";s:4:"code";s:20:"bitfinex_avtusd_high";s:4:"birg";s:8:"bitfinex";}i:1190;a:4:{s:5:"title";s:13:"AVT-BTC (mid)";s:6:"course";s:10:"0.00006063";s:4:"code";s:19:"bitfinex_avtbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1191;a:4:{s:5:"title";s:13:"AVT-BTC (bid)";s:6:"course";s:10:"0.00005826";s:4:"code";s:19:"bitfinex_avtbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1192;a:4:{s:5:"title";s:13:"AVT-BTC (ask)";s:6:"course";s:8:"0.000063";s:4:"code";s:19:"bitfinex_avtbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1193;a:4:{s:5:"title";s:20:"AVT-BTC (last_price)";s:6:"course";s:10:"0.00006293";s:4:"code";s:26:"bitfinex_avtbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1194;a:4:{s:5:"title";s:13:"AVT-BTC (low)";s:6:"course";s:10:"0.00006293";s:4:"code";s:19:"bitfinex_avtbtc_low";s:4:"birg";s:8:"bitfinex";}i:1195;a:4:{s:5:"title";s:14:"AVT-BTC (high)";s:6:"course";s:10:"0.00006293";s:4:"code";s:20:"bitfinex_avtbtc_high";s:4:"birg";s:8:"bitfinex";}i:1196;a:4:{s:5:"title";s:13:"AVT-ETH (mid)";s:6:"course";s:10:"0.00186855";s:4:"code";s:19:"bitfinex_avteth_mid";s:4:"birg";s:8:"bitfinex";}i:1197;a:4:{s:5:"title";s:13:"AVT-ETH (bid)";s:6:"course";s:9:"0.0018621";s:4:"code";s:19:"bitfinex_avteth_bid";s:4:"birg";s:8:"bitfinex";}i:1198;a:4:{s:5:"title";s:13:"AVT-ETH (ask)";s:6:"course";s:8:"0.001875";s:4:"code";s:19:"bitfinex_avteth_ask";s:4:"birg";s:8:"bitfinex";}i:1199;a:4:{s:5:"title";s:20:"AVT-ETH (last_price)";s:6:"course";s:9:"0.0018579";s:4:"code";s:26:"bitfinex_avteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1200;a:4:{s:5:"title";s:13:"AVT-ETH (low)";s:6:"course";s:9:"0.0018579";s:4:"code";s:19:"bitfinex_avteth_low";s:4:"birg";s:8:"bitfinex";}i:1201;a:4:{s:5:"title";s:14:"AVT-ETH (high)";s:6:"course";s:9:"0.0018579";s:4:"code";s:20:"bitfinex_avteth_high";s:4:"birg";s:8:"bitfinex";}i:1202;a:4:{s:5:"title";s:13:"EDO-USD (mid)";s:6:"course";s:6:"1.2671";s:4:"code";s:19:"bitfinex_edousd_mid";s:4:"birg";s:8:"bitfinex";}i:1203;a:4:{s:5:"title";s:13:"EDO-USD (bid)";s:6:"course";s:6:"1.2661";s:4:"code";s:19:"bitfinex_edousd_bid";s:4:"birg";s:8:"bitfinex";}i:1204;a:4:{s:5:"title";s:13:"EDO-USD (ask)";s:6:"course";s:6:"1.2681";s:4:"code";s:19:"bitfinex_edousd_ask";s:4:"birg";s:8:"bitfinex";}i:1205;a:4:{s:5:"title";s:20:"EDO-USD (last_price)";s:6:"course";s:6:"1.2647";s:4:"code";s:26:"bitfinex_edousd_last_price";s:4:"birg";s:8:"bitfinex";}i:1206;a:4:{s:5:"title";s:13:"EDO-USD (low)";s:6:"course";s:6:"1.2012";s:4:"code";s:19:"bitfinex_edousd_low";s:4:"birg";s:8:"bitfinex";}i:1207;a:4:{s:5:"title";s:14:"EDO-USD (high)";s:6:"course";s:4:"1.29";s:4:"code";s:20:"bitfinex_edousd_high";s:4:"birg";s:8:"bitfinex";}i:1208;a:4:{s:5:"title";s:13:"EDO-BTC (mid)";s:6:"course";s:10:"0.00019503";s:4:"code";s:19:"bitfinex_edobtc_mid";s:4:"birg";s:8:"bitfinex";}i:1209;a:4:{s:5:"title";s:13:"EDO-BTC (bid)";s:6:"course";s:9:"0.0001942";s:4:"code";s:19:"bitfinex_edobtc_bid";s:4:"birg";s:8:"bitfinex";}i:1210;a:4:{s:5:"title";s:13:"EDO-BTC (ask)";s:6:"course";s:10:"0.00019586";s:4:"code";s:19:"bitfinex_edobtc_ask";s:4:"birg";s:8:"bitfinex";}i:1211;a:4:{s:5:"title";s:20:"EDO-BTC (last_price)";s:6:"course";s:10:"0.00019467";s:4:"code";s:26:"bitfinex_edobtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1212;a:4:{s:5:"title";s:13:"EDO-BTC (low)";s:6:"course";s:9:"0.0001839";s:4:"code";s:19:"bitfinex_edobtc_low";s:4:"birg";s:8:"bitfinex";}i:1213;a:4:{s:5:"title";s:14:"EDO-BTC (high)";s:6:"course";s:9:"0.0001969";s:4:"code";s:20:"bitfinex_edobtc_high";s:4:"birg";s:8:"bitfinex";}i:1214;a:4:{s:5:"title";s:13:"EDO-ETH (mid)";s:6:"course";s:10:"0.00623975";s:4:"code";s:19:"bitfinex_edoeth_mid";s:4:"birg";s:8:"bitfinex";}i:1215;a:4:{s:5:"title";s:13:"EDO-ETH (bid)";s:6:"course";s:9:"0.0062295";s:4:"code";s:19:"bitfinex_edoeth_bid";s:4:"birg";s:8:"bitfinex";}i:1216;a:4:{s:5:"title";s:13:"EDO-ETH (ask)";s:6:"course";s:7:"0.00625";s:4:"code";s:19:"bitfinex_edoeth_ask";s:4:"birg";s:8:"bitfinex";}i:1217;a:4:{s:5:"title";s:20:"EDO-ETH (last_price)";s:6:"course";s:9:"0.0062295";s:4:"code";s:26:"bitfinex_edoeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1218;a:4:{s:5:"title";s:13:"EDO-ETH (low)";s:6:"course";s:9:"0.0059368";s:4:"code";s:19:"bitfinex_edoeth_low";s:4:"birg";s:8:"bitfinex";}i:1219;a:4:{s:5:"title";s:14:"EDO-ETH (high)";s:6:"course";s:9:"0.0062295";s:4:"code";s:20:"bitfinex_edoeth_high";s:4:"birg";s:8:"bitfinex";}i:1220;a:4:{s:5:"title";s:13:"BTG-USD (mid)";s:6:"course";s:7:"27.0355";s:4:"code";s:19:"bitfinex_btgusd_mid";s:4:"birg";s:8:"bitfinex";}i:1221;a:4:{s:5:"title";s:13:"BTG-USD (bid)";s:6:"course";s:6:"27.018";s:4:"code";s:19:"bitfinex_btgusd_bid";s:4:"birg";s:8:"bitfinex";}i:1222;a:4:{s:5:"title";s:13:"BTG-USD (ask)";s:6:"course";s:6:"27.053";s:4:"code";s:19:"bitfinex_btgusd_ask";s:4:"birg";s:8:"bitfinex";}i:1223;a:4:{s:5:"title";s:20:"BTG-USD (last_price)";s:6:"course";s:5:"27.02";s:4:"code";s:26:"bitfinex_btgusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1224;a:4:{s:5:"title";s:13:"BTG-USD (low)";s:6:"course";s:5:"27.02";s:4:"code";s:19:"bitfinex_btgusd_low";s:4:"birg";s:8:"bitfinex";}i:1225;a:4:{s:5:"title";s:14:"BTG-USD (high)";s:6:"course";s:6:"27.351";s:4:"code";s:20:"bitfinex_btgusd_high";s:4:"birg";s:8:"bitfinex";}i:1226;a:4:{s:5:"title";s:13:"BTG-BTC (mid)";s:6:"course";s:10:"0.00415975";s:4:"code";s:19:"bitfinex_btgbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1227;a:4:{s:5:"title";s:13:"BTG-BTC (bid)";s:6:"course";s:9:"0.0041552";s:4:"code";s:19:"bitfinex_btgbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1228;a:4:{s:5:"title";s:13:"BTG-BTC (ask)";s:6:"course";s:9:"0.0041643";s:4:"code";s:19:"bitfinex_btgbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1229;a:4:{s:5:"title";s:20:"BTG-BTC (last_price)";s:6:"course";s:9:"0.0041542";s:4:"code";s:26:"bitfinex_btgbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1230;a:4:{s:5:"title";s:13:"BTG-BTC (low)";s:6:"course";s:8:"0.004137";s:4:"code";s:19:"bitfinex_btgbtc_low";s:4:"birg";s:8:"bitfinex";}i:1231;a:4:{s:5:"title";s:14:"BTG-BTC (high)";s:6:"course";s:9:"0.0041773";s:4:"code";s:20:"bitfinex_btgbtc_high";s:4:"birg";s:8:"bitfinex";}i:1232;a:4:{s:5:"title";s:13:"DAT-USD (mid)";s:6:"course";s:8:"0.040179";s:4:"code";s:19:"bitfinex_datusd_mid";s:4:"birg";s:8:"bitfinex";}i:1233;a:4:{s:5:"title";s:13:"DAT-USD (bid)";s:6:"course";s:8:"0.039003";s:4:"code";s:19:"bitfinex_datusd_bid";s:4:"birg";s:8:"bitfinex";}i:1234;a:4:{s:5:"title";s:13:"DAT-USD (ask)";s:6:"course";s:8:"0.041355";s:4:"code";s:19:"bitfinex_datusd_ask";s:4:"birg";s:8:"bitfinex";}i:1235;a:4:{s:5:"title";s:20:"DAT-USD (last_price)";s:6:"course";s:5:"0.039";s:4:"code";s:26:"bitfinex_datusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1236;a:4:{s:5:"title";s:13:"DAT-USD (low)";s:6:"course";s:5:"0.039";s:4:"code";s:19:"bitfinex_datusd_low";s:4:"birg";s:8:"bitfinex";}i:1237;a:4:{s:5:"title";s:14:"DAT-USD (high)";s:6:"course";s:8:"0.042209";s:4:"code";s:20:"bitfinex_datusd_high";s:4:"birg";s:8:"bitfinex";}i:1238;a:4:{s:5:"title";s:13:"DAT-BTC (mid)";s:6:"course";s:10:"0.00000624";s:4:"code";s:19:"bitfinex_datbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1239;a:4:{s:5:"title";s:13:"DAT-BTC (bid)";s:6:"course";s:10:"0.00000608";s:4:"code";s:19:"bitfinex_datbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1240;a:4:{s:5:"title";s:13:"DAT-BTC (ask)";s:6:"course";s:9:"0.0000064";s:4:"code";s:19:"bitfinex_datbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1241;a:4:{s:5:"title";s:20:"DAT-BTC (last_price)";s:6:"course";s:10:"0.00000616";s:4:"code";s:26:"bitfinex_datbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1242;a:4:{s:5:"title";s:13:"DAT-BTC (low)";s:6:"course";s:10:"0.00000609";s:4:"code";s:19:"bitfinex_datbtc_low";s:4:"birg";s:8:"bitfinex";}i:1243;a:4:{s:5:"title";s:14:"DAT-BTC (high)";s:6:"course";s:10:"0.00000648";s:4:"code";s:20:"bitfinex_datbtc_high";s:4:"birg";s:8:"bitfinex";}i:1244;a:4:{s:5:"title";s:13:"DAT-ETH (mid)";s:6:"course";s:11:"0.000197975";s:4:"code";s:19:"bitfinex_dateth_mid";s:4:"birg";s:8:"bitfinex";}i:1245;a:4:{s:5:"title";s:13:"DAT-ETH (bid)";s:6:"course";s:10:"0.00019296";s:4:"code";s:19:"bitfinex_dateth_bid";s:4:"birg";s:8:"bitfinex";}i:1246;a:4:{s:5:"title";s:13:"DAT-ETH (ask)";s:6:"course";s:10:"0.00020299";s:4:"code";s:19:"bitfinex_dateth_ask";s:4:"birg";s:8:"bitfinex";}i:1247;a:4:{s:5:"title";s:20:"DAT-ETH (last_price)";s:6:"course";s:10:"0.00020251";s:4:"code";s:26:"bitfinex_dateth_last_price";s:4:"birg";s:8:"bitfinex";}i:1248;a:4:{s:5:"title";s:13:"DAT-ETH (low)";s:6:"course";s:7:"0.00019";s:4:"code";s:19:"bitfinex_dateth_low";s:4:"birg";s:8:"bitfinex";}i:1249;a:4:{s:5:"title";s:14:"DAT-ETH (high)";s:6:"course";s:10:"0.00020539";s:4:"code";s:20:"bitfinex_dateth_high";s:4:"birg";s:8:"bitfinex";}i:1250;a:4:{s:5:"title";s:13:"QSH-USD (mid)";s:6:"course";s:7:"0.21993";s:4:"code";s:19:"bitfinex_qshusd_mid";s:4:"birg";s:8:"bitfinex";}i:1251;a:4:{s:5:"title";s:13:"QSH-USD (bid)";s:6:"course";s:7:"0.21612";s:4:"code";s:19:"bitfinex_qshusd_bid";s:4:"birg";s:8:"bitfinex";}i:1252;a:4:{s:5:"title";s:13:"QSH-USD (ask)";s:6:"course";s:7:"0.22374";s:4:"code";s:19:"bitfinex_qshusd_ask";s:4:"birg";s:8:"bitfinex";}i:1253;a:4:{s:5:"title";s:20:"QSH-USD (last_price)";s:6:"course";s:4:"0.22";s:4:"code";s:26:"bitfinex_qshusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1254;a:4:{s:5:"title";s:13:"QSH-USD (low)";s:6:"course";s:5:"0.218";s:4:"code";s:19:"bitfinex_qshusd_low";s:4:"birg";s:8:"bitfinex";}i:1255;a:4:{s:5:"title";s:14:"QSH-USD (high)";s:6:"course";s:7:"0.22733";s:4:"code";s:20:"bitfinex_qshusd_high";s:4:"birg";s:8:"bitfinex";}i:1256;a:4:{s:5:"title";s:13:"QSH-BTC (mid)";s:6:"course";s:10:"0.00003375";s:4:"code";s:19:"bitfinex_qshbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1257;a:4:{s:5:"title";s:13:"QSH-BTC (bid)";s:6:"course";s:9:"0.0000335";s:4:"code";s:19:"bitfinex_qshbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1258;a:4:{s:5:"title";s:13:"QSH-BTC (ask)";s:6:"course";s:8:"0.000034";s:4:"code";s:19:"bitfinex_qshbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1259;a:4:{s:5:"title";s:20:"QSH-BTC (last_price)";s:6:"course";s:9:"0.0000335";s:4:"code";s:26:"bitfinex_qshbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1260;a:4:{s:5:"title";s:13:"QSH-BTC (low)";s:6:"course";s:9:"0.0000335";s:4:"code";s:19:"bitfinex_qshbtc_low";s:4:"birg";s:8:"bitfinex";}i:1261;a:4:{s:5:"title";s:14:"QSH-BTC (high)";s:6:"course";s:8:"0.000034";s:4:"code";s:20:"bitfinex_qshbtc_high";s:4:"birg";s:8:"bitfinex";}i:1262;a:4:{s:5:"title";s:13:"QSH-ETH (mid)";s:6:"course";s:10:"0.00108395";s:4:"code";s:19:"bitfinex_qsheth_mid";s:4:"birg";s:8:"bitfinex";}i:1263;a:4:{s:5:"title";s:13:"QSH-ETH (bid)";s:6:"course";s:8:"0.001068";s:4:"code";s:19:"bitfinex_qsheth_bid";s:4:"birg";s:8:"bitfinex";}i:1264;a:4:{s:5:"title";s:13:"QSH-ETH (ask)";s:6:"course";s:9:"0.0010999";s:4:"code";s:19:"bitfinex_qsheth_ask";s:4:"birg";s:8:"bitfinex";}i:1265;a:4:{s:5:"title";s:20:"QSH-ETH (last_price)";s:6:"course";s:8:"0.001067";s:4:"code";s:26:"bitfinex_qsheth_last_price";s:4:"birg";s:8:"bitfinex";}i:1266;a:4:{s:5:"title";s:13:"QSH-ETH (low)";s:6:"course";s:8:"0.001062";s:4:"code";s:19:"bitfinex_qsheth_low";s:4:"birg";s:8:"bitfinex";}i:1267;a:4:{s:5:"title";s:14:"QSH-ETH (high)";s:6:"course";s:8:"0.001067";s:4:"code";s:20:"bitfinex_qsheth_high";s:4:"birg";s:8:"bitfinex";}i:1268;a:4:{s:5:"title";s:13:"YYW-USD (mid)";s:6:"course";s:8:"0.032878";s:4:"code";s:19:"bitfinex_yywusd_mid";s:4:"birg";s:8:"bitfinex";}i:1269;a:4:{s:5:"title";s:13:"YYW-USD (bid)";s:6:"course";s:8:"0.032661";s:4:"code";s:19:"bitfinex_yywusd_bid";s:4:"birg";s:8:"bitfinex";}i:1270;a:4:{s:5:"title";s:13:"YYW-USD (ask)";s:6:"course";s:8:"0.033095";s:4:"code";s:19:"bitfinex_yywusd_ask";s:4:"birg";s:8:"bitfinex";}i:1271;a:4:{s:5:"title";s:20:"YYW-USD (last_price)";s:6:"course";s:8:"0.033076";s:4:"code";s:26:"bitfinex_yywusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1272;a:4:{s:5:"title";s:13:"YYW-USD (low)";s:6:"course";s:8:"0.031872";s:4:"code";s:19:"bitfinex_yywusd_low";s:4:"birg";s:8:"bitfinex";}i:1273;a:4:{s:5:"title";s:14:"YYW-USD (high)";s:6:"course";s:8:"0.036535";s:4:"code";s:20:"bitfinex_yywusd_high";s:4:"birg";s:8:"bitfinex";}i:1274;a:4:{s:5:"title";s:13:"YYW-BTC (mid)";s:6:"course";s:11:"0.000005085";s:4:"code";s:19:"bitfinex_yywbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1275;a:4:{s:5:"title";s:13:"YYW-BTC (bid)";s:6:"course";s:10:"0.00000504";s:4:"code";s:19:"bitfinex_yywbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1276;a:4:{s:5:"title";s:13:"YYW-BTC (ask)";s:6:"course";s:10:"0.00000513";s:4:"code";s:19:"bitfinex_yywbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1277;a:4:{s:5:"title";s:20:"YYW-BTC (last_price)";s:6:"course";s:10:"0.00000502";s:4:"code";s:26:"bitfinex_yywbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1278;a:4:{s:5:"title";s:13:"YYW-BTC (low)";s:6:"course";s:10:"0.00000497";s:4:"code";s:19:"bitfinex_yywbtc_low";s:4:"birg";s:8:"bitfinex";}i:1279;a:4:{s:5:"title";s:14:"YYW-BTC (high)";s:6:"course";s:10:"0.00000557";s:4:"code";s:20:"bitfinex_yywbtc_high";s:4:"birg";s:8:"bitfinex";}i:1280;a:4:{s:5:"title";s:13:"YYW-ETH (mid)";s:6:"course";s:10:"0.00017001";s:4:"code";s:19:"bitfinex_yyweth_mid";s:4:"birg";s:8:"bitfinex";}i:1281;a:4:{s:5:"title";s:13:"YYW-ETH (bid)";s:6:"course";s:10:"0.00016003";s:4:"code";s:19:"bitfinex_yyweth_bid";s:4:"birg";s:8:"bitfinex";}i:1282;a:4:{s:5:"title";s:13:"YYW-ETH (ask)";s:6:"course";s:10:"0.00017999";s:4:"code";s:19:"bitfinex_yyweth_ask";s:4:"birg";s:8:"bitfinex";}i:1283;a:4:{s:5:"title";s:20:"YYW-ETH (last_price)";s:6:"course";s:10:"0.00015965";s:4:"code";s:26:"bitfinex_yyweth_last_price";s:4:"birg";s:8:"bitfinex";}i:1284;a:4:{s:5:"title";s:13:"YYW-ETH (low)";s:6:"course";s:10:"0.00015705";s:4:"code";s:19:"bitfinex_yyweth_low";s:4:"birg";s:8:"bitfinex";}i:1285;a:4:{s:5:"title";s:14:"YYW-ETH (high)";s:6:"course";s:10:"0.00017693";s:4:"code";s:20:"bitfinex_yyweth_high";s:4:"birg";s:8:"bitfinex";}i:1286;a:4:{s:5:"title";s:13:"GNT-USD (mid)";s:6:"course";s:8:"0.175295";s:4:"code";s:19:"bitfinex_gntusd_mid";s:4:"birg";s:8:"bitfinex";}i:1287;a:4:{s:5:"title";s:13:"GNT-USD (bid)";s:6:"course";s:7:"0.17442";s:4:"code";s:19:"bitfinex_gntusd_bid";s:4:"birg";s:8:"bitfinex";}i:1288;a:4:{s:5:"title";s:13:"GNT-USD (ask)";s:6:"course";s:7:"0.17617";s:4:"code";s:19:"bitfinex_gntusd_ask";s:4:"birg";s:8:"bitfinex";}i:1289;a:4:{s:5:"title";s:20:"GNT-USD (last_price)";s:6:"course";s:5:"0.174";s:4:"code";s:26:"bitfinex_gntusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1290;a:4:{s:5:"title";s:13:"GNT-USD (low)";s:6:"course";s:5:"0.174";s:4:"code";s:19:"bitfinex_gntusd_low";s:4:"birg";s:8:"bitfinex";}i:1291;a:4:{s:5:"title";s:14:"GNT-USD (high)";s:6:"course";s:5:"0.189";s:4:"code";s:20:"bitfinex_gntusd_high";s:4:"birg";s:8:"bitfinex";}i:1292;a:4:{s:5:"title";s:13:"GNT-BTC (mid)";s:6:"course";s:8:"0.000027";s:4:"code";s:19:"bitfinex_gntbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1293;a:4:{s:5:"title";s:13:"GNT-BTC (bid)";s:6:"course";s:10:"0.00002688";s:4:"code";s:19:"bitfinex_gntbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1294;a:4:{s:5:"title";s:13:"GNT-BTC (ask)";s:6:"course";s:10:"0.00002712";s:4:"code";s:19:"bitfinex_gntbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1295;a:4:{s:5:"title";s:20:"GNT-BTC (last_price)";s:6:"course";s:10:"0.00002723";s:4:"code";s:26:"bitfinex_gntbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1296;a:4:{s:5:"title";s:13:"GNT-BTC (low)";s:6:"course";s:10:"0.00002723";s:4:"code";s:19:"bitfinex_gntbtc_low";s:4:"birg";s:8:"bitfinex";}i:1297;a:4:{s:5:"title";s:14:"GNT-BTC (high)";s:6:"course";s:10:"0.00002895";s:4:"code";s:20:"bitfinex_gntbtc_high";s:4:"birg";s:8:"bitfinex";}i:1298;a:4:{s:5:"title";s:13:"GNT-ETH (mid)";s:6:"course";s:9:"0.0008611";s:4:"code";s:19:"bitfinex_gnteth_mid";s:4:"birg";s:8:"bitfinex";}i:1299;a:4:{s:5:"title";s:13:"GNT-ETH (bid)";s:6:"course";s:9:"0.0008549";s:4:"code";s:19:"bitfinex_gnteth_bid";s:4:"birg";s:8:"bitfinex";}i:1300;a:4:{s:5:"title";s:13:"GNT-ETH (ask)";s:6:"course";s:9:"0.0008673";s:4:"code";s:19:"bitfinex_gnteth_ask";s:4:"birg";s:8:"bitfinex";}i:1301;a:4:{s:5:"title";s:20:"GNT-ETH (last_price)";s:6:"course";s:10:"0.00090102";s:4:"code";s:26:"bitfinex_gnteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1302;a:4:{s:5:"title";s:13:"GNT-ETH (low)";s:6:"course";s:10:"0.00088848";s:4:"code";s:19:"bitfinex_gnteth_low";s:4:"birg";s:8:"bitfinex";}i:1303;a:4:{s:5:"title";s:14:"GNT-ETH (high)";s:6:"course";s:10:"0.00090331";s:4:"code";s:20:"bitfinex_gnteth_high";s:4:"birg";s:8:"bitfinex";}i:1304;a:4:{s:5:"title";s:13:"SNT-USD (mid)";s:6:"course";s:8:"0.036397";s:4:"code";s:19:"bitfinex_sntusd_mid";s:4:"birg";s:8:"bitfinex";}i:1305;a:4:{s:5:"title";s:13:"SNT-USD (bid)";s:6:"course";s:7:"0.03631";s:4:"code";s:19:"bitfinex_sntusd_bid";s:4:"birg";s:8:"bitfinex";}i:1306;a:4:{s:5:"title";s:13:"SNT-USD (ask)";s:6:"course";s:8:"0.036484";s:4:"code";s:19:"bitfinex_sntusd_ask";s:4:"birg";s:8:"bitfinex";}i:1307;a:4:{s:5:"title";s:20:"SNT-USD (last_price)";s:6:"course";s:7:"0.03631";s:4:"code";s:26:"bitfinex_sntusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1308;a:4:{s:5:"title";s:13:"SNT-USD (low)";s:6:"course";s:7:"0.03631";s:4:"code";s:19:"bitfinex_sntusd_low";s:4:"birg";s:8:"bitfinex";}i:1309;a:4:{s:5:"title";s:14:"SNT-USD (high)";s:6:"course";s:8:"0.036943";s:4:"code";s:20:"bitfinex_sntusd_high";s:4:"birg";s:8:"bitfinex";}i:1310;a:4:{s:5:"title";s:13:"SNT-BTC (mid)";s:6:"course";s:10:"0.00000559";s:4:"code";s:19:"bitfinex_sntbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1311;a:4:{s:5:"title";s:13:"SNT-BTC (bid)";s:6:"course";s:10:"0.00000556";s:4:"code";s:19:"bitfinex_sntbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1312;a:4:{s:5:"title";s:13:"SNT-BTC (ask)";s:6:"course";s:10:"0.00000562";s:4:"code";s:19:"bitfinex_sntbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1313;a:4:{s:5:"title";s:20:"SNT-BTC (last_price)";s:6:"course";s:10:"0.00000554";s:4:"code";s:26:"bitfinex_sntbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1314;a:4:{s:5:"title";s:13:"SNT-BTC (low)";s:6:"course";s:10:"0.00000554";s:4:"code";s:19:"bitfinex_sntbtc_low";s:4:"birg";s:8:"bitfinex";}i:1315;a:4:{s:5:"title";s:14:"SNT-BTC (high)";s:6:"course";s:10:"0.00000566";s:4:"code";s:20:"bitfinex_sntbtc_high";s:4:"birg";s:8:"bitfinex";}i:1316;a:4:{s:5:"title";s:13:"SNT-ETH (mid)";s:6:"course";s:9:"0.0001786";s:4:"code";s:19:"bitfinex_snteth_mid";s:4:"birg";s:8:"bitfinex";}i:1317;a:4:{s:5:"title";s:13:"SNT-ETH (bid)";s:6:"course";s:10:"0.00017778";s:4:"code";s:19:"bitfinex_snteth_bid";s:4:"birg";s:8:"bitfinex";}i:1318;a:4:{s:5:"title";s:13:"SNT-ETH (ask)";s:6:"course";s:10:"0.00017942";s:4:"code";s:19:"bitfinex_snteth_ask";s:4:"birg";s:8:"bitfinex";}i:1319;a:4:{s:5:"title";s:20:"SNT-ETH (last_price)";s:6:"course";s:10:"0.00017778";s:4:"code";s:26:"bitfinex_snteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1320;a:4:{s:5:"title";s:13:"SNT-ETH (low)";s:6:"course";s:10:"0.00017778";s:4:"code";s:19:"bitfinex_snteth_low";s:4:"birg";s:8:"bitfinex";}i:1321;a:4:{s:5:"title";s:14:"SNT-ETH (high)";s:6:"course";s:10:"0.00018053";s:4:"code";s:20:"bitfinex_snteth_high";s:4:"birg";s:8:"bitfinex";}i:1322;a:4:{s:5:"title";s:13:"IOT-EUR (mid)";s:6:"course";s:7:"0.43087";s:4:"code";s:19:"bitfinex_ioteur_mid";s:4:"birg";s:8:"bitfinex";}i:1323;a:4:{s:5:"title";s:13:"IOT-EUR (bid)";s:6:"course";s:7:"0.43083";s:4:"code";s:19:"bitfinex_ioteur_bid";s:4:"birg";s:8:"bitfinex";}i:1324;a:4:{s:5:"title";s:13:"IOT-EUR (ask)";s:6:"course";s:7:"0.43091";s:4:"code";s:19:"bitfinex_ioteur_ask";s:4:"birg";s:8:"bitfinex";}i:1325;a:4:{s:5:"title";s:20:"IOT-EUR (last_price)";s:6:"course";s:10:"0.43107513";s:4:"code";s:26:"bitfinex_ioteur_last_price";s:4:"birg";s:8:"bitfinex";}i:1326;a:4:{s:5:"title";s:13:"IOT-EUR (low)";s:6:"course";s:10:"0.43066373";s:4:"code";s:19:"bitfinex_ioteur_low";s:4:"birg";s:8:"bitfinex";}i:1327;a:4:{s:5:"title";s:14:"IOT-EUR (high)";s:6:"course";s:10:"0.43821101";s:4:"code";s:20:"bitfinex_ioteur_high";s:4:"birg";s:8:"bitfinex";}i:1328;a:4:{s:5:"title";s:13:"BAT-USD (mid)";s:6:"course";s:8:"0.253495";s:4:"code";s:19:"bitfinex_batusd_mid";s:4:"birg";s:8:"bitfinex";}i:1329;a:4:{s:5:"title";s:13:"BAT-USD (bid)";s:6:"course";s:5:"0.252";s:4:"code";s:19:"bitfinex_batusd_bid";s:4:"birg";s:8:"bitfinex";}i:1330;a:4:{s:5:"title";s:13:"BAT-USD (ask)";s:6:"course";s:7:"0.25499";s:4:"code";s:19:"bitfinex_batusd_ask";s:4:"birg";s:8:"bitfinex";}i:1331;a:4:{s:5:"title";s:20:"BAT-USD (last_price)";s:6:"course";s:5:"0.259";s:4:"code";s:26:"bitfinex_batusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1332;a:4:{s:5:"title";s:13:"BAT-USD (low)";s:6:"course";s:7:"0.25725";s:4:"code";s:19:"bitfinex_batusd_low";s:4:"birg";s:8:"bitfinex";}i:1333;a:4:{s:5:"title";s:14:"BAT-USD (high)";s:6:"course";s:7:"0.27215";s:4:"code";s:20:"bitfinex_batusd_high";s:4:"birg";s:8:"bitfinex";}i:1334;a:4:{s:5:"title";s:13:"BAT-BTC (mid)";s:6:"course";s:11:"0.000038995";s:4:"code";s:19:"bitfinex_batbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1335;a:4:{s:5:"title";s:13:"BAT-BTC (bid)";s:6:"course";s:10:"0.00003878";s:4:"code";s:19:"bitfinex_batbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1336;a:4:{s:5:"title";s:13:"BAT-BTC (ask)";s:6:"course";s:10:"0.00003921";s:4:"code";s:19:"bitfinex_batbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1337;a:4:{s:5:"title";s:20:"BAT-BTC (last_price)";s:6:"course";s:10:"0.00003959";s:4:"code";s:26:"bitfinex_batbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1338;a:4:{s:5:"title";s:13:"BAT-BTC (low)";s:6:"course";s:10:"0.00003918";s:4:"code";s:19:"bitfinex_batbtc_low";s:4:"birg";s:8:"bitfinex";}i:1339;a:4:{s:5:"title";s:14:"BAT-BTC (high)";s:6:"course";s:10:"0.00004128";s:4:"code";s:20:"bitfinex_batbtc_high";s:4:"birg";s:8:"bitfinex";}i:1340;a:4:{s:5:"title";s:13:"BAT-ETH (mid)";s:6:"course";s:8:"0.001246";s:4:"code";s:19:"bitfinex_bateth_mid";s:4:"birg";s:8:"bitfinex";}i:1341;a:4:{s:5:"title";s:13:"BAT-ETH (bid)";s:6:"course";s:9:"0.0012377";s:4:"code";s:19:"bitfinex_bateth_bid";s:4:"birg";s:8:"bitfinex";}i:1342;a:4:{s:5:"title";s:13:"BAT-ETH (ask)";s:6:"course";s:9:"0.0012543";s:4:"code";s:19:"bitfinex_bateth_ask";s:4:"birg";s:8:"bitfinex";}i:1343;a:4:{s:5:"title";s:20:"BAT-ETH (last_price)";s:6:"course";s:9:"0.0012558";s:4:"code";s:26:"bitfinex_bateth_last_price";s:4:"birg";s:8:"bitfinex";}i:1344;a:4:{s:5:"title";s:13:"BAT-ETH (low)";s:6:"course";s:9:"0.0012558";s:4:"code";s:19:"bitfinex_bateth_low";s:4:"birg";s:8:"bitfinex";}i:1345;a:4:{s:5:"title";s:14:"BAT-ETH (high)";s:6:"course";s:9:"0.0013194";s:4:"code";s:20:"bitfinex_bateth_high";s:4:"birg";s:8:"bitfinex";}i:1346;a:4:{s:5:"title";s:13:"MNA-USD (mid)";s:6:"course";s:9:"0.0753035";s:4:"code";s:19:"bitfinex_mnausd_mid";s:4:"birg";s:8:"bitfinex";}i:1347;a:4:{s:5:"title";s:13:"MNA-USD (bid)";s:6:"course";s:8:"0.074984";s:4:"code";s:19:"bitfinex_mnausd_bid";s:4:"birg";s:8:"bitfinex";}i:1348;a:4:{s:5:"title";s:13:"MNA-USD (ask)";s:6:"course";s:8:"0.075623";s:4:"code";s:19:"bitfinex_mnausd_ask";s:4:"birg";s:8:"bitfinex";}i:1349;a:4:{s:5:"title";s:20:"MNA-USD (last_price)";s:6:"course";s:8:"0.077208";s:4:"code";s:26:"bitfinex_mnausd_last_price";s:4:"birg";s:8:"bitfinex";}i:1350;a:4:{s:5:"title";s:13:"MNA-USD (low)";s:6:"course";s:8:"0.073971";s:4:"code";s:19:"bitfinex_mnausd_low";s:4:"birg";s:8:"bitfinex";}i:1351;a:4:{s:5:"title";s:14:"MNA-USD (high)";s:6:"course";s:8:"0.077513";s:4:"code";s:20:"bitfinex_mnausd_high";s:4:"birg";s:8:"bitfinex";}i:1352;a:4:{s:5:"title";s:13:"MNA-BTC (mid)";s:6:"course";s:10:"0.00001164";s:4:"code";s:19:"bitfinex_mnabtc_mid";s:4:"birg";s:8:"bitfinex";}i:1353;a:4:{s:5:"title";s:13:"MNA-BTC (bid)";s:6:"course";s:10:"0.00001157";s:4:"code";s:19:"bitfinex_mnabtc_bid";s:4:"birg";s:8:"bitfinex";}i:1354;a:4:{s:5:"title";s:13:"MNA-BTC (ask)";s:6:"course";s:10:"0.00001171";s:4:"code";s:19:"bitfinex_mnabtc_ask";s:4:"birg";s:8:"bitfinex";}i:1355;a:4:{s:5:"title";s:20:"MNA-BTC (last_price)";s:6:"course";s:10:"0.00001181";s:4:"code";s:26:"bitfinex_mnabtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1356;a:4:{s:5:"title";s:13:"MNA-BTC (low)";s:6:"course";s:10:"0.00001123";s:4:"code";s:19:"bitfinex_mnabtc_low";s:4:"birg";s:8:"bitfinex";}i:1357;a:4:{s:5:"title";s:14:"MNA-BTC (high)";s:6:"course";s:10:"0.00001186";s:4:"code";s:20:"bitfinex_mnabtc_high";s:4:"birg";s:8:"bitfinex";}i:1358;a:4:{s:5:"title";s:13:"MNA-ETH (mid)";s:6:"course";s:10:"0.00037268";s:4:"code";s:19:"bitfinex_mnaeth_mid";s:4:"birg";s:8:"bitfinex";}i:1359;a:4:{s:5:"title";s:13:"MNA-ETH (bid)";s:6:"course";s:10:"0.00036848";s:4:"code";s:19:"bitfinex_mnaeth_bid";s:4:"birg";s:8:"bitfinex";}i:1360;a:4:{s:5:"title";s:13:"MNA-ETH (ask)";s:6:"course";s:10:"0.00037688";s:4:"code";s:19:"bitfinex_mnaeth_ask";s:4:"birg";s:8:"bitfinex";}i:1361;a:4:{s:5:"title";s:20:"MNA-ETH (last_price)";s:6:"course";s:10:"0.00037562";s:4:"code";s:26:"bitfinex_mnaeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1362;a:4:{s:5:"title";s:13:"MNA-ETH (low)";s:6:"course";s:10:"0.00035503";s:4:"code";s:19:"bitfinex_mnaeth_low";s:4:"birg";s:8:"bitfinex";}i:1363;a:4:{s:5:"title";s:14:"MNA-ETH (high)";s:6:"course";s:10:"0.00037562";s:4:"code";s:20:"bitfinex_mnaeth_high";s:4:"birg";s:8:"bitfinex";}i:1364;a:4:{s:5:"title";s:13:"FUN-USD (mid)";s:6:"course";s:9:"0.0136955";s:4:"code";s:19:"bitfinex_funusd_mid";s:4:"birg";s:8:"bitfinex";}i:1365;a:4:{s:5:"title";s:13:"FUN-USD (bid)";s:6:"course";s:8:"0.013583";s:4:"code";s:19:"bitfinex_funusd_bid";s:4:"birg";s:8:"bitfinex";}i:1366;a:4:{s:5:"title";s:13:"FUN-USD (ask)";s:6:"course";s:8:"0.013808";s:4:"code";s:19:"bitfinex_funusd_ask";s:4:"birg";s:8:"bitfinex";}i:1367;a:4:{s:5:"title";s:20:"FUN-USD (last_price)";s:6:"course";s:8:"0.013846";s:4:"code";s:26:"bitfinex_funusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1368;a:4:{s:5:"title";s:13:"FUN-USD (low)";s:6:"course";s:8:"0.013846";s:4:"code";s:19:"bitfinex_funusd_low";s:4:"birg";s:8:"bitfinex";}i:1369;a:4:{s:5:"title";s:14:"FUN-USD (high)";s:6:"course";s:8:"0.014399";s:4:"code";s:20:"bitfinex_funusd_high";s:4:"birg";s:8:"bitfinex";}i:1370;a:4:{s:5:"title";s:13:"FUN-BTC (mid)";s:6:"course";s:10:"0.00000211";s:4:"code";s:19:"bitfinex_funbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1371;a:4:{s:5:"title";s:13:"FUN-BTC (bid)";s:6:"course";s:9:"0.0000021";s:4:"code";s:19:"bitfinex_funbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1372;a:4:{s:5:"title";s:13:"FUN-BTC (ask)";s:6:"course";s:10:"0.00000212";s:4:"code";s:19:"bitfinex_funbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1373;a:4:{s:5:"title";s:20:"FUN-BTC (last_price)";s:6:"course";s:10:"0.00000211";s:4:"code";s:26:"bitfinex_funbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1374;a:4:{s:5:"title";s:13:"FUN-BTC (low)";s:6:"course";s:10:"0.00000212";s:4:"code";s:19:"bitfinex_funbtc_low";s:4:"birg";s:8:"bitfinex";}i:1375;a:4:{s:5:"title";s:14:"FUN-BTC (high)";s:6:"course";s:10:"0.00000217";s:4:"code";s:20:"bitfinex_funbtc_high";s:4:"birg";s:8:"bitfinex";}i:1376;a:4:{s:5:"title";s:13:"FUN-ETH (mid)";s:6:"course";s:11:"0.000069935";s:4:"code";s:19:"bitfinex_funeth_mid";s:4:"birg";s:8:"bitfinex";}i:1377;a:4:{s:5:"title";s:13:"FUN-ETH (bid)";s:6:"course";s:10:"0.00006691";s:4:"code";s:19:"bitfinex_funeth_bid";s:4:"birg";s:8:"bitfinex";}i:1378;a:4:{s:5:"title";s:13:"FUN-ETH (ask)";s:6:"course";s:10:"0.00007296";s:4:"code";s:19:"bitfinex_funeth_ask";s:4:"birg";s:8:"bitfinex";}i:1379;a:4:{s:5:"title";s:20:"FUN-ETH (last_price)";s:6:"course";s:10:"0.00006691";s:4:"code";s:26:"bitfinex_funeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1380;a:4:{s:5:"title";s:13:"FUN-ETH (low)";s:6:"course";s:10:"0.00006691";s:4:"code";s:19:"bitfinex_funeth_low";s:4:"birg";s:8:"bitfinex";}i:1381;a:4:{s:5:"title";s:14:"FUN-ETH (high)";s:6:"course";s:10:"0.00007298";s:4:"code";s:20:"bitfinex_funeth_high";s:4:"birg";s:8:"bitfinex";}i:1382;a:4:{s:5:"title";s:13:"ZRX-USD (mid)";s:6:"course";s:8:"0.804915";s:4:"code";s:19:"bitfinex_zrxusd_mid";s:4:"birg";s:8:"bitfinex";}i:1383;a:4:{s:5:"title";s:13:"ZRX-USD (bid)";s:6:"course";s:7:"0.80401";s:4:"code";s:19:"bitfinex_zrxusd_bid";s:4:"birg";s:8:"bitfinex";}i:1384;a:4:{s:5:"title";s:13:"ZRX-USD (ask)";s:6:"course";s:7:"0.80582";s:4:"code";s:19:"bitfinex_zrxusd_ask";s:4:"birg";s:8:"bitfinex";}i:1385;a:4:{s:5:"title";s:20:"ZRX-USD (last_price)";s:6:"course";s:7:"0.80599";s:4:"code";s:26:"bitfinex_zrxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1386;a:4:{s:5:"title";s:13:"ZRX-USD (low)";s:6:"course";s:7:"0.80258";s:4:"code";s:19:"bitfinex_zrxusd_low";s:4:"birg";s:8:"bitfinex";}i:1387;a:4:{s:5:"title";s:14:"ZRX-USD (high)";s:6:"course";s:7:"0.83242";s:4:"code";s:20:"bitfinex_zrxusd_high";s:4:"birg";s:8:"bitfinex";}i:1388;a:4:{s:5:"title";s:13:"ZRX-BTC (mid)";s:6:"course";s:11:"0.000123815";s:4:"code";s:19:"bitfinex_zrxbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1389;a:4:{s:5:"title";s:13:"ZRX-BTC (bid)";s:6:"course";s:10:"0.00012355";s:4:"code";s:19:"bitfinex_zrxbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1390;a:4:{s:5:"title";s:13:"ZRX-BTC (ask)";s:6:"course";s:10:"0.00012408";s:4:"code";s:19:"bitfinex_zrxbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1391;a:4:{s:5:"title";s:20:"ZRX-BTC (last_price)";s:6:"course";s:8:"0.000124";s:4:"code";s:26:"bitfinex_zrxbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1392;a:4:{s:5:"title";s:13:"ZRX-BTC (low)";s:6:"course";s:8:"0.000124";s:4:"code";s:19:"bitfinex_zrxbtc_low";s:4:"birg";s:8:"bitfinex";}i:1393;a:4:{s:5:"title";s:14:"ZRX-BTC (high)";s:6:"course";s:9:"0.0001269";s:4:"code";s:20:"bitfinex_zrxbtc_high";s:4:"birg";s:8:"bitfinex";}i:1394;a:4:{s:5:"title";s:13:"ZRX-ETH (mid)";s:6:"course";s:8:"0.003944";s:4:"code";s:19:"bitfinex_zrxeth_mid";s:4:"birg";s:8:"bitfinex";}i:1395;a:4:{s:5:"title";s:13:"ZRX-ETH (bid)";s:6:"course";s:9:"0.0039298";s:4:"code";s:19:"bitfinex_zrxeth_bid";s:4:"birg";s:8:"bitfinex";}i:1396;a:4:{s:5:"title";s:13:"ZRX-ETH (ask)";s:6:"course";s:9:"0.0039582";s:4:"code";s:19:"bitfinex_zrxeth_ask";s:4:"birg";s:8:"bitfinex";}i:1397;a:4:{s:5:"title";s:20:"ZRX-ETH (last_price)";s:6:"course";s:9:"0.0039477";s:4:"code";s:26:"bitfinex_zrxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1398;a:4:{s:5:"title";s:13:"ZRX-ETH (low)";s:6:"course";s:9:"0.0039412";s:4:"code";s:19:"bitfinex_zrxeth_low";s:4:"birg";s:8:"bitfinex";}i:1399;a:4:{s:5:"title";s:14:"ZRX-ETH (high)";s:6:"course";s:9:"0.0040536";s:4:"code";s:20:"bitfinex_zrxeth_high";s:4:"birg";s:8:"bitfinex";}i:1400;a:4:{s:5:"title";s:13:"TNB-USD (mid)";s:6:"course";s:8:"0.010219";s:4:"code";s:19:"bitfinex_tnbusd_mid";s:4:"birg";s:8:"bitfinex";}i:1401;a:4:{s:5:"title";s:13:"TNB-USD (bid)";s:6:"course";s:8:"0.010138";s:4:"code";s:19:"bitfinex_tnbusd_bid";s:4:"birg";s:8:"bitfinex";}i:1402;a:4:{s:5:"title";s:13:"TNB-USD (ask)";s:6:"course";s:6:"0.0103";s:4:"code";s:19:"bitfinex_tnbusd_ask";s:4:"birg";s:8:"bitfinex";}i:1403;a:4:{s:5:"title";s:20:"TNB-USD (last_price)";s:6:"course";s:8:"0.010138";s:4:"code";s:26:"bitfinex_tnbusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1404;a:4:{s:5:"title";s:13:"TNB-USD (low)";s:6:"course";s:8:"0.010001";s:4:"code";s:19:"bitfinex_tnbusd_low";s:4:"birg";s:8:"bitfinex";}i:1405;a:4:{s:5:"title";s:14:"TNB-USD (high)";s:6:"course";s:8:"0.010998";s:4:"code";s:20:"bitfinex_tnbusd_high";s:4:"birg";s:8:"bitfinex";}i:1406;a:4:{s:5:"title";s:13:"TNB-BTC (mid)";s:6:"course";s:11:"0.000001555";s:4:"code";s:19:"bitfinex_tnbbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1407;a:4:{s:5:"title";s:13:"TNB-BTC (bid)";s:6:"course";s:10:"0.00000136";s:4:"code";s:19:"bitfinex_tnbbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1408;a:4:{s:5:"title";s:13:"TNB-BTC (ask)";s:6:"course";s:10:"0.00000175";s:4:"code";s:19:"bitfinex_tnbbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1409;a:4:{s:5:"title";s:20:"TNB-BTC (last_price)";s:6:"course";s:10:"0.00000158";s:4:"code";s:26:"bitfinex_tnbbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1410;a:4:{s:5:"title";s:13:"TNB-BTC (low)";s:6:"course";s:10:"0.00000158";s:4:"code";s:19:"bitfinex_tnbbtc_low";s:4:"birg";s:8:"bitfinex";}i:1411;a:4:{s:5:"title";s:14:"TNB-BTC (high)";s:6:"course";s:10:"0.00000158";s:4:"code";s:20:"bitfinex_tnbbtc_high";s:4:"birg";s:8:"bitfinex";}i:1412;a:4:{s:5:"title";s:13:"TNB-ETH (mid)";s:6:"course";s:10:"0.00005198";s:4:"code";s:19:"bitfinex_tnbeth_mid";s:4:"birg";s:8:"bitfinex";}i:1413;a:4:{s:5:"title";s:13:"TNB-ETH (bid)";s:6:"course";s:10:"0.00004501";s:4:"code";s:19:"bitfinex_tnbeth_bid";s:4:"birg";s:8:"bitfinex";}i:1414;a:4:{s:5:"title";s:13:"TNB-ETH (ask)";s:6:"course";s:10:"0.00005895";s:4:"code";s:19:"bitfinex_tnbeth_ask";s:4:"birg";s:8:"bitfinex";}i:1415;a:4:{s:5:"title";s:20:"TNB-ETH (last_price)";s:6:"course";s:8:"0.000052";s:4:"code";s:26:"bitfinex_tnbeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1416;a:4:{s:5:"title";s:13:"SPK-USD (mid)";s:6:"course";s:9:"0.0549565";s:4:"code";s:19:"bitfinex_spkusd_mid";s:4:"birg";s:8:"bitfinex";}i:1417;a:4:{s:5:"title";s:13:"SPK-USD (bid)";s:6:"course";s:5:"0.053";s:4:"code";s:19:"bitfinex_spkusd_bid";s:4:"birg";s:8:"bitfinex";}i:1418;a:4:{s:5:"title";s:13:"SPK-USD (ask)";s:6:"course";s:8:"0.056913";s:4:"code";s:19:"bitfinex_spkusd_ask";s:4:"birg";s:8:"bitfinex";}i:1419;a:4:{s:5:"title";s:20:"SPK-USD (last_price)";s:6:"course";s:8:"0.056913";s:4:"code";s:26:"bitfinex_spkusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1420;a:4:{s:5:"title";s:13:"SPK-USD (low)";s:6:"course";s:8:"0.051003";s:4:"code";s:19:"bitfinex_spkusd_low";s:4:"birg";s:8:"bitfinex";}i:1421;a:4:{s:5:"title";s:14:"SPK-USD (high)";s:6:"course";s:8:"0.056913";s:4:"code";s:20:"bitfinex_spkusd_high";s:4:"birg";s:8:"bitfinex";}i:1422;a:4:{s:5:"title";s:13:"SPK-BTC (mid)";s:6:"course";s:11:"0.000008665";s:4:"code";s:19:"bitfinex_spkbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1423;a:4:{s:5:"title";s:13:"SPK-BTC (bid)";s:6:"course";s:10:"0.00000701";s:4:"code";s:19:"bitfinex_spkbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1424;a:4:{s:5:"title";s:13:"SPK-BTC (ask)";s:6:"course";s:10:"0.00001032";s:4:"code";s:19:"bitfinex_spkbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1425;a:4:{s:5:"title";s:20:"SPK-BTC (last_price)";s:6:"course";s:8:"0.000008";s:4:"code";s:26:"bitfinex_spkbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1426;a:4:{s:5:"title";s:13:"SPK-ETH (mid)";s:6:"course";s:11:"0.000270305";s:4:"code";s:19:"bitfinex_spketh_mid";s:4:"birg";s:8:"bitfinex";}i:1427;a:4:{s:5:"title";s:13:"SPK-ETH (bid)";s:6:"course";s:10:"0.00025068";s:4:"code";s:19:"bitfinex_spketh_bid";s:4:"birg";s:8:"bitfinex";}i:1428;a:4:{s:5:"title";s:13:"SPK-ETH (ask)";s:6:"course";s:10:"0.00028993";s:4:"code";s:19:"bitfinex_spketh_ask";s:4:"birg";s:8:"bitfinex";}i:1429;a:4:{s:5:"title";s:20:"SPK-ETH (last_price)";s:6:"course";s:10:"0.00028951";s:4:"code";s:26:"bitfinex_spketh_last_price";s:4:"birg";s:8:"bitfinex";}i:1430;a:4:{s:5:"title";s:13:"SPK-ETH (low)";s:6:"course";s:8:"0.000275";s:4:"code";s:19:"bitfinex_spketh_low";s:4:"birg";s:8:"bitfinex";}i:1431;a:4:{s:5:"title";s:14:"SPK-ETH (high)";s:6:"course";s:10:"0.00028951";s:4:"code";s:20:"bitfinex_spketh_high";s:4:"birg";s:8:"bitfinex";}i:1432;a:4:{s:5:"title";s:13:"TRX-USD (mid)";s:6:"course";s:8:"0.023448";s:4:"code";s:19:"bitfinex_trxusd_mid";s:4:"birg";s:8:"bitfinex";}i:1433;a:4:{s:5:"title";s:13:"TRX-USD (bid)";s:6:"course";s:8:"0.023403";s:4:"code";s:19:"bitfinex_trxusd_bid";s:4:"birg";s:8:"bitfinex";}i:1434;a:4:{s:5:"title";s:13:"TRX-USD (ask)";s:6:"course";s:8:"0.023493";s:4:"code";s:19:"bitfinex_trxusd_ask";s:4:"birg";s:8:"bitfinex";}i:1435;a:4:{s:5:"title";s:20:"TRX-USD (last_price)";s:6:"course";s:8:"0.023412";s:4:"code";s:26:"bitfinex_trxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1436;a:4:{s:5:"title";s:13:"TRX-USD (low)";s:6:"course";s:8:"0.023396";s:4:"code";s:19:"bitfinex_trxusd_low";s:4:"birg";s:8:"bitfinex";}i:1437;a:4:{s:5:"title";s:14:"TRX-USD (high)";s:6:"course";s:8:"0.023995";s:4:"code";s:20:"bitfinex_trxusd_high";s:4:"birg";s:8:"bitfinex";}i:1438;a:4:{s:5:"title";s:13:"TRX-BTC (mid)";s:6:"course";s:10:"0.00000361";s:4:"code";s:19:"bitfinex_trxbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1439;a:4:{s:5:"title";s:13:"TRX-BTC (bid)";s:6:"course";s:9:"0.0000036";s:4:"code";s:19:"bitfinex_trxbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1440;a:4:{s:5:"title";s:13:"TRX-BTC (ask)";s:6:"course";s:10:"0.00000362";s:4:"code";s:19:"bitfinex_trxbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1441;a:4:{s:5:"title";s:20:"TRX-BTC (last_price)";s:6:"course";s:10:"0.00000361";s:4:"code";s:26:"bitfinex_trxbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1442;a:4:{s:5:"title";s:13:"TRX-BTC (low)";s:6:"course";s:10:"0.00000359";s:4:"code";s:19:"bitfinex_trxbtc_low";s:4:"birg";s:8:"bitfinex";}i:1443;a:4:{s:5:"title";s:14:"TRX-BTC (high)";s:6:"course";s:10:"0.00000368";s:4:"code";s:20:"bitfinex_trxbtc_high";s:4:"birg";s:8:"bitfinex";}i:1444;a:4:{s:5:"title";s:13:"TRX-ETH (mid)";s:6:"course";s:11:"0.000115215";s:4:"code";s:19:"bitfinex_trxeth_mid";s:4:"birg";s:8:"bitfinex";}i:1445;a:4:{s:5:"title";s:13:"TRX-ETH (bid)";s:6:"course";s:10:"0.00011493";s:4:"code";s:19:"bitfinex_trxeth_bid";s:4:"birg";s:8:"bitfinex";}i:1446;a:4:{s:5:"title";s:13:"TRX-ETH (ask)";s:6:"course";s:9:"0.0001155";s:4:"code";s:19:"bitfinex_trxeth_ask";s:4:"birg";s:8:"bitfinex";}i:1447;a:4:{s:5:"title";s:20:"TRX-ETH (last_price)";s:6:"course";s:10:"0.00011504";s:4:"code";s:26:"bitfinex_trxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1448;a:4:{s:5:"title";s:13:"TRX-ETH (low)";s:6:"course";s:10:"0.00011475";s:4:"code";s:19:"bitfinex_trxeth_low";s:4:"birg";s:8:"bitfinex";}i:1449;a:4:{s:5:"title";s:14:"TRX-ETH (high)";s:6:"course";s:10:"0.00011706";s:4:"code";s:20:"bitfinex_trxeth_high";s:4:"birg";s:8:"bitfinex";}i:1450;a:4:{s:5:"title";s:13:"RCN-USD (mid)";s:6:"course";s:8:"0.028021";s:4:"code";s:19:"bitfinex_rcnusd_mid";s:4:"birg";s:8:"bitfinex";}i:1451;a:4:{s:5:"title";s:13:"RCN-USD (bid)";s:6:"course";s:5:"0.028";s:4:"code";s:19:"bitfinex_rcnusd_bid";s:4:"birg";s:8:"bitfinex";}i:1452;a:4:{s:5:"title";s:13:"RCN-USD (ask)";s:6:"course";s:8:"0.028042";s:4:"code";s:19:"bitfinex_rcnusd_ask";s:4:"birg";s:8:"bitfinex";}i:1453;a:4:{s:5:"title";s:20:"RCN-USD (last_price)";s:6:"course";s:5:"0.028";s:4:"code";s:26:"bitfinex_rcnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1454;a:4:{s:5:"title";s:13:"RCN-USD (low)";s:6:"course";s:5:"0.028";s:4:"code";s:19:"bitfinex_rcnusd_low";s:4:"birg";s:8:"bitfinex";}i:1455;a:4:{s:5:"title";s:14:"RCN-USD (high)";s:6:"course";s:8:"0.029845";s:4:"code";s:20:"bitfinex_rcnusd_high";s:4:"birg";s:8:"bitfinex";}i:1456;a:4:{s:5:"title";s:13:"RCN-BTC (mid)";s:6:"course";s:10:"0.00000416";s:4:"code";s:19:"bitfinex_rcnbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1457;a:4:{s:5:"title";s:13:"RCN-BTC (bid)";s:6:"course";s:10:"0.00000401";s:4:"code";s:19:"bitfinex_rcnbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1458;a:4:{s:5:"title";s:13:"RCN-BTC (ask)";s:6:"course";s:10:"0.00000431";s:4:"code";s:19:"bitfinex_rcnbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1459;a:4:{s:5:"title";s:20:"RCN-BTC (last_price)";s:6:"course";s:9:"0.0000045";s:4:"code";s:26:"bitfinex_rcnbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1460;a:4:{s:5:"title";s:13:"RCN-BTC (low)";s:6:"course";s:10:"0.00000446";s:4:"code";s:19:"bitfinex_rcnbtc_low";s:4:"birg";s:8:"bitfinex";}i:1461;a:4:{s:5:"title";s:14:"RCN-BTC (high)";s:6:"course";s:9:"0.0000045";s:4:"code";s:20:"bitfinex_rcnbtc_high";s:4:"birg";s:8:"bitfinex";}i:1462;a:4:{s:5:"title";s:13:"RCN-ETH (mid)";s:6:"course";s:10:"0.00013175";s:4:"code";s:19:"bitfinex_rcneth_mid";s:4:"birg";s:8:"bitfinex";}i:1463;a:4:{s:5:"title";s:13:"RCN-ETH (bid)";s:6:"course";s:9:"0.0000935";s:4:"code";s:19:"bitfinex_rcneth_bid";s:4:"birg";s:8:"bitfinex";}i:1464;a:4:{s:5:"title";s:13:"RCN-ETH (ask)";s:6:"course";s:7:"0.00017";s:4:"code";s:19:"bitfinex_rcneth_ask";s:4:"birg";s:8:"bitfinex";}i:1465;a:4:{s:5:"title";s:20:"RCN-ETH (last_price)";s:6:"course";s:7:"0.00017";s:4:"code";s:26:"bitfinex_rcneth_last_price";s:4:"birg";s:8:"bitfinex";}i:1466;a:4:{s:5:"title";s:13:"RLC-USD (mid)";s:6:"course";s:7:"0.48214";s:4:"code";s:19:"bitfinex_rlcusd_mid";s:4:"birg";s:8:"bitfinex";}i:1467;a:4:{s:5:"title";s:13:"RLC-USD (bid)";s:6:"course";s:7:"0.48107";s:4:"code";s:19:"bitfinex_rlcusd_bid";s:4:"birg";s:8:"bitfinex";}i:1468;a:4:{s:5:"title";s:13:"RLC-USD (ask)";s:6:"course";s:7:"0.48321";s:4:"code";s:19:"bitfinex_rlcusd_ask";s:4:"birg";s:8:"bitfinex";}i:1469;a:4:{s:5:"title";s:20:"RLC-USD (last_price)";s:6:"course";s:6:"0.4881";s:4:"code";s:26:"bitfinex_rlcusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1470;a:4:{s:5:"title";s:13:"RLC-USD (low)";s:6:"course";s:7:"0.48224";s:4:"code";s:19:"bitfinex_rlcusd_low";s:4:"birg";s:8:"bitfinex";}i:1471;a:4:{s:5:"title";s:14:"RLC-USD (high)";s:6:"course";s:7:"0.50584";s:4:"code";s:20:"bitfinex_rlcusd_high";s:4:"birg";s:8:"bitfinex";}i:1472;a:4:{s:5:"title";s:13:"RLC-BTC (mid)";s:6:"course";s:10:"0.00007441";s:4:"code";s:19:"bitfinex_rlcbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1473;a:4:{s:5:"title";s:13:"RLC-BTC (bid)";s:6:"course";s:10:"0.00007426";s:4:"code";s:19:"bitfinex_rlcbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1474;a:4:{s:5:"title";s:13:"RLC-BTC (ask)";s:6:"course";s:10:"0.00007456";s:4:"code";s:19:"bitfinex_rlcbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1475;a:4:{s:5:"title";s:20:"RLC-BTC (last_price)";s:6:"course";s:10:"0.00007493";s:4:"code";s:26:"bitfinex_rlcbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1476;a:4:{s:5:"title";s:13:"RLC-BTC (low)";s:6:"course";s:10:"0.00007463";s:4:"code";s:19:"bitfinex_rlcbtc_low";s:4:"birg";s:8:"bitfinex";}i:1477;a:4:{s:5:"title";s:14:"RLC-BTC (high)";s:6:"course";s:10:"0.00007608";s:4:"code";s:20:"bitfinex_rlcbtc_high";s:4:"birg";s:8:"bitfinex";}i:1478;a:4:{s:5:"title";s:13:"RLC-ETH (mid)";s:6:"course";s:9:"0.0023662";s:4:"code";s:19:"bitfinex_rlceth_mid";s:4:"birg";s:8:"bitfinex";}i:1479;a:4:{s:5:"title";s:13:"RLC-ETH (bid)";s:6:"course";s:8:"0.002362";s:4:"code";s:19:"bitfinex_rlceth_bid";s:4:"birg";s:8:"bitfinex";}i:1480;a:4:{s:5:"title";s:13:"RLC-ETH (ask)";s:6:"course";s:9:"0.0023704";s:4:"code";s:19:"bitfinex_rlceth_ask";s:4:"birg";s:8:"bitfinex";}i:1481;a:4:{s:5:"title";s:20:"RLC-ETH (last_price)";s:6:"course";s:9:"0.0023718";s:4:"code";s:26:"bitfinex_rlceth_last_price";s:4:"birg";s:8:"bitfinex";}i:1482;a:4:{s:5:"title";s:13:"RLC-ETH (low)";s:6:"course";s:9:"0.0023627";s:4:"code";s:19:"bitfinex_rlceth_low";s:4:"birg";s:8:"bitfinex";}i:1483;a:4:{s:5:"title";s:14:"RLC-ETH (high)";s:6:"course";s:9:"0.0025196";s:4:"code";s:20:"bitfinex_rlceth_high";s:4:"birg";s:8:"bitfinex";}i:1484;a:4:{s:5:"title";s:13:"AID-USD (mid)";s:6:"course";s:9:"0.0764805";s:4:"code";s:19:"bitfinex_aidusd_mid";s:4:"birg";s:8:"bitfinex";}i:1485;a:4:{s:5:"title";s:13:"AID-USD (bid)";s:6:"course";s:8:"0.071673";s:4:"code";s:19:"bitfinex_aidusd_bid";s:4:"birg";s:8:"bitfinex";}i:1486;a:4:{s:5:"title";s:13:"AID-USD (ask)";s:6:"course";s:8:"0.081288";s:4:"code";s:19:"bitfinex_aidusd_ask";s:4:"birg";s:8:"bitfinex";}i:1487;a:4:{s:5:"title";s:20:"AID-USD (last_price)";s:6:"course";s:8:"0.073909";s:4:"code";s:26:"bitfinex_aidusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1488;a:4:{s:5:"title";s:13:"AID-USD (low)";s:6:"course";s:7:"0.06142";s:4:"code";s:19:"bitfinex_aidusd_low";s:4:"birg";s:8:"bitfinex";}i:1489;a:4:{s:5:"title";s:14:"AID-USD (high)";s:6:"course";s:8:"0.083497";s:4:"code";s:20:"bitfinex_aidusd_high";s:4:"birg";s:8:"bitfinex";}i:1490;a:4:{s:5:"title";s:13:"AID-BTC (mid)";s:6:"course";s:10:"0.00001318";s:4:"code";s:19:"bitfinex_aidbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1491;a:4:{s:5:"title";s:13:"AID-BTC (bid)";s:6:"course";s:10:"0.00001047";s:4:"code";s:19:"bitfinex_aidbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1492;a:4:{s:5:"title";s:13:"AID-BTC (ask)";s:6:"course";s:10:"0.00001589";s:4:"code";s:19:"bitfinex_aidbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1493;a:4:{s:5:"title";s:20:"AID-BTC (last_price)";s:6:"course";s:10:"0.00001175";s:4:"code";s:26:"bitfinex_aidbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1494;a:4:{s:5:"title";s:13:"AID-BTC (low)";s:6:"course";s:10:"0.00000935";s:4:"code";s:19:"bitfinex_aidbtc_low";s:4:"birg";s:8:"bitfinex";}i:1495;a:4:{s:5:"title";s:14:"AID-BTC (high)";s:6:"course";s:10:"0.00001184";s:4:"code";s:20:"bitfinex_aidbtc_high";s:4:"birg";s:8:"bitfinex";}i:1496;a:4:{s:5:"title";s:13:"AID-ETH (mid)";s:6:"course";s:11:"0.000387675";s:4:"code";s:19:"bitfinex_aideth_mid";s:4:"birg";s:8:"bitfinex";}i:1497;a:4:{s:5:"title";s:13:"AID-ETH (bid)";s:6:"course";s:10:"0.00035114";s:4:"code";s:19:"bitfinex_aideth_bid";s:4:"birg";s:8:"bitfinex";}i:1498;a:4:{s:5:"title";s:13:"AID-ETH (ask)";s:6:"course";s:10:"0.00042421";s:4:"code";s:19:"bitfinex_aideth_ask";s:4:"birg";s:8:"bitfinex";}i:1499;a:4:{s:5:"title";s:20:"AID-ETH (last_price)";s:6:"course";s:10:"0.00042421";s:4:"code";s:26:"bitfinex_aideth_last_price";s:4:"birg";s:8:"bitfinex";}i:1500;a:4:{s:5:"title";s:13:"AID-ETH (low)";s:6:"course";s:7:"0.00035";s:4:"code";s:19:"bitfinex_aideth_low";s:4:"birg";s:8:"bitfinex";}i:1501;a:4:{s:5:"title";s:14:"AID-ETH (high)";s:6:"course";s:10:"0.00042421";s:4:"code";s:20:"bitfinex_aideth_high";s:4:"birg";s:8:"bitfinex";}i:1502;a:4:{s:5:"title";s:13:"SNG-USD (mid)";s:6:"course";s:9:"0.0282735";s:4:"code";s:19:"bitfinex_sngusd_mid";s:4:"birg";s:8:"bitfinex";}i:1503;a:4:{s:5:"title";s:13:"SNG-USD (bid)";s:6:"course";s:8:"0.025049";s:4:"code";s:19:"bitfinex_sngusd_bid";s:4:"birg";s:8:"bitfinex";}i:1504;a:4:{s:5:"title";s:13:"SNG-USD (ask)";s:6:"course";s:8:"0.031498";s:4:"code";s:19:"bitfinex_sngusd_ask";s:4:"birg";s:8:"bitfinex";}i:1505;a:4:{s:5:"title";s:20:"SNG-USD (last_price)";s:6:"course";s:6:"0.0266";s:4:"code";s:26:"bitfinex_sngusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1506;a:4:{s:5:"title";s:13:"SNG-USD (low)";s:6:"course";s:5:"0.025";s:4:"code";s:19:"bitfinex_sngusd_low";s:4:"birg";s:8:"bitfinex";}i:1507;a:4:{s:5:"title";s:14:"SNG-USD (high)";s:6:"course";s:5:"0.031";s:4:"code";s:20:"bitfinex_sngusd_high";s:4:"birg";s:8:"bitfinex";}i:1508;a:4:{s:5:"title";s:13:"SNG-BTC (mid)";s:6:"course";s:10:"0.00000434";s:4:"code";s:19:"bitfinex_sngbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1509;a:4:{s:5:"title";s:13:"SNG-BTC (bid)";s:6:"course";s:10:"0.00000388";s:4:"code";s:19:"bitfinex_sngbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1510;a:4:{s:5:"title";s:13:"SNG-BTC (ask)";s:6:"course";s:9:"0.0000048";s:4:"code";s:19:"bitfinex_sngbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1511;a:4:{s:5:"title";s:20:"SNG-BTC (last_price)";s:6:"course";s:9:"0.0000041";s:4:"code";s:26:"bitfinex_sngbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1512;a:4:{s:5:"title";s:13:"SNG-BTC (low)";s:6:"course";s:10:"0.00000388";s:4:"code";s:19:"bitfinex_sngbtc_low";s:4:"birg";s:8:"bitfinex";}i:1513;a:4:{s:5:"title";s:14:"SNG-BTC (high)";s:6:"course";s:9:"0.0000041";s:4:"code";s:20:"bitfinex_sngbtc_high";s:4:"birg";s:8:"bitfinex";}i:1514;a:4:{s:5:"title";s:13:"SNG-ETH (mid)";s:6:"course";s:10:"0.00012987";s:4:"code";s:19:"bitfinex_sngeth_mid";s:4:"birg";s:8:"bitfinex";}i:1515;a:4:{s:5:"title";s:13:"SNG-ETH (bid)";s:6:"course";s:10:"0.00010004";s:4:"code";s:19:"bitfinex_sngeth_bid";s:4:"birg";s:8:"bitfinex";}i:1516;a:4:{s:5:"title";s:13:"SNG-ETH (ask)";s:6:"course";s:9:"0.0001597";s:4:"code";s:19:"bitfinex_sngeth_ask";s:4:"birg";s:8:"bitfinex";}i:1517;a:4:{s:5:"title";s:20:"SNG-ETH (last_price)";s:6:"course";s:8:"0.000135";s:4:"code";s:26:"bitfinex_sngeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1518;a:4:{s:5:"title";s:13:"REP-USD (mid)";s:6:"course";s:6:"13.729";s:4:"code";s:19:"bitfinex_repusd_mid";s:4:"birg";s:8:"bitfinex";}i:1519;a:4:{s:5:"title";s:13:"REP-USD (bid)";s:6:"course";s:6:"13.664";s:4:"code";s:19:"bitfinex_repusd_bid";s:4:"birg";s:8:"bitfinex";}i:1520;a:4:{s:5:"title";s:13:"REP-USD (ask)";s:6:"course";s:6:"13.794";s:4:"code";s:19:"bitfinex_repusd_ask";s:4:"birg";s:8:"bitfinex";}i:1521;a:4:{s:5:"title";s:20:"REP-USD (last_price)";s:6:"course";s:6:"13.667";s:4:"code";s:26:"bitfinex_repusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1522;a:4:{s:5:"title";s:13:"REP-USD (low)";s:6:"course";s:6:"13.667";s:4:"code";s:19:"bitfinex_repusd_low";s:4:"birg";s:8:"bitfinex";}i:1523;a:4:{s:5:"title";s:14:"REP-USD (high)";s:6:"course";s:4:"13.9";s:4:"code";s:20:"bitfinex_repusd_high";s:4:"birg";s:8:"bitfinex";}i:1524;a:4:{s:5:"title";s:13:"REP-BTC (mid)";s:6:"course";s:9:"0.0020551";s:4:"code";s:19:"bitfinex_repbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1525;a:4:{s:5:"title";s:13:"REP-BTC (bid)";s:6:"course";s:9:"0.0019978";s:4:"code";s:19:"bitfinex_repbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1526;a:4:{s:5:"title";s:13:"REP-BTC (ask)";s:6:"course";s:9:"0.0021124";s:4:"code";s:19:"bitfinex_repbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1527;a:4:{s:5:"title";s:20:"REP-BTC (last_price)";s:6:"course";s:9:"0.0021113";s:4:"code";s:26:"bitfinex_repbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1528;a:4:{s:5:"title";s:13:"REP-ETH (mid)";s:6:"course";s:9:"0.0673035";s:4:"code";s:19:"bitfinex_repeth_mid";s:4:"birg";s:8:"bitfinex";}i:1529;a:4:{s:5:"title";s:13:"REP-ETH (bid)";s:6:"course";s:8:"0.066882";s:4:"code";s:19:"bitfinex_repeth_bid";s:4:"birg";s:8:"bitfinex";}i:1530;a:4:{s:5:"title";s:13:"REP-ETH (ask)";s:6:"course";s:8:"0.067725";s:4:"code";s:19:"bitfinex_repeth_ask";s:4:"birg";s:8:"bitfinex";}i:1531;a:4:{s:5:"title";s:20:"REP-ETH (last_price)";s:6:"course";s:8:"0.067755";s:4:"code";s:26:"bitfinex_repeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1532;a:4:{s:5:"title";s:13:"REP-ETH (low)";s:6:"course";s:8:"0.067621";s:4:"code";s:19:"bitfinex_repeth_low";s:4:"birg";s:8:"bitfinex";}i:1533;a:4:{s:5:"title";s:14:"REP-ETH (high)";s:6:"course";s:8:"0.067755";s:4:"code";s:20:"bitfinex_repeth_high";s:4:"birg";s:8:"bitfinex";}i:1534;a:4:{s:5:"title";s:13:"ELF-USD (mid)";s:6:"course";s:7:"0.33799";s:4:"code";s:19:"bitfinex_elfusd_mid";s:4:"birg";s:8:"bitfinex";}i:1535;a:4:{s:5:"title";s:13:"ELF-USD (bid)";s:6:"course";s:7:"0.33681";s:4:"code";s:19:"bitfinex_elfusd_bid";s:4:"birg";s:8:"bitfinex";}i:1536;a:4:{s:5:"title";s:13:"ELF-USD (ask)";s:6:"course";s:7:"0.33917";s:4:"code";s:19:"bitfinex_elfusd_ask";s:4:"birg";s:8:"bitfinex";}i:1537;a:4:{s:5:"title";s:20:"ELF-USD (last_price)";s:6:"course";s:7:"0.33725";s:4:"code";s:26:"bitfinex_elfusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1538;a:4:{s:5:"title";s:13:"ELF-USD (low)";s:6:"course";s:7:"0.33419";s:4:"code";s:19:"bitfinex_elfusd_low";s:4:"birg";s:8:"bitfinex";}i:1539;a:4:{s:5:"title";s:14:"ELF-USD (high)";s:6:"course";s:7:"0.34267";s:4:"code";s:20:"bitfinex_elfusd_high";s:4:"birg";s:8:"bitfinex";}i:1540;a:4:{s:5:"title";s:13:"ELF-BTC (mid)";s:6:"course";s:10:"0.00005192";s:4:"code";s:19:"bitfinex_elfbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1541;a:4:{s:5:"title";s:13:"ELF-BTC (bid)";s:6:"course";s:10:"0.00005183";s:4:"code";s:19:"bitfinex_elfbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1542;a:4:{s:5:"title";s:13:"ELF-BTC (ask)";s:6:"course";s:10:"0.00005201";s:4:"code";s:19:"bitfinex_elfbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1543;a:4:{s:5:"title";s:20:"ELF-BTC (last_price)";s:6:"course";s:10:"0.00005201";s:4:"code";s:26:"bitfinex_elfbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1544;a:4:{s:5:"title";s:13:"ELF-BTC (low)";s:6:"course";s:10:"0.00005101";s:4:"code";s:19:"bitfinex_elfbtc_low";s:4:"birg";s:8:"bitfinex";}i:1545;a:4:{s:5:"title";s:14:"ELF-BTC (high)";s:6:"course";s:10:"0.00005236";s:4:"code";s:20:"bitfinex_elfbtc_high";s:4:"birg";s:8:"bitfinex";}i:1546;a:4:{s:5:"title";s:13:"ELF-ETH (mid)";s:6:"course";s:9:"0.0016591";s:4:"code";s:19:"bitfinex_elfeth_mid";s:4:"birg";s:8:"bitfinex";}i:1547;a:4:{s:5:"title";s:13:"ELF-ETH (bid)";s:6:"course";s:9:"0.0016534";s:4:"code";s:19:"bitfinex_elfeth_bid";s:4:"birg";s:8:"bitfinex";}i:1548;a:4:{s:5:"title";s:13:"ELF-ETH (ask)";s:6:"course";s:9:"0.0016648";s:4:"code";s:19:"bitfinex_elfeth_ask";s:4:"birg";s:8:"bitfinex";}i:1549;a:4:{s:5:"title";s:20:"ELF-ETH (last_price)";s:6:"course";s:9:"0.0016593";s:4:"code";s:26:"bitfinex_elfeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1550;a:4:{s:5:"title";s:13:"ELF-ETH (low)";s:6:"course";s:9:"0.0016307";s:4:"code";s:19:"bitfinex_elfeth_low";s:4:"birg";s:8:"bitfinex";}i:1551;a:4:{s:5:"title";s:14:"ELF-ETH (high)";s:6:"course";s:9:"0.0016702";s:4:"code";s:20:"bitfinex_elfeth_high";s:4:"birg";s:8:"bitfinex";}i:1552;a:4:{s:5:"title";s:13:"BTC-GBP (mid)";s:6:"course";s:7:"5059.95";s:4:"code";s:19:"bitfinex_btcgbp_mid";s:4:"birg";s:8:"bitfinex";}i:1553;a:4:{s:5:"title";s:13:"BTC-GBP (bid)";s:6:"course";s:6:"5059.9";s:4:"code";s:19:"bitfinex_btcgbp_bid";s:4:"birg";s:8:"bitfinex";}i:1554;a:4:{s:5:"title";s:13:"BTC-GBP (ask)";s:6:"course";s:4:"5060";s:4:"code";s:19:"bitfinex_btcgbp_ask";s:4:"birg";s:8:"bitfinex";}i:1555;a:4:{s:5:"title";s:20:"BTC-GBP (last_price)";s:6:"course";s:6:"5052.4";s:4:"code";s:26:"bitfinex_btcgbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1556;a:4:{s:5:"title";s:13:"BTC-GBP (low)";s:6:"course";s:6:"5052.4";s:4:"code";s:19:"bitfinex_btcgbp_low";s:4:"birg";s:8:"bitfinex";}i:1557;a:4:{s:5:"title";s:14:"BTC-GBP (high)";s:6:"course";s:6:"5107.7";s:4:"code";s:20:"bitfinex_btcgbp_high";s:4:"birg";s:8:"bitfinex";}i:1558;a:4:{s:5:"title";s:13:"ETH-EUR (mid)";s:6:"course";s:6:"178.23";s:4:"code";s:19:"bitfinex_etheur_mid";s:4:"birg";s:8:"bitfinex";}i:1559;a:4:{s:5:"title";s:13:"ETH-EUR (bid)";s:6:"course";s:6:"178.22";s:4:"code";s:19:"bitfinex_etheur_bid";s:4:"birg";s:8:"bitfinex";}i:1560;a:4:{s:5:"title";s:13:"ETH-EUR (ask)";s:6:"course";s:6:"178.24";s:4:"code";s:19:"bitfinex_etheur_ask";s:4:"birg";s:8:"bitfinex";}i:1561;a:4:{s:5:"title";s:20:"ETH-EUR (last_price)";s:6:"course";s:6:"178.09";s:4:"code";s:26:"bitfinex_etheur_last_price";s:4:"birg";s:8:"bitfinex";}i:1562;a:4:{s:5:"title";s:13:"ETH-EUR (low)";s:6:"course";s:12:"177.85525522";s:4:"code";s:19:"bitfinex_etheur_low";s:4:"birg";s:8:"bitfinex";}i:1563;a:4:{s:5:"title";s:14:"ETH-EUR (high)";s:6:"course";s:6:"180.13";s:4:"code";s:20:"bitfinex_etheur_high";s:4:"birg";s:8:"bitfinex";}i:1564;a:4:{s:5:"title";s:13:"ETH-JPY (mid)";s:6:"course";s:5:"22784";s:4:"code";s:19:"bitfinex_ethjpy_mid";s:4:"birg";s:8:"bitfinex";}i:1565;a:4:{s:5:"title";s:13:"ETH-JPY (bid)";s:6:"course";s:5:"22783";s:4:"code";s:19:"bitfinex_ethjpy_bid";s:4:"birg";s:8:"bitfinex";}i:1566;a:4:{s:5:"title";s:13:"ETH-JPY (ask)";s:6:"course";s:5:"22785";s:4:"code";s:19:"bitfinex_ethjpy_ask";s:4:"birg";s:8:"bitfinex";}i:1567;a:4:{s:5:"title";s:20:"ETH-JPY (last_price)";s:6:"course";s:5:"22793";s:4:"code";s:26:"bitfinex_ethjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1568;a:4:{s:5:"title";s:13:"ETH-JPY (low)";s:6:"course";s:5:"22747";s:4:"code";s:19:"bitfinex_ethjpy_low";s:4:"birg";s:8:"bitfinex";}i:1569;a:4:{s:5:"title";s:14:"ETH-JPY (high)";s:6:"course";s:5:"22979";s:4:"code";s:20:"bitfinex_ethjpy_high";s:4:"birg";s:8:"bitfinex";}i:1570;a:4:{s:5:"title";s:13:"ETH-GBP (mid)";s:6:"course";s:7:"158.665";s:4:"code";s:19:"bitfinex_ethgbp_mid";s:4:"birg";s:8:"bitfinex";}i:1571;a:4:{s:5:"title";s:13:"ETH-GBP (bid)";s:6:"course";s:6:"158.66";s:4:"code";s:19:"bitfinex_ethgbp_bid";s:4:"birg";s:8:"bitfinex";}i:1572;a:4:{s:5:"title";s:13:"ETH-GBP (ask)";s:6:"course";s:6:"158.67";s:4:"code";s:19:"bitfinex_ethgbp_ask";s:4:"birg";s:8:"bitfinex";}i:1573;a:4:{s:5:"title";s:20:"ETH-GBP (last_price)";s:6:"course";s:6:"158.46";s:4:"code";s:26:"bitfinex_ethgbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1574;a:4:{s:5:"title";s:13:"ETH-GBP (low)";s:6:"course";s:12:"158.31039822";s:4:"code";s:19:"bitfinex_ethgbp_low";s:4:"birg";s:8:"bitfinex";}i:1575;a:4:{s:5:"title";s:14:"ETH-GBP (high)";s:6:"course";s:5:"160.2";s:4:"code";s:20:"bitfinex_ethgbp_high";s:4:"birg";s:8:"bitfinex";}i:1576;a:4:{s:5:"title";s:13:"NEO-EUR (mid)";s:6:"course";s:6:"14.114";s:4:"code";s:19:"bitfinex_neoeur_mid";s:4:"birg";s:8:"bitfinex";}i:1577;a:4:{s:5:"title";s:13:"NEO-EUR (bid)";s:6:"course";s:5:"14.11";s:4:"code";s:19:"bitfinex_neoeur_bid";s:4:"birg";s:8:"bitfinex";}i:1578;a:4:{s:5:"title";s:13:"NEO-EUR (ask)";s:6:"course";s:6:"14.118";s:4:"code";s:19:"bitfinex_neoeur_ask";s:4:"birg";s:8:"bitfinex";}i:1579;a:4:{s:5:"title";s:20:"NEO-EUR (last_price)";s:6:"course";s:11:"14.12058161";s:4:"code";s:26:"bitfinex_neoeur_last_price";s:4:"birg";s:8:"bitfinex";}i:1580;a:4:{s:5:"title";s:13:"NEO-EUR (low)";s:6:"course";s:6:"14.048";s:4:"code";s:19:"bitfinex_neoeur_low";s:4:"birg";s:8:"bitfinex";}i:1581;a:4:{s:5:"title";s:14:"NEO-EUR (high)";s:6:"course";s:11:"14.37800003";s:4:"code";s:20:"bitfinex_neoeur_high";s:4:"birg";s:8:"bitfinex";}i:1582;a:4:{s:5:"title";s:13:"NEO-JPY (mid)";s:6:"course";s:7:"1804.25";s:4:"code";s:19:"bitfinex_neojpy_mid";s:4:"birg";s:8:"bitfinex";}i:1583;a:4:{s:5:"title";s:13:"NEO-JPY (bid)";s:6:"course";s:6:"1803.8";s:4:"code";s:19:"bitfinex_neojpy_bid";s:4:"birg";s:8:"bitfinex";}i:1584;a:4:{s:5:"title";s:13:"NEO-JPY (ask)";s:6:"course";s:6:"1804.7";s:4:"code";s:19:"bitfinex_neojpy_ask";s:4:"birg";s:8:"bitfinex";}i:1585;a:4:{s:5:"title";s:20:"NEO-JPY (last_price)";s:6:"course";s:13:"1837.49936051";s:4:"code";s:26:"bitfinex_neojpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1586;a:4:{s:5:"title";s:13:"NEO-JPY (low)";s:6:"course";s:6:"1831.5";s:4:"code";s:19:"bitfinex_neojpy_low";s:4:"birg";s:8:"bitfinex";}i:1587;a:4:{s:5:"title";s:14:"NEO-JPY (high)";s:6:"course";s:13:"1837.49936051";s:4:"code";s:20:"bitfinex_neojpy_high";s:4:"birg";s:8:"bitfinex";}i:1588;a:4:{s:5:"title";s:13:"NEO-GBP (mid)";s:6:"course";s:6:"12.566";s:4:"code";s:19:"bitfinex_neogbp_mid";s:4:"birg";s:8:"bitfinex";}i:1589;a:4:{s:5:"title";s:13:"NEO-GBP (bid)";s:6:"course";s:6:"12.562";s:4:"code";s:19:"bitfinex_neogbp_bid";s:4:"birg";s:8:"bitfinex";}i:1590;a:4:{s:5:"title";s:13:"NEO-GBP (ask)";s:6:"course";s:5:"12.57";s:4:"code";s:19:"bitfinex_neogbp_ask";s:4:"birg";s:8:"bitfinex";}i:1591;a:4:{s:5:"title";s:20:"NEO-GBP (last_price)";s:6:"course";s:11:"12.57069967";s:4:"code";s:26:"bitfinex_neogbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1592;a:4:{s:5:"title";s:13:"NEO-GBP (low)";s:6:"course";s:4:"12.5";s:4:"code";s:19:"bitfinex_neogbp_low";s:4:"birg";s:8:"bitfinex";}i:1593;a:4:{s:5:"title";s:14:"NEO-GBP (high)";s:6:"course";s:11:"12.86992783";s:4:"code";s:20:"bitfinex_neogbp_high";s:4:"birg";s:8:"bitfinex";}i:1594;a:4:{s:5:"title";s:13:"EOS-EUR (mid)";s:6:"course";s:7:"4.74395";s:4:"code";s:19:"bitfinex_eoseur_mid";s:4:"birg";s:8:"bitfinex";}i:1595;a:4:{s:5:"title";s:13:"EOS-EUR (bid)";s:6:"course";s:6:"4.7421";s:4:"code";s:19:"bitfinex_eoseur_bid";s:4:"birg";s:8:"bitfinex";}i:1596;a:4:{s:5:"title";s:13:"EOS-EUR (ask)";s:6:"course";s:6:"4.7458";s:4:"code";s:19:"bitfinex_eoseur_ask";s:4:"birg";s:8:"bitfinex";}i:1597;a:4:{s:5:"title";s:20:"EOS-EUR (last_price)";s:6:"course";s:5:"4.741";s:4:"code";s:26:"bitfinex_eoseur_last_price";s:4:"birg";s:8:"bitfinex";}i:1598;a:4:{s:5:"title";s:13:"EOS-EUR (low)";s:6:"course";s:6:"4.7349";s:4:"code";s:19:"bitfinex_eoseur_low";s:4:"birg";s:8:"bitfinex";}i:1599;a:4:{s:5:"title";s:14:"EOS-EUR (high)";s:6:"course";s:6:"4.7821";s:4:"code";s:20:"bitfinex_eoseur_high";s:4:"birg";s:8:"bitfinex";}i:1600;a:4:{s:5:"title";s:13:"EOS-JPY (mid)";s:6:"course";s:7:"606.425";s:4:"code";s:19:"bitfinex_eosjpy_mid";s:4:"birg";s:8:"bitfinex";}i:1601;a:4:{s:5:"title";s:13:"EOS-JPY (bid)";s:6:"course";s:6:"606.16";s:4:"code";s:19:"bitfinex_eosjpy_bid";s:4:"birg";s:8:"bitfinex";}i:1602;a:4:{s:5:"title";s:13:"EOS-JPY (ask)";s:6:"course";s:6:"606.69";s:4:"code";s:19:"bitfinex_eosjpy_ask";s:4:"birg";s:8:"bitfinex";}i:1603;a:4:{s:5:"title";s:20:"EOS-JPY (last_price)";s:6:"course";s:12:"607.61190539";s:4:"code";s:26:"bitfinex_eosjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1604;a:4:{s:5:"title";s:13:"EOS-JPY (low)";s:6:"course";s:12:"607.61190539";s:4:"code";s:19:"bitfinex_eosjpy_low";s:4:"birg";s:8:"bitfinex";}i:1605;a:4:{s:5:"title";s:14:"EOS-JPY (high)";s:6:"course";s:12:"610.90167722";s:4:"code";s:20:"bitfinex_eosjpy_high";s:4:"birg";s:8:"bitfinex";}i:1606;a:4:{s:5:"title";s:13:"EOS-GBP (mid)";s:6:"course";s:7:"4.22305";s:4:"code";s:19:"bitfinex_eosgbp_mid";s:4:"birg";s:8:"bitfinex";}i:1607;a:4:{s:5:"title";s:13:"EOS-GBP (bid)";s:6:"course";s:6:"4.2212";s:4:"code";s:19:"bitfinex_eosgbp_bid";s:4:"birg";s:8:"bitfinex";}i:1608;a:4:{s:5:"title";s:13:"EOS-GBP (ask)";s:6:"course";s:6:"4.2249";s:4:"code";s:19:"bitfinex_eosgbp_ask";s:4:"birg";s:8:"bitfinex";}i:1609;a:4:{s:5:"title";s:20:"EOS-GBP (last_price)";s:6:"course";s:6:"4.2141";s:4:"code";s:26:"bitfinex_eosgbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1610;a:4:{s:5:"title";s:13:"EOS-GBP (low)";s:6:"course";s:6:"4.2141";s:4:"code";s:19:"bitfinex_eosgbp_low";s:4:"birg";s:8:"bitfinex";}i:1611;a:4:{s:5:"title";s:14:"EOS-GBP (high)";s:6:"course";s:6:"4.2569";s:4:"code";s:20:"bitfinex_eosgbp_high";s:4:"birg";s:8:"bitfinex";}i:1612;a:4:{s:5:"title";s:13:"IOT-JPY (mid)";s:6:"course";s:6:"55.081";s:4:"code";s:19:"bitfinex_iotjpy_mid";s:4:"birg";s:8:"bitfinex";}i:1613;a:4:{s:5:"title";s:13:"IOT-JPY (bid)";s:6:"course";s:6:"55.076";s:4:"code";s:19:"bitfinex_iotjpy_bid";s:4:"birg";s:8:"bitfinex";}i:1614;a:4:{s:5:"title";s:13:"IOT-JPY (ask)";s:6:"course";s:6:"55.086";s:4:"code";s:19:"bitfinex_iotjpy_ask";s:4:"birg";s:8:"bitfinex";}i:1615;a:4:{s:5:"title";s:20:"IOT-JPY (last_price)";s:6:"course";s:11:"55.18700003";s:4:"code";s:26:"bitfinex_iotjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1616;a:4:{s:5:"title";s:13:"IOT-JPY (low)";s:6:"course";s:11:"55.18312504";s:4:"code";s:19:"bitfinex_iotjpy_low";s:4:"birg";s:8:"bitfinex";}i:1617;a:4:{s:5:"title";s:14:"IOT-JPY (high)";s:6:"course";s:11:"55.43000029";s:4:"code";s:20:"bitfinex_iotjpy_high";s:4:"birg";s:8:"bitfinex";}i:1618;a:4:{s:5:"title";s:13:"IOT-GBP (mid)";s:6:"course";s:7:"0.38358";s:4:"code";s:19:"bitfinex_iotgbp_mid";s:4:"birg";s:8:"bitfinex";}i:1619;a:4:{s:5:"title";s:13:"IOT-GBP (bid)";s:6:"course";s:7:"0.38354";s:4:"code";s:19:"bitfinex_iotgbp_bid";s:4:"birg";s:8:"bitfinex";}i:1620;a:4:{s:5:"title";s:13:"IOT-GBP (ask)";s:6:"course";s:7:"0.38362";s:4:"code";s:19:"bitfinex_iotgbp_ask";s:4:"birg";s:8:"bitfinex";}i:1621;a:4:{s:5:"title";s:20:"IOT-GBP (last_price)";s:6:"course";s:7:"0.38504";s:4:"code";s:26:"bitfinex_iotgbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1622;a:4:{s:5:"title";s:13:"IOT-GBP (low)";s:6:"course";s:10:"0.38498352";s:4:"code";s:19:"bitfinex_iotgbp_low";s:4:"birg";s:8:"bitfinex";}i:1623;a:4:{s:5:"title";s:14:"IOT-GBP (high)";s:6:"course";s:10:"0.38726489";s:4:"code";s:20:"bitfinex_iotgbp_high";s:4:"birg";s:8:"bitfinex";}i:1624;a:4:{s:5:"title";s:13:"IOS-USD (mid)";s:6:"course";s:9:"0.0123145";s:4:"code";s:19:"bitfinex_iosusd_mid";s:4:"birg";s:8:"bitfinex";}i:1625;a:4:{s:5:"title";s:13:"IOS-USD (bid)";s:6:"course";s:8:"0.011901";s:4:"code";s:19:"bitfinex_iosusd_bid";s:4:"birg";s:8:"bitfinex";}i:1626;a:4:{s:5:"title";s:13:"IOS-USD (ask)";s:6:"course";s:8:"0.012728";s:4:"code";s:19:"bitfinex_iosusd_ask";s:4:"birg";s:8:"bitfinex";}i:1627;a:4:{s:5:"title";s:20:"IOS-USD (last_price)";s:6:"course";s:8:"0.012438";s:4:"code";s:26:"bitfinex_iosusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1628;a:4:{s:5:"title";s:13:"IOS-BTC (mid)";s:6:"course";s:9:"0.0000019";s:4:"code";s:19:"bitfinex_iosbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1629;a:4:{s:5:"title";s:13:"IOS-BTC (bid)";s:6:"course";s:10:"0.00000188";s:4:"code";s:19:"bitfinex_iosbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1630;a:4:{s:5:"title";s:13:"IOS-BTC (ask)";s:6:"course";s:10:"0.00000192";s:4:"code";s:19:"bitfinex_iosbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1631;a:4:{s:5:"title";s:20:"IOS-BTC (last_price)";s:6:"course";s:10:"0.00000193";s:4:"code";s:26:"bitfinex_iosbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1632;a:4:{s:5:"title";s:13:"IOS-ETH (mid)";s:6:"course";s:10:"0.00006114";s:4:"code";s:19:"bitfinex_ioseth_mid";s:4:"birg";s:8:"bitfinex";}i:1633;a:4:{s:5:"title";s:13:"IOS-ETH (bid)";s:6:"course";s:10:"0.00005992";s:4:"code";s:19:"bitfinex_ioseth_bid";s:4:"birg";s:8:"bitfinex";}i:1634;a:4:{s:5:"title";s:13:"IOS-ETH (ask)";s:6:"course";s:10:"0.00006236";s:4:"code";s:19:"bitfinex_ioseth_ask";s:4:"birg";s:8:"bitfinex";}i:1635;a:4:{s:5:"title";s:20:"IOS-ETH (last_price)";s:6:"course";s:10:"0.00005992";s:4:"code";s:26:"bitfinex_ioseth_last_price";s:4:"birg";s:8:"bitfinex";}i:1636;a:4:{s:5:"title";s:13:"AIO-USD (mid)";s:6:"course";s:6:"0.4335";s:4:"code";s:19:"bitfinex_aiousd_mid";s:4:"birg";s:8:"bitfinex";}i:1637;a:4:{s:5:"title";s:13:"AIO-USD (bid)";s:6:"course";s:5:"0.418";s:4:"code";s:19:"bitfinex_aiousd_bid";s:4:"birg";s:8:"bitfinex";}i:1638;a:4:{s:5:"title";s:13:"AIO-USD (ask)";s:6:"course";s:5:"0.449";s:4:"code";s:19:"bitfinex_aiousd_ask";s:4:"birg";s:8:"bitfinex";}i:1639;a:4:{s:5:"title";s:20:"AIO-USD (last_price)";s:6:"course";s:5:"0.448";s:4:"code";s:26:"bitfinex_aiousd_last_price";s:4:"birg";s:8:"bitfinex";}i:1640;a:4:{s:5:"title";s:13:"AIO-USD (low)";s:6:"course";s:5:"0.446";s:4:"code";s:19:"bitfinex_aiousd_low";s:4:"birg";s:8:"bitfinex";}i:1641;a:4:{s:5:"title";s:14:"AIO-USD (high)";s:6:"course";s:5:"0.448";s:4:"code";s:20:"bitfinex_aiousd_high";s:4:"birg";s:8:"bitfinex";}i:1642;a:4:{s:5:"title";s:13:"AIO-BTC (mid)";s:6:"course";s:10:"0.00006559";s:4:"code";s:19:"bitfinex_aiobtc_mid";s:4:"birg";s:8:"bitfinex";}i:1643;a:4:{s:5:"title";s:13:"AIO-BTC (bid)";s:6:"course";s:10:"0.00006213";s:4:"code";s:19:"bitfinex_aiobtc_bid";s:4:"birg";s:8:"bitfinex";}i:1644;a:4:{s:5:"title";s:13:"AIO-BTC (ask)";s:6:"course";s:10:"0.00006905";s:4:"code";s:19:"bitfinex_aiobtc_ask";s:4:"birg";s:8:"bitfinex";}i:1645;a:4:{s:5:"title";s:20:"AIO-BTC (last_price)";s:6:"course";s:10:"0.00006906";s:4:"code";s:26:"bitfinex_aiobtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1646;a:4:{s:5:"title";s:13:"AIO-BTC (low)";s:6:"course";s:10:"0.00006262";s:4:"code";s:19:"bitfinex_aiobtc_low";s:4:"birg";s:8:"bitfinex";}i:1647;a:4:{s:5:"title";s:14:"AIO-BTC (high)";s:6:"course";s:10:"0.00006906";s:4:"code";s:20:"bitfinex_aiobtc_high";s:4:"birg";s:8:"bitfinex";}i:1648;a:4:{s:5:"title";s:13:"AIO-ETH (mid)";s:6:"course";s:9:"0.0022199";s:4:"code";s:19:"bitfinex_aioeth_mid";s:4:"birg";s:8:"bitfinex";}i:1649;a:4:{s:5:"title";s:13:"AIO-ETH (bid)";s:6:"course";s:6:"0.0019";s:4:"code";s:19:"bitfinex_aioeth_bid";s:4:"birg";s:8:"bitfinex";}i:1650;a:4:{s:5:"title";s:13:"AIO-ETH (ask)";s:6:"course";s:9:"0.0025398";s:4:"code";s:19:"bitfinex_aioeth_ask";s:4:"birg";s:8:"bitfinex";}i:1651;a:4:{s:5:"title";s:20:"AIO-ETH (last_price)";s:6:"course";s:9:"0.0021999";s:4:"code";s:26:"bitfinex_aioeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1652;a:4:{s:5:"title";s:13:"AIO-ETH (low)";s:6:"course";s:9:"0.0021999";s:4:"code";s:19:"bitfinex_aioeth_low";s:4:"birg";s:8:"bitfinex";}i:1653;a:4:{s:5:"title";s:14:"AIO-ETH (high)";s:6:"course";s:9:"0.0021999";s:4:"code";s:20:"bitfinex_aioeth_high";s:4:"birg";s:8:"bitfinex";}i:1654;a:4:{s:5:"title";s:13:"REQ-USD (mid)";s:6:"course";s:9:"0.0550945";s:4:"code";s:19:"bitfinex_requsd_mid";s:4:"birg";s:8:"bitfinex";}i:1655;a:4:{s:5:"title";s:13:"REQ-USD (bid)";s:6:"course";s:7:"0.05029";s:4:"code";s:19:"bitfinex_requsd_bid";s:4:"birg";s:8:"bitfinex";}i:1656;a:4:{s:5:"title";s:13:"REQ-USD (ask)";s:6:"course";s:8:"0.059899";s:4:"code";s:19:"bitfinex_requsd_ask";s:4:"birg";s:8:"bitfinex";}i:1657;a:4:{s:5:"title";s:20:"REQ-USD (last_price)";s:6:"course";s:7:"0.05029";s:4:"code";s:26:"bitfinex_requsd_last_price";s:4:"birg";s:8:"bitfinex";}i:1658;a:4:{s:5:"title";s:13:"REQ-USD (low)";s:6:"course";s:7:"0.05029";s:4:"code";s:19:"bitfinex_requsd_low";s:4:"birg";s:8:"bitfinex";}i:1659;a:4:{s:5:"title";s:14:"REQ-USD (high)";s:6:"course";s:6:"0.0528";s:4:"code";s:20:"bitfinex_requsd_high";s:4:"birg";s:8:"bitfinex";}i:1660;a:4:{s:5:"title";s:13:"REQ-BTC (mid)";s:6:"course";s:11:"0.000005975";s:4:"code";s:19:"bitfinex_reqbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1661;a:4:{s:5:"title";s:13:"REQ-BTC (bid)";s:6:"course";s:9:"0.0000042";s:4:"code";s:19:"bitfinex_reqbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1662;a:4:{s:5:"title";s:13:"REQ-BTC (ask)";s:6:"course";s:10:"0.00000775";s:4:"code";s:19:"bitfinex_reqbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1663;a:4:{s:5:"title";s:20:"REQ-BTC (last_price)";s:6:"course";s:10:"0.00000827";s:4:"code";s:26:"bitfinex_reqbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1664;a:4:{s:5:"title";s:13:"REQ-BTC (low)";s:6:"course";s:10:"0.00000805";s:4:"code";s:19:"bitfinex_reqbtc_low";s:4:"birg";s:8:"bitfinex";}i:1665;a:4:{s:5:"title";s:14:"REQ-BTC (high)";s:6:"course";s:10:"0.00000827";s:4:"code";s:20:"bitfinex_reqbtc_high";s:4:"birg";s:8:"bitfinex";}i:1666;a:4:{s:5:"title";s:13:"REQ-ETH (mid)";s:6:"course";s:11:"0.000278535";s:4:"code";s:19:"bitfinex_reqeth_mid";s:4:"birg";s:8:"bitfinex";}i:1667;a:4:{s:5:"title";s:13:"REQ-ETH (bid)";s:6:"course";s:10:"0.00023026";s:4:"code";s:19:"bitfinex_reqeth_bid";s:4:"birg";s:8:"bitfinex";}i:1668;a:4:{s:5:"title";s:13:"REQ-ETH (ask)";s:6:"course";s:10:"0.00032681";s:4:"code";s:19:"bitfinex_reqeth_ask";s:4:"birg";s:8:"bitfinex";}i:1669;a:4:{s:5:"title";s:20:"REQ-ETH (last_price)";s:6:"course";s:7:"0.00026";s:4:"code";s:26:"bitfinex_reqeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1670;a:4:{s:5:"title";s:13:"RDN-USD (mid)";s:6:"course";s:7:"0.60323";s:4:"code";s:19:"bitfinex_rdnusd_mid";s:4:"birg";s:8:"bitfinex";}i:1671;a:4:{s:5:"title";s:13:"RDN-USD (bid)";s:6:"course";s:7:"0.54002";s:4:"code";s:19:"bitfinex_rdnusd_bid";s:4:"birg";s:8:"bitfinex";}i:1672;a:4:{s:5:"title";s:13:"RDN-USD (ask)";s:6:"course";s:7:"0.66644";s:4:"code";s:19:"bitfinex_rdnusd_ask";s:4:"birg";s:8:"bitfinex";}i:1673;a:4:{s:5:"title";s:20:"RDN-USD (last_price)";s:6:"course";s:7:"0.58002";s:4:"code";s:26:"bitfinex_rdnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1674;a:4:{s:5:"title";s:13:"RDN-USD (low)";s:6:"course";s:7:"0.58002";s:4:"code";s:19:"bitfinex_rdnusd_low";s:4:"birg";s:8:"bitfinex";}i:1675;a:4:{s:5:"title";s:14:"RDN-USD (high)";s:6:"course";s:4:"0.66";s:4:"code";s:20:"bitfinex_rdnusd_high";s:4:"birg";s:8:"bitfinex";}i:1676;a:4:{s:5:"title";s:13:"RDN-BTC (mid)";s:6:"course";s:11:"0.000086515";s:4:"code";s:19:"bitfinex_rdnbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1677;a:4:{s:5:"title";s:13:"RDN-BTC (bid)";s:6:"course";s:9:"0.0000844";s:4:"code";s:19:"bitfinex_rdnbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1678;a:4:{s:5:"title";s:13:"RDN-BTC (ask)";s:6:"course";s:10:"0.00008863";s:4:"code";s:19:"bitfinex_rdnbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1679;a:4:{s:5:"title";s:20:"RDN-BTC (last_price)";s:6:"course";s:10:"0.00008863";s:4:"code";s:26:"bitfinex_rdnbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1680;a:4:{s:5:"title";s:13:"RDN-BTC (low)";s:6:"course";s:10:"0.00008455";s:4:"code";s:19:"bitfinex_rdnbtc_low";s:4:"birg";s:8:"bitfinex";}i:1681;a:4:{s:5:"title";s:14:"RDN-BTC (high)";s:6:"course";s:10:"0.00011133";s:4:"code";s:20:"bitfinex_rdnbtc_high";s:4:"birg";s:8:"bitfinex";}i:1682;a:4:{s:5:"title";s:13:"RDN-ETH (mid)";s:6:"course";s:10:"0.00322495";s:4:"code";s:19:"bitfinex_rdneth_mid";s:4:"birg";s:8:"bitfinex";}i:1683;a:4:{s:5:"title";s:13:"RDN-ETH (bid)";s:6:"course";s:7:"0.00275";s:4:"code";s:19:"bitfinex_rdneth_bid";s:4:"birg";s:8:"bitfinex";}i:1684;a:4:{s:5:"title";s:13:"RDN-ETH (ask)";s:6:"course";s:9:"0.0036999";s:4:"code";s:19:"bitfinex_rdneth_ask";s:4:"birg";s:8:"bitfinex";}i:1685;a:4:{s:5:"title";s:20:"RDN-ETH (last_price)";s:6:"course";s:9:"0.0028088";s:4:"code";s:26:"bitfinex_rdneth_last_price";s:4:"birg";s:8:"bitfinex";}i:1686;a:4:{s:5:"title";s:13:"RDN-ETH (low)";s:6:"course";s:9:"0.0027544";s:4:"code";s:19:"bitfinex_rdneth_low";s:4:"birg";s:8:"bitfinex";}i:1687;a:4:{s:5:"title";s:14:"RDN-ETH (high)";s:6:"course";s:9:"0.0028088";s:4:"code";s:20:"bitfinex_rdneth_high";s:4:"birg";s:8:"bitfinex";}i:1688;a:4:{s:5:"title";s:13:"LRC-USD (mid)";s:6:"course";s:7:"0.12102";s:4:"code";s:19:"bitfinex_lrcusd_mid";s:4:"birg";s:8:"bitfinex";}i:1689;a:4:{s:5:"title";s:13:"LRC-USD (bid)";s:6:"course";s:6:"0.1144";s:4:"code";s:19:"bitfinex_lrcusd_bid";s:4:"birg";s:8:"bitfinex";}i:1690;a:4:{s:5:"title";s:13:"LRC-USD (ask)";s:6:"course";s:7:"0.12764";s:4:"code";s:19:"bitfinex_lrcusd_ask";s:4:"birg";s:8:"bitfinex";}i:1691;a:4:{s:5:"title";s:20:"LRC-USD (last_price)";s:6:"course";s:7:"0.11806";s:4:"code";s:26:"bitfinex_lrcusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1692;a:4:{s:5:"title";s:13:"LRC-USD (low)";s:6:"course";s:7:"0.11806";s:4:"code";s:19:"bitfinex_lrcusd_low";s:4:"birg";s:8:"bitfinex";}i:1693;a:4:{s:5:"title";s:14:"LRC-USD (high)";s:6:"course";s:7:"0.11806";s:4:"code";s:20:"bitfinex_lrcusd_high";s:4:"birg";s:8:"bitfinex";}i:1694;a:4:{s:5:"title";s:13:"LRC-BTC (mid)";s:6:"course";s:11:"0.000015555";s:4:"code";s:19:"bitfinex_lrcbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1695;a:4:{s:5:"title";s:13:"LRC-BTC (bid)";s:6:"course";s:10:"0.00001291";s:4:"code";s:19:"bitfinex_lrcbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1696;a:4:{s:5:"title";s:13:"LRC-BTC (ask)";s:6:"course";s:9:"0.0000182";s:4:"code";s:19:"bitfinex_lrcbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1697;a:4:{s:5:"title";s:20:"LRC-BTC (last_price)";s:6:"course";s:9:"0.0000184";s:4:"code";s:26:"bitfinex_lrcbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1698;a:4:{s:5:"title";s:13:"LRC-ETH (mid)";s:6:"course";s:8:"0.000645";s:4:"code";s:19:"bitfinex_lrceth_mid";s:4:"birg";s:8:"bitfinex";}i:1699;a:4:{s:5:"title";s:13:"LRC-ETH (bid)";s:6:"course";s:10:"0.00055537";s:4:"code";s:19:"bitfinex_lrceth_bid";s:4:"birg";s:8:"bitfinex";}i:1700;a:4:{s:5:"title";s:13:"LRC-ETH (ask)";s:6:"course";s:10:"0.00073463";s:4:"code";s:19:"bitfinex_lrceth_ask";s:4:"birg";s:8:"bitfinex";}i:1701;a:4:{s:5:"title";s:20:"LRC-ETH (last_price)";s:6:"course";s:10:"0.00055318";s:4:"code";s:26:"bitfinex_lrceth_last_price";s:4:"birg";s:8:"bitfinex";}i:1702;a:4:{s:5:"title";s:13:"WAX-USD (mid)";s:6:"course";s:9:"0.0815175";s:4:"code";s:19:"bitfinex_waxusd_mid";s:4:"birg";s:8:"bitfinex";}i:1703;a:4:{s:5:"title";s:13:"WAX-USD (bid)";s:6:"course";s:8:"0.080876";s:4:"code";s:19:"bitfinex_waxusd_bid";s:4:"birg";s:8:"bitfinex";}i:1704;a:4:{s:5:"title";s:13:"WAX-USD (ask)";s:6:"course";s:8:"0.082159";s:4:"code";s:19:"bitfinex_waxusd_ask";s:4:"birg";s:8:"bitfinex";}i:1705;a:4:{s:5:"title";s:20:"WAX-USD (last_price)";s:6:"course";s:7:"0.08084";s:4:"code";s:26:"bitfinex_waxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1706;a:4:{s:5:"title";s:13:"WAX-USD (low)";s:6:"course";s:7:"0.08142";s:4:"code";s:19:"bitfinex_waxusd_low";s:4:"birg";s:8:"bitfinex";}i:1707;a:4:{s:5:"title";s:14:"WAX-USD (high)";s:6:"course";s:8:"0.082162";s:4:"code";s:20:"bitfinex_waxusd_high";s:4:"birg";s:8:"bitfinex";}i:1708;a:4:{s:5:"title";s:13:"WAX-BTC (mid)";s:6:"course";s:10:"0.00001274";s:4:"code";s:19:"bitfinex_waxbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1709;a:4:{s:5:"title";s:13:"WAX-BTC (bid)";s:6:"course";s:9:"0.0000125";s:4:"code";s:19:"bitfinex_waxbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1710;a:4:{s:5:"title";s:13:"WAX-BTC (ask)";s:6:"course";s:10:"0.00001298";s:4:"code";s:19:"bitfinex_waxbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1711;a:4:{s:5:"title";s:20:"WAX-BTC (last_price)";s:6:"course";s:10:"0.00001277";s:4:"code";s:26:"bitfinex_waxbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1712;a:4:{s:5:"title";s:13:"WAX-BTC (low)";s:6:"course";s:10:"0.00001246";s:4:"code";s:19:"bitfinex_waxbtc_low";s:4:"birg";s:8:"bitfinex";}i:1713;a:4:{s:5:"title";s:14:"WAX-BTC (high)";s:6:"course";s:10:"0.00001294";s:4:"code";s:20:"bitfinex_waxbtc_high";s:4:"birg";s:8:"bitfinex";}i:1714;a:4:{s:5:"title";s:13:"WAX-ETH (mid)";s:6:"course";s:11:"0.000382735";s:4:"code";s:19:"bitfinex_waxeth_mid";s:4:"birg";s:8:"bitfinex";}i:1715;a:4:{s:5:"title";s:13:"WAX-ETH (bid)";s:6:"course";s:10:"0.00034429";s:4:"code";s:19:"bitfinex_waxeth_bid";s:4:"birg";s:8:"bitfinex";}i:1716;a:4:{s:5:"title";s:13:"WAX-ETH (ask)";s:6:"course";s:10:"0.00042118";s:4:"code";s:19:"bitfinex_waxeth_ask";s:4:"birg";s:8:"bitfinex";}i:1717;a:4:{s:5:"title";s:20:"WAX-ETH (last_price)";s:6:"course";s:10:"0.00040468";s:4:"code";s:26:"bitfinex_waxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1718;a:4:{s:5:"title";s:13:"WAX-ETH (low)";s:6:"course";s:10:"0.00040468";s:4:"code";s:19:"bitfinex_waxeth_low";s:4:"birg";s:8:"bitfinex";}i:1719;a:4:{s:5:"title";s:14:"WAX-ETH (high)";s:6:"course";s:9:"0.0004047";s:4:"code";s:20:"bitfinex_waxeth_high";s:4:"birg";s:8:"bitfinex";}i:1720;a:4:{s:5:"title";s:13:"DAI-USD (mid)";s:6:"course";s:7:"1.01245";s:4:"code";s:19:"bitfinex_daiusd_mid";s:4:"birg";s:8:"bitfinex";}i:1721;a:4:{s:5:"title";s:13:"DAI-USD (bid)";s:6:"course";s:6:"1.0071";s:4:"code";s:19:"bitfinex_daiusd_bid";s:4:"birg";s:8:"bitfinex";}i:1722;a:4:{s:5:"title";s:13:"DAI-USD (ask)";s:6:"course";s:6:"1.0178";s:4:"code";s:19:"bitfinex_daiusd_ask";s:4:"birg";s:8:"bitfinex";}i:1723;a:4:{s:5:"title";s:20:"DAI-USD (last_price)";s:6:"course";s:6:"1.0071";s:4:"code";s:26:"bitfinex_daiusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1724;a:4:{s:5:"title";s:13:"DAI-USD (low)";s:6:"course";s:6:"1.0071";s:4:"code";s:19:"bitfinex_daiusd_low";s:4:"birg";s:8:"bitfinex";}i:1725;a:4:{s:5:"title";s:14:"DAI-USD (high)";s:6:"course";s:6:"1.0172";s:4:"code";s:20:"bitfinex_daiusd_high";s:4:"birg";s:8:"bitfinex";}i:1726;a:4:{s:5:"title";s:13:"DAI-BTC (mid)";s:6:"course";s:10:"0.00015584";s:4:"code";s:19:"bitfinex_daibtc_mid";s:4:"birg";s:8:"bitfinex";}i:1727;a:4:{s:5:"title";s:13:"DAI-BTC (bid)";s:6:"course";s:10:"0.00015492";s:4:"code";s:19:"bitfinex_daibtc_bid";s:4:"birg";s:8:"bitfinex";}i:1728;a:4:{s:5:"title";s:13:"DAI-BTC (ask)";s:6:"course";s:10:"0.00015676";s:4:"code";s:19:"bitfinex_daibtc_ask";s:4:"birg";s:8:"bitfinex";}i:1729;a:4:{s:5:"title";s:20:"DAI-BTC (last_price)";s:6:"course";s:10:"0.00015391";s:4:"code";s:26:"bitfinex_daibtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1730;a:4:{s:5:"title";s:13:"DAI-ETH (mid)";s:6:"course";s:9:"0.0049682";s:4:"code";s:19:"bitfinex_daieth_mid";s:4:"birg";s:8:"bitfinex";}i:1731;a:4:{s:5:"title";s:13:"DAI-ETH (bid)";s:6:"course";s:9:"0.0049361";s:4:"code";s:19:"bitfinex_daieth_bid";s:4:"birg";s:8:"bitfinex";}i:1732;a:4:{s:5:"title";s:13:"DAI-ETH (ask)";s:6:"course";s:9:"0.0050003";s:4:"code";s:19:"bitfinex_daieth_ask";s:4:"birg";s:8:"bitfinex";}i:1733;a:4:{s:5:"title";s:20:"DAI-ETH (last_price)";s:6:"course";s:9:"0.0050004";s:4:"code";s:26:"bitfinex_daieth_last_price";s:4:"birg";s:8:"bitfinex";}i:1734;a:4:{s:5:"title";s:13:"DAI-ETH (low)";s:6:"course";s:9:"0.0050004";s:4:"code";s:19:"bitfinex_daieth_low";s:4:"birg";s:8:"bitfinex";}i:1735;a:4:{s:5:"title";s:14:"DAI-ETH (high)";s:6:"course";s:9:"0.0050004";s:4:"code";s:20:"bitfinex_daieth_high";s:4:"birg";s:8:"bitfinex";}i:1736;a:4:{s:5:"title";s:13:"CFI-USD (mid)";s:6:"course";s:9:"0.0234625";s:4:"code";s:19:"bitfinex_cfiusd_mid";s:4:"birg";s:8:"bitfinex";}i:1737;a:4:{s:5:"title";s:13:"CFI-USD (bid)";s:6:"course";s:8:"0.021205";s:4:"code";s:19:"bitfinex_cfiusd_bid";s:4:"birg";s:8:"bitfinex";}i:1738;a:4:{s:5:"title";s:13:"CFI-USD (ask)";s:6:"course";s:7:"0.02572";s:4:"code";s:19:"bitfinex_cfiusd_ask";s:4:"birg";s:8:"bitfinex";}i:1739;a:4:{s:5:"title";s:20:"CFI-USD (last_price)";s:6:"course";s:8:"0.023335";s:4:"code";s:26:"bitfinex_cfiusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1740;a:4:{s:5:"title";s:13:"CFI-BTC (mid)";s:6:"course";s:11:"0.000003375";s:4:"code";s:19:"bitfinex_cfibtc_mid";s:4:"birg";s:8:"bitfinex";}i:1741;a:4:{s:5:"title";s:13:"CFI-BTC (bid)";s:6:"course";s:10:"0.00000272";s:4:"code";s:19:"bitfinex_cfibtc_bid";s:4:"birg";s:8:"bitfinex";}i:1742;a:4:{s:5:"title";s:13:"CFI-BTC (ask)";s:6:"course";s:10:"0.00000403";s:4:"code";s:19:"bitfinex_cfibtc_ask";s:4:"birg";s:8:"bitfinex";}i:1743;a:4:{s:5:"title";s:20:"CFI-BTC (last_price)";s:6:"course";s:10:"0.00000379";s:4:"code";s:26:"bitfinex_cfibtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1744;a:4:{s:5:"title";s:13:"CFI-ETH (mid)";s:6:"course";s:10:"0.00009185";s:4:"code";s:19:"bitfinex_cfieth_mid";s:4:"birg";s:8:"bitfinex";}i:1745;a:4:{s:5:"title";s:13:"CFI-ETH (bid)";s:6:"course";s:10:"0.00005684";s:4:"code";s:19:"bitfinex_cfieth_bid";s:4:"birg";s:8:"bitfinex";}i:1746;a:4:{s:5:"title";s:13:"CFI-ETH (ask)";s:6:"course";s:10:"0.00012686";s:4:"code";s:19:"bitfinex_cfieth_ask";s:4:"birg";s:8:"bitfinex";}i:1747;a:4:{s:5:"title";s:20:"CFI-ETH (last_price)";s:6:"course";s:10:"0.00012897";s:4:"code";s:26:"bitfinex_cfieth_last_price";s:4:"birg";s:8:"bitfinex";}i:1748;a:4:{s:5:"title";s:13:"AGI-USD (mid)";s:6:"course";s:9:"0.0599935";s:4:"code";s:19:"bitfinex_agiusd_mid";s:4:"birg";s:8:"bitfinex";}i:1749;a:4:{s:5:"title";s:13:"AGI-USD (bid)";s:6:"course";s:8:"0.055987";s:4:"code";s:19:"bitfinex_agiusd_bid";s:4:"birg";s:8:"bitfinex";}i:1750;a:4:{s:5:"title";s:13:"AGI-USD (ask)";s:6:"course";s:5:"0.064";s:4:"code";s:19:"bitfinex_agiusd_ask";s:4:"birg";s:8:"bitfinex";}i:1751;a:4:{s:5:"title";s:20:"AGI-USD (last_price)";s:6:"course";s:5:"0.064";s:4:"code";s:26:"bitfinex_agiusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1752;a:4:{s:5:"title";s:13:"AGI-BTC (mid)";s:6:"course";s:10:"0.00000948";s:4:"code";s:19:"bitfinex_agibtc_mid";s:4:"birg";s:8:"bitfinex";}i:1753;a:4:{s:5:"title";s:13:"AGI-BTC (bid)";s:6:"course";s:10:"0.00000851";s:4:"code";s:19:"bitfinex_agibtc_bid";s:4:"birg";s:8:"bitfinex";}i:1754;a:4:{s:5:"title";s:13:"AGI-BTC (ask)";s:6:"course";s:10:"0.00001045";s:4:"code";s:19:"bitfinex_agibtc_ask";s:4:"birg";s:8:"bitfinex";}i:1755;a:4:{s:5:"title";s:20:"AGI-BTC (last_price)";s:6:"course";s:9:"0.0000091";s:4:"code";s:26:"bitfinex_agibtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1756;a:4:{s:5:"title";s:13:"AGI-ETH (mid)";s:6:"course";s:10:"0.00029755";s:4:"code";s:19:"bitfinex_agieth_mid";s:4:"birg";s:8:"bitfinex";}i:1757;a:4:{s:5:"title";s:13:"AGI-ETH (bid)";s:6:"course";s:10:"0.00027512";s:4:"code";s:19:"bitfinex_agieth_bid";s:4:"birg";s:8:"bitfinex";}i:1758;a:4:{s:5:"title";s:13:"AGI-ETH (ask)";s:6:"course";s:10:"0.00031998";s:4:"code";s:19:"bitfinex_agieth_ask";s:4:"birg";s:8:"bitfinex";}i:1759;a:4:{s:5:"title";s:20:"AGI-ETH (last_price)";s:6:"course";s:7:"0.00032";s:4:"code";s:26:"bitfinex_agieth_last_price";s:4:"birg";s:8:"bitfinex";}i:1760;a:4:{s:5:"title";s:13:"BFT-USD (mid)";s:6:"course";s:9:"0.0449685";s:4:"code";s:19:"bitfinex_bftusd_mid";s:4:"birg";s:8:"bitfinex";}i:1761;a:4:{s:5:"title";s:13:"BFT-USD (bid)";s:6:"course";s:8:"0.044551";s:4:"code";s:19:"bitfinex_bftusd_bid";s:4:"birg";s:8:"bitfinex";}i:1762;a:4:{s:5:"title";s:13:"BFT-USD (ask)";s:6:"course";s:8:"0.045386";s:4:"code";s:19:"bitfinex_bftusd_ask";s:4:"birg";s:8:"bitfinex";}i:1763;a:4:{s:5:"title";s:20:"BFT-USD (last_price)";s:6:"course";s:8:"0.044551";s:4:"code";s:26:"bitfinex_bftusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1764;a:4:{s:5:"title";s:13:"BFT-USD (low)";s:6:"course";s:7:"0.04088";s:4:"code";s:19:"bitfinex_bftusd_low";s:4:"birg";s:8:"bitfinex";}i:1765;a:4:{s:5:"title";s:14:"BFT-USD (high)";s:6:"course";s:8:"0.045386";s:4:"code";s:20:"bitfinex_bftusd_high";s:4:"birg";s:8:"bitfinex";}i:1766;a:4:{s:5:"title";s:13:"BFT-BTC (mid)";s:6:"course";s:10:"0.00000685";s:4:"code";s:19:"bitfinex_bftbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1767;a:4:{s:5:"title";s:13:"BFT-BTC (bid)";s:6:"course";s:10:"0.00000679";s:4:"code";s:19:"bitfinex_bftbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1768;a:4:{s:5:"title";s:13:"BFT-BTC (ask)";s:6:"course";s:10:"0.00000691";s:4:"code";s:19:"bitfinex_bftbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1769;a:4:{s:5:"title";s:20:"BFT-BTC (last_price)";s:6:"course";s:10:"0.00000685";s:4:"code";s:26:"bitfinex_bftbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1770;a:4:{s:5:"title";s:13:"BFT-BTC (low)";s:6:"course";s:10:"0.00000621";s:4:"code";s:19:"bitfinex_bftbtc_low";s:4:"birg";s:8:"bitfinex";}i:1771;a:4:{s:5:"title";s:14:"BFT-BTC (high)";s:6:"course";s:10:"0.00000685";s:4:"code";s:20:"bitfinex_bftbtc_high";s:4:"birg";s:8:"bitfinex";}i:1772;a:4:{s:5:"title";s:13:"BFT-ETH (mid)";s:6:"course";s:11:"0.000223545";s:4:"code";s:19:"bitfinex_bfteth_mid";s:4:"birg";s:8:"bitfinex";}i:1773;a:4:{s:5:"title";s:13:"BFT-ETH (bid)";s:6:"course";s:9:"0.0002171";s:4:"code";s:19:"bitfinex_bfteth_bid";s:4:"birg";s:8:"bitfinex";}i:1774;a:4:{s:5:"title";s:13:"BFT-ETH (ask)";s:6:"course";s:10:"0.00022999";s:4:"code";s:19:"bitfinex_bfteth_ask";s:4:"birg";s:8:"bitfinex";}i:1775;a:4:{s:5:"title";s:20:"BFT-ETH (last_price)";s:6:"course";s:7:"0.00021";s:4:"code";s:26:"bitfinex_bfteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1776;a:4:{s:5:"title";s:13:"BFT-ETH (low)";s:6:"course";s:6:"0.0002";s:4:"code";s:19:"bitfinex_bfteth_low";s:4:"birg";s:8:"bitfinex";}i:1777;a:4:{s:5:"title";s:14:"BFT-ETH (high)";s:6:"course";s:7:"0.00021";s:4:"code";s:20:"bitfinex_bfteth_high";s:4:"birg";s:8:"bitfinex";}i:1778;a:4:{s:5:"title";s:13:"MTN-USD (mid)";s:6:"course";s:8:"0.022923";s:4:"code";s:19:"bitfinex_mtnusd_mid";s:4:"birg";s:8:"bitfinex";}i:1779;a:4:{s:5:"title";s:13:"MTN-USD (bid)";s:6:"course";s:8:"0.021803";s:4:"code";s:19:"bitfinex_mtnusd_bid";s:4:"birg";s:8:"bitfinex";}i:1780;a:4:{s:5:"title";s:13:"MTN-USD (ask)";s:6:"course";s:8:"0.024043";s:4:"code";s:19:"bitfinex_mtnusd_ask";s:4:"birg";s:8:"bitfinex";}i:1781;a:4:{s:5:"title";s:20:"MTN-USD (last_price)";s:6:"course";s:8:"0.022169";s:4:"code";s:26:"bitfinex_mtnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1782;a:4:{s:5:"title";s:13:"MTN-USD (low)";s:6:"course";s:8:"0.021632";s:4:"code";s:19:"bitfinex_mtnusd_low";s:4:"birg";s:8:"bitfinex";}i:1783;a:4:{s:5:"title";s:14:"MTN-USD (high)";s:6:"course";s:8:"0.023853";s:4:"code";s:20:"bitfinex_mtnusd_high";s:4:"birg";s:8:"bitfinex";}i:1784;a:4:{s:5:"title";s:13:"MTN-BTC (mid)";s:6:"course";s:10:"0.00000338";s:4:"code";s:19:"bitfinex_mtnbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1785;a:4:{s:5:"title";s:13:"MTN-BTC (bid)";s:6:"course";s:10:"0.00000311";s:4:"code";s:19:"bitfinex_mtnbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1786;a:4:{s:5:"title";s:13:"MTN-BTC (ask)";s:6:"course";s:10:"0.00000365";s:4:"code";s:19:"bitfinex_mtnbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1787;a:4:{s:5:"title";s:20:"MTN-BTC (last_price)";s:6:"course";s:10:"0.00000364";s:4:"code";s:26:"bitfinex_mtnbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1788;a:4:{s:5:"title";s:13:"MTN-BTC (low)";s:6:"course";s:10:"0.00000364";s:4:"code";s:19:"bitfinex_mtnbtc_low";s:4:"birg";s:8:"bitfinex";}i:1789;a:4:{s:5:"title";s:14:"MTN-BTC (high)";s:6:"course";s:10:"0.00000364";s:4:"code";s:20:"bitfinex_mtnbtc_high";s:4:"birg";s:8:"bitfinex";}i:1790;a:4:{s:5:"title";s:13:"MTN-ETH (mid)";s:6:"course";s:11:"0.000112365";s:4:"code";s:19:"bitfinex_mtneth_mid";s:4:"birg";s:8:"bitfinex";}i:1791;a:4:{s:5:"title";s:13:"MTN-ETH (bid)";s:6:"course";s:10:"0.00009701";s:4:"code";s:19:"bitfinex_mtneth_bid";s:4:"birg";s:8:"bitfinex";}i:1792;a:4:{s:5:"title";s:13:"MTN-ETH (ask)";s:6:"course";s:10:"0.00012772";s:4:"code";s:19:"bitfinex_mtneth_ask";s:4:"birg";s:8:"bitfinex";}i:1793;a:4:{s:5:"title";s:20:"MTN-ETH (last_price)";s:6:"course";s:10:"0.00010401";s:4:"code";s:26:"bitfinex_mtneth_last_price";s:4:"birg";s:8:"bitfinex";}i:1794;a:4:{s:5:"title";s:13:"MTN-ETH (low)";s:6:"course";s:10:"0.00010401";s:4:"code";s:19:"bitfinex_mtneth_low";s:4:"birg";s:8:"bitfinex";}i:1795;a:4:{s:5:"title";s:14:"MTN-ETH (high)";s:6:"course";s:10:"0.00010401";s:4:"code";s:20:"bitfinex_mtneth_high";s:4:"birg";s:8:"bitfinex";}i:1796;a:4:{s:5:"title";s:13:"ODE-USD (mid)";s:6:"course";s:8:"0.147485";s:4:"code";s:19:"bitfinex_odeusd_mid";s:4:"birg";s:8:"bitfinex";}i:1797;a:4:{s:5:"title";s:13:"ODE-USD (bid)";s:6:"course";s:6:"0.1432";s:4:"code";s:19:"bitfinex_odeusd_bid";s:4:"birg";s:8:"bitfinex";}i:1798;a:4:{s:5:"title";s:13:"ODE-USD (ask)";s:6:"course";s:7:"0.15177";s:4:"code";s:19:"bitfinex_odeusd_ask";s:4:"birg";s:8:"bitfinex";}i:1799;a:4:{s:5:"title";s:20:"ODE-USD (last_price)";s:6:"course";s:7:"0.15154";s:4:"code";s:26:"bitfinex_odeusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1800;a:4:{s:5:"title";s:13:"ODE-USD (low)";s:6:"course";s:7:"0.13997";s:4:"code";s:19:"bitfinex_odeusd_low";s:4:"birg";s:8:"bitfinex";}i:1801;a:4:{s:5:"title";s:14:"ODE-USD (high)";s:6:"course";s:7:"0.17105";s:4:"code";s:20:"bitfinex_odeusd_high";s:4:"birg";s:8:"bitfinex";}i:1802;a:4:{s:5:"title";s:13:"ODE-BTC (mid)";s:6:"course";s:11:"0.000025455";s:4:"code";s:19:"bitfinex_odebtc_mid";s:4:"birg";s:8:"bitfinex";}i:1803;a:4:{s:5:"title";s:13:"ODE-BTC (bid)";s:6:"course";s:8:"0.000023";s:4:"code";s:19:"bitfinex_odebtc_bid";s:4:"birg";s:8:"bitfinex";}i:1804;a:4:{s:5:"title";s:13:"ODE-BTC (ask)";s:6:"course";s:10:"0.00002791";s:4:"code";s:19:"bitfinex_odebtc_ask";s:4:"birg";s:8:"bitfinex";}i:1805;a:4:{s:5:"title";s:20:"ODE-BTC (last_price)";s:6:"course";s:8:"0.000023";s:4:"code";s:26:"bitfinex_odebtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1806;a:4:{s:5:"title";s:13:"ODE-BTC (low)";s:6:"course";s:9:"0.0000225";s:4:"code";s:19:"bitfinex_odebtc_low";s:4:"birg";s:8:"bitfinex";}i:1807;a:4:{s:5:"title";s:14:"ODE-BTC (high)";s:6:"course";s:10:"0.00002447";s:4:"code";s:20:"bitfinex_odebtc_high";s:4:"birg";s:8:"bitfinex";}i:1808;a:4:{s:5:"title";s:13:"ODE-ETH (mid)";s:6:"course";s:11:"0.000736265";s:4:"code";s:19:"bitfinex_odeeth_mid";s:4:"birg";s:8:"bitfinex";}i:1809;a:4:{s:5:"title";s:13:"ODE-ETH (bid)";s:6:"course";s:10:"0.00072256";s:4:"code";s:19:"bitfinex_odeeth_bid";s:4:"birg";s:8:"bitfinex";}i:1810;a:4:{s:5:"title";s:13:"ODE-ETH (ask)";s:6:"course";s:10:"0.00074997";s:4:"code";s:19:"bitfinex_odeeth_ask";s:4:"birg";s:8:"bitfinex";}i:1811;a:4:{s:5:"title";s:20:"ODE-ETH (last_price)";s:6:"course";s:8:"0.000705";s:4:"code";s:26:"bitfinex_odeeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1812;a:4:{s:5:"title";s:13:"ODE-ETH (low)";s:6:"course";s:8:"0.000705";s:4:"code";s:19:"bitfinex_odeeth_low";s:4:"birg";s:8:"bitfinex";}i:1813;a:4:{s:5:"title";s:14:"ODE-ETH (high)";s:6:"course";s:6:"0.0008";s:4:"code";s:20:"bitfinex_odeeth_high";s:4:"birg";s:8:"bitfinex";}i:1814;a:4:{s:5:"title";s:13:"ANT-USD (mid)";s:6:"course";s:7:"0.79504";s:4:"code";s:19:"bitfinex_antusd_mid";s:4:"birg";s:8:"bitfinex";}i:1815;a:4:{s:5:"title";s:13:"ANT-USD (bid)";s:6:"course";s:7:"0.71876";s:4:"code";s:19:"bitfinex_antusd_bid";s:4:"birg";s:8:"bitfinex";}i:1816;a:4:{s:5:"title";s:13:"ANT-USD (ask)";s:6:"course";s:7:"0.87132";s:4:"code";s:19:"bitfinex_antusd_ask";s:4:"birg";s:8:"bitfinex";}i:1817;a:4:{s:5:"title";s:20:"ANT-USD (last_price)";s:6:"course";s:7:"0.84945";s:4:"code";s:26:"bitfinex_antusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1818;a:4:{s:5:"title";s:13:"ANT-USD (low)";s:6:"course";s:7:"0.84945";s:4:"code";s:19:"bitfinex_antusd_low";s:4:"birg";s:8:"bitfinex";}i:1819;a:4:{s:5:"title";s:14:"ANT-USD (high)";s:6:"course";s:7:"0.84945";s:4:"code";s:20:"bitfinex_antusd_high";s:4:"birg";s:8:"bitfinex";}i:1820;a:4:{s:5:"title";s:13:"ANT-BTC (mid)";s:6:"course";s:10:"0.00015196";s:4:"code";s:19:"bitfinex_antbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1821;a:4:{s:5:"title";s:13:"ANT-BTC (bid)";s:6:"course";s:10:"0.00010392";s:4:"code";s:19:"bitfinex_antbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1822;a:4:{s:5:"title";s:13:"ANT-BTC (ask)";s:6:"course";s:6:"0.0002";s:4:"code";s:19:"bitfinex_antbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1823;a:4:{s:5:"title";s:20:"ANT-BTC (last_price)";s:6:"course";s:10:"0.00010392";s:4:"code";s:26:"bitfinex_antbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1824;a:4:{s:5:"title";s:13:"ANT-ETH (mid)";s:6:"course";s:9:"0.0039575";s:4:"code";s:19:"bitfinex_anteth_mid";s:4:"birg";s:8:"bitfinex";}i:1825;a:4:{s:5:"title";s:13:"ANT-ETH (bid)";s:6:"course";s:6:"0.0036";s:4:"code";s:19:"bitfinex_anteth_bid";s:4:"birg";s:8:"bitfinex";}i:1826;a:4:{s:5:"title";s:13:"ANT-ETH (ask)";s:6:"course";s:8:"0.004315";s:4:"code";s:19:"bitfinex_anteth_ask";s:4:"birg";s:8:"bitfinex";}i:1827;a:4:{s:5:"title";s:20:"ANT-ETH (last_price)";s:6:"course";s:9:"0.0039266";s:4:"code";s:26:"bitfinex_anteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1828;a:4:{s:5:"title";s:13:"DTH-USD (mid)";s:6:"course";s:9:"0.0178105";s:4:"code";s:19:"bitfinex_dthusd_mid";s:4:"birg";s:8:"bitfinex";}i:1829;a:4:{s:5:"title";s:13:"DTH-USD (bid)";s:6:"course";s:8:"0.017709";s:4:"code";s:19:"bitfinex_dthusd_bid";s:4:"birg";s:8:"bitfinex";}i:1830;a:4:{s:5:"title";s:13:"DTH-USD (ask)";s:6:"course";s:8:"0.017912";s:4:"code";s:19:"bitfinex_dthusd_ask";s:4:"birg";s:8:"bitfinex";}i:1831;a:4:{s:5:"title";s:20:"DTH-USD (last_price)";s:6:"course";s:8:"0.017813";s:4:"code";s:26:"bitfinex_dthusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1832;a:4:{s:5:"title";s:13:"DTH-USD (low)";s:6:"course";s:8:"0.017813";s:4:"code";s:19:"bitfinex_dthusd_low";s:4:"birg";s:8:"bitfinex";}i:1833;a:4:{s:5:"title";s:14:"DTH-USD (high)";s:6:"course";s:8:"0.017909";s:4:"code";s:20:"bitfinex_dthusd_high";s:4:"birg";s:8:"bitfinex";}i:1834;a:4:{s:5:"title";s:13:"DTH-BTC (mid)";s:6:"course";s:11:"0.000002665";s:4:"code";s:19:"bitfinex_dthbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1835;a:4:{s:5:"title";s:13:"DTH-BTC (bid)";s:6:"course";s:10:"0.00000232";s:4:"code";s:19:"bitfinex_dthbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1836;a:4:{s:5:"title";s:13:"DTH-BTC (ask)";s:6:"course";s:10:"0.00000301";s:4:"code";s:19:"bitfinex_dthbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1837;a:4:{s:5:"title";s:20:"DTH-BTC (last_price)";s:6:"course";s:10:"0.00000232";s:4:"code";s:26:"bitfinex_dthbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1838;a:4:{s:5:"title";s:13:"DTH-BTC (low)";s:6:"course";s:10:"0.00000232";s:4:"code";s:19:"bitfinex_dthbtc_low";s:4:"birg";s:8:"bitfinex";}i:1839;a:4:{s:5:"title";s:14:"DTH-BTC (high)";s:6:"course";s:10:"0.00000232";s:4:"code";s:20:"bitfinex_dthbtc_high";s:4:"birg";s:8:"bitfinex";}i:1840;a:4:{s:5:"title";s:13:"DTH-ETH (mid)";s:6:"course";s:11:"0.000087045";s:4:"code";s:19:"bitfinex_dtheth_mid";s:4:"birg";s:8:"bitfinex";}i:1841;a:4:{s:5:"title";s:13:"DTH-ETH (bid)";s:6:"course";s:10:"0.00008703";s:4:"code";s:19:"bitfinex_dtheth_bid";s:4:"birg";s:8:"bitfinex";}i:1842;a:4:{s:5:"title";s:13:"DTH-ETH (ask)";s:6:"course";s:10:"0.00008706";s:4:"code";s:19:"bitfinex_dtheth_ask";s:4:"birg";s:8:"bitfinex";}i:1843;a:4:{s:5:"title";s:20:"DTH-ETH (last_price)";s:6:"course";s:10:"0.00008703";s:4:"code";s:26:"bitfinex_dtheth_last_price";s:4:"birg";s:8:"bitfinex";}i:1844;a:4:{s:5:"title";s:13:"DTH-ETH (low)";s:6:"course";s:10:"0.00008701";s:4:"code";s:19:"bitfinex_dtheth_low";s:4:"birg";s:8:"bitfinex";}i:1845;a:4:{s:5:"title";s:14:"DTH-ETH (high)";s:6:"course";s:10:"0.00008743";s:4:"code";s:20:"bitfinex_dtheth_high";s:4:"birg";s:8:"bitfinex";}i:1846;a:4:{s:5:"title";s:13:"MIT-USD (mid)";s:6:"course";s:8:"0.263555";s:4:"code";s:19:"bitfinex_mitusd_mid";s:4:"birg";s:8:"bitfinex";}i:1847;a:4:{s:5:"title";s:13:"MIT-USD (bid)";s:6:"course";s:7:"0.25111";s:4:"code";s:19:"bitfinex_mitusd_bid";s:4:"birg";s:8:"bitfinex";}i:1848;a:4:{s:5:"title";s:13:"MIT-USD (ask)";s:6:"course";s:5:"0.276";s:4:"code";s:19:"bitfinex_mitusd_ask";s:4:"birg";s:8:"bitfinex";}i:1849;a:4:{s:5:"title";s:20:"MIT-USD (last_price)";s:6:"course";s:5:"0.275";s:4:"code";s:26:"bitfinex_mitusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1850;a:4:{s:5:"title";s:13:"MIT-USD (low)";s:6:"course";s:7:"0.25111";s:4:"code";s:19:"bitfinex_mitusd_low";s:4:"birg";s:8:"bitfinex";}i:1851;a:4:{s:5:"title";s:14:"MIT-USD (high)";s:6:"course";s:5:"0.275";s:4:"code";s:20:"bitfinex_mitusd_high";s:4:"birg";s:8:"bitfinex";}i:1852;a:4:{s:5:"title";s:13:"MIT-BTC (mid)";s:6:"course";s:11:"0.000039155";s:4:"code";s:19:"bitfinex_mitbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1853;a:4:{s:5:"title";s:13:"MIT-BTC (bid)";s:6:"course";s:10:"0.00003566";s:4:"code";s:19:"bitfinex_mitbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1854;a:4:{s:5:"title";s:13:"MIT-BTC (ask)";s:6:"course";s:10:"0.00004265";s:4:"code";s:19:"bitfinex_mitbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1855;a:4:{s:5:"title";s:20:"MIT-BTC (last_price)";s:6:"course";s:10:"0.00003572";s:4:"code";s:26:"bitfinex_mitbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1856;a:4:{s:5:"title";s:13:"MIT-ETH (mid)";s:6:"course";s:10:"0.00124345";s:4:"code";s:19:"bitfinex_miteth_mid";s:4:"birg";s:8:"bitfinex";}i:1857;a:4:{s:5:"title";s:13:"MIT-ETH (bid)";s:6:"course";s:9:"0.0010568";s:4:"code";s:19:"bitfinex_miteth_bid";s:4:"birg";s:8:"bitfinex";}i:1858;a:4:{s:5:"title";s:13:"MIT-ETH (ask)";s:6:"course";s:9:"0.0014301";s:4:"code";s:19:"bitfinex_miteth_ask";s:4:"birg";s:8:"bitfinex";}i:1859;a:4:{s:5:"title";s:20:"MIT-ETH (last_price)";s:6:"course";s:6:"0.0012";s:4:"code";s:26:"bitfinex_miteth_last_price";s:4:"birg";s:8:"bitfinex";}i:1860;a:4:{s:5:"title";s:13:"STJ-USD (mid)";s:6:"course";s:8:"0.342525";s:4:"code";s:19:"bitfinex_stjusd_mid";s:4:"birg";s:8:"bitfinex";}i:1861;a:4:{s:5:"title";s:13:"STJ-USD (bid)";s:6:"course";s:7:"0.30806";s:4:"code";s:19:"bitfinex_stjusd_bid";s:4:"birg";s:8:"bitfinex";}i:1862;a:4:{s:5:"title";s:13:"STJ-USD (ask)";s:6:"course";s:7:"0.37699";s:4:"code";s:19:"bitfinex_stjusd_ask";s:4:"birg";s:8:"bitfinex";}i:1863;a:4:{s:5:"title";s:20:"STJ-USD (last_price)";s:6:"course";s:4:"0.33";s:4:"code";s:26:"bitfinex_stjusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1864;a:4:{s:5:"title";s:13:"STJ-USD (low)";s:6:"course";s:4:"0.33";s:4:"code";s:19:"bitfinex_stjusd_low";s:4:"birg";s:8:"bitfinex";}i:1865;a:4:{s:5:"title";s:14:"STJ-USD (high)";s:6:"course";s:4:"0.33";s:4:"code";s:20:"bitfinex_stjusd_high";s:4:"birg";s:8:"bitfinex";}i:1866;a:4:{s:5:"title";s:13:"STJ-BTC (mid)";s:6:"course";s:11:"0.000050965";s:4:"code";s:19:"bitfinex_stjbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1867;a:4:{s:5:"title";s:13:"STJ-BTC (bid)";s:6:"course";s:7:"0.00005";s:4:"code";s:19:"bitfinex_stjbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1868;a:4:{s:5:"title";s:13:"STJ-BTC (ask)";s:6:"course";s:10:"0.00005193";s:4:"code";s:19:"bitfinex_stjbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1869;a:4:{s:5:"title";s:20:"STJ-BTC (last_price)";s:6:"course";s:7:"0.00005";s:4:"code";s:26:"bitfinex_stjbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1870;a:4:{s:5:"title";s:13:"STJ-ETH (mid)";s:6:"course";s:9:"0.0024414";s:4:"code";s:19:"bitfinex_stjeth_mid";s:4:"birg";s:8:"bitfinex";}i:1871;a:4:{s:5:"title";s:13:"STJ-ETH (bid)";s:6:"course";s:9:"0.0014001";s:4:"code";s:19:"bitfinex_stjeth_bid";s:4:"birg";s:8:"bitfinex";}i:1872;a:4:{s:5:"title";s:13:"STJ-ETH (ask)";s:6:"course";s:9:"0.0034827";s:4:"code";s:19:"bitfinex_stjeth_ask";s:4:"birg";s:8:"bitfinex";}i:1873;a:4:{s:5:"title";s:20:"STJ-ETH (last_price)";s:6:"course";s:9:"0.0015993";s:4:"code";s:26:"bitfinex_stjeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1874;a:4:{s:5:"title";s:13:"XLM-USD (mid)";s:6:"course";s:8:"0.232975";s:4:"code";s:19:"bitfinex_xlmusd_mid";s:4:"birg";s:8:"bitfinex";}i:1875;a:4:{s:5:"title";s:13:"XLM-USD (bid)";s:6:"course";s:7:"0.23291";s:4:"code";s:19:"bitfinex_xlmusd_bid";s:4:"birg";s:8:"bitfinex";}i:1876;a:4:{s:5:"title";s:13:"XLM-USD (ask)";s:6:"course";s:7:"0.23304";s:4:"code";s:19:"bitfinex_xlmusd_ask";s:4:"birg";s:8:"bitfinex";}i:1877;a:4:{s:5:"title";s:20:"XLM-USD (last_price)";s:6:"course";s:10:"0.23291044";s:4:"code";s:26:"bitfinex_xlmusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1878;a:4:{s:5:"title";s:13:"XLM-USD (low)";s:6:"course";s:10:"0.23291044";s:4:"code";s:19:"bitfinex_xlmusd_low";s:4:"birg";s:8:"bitfinex";}i:1879;a:4:{s:5:"title";s:14:"XLM-USD (high)";s:6:"course";s:7:"0.23747";s:4:"code";s:20:"bitfinex_xlmusd_high";s:4:"birg";s:8:"bitfinex";}i:1880;a:4:{s:5:"title";s:13:"XLM-EUR (mid)";s:6:"course";s:7:"0.20393";s:4:"code";s:19:"bitfinex_xlmeur_mid";s:4:"birg";s:8:"bitfinex";}i:1881;a:4:{s:5:"title";s:13:"XLM-EUR (bid)";s:6:"course";s:7:"0.20387";s:4:"code";s:19:"bitfinex_xlmeur_bid";s:4:"birg";s:8:"bitfinex";}i:1882;a:4:{s:5:"title";s:13:"XLM-EUR (ask)";s:6:"course";s:7:"0.20399";s:4:"code";s:19:"bitfinex_xlmeur_ask";s:4:"birg";s:8:"bitfinex";}i:1883;a:4:{s:5:"title";s:20:"XLM-EUR (last_price)";s:6:"course";s:7:"0.20387";s:4:"code";s:26:"bitfinex_xlmeur_last_price";s:4:"birg";s:8:"bitfinex";}i:1884;a:4:{s:5:"title";s:13:"XLM-EUR (low)";s:6:"course";s:7:"0.20387";s:4:"code";s:19:"bitfinex_xlmeur_low";s:4:"birg";s:8:"bitfinex";}i:1885;a:4:{s:5:"title";s:14:"XLM-EUR (high)";s:6:"course";s:10:"0.20761597";s:4:"code";s:20:"bitfinex_xlmeur_high";s:4:"birg";s:8:"bitfinex";}i:1886;a:4:{s:5:"title";s:13:"XLM-JPY (mid)";s:6:"course";s:6:"26.069";s:4:"code";s:19:"bitfinex_xlmjpy_mid";s:4:"birg";s:8:"bitfinex";}i:1887;a:4:{s:5:"title";s:13:"XLM-JPY (bid)";s:6:"course";s:6:"26.061";s:4:"code";s:19:"bitfinex_xlmjpy_bid";s:4:"birg";s:8:"bitfinex";}i:1888;a:4:{s:5:"title";s:13:"XLM-JPY (ask)";s:6:"course";s:6:"26.077";s:4:"code";s:19:"bitfinex_xlmjpy_ask";s:4:"birg";s:8:"bitfinex";}i:1889;a:4:{s:5:"title";s:20:"XLM-JPY (last_price)";s:6:"course";s:11:"26.11399059";s:4:"code";s:26:"bitfinex_xlmjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1890;a:4:{s:5:"title";s:13:"XLM-JPY (low)";s:6:"course";s:11:"26.11399059";s:4:"code";s:19:"bitfinex_xlmjpy_low";s:4:"birg";s:8:"bitfinex";}i:1891;a:4:{s:5:"title";s:14:"XLM-JPY (high)";s:6:"course";s:11:"26.38156989";s:4:"code";s:20:"bitfinex_xlmjpy_high";s:4:"birg";s:8:"bitfinex";}i:1892;a:4:{s:5:"title";s:13:"XLM-GBP (mid)";s:6:"course";s:8:"0.181545";s:4:"code";s:19:"bitfinex_xlmgbp_mid";s:4:"birg";s:8:"bitfinex";}i:1893;a:4:{s:5:"title";s:13:"XLM-GBP (bid)";s:6:"course";s:7:"0.18149";s:4:"code";s:19:"bitfinex_xlmgbp_bid";s:4:"birg";s:8:"bitfinex";}i:1894;a:4:{s:5:"title";s:13:"XLM-GBP (ask)";s:6:"course";s:6:"0.1816";s:4:"code";s:19:"bitfinex_xlmgbp_ask";s:4:"birg";s:8:"bitfinex";}i:1895;a:4:{s:5:"title";s:20:"XLM-GBP (last_price)";s:6:"course";s:7:"0.18183";s:4:"code";s:26:"bitfinex_xlmgbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1896;a:4:{s:5:"title";s:13:"XLM-GBP (low)";s:6:"course";s:7:"0.18183";s:4:"code";s:19:"bitfinex_xlmgbp_low";s:4:"birg";s:8:"bitfinex";}i:1897;a:4:{s:5:"title";s:14:"XLM-GBP (high)";s:6:"course";s:7:"0.18204";s:4:"code";s:20:"bitfinex_xlmgbp_high";s:4:"birg";s:8:"bitfinex";}i:1898;a:4:{s:5:"title";s:13:"XLM-BTC (mid)";s:6:"course";s:10:"0.00003586";s:4:"code";s:19:"bitfinex_xlmbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1899;a:4:{s:5:"title";s:13:"XLM-BTC (bid)";s:6:"course";s:10:"0.00003578";s:4:"code";s:19:"bitfinex_xlmbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1900;a:4:{s:5:"title";s:13:"XLM-BTC (ask)";s:6:"course";s:10:"0.00003594";s:4:"code";s:19:"bitfinex_xlmbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1901;a:4:{s:5:"title";s:20:"XLM-BTC (last_price)";s:6:"course";s:10:"0.00003592";s:4:"code";s:26:"bitfinex_xlmbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1902;a:4:{s:5:"title";s:13:"XLM-BTC (low)";s:6:"course";s:10:"0.00003573";s:4:"code";s:19:"bitfinex_xlmbtc_low";s:4:"birg";s:8:"bitfinex";}i:1903;a:4:{s:5:"title";s:14:"XLM-BTC (high)";s:6:"course";s:10:"0.00003626";s:4:"code";s:20:"bitfinex_xlmbtc_high";s:4:"birg";s:8:"bitfinex";}i:1904;a:4:{s:5:"title";s:13:"XLM-ETH (mid)";s:6:"course";s:9:"0.0011455";s:4:"code";s:19:"bitfinex_xlmeth_mid";s:4:"birg";s:8:"bitfinex";}i:1905;a:4:{s:5:"title";s:13:"XLM-ETH (bid)";s:6:"course";s:9:"0.0011445";s:4:"code";s:19:"bitfinex_xlmeth_bid";s:4:"birg";s:8:"bitfinex";}i:1906;a:4:{s:5:"title";s:13:"XLM-ETH (ask)";s:6:"course";s:9:"0.0011465";s:4:"code";s:19:"bitfinex_xlmeth_ask";s:4:"birg";s:8:"bitfinex";}i:1907;a:4:{s:5:"title";s:20:"XLM-ETH (last_price)";s:6:"course";s:9:"0.0011579";s:4:"code";s:26:"bitfinex_xlmeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1908;a:4:{s:5:"title";s:13:"XLM-ETH (low)";s:6:"course";s:9:"0.0011462";s:4:"code";s:19:"bitfinex_xlmeth_low";s:4:"birg";s:8:"bitfinex";}i:1909;a:4:{s:5:"title";s:14:"XLM-ETH (high)";s:6:"course";s:9:"0.0011579";s:4:"code";s:20:"bitfinex_xlmeth_high";s:4:"birg";s:8:"bitfinex";}i:1910;a:4:{s:5:"title";s:13:"XVG-USD (mid)";s:6:"course";s:9:"0.0148045";s:4:"code";s:19:"bitfinex_xvgusd_mid";s:4:"birg";s:8:"bitfinex";}i:1911;a:4:{s:5:"title";s:13:"XVG-USD (bid)";s:6:"course";s:7:"0.01473";s:4:"code";s:19:"bitfinex_xvgusd_bid";s:4:"birg";s:8:"bitfinex";}i:1912;a:4:{s:5:"title";s:13:"XVG-USD (ask)";s:6:"course";s:8:"0.014879";s:4:"code";s:19:"bitfinex_xvgusd_ask";s:4:"birg";s:8:"bitfinex";}i:1913;a:4:{s:5:"title";s:20:"XVG-USD (last_price)";s:6:"course";s:8:"0.014834";s:4:"code";s:26:"bitfinex_xvgusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1914;a:4:{s:5:"title";s:13:"XVG-USD (low)";s:6:"course";s:7:"0.01474";s:4:"code";s:19:"bitfinex_xvgusd_low";s:4:"birg";s:8:"bitfinex";}i:1915;a:4:{s:5:"title";s:14:"XVG-USD (high)";s:6:"course";s:8:"0.015263";s:4:"code";s:20:"bitfinex_xvgusd_high";s:4:"birg";s:8:"bitfinex";}i:1916;a:4:{s:5:"title";s:13:"XVG-EUR (mid)";s:6:"course";s:9:"0.0129575";s:4:"code";s:19:"bitfinex_xvgeur_mid";s:4:"birg";s:8:"bitfinex";}i:1917;a:4:{s:5:"title";s:13:"XVG-EUR (bid)";s:6:"course";s:8:"0.012893";s:4:"code";s:19:"bitfinex_xvgeur_bid";s:4:"birg";s:8:"bitfinex";}i:1918;a:4:{s:5:"title";s:13:"XVG-EUR (ask)";s:6:"course";s:8:"0.013022";s:4:"code";s:19:"bitfinex_xvgeur_ask";s:4:"birg";s:8:"bitfinex";}i:1919;a:4:{s:5:"title";s:20:"XVG-EUR (last_price)";s:6:"course";s:10:"0.01303519";s:4:"code";s:26:"bitfinex_xvgeur_last_price";s:4:"birg";s:8:"bitfinex";}i:1920;a:4:{s:5:"title";s:13:"XVG-EUR (low)";s:6:"course";s:10:"0.01303519";s:4:"code";s:19:"bitfinex_xvgeur_low";s:4:"birg";s:8:"bitfinex";}i:1921;a:4:{s:5:"title";s:14:"XVG-EUR (high)";s:6:"course";s:10:"0.01313848";s:4:"code";s:20:"bitfinex_xvgeur_high";s:4:"birg";s:8:"bitfinex";}i:1922;a:4:{s:5:"title";s:13:"XVG-JPY (mid)";s:6:"course";s:6:"1.6564";s:4:"code";s:19:"bitfinex_xvgjpy_mid";s:4:"birg";s:8:"bitfinex";}i:1923;a:4:{s:5:"title";s:13:"XVG-JPY (bid)";s:6:"course";s:6:"1.6482";s:4:"code";s:19:"bitfinex_xvgjpy_bid";s:4:"birg";s:8:"bitfinex";}i:1924;a:4:{s:5:"title";s:13:"XVG-JPY (ask)";s:6:"course";s:6:"1.6646";s:4:"code";s:19:"bitfinex_xvgjpy_ask";s:4:"birg";s:8:"bitfinex";}i:1925;a:4:{s:5:"title";s:20:"XVG-JPY (last_price)";s:6:"course";s:10:"1.66491548";s:4:"code";s:26:"bitfinex_xvgjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:1926;a:4:{s:5:"title";s:13:"XVG-JPY (low)";s:6:"course";s:10:"1.66491548";s:4:"code";s:19:"bitfinex_xvgjpy_low";s:4:"birg";s:8:"bitfinex";}i:1927;a:4:{s:5:"title";s:14:"XVG-JPY (high)";s:6:"course";s:10:"1.66491548";s:4:"code";s:20:"bitfinex_xvgjpy_high";s:4:"birg";s:8:"bitfinex";}i:1928;a:4:{s:5:"title";s:13:"XVG-GBP (mid)";s:6:"course";s:8:"0.011535";s:4:"code";s:19:"bitfinex_xvggbp_mid";s:4:"birg";s:8:"bitfinex";}i:1929;a:4:{s:5:"title";s:13:"XVG-GBP (bid)";s:6:"course";s:8:"0.011478";s:4:"code";s:19:"bitfinex_xvggbp_bid";s:4:"birg";s:8:"bitfinex";}i:1930;a:4:{s:5:"title";s:13:"XVG-GBP (ask)";s:6:"course";s:8:"0.011592";s:4:"code";s:19:"bitfinex_xvggbp_ask";s:4:"birg";s:8:"bitfinex";}i:1931;a:4:{s:5:"title";s:20:"XVG-GBP (last_price)";s:6:"course";s:8:"0.011223";s:4:"code";s:26:"bitfinex_xvggbp_last_price";s:4:"birg";s:8:"bitfinex";}i:1932;a:4:{s:5:"title";s:13:"XVG-BTC (mid)";s:6:"course";s:11:"0.000002285";s:4:"code";s:19:"bitfinex_xvgbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1933;a:4:{s:5:"title";s:13:"XVG-BTC (bid)";s:6:"course";s:10:"0.00000228";s:4:"code";s:19:"bitfinex_xvgbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1934;a:4:{s:5:"title";s:13:"XVG-BTC (ask)";s:6:"course";s:10:"0.00000229";s:4:"code";s:19:"bitfinex_xvgbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1935;a:4:{s:5:"title";s:20:"XVG-BTC (last_price)";s:6:"course";s:10:"0.00000228";s:4:"code";s:26:"bitfinex_xvgbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1936;a:4:{s:5:"title";s:13:"XVG-BTC (low)";s:6:"course";s:10:"0.00000224";s:4:"code";s:19:"bitfinex_xvgbtc_low";s:4:"birg";s:8:"bitfinex";}i:1937;a:4:{s:5:"title";s:14:"XVG-BTC (high)";s:6:"course";s:10:"0.00000233";s:4:"code";s:20:"bitfinex_xvgbtc_high";s:4:"birg";s:8:"bitfinex";}i:1938;a:4:{s:5:"title";s:13:"XVG-ETH (mid)";s:6:"course";s:11:"0.000072495";s:4:"code";s:19:"bitfinex_xvgeth_mid";s:4:"birg";s:8:"bitfinex";}i:1939;a:4:{s:5:"title";s:13:"XVG-ETH (bid)";s:6:"course";s:10:"0.00007199";s:4:"code";s:19:"bitfinex_xvgeth_bid";s:4:"birg";s:8:"bitfinex";}i:1940;a:4:{s:5:"title";s:13:"XVG-ETH (ask)";s:6:"course";s:8:"0.000073";s:4:"code";s:19:"bitfinex_xvgeth_ask";s:4:"birg";s:8:"bitfinex";}i:1941;a:4:{s:5:"title";s:20:"XVG-ETH (last_price)";s:6:"course";s:10:"0.00007369";s:4:"code";s:26:"bitfinex_xvgeth_last_price";s:4:"birg";s:8:"bitfinex";}i:1942;a:4:{s:5:"title";s:13:"XVG-ETH (low)";s:6:"course";s:10:"0.00007273";s:4:"code";s:19:"bitfinex_xvgeth_low";s:4:"birg";s:8:"bitfinex";}i:1943;a:4:{s:5:"title";s:14:"XVG-ETH (high)";s:6:"course";s:10:"0.00007482";s:4:"code";s:20:"bitfinex_xvgeth_high";s:4:"birg";s:8:"bitfinex";}i:1944;a:4:{s:5:"title";s:13:"BCI-USD (mid)";s:6:"course";s:8:"0.765365";s:4:"code";s:19:"bitfinex_bciusd_mid";s:4:"birg";s:8:"bitfinex";}i:1945;a:4:{s:5:"title";s:13:"BCI-USD (bid)";s:6:"course";s:7:"0.74121";s:4:"code";s:19:"bitfinex_bciusd_bid";s:4:"birg";s:8:"bitfinex";}i:1946;a:4:{s:5:"title";s:13:"BCI-USD (ask)";s:6:"course";s:7:"0.78952";s:4:"code";s:19:"bitfinex_bciusd_ask";s:4:"birg";s:8:"bitfinex";}i:1947;a:4:{s:5:"title";s:20:"BCI-USD (last_price)";s:6:"course";s:4:"0.75";s:4:"code";s:26:"bitfinex_bciusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1948;a:4:{s:5:"title";s:13:"BCI-USD (low)";s:6:"course";s:7:"0.74111";s:4:"code";s:19:"bitfinex_bciusd_low";s:4:"birg";s:8:"bitfinex";}i:1949;a:4:{s:5:"title";s:14:"BCI-USD (high)";s:6:"course";s:3:"0.8";s:4:"code";s:20:"bitfinex_bciusd_high";s:4:"birg";s:8:"bitfinex";}i:1950;a:4:{s:5:"title";s:13:"BCI-BTC (mid)";s:6:"course";s:11:"0.000119145";s:4:"code";s:19:"bitfinex_bcibtc_mid";s:4:"birg";s:8:"bitfinex";}i:1951;a:4:{s:5:"title";s:13:"BCI-BTC (bid)";s:6:"course";s:9:"0.0001155";s:4:"code";s:19:"bitfinex_bcibtc_bid";s:4:"birg";s:8:"bitfinex";}i:1952;a:4:{s:5:"title";s:13:"BCI-BTC (ask)";s:6:"course";s:10:"0.00012279";s:4:"code";s:19:"bitfinex_bcibtc_ask";s:4:"birg";s:8:"bitfinex";}i:1953;a:4:{s:5:"title";s:20:"BCI-BTC (last_price)";s:6:"course";s:8:"0.000122";s:4:"code";s:26:"bitfinex_bcibtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1954;a:4:{s:5:"title";s:13:"BCI-BTC (low)";s:6:"course";s:9:"0.0001155";s:4:"code";s:19:"bitfinex_bcibtc_low";s:4:"birg";s:8:"bitfinex";}i:1955;a:4:{s:5:"title";s:14:"BCI-BTC (high)";s:6:"course";s:10:"0.00012284";s:4:"code";s:20:"bitfinex_bcibtc_high";s:4:"birg";s:8:"bitfinex";}i:1956;a:4:{s:5:"title";s:13:"MKR-USD (mid)";s:6:"course";s:6:"619.95";s:4:"code";s:19:"bitfinex_mkrusd_mid";s:4:"birg";s:8:"bitfinex";}i:1957;a:4:{s:5:"title";s:13:"MKR-USD (bid)";s:6:"course";s:6:"613.14";s:4:"code";s:19:"bitfinex_mkrusd_bid";s:4:"birg";s:8:"bitfinex";}i:1958;a:4:{s:5:"title";s:13:"MKR-USD (ask)";s:6:"course";s:6:"626.76";s:4:"code";s:19:"bitfinex_mkrusd_ask";s:4:"birg";s:8:"bitfinex";}i:1959;a:4:{s:5:"title";s:20:"MKR-USD (last_price)";s:6:"course";s:6:"628.73";s:4:"code";s:26:"bitfinex_mkrusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1960;a:4:{s:5:"title";s:13:"MKR-USD (low)";s:6:"course";s:6:"617.48";s:4:"code";s:19:"bitfinex_mkrusd_low";s:4:"birg";s:8:"bitfinex";}i:1961;a:4:{s:5:"title";s:14:"MKR-USD (high)";s:6:"course";s:3:"650";s:4:"code";s:20:"bitfinex_mkrusd_high";s:4:"birg";s:8:"bitfinex";}i:1962;a:4:{s:5:"title";s:13:"MKR-BTC (mid)";s:6:"course";s:9:"0.0953895";s:4:"code";s:19:"bitfinex_mkrbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1963;a:4:{s:5:"title";s:13:"MKR-BTC (bid)";s:6:"course";s:8:"0.094431";s:4:"code";s:19:"bitfinex_mkrbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1964;a:4:{s:5:"title";s:13:"MKR-BTC (ask)";s:6:"course";s:8:"0.096348";s:4:"code";s:19:"bitfinex_mkrbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1965;a:4:{s:5:"title";s:20:"MKR-BTC (last_price)";s:6:"course";s:8:"0.097432";s:4:"code";s:26:"bitfinex_mkrbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1966;a:4:{s:5:"title";s:13:"MKR-BTC (low)";s:6:"course";s:8:"0.096958";s:4:"code";s:19:"bitfinex_mkrbtc_low";s:4:"birg";s:8:"bitfinex";}i:1967;a:4:{s:5:"title";s:14:"MKR-BTC (high)";s:6:"course";s:8:"0.098969";s:4:"code";s:20:"bitfinex_mkrbtc_high";s:4:"birg";s:8:"bitfinex";}i:1968;a:4:{s:5:"title";s:13:"MKR-ETH (mid)";s:6:"course";s:5:"3.041";s:4:"code";s:19:"bitfinex_mkreth_mid";s:4:"birg";s:8:"bitfinex";}i:1969;a:4:{s:5:"title";s:13:"MKR-ETH (bid)";s:6:"course";s:6:"2.9896";s:4:"code";s:19:"bitfinex_mkreth_bid";s:4:"birg";s:8:"bitfinex";}i:1970;a:4:{s:5:"title";s:13:"MKR-ETH (ask)";s:6:"course";s:6:"3.0924";s:4:"code";s:19:"bitfinex_mkreth_ask";s:4:"birg";s:8:"bitfinex";}i:1971;a:4:{s:5:"title";s:20:"MKR-ETH (last_price)";s:6:"course";s:4:"3.03";s:4:"code";s:26:"bitfinex_mkreth_last_price";s:4:"birg";s:8:"bitfinex";}i:1972;a:4:{s:5:"title";s:13:"MKR-ETH (low)";s:6:"course";s:4:"3.03";s:4:"code";s:19:"bitfinex_mkreth_low";s:4:"birg";s:8:"bitfinex";}i:1973;a:4:{s:5:"title";s:14:"MKR-ETH (high)";s:6:"course";s:6:"3.1741";s:4:"code";s:20:"bitfinex_mkreth_high";s:4:"birg";s:8:"bitfinex";}i:1974;a:4:{s:5:"title";s:13:"KNC-USD (mid)";s:6:"course";s:7:"0.47838";s:4:"code";s:19:"bitfinex_kncusd_mid";s:4:"birg";s:8:"bitfinex";}i:1975;a:4:{s:5:"title";s:13:"KNC-USD (bid)";s:6:"course";s:7:"0.46316";s:4:"code";s:19:"bitfinex_kncusd_bid";s:4:"birg";s:8:"bitfinex";}i:1976;a:4:{s:5:"title";s:13:"KNC-USD (ask)";s:6:"course";s:6:"0.4936";s:4:"code";s:19:"bitfinex_kncusd_ask";s:4:"birg";s:8:"bitfinex";}i:1977;a:4:{s:5:"title";s:20:"KNC-USD (last_price)";s:6:"course";s:7:"0.46746";s:4:"code";s:26:"bitfinex_kncusd_last_price";s:4:"birg";s:8:"bitfinex";}i:1978;a:4:{s:5:"title";s:13:"KNC-USD (low)";s:6:"course";s:7:"0.46172";s:4:"code";s:19:"bitfinex_kncusd_low";s:4:"birg";s:8:"bitfinex";}i:1979;a:4:{s:5:"title";s:14:"KNC-USD (high)";s:6:"course";s:7:"0.56222";s:4:"code";s:20:"bitfinex_kncusd_high";s:4:"birg";s:8:"bitfinex";}i:1980;a:4:{s:5:"title";s:13:"KNC-BTC (mid)";s:6:"course";s:10:"0.00007191";s:4:"code";s:19:"bitfinex_kncbtc_mid";s:4:"birg";s:8:"bitfinex";}i:1981;a:4:{s:5:"title";s:13:"KNC-BTC (bid)";s:6:"course";s:10:"0.00007145";s:4:"code";s:19:"bitfinex_kncbtc_bid";s:4:"birg";s:8:"bitfinex";}i:1982;a:4:{s:5:"title";s:13:"KNC-BTC (ask)";s:6:"course";s:10:"0.00007237";s:4:"code";s:19:"bitfinex_kncbtc_ask";s:4:"birg";s:8:"bitfinex";}i:1983;a:4:{s:5:"title";s:20:"KNC-BTC (last_price)";s:6:"course";s:10:"0.00007217";s:4:"code";s:26:"bitfinex_kncbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:1984;a:4:{s:5:"title";s:13:"KNC-BTC (low)";s:6:"course";s:10:"0.00007153";s:4:"code";s:19:"bitfinex_kncbtc_low";s:4:"birg";s:8:"bitfinex";}i:1985;a:4:{s:5:"title";s:14:"KNC-BTC (high)";s:6:"course";s:10:"0.00008386";s:4:"code";s:20:"bitfinex_kncbtc_high";s:4:"birg";s:8:"bitfinex";}i:1986;a:4:{s:5:"title";s:13:"KNC-ETH (mid)";s:6:"course";s:9:"0.0024012";s:4:"code";s:19:"bitfinex_knceth_mid";s:4:"birg";s:8:"bitfinex";}i:1987;a:4:{s:5:"title";s:13:"KNC-ETH (bid)";s:6:"course";s:9:"0.0022733";s:4:"code";s:19:"bitfinex_knceth_bid";s:4:"birg";s:8:"bitfinex";}i:1988;a:4:{s:5:"title";s:13:"KNC-ETH (ask)";s:6:"course";s:9:"0.0025291";s:4:"code";s:19:"bitfinex_knceth_ask";s:4:"birg";s:8:"bitfinex";}i:1989;a:4:{s:5:"title";s:20:"KNC-ETH (last_price)";s:6:"course";s:9:"0.0022891";s:4:"code";s:26:"bitfinex_knceth_last_price";s:4:"birg";s:8:"bitfinex";}i:1990;a:4:{s:5:"title";s:13:"KNC-ETH (low)";s:6:"course";s:9:"0.0022754";s:4:"code";s:19:"bitfinex_knceth_low";s:4:"birg";s:8:"bitfinex";}i:1991;a:4:{s:5:"title";s:14:"KNC-ETH (high)";s:6:"course";s:9:"0.0025407";s:4:"code";s:20:"bitfinex_knceth_high";s:4:"birg";s:8:"bitfinex";}i:1992;a:4:{s:5:"title";s:13:"POA-USD (mid)";s:6:"course";s:7:"0.11599";s:4:"code";s:19:"bitfinex_poausd_mid";s:4:"birg";s:8:"bitfinex";}i:1993;a:4:{s:5:"title";s:13:"POA-USD (bid)";s:6:"course";s:6:"0.1101";s:4:"code";s:19:"bitfinex_poausd_bid";s:4:"birg";s:8:"bitfinex";}i:1994;a:4:{s:5:"title";s:13:"POA-USD (ask)";s:6:"course";s:7:"0.12188";s:4:"code";s:19:"bitfinex_poausd_ask";s:4:"birg";s:8:"bitfinex";}i:1995;a:4:{s:5:"title";s:20:"POA-USD (last_price)";s:6:"course";s:7:"0.11152";s:4:"code";s:26:"bitfinex_poausd_last_price";s:4:"birg";s:8:"bitfinex";}i:1996;a:4:{s:5:"title";s:13:"POA-BTC (mid)";s:6:"course";s:11:"0.000017275";s:4:"code";s:19:"bitfinex_poabtc_mid";s:4:"birg";s:8:"bitfinex";}i:1997;a:4:{s:5:"title";s:13:"POA-BTC (bid)";s:6:"course";s:10:"0.00001655";s:4:"code";s:19:"bitfinex_poabtc_bid";s:4:"birg";s:8:"bitfinex";}i:1998;a:4:{s:5:"title";s:13:"POA-BTC (ask)";s:6:"course";s:8:"0.000018";s:4:"code";s:19:"bitfinex_poabtc_ask";s:4:"birg";s:8:"bitfinex";}i:1999;a:4:{s:5:"title";s:20:"POA-BTC (last_price)";s:6:"course";s:10:"0.00001655";s:4:"code";s:26:"bitfinex_poabtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2000;a:4:{s:5:"title";s:13:"POA-BTC (low)";s:6:"course";s:10:"0.00001655";s:4:"code";s:19:"bitfinex_poabtc_low";s:4:"birg";s:8:"bitfinex";}i:2001;a:4:{s:5:"title";s:14:"POA-BTC (high)";s:6:"course";s:8:"0.000018";s:4:"code";s:20:"bitfinex_poabtc_high";s:4:"birg";s:8:"bitfinex";}i:2002;a:4:{s:5:"title";s:13:"POA-ETH (mid)";s:6:"course";s:11:"0.000684545";s:4:"code";s:19:"bitfinex_poaeth_mid";s:4:"birg";s:8:"bitfinex";}i:2003;a:4:{s:5:"title";s:13:"POA-ETH (bid)";s:6:"course";s:10:"0.00049013";s:4:"code";s:19:"bitfinex_poaeth_bid";s:4:"birg";s:8:"bitfinex";}i:2004;a:4:{s:5:"title";s:13:"POA-ETH (ask)";s:6:"course";s:10:"0.00087896";s:4:"code";s:19:"bitfinex_poaeth_ask";s:4:"birg";s:8:"bitfinex";}i:2005;a:4:{s:5:"title";s:20:"POA-ETH (last_price)";s:6:"course";s:10:"0.00052604";s:4:"code";s:26:"bitfinex_poaeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2006;a:4:{s:5:"title";s:13:"LYM-USD (mid)";s:6:"course";s:8:"0.017799";s:4:"code";s:19:"bitfinex_lymusd_mid";s:4:"birg";s:8:"bitfinex";}i:2007;a:4:{s:5:"title";s:13:"LYM-USD (bid)";s:6:"course";s:6:"0.0177";s:4:"code";s:19:"bitfinex_lymusd_bid";s:4:"birg";s:8:"bitfinex";}i:2008;a:4:{s:5:"title";s:13:"LYM-USD (ask)";s:6:"course";s:8:"0.017898";s:4:"code";s:19:"bitfinex_lymusd_ask";s:4:"birg";s:8:"bitfinex";}i:2009;a:4:{s:5:"title";s:20:"LYM-USD (last_price)";s:6:"course";s:6:"0.0178";s:4:"code";s:26:"bitfinex_lymusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2010;a:4:{s:5:"title";s:13:"LYM-USD (low)";s:6:"course";s:6:"0.0178";s:4:"code";s:19:"bitfinex_lymusd_low";s:4:"birg";s:8:"bitfinex";}i:2011;a:4:{s:5:"title";s:14:"LYM-USD (high)";s:6:"course";s:8:"0.018144";s:4:"code";s:20:"bitfinex_lymusd_high";s:4:"birg";s:8:"bitfinex";}i:2012;a:4:{s:5:"title";s:13:"LYM-BTC (mid)";s:6:"course";s:10:"0.00000273";s:4:"code";s:19:"bitfinex_lymbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2013;a:4:{s:5:"title";s:13:"LYM-BTC (bid)";s:6:"course";s:10:"0.00000272";s:4:"code";s:19:"bitfinex_lymbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2014;a:4:{s:5:"title";s:13:"LYM-BTC (ask)";s:6:"course";s:10:"0.00000274";s:4:"code";s:19:"bitfinex_lymbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2015;a:4:{s:5:"title";s:20:"LYM-BTC (last_price)";s:6:"course";s:10:"0.00000273";s:4:"code";s:26:"bitfinex_lymbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2016;a:4:{s:5:"title";s:13:"LYM-BTC (low)";s:6:"course";s:10:"0.00000272";s:4:"code";s:19:"bitfinex_lymbtc_low";s:4:"birg";s:8:"bitfinex";}i:2017;a:4:{s:5:"title";s:14:"LYM-BTC (high)";s:6:"course";s:10:"0.00000279";s:4:"code";s:20:"bitfinex_lymbtc_high";s:4:"birg";s:8:"bitfinex";}i:2018;a:4:{s:5:"title";s:13:"LYM-ETH (mid)";s:6:"course";s:11:"0.000087325";s:4:"code";s:19:"bitfinex_lymeth_mid";s:4:"birg";s:8:"bitfinex";}i:2019;a:4:{s:5:"title";s:13:"LYM-ETH (bid)";s:6:"course";s:10:"0.00008717";s:4:"code";s:19:"bitfinex_lymeth_bid";s:4:"birg";s:8:"bitfinex";}i:2020;a:4:{s:5:"title";s:13:"LYM-ETH (ask)";s:6:"course";s:10:"0.00008748";s:4:"code";s:19:"bitfinex_lymeth_ask";s:4:"birg";s:8:"bitfinex";}i:2021;a:4:{s:5:"title";s:20:"LYM-ETH (last_price)";s:6:"course";s:9:"0.0000875";s:4:"code";s:26:"bitfinex_lymeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2022;a:4:{s:5:"title";s:13:"LYM-ETH (low)";s:6:"course";s:10:"0.00008657";s:4:"code";s:19:"bitfinex_lymeth_low";s:4:"birg";s:8:"bitfinex";}i:2023;a:4:{s:5:"title";s:14:"LYM-ETH (high)";s:6:"course";s:10:"0.00008851";s:4:"code";s:20:"bitfinex_lymeth_high";s:4:"birg";s:8:"bitfinex";}i:2024;a:4:{s:5:"title";s:13:"UTK-USD (mid)";s:6:"course";s:8:"0.031717";s:4:"code";s:19:"bitfinex_utkusd_mid";s:4:"birg";s:8:"bitfinex";}i:2025;a:4:{s:5:"title";s:13:"UTK-USD (bid)";s:6:"course";s:8:"0.025777";s:4:"code";s:19:"bitfinex_utkusd_bid";s:4:"birg";s:8:"bitfinex";}i:2026;a:4:{s:5:"title";s:13:"UTK-USD (ask)";s:6:"course";s:8:"0.037657";s:4:"code";s:19:"bitfinex_utkusd_ask";s:4:"birg";s:8:"bitfinex";}i:2027;a:4:{s:5:"title";s:20:"UTK-USD (last_price)";s:6:"course";s:5:"0.032";s:4:"code";s:26:"bitfinex_utkusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2028;a:4:{s:5:"title";s:13:"UTK-BTC (mid)";s:6:"course";s:11:"0.000005165";s:4:"code";s:19:"bitfinex_utkbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2029;a:4:{s:5:"title";s:13:"UTK-BTC (bid)";s:6:"course";s:10:"0.00000514";s:4:"code";s:19:"bitfinex_utkbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2030;a:4:{s:5:"title";s:13:"UTK-BTC (ask)";s:6:"course";s:10:"0.00000519";s:4:"code";s:19:"bitfinex_utkbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2031;a:4:{s:5:"title";s:20:"UTK-BTC (last_price)";s:6:"course";s:10:"0.00000515";s:4:"code";s:26:"bitfinex_utkbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2032;a:4:{s:5:"title";s:13:"UTK-BTC (low)";s:6:"course";s:10:"0.00000501";s:4:"code";s:19:"bitfinex_utkbtc_low";s:4:"birg";s:8:"bitfinex";}i:2033;a:4:{s:5:"title";s:14:"UTK-BTC (high)";s:6:"course";s:10:"0.00000527";s:4:"code";s:20:"bitfinex_utkbtc_high";s:4:"birg";s:8:"bitfinex";}i:2034;a:4:{s:5:"title";s:13:"UTK-ETH (mid)";s:6:"course";s:10:"0.00016455";s:4:"code";s:19:"bitfinex_utketh_mid";s:4:"birg";s:8:"bitfinex";}i:2035;a:4:{s:5:"title";s:13:"UTK-ETH (bid)";s:6:"course";s:10:"0.00016373";s:4:"code";s:19:"bitfinex_utketh_bid";s:4:"birg";s:8:"bitfinex";}i:2036;a:4:{s:5:"title";s:13:"UTK-ETH (ask)";s:6:"course";s:10:"0.00016537";s:4:"code";s:19:"bitfinex_utketh_ask";s:4:"birg";s:8:"bitfinex";}i:2037;a:4:{s:5:"title";s:20:"UTK-ETH (last_price)";s:6:"course";s:10:"0.00016406";s:4:"code";s:26:"bitfinex_utketh_last_price";s:4:"birg";s:8:"bitfinex";}i:2038;a:4:{s:5:"title";s:13:"UTK-ETH (low)";s:6:"course";s:10:"0.00015926";s:4:"code";s:19:"bitfinex_utketh_low";s:4:"birg";s:8:"bitfinex";}i:2039;a:4:{s:5:"title";s:14:"UTK-ETH (high)";s:6:"course";s:10:"0.00016837";s:4:"code";s:20:"bitfinex_utketh_high";s:4:"birg";s:8:"bitfinex";}i:2040;a:4:{s:5:"title";s:13:"VEE-USD (mid)";s:6:"course";s:10:"0.00976825";s:4:"code";s:19:"bitfinex_veeusd_mid";s:4:"birg";s:8:"bitfinex";}i:2041;a:4:{s:5:"title";s:13:"VEE-USD (bid)";s:6:"course";s:9:"0.0090085";s:4:"code";s:19:"bitfinex_veeusd_bid";s:4:"birg";s:8:"bitfinex";}i:2042;a:4:{s:5:"title";s:13:"VEE-USD (ask)";s:6:"course";s:8:"0.010528";s:4:"code";s:19:"bitfinex_veeusd_ask";s:4:"birg";s:8:"bitfinex";}i:2043;a:4:{s:5:"title";s:20:"VEE-USD (last_price)";s:6:"course";s:8:"0.009751";s:4:"code";s:26:"bitfinex_veeusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2044;a:4:{s:5:"title";s:13:"VEE-USD (low)";s:6:"course";s:9:"0.0097319";s:4:"code";s:19:"bitfinex_veeusd_low";s:4:"birg";s:8:"bitfinex";}i:2045;a:4:{s:5:"title";s:14:"VEE-USD (high)";s:6:"course";s:8:"0.009751";s:4:"code";s:20:"bitfinex_veeusd_high";s:4:"birg";s:8:"bitfinex";}i:2046;a:4:{s:5:"title";s:13:"VEE-BTC (mid)";s:6:"course";s:11:"0.000001485";s:4:"code";s:19:"bitfinex_veebtc_mid";s:4:"birg";s:8:"bitfinex";}i:2047;a:4:{s:5:"title";s:13:"VEE-BTC (bid)";s:6:"course";s:10:"0.00000127";s:4:"code";s:19:"bitfinex_veebtc_bid";s:4:"birg";s:8:"bitfinex";}i:2048;a:4:{s:5:"title";s:13:"VEE-BTC (ask)";s:6:"course";s:9:"0.0000017";s:4:"code";s:19:"bitfinex_veebtc_ask";s:4:"birg";s:8:"bitfinex";}i:2049;a:4:{s:5:"title";s:20:"VEE-BTC (last_price)";s:6:"course";s:10:"0.00000144";s:4:"code";s:26:"bitfinex_veebtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2050;a:4:{s:5:"title";s:13:"VEE-BTC (low)";s:6:"course";s:10:"0.00000144";s:4:"code";s:19:"bitfinex_veebtc_low";s:4:"birg";s:8:"bitfinex";}i:2051;a:4:{s:5:"title";s:14:"VEE-BTC (high)";s:6:"course";s:10:"0.00000144";s:4:"code";s:20:"bitfinex_veebtc_high";s:4:"birg";s:8:"bitfinex";}i:2052;a:4:{s:5:"title";s:13:"VEE-ETH (mid)";s:6:"course";s:11:"0.000045395";s:4:"code";s:19:"bitfinex_veeeth_mid";s:4:"birg";s:8:"bitfinex";}i:2053;a:4:{s:5:"title";s:13:"VEE-ETH (bid)";s:6:"course";s:9:"0.0000408";s:4:"code";s:19:"bitfinex_veeeth_bid";s:4:"birg";s:8:"bitfinex";}i:2054;a:4:{s:5:"title";s:13:"VEE-ETH (ask)";s:6:"course";s:10:"0.00004999";s:4:"code";s:19:"bitfinex_veeeth_ask";s:4:"birg";s:8:"bitfinex";}i:2055;a:4:{s:5:"title";s:20:"VEE-ETH (last_price)";s:6:"course";s:8:"0.000048";s:4:"code";s:26:"bitfinex_veeeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2056;a:4:{s:5:"title";s:13:"DAD-USD (mid)";s:6:"course";s:8:"0.084426";s:4:"code";s:19:"bitfinex_dadusd_mid";s:4:"birg";s:8:"bitfinex";}i:2057;a:4:{s:5:"title";s:13:"DAD-USD (bid)";s:6:"course";s:8:"0.078063";s:4:"code";s:19:"bitfinex_dadusd_bid";s:4:"birg";s:8:"bitfinex";}i:2058;a:4:{s:5:"title";s:13:"DAD-USD (ask)";s:6:"course";s:8:"0.090789";s:4:"code";s:19:"bitfinex_dadusd_ask";s:4:"birg";s:8:"bitfinex";}i:2059;a:4:{s:5:"title";s:20:"DAD-USD (last_price)";s:6:"course";s:8:"0.088344";s:4:"code";s:26:"bitfinex_dadusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2060;a:4:{s:5:"title";s:13:"DAD-USD (low)";s:6:"course";s:8:"0.085199";s:4:"code";s:19:"bitfinex_dadusd_low";s:4:"birg";s:8:"bitfinex";}i:2061;a:4:{s:5:"title";s:14:"DAD-USD (high)";s:6:"course";s:8:"0.088344";s:4:"code";s:20:"bitfinex_dadusd_high";s:4:"birg";s:8:"bitfinex";}i:2062;a:4:{s:5:"title";s:13:"DAD-BTC (mid)";s:6:"course";s:10:"0.00001318";s:4:"code";s:19:"bitfinex_dadbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2063;a:4:{s:5:"title";s:13:"DAD-BTC (bid)";s:6:"course";s:10:"0.00001312";s:4:"code";s:19:"bitfinex_dadbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2064;a:4:{s:5:"title";s:13:"DAD-BTC (ask)";s:6:"course";s:10:"0.00001324";s:4:"code";s:19:"bitfinex_dadbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2065;a:4:{s:5:"title";s:20:"DAD-BTC (last_price)";s:6:"course";s:10:"0.00001314";s:4:"code";s:26:"bitfinex_dadbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2066;a:4:{s:5:"title";s:13:"DAD-BTC (low)";s:6:"course";s:10:"0.00001277";s:4:"code";s:19:"bitfinex_dadbtc_low";s:4:"birg";s:8:"bitfinex";}i:2067;a:4:{s:5:"title";s:14:"DAD-BTC (high)";s:6:"course";s:10:"0.00001361";s:4:"code";s:20:"bitfinex_dadbtc_high";s:4:"birg";s:8:"bitfinex";}i:2068;a:4:{s:5:"title";s:13:"DAD-ETH (mid)";s:6:"course";s:11:"0.000418805";s:4:"code";s:19:"bitfinex_dadeth_mid";s:4:"birg";s:8:"bitfinex";}i:2069;a:4:{s:5:"title";s:13:"DAD-ETH (bid)";s:6:"course";s:10:"0.00041781";s:4:"code";s:19:"bitfinex_dadeth_bid";s:4:"birg";s:8:"bitfinex";}i:2070;a:4:{s:5:"title";s:13:"DAD-ETH (ask)";s:6:"course";s:9:"0.0004198";s:4:"code";s:19:"bitfinex_dadeth_ask";s:4:"birg";s:8:"bitfinex";}i:2071;a:4:{s:5:"title";s:20:"DAD-ETH (last_price)";s:6:"course";s:10:"0.00041833";s:4:"code";s:26:"bitfinex_dadeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2072;a:4:{s:5:"title";s:13:"DAD-ETH (low)";s:6:"course";s:10:"0.00040785";s:4:"code";s:19:"bitfinex_dadeth_low";s:4:"birg";s:8:"bitfinex";}i:2073;a:4:{s:5:"title";s:14:"DAD-ETH (high)";s:6:"course";s:10:"0.00042909";s:4:"code";s:20:"bitfinex_dadeth_high";s:4:"birg";s:8:"bitfinex";}i:2074;a:4:{s:5:"title";s:13:"ORS-USD (mid)";s:6:"course";s:9:"0.0354615";s:4:"code";s:19:"bitfinex_orsusd_mid";s:4:"birg";s:8:"bitfinex";}i:2075;a:4:{s:5:"title";s:13:"ORS-USD (bid)";s:6:"course";s:7:"0.03201";s:4:"code";s:19:"bitfinex_orsusd_bid";s:4:"birg";s:8:"bitfinex";}i:2076;a:4:{s:5:"title";s:13:"ORS-USD (ask)";s:6:"course";s:8:"0.038913";s:4:"code";s:19:"bitfinex_orsusd_ask";s:4:"birg";s:8:"bitfinex";}i:2077;a:4:{s:5:"title";s:20:"ORS-USD (last_price)";s:6:"course";s:8:"0.038913";s:4:"code";s:26:"bitfinex_orsusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2078;a:4:{s:5:"title";s:13:"ORS-BTC (mid)";s:6:"course";s:10:"0.00000525";s:4:"code";s:19:"bitfinex_orsbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2079;a:4:{s:5:"title";s:13:"ORS-BTC (bid)";s:6:"course";s:9:"0.0000049";s:4:"code";s:19:"bitfinex_orsbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2080;a:4:{s:5:"title";s:13:"ORS-BTC (ask)";s:6:"course";s:9:"0.0000056";s:4:"code";s:19:"bitfinex_orsbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2081;a:4:{s:5:"title";s:20:"ORS-BTC (last_price)";s:6:"course";s:9:"0.0000055";s:4:"code";s:26:"bitfinex_orsbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2082;a:4:{s:5:"title";s:13:"ORS-ETH (mid)";s:6:"course";s:11:"0.000173745";s:4:"code";s:19:"bitfinex_orseth_mid";s:4:"birg";s:8:"bitfinex";}i:2083;a:4:{s:5:"title";s:13:"ORS-ETH (bid)";s:6:"course";s:10:"0.00015649";s:4:"code";s:19:"bitfinex_orseth_bid";s:4:"birg";s:8:"bitfinex";}i:2084;a:4:{s:5:"title";s:13:"ORS-ETH (ask)";s:6:"course";s:8:"0.000191";s:4:"code";s:19:"bitfinex_orseth_ask";s:4:"birg";s:8:"bitfinex";}i:2085;a:4:{s:5:"title";s:20:"ORS-ETH (last_price)";s:6:"course";s:10:"0.00019098";s:4:"code";s:26:"bitfinex_orseth_last_price";s:4:"birg";s:8:"bitfinex";}i:2086;a:4:{s:5:"title";s:13:"AUC-USD (mid)";s:6:"course";s:7:"0.03605";s:4:"code";s:19:"bitfinex_aucusd_mid";s:4:"birg";s:8:"bitfinex";}i:2087;a:4:{s:5:"title";s:13:"AUC-USD (bid)";s:6:"course";s:6:"0.0353";s:4:"code";s:19:"bitfinex_aucusd_bid";s:4:"birg";s:8:"bitfinex";}i:2088;a:4:{s:5:"title";s:13:"AUC-USD (ask)";s:6:"course";s:6:"0.0368";s:4:"code";s:19:"bitfinex_aucusd_ask";s:4:"birg";s:8:"bitfinex";}i:2089;a:4:{s:5:"title";s:20:"AUC-USD (last_price)";s:6:"course";s:8:"0.036888";s:4:"code";s:26:"bitfinex_aucusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2090;a:4:{s:5:"title";s:13:"AUC-BTC (mid)";s:6:"course";s:10:"0.00000525";s:4:"code";s:19:"bitfinex_aucbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2091;a:4:{s:5:"title";s:13:"AUC-BTC (bid)";s:6:"course";s:8:"0.000004";s:4:"code";s:19:"bitfinex_aucbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2092;a:4:{s:5:"title";s:13:"AUC-BTC (ask)";s:6:"course";s:9:"0.0000065";s:4:"code";s:19:"bitfinex_aucbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2093;a:4:{s:5:"title";s:20:"AUC-BTC (last_price)";s:6:"course";s:10:"0.00000536";s:4:"code";s:26:"bitfinex_aucbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2094;a:4:{s:5:"title";s:13:"AUC-BTC (low)";s:6:"course";s:10:"0.00000528";s:4:"code";s:19:"bitfinex_aucbtc_low";s:4:"birg";s:8:"bitfinex";}i:2095;a:4:{s:5:"title";s:14:"AUC-BTC (high)";s:6:"course";s:10:"0.00000536";s:4:"code";s:20:"bitfinex_aucbtc_high";s:4:"birg";s:8:"bitfinex";}i:2096;a:4:{s:5:"title";s:13:"AUC-ETH (mid)";s:6:"course";s:11:"0.000165085";s:4:"code";s:19:"bitfinex_auceth_mid";s:4:"birg";s:8:"bitfinex";}i:2097;a:4:{s:5:"title";s:13:"AUC-ETH (bid)";s:6:"course";s:8:"0.000152";s:4:"code";s:19:"bitfinex_auceth_bid";s:4:"birg";s:8:"bitfinex";}i:2098;a:4:{s:5:"title";s:13:"AUC-ETH (ask)";s:6:"course";s:10:"0.00017817";s:4:"code";s:19:"bitfinex_auceth_ask";s:4:"birg";s:8:"bitfinex";}i:2099;a:4:{s:5:"title";s:20:"AUC-ETH (last_price)";s:6:"course";s:8:"0.000175";s:4:"code";s:26:"bitfinex_auceth_last_price";s:4:"birg";s:8:"bitfinex";}i:2100;a:4:{s:5:"title";s:13:"AUC-ETH (low)";s:6:"course";s:8:"0.000175";s:4:"code";s:19:"bitfinex_auceth_low";s:4:"birg";s:8:"bitfinex";}i:2101;a:4:{s:5:"title";s:14:"AUC-ETH (high)";s:6:"course";s:8:"0.000175";s:4:"code";s:20:"bitfinex_auceth_high";s:4:"birg";s:8:"bitfinex";}i:2102;a:4:{s:5:"title";s:13:"POY-USD (mid)";s:6:"course";s:8:"0.261395";s:4:"code";s:19:"bitfinex_poyusd_mid";s:4:"birg";s:8:"bitfinex";}i:2103;a:4:{s:5:"title";s:13:"POY-USD (bid)";s:6:"course";s:7:"0.23803";s:4:"code";s:19:"bitfinex_poyusd_bid";s:4:"birg";s:8:"bitfinex";}i:2104;a:4:{s:5:"title";s:13:"POY-USD (ask)";s:6:"course";s:7:"0.28476";s:4:"code";s:19:"bitfinex_poyusd_ask";s:4:"birg";s:8:"bitfinex";}i:2105;a:4:{s:5:"title";s:20:"POY-USD (last_price)";s:6:"course";s:7:"0.28476";s:4:"code";s:26:"bitfinex_poyusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2106;a:4:{s:5:"title";s:13:"POY-USD (low)";s:6:"course";s:7:"0.21655";s:4:"code";s:19:"bitfinex_poyusd_low";s:4:"birg";s:8:"bitfinex";}i:2107;a:4:{s:5:"title";s:14:"POY-USD (high)";s:6:"course";s:7:"0.28476";s:4:"code";s:20:"bitfinex_poyusd_high";s:4:"birg";s:8:"bitfinex";}i:2108;a:4:{s:5:"title";s:13:"POY-BTC (mid)";s:6:"course";s:10:"0.00003685";s:4:"code";s:19:"bitfinex_poybtc_mid";s:4:"birg";s:8:"bitfinex";}i:2109;a:4:{s:5:"title";s:13:"POY-BTC (bid)";s:6:"course";s:10:"0.00003082";s:4:"code";s:19:"bitfinex_poybtc_bid";s:4:"birg";s:8:"bitfinex";}i:2110;a:4:{s:5:"title";s:13:"POY-BTC (ask)";s:6:"course";s:10:"0.00004288";s:4:"code";s:19:"bitfinex_poybtc_ask";s:4:"birg";s:8:"bitfinex";}i:2111;a:4:{s:5:"title";s:20:"POY-BTC (last_price)";s:6:"course";s:10:"0.00004261";s:4:"code";s:26:"bitfinex_poybtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2112;a:4:{s:5:"title";s:13:"POY-BTC (low)";s:6:"course";s:10:"0.00004181";s:4:"code";s:19:"bitfinex_poybtc_low";s:4:"birg";s:8:"bitfinex";}i:2113;a:4:{s:5:"title";s:14:"POY-BTC (high)";s:6:"course";s:10:"0.00004261";s:4:"code";s:20:"bitfinex_poybtc_high";s:4:"birg";s:8:"bitfinex";}i:2114;a:4:{s:5:"title";s:13:"POY-ETH (mid)";s:6:"course";s:10:"0.00143495";s:4:"code";s:19:"bitfinex_poyeth_mid";s:4:"birg";s:8:"bitfinex";}i:2115;a:4:{s:5:"title";s:13:"POY-ETH (bid)";s:6:"course";s:6:"0.0012";s:4:"code";s:19:"bitfinex_poyeth_bid";s:4:"birg";s:8:"bitfinex";}i:2116;a:4:{s:5:"title";s:13:"POY-ETH (ask)";s:6:"course";s:9:"0.0016699";s:4:"code";s:19:"bitfinex_poyeth_ask";s:4:"birg";s:8:"bitfinex";}i:2117;a:4:{s:5:"title";s:20:"POY-ETH (last_price)";s:6:"course";s:7:"0.00135";s:4:"code";s:26:"bitfinex_poyeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2118;a:4:{s:5:"title";s:13:"POY-ETH (low)";s:6:"course";s:6:"0.0013";s:4:"code";s:19:"bitfinex_poyeth_low";s:4:"birg";s:8:"bitfinex";}i:2119;a:4:{s:5:"title";s:14:"POY-ETH (high)";s:6:"course";s:7:"0.00135";s:4:"code";s:20:"bitfinex_poyeth_high";s:4:"birg";s:8:"bitfinex";}i:2120;a:4:{s:5:"title";s:13:"FSN-USD (mid)";s:6:"course";s:7:"0.89083";s:4:"code";s:19:"bitfinex_fsnusd_mid";s:4:"birg";s:8:"bitfinex";}i:2121;a:4:{s:5:"title";s:13:"FSN-USD (bid)";s:6:"course";s:7:"0.88166";s:4:"code";s:19:"bitfinex_fsnusd_bid";s:4:"birg";s:8:"bitfinex";}i:2122;a:4:{s:5:"title";s:13:"FSN-USD (ask)";s:6:"course";s:3:"0.9";s:4:"code";s:19:"bitfinex_fsnusd_ask";s:4:"birg";s:8:"bitfinex";}i:2123;a:4:{s:5:"title";s:20:"FSN-USD (last_price)";s:6:"course";s:3:"0.9";s:4:"code";s:26:"bitfinex_fsnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2124;a:4:{s:5:"title";s:13:"FSN-USD (low)";s:6:"course";s:6:"0.8946";s:4:"code";s:19:"bitfinex_fsnusd_low";s:4:"birg";s:8:"bitfinex";}i:2125;a:4:{s:5:"title";s:14:"FSN-USD (high)";s:6:"course";s:3:"0.9";s:4:"code";s:20:"bitfinex_fsnusd_high";s:4:"birg";s:8:"bitfinex";}i:2126;a:4:{s:5:"title";s:13:"FSN-BTC (mid)";s:6:"course";s:11:"0.000137835";s:4:"code";s:19:"bitfinex_fsnbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2127;a:4:{s:5:"title";s:13:"FSN-BTC (bid)";s:6:"course";s:8:"0.000136";s:4:"code";s:19:"bitfinex_fsnbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2128;a:4:{s:5:"title";s:13:"FSN-BTC (ask)";s:6:"course";s:10:"0.00013967";s:4:"code";s:19:"bitfinex_fsnbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2129;a:4:{s:5:"title";s:20:"FSN-BTC (last_price)";s:6:"course";s:10:"0.00013712";s:4:"code";s:26:"bitfinex_fsnbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2130;a:4:{s:5:"title";s:13:"FSN-BTC (low)";s:6:"course";s:10:"0.00013712";s:4:"code";s:19:"bitfinex_fsnbtc_low";s:4:"birg";s:8:"bitfinex";}i:2131;a:4:{s:5:"title";s:14:"FSN-BTC (high)";s:6:"course";s:10:"0.00013712";s:4:"code";s:20:"bitfinex_fsnbtc_high";s:4:"birg";s:8:"bitfinex";}i:2132;a:4:{s:5:"title";s:13:"FSN-ETH (mid)";s:6:"course";s:10:"0.00438435";s:4:"code";s:19:"bitfinex_fsneth_mid";s:4:"birg";s:8:"bitfinex";}i:2133;a:4:{s:5:"title";s:13:"FSN-ETH (bid)";s:6:"course";s:9:"0.0043244";s:4:"code";s:19:"bitfinex_fsneth_bid";s:4:"birg";s:8:"bitfinex";}i:2134;a:4:{s:5:"title";s:13:"FSN-ETH (ask)";s:6:"course";s:9:"0.0044443";s:4:"code";s:19:"bitfinex_fsneth_ask";s:4:"birg";s:8:"bitfinex";}i:2135;a:4:{s:5:"title";s:20:"FSN-ETH (last_price)";s:6:"course";s:9:"0.0045002";s:4:"code";s:26:"bitfinex_fsneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2136;a:4:{s:5:"title";s:13:"FSN-ETH (low)";s:6:"course";s:9:"0.0043548";s:4:"code";s:19:"bitfinex_fsneth_low";s:4:"birg";s:8:"bitfinex";}i:2137;a:4:{s:5:"title";s:14:"FSN-ETH (high)";s:6:"course";s:9:"0.0045003";s:4:"code";s:20:"bitfinex_fsneth_high";s:4:"birg";s:8:"bitfinex";}i:2138;a:4:{s:5:"title";s:13:"CBT-USD (mid)";s:6:"course";s:9:"0.0115005";s:4:"code";s:19:"bitfinex_cbtusd_mid";s:4:"birg";s:8:"bitfinex";}i:2139;a:4:{s:5:"title";s:13:"CBT-USD (bid)";s:6:"course";s:8:"0.010502";s:4:"code";s:19:"bitfinex_cbtusd_bid";s:4:"birg";s:8:"bitfinex";}i:2140;a:4:{s:5:"title";s:13:"CBT-USD (ask)";s:6:"course";s:8:"0.012499";s:4:"code";s:19:"bitfinex_cbtusd_ask";s:4:"birg";s:8:"bitfinex";}i:2141;a:4:{s:5:"title";s:20:"CBT-USD (last_price)";s:6:"course";s:8:"0.011095";s:4:"code";s:26:"bitfinex_cbtusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2142;a:4:{s:5:"title";s:13:"CBT-USD (low)";s:6:"course";s:8:"0.011028";s:4:"code";s:19:"bitfinex_cbtusd_low";s:4:"birg";s:8:"bitfinex";}i:2143;a:4:{s:5:"title";s:14:"CBT-USD (high)";s:6:"course";s:8:"0.012534";s:4:"code";s:20:"bitfinex_cbtusd_high";s:4:"birg";s:8:"bitfinex";}i:2144;a:4:{s:5:"title";s:13:"CBT-BTC (mid)";s:6:"course";s:11:"0.000001915";s:4:"code";s:19:"bitfinex_cbtbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2145;a:4:{s:5:"title";s:13:"CBT-BTC (bid)";s:6:"course";s:10:"0.00000137";s:4:"code";s:19:"bitfinex_cbtbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2146;a:4:{s:5:"title";s:13:"CBT-BTC (ask)";s:6:"course";s:10:"0.00000246";s:4:"code";s:19:"bitfinex_cbtbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2147;a:4:{s:5:"title";s:20:"CBT-BTC (last_price)";s:6:"course";s:10:"0.00000124";s:4:"code";s:26:"bitfinex_cbtbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2148;a:4:{s:5:"title";s:13:"CBT-BTC (low)";s:6:"course";s:10:"0.00000124";s:4:"code";s:19:"bitfinex_cbtbtc_low";s:4:"birg";s:8:"bitfinex";}i:2149;a:4:{s:5:"title";s:14:"CBT-BTC (high)";s:6:"course";s:10:"0.00000235";s:4:"code";s:20:"bitfinex_cbtbtc_high";s:4:"birg";s:8:"bitfinex";}i:2150;a:4:{s:5:"title";s:13:"CBT-ETH (mid)";s:6:"course";s:8:"0.000062";s:4:"code";s:19:"bitfinex_cbteth_mid";s:4:"birg";s:8:"bitfinex";}i:2151;a:4:{s:5:"title";s:13:"CBT-ETH (bid)";s:6:"course";s:10:"0.00004502";s:4:"code";s:19:"bitfinex_cbteth_bid";s:4:"birg";s:8:"bitfinex";}i:2152;a:4:{s:5:"title";s:13:"CBT-ETH (ask)";s:6:"course";s:10:"0.00007898";s:4:"code";s:19:"bitfinex_cbteth_ask";s:4:"birg";s:8:"bitfinex";}i:2153;a:4:{s:5:"title";s:20:"CBT-ETH (last_price)";s:6:"course";s:10:"0.00004636";s:4:"code";s:26:"bitfinex_cbteth_last_price";s:4:"birg";s:8:"bitfinex";}i:2154;a:4:{s:5:"title";s:13:"CBT-ETH (low)";s:6:"course";s:10:"0.00004636";s:4:"code";s:19:"bitfinex_cbteth_low";s:4:"birg";s:8:"bitfinex";}i:2155;a:4:{s:5:"title";s:14:"CBT-ETH (high)";s:6:"course";s:10:"0.00004636";s:4:"code";s:20:"bitfinex_cbteth_high";s:4:"birg";s:8:"bitfinex";}i:2156;a:4:{s:5:"title";s:13:"ZCN-USD (mid)";s:6:"course";s:8:"0.280115";s:4:"code";s:19:"bitfinex_zcnusd_mid";s:4:"birg";s:8:"bitfinex";}i:2157;a:4:{s:5:"title";s:13:"ZCN-USD (bid)";s:6:"course";s:7:"0.24025";s:4:"code";s:19:"bitfinex_zcnusd_bid";s:4:"birg";s:8:"bitfinex";}i:2158;a:4:{s:5:"title";s:13:"ZCN-USD (ask)";s:6:"course";s:7:"0.31998";s:4:"code";s:19:"bitfinex_zcnusd_ask";s:4:"birg";s:8:"bitfinex";}i:2159;a:4:{s:5:"title";s:20:"ZCN-USD (last_price)";s:6:"course";s:5:"0.319";s:4:"code";s:26:"bitfinex_zcnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2160;a:4:{s:5:"title";s:13:"ZCN-BTC (mid)";s:6:"course";s:11:"0.000034915";s:4:"code";s:19:"bitfinex_zcnbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2161;a:4:{s:5:"title";s:13:"ZCN-BTC (bid)";s:6:"course";s:10:"0.00002213";s:4:"code";s:19:"bitfinex_zcnbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2162;a:4:{s:5:"title";s:13:"ZCN-BTC (ask)";s:6:"course";s:9:"0.0000477";s:4:"code";s:19:"bitfinex_zcnbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2163;a:4:{s:5:"title";s:20:"ZCN-BTC (last_price)";s:6:"course";s:10:"0.00002231";s:4:"code";s:26:"bitfinex_zcnbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2164;a:4:{s:5:"title";s:13:"ZCN-ETH (mid)";s:6:"course";s:8:"0.001265";s:4:"code";s:19:"bitfinex_zcneth_mid";s:4:"birg";s:8:"bitfinex";}i:2165;a:4:{s:5:"title";s:13:"ZCN-ETH (bid)";s:6:"course";s:7:"0.00103";s:4:"code";s:19:"bitfinex_zcneth_bid";s:4:"birg";s:8:"bitfinex";}i:2166;a:4:{s:5:"title";s:13:"ZCN-ETH (ask)";s:6:"course";s:6:"0.0015";s:4:"code";s:19:"bitfinex_zcneth_ask";s:4:"birg";s:8:"bitfinex";}i:2167;a:4:{s:5:"title";s:20:"ZCN-ETH (last_price)";s:6:"course";s:7:"0.00135";s:4:"code";s:26:"bitfinex_zcneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2168;a:4:{s:5:"title";s:13:"SEN-USD (mid)";s:6:"course";s:9:"0.0038992";s:4:"code";s:19:"bitfinex_senusd_mid";s:4:"birg";s:8:"bitfinex";}i:2169;a:4:{s:5:"title";s:13:"SEN-USD (bid)";s:6:"course";s:9:"0.0037984";s:4:"code";s:19:"bitfinex_senusd_bid";s:4:"birg";s:8:"bitfinex";}i:2170;a:4:{s:5:"title";s:13:"SEN-USD (ask)";s:6:"course";s:5:"0.004";s:4:"code";s:19:"bitfinex_senusd_ask";s:4:"birg";s:8:"bitfinex";}i:2171;a:4:{s:5:"title";s:20:"SEN-USD (last_price)";s:6:"course";s:9:"0.0039999";s:4:"code";s:26:"bitfinex_senusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2172;a:4:{s:5:"title";s:13:"SEN-USD (low)";s:6:"course";s:7:"0.00356";s:4:"code";s:19:"bitfinex_senusd_low";s:4:"birg";s:8:"bitfinex";}i:2173;a:4:{s:5:"title";s:14:"SEN-USD (high)";s:6:"course";s:5:"0.004";s:4:"code";s:20:"bitfinex_senusd_high";s:4:"birg";s:8:"bitfinex";}i:2174;a:4:{s:5:"title";s:13:"SEN-BTC (mid)";s:6:"course";s:11:"0.000000605";s:4:"code";s:19:"bitfinex_senbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2175;a:4:{s:5:"title";s:13:"SEN-BTC (bid)";s:6:"course";s:10:"0.00000059";s:4:"code";s:19:"bitfinex_senbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2176;a:4:{s:5:"title";s:13:"SEN-BTC (ask)";s:6:"course";s:10:"0.00000062";s:4:"code";s:19:"bitfinex_senbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2177;a:4:{s:5:"title";s:20:"SEN-BTC (last_price)";s:6:"course";s:10:"0.00000061";s:4:"code";s:26:"bitfinex_senbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2178;a:4:{s:5:"title";s:13:"SEN-BTC (low)";s:6:"course";s:10:"0.00000054";s:4:"code";s:19:"bitfinex_senbtc_low";s:4:"birg";s:8:"bitfinex";}i:2179;a:4:{s:5:"title";s:14:"SEN-BTC (high)";s:6:"course";s:10:"0.00000061";s:4:"code";s:20:"bitfinex_senbtc_high";s:4:"birg";s:8:"bitfinex";}i:2180;a:4:{s:5:"title";s:13:"SEN-ETH (mid)";s:6:"course";s:11:"0.000019425";s:4:"code";s:19:"bitfinex_seneth_mid";s:4:"birg";s:8:"bitfinex";}i:2181;a:4:{s:5:"title";s:13:"SEN-ETH (bid)";s:6:"course";s:10:"0.00001915";s:4:"code";s:19:"bitfinex_seneth_bid";s:4:"birg";s:8:"bitfinex";}i:2182;a:4:{s:5:"title";s:13:"SEN-ETH (ask)";s:6:"course";s:9:"0.0000197";s:4:"code";s:19:"bitfinex_seneth_ask";s:4:"birg";s:8:"bitfinex";}i:2183;a:4:{s:5:"title";s:20:"SEN-ETH (last_price)";s:6:"course";s:10:"0.00001964";s:4:"code";s:26:"bitfinex_seneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2184;a:4:{s:5:"title";s:13:"SEN-ETH (low)";s:6:"course";s:10:"0.00001751";s:4:"code";s:19:"bitfinex_seneth_low";s:4:"birg";s:8:"bitfinex";}i:2185;a:4:{s:5:"title";s:14:"SEN-ETH (high)";s:6:"course";s:10:"0.00001964";s:4:"code";s:20:"bitfinex_seneth_high";s:4:"birg";s:8:"bitfinex";}i:2186;a:4:{s:5:"title";s:13:"NCA-USD (mid)";s:6:"course";s:9:"0.0050291";s:4:"code";s:19:"bitfinex_ncausd_mid";s:4:"birg";s:8:"bitfinex";}i:2187;a:4:{s:5:"title";s:13:"NCA-USD (bid)";s:6:"course";s:9:"0.0047836";s:4:"code";s:19:"bitfinex_ncausd_bid";s:4:"birg";s:8:"bitfinex";}i:2188;a:4:{s:5:"title";s:13:"NCA-USD (ask)";s:6:"course";s:9:"0.0052746";s:4:"code";s:19:"bitfinex_ncausd_ask";s:4:"birg";s:8:"bitfinex";}i:2189;a:4:{s:5:"title";s:20:"NCA-USD (last_price)";s:6:"course";s:9:"0.0053468";s:4:"code";s:26:"bitfinex_ncausd_last_price";s:4:"birg";s:8:"bitfinex";}i:2190;a:4:{s:5:"title";s:13:"NCA-BTC (mid)";s:6:"course";s:11:"0.000000795";s:4:"code";s:19:"bitfinex_ncabtc_mid";s:4:"birg";s:8:"bitfinex";}i:2191;a:4:{s:5:"title";s:13:"NCA-BTC (bid)";s:6:"course";s:9:"0.0000007";s:4:"code";s:19:"bitfinex_ncabtc_bid";s:4:"birg";s:8:"bitfinex";}i:2192;a:4:{s:5:"title";s:13:"NCA-BTC (ask)";s:6:"course";s:10:"0.00000089";s:4:"code";s:19:"bitfinex_ncabtc_ask";s:4:"birg";s:8:"bitfinex";}i:2193;a:4:{s:5:"title";s:20:"NCA-BTC (last_price)";s:6:"course";s:10:"0.00000089";s:4:"code";s:26:"bitfinex_ncabtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2194;a:4:{s:5:"title";s:13:"NCA-ETH (mid)";s:6:"course";s:9:"0.0000239";s:4:"code";s:19:"bitfinex_ncaeth_mid";s:4:"birg";s:8:"bitfinex";}i:2195;a:4:{s:5:"title";s:13:"NCA-ETH (bid)";s:6:"course";s:8:"0.000011";s:4:"code";s:19:"bitfinex_ncaeth_bid";s:4:"birg";s:8:"bitfinex";}i:2196;a:4:{s:5:"title";s:13:"NCA-ETH (ask)";s:6:"course";s:9:"0.0000368";s:4:"code";s:19:"bitfinex_ncaeth_ask";s:4:"birg";s:8:"bitfinex";}i:2197;a:4:{s:5:"title";s:20:"NCA-ETH (last_price)";s:6:"course";s:10:"0.00002611";s:4:"code";s:26:"bitfinex_ncaeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2198;a:4:{s:5:"title";s:13:"CND-USD (mid)";s:6:"course";s:8:"0.026538";s:4:"code";s:19:"bitfinex_cndusd_mid";s:4:"birg";s:8:"bitfinex";}i:2199;a:4:{s:5:"title";s:13:"CND-USD (bid)";s:6:"course";s:8:"0.023237";s:4:"code";s:19:"bitfinex_cndusd_bid";s:4:"birg";s:8:"bitfinex";}i:2200;a:4:{s:5:"title";s:13:"CND-USD (ask)";s:6:"course";s:8:"0.029839";s:4:"code";s:19:"bitfinex_cndusd_ask";s:4:"birg";s:8:"bitfinex";}i:2201;a:4:{s:5:"title";s:20:"CND-USD (last_price)";s:6:"course";s:5:"0.026";s:4:"code";s:26:"bitfinex_cndusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2202;a:4:{s:5:"title";s:13:"CND-BTC (mid)";s:6:"course";s:10:"0.00000385";s:4:"code";s:19:"bitfinex_cndbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2203;a:4:{s:5:"title";s:13:"CND-BTC (bid)";s:6:"course";s:10:"0.00000331";s:4:"code";s:19:"bitfinex_cndbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2204;a:4:{s:5:"title";s:13:"CND-BTC (ask)";s:6:"course";s:10:"0.00000439";s:4:"code";s:19:"bitfinex_cndbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2205;a:4:{s:5:"title";s:20:"CND-BTC (last_price)";s:6:"course";s:10:"0.00000363";s:4:"code";s:26:"bitfinex_cndbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2206;a:4:{s:5:"title";s:13:"CND-ETH (mid)";s:6:"course";s:11:"0.000097045";s:4:"code";s:19:"bitfinex_cndeth_mid";s:4:"birg";s:8:"bitfinex";}i:2207;a:4:{s:5:"title";s:13:"CND-ETH (bid)";s:6:"course";s:8:"0.000075";s:4:"code";s:19:"bitfinex_cndeth_bid";s:4:"birg";s:8:"bitfinex";}i:2208;a:4:{s:5:"title";s:13:"CND-ETH (ask)";s:6:"course";s:10:"0.00011909";s:4:"code";s:19:"bitfinex_cndeth_ask";s:4:"birg";s:8:"bitfinex";}i:2209;a:4:{s:5:"title";s:20:"CND-ETH (last_price)";s:6:"course";s:10:"0.00012344";s:4:"code";s:26:"bitfinex_cndeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2210;a:4:{s:5:"title";s:13:"CTX-USD (mid)";s:6:"course";s:7:"0.32728";s:4:"code";s:19:"bitfinex_ctxusd_mid";s:4:"birg";s:8:"bitfinex";}i:2211;a:4:{s:5:"title";s:13:"CTX-USD (bid)";s:6:"course";s:6:"0.2954";s:4:"code";s:19:"bitfinex_ctxusd_bid";s:4:"birg";s:8:"bitfinex";}i:2212;a:4:{s:5:"title";s:13:"CTX-USD (ask)";s:6:"course";s:7:"0.35916";s:4:"code";s:19:"bitfinex_ctxusd_ask";s:4:"birg";s:8:"bitfinex";}i:2213;a:4:{s:5:"title";s:20:"CTX-USD (last_price)";s:6:"course";s:7:"0.29525";s:4:"code";s:26:"bitfinex_ctxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2214;a:4:{s:5:"title";s:13:"CTX-BTC (mid)";s:6:"course";s:10:"0.00005079";s:4:"code";s:19:"bitfinex_ctxbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2215;a:4:{s:5:"title";s:13:"CTX-BTC (bid)";s:6:"course";s:10:"0.00004322";s:4:"code";s:19:"bitfinex_ctxbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2216;a:4:{s:5:"title";s:13:"CTX-BTC (ask)";s:6:"course";s:10:"0.00005836";s:4:"code";s:19:"bitfinex_ctxbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2217;a:4:{s:5:"title";s:20:"CTX-BTC (last_price)";s:6:"course";s:10:"0.00004318";s:4:"code";s:26:"bitfinex_ctxbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2218;a:4:{s:5:"title";s:13:"CTX-ETH (mid)";s:6:"course";s:10:"0.00153235";s:4:"code";s:19:"bitfinex_ctxeth_mid";s:4:"birg";s:8:"bitfinex";}i:2219;a:4:{s:5:"title";s:13:"CTX-ETH (bid)";s:6:"course";s:9:"0.0013747";s:4:"code";s:19:"bitfinex_ctxeth_bid";s:4:"birg";s:8:"bitfinex";}i:2220;a:4:{s:5:"title";s:13:"CTX-ETH (ask)";s:6:"course";s:7:"0.00169";s:4:"code";s:19:"bitfinex_ctxeth_ask";s:4:"birg";s:8:"bitfinex";}i:2221;a:4:{s:5:"title";s:20:"CTX-ETH (last_price)";s:6:"course";s:9:"0.0016898";s:4:"code";s:26:"bitfinex_ctxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2222;a:4:{s:5:"title";s:13:"CTX-ETH (low)";s:6:"course";s:9:"0.0016898";s:4:"code";s:19:"bitfinex_ctxeth_low";s:4:"birg";s:8:"bitfinex";}i:2223;a:4:{s:5:"title";s:14:"CTX-ETH (high)";s:6:"course";s:9:"0.0016898";s:4:"code";s:20:"bitfinex_ctxeth_high";s:4:"birg";s:8:"bitfinex";}i:2224;a:4:{s:5:"title";s:13:"PAI-USD (mid)";s:6:"course";s:8:"0.163635";s:4:"code";s:19:"bitfinex_paiusd_mid";s:4:"birg";s:8:"bitfinex";}i:2225;a:4:{s:5:"title";s:13:"PAI-USD (bid)";s:6:"course";s:7:"0.15228";s:4:"code";s:19:"bitfinex_paiusd_bid";s:4:"birg";s:8:"bitfinex";}i:2226;a:4:{s:5:"title";s:13:"PAI-USD (ask)";s:6:"course";s:7:"0.17499";s:4:"code";s:19:"bitfinex_paiusd_ask";s:4:"birg";s:8:"bitfinex";}i:2227;a:4:{s:5:"title";s:20:"PAI-USD (last_price)";s:6:"course";s:7:"0.16856";s:4:"code";s:26:"bitfinex_paiusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2228;a:4:{s:5:"title";s:13:"PAI-BTC (mid)";s:6:"course";s:10:"0.00002472";s:4:"code";s:19:"bitfinex_paibtc_mid";s:4:"birg";s:8:"bitfinex";}i:2229;a:4:{s:5:"title";s:13:"PAI-BTC (bid)";s:6:"course";s:10:"0.00002245";s:4:"code";s:19:"bitfinex_paibtc_bid";s:4:"birg";s:8:"bitfinex";}i:2230;a:4:{s:5:"title";s:13:"PAI-BTC (ask)";s:6:"course";s:10:"0.00002699";s:4:"code";s:19:"bitfinex_paibtc_ask";s:4:"birg";s:8:"bitfinex";}i:2231;a:4:{s:5:"title";s:20:"PAI-BTC (last_price)";s:6:"course";s:10:"0.00002261";s:4:"code";s:26:"bitfinex_paibtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2232;a:4:{s:5:"title";s:13:"PAI-BTC (low)";s:6:"course";s:10:"0.00002261";s:4:"code";s:19:"bitfinex_paibtc_low";s:4:"birg";s:8:"bitfinex";}i:2233;a:4:{s:5:"title";s:14:"PAI-BTC (high)";s:6:"course";s:10:"0.00002451";s:4:"code";s:20:"bitfinex_paibtc_high";s:4:"birg";s:8:"bitfinex";}i:2234;a:4:{s:5:"title";s:13:"SEE-USD (mid)";s:6:"course";s:10:"0.00149015";s:4:"code";s:19:"bitfinex_seeusd_mid";s:4:"birg";s:8:"bitfinex";}i:2235;a:4:{s:5:"title";s:13:"SEE-USD (bid)";s:6:"course";s:8:"0.001485";s:4:"code";s:19:"bitfinex_seeusd_bid";s:4:"birg";s:8:"bitfinex";}i:2236;a:4:{s:5:"title";s:13:"SEE-USD (ask)";s:6:"course";s:9:"0.0014953";s:4:"code";s:19:"bitfinex_seeusd_ask";s:4:"birg";s:8:"bitfinex";}i:2237;a:4:{s:5:"title";s:20:"SEE-USD (last_price)";s:6:"course";s:7:"0.00146";s:4:"code";s:26:"bitfinex_seeusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2238;a:4:{s:5:"title";s:13:"SEE-USD (low)";s:6:"course";s:7:"0.00146";s:4:"code";s:19:"bitfinex_seeusd_low";s:4:"birg";s:8:"bitfinex";}i:2239;a:4:{s:5:"title";s:14:"SEE-USD (high)";s:6:"course";s:7:"0.00146";s:4:"code";s:20:"bitfinex_seeusd_high";s:4:"birg";s:8:"bitfinex";}i:2240;a:4:{s:5:"title";s:13:"SEE-BTC (mid)";s:6:"course";s:10:"0.00000023";s:4:"code";s:19:"bitfinex_seebtc_mid";s:4:"birg";s:8:"bitfinex";}i:2241;a:4:{s:5:"title";s:13:"SEE-BTC (bid)";s:6:"course";s:10:"0.00000022";s:4:"code";s:19:"bitfinex_seebtc_bid";s:4:"birg";s:8:"bitfinex";}i:2242;a:4:{s:5:"title";s:13:"SEE-BTC (ask)";s:6:"course";s:10:"0.00000024";s:4:"code";s:19:"bitfinex_seebtc_ask";s:4:"birg";s:8:"bitfinex";}i:2243;a:4:{s:5:"title";s:20:"SEE-BTC (last_price)";s:6:"course";s:10:"0.00000022";s:4:"code";s:26:"bitfinex_seebtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2244;a:4:{s:5:"title";s:13:"SEE-BTC (low)";s:6:"course";s:10:"0.00000022";s:4:"code";s:19:"bitfinex_seebtc_low";s:4:"birg";s:8:"bitfinex";}i:2245;a:4:{s:5:"title";s:14:"SEE-BTC (high)";s:6:"course";s:10:"0.00000023";s:4:"code";s:20:"bitfinex_seebtc_high";s:4:"birg";s:8:"bitfinex";}i:2246;a:4:{s:5:"title";s:13:"SEE-ETH (mid)";s:6:"course";s:11:"0.000008095";s:4:"code";s:19:"bitfinex_seeeth_mid";s:4:"birg";s:8:"bitfinex";}i:2247;a:4:{s:5:"title";s:13:"SEE-ETH (bid)";s:6:"course";s:10:"0.00000724";s:4:"code";s:19:"bitfinex_seeeth_bid";s:4:"birg";s:8:"bitfinex";}i:2248;a:4:{s:5:"title";s:13:"SEE-ETH (ask)";s:6:"course";s:10:"0.00000895";s:4:"code";s:19:"bitfinex_seeeth_ask";s:4:"birg";s:8:"bitfinex";}i:2249;a:4:{s:5:"title";s:20:"SEE-ETH (last_price)";s:6:"course";s:10:"0.00000724";s:4:"code";s:26:"bitfinex_seeeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2250;a:4:{s:5:"title";s:13:"SEE-ETH (low)";s:6:"course";s:10:"0.00000724";s:4:"code";s:19:"bitfinex_seeeth_low";s:4:"birg";s:8:"bitfinex";}i:2251;a:4:{s:5:"title";s:14:"SEE-ETH (high)";s:6:"course";s:10:"0.00000724";s:4:"code";s:20:"bitfinex_seeeth_high";s:4:"birg";s:8:"bitfinex";}i:2252;a:4:{s:5:"title";s:13:"ESS-USD (mid)";s:6:"course";s:10:"0.00389235";s:4:"code";s:19:"bitfinex_essusd_mid";s:4:"birg";s:8:"bitfinex";}i:2253;a:4:{s:5:"title";s:13:"ESS-USD (bid)";s:6:"course";s:9:"0.0035857";s:4:"code";s:19:"bitfinex_essusd_bid";s:4:"birg";s:8:"bitfinex";}i:2254;a:4:{s:5:"title";s:13:"ESS-USD (ask)";s:6:"course";s:8:"0.004199";s:4:"code";s:19:"bitfinex_essusd_ask";s:4:"birg";s:8:"bitfinex";}i:2255;a:4:{s:5:"title";s:20:"ESS-USD (last_price)";s:6:"course";s:8:"0.004098";s:4:"code";s:26:"bitfinex_essusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2256;a:4:{s:5:"title";s:13:"ESS-USD (low)";s:6:"course";s:6:"0.0037";s:4:"code";s:19:"bitfinex_essusd_low";s:4:"birg";s:8:"bitfinex";}i:2257;a:4:{s:5:"title";s:14:"ESS-USD (high)";s:6:"course";s:8:"0.004098";s:4:"code";s:20:"bitfinex_essusd_high";s:4:"birg";s:8:"bitfinex";}i:2258;a:4:{s:5:"title";s:13:"ESS-BTC (mid)";s:6:"course";s:11:"0.000001035";s:4:"code";s:19:"bitfinex_essbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2259;a:4:{s:5:"title";s:13:"ESS-BTC (bid)";s:6:"course";s:10:"0.00000042";s:4:"code";s:19:"bitfinex_essbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2260;a:4:{s:5:"title";s:13:"ESS-BTC (ask)";s:6:"course";s:10:"0.00000165";s:4:"code";s:19:"bitfinex_essbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2261;a:4:{s:5:"title";s:20:"ESS-BTC (last_price)";s:6:"course";s:10:"0.00000075";s:4:"code";s:26:"bitfinex_essbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2262;a:4:{s:5:"title";s:13:"ESS-ETH (mid)";s:6:"course";s:10:"0.00001861";s:4:"code";s:19:"bitfinex_esseth_mid";s:4:"birg";s:8:"bitfinex";}i:2263;a:4:{s:5:"title";s:13:"ESS-ETH (bid)";s:6:"course";s:10:"0.00001775";s:4:"code";s:19:"bitfinex_esseth_bid";s:4:"birg";s:8:"bitfinex";}i:2264;a:4:{s:5:"title";s:13:"ESS-ETH (ask)";s:6:"course";s:10:"0.00001947";s:4:"code";s:19:"bitfinex_esseth_ask";s:4:"birg";s:8:"bitfinex";}i:2265;a:4:{s:5:"title";s:20:"ESS-ETH (last_price)";s:6:"course";s:9:"0.0000182";s:4:"code";s:26:"bitfinex_esseth_last_price";s:4:"birg";s:8:"bitfinex";}i:2266;a:4:{s:5:"title";s:13:"ESS-ETH (low)";s:6:"course";s:10:"0.00001732";s:4:"code";s:19:"bitfinex_esseth_low";s:4:"birg";s:8:"bitfinex";}i:2267;a:4:{s:5:"title";s:14:"ESS-ETH (high)";s:6:"course";s:9:"0.0000188";s:4:"code";s:20:"bitfinex_esseth_high";s:4:"birg";s:8:"bitfinex";}i:2268;a:4:{s:5:"title";s:13:"ATM-USD (mid)";s:6:"course";s:9:"0.0082872";s:4:"code";s:19:"bitfinex_atmusd_mid";s:4:"birg";s:8:"bitfinex";}i:2269;a:4:{s:5:"title";s:13:"ATM-USD (bid)";s:6:"course";s:5:"0.007";s:4:"code";s:19:"bitfinex_atmusd_bid";s:4:"birg";s:8:"bitfinex";}i:2270;a:4:{s:5:"title";s:13:"ATM-USD (ask)";s:6:"course";s:9:"0.0095744";s:4:"code";s:19:"bitfinex_atmusd_ask";s:4:"birg";s:8:"bitfinex";}i:2271;a:4:{s:5:"title";s:20:"ATM-USD (last_price)";s:6:"course";s:6:"0.0075";s:4:"code";s:26:"bitfinex_atmusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2272;a:4:{s:5:"title";s:13:"ATM-USD (low)";s:6:"course";s:8:"0.006903";s:4:"code";s:19:"bitfinex_atmusd_low";s:4:"birg";s:8:"bitfinex";}i:2273;a:4:{s:5:"title";s:14:"ATM-USD (high)";s:6:"course";s:6:"0.0075";s:4:"code";s:20:"bitfinex_atmusd_high";s:4:"birg";s:8:"bitfinex";}i:2274;a:4:{s:5:"title";s:13:"ATM-BTC (mid)";s:6:"course";s:11:"0.000001255";s:4:"code";s:19:"bitfinex_atmbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2275;a:4:{s:5:"title";s:13:"ATM-BTC (bid)";s:6:"course";s:10:"0.00000051";s:4:"code";s:19:"bitfinex_atmbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2276;a:4:{s:5:"title";s:13:"ATM-BTC (ask)";s:6:"course";s:8:"0.000002";s:4:"code";s:19:"bitfinex_atmbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2277;a:4:{s:5:"title";s:20:"ATM-BTC (last_price)";s:6:"course";s:10:"0.00000075";s:4:"code";s:26:"bitfinex_atmbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2278;a:4:{s:5:"title";s:13:"ATM-ETH (mid)";s:6:"course";s:11:"0.000037745";s:4:"code";s:19:"bitfinex_atmeth_mid";s:4:"birg";s:8:"bitfinex";}i:2279;a:4:{s:5:"title";s:13:"ATM-ETH (bid)";s:6:"course";s:10:"0.00003251";s:4:"code";s:19:"bitfinex_atmeth_bid";s:4:"birg";s:8:"bitfinex";}i:2280;a:4:{s:5:"title";s:13:"ATM-ETH (ask)";s:6:"course";s:10:"0.00004298";s:4:"code";s:19:"bitfinex_atmeth_ask";s:4:"birg";s:8:"bitfinex";}i:2281;a:4:{s:5:"title";s:20:"ATM-ETH (last_price)";s:6:"course";s:10:"0.00003319";s:4:"code";s:26:"bitfinex_atmeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2282;a:4:{s:5:"title";s:13:"ATM-ETH (low)";s:6:"course";s:10:"0.00003319";s:4:"code";s:19:"bitfinex_atmeth_low";s:4:"birg";s:8:"bitfinex";}i:2283;a:4:{s:5:"title";s:14:"ATM-ETH (high)";s:6:"course";s:10:"0.00003319";s:4:"code";s:20:"bitfinex_atmeth_high";s:4:"birg";s:8:"bitfinex";}i:2284;a:4:{s:5:"title";s:13:"HOT-USD (mid)";s:6:"course";s:10:"0.00984605";s:4:"code";s:19:"bitfinex_hotusd_mid";s:4:"birg";s:8:"bitfinex";}i:2285;a:4:{s:5:"title";s:13:"HOT-USD (bid)";s:6:"course";s:6:"0.0098";s:4:"code";s:19:"bitfinex_hotusd_bid";s:4:"birg";s:8:"bitfinex";}i:2286;a:4:{s:5:"title";s:13:"HOT-USD (ask)";s:6:"course";s:9:"0.0098921";s:4:"code";s:19:"bitfinex_hotusd_ask";s:4:"birg";s:8:"bitfinex";}i:2287;a:4:{s:5:"title";s:20:"HOT-USD (last_price)";s:6:"course";s:6:"0.0098";s:4:"code";s:26:"bitfinex_hotusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2288;a:4:{s:5:"title";s:13:"HOT-USD (low)";s:6:"course";s:6:"0.0098";s:4:"code";s:19:"bitfinex_hotusd_low";s:4:"birg";s:8:"bitfinex";}i:2289;a:4:{s:5:"title";s:14:"HOT-USD (high)";s:6:"course";s:8:"0.010252";s:4:"code";s:20:"bitfinex_hotusd_high";s:4:"birg";s:8:"bitfinex";}i:2290;a:4:{s:5:"title";s:13:"HOT-BTC (mid)";s:6:"course";s:11:"0.000001495";s:4:"code";s:19:"bitfinex_hotbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2291;a:4:{s:5:"title";s:13:"HOT-BTC (bid)";s:6:"course";s:10:"0.00000149";s:4:"code";s:19:"bitfinex_hotbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2292;a:4:{s:5:"title";s:13:"HOT-BTC (ask)";s:6:"course";s:9:"0.0000015";s:4:"code";s:19:"bitfinex_hotbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2293;a:4:{s:5:"title";s:20:"HOT-BTC (last_price)";s:6:"course";s:9:"0.0000015";s:4:"code";s:26:"bitfinex_hotbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2294;a:4:{s:5:"title";s:13:"HOT-BTC (low)";s:6:"course";s:9:"0.0000015";s:4:"code";s:19:"bitfinex_hotbtc_low";s:4:"birg";s:8:"bitfinex";}i:2295;a:4:{s:5:"title";s:14:"HOT-BTC (high)";s:6:"course";s:9:"0.0000015";s:4:"code";s:20:"bitfinex_hotbtc_high";s:4:"birg";s:8:"bitfinex";}i:2296;a:4:{s:5:"title";s:13:"HOT-ETH (mid)";s:6:"course";s:11:"0.000047975";s:4:"code";s:19:"bitfinex_hoteth_mid";s:4:"birg";s:8:"bitfinex";}i:2297;a:4:{s:5:"title";s:13:"HOT-ETH (bid)";s:6:"course";s:10:"0.00004774";s:4:"code";s:19:"bitfinex_hoteth_bid";s:4:"birg";s:8:"bitfinex";}i:2298;a:4:{s:5:"title";s:13:"HOT-ETH (ask)";s:6:"course";s:10:"0.00004821";s:4:"code";s:19:"bitfinex_hoteth_ask";s:4:"birg";s:8:"bitfinex";}i:2299;a:4:{s:5:"title";s:20:"HOT-ETH (last_price)";s:6:"course";s:10:"0.00004774";s:4:"code";s:26:"bitfinex_hoteth_last_price";s:4:"birg";s:8:"bitfinex";}i:2300;a:4:{s:5:"title";s:13:"HOT-ETH (low)";s:6:"course";s:10:"0.00004774";s:4:"code";s:19:"bitfinex_hoteth_low";s:4:"birg";s:8:"bitfinex";}i:2301;a:4:{s:5:"title";s:14:"HOT-ETH (high)";s:6:"course";s:10:"0.00004822";s:4:"code";s:20:"bitfinex_hoteth_high";s:4:"birg";s:8:"bitfinex";}i:2302;a:4:{s:5:"title";s:13:"DTA-USD (mid)";s:6:"course";s:10:"0.00303745";s:4:"code";s:19:"bitfinex_dtausd_mid";s:4:"birg";s:8:"bitfinex";}i:2303;a:4:{s:5:"title";s:13:"DTA-USD (bid)";s:6:"course";s:8:"0.002875";s:4:"code";s:19:"bitfinex_dtausd_bid";s:4:"birg";s:8:"bitfinex";}i:2304;a:4:{s:5:"title";s:13:"DTA-USD (ask)";s:6:"course";s:9:"0.0031999";s:4:"code";s:19:"bitfinex_dtausd_ask";s:4:"birg";s:8:"bitfinex";}i:2305;a:4:{s:5:"title";s:20:"DTA-USD (last_price)";s:6:"course";s:9:"0.0029208";s:4:"code";s:26:"bitfinex_dtausd_last_price";s:4:"birg";s:8:"bitfinex";}i:2306;a:4:{s:5:"title";s:13:"DTA-USD (low)";s:6:"course";s:9:"0.0029209";s:4:"code";s:19:"bitfinex_dtausd_low";s:4:"birg";s:8:"bitfinex";}i:2307;a:4:{s:5:"title";s:14:"DTA-USD (high)";s:6:"course";s:6:"0.0031";s:4:"code";s:20:"bitfinex_dtausd_high";s:4:"birg";s:8:"bitfinex";}i:2308;a:4:{s:5:"title";s:13:"DTA-BTC (mid)";s:6:"course";s:10:"0.00000055";s:4:"code";s:19:"bitfinex_dtabtc_mid";s:4:"birg";s:8:"bitfinex";}i:2309;a:4:{s:5:"title";s:13:"DTA-BTC (bid)";s:6:"course";s:9:"0.0000004";s:4:"code";s:19:"bitfinex_dtabtc_bid";s:4:"birg";s:8:"bitfinex";}i:2310;a:4:{s:5:"title";s:13:"DTA-BTC (ask)";s:6:"course";s:9:"0.0000007";s:4:"code";s:19:"bitfinex_dtabtc_ask";s:4:"birg";s:8:"bitfinex";}i:2311;a:4:{s:5:"title";s:20:"DTA-BTC (last_price)";s:6:"course";s:10:"0.00000075";s:4:"code";s:26:"bitfinex_dtabtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2312;a:4:{s:5:"title";s:13:"DTA-ETH (mid)";s:6:"course";s:11:"0.000014865";s:4:"code";s:19:"bitfinex_dtaeth_mid";s:4:"birg";s:8:"bitfinex";}i:2313;a:4:{s:5:"title";s:13:"DTA-ETH (bid)";s:6:"course";s:10:"0.00001123";s:4:"code";s:19:"bitfinex_dtaeth_bid";s:4:"birg";s:8:"bitfinex";}i:2314;a:4:{s:5:"title";s:13:"DTA-ETH (ask)";s:6:"course";s:9:"0.0000185";s:4:"code";s:19:"bitfinex_dtaeth_ask";s:4:"birg";s:8:"bitfinex";}i:2315;a:4:{s:5:"title";s:20:"DTA-ETH (last_price)";s:6:"course";s:10:"0.00001318";s:4:"code";s:26:"bitfinex_dtaeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2316;a:4:{s:5:"title";s:13:"IQX-USD (mid)";s:6:"course";s:10:"0.01011745";s:4:"code";s:19:"bitfinex_iqxusd_mid";s:4:"birg";s:8:"bitfinex";}i:2317;a:4:{s:5:"title";s:13:"IQX-USD (bid)";s:6:"course";s:9:"0.0098029";s:4:"code";s:19:"bitfinex_iqxusd_bid";s:4:"birg";s:8:"bitfinex";}i:2318;a:4:{s:5:"title";s:13:"IQX-USD (ask)";s:6:"course";s:8:"0.010432";s:4:"code";s:19:"bitfinex_iqxusd_ask";s:4:"birg";s:8:"bitfinex";}i:2319;a:4:{s:5:"title";s:20:"IQX-USD (last_price)";s:6:"course";s:6:"0.0099";s:4:"code";s:26:"bitfinex_iqxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2320;a:4:{s:5:"title";s:13:"IQX-USD (low)";s:6:"course";s:6:"0.0099";s:4:"code";s:19:"bitfinex_iqxusd_low";s:4:"birg";s:8:"bitfinex";}i:2321;a:4:{s:5:"title";s:14:"IQX-USD (high)";s:6:"course";s:7:"0.01046";s:4:"code";s:20:"bitfinex_iqxusd_high";s:4:"birg";s:8:"bitfinex";}i:2322;a:4:{s:5:"title";s:13:"IQX-BTC (mid)";s:6:"course";s:10:"0.00000153";s:4:"code";s:19:"bitfinex_iqxbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2323;a:4:{s:5:"title";s:13:"IQX-BTC (bid)";s:6:"course";s:10:"0.00000149";s:4:"code";s:19:"bitfinex_iqxbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2324;a:4:{s:5:"title";s:13:"IQX-BTC (ask)";s:6:"course";s:10:"0.00000157";s:4:"code";s:19:"bitfinex_iqxbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2325;a:4:{s:5:"title";s:20:"IQX-BTC (last_price)";s:6:"course";s:9:"0.0000015";s:4:"code";s:26:"bitfinex_iqxbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2326;a:4:{s:5:"title";s:13:"IQX-BTC (low)";s:6:"course";s:10:"0.00000142";s:4:"code";s:19:"bitfinex_iqxbtc_low";s:4:"birg";s:8:"bitfinex";}i:2327;a:4:{s:5:"title";s:14:"IQX-BTC (high)";s:6:"course";s:10:"0.00000184";s:4:"code";s:20:"bitfinex_iqxbtc_high";s:4:"birg";s:8:"bitfinex";}i:2328;a:4:{s:5:"title";s:13:"IQX-EOS (mid)";s:6:"course";s:9:"0.0018372";s:4:"code";s:19:"bitfinex_iqxeos_mid";s:4:"birg";s:8:"bitfinex";}i:2329;a:4:{s:5:"title";s:13:"IQX-EOS (bid)";s:6:"course";s:9:"0.0017254";s:4:"code";s:19:"bitfinex_iqxeos_bid";s:4:"birg";s:8:"bitfinex";}i:2330;a:4:{s:5:"title";s:13:"IQX-EOS (ask)";s:6:"course";s:8:"0.001949";s:4:"code";s:19:"bitfinex_iqxeos_ask";s:4:"birg";s:8:"bitfinex";}i:2331;a:4:{s:5:"title";s:20:"IQX-EOS (last_price)";s:6:"course";s:7:"0.00173";s:4:"code";s:26:"bitfinex_iqxeos_last_price";s:4:"birg";s:8:"bitfinex";}i:2332;a:4:{s:5:"title";s:13:"IQX-EOS (low)";s:6:"course";s:7:"0.00173";s:4:"code";s:19:"bitfinex_iqxeos_low";s:4:"birg";s:8:"bitfinex";}i:2333;a:4:{s:5:"title";s:14:"IQX-EOS (high)";s:6:"course";s:8:"0.001945";s:4:"code";s:20:"bitfinex_iqxeos_high";s:4:"birg";s:8:"bitfinex";}i:2334;a:4:{s:5:"title";s:13:"WPR-USD (mid)";s:6:"course";s:8:"0.031348";s:4:"code";s:19:"bitfinex_wprusd_mid";s:4:"birg";s:8:"bitfinex";}i:2335;a:4:{s:5:"title";s:13:"WPR-USD (bid)";s:6:"course";s:8:"0.029004";s:4:"code";s:19:"bitfinex_wprusd_bid";s:4:"birg";s:8:"bitfinex";}i:2336;a:4:{s:5:"title";s:13:"WPR-USD (ask)";s:6:"course";s:8:"0.033692";s:4:"code";s:19:"bitfinex_wprusd_ask";s:4:"birg";s:8:"bitfinex";}i:2337;a:4:{s:5:"title";s:20:"WPR-USD (last_price)";s:6:"course";s:8:"0.029046";s:4:"code";s:26:"bitfinex_wprusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2338;a:4:{s:5:"title";s:13:"WPR-USD (low)";s:6:"course";s:8:"0.029046";s:4:"code";s:19:"bitfinex_wprusd_low";s:4:"birg";s:8:"bitfinex";}i:2339;a:4:{s:5:"title";s:14:"WPR-USD (high)";s:6:"course";s:8:"0.029056";s:4:"code";s:20:"bitfinex_wprusd_high";s:4:"birg";s:8:"bitfinex";}i:2340;a:4:{s:5:"title";s:13:"WPR-BTC (mid)";s:6:"course";s:9:"0.0000073";s:4:"code";s:19:"bitfinex_wprbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2341;a:4:{s:5:"title";s:13:"WPR-BTC (bid)";s:6:"course";s:9:"0.0000042";s:4:"code";s:19:"bitfinex_wprbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2342;a:4:{s:5:"title";s:13:"WPR-BTC (ask)";s:6:"course";s:9:"0.0000104";s:4:"code";s:19:"bitfinex_wprbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2343;a:4:{s:5:"title";s:20:"WPR-BTC (last_price)";s:6:"course";s:10:"0.00000456";s:4:"code";s:26:"bitfinex_wprbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2344;a:4:{s:5:"title";s:13:"WPR-BTC (low)";s:6:"course";s:10:"0.00000453";s:4:"code";s:19:"bitfinex_wprbtc_low";s:4:"birg";s:8:"bitfinex";}i:2345;a:4:{s:5:"title";s:14:"WPR-BTC (high)";s:6:"course";s:10:"0.00000472";s:4:"code";s:20:"bitfinex_wprbtc_high";s:4:"birg";s:8:"bitfinex";}i:2346;a:4:{s:5:"title";s:13:"WPR-ETH (mid)";s:6:"course";s:11:"0.000215825";s:4:"code";s:19:"bitfinex_wpreth_mid";s:4:"birg";s:8:"bitfinex";}i:2347;a:4:{s:5:"title";s:13:"WPR-ETH (bid)";s:6:"course";s:10:"0.00014165";s:4:"code";s:19:"bitfinex_wpreth_bid";s:4:"birg";s:8:"bitfinex";}i:2348;a:4:{s:5:"title";s:13:"WPR-ETH (ask)";s:6:"course";s:7:"0.00029";s:4:"code";s:19:"bitfinex_wpreth_ask";s:4:"birg";s:8:"bitfinex";}i:2349;a:4:{s:5:"title";s:20:"WPR-ETH (last_price)";s:6:"course";s:10:"0.00013557";s:4:"code";s:26:"bitfinex_wpreth_last_price";s:4:"birg";s:8:"bitfinex";}i:2350;a:4:{s:5:"title";s:13:"ZIL-USD (mid)";s:6:"course";s:9:"0.0362535";s:4:"code";s:19:"bitfinex_zilusd_mid";s:4:"birg";s:8:"bitfinex";}i:2351;a:4:{s:5:"title";s:13:"ZIL-USD (bid)";s:6:"course";s:6:"0.0359";s:4:"code";s:19:"bitfinex_zilusd_bid";s:4:"birg";s:8:"bitfinex";}i:2352;a:4:{s:5:"title";s:13:"ZIL-USD (ask)";s:6:"course";s:8:"0.036607";s:4:"code";s:19:"bitfinex_zilusd_ask";s:4:"birg";s:8:"bitfinex";}i:2353;a:4:{s:5:"title";s:20:"ZIL-USD (last_price)";s:6:"course";s:6:"0.0359";s:4:"code";s:26:"bitfinex_zilusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2354;a:4:{s:5:"title";s:13:"ZIL-USD (low)";s:6:"course";s:6:"0.0359";s:4:"code";s:19:"bitfinex_zilusd_low";s:4:"birg";s:8:"bitfinex";}i:2355;a:4:{s:5:"title";s:14:"ZIL-USD (high)";s:6:"course";s:8:"0.037287";s:4:"code";s:20:"bitfinex_zilusd_high";s:4:"birg";s:8:"bitfinex";}i:2356;a:4:{s:5:"title";s:13:"ZIL-BTC (mid)";s:6:"course";s:11:"0.000005475";s:4:"code";s:19:"bitfinex_zilbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2357;a:4:{s:5:"title";s:13:"ZIL-BTC (bid)";s:6:"course";s:10:"0.00000543";s:4:"code";s:19:"bitfinex_zilbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2358;a:4:{s:5:"title";s:13:"ZIL-BTC (ask)";s:6:"course";s:10:"0.00000552";s:4:"code";s:19:"bitfinex_zilbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2359;a:4:{s:5:"title";s:20:"ZIL-BTC (last_price)";s:6:"course";s:10:"0.00000555";s:4:"code";s:26:"bitfinex_zilbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2360;a:4:{s:5:"title";s:13:"ZIL-ETH (mid)";s:6:"course";s:11:"0.000176325";s:4:"code";s:19:"bitfinex_zileth_mid";s:4:"birg";s:8:"bitfinex";}i:2361;a:4:{s:5:"title";s:13:"ZIL-ETH (bid)";s:6:"course";s:8:"0.000174";s:4:"code";s:19:"bitfinex_zileth_bid";s:4:"birg";s:8:"bitfinex";}i:2362;a:4:{s:5:"title";s:13:"ZIL-ETH (ask)";s:6:"course";s:10:"0.00017865";s:4:"code";s:19:"bitfinex_zileth_ask";s:4:"birg";s:8:"bitfinex";}i:2363;a:4:{s:5:"title";s:20:"ZIL-ETH (last_price)";s:6:"course";s:8:"0.000178";s:4:"code";s:26:"bitfinex_zileth_last_price";s:4:"birg";s:8:"bitfinex";}i:2364;a:4:{s:5:"title";s:13:"ZIL-ETH (low)";s:6:"course";s:8:"0.000178";s:4:"code";s:19:"bitfinex_zileth_low";s:4:"birg";s:8:"bitfinex";}i:2365;a:4:{s:5:"title";s:14:"ZIL-ETH (high)";s:6:"course";s:10:"0.00017834";s:4:"code";s:20:"bitfinex_zileth_high";s:4:"birg";s:8:"bitfinex";}i:2366;a:4:{s:5:"title";s:13:"BNT-USD (mid)";s:6:"course";s:7:"1.26605";s:4:"code";s:19:"bitfinex_bntusd_mid";s:4:"birg";s:8:"bitfinex";}i:2367;a:4:{s:5:"title";s:13:"BNT-USD (bid)";s:6:"course";s:6:"1.2241";s:4:"code";s:19:"bitfinex_bntusd_bid";s:4:"birg";s:8:"bitfinex";}i:2368;a:4:{s:5:"title";s:13:"BNT-USD (ask)";s:6:"course";s:5:"1.308";s:4:"code";s:19:"bitfinex_bntusd_ask";s:4:"birg";s:8:"bitfinex";}i:2369;a:4:{s:5:"title";s:20:"BNT-USD (last_price)";s:6:"course";s:6:"1.3245";s:4:"code";s:26:"bitfinex_bntusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2370;a:4:{s:5:"title";s:13:"BNT-BTC (mid)";s:6:"course";s:11:"0.000195685";s:4:"code";s:19:"bitfinex_bntbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2371;a:4:{s:5:"title";s:13:"BNT-BTC (bid)";s:6:"course";s:10:"0.00018537";s:4:"code";s:19:"bitfinex_bntbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2372;a:4:{s:5:"title";s:13:"BNT-BTC (ask)";s:6:"course";s:8:"0.000206";s:4:"code";s:19:"bitfinex_bntbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2373;a:4:{s:5:"title";s:20:"BNT-BTC (last_price)";s:6:"course";s:10:"0.00019325";s:4:"code";s:26:"bitfinex_bntbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2374;a:4:{s:5:"title";s:13:"BNT-ETH (mid)";s:6:"course";s:8:"0.006463";s:4:"code";s:19:"bitfinex_bnteth_mid";s:4:"birg";s:8:"bitfinex";}i:2375;a:4:{s:5:"title";s:13:"BNT-ETH (bid)";s:6:"course";s:6:"0.0063";s:4:"code";s:19:"bitfinex_bnteth_bid";s:4:"birg";s:8:"bitfinex";}i:2376;a:4:{s:5:"title";s:13:"BNT-ETH (ask)";s:6:"course";s:8:"0.006626";s:4:"code";s:19:"bitfinex_bnteth_ask";s:4:"birg";s:8:"bitfinex";}i:2377;a:4:{s:5:"title";s:20:"BNT-ETH (last_price)";s:6:"course";s:8:"0.005957";s:4:"code";s:26:"bitfinex_bnteth_last_price";s:4:"birg";s:8:"bitfinex";}i:2378;a:4:{s:5:"title";s:13:"ABS-USD (mid)";s:6:"course";s:10:"0.00958365";s:4:"code";s:19:"bitfinex_absusd_mid";s:4:"birg";s:8:"bitfinex";}i:2379;a:4:{s:5:"title";s:13:"ABS-USD (bid)";s:6:"course";s:9:"0.0091773";s:4:"code";s:19:"bitfinex_absusd_bid";s:4:"birg";s:8:"bitfinex";}i:2380;a:4:{s:5:"title";s:13:"ABS-USD (ask)";s:6:"course";s:7:"0.00999";s:4:"code";s:19:"bitfinex_absusd_ask";s:4:"birg";s:8:"bitfinex";}i:2381;a:4:{s:5:"title";s:20:"ABS-USD (last_price)";s:6:"course";s:7:"0.00861";s:4:"code";s:26:"bitfinex_absusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2382;a:4:{s:5:"title";s:13:"ABS-ETH (mid)";s:6:"course";s:11:"0.000067495";s:4:"code";s:19:"bitfinex_abseth_mid";s:4:"birg";s:8:"bitfinex";}i:2383;a:4:{s:5:"title";s:13:"ABS-ETH (bid)";s:6:"course";s:8:"0.000045";s:4:"code";s:19:"bitfinex_abseth_bid";s:4:"birg";s:8:"bitfinex";}i:2384;a:4:{s:5:"title";s:13:"ABS-ETH (ask)";s:6:"course";s:10:"0.00008999";s:4:"code";s:19:"bitfinex_abseth_ask";s:4:"birg";s:8:"bitfinex";}i:2385;a:4:{s:5:"title";s:20:"ABS-ETH (last_price)";s:6:"course";s:10:"0.00005156";s:4:"code";s:26:"bitfinex_abseth_last_price";s:4:"birg";s:8:"bitfinex";}i:2386;a:4:{s:5:"title";s:13:"XRA-USD (mid)";s:6:"course";s:9:"0.0434055";s:4:"code";s:19:"bitfinex_xrausd_mid";s:4:"birg";s:8:"bitfinex";}i:2387;a:4:{s:5:"title";s:13:"XRA-USD (bid)";s:6:"course";s:8:"0.040313";s:4:"code";s:19:"bitfinex_xrausd_bid";s:4:"birg";s:8:"bitfinex";}i:2388;a:4:{s:5:"title";s:13:"XRA-USD (ask)";s:6:"course";s:8:"0.046498";s:4:"code";s:19:"bitfinex_xrausd_ask";s:4:"birg";s:8:"bitfinex";}i:2389;a:4:{s:5:"title";s:20:"XRA-USD (last_price)";s:6:"course";s:5:"0.046";s:4:"code";s:26:"bitfinex_xrausd_last_price";s:4:"birg";s:8:"bitfinex";}i:2390;a:4:{s:5:"title";s:13:"XRA-USD (low)";s:6:"course";s:8:"0.044402";s:4:"code";s:19:"bitfinex_xrausd_low";s:4:"birg";s:8:"bitfinex";}i:2391;a:4:{s:5:"title";s:14:"XRA-USD (high)";s:6:"course";s:5:"0.046";s:4:"code";s:20:"bitfinex_xrausd_high";s:4:"birg";s:8:"bitfinex";}i:2392;a:4:{s:5:"title";s:13:"XRA-ETH (mid)";s:6:"course";s:11:"0.000239095";s:4:"code";s:19:"bitfinex_xraeth_mid";s:4:"birg";s:8:"bitfinex";}i:2393;a:4:{s:5:"title";s:13:"XRA-ETH (bid)";s:6:"course";s:9:"0.0002042";s:4:"code";s:19:"bitfinex_xraeth_bid";s:4:"birg";s:8:"bitfinex";}i:2394;a:4:{s:5:"title";s:13:"XRA-ETH (ask)";s:6:"course";s:10:"0.00027399";s:4:"code";s:19:"bitfinex_xraeth_ask";s:4:"birg";s:8:"bitfinex";}i:2395;a:4:{s:5:"title";s:20:"XRA-ETH (last_price)";s:6:"course";s:10:"0.00024999";s:4:"code";s:26:"bitfinex_xraeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2396;a:4:{s:5:"title";s:13:"XRA-ETH (low)";s:6:"course";s:7:"0.00024";s:4:"code";s:19:"bitfinex_xraeth_low";s:4:"birg";s:8:"bitfinex";}i:2397;a:4:{s:5:"title";s:14:"XRA-ETH (high)";s:6:"course";s:10:"0.00024999";s:4:"code";s:20:"bitfinex_xraeth_high";s:4:"birg";s:8:"bitfinex";}i:2398;a:4:{s:5:"title";s:13:"MAN-USD (mid)";s:6:"course";s:8:"0.237675";s:4:"code";s:19:"bitfinex_manusd_mid";s:4:"birg";s:8:"bitfinex";}i:2399;a:4:{s:5:"title";s:13:"MAN-USD (bid)";s:6:"course";s:7:"0.23625";s:4:"code";s:19:"bitfinex_manusd_bid";s:4:"birg";s:8:"bitfinex";}i:2400;a:4:{s:5:"title";s:13:"MAN-USD (ask)";s:6:"course";s:6:"0.2391";s:4:"code";s:19:"bitfinex_manusd_ask";s:4:"birg";s:8:"bitfinex";}i:2401;a:4:{s:5:"title";s:20:"MAN-USD (last_price)";s:6:"course";s:7:"0.23624";s:4:"code";s:26:"bitfinex_manusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2402;a:4:{s:5:"title";s:13:"MAN-USD (low)";s:6:"course";s:7:"0.22186";s:4:"code";s:19:"bitfinex_manusd_low";s:4:"birg";s:8:"bitfinex";}i:2403;a:4:{s:5:"title";s:14:"MAN-USD (high)";s:6:"course";s:7:"0.23791";s:4:"code";s:20:"bitfinex_manusd_high";s:4:"birg";s:8:"bitfinex";}i:2404;a:4:{s:5:"title";s:13:"MAN-ETH (mid)";s:6:"course";s:9:"0.0011501";s:4:"code";s:19:"bitfinex_maneth_mid";s:4:"birg";s:8:"bitfinex";}i:2405;a:4:{s:5:"title";s:13:"MAN-ETH (bid)";s:6:"course";s:8:"0.001148";s:4:"code";s:19:"bitfinex_maneth_bid";s:4:"birg";s:8:"bitfinex";}i:2406;a:4:{s:5:"title";s:13:"MAN-ETH (ask)";s:6:"course";s:9:"0.0011522";s:4:"code";s:19:"bitfinex_maneth_ask";s:4:"birg";s:8:"bitfinex";}i:2407;a:4:{s:5:"title";s:20:"MAN-ETH (last_price)";s:6:"course";s:8:"0.001152";s:4:"code";s:26:"bitfinex_maneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2408;a:4:{s:5:"title";s:13:"MAN-ETH (low)";s:6:"course";s:9:"0.0010904";s:4:"code";s:19:"bitfinex_maneth_low";s:4:"birg";s:8:"bitfinex";}i:2409;a:4:{s:5:"title";s:14:"MAN-ETH (high)";s:6:"course";s:9:"0.0011522";s:4:"code";s:20:"bitfinex_maneth_high";s:4:"birg";s:8:"bitfinex";}i:2410;a:4:{s:5:"title";s:13:"BBN-USD (mid)";s:6:"course";s:9:"0.0075565";s:4:"code";s:19:"bitfinex_bbnusd_mid";s:4:"birg";s:8:"bitfinex";}i:2411;a:4:{s:5:"title";s:13:"BBN-USD (bid)";s:6:"course";s:9:"0.0073131";s:4:"code";s:19:"bitfinex_bbnusd_bid";s:4:"birg";s:8:"bitfinex";}i:2412;a:4:{s:5:"title";s:13:"BBN-USD (ask)";s:6:"course";s:9:"0.0077999";s:4:"code";s:19:"bitfinex_bbnusd_ask";s:4:"birg";s:8:"bitfinex";}i:2413;a:4:{s:5:"title";s:20:"BBN-USD (last_price)";s:6:"course";s:9:"0.0073612";s:4:"code";s:26:"bitfinex_bbnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2414;a:4:{s:5:"title";s:13:"BBN-USD (low)";s:6:"course";s:7:"0.00722";s:4:"code";s:19:"bitfinex_bbnusd_low";s:4:"birg";s:8:"bitfinex";}i:2415;a:4:{s:5:"title";s:14:"BBN-USD (high)";s:6:"course";s:6:"0.0076";s:4:"code";s:20:"bitfinex_bbnusd_high";s:4:"birg";s:8:"bitfinex";}i:2416;a:4:{s:5:"title";s:13:"BBN-ETH (mid)";s:6:"course";s:11:"0.000041475";s:4:"code";s:19:"bitfinex_bbneth_mid";s:4:"birg";s:8:"bitfinex";}i:2417;a:4:{s:5:"title";s:13:"BBN-ETH (bid)";s:6:"course";s:10:"0.00002905";s:4:"code";s:19:"bitfinex_bbneth_bid";s:4:"birg";s:8:"bitfinex";}i:2418;a:4:{s:5:"title";s:13:"BBN-ETH (ask)";s:6:"course";s:9:"0.0000539";s:4:"code";s:19:"bitfinex_bbneth_ask";s:4:"birg";s:8:"bitfinex";}i:2419;a:4:{s:5:"title";s:20:"BBN-ETH (last_price)";s:6:"course";s:9:"0.0000347";s:4:"code";s:26:"bitfinex_bbneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2420;a:4:{s:5:"title";s:13:"NIO-USD (mid)";s:6:"course";s:9:"0.0341245";s:4:"code";s:19:"bitfinex_niousd_mid";s:4:"birg";s:8:"bitfinex";}i:2421;a:4:{s:5:"title";s:13:"NIO-USD (bid)";s:6:"course";s:7:"0.03225";s:4:"code";s:19:"bitfinex_niousd_bid";s:4:"birg";s:8:"bitfinex";}i:2422;a:4:{s:5:"title";s:13:"NIO-USD (ask)";s:6:"course";s:8:"0.035999";s:4:"code";s:19:"bitfinex_niousd_ask";s:4:"birg";s:8:"bitfinex";}i:2423;a:4:{s:5:"title";s:20:"NIO-USD (last_price)";s:6:"course";s:5:"0.032";s:4:"code";s:26:"bitfinex_niousd_last_price";s:4:"birg";s:8:"bitfinex";}i:2424;a:4:{s:5:"title";s:13:"NIO-ETH (mid)";s:6:"course";s:10:"0.00014395";s:4:"code";s:19:"bitfinex_nioeth_mid";s:4:"birg";s:8:"bitfinex";}i:2425;a:4:{s:5:"title";s:13:"NIO-ETH (bid)";s:6:"course";s:6:"0.0001";s:4:"code";s:19:"bitfinex_nioeth_bid";s:4:"birg";s:8:"bitfinex";}i:2426;a:4:{s:5:"title";s:13:"NIO-ETH (ask)";s:6:"course";s:9:"0.0001879";s:4:"code";s:19:"bitfinex_nioeth_ask";s:4:"birg";s:8:"bitfinex";}i:2427;a:4:{s:5:"title";s:20:"NIO-ETH (last_price)";s:6:"course";s:10:"0.00015104";s:4:"code";s:26:"bitfinex_nioeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2428;a:4:{s:5:"title";s:13:"DGX-USD (mid)";s:6:"course";s:6:"42.005";s:4:"code";s:19:"bitfinex_dgxusd_mid";s:4:"birg";s:8:"bitfinex";}i:2429;a:4:{s:5:"title";s:13:"DGX-USD (bid)";s:6:"course";s:6:"41.011";s:4:"code";s:19:"bitfinex_dgxusd_bid";s:4:"birg";s:8:"bitfinex";}i:2430;a:4:{s:5:"title";s:13:"DGX-USD (ask)";s:6:"course";s:6:"42.999";s:4:"code";s:19:"bitfinex_dgxusd_ask";s:4:"birg";s:8:"bitfinex";}i:2431;a:4:{s:5:"title";s:20:"DGX-USD (last_price)";s:6:"course";s:6:"42.999";s:4:"code";s:26:"bitfinex_dgxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2432;a:4:{s:5:"title";s:13:"DGX-USD (low)";s:6:"course";s:5:"39.81";s:4:"code";s:19:"bitfinex_dgxusd_low";s:4:"birg";s:8:"bitfinex";}i:2433;a:4:{s:5:"title";s:14:"DGX-USD (high)";s:6:"course";s:6:"42.999";s:4:"code";s:20:"bitfinex_dgxusd_high";s:4:"birg";s:8:"bitfinex";}i:2434;a:4:{s:5:"title";s:13:"DGX-ETH (mid)";s:6:"course";s:7:"0.25893";s:4:"code";s:19:"bitfinex_dgxeth_mid";s:4:"birg";s:8:"bitfinex";}i:2435;a:4:{s:5:"title";s:13:"DGX-ETH (bid)";s:6:"course";s:7:"0.19787";s:4:"code";s:19:"bitfinex_dgxeth_bid";s:4:"birg";s:8:"bitfinex";}i:2436;a:4:{s:5:"title";s:13:"DGX-ETH (ask)";s:6:"course";s:7:"0.31999";s:4:"code";s:19:"bitfinex_dgxeth_ask";s:4:"birg";s:8:"bitfinex";}i:2437;a:4:{s:5:"title";s:20:"DGX-ETH (last_price)";s:6:"course";s:7:"0.19787";s:4:"code";s:26:"bitfinex_dgxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2438;a:4:{s:5:"title";s:13:"VET-USD (mid)";s:6:"course";s:9:"0.0110825";s:4:"code";s:19:"bitfinex_vetusd_mid";s:4:"birg";s:8:"bitfinex";}i:2439;a:4:{s:5:"title";s:13:"VET-USD (bid)";s:6:"course";s:8:"0.010926";s:4:"code";s:19:"bitfinex_vetusd_bid";s:4:"birg";s:8:"bitfinex";}i:2440;a:4:{s:5:"title";s:13:"VET-USD (ask)";s:6:"course";s:8:"0.011239";s:4:"code";s:19:"bitfinex_vetusd_ask";s:4:"birg";s:8:"bitfinex";}i:2441;a:4:{s:5:"title";s:20:"VET-USD (last_price)";s:6:"course";s:8:"0.010976";s:4:"code";s:26:"bitfinex_vetusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2442;a:4:{s:5:"title";s:13:"VET-USD (low)";s:6:"course";s:6:"0.0101";s:4:"code";s:19:"bitfinex_vetusd_low";s:4:"birg";s:8:"bitfinex";}i:2443;a:4:{s:5:"title";s:14:"VET-USD (high)";s:6:"course";s:7:"0.01125";s:4:"code";s:20:"bitfinex_vetusd_high";s:4:"birg";s:8:"bitfinex";}i:2444;a:4:{s:5:"title";s:13:"VET-BTC (mid)";s:6:"course";s:10:"0.00000168";s:4:"code";s:19:"bitfinex_vetbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2445;a:4:{s:5:"title";s:13:"VET-BTC (bid)";s:6:"course";s:10:"0.00000166";s:4:"code";s:19:"bitfinex_vetbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2446;a:4:{s:5:"title";s:13:"VET-BTC (ask)";s:6:"course";s:9:"0.0000017";s:4:"code";s:19:"bitfinex_vetbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2447;a:4:{s:5:"title";s:20:"VET-BTC (last_price)";s:6:"course";s:10:"0.00000169";s:4:"code";s:26:"bitfinex_vetbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2448;a:4:{s:5:"title";s:13:"VET-BTC (low)";s:6:"course";s:10:"0.00000155";s:4:"code";s:19:"bitfinex_vetbtc_low";s:4:"birg";s:8:"bitfinex";}i:2449;a:4:{s:5:"title";s:14:"VET-BTC (high)";s:6:"course";s:10:"0.00000171";s:4:"code";s:20:"bitfinex_vetbtc_high";s:4:"birg";s:8:"bitfinex";}i:2450;a:4:{s:5:"title";s:13:"VET-ETH (mid)";s:6:"course";s:9:"0.0000545";s:4:"code";s:19:"bitfinex_veteth_mid";s:4:"birg";s:8:"bitfinex";}i:2451;a:4:{s:5:"title";s:13:"VET-ETH (bid)";s:6:"course";s:9:"0.0000528";s:4:"code";s:19:"bitfinex_veteth_bid";s:4:"birg";s:8:"bitfinex";}i:2452;a:4:{s:5:"title";s:13:"VET-ETH (ask)";s:6:"course";s:9:"0.0000562";s:4:"code";s:19:"bitfinex_veteth_ask";s:4:"birg";s:8:"bitfinex";}i:2453;a:4:{s:5:"title";s:20:"VET-ETH (last_price)";s:6:"course";s:10:"0.00005565";s:4:"code";s:26:"bitfinex_veteth_last_price";s:4:"birg";s:8:"bitfinex";}i:2454;a:4:{s:5:"title";s:13:"VET-ETH (low)";s:6:"course";s:10:"0.00005307";s:4:"code";s:19:"bitfinex_veteth_low";s:4:"birg";s:8:"bitfinex";}i:2455;a:4:{s:5:"title";s:14:"VET-ETH (high)";s:6:"course";s:10:"0.00005565";s:4:"code";s:20:"bitfinex_veteth_high";s:4:"birg";s:8:"bitfinex";}i:2456;a:4:{s:5:"title";s:13:"UTN-USD (mid)";s:6:"course";s:9:"0.0045275";s:4:"code";s:19:"bitfinex_utnusd_mid";s:4:"birg";s:8:"bitfinex";}i:2457;a:4:{s:5:"title";s:13:"UTN-USD (bid)";s:6:"course";s:8:"0.004255";s:4:"code";s:19:"bitfinex_utnusd_bid";s:4:"birg";s:8:"bitfinex";}i:2458;a:4:{s:5:"title";s:13:"UTN-USD (ask)";s:6:"course";s:6:"0.0048";s:4:"code";s:19:"bitfinex_utnusd_ask";s:4:"birg";s:8:"bitfinex";}i:2459;a:4:{s:5:"title";s:20:"UTN-USD (last_price)";s:6:"course";s:7:"0.00449";s:4:"code";s:26:"bitfinex_utnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2460;a:4:{s:5:"title";s:13:"UTN-USD (low)";s:6:"course";s:8:"0.004484";s:4:"code";s:19:"bitfinex_utnusd_low";s:4:"birg";s:8:"bitfinex";}i:2461;a:4:{s:5:"title";s:14:"UTN-USD (high)";s:6:"course";s:7:"0.00449";s:4:"code";s:20:"bitfinex_utnusd_high";s:4:"birg";s:8:"bitfinex";}i:2462;a:4:{s:5:"title";s:13:"UTN-ETH (mid)";s:6:"course";s:11:"0.000021685";s:4:"code";s:19:"bitfinex_utneth_mid";s:4:"birg";s:8:"bitfinex";}i:2463;a:4:{s:5:"title";s:13:"UTN-ETH (bid)";s:6:"course";s:10:"0.00002041";s:4:"code";s:19:"bitfinex_utneth_bid";s:4:"birg";s:8:"bitfinex";}i:2464;a:4:{s:5:"title";s:13:"UTN-ETH (ask)";s:6:"course";s:10:"0.00002296";s:4:"code";s:19:"bitfinex_utneth_ask";s:4:"birg";s:8:"bitfinex";}i:2465;a:4:{s:5:"title";s:20:"UTN-ETH (last_price)";s:6:"course";s:10:"0.00002297";s:4:"code";s:26:"bitfinex_utneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2466;a:4:{s:5:"title";s:13:"UTN-ETH (low)";s:6:"course";s:10:"0.00002289";s:4:"code";s:19:"bitfinex_utneth_low";s:4:"birg";s:8:"bitfinex";}i:2467;a:4:{s:5:"title";s:14:"UTN-ETH (high)";s:6:"course";s:10:"0.00002297";s:4:"code";s:20:"bitfinex_utneth_high";s:4:"birg";s:8:"bitfinex";}i:2468;a:4:{s:5:"title";s:13:"TKN-USD (mid)";s:6:"course";s:8:"0.659495";s:4:"code";s:19:"bitfinex_tknusd_mid";s:4:"birg";s:8:"bitfinex";}i:2469;a:4:{s:5:"title";s:13:"TKN-USD (bid)";s:6:"course";s:3:"0.6";s:4:"code";s:19:"bitfinex_tknusd_bid";s:4:"birg";s:8:"bitfinex";}i:2470;a:4:{s:5:"title";s:13:"TKN-USD (ask)";s:6:"course";s:7:"0.71899";s:4:"code";s:19:"bitfinex_tknusd_ask";s:4:"birg";s:8:"bitfinex";}i:2471;a:4:{s:5:"title";s:20:"TKN-USD (last_price)";s:6:"course";s:3:"0.6";s:4:"code";s:26:"bitfinex_tknusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2472;a:4:{s:5:"title";s:13:"TKN-USD (low)";s:6:"course";s:3:"0.6";s:4:"code";s:19:"bitfinex_tknusd_low";s:4:"birg";s:8:"bitfinex";}i:2473;a:4:{s:5:"title";s:14:"TKN-USD (high)";s:6:"course";s:6:"0.6006";s:4:"code";s:20:"bitfinex_tknusd_high";s:4:"birg";s:8:"bitfinex";}i:2474;a:4:{s:5:"title";s:13:"TKN-ETH (mid)";s:6:"course";s:8:"0.003155";s:4:"code";s:19:"bitfinex_tkneth_mid";s:4:"birg";s:8:"bitfinex";}i:2475;a:4:{s:5:"title";s:13:"TKN-ETH (bid)";s:6:"course";s:7:"0.00251";s:4:"code";s:19:"bitfinex_tkneth_bid";s:4:"birg";s:8:"bitfinex";}i:2476;a:4:{s:5:"title";s:13:"TKN-ETH (ask)";s:6:"course";s:6:"0.0038";s:4:"code";s:19:"bitfinex_tkneth_ask";s:4:"birg";s:8:"bitfinex";}i:2477;a:4:{s:5:"title";s:20:"TKN-ETH (last_price)";s:6:"course";s:9:"0.0028846";s:4:"code";s:26:"bitfinex_tkneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2478;a:4:{s:5:"title";s:13:"TKN-ETH (low)";s:6:"course";s:8:"0.002514";s:4:"code";s:19:"bitfinex_tkneth_low";s:4:"birg";s:8:"bitfinex";}i:2479;a:4:{s:5:"title";s:14:"TKN-ETH (high)";s:6:"course";s:9:"0.0028846";s:4:"code";s:20:"bitfinex_tkneth_high";s:4:"birg";s:8:"bitfinex";}i:2480;a:4:{s:5:"title";s:13:"GOT-USD (mid)";s:6:"course";s:7:"0.50961";s:4:"code";s:19:"bitfinex_gotusd_mid";s:4:"birg";s:8:"bitfinex";}i:2481;a:4:{s:5:"title";s:13:"GOT-USD (bid)";s:6:"course";s:7:"0.49943";s:4:"code";s:19:"bitfinex_gotusd_bid";s:4:"birg";s:8:"bitfinex";}i:2482;a:4:{s:5:"title";s:13:"GOT-USD (ask)";s:6:"course";s:7:"0.51979";s:4:"code";s:19:"bitfinex_gotusd_ask";s:4:"birg";s:8:"bitfinex";}i:2483;a:4:{s:5:"title";s:20:"GOT-USD (last_price)";s:6:"course";s:7:"0.51186";s:4:"code";s:26:"bitfinex_gotusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2484;a:4:{s:5:"title";s:13:"GOT-USD (low)";s:6:"course";s:6:"0.5088";s:4:"code";s:19:"bitfinex_gotusd_low";s:4:"birg";s:8:"bitfinex";}i:2485;a:4:{s:5:"title";s:14:"GOT-USD (high)";s:6:"course";s:6:"0.5599";s:4:"code";s:20:"bitfinex_gotusd_high";s:4:"birg";s:8:"bitfinex";}i:2486;a:4:{s:5:"title";s:13:"GOT-EUR (mid)";s:6:"course";s:8:"0.446065";s:4:"code";s:19:"bitfinex_goteur_mid";s:4:"birg";s:8:"bitfinex";}i:2487;a:4:{s:5:"title";s:13:"GOT-EUR (bid)";s:6:"course";s:7:"0.43715";s:4:"code";s:19:"bitfinex_goteur_bid";s:4:"birg";s:8:"bitfinex";}i:2488;a:4:{s:5:"title";s:13:"GOT-EUR (ask)";s:6:"course";s:7:"0.45498";s:4:"code";s:19:"bitfinex_goteur_ask";s:4:"birg";s:8:"bitfinex";}i:2489;a:4:{s:5:"title";s:20:"GOT-EUR (last_price)";s:6:"course";s:10:"0.44803874";s:4:"code";s:26:"bitfinex_goteur_last_price";s:4:"birg";s:8:"bitfinex";}i:2490;a:4:{s:5:"title";s:13:"GOT-EUR (low)";s:6:"course";s:10:"0.44803874";s:4:"code";s:19:"bitfinex_goteur_low";s:4:"birg";s:8:"bitfinex";}i:2491;a:4:{s:5:"title";s:14:"GOT-EUR (high)";s:6:"course";s:10:"0.49184135";s:4:"code";s:20:"bitfinex_goteur_high";s:4:"birg";s:8:"bitfinex";}i:2492;a:4:{s:5:"title";s:13:"GOT-ETH (mid)";s:6:"course";s:10:"0.00190625";s:4:"code";s:19:"bitfinex_goteth_mid";s:4:"birg";s:8:"bitfinex";}i:2493;a:4:{s:5:"title";s:13:"GOT-ETH (bid)";s:6:"course";s:9:"0.0012725";s:4:"code";s:19:"bitfinex_goteth_bid";s:4:"birg";s:8:"bitfinex";}i:2494;a:4:{s:5:"title";s:13:"GOT-ETH (ask)";s:6:"course";s:7:"0.00254";s:4:"code";s:19:"bitfinex_goteth_ask";s:4:"birg";s:8:"bitfinex";}i:2495;a:4:{s:5:"title";s:20:"GOT-ETH (last_price)";s:6:"course";s:6:"0.0025";s:4:"code";s:26:"bitfinex_goteth_last_price";s:4:"birg";s:8:"bitfinex";}i:2496;a:4:{s:5:"title";s:13:"GOT-ETH (low)";s:6:"course";s:6:"0.0025";s:4:"code";s:19:"bitfinex_goteth_low";s:4:"birg";s:8:"bitfinex";}i:2497;a:4:{s:5:"title";s:14:"GOT-ETH (high)";s:6:"course";s:6:"0.0026";s:4:"code";s:20:"bitfinex_goteth_high";s:4:"birg";s:8:"bitfinex";}i:2498;a:4:{s:5:"title";s:13:"XTZ-USD (mid)";s:6:"course";s:7:"1.35975";s:4:"code";s:19:"bitfinex_xtzusd_mid";s:4:"birg";s:8:"bitfinex";}i:2499;a:4:{s:5:"title";s:13:"XTZ-USD (bid)";s:6:"course";s:6:"1.3538";s:4:"code";s:19:"bitfinex_xtzusd_bid";s:4:"birg";s:8:"bitfinex";}i:2500;a:4:{s:5:"title";s:13:"XTZ-USD (ask)";s:6:"course";s:6:"1.3657";s:4:"code";s:19:"bitfinex_xtzusd_ask";s:4:"birg";s:8:"bitfinex";}i:2501;a:4:{s:5:"title";s:20:"XTZ-USD (last_price)";s:6:"course";s:6:"1.3537";s:4:"code";s:26:"bitfinex_xtzusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2502;a:4:{s:5:"title";s:13:"XTZ-USD (low)";s:6:"course";s:6:"1.3537";s:4:"code";s:19:"bitfinex_xtzusd_low";s:4:"birg";s:8:"bitfinex";}i:2503;a:4:{s:5:"title";s:14:"XTZ-USD (high)";s:6:"course";s:6:"1.3887";s:4:"code";s:20:"bitfinex_xtzusd_high";s:4:"birg";s:8:"bitfinex";}i:2504;a:4:{s:5:"title";s:13:"XTZ-BTC (mid)";s:6:"course";s:10:"0.00020947";s:4:"code";s:19:"bitfinex_xtzbtc_mid";s:4:"birg";s:8:"bitfinex";}i:2505;a:4:{s:5:"title";s:13:"XTZ-BTC (bid)";s:6:"course";s:10:"0.00020834";s:4:"code";s:19:"bitfinex_xtzbtc_bid";s:4:"birg";s:8:"bitfinex";}i:2506;a:4:{s:5:"title";s:13:"XTZ-BTC (ask)";s:6:"course";s:9:"0.0002106";s:4:"code";s:19:"bitfinex_xtzbtc_ask";s:4:"birg";s:8:"bitfinex";}i:2507;a:4:{s:5:"title";s:20:"XTZ-BTC (last_price)";s:6:"course";s:10:"0.00021056";s:4:"code";s:26:"bitfinex_xtzbtc_last_price";s:4:"birg";s:8:"bitfinex";}i:2508;a:4:{s:5:"title";s:13:"XTZ-BTC (low)";s:6:"course";s:10:"0.00020559";s:4:"code";s:19:"bitfinex_xtzbtc_low";s:4:"birg";s:8:"bitfinex";}i:2509;a:4:{s:5:"title";s:14:"XTZ-BTC (high)";s:6:"course";s:10:"0.00021323";s:4:"code";s:20:"bitfinex_xtzbtc_high";s:4:"birg";s:8:"bitfinex";}i:2510;a:4:{s:5:"title";s:13:"CNN-USD (mid)";s:6:"course";s:11:"0.000482215";s:4:"code";s:19:"bitfinex_cnnusd_mid";s:4:"birg";s:8:"bitfinex";}i:2511;a:4:{s:5:"title";s:13:"CNN-USD (bid)";s:6:"course";s:10:"0.00046446";s:4:"code";s:19:"bitfinex_cnnusd_bid";s:4:"birg";s:8:"bitfinex";}i:2512;a:4:{s:5:"title";s:13:"CNN-USD (ask)";s:6:"course";s:10:"0.00049997";s:4:"code";s:19:"bitfinex_cnnusd_ask";s:4:"birg";s:8:"bitfinex";}i:2513;a:4:{s:5:"title";s:20:"CNN-USD (last_price)";s:6:"course";s:9:"0.0004755";s:4:"code";s:26:"bitfinex_cnnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2514;a:4:{s:5:"title";s:13:"CNN-USD (low)";s:6:"course";s:7:"0.00047";s:4:"code";s:19:"bitfinex_cnnusd_low";s:4:"birg";s:8:"bitfinex";}i:2515;a:4:{s:5:"title";s:14:"CNN-USD (high)";s:6:"course";s:7:"0.00051";s:4:"code";s:20:"bitfinex_cnnusd_high";s:4:"birg";s:8:"bitfinex";}i:2516;a:4:{s:5:"title";s:13:"CNN-ETH (mid)";s:6:"course";s:10:"0.00000232";s:4:"code";s:19:"bitfinex_cnneth_mid";s:4:"birg";s:8:"bitfinex";}i:2517;a:4:{s:5:"title";s:13:"CNN-ETH (bid)";s:6:"course";s:10:"0.00000231";s:4:"code";s:19:"bitfinex_cnneth_bid";s:4:"birg";s:8:"bitfinex";}i:2518;a:4:{s:5:"title";s:13:"CNN-ETH (ask)";s:6:"course";s:10:"0.00000233";s:4:"code";s:19:"bitfinex_cnneth_ask";s:4:"birg";s:8:"bitfinex";}i:2519;a:4:{s:5:"title";s:20:"CNN-ETH (last_price)";s:6:"course";s:10:"0.00000232";s:4:"code";s:26:"bitfinex_cnneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2520;a:4:{s:5:"title";s:13:"CNN-ETH (low)";s:6:"course";s:10:"0.00000223";s:4:"code";s:19:"bitfinex_cnneth_low";s:4:"birg";s:8:"bitfinex";}i:2521;a:4:{s:5:"title";s:14:"CNN-ETH (high)";s:6:"course";s:9:"0.0000024";s:4:"code";s:20:"bitfinex_cnneth_high";s:4:"birg";s:8:"bitfinex";}i:2522;a:4:{s:5:"title";s:13:"BOX-USD (mid)";s:6:"course";s:8:"0.010304";s:4:"code";s:19:"bitfinex_boxusd_mid";s:4:"birg";s:8:"bitfinex";}i:2523;a:4:{s:5:"title";s:13:"BOX-USD (bid)";s:6:"course";s:8:"0.010201";s:4:"code";s:19:"bitfinex_boxusd_bid";s:4:"birg";s:8:"bitfinex";}i:2524;a:4:{s:5:"title";s:13:"BOX-USD (ask)";s:6:"course";s:8:"0.010407";s:4:"code";s:19:"bitfinex_boxusd_ask";s:4:"birg";s:8:"bitfinex";}i:2525;a:4:{s:5:"title";s:20:"BOX-USD (last_price)";s:6:"course";s:8:"0.010316";s:4:"code";s:26:"bitfinex_boxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2526;a:4:{s:5:"title";s:13:"BOX-USD (low)";s:6:"course";s:8:"0.010316";s:4:"code";s:19:"bitfinex_boxusd_low";s:4:"birg";s:8:"bitfinex";}i:2527;a:4:{s:5:"title";s:14:"BOX-USD (high)";s:6:"course";s:8:"0.010443";s:4:"code";s:20:"bitfinex_boxusd_high";s:4:"birg";s:8:"bitfinex";}i:2528;a:4:{s:5:"title";s:13:"BOX-ETH (mid)";s:6:"course";s:11:"0.000049795";s:4:"code";s:19:"bitfinex_boxeth_mid";s:4:"birg";s:8:"bitfinex";}i:2529;a:4:{s:5:"title";s:13:"BOX-ETH (bid)";s:6:"course";s:9:"0.0000493";s:4:"code";s:19:"bitfinex_boxeth_bid";s:4:"birg";s:8:"bitfinex";}i:2530;a:4:{s:5:"title";s:13:"BOX-ETH (ask)";s:6:"course";s:10:"0.00005029";s:4:"code";s:19:"bitfinex_boxeth_ask";s:4:"birg";s:8:"bitfinex";}i:2531;a:4:{s:5:"title";s:20:"BOX-ETH (last_price)";s:6:"course";s:10:"0.00004957";s:4:"code";s:26:"bitfinex_boxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2532;a:4:{s:5:"title";s:13:"BOX-ETH (low)";s:6:"course";s:10:"0.00004957";s:4:"code";s:19:"bitfinex_boxeth_low";s:4:"birg";s:8:"bitfinex";}i:2533;a:4:{s:5:"title";s:14:"BOX-ETH (high)";s:6:"course";s:10:"0.00005051";s:4:"code";s:20:"bitfinex_boxeth_high";s:4:"birg";s:8:"bitfinex";}i:2534;a:4:{s:5:"title";s:13:"TRX-EUR (mid)";s:6:"course";s:8:"0.020524";s:4:"code";s:19:"bitfinex_trxeur_mid";s:4:"birg";s:8:"bitfinex";}i:2535;a:4:{s:5:"title";s:13:"TRX-EUR (bid)";s:6:"course";s:8:"0.020484";s:4:"code";s:19:"bitfinex_trxeur_bid";s:4:"birg";s:8:"bitfinex";}i:2536;a:4:{s:5:"title";s:13:"TRX-EUR (ask)";s:6:"course";s:8:"0.020564";s:4:"code";s:19:"bitfinex_trxeur_ask";s:4:"birg";s:8:"bitfinex";}i:2537;a:4:{s:5:"title";s:20:"TRX-EUR (last_price)";s:6:"course";s:7:"0.02048";s:4:"code";s:26:"bitfinex_trxeur_last_price";s:4:"birg";s:8:"bitfinex";}i:2538;a:4:{s:5:"title";s:13:"TRX-EUR (low)";s:6:"course";s:8:"0.020472";s:4:"code";s:19:"bitfinex_trxeur_low";s:4:"birg";s:8:"bitfinex";}i:2539;a:4:{s:5:"title";s:14:"TRX-EUR (high)";s:6:"course";s:8:"0.021031";s:4:"code";s:20:"bitfinex_trxeur_high";s:4:"birg";s:8:"bitfinex";}i:2540;a:4:{s:5:"title";s:13:"TRX-GBP (mid)";s:6:"course";s:9:"0.0182715";s:4:"code";s:19:"bitfinex_trxgbp_mid";s:4:"birg";s:8:"bitfinex";}i:2541;a:4:{s:5:"title";s:13:"TRX-GBP (bid)";s:6:"course";s:8:"0.018236";s:4:"code";s:19:"bitfinex_trxgbp_bid";s:4:"birg";s:8:"bitfinex";}i:2542;a:4:{s:5:"title";s:13:"TRX-GBP (ask)";s:6:"course";s:8:"0.018307";s:4:"code";s:19:"bitfinex_trxgbp_ask";s:4:"birg";s:8:"bitfinex";}i:2543;a:4:{s:5:"title";s:20:"TRX-GBP (last_price)";s:6:"course";s:7:"0.01823";s:4:"code";s:26:"bitfinex_trxgbp_last_price";s:4:"birg";s:8:"bitfinex";}i:2544;a:4:{s:5:"title";s:13:"TRX-GBP (low)";s:6:"course";s:7:"0.01823";s:4:"code";s:19:"bitfinex_trxgbp_low";s:4:"birg";s:8:"bitfinex";}i:2545;a:4:{s:5:"title";s:14:"TRX-GBP (high)";s:6:"course";s:8:"0.018684";s:4:"code";s:20:"bitfinex_trxgbp_high";s:4:"birg";s:8:"bitfinex";}i:2546;a:4:{s:5:"title";s:13:"TRX-JPY (mid)";s:6:"course";s:7:"2.62375";s:4:"code";s:19:"bitfinex_trxjpy_mid";s:4:"birg";s:8:"bitfinex";}i:2547;a:4:{s:5:"title";s:13:"TRX-JPY (bid)";s:6:"course";s:6:"2.6187";s:4:"code";s:19:"bitfinex_trxjpy_bid";s:4:"birg";s:8:"bitfinex";}i:2548;a:4:{s:5:"title";s:13:"TRX-JPY (ask)";s:6:"course";s:6:"2.6288";s:4:"code";s:19:"bitfinex_trxjpy_ask";s:4:"birg";s:8:"bitfinex";}i:2549;a:4:{s:5:"title";s:20:"TRX-JPY (last_price)";s:6:"course";s:10:"2.61729995";s:4:"code";s:26:"bitfinex_trxjpy_last_price";s:4:"birg";s:8:"bitfinex";}i:2550;a:4:{s:5:"title";s:13:"TRX-JPY (low)";s:6:"course";s:10:"2.61729995";s:4:"code";s:19:"bitfinex_trxjpy_low";s:4:"birg";s:8:"bitfinex";}i:2551;a:4:{s:5:"title";s:14:"TRX-JPY (high)";s:6:"course";s:10:"2.68289957";s:4:"code";s:20:"bitfinex_trxjpy_high";s:4:"birg";s:8:"bitfinex";}i:2552;a:4:{s:5:"title";s:13:"MGO-USD (mid)";s:6:"course";s:7:"0.74871";s:4:"code";s:19:"bitfinex_mgousd_mid";s:4:"birg";s:8:"bitfinex";}i:2553;a:4:{s:5:"title";s:13:"MGO-USD (bid)";s:6:"course";s:7:"0.74583";s:4:"code";s:19:"bitfinex_mgousd_bid";s:4:"birg";s:8:"bitfinex";}i:2554;a:4:{s:5:"title";s:13:"MGO-USD (ask)";s:6:"course";s:7:"0.75159";s:4:"code";s:19:"bitfinex_mgousd_ask";s:4:"birg";s:8:"bitfinex";}i:2555;a:4:{s:5:"title";s:20:"MGO-USD (last_price)";s:6:"course";s:7:"0.74872";s:4:"code";s:26:"bitfinex_mgousd_last_price";s:4:"birg";s:8:"bitfinex";}i:2556;a:4:{s:5:"title";s:13:"MGO-USD (low)";s:6:"course";s:7:"0.71302";s:4:"code";s:19:"bitfinex_mgousd_low";s:4:"birg";s:8:"bitfinex";}i:2557;a:4:{s:5:"title";s:14:"MGO-USD (high)";s:6:"course";s:7:"0.76233";s:4:"code";s:20:"bitfinex_mgousd_high";s:4:"birg";s:8:"bitfinex";}i:2558;a:4:{s:5:"title";s:13:"MGO-ETH (mid)";s:6:"course";s:9:"0.0036825";s:4:"code";s:19:"bitfinex_mgoeth_mid";s:4:"birg";s:8:"bitfinex";}i:2559;a:4:{s:5:"title";s:13:"MGO-ETH (bid)";s:6:"course";s:9:"0.0036504";s:4:"code";s:19:"bitfinex_mgoeth_bid";s:4:"birg";s:8:"bitfinex";}i:2560;a:4:{s:5:"title";s:13:"MGO-ETH (ask)";s:6:"course";s:9:"0.0037146";s:4:"code";s:19:"bitfinex_mgoeth_ask";s:4:"birg";s:8:"bitfinex";}i:2561;a:4:{s:5:"title";s:20:"MGO-ETH (last_price)";s:6:"course";s:8:"0.003682";s:4:"code";s:26:"bitfinex_mgoeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2562;a:4:{s:5:"title";s:13:"MGO-ETH (low)";s:6:"course";s:6:"0.0035";s:4:"code";s:19:"bitfinex_mgoeth_low";s:4:"birg";s:8:"bitfinex";}i:2563;a:4:{s:5:"title";s:14:"MGO-ETH (high)";s:6:"course";s:7:"0.00371";s:4:"code";s:20:"bitfinex_mgoeth_high";s:4:"birg";s:8:"bitfinex";}i:2564;a:4:{s:5:"title";s:13:"RTE-USD (mid)";s:6:"course";s:9:"0.0066505";s:4:"code";s:19:"bitfinex_rteusd_mid";s:4:"birg";s:8:"bitfinex";}i:2565;a:4:{s:5:"title";s:13:"RTE-USD (bid)";s:6:"course";s:9:"0.0063011";s:4:"code";s:19:"bitfinex_rteusd_bid";s:4:"birg";s:8:"bitfinex";}i:2566;a:4:{s:5:"title";s:13:"RTE-USD (ask)";s:6:"course";s:9:"0.0069999";s:4:"code";s:19:"bitfinex_rteusd_ask";s:4:"birg";s:8:"bitfinex";}i:2567;a:4:{s:5:"title";s:20:"RTE-USD (last_price)";s:6:"course";s:5:"0.007";s:4:"code";s:26:"bitfinex_rteusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2568;a:4:{s:5:"title";s:13:"RTE-USD (low)";s:6:"course";s:5:"0.007";s:4:"code";s:19:"bitfinex_rteusd_low";s:4:"birg";s:8:"bitfinex";}i:2569;a:4:{s:5:"title";s:14:"RTE-USD (high)";s:6:"course";s:6:"0.0071";s:4:"code";s:20:"bitfinex_rteusd_high";s:4:"birg";s:8:"bitfinex";}i:2570;a:4:{s:5:"title";s:13:"RTE-ETH (mid)";s:6:"course";s:9:"0.0000329";s:4:"code";s:19:"bitfinex_rteeth_mid";s:4:"birg";s:8:"bitfinex";}i:2571;a:4:{s:5:"title";s:13:"RTE-ETH (bid)";s:6:"course";s:9:"0.0000268";s:4:"code";s:19:"bitfinex_rteeth_bid";s:4:"birg";s:8:"bitfinex";}i:2572;a:4:{s:5:"title";s:13:"RTE-ETH (ask)";s:6:"course";s:8:"0.000039";s:4:"code";s:19:"bitfinex_rteeth_ask";s:4:"birg";s:8:"bitfinex";}i:2573;a:4:{s:5:"title";s:20:"RTE-ETH (last_price)";s:6:"course";s:10:"0.00002894";s:4:"code";s:26:"bitfinex_rteeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2574;a:4:{s:5:"title";s:13:"YGG-USD (mid)";s:6:"course";s:9:"0.0016445";s:4:"code";s:19:"bitfinex_yggusd_mid";s:4:"birg";s:8:"bitfinex";}i:2575;a:4:{s:5:"title";s:13:"YGG-USD (bid)";s:6:"course";s:7:"0.00164";s:4:"code";s:19:"bitfinex_yggusd_bid";s:4:"birg";s:8:"bitfinex";}i:2576;a:4:{s:5:"title";s:13:"YGG-USD (ask)";s:6:"course";s:8:"0.001649";s:4:"code";s:19:"bitfinex_yggusd_ask";s:4:"birg";s:8:"bitfinex";}i:2577;a:4:{s:5:"title";s:20:"YGG-USD (last_price)";s:6:"course";s:7:"0.00164";s:4:"code";s:26:"bitfinex_yggusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2578;a:4:{s:5:"title";s:13:"YGG-USD (low)";s:6:"course";s:9:"0.0015821";s:4:"code";s:19:"bitfinex_yggusd_low";s:4:"birg";s:8:"bitfinex";}i:2579;a:4:{s:5:"title";s:14:"YGG-USD (high)";s:6:"course";s:7:"0.00179";s:4:"code";s:20:"bitfinex_yggusd_high";s:4:"birg";s:8:"bitfinex";}i:2580;a:4:{s:5:"title";s:13:"YGG-ETH (mid)";s:6:"course";s:10:"0.00000802";s:4:"code";s:19:"bitfinex_yggeth_mid";s:4:"birg";s:8:"bitfinex";}i:2581;a:4:{s:5:"title";s:13:"YGG-ETH (bid)";s:6:"course";s:10:"0.00000798";s:4:"code";s:19:"bitfinex_yggeth_bid";s:4:"birg";s:8:"bitfinex";}i:2582;a:4:{s:5:"title";s:13:"YGG-ETH (ask)";s:6:"course";s:10:"0.00000806";s:4:"code";s:19:"bitfinex_yggeth_ask";s:4:"birg";s:8:"bitfinex";}i:2583;a:4:{s:5:"title";s:20:"YGG-ETH (last_price)";s:6:"course";s:10:"0.00000804";s:4:"code";s:26:"bitfinex_yggeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2584;a:4:{s:5:"title";s:13:"YGG-ETH (low)";s:6:"course";s:10:"0.00000793";s:4:"code";s:19:"bitfinex_yggeth_low";s:4:"birg";s:8:"bitfinex";}i:2585;a:4:{s:5:"title";s:14:"YGG-ETH (high)";s:6:"course";s:10:"0.00000865";s:4:"code";s:20:"bitfinex_yggeth_high";s:4:"birg";s:8:"bitfinex";}i:2586;a:4:{s:5:"title";s:13:"MLN-USD (mid)";s:6:"course";s:7:"14.6105";s:4:"code";s:19:"bitfinex_mlnusd_mid";s:4:"birg";s:8:"bitfinex";}i:2587;a:4:{s:5:"title";s:13:"MLN-USD (bid)";s:6:"course";s:6:"13.302";s:4:"code";s:19:"bitfinex_mlnusd_bid";s:4:"birg";s:8:"bitfinex";}i:2588;a:4:{s:5:"title";s:13:"MLN-USD (ask)";s:6:"course";s:6:"15.919";s:4:"code";s:19:"bitfinex_mlnusd_ask";s:4:"birg";s:8:"bitfinex";}i:2589;a:4:{s:5:"title";s:20:"MLN-USD (last_price)";s:6:"course";s:6:"11.764";s:4:"code";s:26:"bitfinex_mlnusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2590;a:4:{s:5:"title";s:13:"MLN-USD (low)";s:6:"course";s:6:"11.764";s:4:"code";s:19:"bitfinex_mlnusd_low";s:4:"birg";s:8:"bitfinex";}i:2591;a:4:{s:5:"title";s:14:"MLN-USD (high)";s:6:"course";s:6:"14.824";s:4:"code";s:20:"bitfinex_mlnusd_high";s:4:"birg";s:8:"bitfinex";}i:2592;a:4:{s:5:"title";s:13:"MLN-ETH (mid)";s:6:"course";s:8:"0.067021";s:4:"code";s:19:"bitfinex_mlneth_mid";s:4:"birg";s:8:"bitfinex";}i:2593;a:4:{s:5:"title";s:13:"MLN-ETH (bid)";s:6:"course";s:8:"0.064042";s:4:"code";s:19:"bitfinex_mlneth_bid";s:4:"birg";s:8:"bitfinex";}i:2594;a:4:{s:5:"title";s:13:"MLN-ETH (ask)";s:6:"course";s:4:"0.07";s:4:"code";s:19:"bitfinex_mlneth_ask";s:4:"birg";s:8:"bitfinex";}i:2595;a:4:{s:5:"title";s:20:"MLN-ETH (last_price)";s:6:"course";s:8:"0.058534";s:4:"code";s:26:"bitfinex_mlneth_last_price";s:4:"birg";s:8:"bitfinex";}i:2596;a:4:{s:5:"title";s:13:"MLN-ETH (low)";s:6:"course";s:6:"0.0585";s:4:"code";s:19:"bitfinex_mlneth_low";s:4:"birg";s:8:"bitfinex";}i:2597;a:4:{s:5:"title";s:14:"MLN-ETH (high)";s:6:"course";s:4:"0.07";s:4:"code";s:20:"bitfinex_mlneth_high";s:4:"birg";s:8:"bitfinex";}i:2598;a:4:{s:5:"title";s:13:"WTC-USD (mid)";s:6:"course";s:7:"3.25895";s:4:"code";s:19:"bitfinex_wtcusd_mid";s:4:"birg";s:8:"bitfinex";}i:2599;a:4:{s:5:"title";s:13:"WTC-USD (bid)";s:6:"course";s:5:"3.156";s:4:"code";s:19:"bitfinex_wtcusd_bid";s:4:"birg";s:8:"bitfinex";}i:2600;a:4:{s:5:"title";s:13:"WTC-USD (ask)";s:6:"course";s:6:"3.3619";s:4:"code";s:19:"bitfinex_wtcusd_ask";s:4:"birg";s:8:"bitfinex";}i:2601;a:4:{s:5:"title";s:20:"WTC-USD (last_price)";s:6:"course";s:6:"3.3619";s:4:"code";s:26:"bitfinex_wtcusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2602;a:4:{s:5:"title";s:13:"WTC-USD (low)";s:6:"course";s:3:"3.3";s:4:"code";s:19:"bitfinex_wtcusd_low";s:4:"birg";s:8:"bitfinex";}i:2603;a:4:{s:5:"title";s:14:"WTC-USD (high)";s:6:"course";s:6:"3.3619";s:4:"code";s:20:"bitfinex_wtcusd_high";s:4:"birg";s:8:"bitfinex";}i:2604;a:4:{s:5:"title";s:13:"WTC-ETH (mid)";s:6:"course";s:9:"0.0163295";s:4:"code";s:19:"bitfinex_wtceth_mid";s:4:"birg";s:8:"bitfinex";}i:2605;a:4:{s:5:"title";s:13:"WTC-ETH (bid)";s:6:"course";s:8:"0.015481";s:4:"code";s:19:"bitfinex_wtceth_bid";s:4:"birg";s:8:"bitfinex";}i:2606;a:4:{s:5:"title";s:13:"WTC-ETH (ask)";s:6:"course";s:8:"0.017178";s:4:"code";s:19:"bitfinex_wtceth_ask";s:4:"birg";s:8:"bitfinex";}i:2607;a:4:{s:5:"title";s:20:"WTC-ETH (last_price)";s:6:"course";s:8:"0.016099";s:4:"code";s:26:"bitfinex_wtceth_last_price";s:4:"birg";s:8:"bitfinex";}i:2608;a:4:{s:5:"title";s:13:"WTC-ETH (low)";s:6:"course";s:8:"0.016099";s:4:"code";s:19:"bitfinex_wtceth_low";s:4:"birg";s:8:"bitfinex";}i:2609;a:4:{s:5:"title";s:14:"WTC-ETH (high)";s:6:"course";s:6:"0.0161";s:4:"code";s:20:"bitfinex_wtceth_high";s:4:"birg";s:8:"bitfinex";}i:2610;a:4:{s:5:"title";s:13:"CSX-USD (mid)";s:6:"course";s:8:"0.146615";s:4:"code";s:19:"bitfinex_csxusd_mid";s:4:"birg";s:8:"bitfinex";}i:2611;a:4:{s:5:"title";s:13:"CSX-USD (bid)";s:6:"course";s:6:"0.1406";s:4:"code";s:19:"bitfinex_csxusd_bid";s:4:"birg";s:8:"bitfinex";}i:2612;a:4:{s:5:"title";s:13:"CSX-USD (ask)";s:6:"course";s:7:"0.15263";s:4:"code";s:19:"bitfinex_csxusd_ask";s:4:"birg";s:8:"bitfinex";}i:2613;a:4:{s:5:"title";s:20:"CSX-USD (last_price)";s:6:"course";s:5:"0.143";s:4:"code";s:26:"bitfinex_csxusd_last_price";s:4:"birg";s:8:"bitfinex";}i:2614;a:4:{s:5:"title";s:13:"CSX-USD (low)";s:6:"course";s:7:"0.14268";s:4:"code";s:19:"bitfinex_csxusd_low";s:4:"birg";s:8:"bitfinex";}i:2615;a:4:{s:5:"title";s:14:"CSX-USD (high)";s:6:"course";s:7:"0.14862";s:4:"code";s:20:"bitfinex_csxusd_high";s:4:"birg";s:8:"bitfinex";}i:2616;a:4:{s:5:"title";s:13:"CSX-ETH (mid)";s:6:"course";s:11:"0.000721025";s:4:"code";s:19:"bitfinex_csxeth_mid";s:4:"birg";s:8:"bitfinex";}i:2617;a:4:{s:5:"title";s:13:"CSX-ETH (bid)";s:6:"course";s:8:"0.000688";s:4:"code";s:19:"bitfinex_csxeth_bid";s:4:"birg";s:8:"bitfinex";}i:2618;a:4:{s:5:"title";s:13:"CSX-ETH (ask)";s:6:"course";s:10:"0.00075405";s:4:"code";s:19:"bitfinex_csxeth_ask";s:4:"birg";s:8:"bitfinex";}i:2619;a:4:{s:5:"title";s:20:"CSX-ETH (last_price)";s:6:"course";s:6:"0.0007";s:4:"code";s:26:"bitfinex_csxeth_last_price";s:4:"birg";s:8:"bitfinex";}i:2620;a:4:{s:5:"title";s:13:"CSX-ETH (low)";s:6:"course";s:8:"0.000688";s:4:"code";s:19:"bitfinex_csxeth_low";s:4:"birg";s:8:"bitfinex";}i:2621;a:4:{s:5:"title";s:14:"CSX-ETH (high)";s:6:"course";s:10:"0.00071222";s:4:"code";s:20:"bitfinex_csxeth_high";s:4:"birg";s:8:"bitfinex";}i:2622;a:4:{s:5:"title";s:7:"ETH-BTC";s:6:"course";s:8:"0.031365";s:4:"code";s:14:"binance_ethbtc";s:4:"birg";s:7:"binance";}i:2623;a:4:{s:5:"title";s:7:"LTC-BTC";s:6:"course";s:8:"0.008026";s:4:"code";s:14:"binance_ltcbtc";s:4:"birg";s:7:"binance";}i:2624;a:4:{s:5:"title";s:7:"BNB-BTC";s:6:"course";s:8:"0.001497";s:4:"code";s:14:"binance_bnbbtc";s:4:"birg";s:7:"binance";}i:2625;a:4:{s:5:"title";s:7:"NEO-BTC";s:6:"course";s:8:"0.002487";s:4:"code";s:14:"binance_neobtc";s:4:"birg";s:7:"binance";}i:2626;a:4:{s:5:"title";s:8:"QTU-METH";s:6:"course";s:8:"0.019935";s:4:"code";s:15:"binance_qtumeth";s:4:"birg";s:7:"binance";}i:2627;a:4:{s:5:"title";s:7:"EOS-ETH";s:6:"course";s:8:"0.026615";s:4:"code";s:14:"binance_eoseth";s:4:"birg";s:7:"binance";}i:2628;a:4:{s:5:"title";s:7:"SNT-ETH";s:6:"course";s:10:"0.00017761";s:4:"code";s:14:"binance_snteth";s:4:"birg";s:7:"binance";}i:2629;a:4:{s:5:"title";s:7:"BNT-ETH";s:6:"course";s:8:"0.006369";s:4:"code";s:14:"binance_bnteth";s:4:"birg";s:7:"binance";}i:2630;a:4:{s:5:"title";s:7:"BCC-BTC";s:6:"course";s:8:"0.067695";s:4:"code";s:14:"binance_bccbtc";s:4:"birg";s:7:"binance";}i:2631;a:4:{s:5:"title";s:7:"GAS-BTC";s:6:"course";s:8:"0.000796";s:4:"code";s:14:"binance_gasbtc";s:4:"birg";s:7:"binance";}i:2632;a:4:{s:5:"title";s:7:"BNB-ETH";s:6:"course";s:8:"0.047767";s:4:"code";s:14:"binance_bnbeth";s:4:"birg";s:7:"binance";}i:2633;a:4:{s:5:"title";s:8:"BTC-USDT";s:6:"course";s:7:"6493.87";s:4:"code";s:15:"binance_btcusdt";s:4:"birg";s:7:"binance";}i:2634;a:4:{s:5:"title";s:8:"ETH-USDT";s:6:"course";s:6:"203.71";s:4:"code";s:15:"binance_ethusdt";s:4:"birg";s:7:"binance";}i:2635;a:4:{s:5:"title";s:7:"OAX-ETH";s:6:"course";s:9:"0.0012574";s:4:"code";s:14:"binance_oaxeth";s:4:"birg";s:7:"binance";}i:2636;a:4:{s:5:"title";s:7:"DNT-ETH";s:6:"course";s:10:"0.00012497";s:4:"code";s:14:"binance_dnteth";s:4:"birg";s:7:"binance";}i:2637;a:4:{s:5:"title";s:7:"MCO-ETH";s:6:"course";s:8:"0.023505";s:4:"code";s:14:"binance_mcoeth";s:4:"birg";s:7:"binance";}i:2638;a:4:{s:5:"title";s:7:"MCO-BTC";s:6:"course";s:8:"0.000737";s:4:"code";s:14:"binance_mcobtc";s:4:"birg";s:7:"binance";}i:2639;a:4:{s:5:"title";s:7:"WTC-BTC";s:6:"course";s:9:"0.0004767";s:4:"code";s:14:"binance_wtcbtc";s:4:"birg";s:7:"binance";}i:2640;a:4:{s:5:"title";s:7:"WTC-ETH";s:6:"course";s:8:"0.015221";s:4:"code";s:14:"binance_wtceth";s:4:"birg";s:7:"binance";}i:2641;a:4:{s:5:"title";s:7:"LRC-BTC";s:6:"course";s:9:"0.0000177";s:4:"code";s:14:"binance_lrcbtc";s:4:"birg";s:7:"binance";}i:2642;a:4:{s:5:"title";s:7:"LRC-ETH";s:6:"course";s:9:"0.0005649";s:4:"code";s:14:"binance_lrceth";s:4:"birg";s:7:"binance";}i:2643;a:4:{s:5:"title";s:8:"QTU-MBTC";s:6:"course";s:8:"0.000626";s:4:"code";s:15:"binance_qtumbtc";s:4:"birg";s:7:"binance";}i:2644;a:4:{s:5:"title";s:8:"YOY-OBTC";s:6:"course";s:10:"0.00000512";s:4:"code";s:15:"binance_yoyobtc";s:4:"birg";s:7:"binance";}i:2645;a:4:{s:5:"title";s:7:"OMG-BTC";s:6:"course";s:8:"0.000498";s:4:"code";s:14:"binance_omgbtc";s:4:"birg";s:7:"binance";}i:2646;a:4:{s:5:"title";s:7:"OMG-ETH";s:6:"course";s:8:"0.015895";s:4:"code";s:14:"binance_omgeth";s:4:"birg";s:7:"binance";}i:2647;a:4:{s:5:"title";s:7:"ZRX-BTC";s:6:"course";s:9:"0.0001238";s:4:"code";s:14:"binance_zrxbtc";s:4:"birg";s:7:"binance";}i:2648;a:4:{s:5:"title";s:7:"ZRX-ETH";s:6:"course";s:10:"0.00394757";s:4:"code";s:14:"binance_zrxeth";s:4:"birg";s:7:"binance";}i:2649;a:4:{s:5:"title";s:9:"STR-ATBTC";s:6:"course";s:9:"0.0002625";s:4:"code";s:16:"binance_stratbtc";s:4:"birg";s:7:"binance";}i:2650;a:4:{s:5:"title";s:9:"STR-ATETH";s:6:"course";s:8:"0.008365";s:4:"code";s:16:"binance_strateth";s:4:"birg";s:7:"binance";}i:2651;a:4:{s:5:"title";s:9:"SNG-LSBTC";s:6:"course";s:8:"0.000004";s:4:"code";s:16:"binance_snglsbtc";s:4:"birg";s:7:"binance";}i:2652;a:4:{s:5:"title";s:9:"SNG-LSETH";s:6:"course";s:8:"0.000127";s:4:"code";s:16:"binance_snglseth";s:4:"birg";s:7:"binance";}i:2653;a:4:{s:5:"title";s:7:"BQX-BTC";s:6:"course";s:10:"0.00005786";s:4:"code";s:14:"binance_bqxbtc";s:4:"birg";s:7:"binance";}i:2654;a:4:{s:5:"title";s:7:"BQX-ETH";s:6:"course";s:9:"0.0018403";s:4:"code";s:14:"binance_bqxeth";s:4:"birg";s:7:"binance";}i:2655;a:4:{s:5:"title";s:7:"KNC-BTC";s:6:"course";s:10:"0.00007219";s:4:"code";s:14:"binance_kncbtc";s:4:"birg";s:7:"binance";}i:2656;a:4:{s:5:"title";s:7:"KNC-ETH";s:6:"course";s:9:"0.0022948";s:4:"code";s:14:"binance_knceth";s:4:"birg";s:7:"binance";}i:2657;a:4:{s:5:"title";s:7:"FUN-BTC";s:6:"course";s:10:"0.00000211";s:4:"code";s:14:"binance_funbtc";s:4:"birg";s:7:"binance";}i:2658;a:4:{s:5:"title";s:7:"FUN-ETH";s:6:"course";s:10:"0.00006729";s:4:"code";s:14:"binance_funeth";s:4:"birg";s:7:"binance";}i:2659;a:4:{s:5:"title";s:7:"SNM-BTC";s:6:"course";s:10:"0.00000891";s:4:"code";s:14:"binance_snmbtc";s:4:"birg";s:7:"binance";}i:2660;a:4:{s:5:"title";s:7:"SNM-ETH";s:6:"course";s:10:"0.00028354";s:4:"code";s:14:"binance_snmeth";s:4:"birg";s:7:"binance";}i:2661;a:4:{s:5:"title";s:7:"NEO-ETH";s:6:"course";s:8:"0.079223";s:4:"code";s:14:"binance_neoeth";s:4:"birg";s:7:"binance";}i:2662;a:4:{s:5:"title";s:8:"IOT-ABTC";s:6:"course";s:10:"0.00007549";s:4:"code";s:15:"binance_iotabtc";s:4:"birg";s:7:"binance";}i:2663;a:4:{s:5:"title";s:8:"IOT-AETH";s:6:"course";s:10:"0.00240641";s:4:"code";s:15:"binance_iotaeth";s:4:"birg";s:7:"binance";}i:2664;a:4:{s:5:"title";s:8:"LIN-KBTC";s:6:"course";s:10:"0.00006888";s:4:"code";s:15:"binance_linkbtc";s:4:"birg";s:7:"binance";}i:2665;a:4:{s:5:"title";s:8:"LIN-KETH";s:6:"course";s:9:"0.0022007";s:4:"code";s:15:"binance_linketh";s:4:"birg";s:7:"binance";}i:2666;a:4:{s:5:"title";s:7:"XVG-BTC";s:6:"course";s:10:"0.00000228";s:4:"code";s:14:"binance_xvgbtc";s:4:"birg";s:7:"binance";}i:2667;a:4:{s:5:"title";s:7:"XVG-ETH";s:6:"course";s:10:"0.00007288";s:4:"code";s:14:"binance_xvgeth";s:4:"birg";s:7:"binance";}i:2668;a:4:{s:5:"title";s:8:"SAL-TBTC";s:6:"course";s:8:"0.000104";s:4:"code";s:15:"binance_saltbtc";s:4:"birg";s:7:"binance";}i:2669;a:4:{s:5:"title";s:8:"SAL-TETH";s:6:"course";s:8:"0.003317";s:4:"code";s:15:"binance_salteth";s:4:"birg";s:7:"binance";}i:2670;a:4:{s:5:"title";s:7:"MDA-BTC";s:6:"course";s:9:"0.0002403";s:4:"code";s:14:"binance_mdabtc";s:4:"birg";s:7:"binance";}i:2671;a:4:{s:5:"title";s:7:"MDA-ETH";s:6:"course";s:9:"0.0076862";s:4:"code";s:14:"binance_mdaeth";s:4:"birg";s:7:"binance";}i:2672;a:4:{s:5:"title";s:7:"MTL-BTC";s:6:"course";s:9:"0.0001067";s:4:"code";s:14:"binance_mtlbtc";s:4:"birg";s:7:"binance";}i:2673;a:4:{s:5:"title";s:7:"MTL-ETH";s:6:"course";s:8:"0.003395";s:4:"code";s:14:"binance_mtleth";s:4:"birg";s:7:"binance";}i:2674;a:4:{s:5:"title";s:7:"SUB-BTC";s:6:"course";s:10:"0.00001671";s:4:"code";s:14:"binance_subbtc";s:4:"birg";s:7:"binance";}i:2675;a:4:{s:5:"title";s:7:"SUB-ETH";s:6:"course";s:10:"0.00053375";s:4:"code";s:14:"binance_subeth";s:4:"birg";s:7:"binance";}i:2676;a:4:{s:5:"title";s:7:"EOS-BTC";s:6:"course";s:9:"0.0008346";s:4:"code";s:14:"binance_eosbtc";s:4:"birg";s:7:"binance";}i:2677;a:4:{s:5:"title";s:7:"SNT-BTC";s:6:"course";s:10:"0.00000559";s:4:"code";s:14:"binance_sntbtc";s:4:"birg";s:7:"binance";}i:2678;a:4:{s:5:"title";s:7:"ETC-ETH";s:6:"course";s:8:"0.047412";s:4:"code";s:14:"binance_etceth";s:4:"birg";s:7:"binance";}i:2679;a:4:{s:5:"title";s:7:"ETC-BTC";s:6:"course";s:8:"0.001489";s:4:"code";s:14:"binance_etcbtc";s:4:"birg";s:7:"binance";}i:2680;a:4:{s:5:"title";s:7:"MTH-BTC";s:6:"course";s:10:"0.00000544";s:4:"code";s:14:"binance_mthbtc";s:4:"birg";s:7:"binance";}i:2681;a:4:{s:5:"title";s:7:"MTH-ETH";s:6:"course";s:10:"0.00017301";s:4:"code";s:14:"binance_mtheth";s:4:"birg";s:7:"binance";}i:2682;a:4:{s:5:"title";s:7:"ENG-BTC";s:6:"course";s:8:"0.000103";s:4:"code";s:14:"binance_engbtc";s:4:"birg";s:7:"binance";}i:2683;a:4:{s:5:"title";s:7:"ENG-ETH";s:6:"course";s:9:"0.0033041";s:4:"code";s:14:"binance_engeth";s:4:"birg";s:7:"binance";}i:2684;a:4:{s:5:"title";s:7:"DNT-BTC";s:6:"course";s:10:"0.00000391";s:4:"code";s:14:"binance_dntbtc";s:4:"birg";s:7:"binance";}i:2685;a:4:{s:5:"title";s:7:"ZEC-BTC";s:6:"course";s:8:"0.018643";s:4:"code";s:14:"binance_zecbtc";s:4:"birg";s:7:"binance";}i:2686;a:4:{s:5:"title";s:7:"ZEC-ETH";s:6:"course";s:7:"0.59438";s:4:"code";s:14:"binance_zeceth";s:4:"birg";s:7:"binance";}i:2687;a:4:{s:5:"title";s:7:"BNT-BTC";s:6:"course";s:10:"0.00019993";s:4:"code";s:14:"binance_bntbtc";s:4:"birg";s:7:"binance";}i:2688;a:4:{s:5:"title";s:7:"AST-BTC";s:6:"course";s:10:"0.00001294";s:4:"code";s:14:"binance_astbtc";s:4:"birg";s:7:"binance";}i:2689;a:4:{s:5:"title";s:7:"AST-ETH";s:6:"course";s:9:"0.0004122";s:4:"code";s:14:"binance_asteth";s:4:"birg";s:7:"binance";}i:2690;a:4:{s:5:"title";s:8:"DAS-HBTC";s:6:"course";s:8:"0.023927";s:4:"code";s:15:"binance_dashbtc";s:4:"birg";s:7:"binance";}i:2691;a:4:{s:5:"title";s:8:"DAS-HETH";s:6:"course";s:7:"0.76578";s:4:"code";s:15:"binance_dasheth";s:4:"birg";s:7:"binance";}i:2692;a:4:{s:5:"title";s:7:"OAX-BTC";s:6:"course";s:10:"0.00003944";s:4:"code";s:14:"binance_oaxbtc";s:4:"birg";s:7:"binance";}i:2693;a:4:{s:5:"title";s:7:"BTG-BTC";s:6:"course";s:8:"0.004153";s:4:"code";s:14:"binance_btgbtc";s:4:"birg";s:7:"binance";}i:2694;a:4:{s:5:"title";s:7:"BTG-ETH";s:6:"course";s:8:"0.132107";s:4:"code";s:14:"binance_btgeth";s:4:"birg";s:7:"binance";}i:2695;a:4:{s:5:"title";s:7:"EVX-BTC";s:6:"course";s:10:"0.00008363";s:4:"code";s:14:"binance_evxbtc";s:4:"birg";s:7:"binance";}i:2696;a:4:{s:5:"title";s:7:"EVX-ETH";s:6:"course";s:9:"0.0026666";s:4:"code";s:14:"binance_evxeth";s:4:"birg";s:7:"binance";}i:2697;a:4:{s:5:"title";s:7:"REQ-BTC";s:6:"course";s:10:"0.00000771";s:4:"code";s:14:"binance_reqbtc";s:4:"birg";s:7:"binance";}i:2698;a:4:{s:5:"title";s:7:"REQ-ETH";s:6:"course";s:9:"0.0002456";s:4:"code";s:14:"binance_reqeth";s:4:"birg";s:7:"binance";}i:2699;a:4:{s:5:"title";s:7:"VIB-BTC";s:6:"course";s:10:"0.00000733";s:4:"code";s:14:"binance_vibbtc";s:4:"birg";s:7:"binance";}i:2700;a:4:{s:5:"title";s:7:"VIB-ETH";s:6:"course";s:10:"0.00023335";s:4:"code";s:14:"binance_vibeth";s:4:"birg";s:7:"binance";}i:2701;a:4:{s:5:"title";s:7:"TRX-BTC";s:6:"course";s:10:"0.00000362";s:4:"code";s:14:"binance_trxbtc";s:4:"birg";s:7:"binance";}i:2702;a:4:{s:5:"title";s:7:"TRX-ETH";s:6:"course";s:10:"0.00011521";s:4:"code";s:14:"binance_trxeth";s:4:"birg";s:7:"binance";}i:2703;a:4:{s:5:"title";s:8:"POW-RBTC";s:6:"course";s:10:"0.00002541";s:4:"code";s:15:"binance_powrbtc";s:4:"birg";s:7:"binance";}i:2704;a:4:{s:5:"title";s:8:"POW-RETH";s:6:"course";s:10:"0.00080609";s:4:"code";s:15:"binance_powreth";s:4:"birg";s:7:"binance";}i:2705;a:4:{s:5:"title";s:7:"ARK-BTC";s:6:"course";s:9:"0.0001225";s:4:"code";s:14:"binance_arkbtc";s:4:"birg";s:7:"binance";}i:2706;a:4:{s:5:"title";s:7:"ARK-ETH";s:6:"course";s:8:"0.003911";s:4:"code";s:14:"binance_arketh";s:4:"birg";s:7:"binance";}i:2707;a:4:{s:5:"title";s:8:"YOY-OETH";s:6:"course";s:10:"0.00016281";s:4:"code";s:15:"binance_yoyoeth";s:4:"birg";s:7:"binance";}i:2708;a:4:{s:5:"title";s:7:"XRP-BTC";s:6:"course";s:10:"0.00007075";s:4:"code";s:14:"binance_xrpbtc";s:4:"birg";s:7:"binance";}i:2709;a:4:{s:5:"title";s:7:"XRP-ETH";s:6:"course";s:8:"0.002254";s:4:"code";s:14:"binance_xrpeth";s:4:"birg";s:7:"binance";}i:2710;a:4:{s:5:"title";s:7:"MOD-BTC";s:6:"course";s:9:"0.0001318";s:4:"code";s:14:"binance_modbtc";s:4:"birg";s:7:"binance";}i:2711;a:4:{s:5:"title";s:7:"MOD-ETH";s:6:"course";s:8:"0.004203";s:4:"code";s:14:"binance_modeth";s:4:"birg";s:7:"binance";}i:2712;a:4:{s:5:"title";s:7:"ENJ-BTC";s:6:"course";s:10:"0.00000777";s:4:"code";s:14:"binance_enjbtc";s:4:"birg";s:7:"binance";}i:2713;a:4:{s:5:"title";s:7:"ENJ-ETH";s:6:"course";s:10:"0.00024706";s:4:"code";s:14:"binance_enjeth";s:4:"birg";s:7:"binance";}i:2714;a:4:{s:5:"title";s:9:"STO-RJBTC";s:6:"course";s:10:"0.00005125";s:4:"code";s:16:"binance_storjbtc";s:4:"birg";s:7:"binance";}i:2715;a:4:{s:5:"title";s:9:"STO-RJETH";s:6:"course";s:8:"0.001644";s:4:"code";s:16:"binance_storjeth";s:4:"birg";s:7:"binance";}i:2716;a:4:{s:5:"title";s:8:"BNB-USDT";s:6:"course";s:6:"9.7272";s:4:"code";s:15:"binance_bnbusdt";s:4:"birg";s:7:"binance";}i:2717;a:4:{s:5:"title";s:8:"YOY-OBNB";s:6:"course";s:8:"0.003403";s:4:"code";s:15:"binance_yoyobnb";s:4:"birg";s:7:"binance";}i:2718;a:4:{s:5:"title";s:8:"POW-RBNB";s:6:"course";s:7:"0.01694";s:4:"code";s:15:"binance_powrbnb";s:4:"birg";s:7:"binance";}i:2719;a:4:{s:5:"title";s:7:"KMD-BTC";s:6:"course";s:8:"0.000216";s:4:"code";s:14:"binance_kmdbtc";s:4:"birg";s:7:"binance";}i:2720;a:4:{s:5:"title";s:7:"KMD-ETH";s:6:"course";s:8:"0.006875";s:4:"code";s:14:"binance_kmdeth";s:4:"birg";s:7:"binance";}i:2721;a:4:{s:5:"title";s:8:"NUL-SBNB";s:6:"course";s:7:"0.11473";s:4:"code";s:15:"binance_nulsbnb";s:4:"birg";s:7:"binance";}i:2722;a:4:{s:5:"title";s:7:"RCN-BTC";s:6:"course";s:10:"0.00000425";s:4:"code";s:14:"binance_rcnbtc";s:4:"birg";s:7:"binance";}i:2723;a:4:{s:5:"title";s:7:"RCN-ETH";s:6:"course";s:10:"0.00013553";s:4:"code";s:14:"binance_rcneth";s:4:"birg";s:7:"binance";}i:2724;a:4:{s:5:"title";s:7:"RCN-BNB";s:6:"course";s:8:"0.002873";s:4:"code";s:14:"binance_rcnbnb";s:4:"birg";s:7:"binance";}i:2725;a:4:{s:5:"title";s:8:"NUL-SBTC";s:6:"course";s:9:"0.0001712";s:4:"code";s:15:"binance_nulsbtc";s:4:"birg";s:7:"binance";}i:2726;a:4:{s:5:"title";s:8:"NUL-SETH";s:6:"course";s:10:"0.00546345";s:4:"code";s:15:"binance_nulseth";s:4:"birg";s:7:"binance";}i:2727;a:4:{s:5:"title";s:7:"RDN-BTC";s:6:"course";s:10:"0.00008762";s:4:"code";s:14:"binance_rdnbtc";s:4:"birg";s:7:"binance";}i:2728;a:4:{s:5:"title";s:7:"RDN-ETH";s:6:"course";s:8:"0.002796";s:4:"code";s:14:"binance_rdneth";s:4:"birg";s:7:"binance";}i:2729;a:4:{s:5:"title";s:7:"RDN-BNB";s:6:"course";s:7:"0.05914";s:4:"code";s:14:"binance_rdnbnb";s:4:"birg";s:7:"binance";}i:2730;a:4:{s:5:"title";s:7:"XMR-BTC";s:6:"course";s:8:"0.016167";s:4:"code";s:14:"binance_xmrbtc";s:4:"birg";s:7:"binance";}i:2731;a:4:{s:5:"title";s:7:"XMR-ETH";s:6:"course";s:7:"0.51657";s:4:"code";s:14:"binance_xmreth";s:4:"birg";s:7:"binance";}i:2732;a:4:{s:5:"title";s:7:"DLT-BNB";s:6:"course";s:7:"0.00944";s:4:"code";s:14:"binance_dltbnb";s:4:"birg";s:7:"binance";}i:2733;a:4:{s:5:"title";s:7:"WTC-BNB";s:6:"course";s:5:"0.318";s:4:"code";s:14:"binance_wtcbnb";s:4:"birg";s:7:"binance";}i:2734;a:4:{s:5:"title";s:7:"DLT-BTC";s:6:"course";s:9:"0.0000141";s:4:"code";s:14:"binance_dltbtc";s:4:"birg";s:7:"binance";}i:2735;a:4:{s:5:"title";s:7:"DLT-ETH";s:6:"course";s:10:"0.00044765";s:4:"code";s:14:"binance_dlteth";s:4:"birg";s:7:"binance";}i:2736;a:4:{s:5:"title";s:7:"AMB-BTC";s:6:"course";s:10:"0.00002983";s:4:"code";s:14:"binance_ambbtc";s:4:"birg";s:7:"binance";}i:2737;a:4:{s:5:"title";s:7:"AMB-ETH";s:6:"course";s:10:"0.00095068";s:4:"code";s:14:"binance_ambeth";s:4:"birg";s:7:"binance";}i:2738;a:4:{s:5:"title";s:7:"AMB-BNB";s:6:"course";s:7:"0.01993";s:4:"code";s:14:"binance_ambbnb";s:4:"birg";s:7:"binance";}i:2739;a:4:{s:5:"title";s:7:"BCC-ETH";s:6:"course";s:7:"2.16219";s:4:"code";s:14:"binance_bcceth";s:4:"birg";s:7:"binance";}i:2740;a:4:{s:5:"title";s:8:"BCC-USDT";s:6:"course";s:6:"440.09";s:4:"code";s:15:"binance_bccusdt";s:4:"birg";s:7:"binance";}i:2741;a:4:{s:5:"title";s:7:"BCC-BNB";s:6:"course";s:5:"45.17";s:4:"code";s:14:"binance_bccbnb";s:4:"birg";s:7:"binance";}i:2742;a:4:{s:5:"title";s:7:"BAT-BTC";s:6:"course";s:9:"0.0000391";s:4:"code";s:14:"binance_batbtc";s:4:"birg";s:7:"binance";}i:2743;a:4:{s:5:"title";s:7:"BAT-ETH";s:6:"course";s:9:"0.0012462";s:4:"code";s:14:"binance_bateth";s:4:"birg";s:7:"binance";}i:2744;a:4:{s:5:"title";s:7:"BAT-BNB";s:6:"course";s:7:"0.02618";s:4:"code";s:14:"binance_batbnb";s:4:"birg";s:7:"binance";}i:2745;a:4:{s:5:"title";s:8:"BCP-TBTC";s:6:"course";s:10:"0.00001666";s:4:"code";s:15:"binance_bcptbtc";s:4:"birg";s:7:"binance";}i:2746;a:4:{s:5:"title";s:8:"BCP-TETH";s:6:"course";s:10:"0.00053183";s:4:"code";s:15:"binance_bcpteth";s:4:"birg";s:7:"binance";}i:2747;a:4:{s:5:"title";s:8:"BCP-TBNB";s:6:"course";s:7:"0.01108";s:4:"code";s:15:"binance_bcptbnb";s:4:"birg";s:7:"binance";}i:2748;a:4:{s:5:"title";s:7:"ARN-BTC";s:6:"course";s:9:"0.0001333";s:4:"code";s:14:"binance_arnbtc";s:4:"birg";s:7:"binance";}i:2749;a:4:{s:5:"title";s:7:"ARN-ETH";s:6:"course";s:10:"0.00427136";s:4:"code";s:14:"binance_arneth";s:4:"birg";s:7:"binance";}i:2750;a:4:{s:5:"title";s:7:"GVT-BTC";s:6:"course";s:9:"0.0019731";s:4:"code";s:14:"binance_gvtbtc";s:4:"birg";s:7:"binance";}i:2751;a:4:{s:5:"title";s:7:"GVT-ETH";s:6:"course";s:8:"0.062843";s:4:"code";s:14:"binance_gvteth";s:4:"birg";s:7:"binance";}i:2752;a:4:{s:5:"title";s:7:"CDT-BTC";s:6:"course";s:10:"0.00000273";s:4:"code";s:14:"binance_cdtbtc";s:4:"birg";s:7:"binance";}i:2753;a:4:{s:5:"title";s:7:"CDT-ETH";s:6:"course";s:10:"0.00008736";s:4:"code";s:14:"binance_cdteth";s:4:"birg";s:7:"binance";}i:2754;a:4:{s:5:"title";s:7:"GXS-BTC";s:6:"course";s:9:"0.0002072";s:4:"code";s:14:"binance_gxsbtc";s:4:"birg";s:7:"binance";}i:2755;a:4:{s:5:"title";s:7:"GXS-ETH";s:6:"course";s:8:"0.006586";s:4:"code";s:14:"binance_gxseth";s:4:"birg";s:7:"binance";}i:2756;a:4:{s:5:"title";s:8:"NEO-USDT";s:6:"course";s:5:"16.15";s:4:"code";s:15:"binance_neousdt";s:4:"birg";s:7:"binance";}i:2757;a:4:{s:5:"title";s:7:"NEO-BNB";s:6:"course";s:5:"1.661";s:4:"code";s:14:"binance_neobnb";s:4:"birg";s:7:"binance";}i:2758;a:4:{s:5:"title";s:7:"POE-BTC";s:6:"course";s:10:"0.00000175";s:4:"code";s:14:"binance_poebtc";s:4:"birg";s:7:"binance";}i:2759;a:4:{s:5:"title";s:7:"POE-ETH";s:6:"course";s:10:"0.00005617";s:4:"code";s:14:"binance_poeeth";s:4:"birg";s:7:"binance";}i:2760;a:4:{s:5:"title";s:7:"QSP-BTC";s:6:"course";s:10:"0.00000639";s:4:"code";s:14:"binance_qspbtc";s:4:"birg";s:7:"binance";}i:2761;a:4:{s:5:"title";s:7:"QSP-ETH";s:6:"course";s:10:"0.00020364";s:4:"code";s:14:"binance_qspeth";s:4:"birg";s:7:"binance";}i:2762;a:4:{s:5:"title";s:7:"QSP-BNB";s:6:"course";s:7:"0.00431";s:4:"code";s:14:"binance_qspbnb";s:4:"birg";s:7:"binance";}i:2763;a:4:{s:5:"title";s:7:"BTS-BTC";s:6:"course";s:10:"0.00001494";s:4:"code";s:14:"binance_btsbtc";s:4:"birg";s:7:"binance";}i:2764;a:4:{s:5:"title";s:7:"BTS-ETH";s:6:"course";s:9:"0.0004769";s:4:"code";s:14:"binance_btseth";s:4:"birg";s:7:"binance";}i:2765;a:4:{s:5:"title";s:7:"BTS-BNB";s:6:"course";s:7:"0.00997";s:4:"code";s:14:"binance_btsbnb";s:4:"birg";s:7:"binance";}i:2766;a:4:{s:5:"title";s:7:"XZC-BTC";s:6:"course";s:8:"0.001655";s:4:"code";s:14:"binance_xzcbtc";s:4:"birg";s:7:"binance";}i:2767;a:4:{s:5:"title";s:7:"XZC-ETH";s:6:"course";s:8:"0.052466";s:4:"code";s:14:"binance_xzceth";s:4:"birg";s:7:"binance";}i:2768;a:4:{s:5:"title";s:7:"XZC-BNB";s:6:"course";s:5:"1.099";s:4:"code";s:14:"binance_xzcbnb";s:4:"birg";s:7:"binance";}i:2769;a:4:{s:5:"title";s:7:"LSK-BTC";s:6:"course";s:9:"0.0004382";s:4:"code";s:14:"binance_lskbtc";s:4:"birg";s:7:"binance";}i:2770;a:4:{s:5:"title";s:7:"LSK-ETH";s:6:"course";s:8:"0.013952";s:4:"code";s:14:"binance_lsketh";s:4:"birg";s:7:"binance";}i:2771;a:4:{s:5:"title";s:7:"LSK-BNB";s:6:"course";s:6:"0.2921";s:4:"code";s:14:"binance_lskbnb";s:4:"birg";s:7:"binance";}i:2772;a:4:{s:5:"title";s:7:"TNT-BTC";s:6:"course";s:10:"0.00000513";s:4:"code";s:14:"binance_tntbtc";s:4:"birg";s:7:"binance";}i:2773;a:4:{s:5:"title";s:7:"TNT-ETH";s:6:"course";s:10:"0.00016457";s:4:"code";s:14:"binance_tnteth";s:4:"birg";s:7:"binance";}i:2774;a:4:{s:5:"title";s:8:"FUE-LBTC";s:6:"course";s:10:"0.00000305";s:4:"code";s:15:"binance_fuelbtc";s:4:"birg";s:7:"binance";}i:2775;a:4:{s:5:"title";s:8:"FUE-LETH";s:6:"course";s:10:"0.00009784";s:4:"code";s:15:"binance_fueleth";s:4:"birg";s:7:"binance";}i:2776;a:4:{s:5:"title";s:8:"MAN-ABTC";s:6:"course";s:10:"0.00001169";s:4:"code";s:15:"binance_manabtc";s:4:"birg";s:7:"binance";}i:2777;a:4:{s:5:"title";s:8:"MAN-AETH";s:6:"course";s:10:"0.00037235";s:4:"code";s:15:"binance_manaeth";s:4:"birg";s:7:"binance";}i:2778;a:4:{s:5:"title";s:7:"BCD-BTC";s:6:"course";s:8:"0.000283";s:4:"code";s:14:"binance_bcdbtc";s:4:"birg";s:7:"binance";}i:2779;a:4:{s:5:"title";s:7:"BCD-ETH";s:6:"course";s:7:"0.00898";s:4:"code";s:14:"binance_bcdeth";s:4:"birg";s:7:"binance";}i:2780;a:4:{s:5:"title";s:7:"DGD-BTC";s:6:"course";s:8:"0.006151";s:4:"code";s:14:"binance_dgdbtc";s:4:"birg";s:7:"binance";}i:2781;a:4:{s:5:"title";s:7:"DGD-ETH";s:6:"course";s:7:"0.19589";s:4:"code";s:14:"binance_dgdeth";s:4:"birg";s:7:"binance";}i:2782;a:4:{s:5:"title";s:8:"IOT-ABNB";s:6:"course";s:7:"0.05042";s:4:"code";s:15:"binance_iotabnb";s:4:"birg";s:7:"binance";}i:2783;a:4:{s:5:"title";s:7:"ADX-BTC";s:6:"course";s:10:"0.00003554";s:4:"code";s:14:"binance_adxbtc";s:4:"birg";s:7:"binance";}i:2784;a:4:{s:5:"title";s:7:"ADX-ETH";s:6:"course";s:9:"0.0011335";s:4:"code";s:14:"binance_adxeth";s:4:"birg";s:7:"binance";}i:2785;a:4:{s:5:"title";s:7:"ADX-BNB";s:6:"course";s:6:"0.0237";s:4:"code";s:14:"binance_adxbnb";s:4:"birg";s:7:"binance";}i:2786;a:4:{s:5:"title";s:7:"ADA-BTC";s:6:"course";s:10:"0.00001132";s:4:"code";s:14:"binance_adabtc";s:4:"birg";s:7:"binance";}i:2787;a:4:{s:5:"title";s:7:"ADA-ETH";s:6:"course";s:10:"0.00036109";s:4:"code";s:14:"binance_adaeth";s:4:"birg";s:7:"binance";}i:2788;a:4:{s:5:"title";s:7:"PPT-BTC";s:6:"course";s:8:"0.000536";s:4:"code";s:14:"binance_pptbtc";s:4:"birg";s:7:"binance";}i:2789;a:4:{s:5:"title";s:7:"PPT-ETH";s:6:"course";s:8:"0.017113";s:4:"code";s:14:"binance_ppteth";s:4:"birg";s:7:"binance";}i:2790;a:4:{s:5:"title";s:7:"CMT-BTC";s:6:"course";s:8:"0.000015";s:4:"code";s:14:"binance_cmtbtc";s:4:"birg";s:7:"binance";}i:2791;a:4:{s:5:"title";s:7:"CMT-ETH";s:6:"course";s:10:"0.00047918";s:4:"code";s:14:"binance_cmteth";s:4:"birg";s:7:"binance";}i:2792;a:4:{s:5:"title";s:7:"CMT-BNB";s:6:"course";s:7:"0.01008";s:4:"code";s:14:"binance_cmtbnb";s:4:"birg";s:7:"binance";}i:2793;a:4:{s:5:"title";s:7:"XLM-BTC";s:6:"course";s:9:"0.0000359";s:4:"code";s:14:"binance_xlmbtc";s:4:"birg";s:7:"binance";}i:2794;a:4:{s:5:"title";s:7:"XLM-ETH";s:6:"course";s:10:"0.00114482";s:4:"code";s:14:"binance_xlmeth";s:4:"birg";s:7:"binance";}i:2795;a:4:{s:5:"title";s:7:"XLM-BNB";s:6:"course";s:7:"0.02393";s:4:"code";s:14:"binance_xlmbnb";s:4:"birg";s:7:"binance";}i:2796;a:4:{s:5:"title";s:7:"CND-BTC";s:6:"course";s:10:"0.00000355";s:4:"code";s:14:"binance_cndbtc";s:4:"birg";s:7:"binance";}i:2797;a:4:{s:5:"title";s:7:"CND-ETH";s:6:"course";s:10:"0.00011358";s:4:"code";s:14:"binance_cndeth";s:4:"birg";s:7:"binance";}i:2798;a:4:{s:5:"title";s:7:"CND-BNB";s:6:"course";s:8:"0.002368";s:4:"code";s:14:"binance_cndbnb";s:4:"birg";s:7:"binance";}i:2799;a:4:{s:5:"title";s:8:"LEN-DBTC";s:6:"course";s:10:"0.00000312";s:4:"code";s:15:"binance_lendbtc";s:4:"birg";s:7:"binance";}i:2800;a:4:{s:5:"title";s:8:"LEN-DETH";s:6:"course";s:10:"0.00009974";s:4:"code";s:15:"binance_lendeth";s:4:"birg";s:7:"binance";}i:2801;a:4:{s:5:"title";s:8:"WAB-IBTC";s:6:"course";s:10:"0.00003854";s:4:"code";s:15:"binance_wabibtc";s:4:"birg";s:7:"binance";}i:2802;a:4:{s:5:"title";s:8:"WAB-IETH";s:6:"course";s:9:"0.0012245";s:4:"code";s:15:"binance_wabieth";s:4:"birg";s:7:"binance";}i:2803;a:4:{s:5:"title";s:8:"WAB-IBNB";s:6:"course";s:7:"0.02588";s:4:"code";s:15:"binance_wabibnb";s:4:"birg";s:7:"binance";}i:2804;a:4:{s:5:"title";s:7:"LTC-ETH";s:6:"course";s:7:"0.25561";s:4:"code";s:14:"binance_ltceth";s:4:"birg";s:7:"binance";}i:2805;a:4:{s:5:"title";s:8:"LTC-USDT";s:6:"course";s:5:"52.09";s:4:"code";s:15:"binance_ltcusdt";s:4:"birg";s:7:"binance";}i:2806;a:4:{s:5:"title";s:7:"LTC-BNB";s:6:"course";s:4:"5.36";s:4:"code";s:14:"binance_ltcbnb";s:4:"birg";s:7:"binance";}i:2807;a:4:{s:5:"title";s:7:"TNB-BTC";s:6:"course";s:10:"0.00000155";s:4:"code";s:14:"binance_tnbbtc";s:4:"birg";s:7:"binance";}i:2808;a:4:{s:5:"title";s:7:"TNB-ETH";s:6:"course";s:10:"0.00004904";s:4:"code";s:14:"binance_tnbeth";s:4:"birg";s:7:"binance";}i:2809;a:4:{s:5:"title";s:9:"WAV-ESBTC";s:6:"course";s:9:"0.0002962";s:4:"code";s:16:"binance_wavesbtc";s:4:"birg";s:7:"binance";}i:2810;a:4:{s:5:"title";s:9:"WAV-ESETH";s:6:"course";s:8:"0.009412";s:4:"code";s:16:"binance_waveseth";s:4:"birg";s:7:"binance";}i:2811;a:4:{s:5:"title";s:9:"WAV-ESBNB";s:6:"course";s:6:"0.1988";s:4:"code";s:16:"binance_wavesbnb";s:4:"birg";s:7:"binance";}i:2812;a:4:{s:5:"title";s:7:"GTO-BTC";s:6:"course";s:10:"0.00001087";s:4:"code";s:14:"binance_gtobtc";s:4:"birg";s:7:"binance";}i:2813;a:4:{s:5:"title";s:7:"GTO-ETH";s:6:"course";s:10:"0.00034656";s:4:"code";s:14:"binance_gtoeth";s:4:"birg";s:7:"binance";}i:2814;a:4:{s:5:"title";s:7:"GTO-BNB";s:6:"course";s:7:"0.00726";s:4:"code";s:14:"binance_gtobnb";s:4:"birg";s:7:"binance";}i:2815;a:4:{s:5:"title";s:7:"ICX-BTC";s:6:"course";s:9:"0.0001011";s:4:"code";s:14:"binance_icxbtc";s:4:"birg";s:7:"binance";}i:2816;a:4:{s:5:"title";s:7:"ICX-ETH";s:6:"course";s:8:"0.003229";s:4:"code";s:14:"binance_icxeth";s:4:"birg";s:7:"binance";}i:2817;a:4:{s:5:"title";s:7:"ICX-BNB";s:6:"course";s:7:"0.06766";s:4:"code";s:14:"binance_icxbnb";s:4:"birg";s:7:"binance";}i:2818;a:4:{s:5:"title";s:7:"OST-BTC";s:6:"course";s:10:"0.00000716";s:4:"code";s:14:"binance_ostbtc";s:4:"birg";s:7:"binance";}i:2819;a:4:{s:5:"title";s:7:"OST-ETH";s:6:"course";s:10:"0.00022769";s:4:"code";s:14:"binance_osteth";s:4:"birg";s:7:"binance";}i:2820;a:4:{s:5:"title";s:7:"OST-BNB";s:6:"course";s:8:"0.004821";s:4:"code";s:14:"binance_ostbnb";s:4:"birg";s:7:"binance";}i:2821;a:4:{s:5:"title";s:7:"ELF-BTC";s:6:"course";s:10:"0.00005207";s:4:"code";s:14:"binance_elfbtc";s:4:"birg";s:7:"binance";}i:2822;a:4:{s:5:"title";s:7:"ELF-ETH";s:6:"course";s:10:"0.00165771";s:4:"code";s:14:"binance_elfeth";s:4:"birg";s:7:"binance";}i:2823;a:4:{s:5:"title";s:8:"AIO-NBTC";s:6:"course";s:9:"0.0000663";s:4:"code";s:15:"binance_aionbtc";s:4:"birg";s:7:"binance";}i:2824;a:4:{s:5:"title";s:8:"AIO-NETH";s:6:"course";s:7:"0.00211";s:4:"code";s:15:"binance_aioneth";s:4:"birg";s:7:"binance";}i:2825;a:4:{s:5:"title";s:8:"AIO-NBNB";s:6:"course";s:7:"0.04415";s:4:"code";s:15:"binance_aionbnb";s:4:"birg";s:7:"binance";}i:2826;a:4:{s:5:"title";s:8:"NEB-LBTC";s:6:"course";s:9:"0.0003956";s:4:"code";s:15:"binance_neblbtc";s:4:"birg";s:7:"binance";}i:2827;a:4:{s:5:"title";s:8:"NEB-LETH";s:6:"course";s:8:"0.012575";s:4:"code";s:15:"binance_nebleth";s:4:"birg";s:7:"binance";}i:2828;a:4:{s:5:"title";s:8:"NEB-LBNB";s:6:"course";s:7:"0.26335";s:4:"code";s:15:"binance_neblbnb";s:4:"birg";s:7:"binance";}i:2829;a:4:{s:5:"title";s:7:"BRD-BTC";s:6:"course";s:10:"0.00005807";s:4:"code";s:14:"binance_brdbtc";s:4:"birg";s:7:"binance";}i:2830;a:4:{s:5:"title";s:7:"BRD-ETH";s:6:"course";s:9:"0.0018503";s:4:"code";s:14:"binance_brdeth";s:4:"birg";s:7:"binance";}i:2831;a:4:{s:5:"title";s:7:"BRD-BNB";s:6:"course";s:7:"0.03905";s:4:"code";s:14:"binance_brdbnb";s:4:"birg";s:7:"binance";}i:2832;a:4:{s:5:"title";s:7:"MCO-BNB";s:6:"course";s:7:"0.49204";s:4:"code";s:14:"binance_mcobnb";s:4:"birg";s:7:"binance";}i:2833;a:4:{s:5:"title";s:7:"EDO-BTC";s:6:"course";s:9:"0.0001938";s:4:"code";s:14:"binance_edobtc";s:4:"birg";s:7:"binance";}i:2834;a:4:{s:5:"title";s:7:"EDO-ETH";s:6:"course";s:7:"0.00621";s:4:"code";s:14:"binance_edoeth";s:4:"birg";s:7:"binance";}i:2835;a:4:{s:5:"title";s:9:"WIN-GSBTC";s:6:"course";s:10:"0.00002572";s:4:"code";s:16:"binance_wingsbtc";s:4:"birg";s:7:"binance";}i:2836;a:4:{s:5:"title";s:9:"WIN-GSETH";s:6:"course";s:9:"0.0008194";s:4:"code";s:16:"binance_wingseth";s:4:"birg";s:7:"binance";}i:2837;a:4:{s:5:"title";s:7:"NAV-BTC";s:6:"course";s:8:"0.000055";s:4:"code";s:14:"binance_navbtc";s:4:"birg";s:7:"binance";}i:2838;a:4:{s:5:"title";s:7:"NAV-ETH";s:6:"course";s:8:"0.001756";s:4:"code";s:14:"binance_naveth";s:4:"birg";s:7:"binance";}i:2839;a:4:{s:5:"title";s:7:"NAV-BNB";s:6:"course";s:7:"0.03704";s:4:"code";s:14:"binance_navbnb";s:4:"birg";s:7:"binance";}i:2840;a:4:{s:5:"title";s:7:"LUN-BTC";s:6:"course";s:8:"0.000668";s:4:"code";s:14:"binance_lunbtc";s:4:"birg";s:7:"binance";}i:2841;a:4:{s:5:"title";s:7:"LUN-ETH";s:6:"course";s:8:"0.021377";s:4:"code";s:14:"binance_luneth";s:4:"birg";s:7:"binance";}i:2842;a:4:{s:5:"title";s:8:"APP-CBTC";s:6:"course";s:10:"0.00001658";s:4:"code";s:15:"binance_appcbtc";s:4:"birg";s:7:"binance";}i:2843;a:4:{s:5:"title";s:8:"APP-CETH";s:6:"course";s:9:"0.0005273";s:4:"code";s:15:"binance_appceth";s:4:"birg";s:7:"binance";}i:2844;a:4:{s:5:"title";s:8:"APP-CBNB";s:6:"course";s:7:"0.01097";s:4:"code";s:15:"binance_appcbnb";s:4:"birg";s:7:"binance";}i:2845;a:4:{s:5:"title";s:8:"VIB-EBTC";s:6:"course";s:10:"0.00001096";s:4:"code";s:15:"binance_vibebtc";s:4:"birg";s:7:"binance";}i:2846;a:4:{s:5:"title";s:8:"VIB-EETH";s:6:"course";s:9:"0.0003486";s:4:"code";s:15:"binance_vibeeth";s:4:"birg";s:7:"binance";}i:2847;a:4:{s:5:"title";s:7:"RLC-BTC";s:6:"course";s:9:"0.0000742";s:4:"code";s:14:"binance_rlcbtc";s:4:"birg";s:7:"binance";}i:2848;a:4:{s:5:"title";s:7:"RLC-ETH";s:6:"course";s:8:"0.002372";s:4:"code";s:14:"binance_rlceth";s:4:"birg";s:7:"binance";}i:2849;a:4:{s:5:"title";s:7:"RLC-BNB";s:6:"course";s:7:"0.05009";s:4:"code";s:14:"binance_rlcbnb";s:4:"birg";s:7:"binance";}i:2850;a:4:{s:5:"title";s:7:"INS-BTC";s:6:"course";s:9:"0.0000719";s:4:"code";s:14:"binance_insbtc";s:4:"birg";s:7:"binance";}i:2851;a:4:{s:5:"title";s:7:"INS-ETH";s:6:"course";s:8:"0.002293";s:4:"code";s:14:"binance_inseth";s:4:"birg";s:7:"binance";}i:2852;a:4:{s:5:"title";s:8:"PIV-XBTC";s:6:"course";s:9:"0.0002051";s:4:"code";s:15:"binance_pivxbtc";s:4:"birg";s:7:"binance";}i:2853;a:4:{s:5:"title";s:8:"PIV-XETH";s:6:"course";s:8:"0.006525";s:4:"code";s:15:"binance_pivxeth";s:4:"birg";s:7:"binance";}i:2854;a:4:{s:5:"title";s:8:"PIV-XBNB";s:6:"course";s:7:"0.13686";s:4:"code";s:15:"binance_pivxbnb";s:4:"birg";s:7:"binance";}i:2855;a:4:{s:5:"title";s:8:"IOS-TBTC";s:6:"course";s:10:"0.00000189";s:4:"code";s:15:"binance_iostbtc";s:4:"birg";s:7:"binance";}i:2856;a:4:{s:5:"title";s:8:"IOS-TETH";s:6:"course";s:10:"0.00006052";s:4:"code";s:15:"binance_iosteth";s:4:"birg";s:7:"binance";}i:2857;a:4:{s:5:"title";s:9:"STE-EMBTC";s:6:"course";s:9:"0.0001215";s:4:"code";s:16:"binance_steembtc";s:4:"birg";s:7:"binance";}i:2858;a:4:{s:5:"title";s:9:"STE-EMETH";s:6:"course";s:8:"0.003884";s:4:"code";s:16:"binance_steemeth";s:4:"birg";s:7:"binance";}i:2859;a:4:{s:5:"title";s:9:"STE-EMBNB";s:6:"course";s:6:"0.0813";s:4:"code";s:16:"binance_steembnb";s:4:"birg";s:7:"binance";}i:2860;a:4:{s:5:"title";s:8:"NAN-OBTC";s:6:"course";s:9:"0.0003147";s:4:"code";s:15:"binance_nanobtc";s:4:"birg";s:7:"binance";}i:2861;a:4:{s:5:"title";s:8:"NAN-OETH";s:6:"course";s:8:"0.010039";s:4:"code";s:15:"binance_nanoeth";s:4:"birg";s:7:"binance";}i:2862;a:4:{s:5:"title";s:8:"NAN-OBNB";s:6:"course";s:6:"0.2101";s:4:"code";s:15:"binance_nanobnb";s:4:"birg";s:7:"binance";}i:2863;a:4:{s:5:"title";s:7:"VIA-BTC";s:6:"course";s:9:"0.0001085";s:4:"code";s:14:"binance_viabtc";s:4:"birg";s:7:"binance";}i:2864;a:4:{s:5:"title";s:7:"VIA-ETH";s:6:"course";s:8:"0.003457";s:4:"code";s:14:"binance_viaeth";s:4:"birg";s:7:"binance";}i:2865;a:4:{s:5:"title";s:7:"VIA-BNB";s:6:"course";s:7:"0.07511";s:4:"code";s:14:"binance_viabnb";s:4:"birg";s:7:"binance";}i:2866;a:4:{s:5:"title";s:7:"BLZ-BTC";s:6:"course";s:10:"0.00001932";s:4:"code";s:14:"binance_blzbtc";s:4:"birg";s:7:"binance";}i:2867;a:4:{s:5:"title";s:7:"BLZ-ETH";s:6:"course";s:10:"0.00061505";s:4:"code";s:14:"binance_blzeth";s:4:"birg";s:7:"binance";}i:2868;a:4:{s:5:"title";s:7:"BLZ-BNB";s:6:"course";s:7:"0.01294";s:4:"code";s:14:"binance_blzbnb";s:4:"birg";s:7:"binance";}i:2869;a:4:{s:5:"title";s:6:"AEB-TC";s:6:"course";s:9:"0.0001944";s:4:"code";s:13:"binance_aebtc";s:4:"birg";s:7:"binance";}i:2870;a:4:{s:5:"title";s:6:"AEE-TH";s:6:"course";s:8:"0.006203";s:4:"code";s:13:"binance_aeeth";s:4:"birg";s:7:"binance";}i:2871;a:4:{s:5:"title";s:6:"AEB-NB";s:6:"course";s:7:"0.13066";s:4:"code";s:13:"binance_aebnb";s:4:"birg";s:7:"binance";}i:2872;a:4:{s:5:"title";s:9:"NCA-SHBTC";s:6:"course";s:10:"0.00000078";s:4:"code";s:16:"binance_ncashbtc";s:4:"birg";s:7:"binance";}i:2873;a:4:{s:5:"title";s:9:"NCA-SHETH";s:6:"course";s:10:"0.00002468";s:4:"code";s:16:"binance_ncasheth";s:4:"birg";s:7:"binance";}i:2874;a:4:{s:5:"title";s:9:"NCA-SHBNB";s:6:"course";s:8:"0.000518";s:4:"code";s:16:"binance_ncashbnb";s:4:"birg";s:7:"binance";}i:2875;a:4:{s:5:"title";s:7:"POA-BTC";s:6:"course";s:10:"0.00001556";s:4:"code";s:14:"binance_poabtc";s:4:"birg";s:7:"binance";}i:2876;a:4:{s:5:"title";s:7:"POA-ETH";s:6:"course";s:10:"0.00049602";s:4:"code";s:14:"binance_poaeth";s:4:"birg";s:7:"binance";}i:2877;a:4:{s:5:"title";s:7:"POA-BNB";s:6:"course";s:7:"0.01044";s:4:"code";s:14:"binance_poabnb";s:4:"birg";s:7:"binance";}i:2878;a:4:{s:5:"title";s:7:"ZIL-BTC";s:6:"course";s:10:"0.00000548";s:4:"code";s:14:"binance_zilbtc";s:4:"birg";s:7:"binance";}i:2879;a:4:{s:5:"title";s:7:"ZIL-ETH";s:6:"course";s:10:"0.00017508";s:4:"code";s:14:"binance_zileth";s:4:"birg";s:7:"binance";}i:2880;a:4:{s:5:"title";s:7:"ZIL-BNB";s:6:"course";s:8:"0.003674";s:4:"code";s:14:"binance_zilbnb";s:4:"birg";s:7:"binance";}i:2881;a:4:{s:5:"title";s:7:"ONT-BTC";s:6:"course";s:8:"0.000265";s:4:"code";s:14:"binance_ontbtc";s:4:"birg";s:7:"binance";}i:2882;a:4:{s:5:"title";s:7:"ONT-ETH";s:6:"course";s:8:"0.008445";s:4:"code";s:14:"binance_onteth";s:4:"birg";s:7:"binance";}i:2883;a:4:{s:5:"title";s:7:"ONT-BNB";s:6:"course";s:7:"0.17686";s:4:"code";s:14:"binance_ontbnb";s:4:"birg";s:7:"binance";}i:2884;a:4:{s:5:"title";s:9:"STO-RMBTC";s:6:"course";s:10:"0.00000142";s:4:"code";s:16:"binance_stormbtc";s:4:"birg";s:7:"binance";}i:2885;a:4:{s:5:"title";s:9:"STO-RMETH";s:6:"course";s:8:"0.000045";s:4:"code";s:16:"binance_stormeth";s:4:"birg";s:7:"binance";}i:2886;a:4:{s:5:"title";s:9:"STO-RMBNB";s:6:"course";s:8:"0.000959";s:4:"code";s:16:"binance_stormbnb";s:4:"birg";s:7:"binance";}i:2887;a:4:{s:5:"title";s:8:"QTU-MBNB";s:6:"course";s:6:"0.4173";s:4:"code";s:15:"binance_qtumbnb";s:4:"birg";s:7:"binance";}i:2888;a:4:{s:5:"title";s:9:"QTU-MUSDT";s:6:"course";s:5:"4.058";s:4:"code";s:16:"binance_qtumusdt";s:4:"birg";s:7:"binance";}i:2889;a:4:{s:5:"title";s:7:"XEM-BTC";s:6:"course";s:10:"0.00001461";s:4:"code";s:14:"binance_xembtc";s:4:"birg";s:7:"binance";}i:2890;a:4:{s:5:"title";s:7:"XEM-ETH";s:6:"course";s:10:"0.00046639";s:4:"code";s:14:"binance_xemeth";s:4:"birg";s:7:"binance";}i:2891;a:4:{s:5:"title";s:7:"XEM-BNB";s:6:"course";s:6:"0.0098";s:4:"code";s:14:"binance_xembnb";s:4:"birg";s:7:"binance";}i:2892;a:4:{s:5:"title";s:7:"WAN-BTC";s:6:"course";s:8:"0.000158";s:4:"code";s:14:"binance_wanbtc";s:4:"birg";s:7:"binance";}i:2893;a:4:{s:5:"title";s:7:"WAN-ETH";s:6:"course";s:8:"0.005038";s:4:"code";s:14:"binance_waneth";s:4:"birg";s:7:"binance";}i:2894;a:4:{s:5:"title";s:7:"WAN-BNB";s:6:"course";s:6:"0.1061";s:4:"code";s:14:"binance_wanbnb";s:4:"birg";s:7:"binance";}i:2895;a:4:{s:5:"title";s:7:"WPR-BTC";s:6:"course";s:10:"0.00000458";s:4:"code";s:14:"binance_wprbtc";s:4:"birg";s:7:"binance";}i:2896;a:4:{s:5:"title";s:7:"WPR-ETH";s:6:"course";s:10:"0.00014734";s:4:"code";s:14:"binance_wpreth";s:4:"birg";s:7:"binance";}i:2897;a:4:{s:5:"title";s:7:"QLC-BTC";s:6:"course";s:10:"0.00000793";s:4:"code";s:14:"binance_qlcbtc";s:4:"birg";s:7:"binance";}i:2898;a:4:{s:5:"title";s:7:"QLC-ETH";s:6:"course";s:10:"0.00025315";s:4:"code";s:14:"binance_qlceth";s:4:"birg";s:7:"binance";}i:2899;a:4:{s:5:"title";s:7:"SYS-BTC";s:6:"course";s:10:"0.00001505";s:4:"code";s:14:"binance_sysbtc";s:4:"birg";s:7:"binance";}i:2900;a:4:{s:5:"title";s:7:"SYS-ETH";s:6:"course";s:10:"0.00048047";s:4:"code";s:14:"binance_syseth";s:4:"birg";s:7:"binance";}i:2901;a:4:{s:5:"title";s:7:"SYS-BNB";s:6:"course";s:7:"0.01012";s:4:"code";s:14:"binance_sysbnb";s:4:"birg";s:7:"binance";}i:2902;a:4:{s:5:"title";s:7:"QLC-BNB";s:6:"course";s:8:"0.005311";s:4:"code";s:14:"binance_qlcbnb";s:4:"birg";s:7:"binance";}i:2903;a:4:{s:5:"title";s:7:"GRS-BTC";s:6:"course";s:8:"0.000084";s:4:"code";s:14:"binance_grsbtc";s:4:"birg";s:7:"binance";}i:2904;a:4:{s:5:"title";s:7:"GRS-ETH";s:6:"course";s:10:"0.00266974";s:4:"code";s:14:"binance_grseth";s:4:"birg";s:7:"binance";}i:2905;a:4:{s:5:"title";s:8:"ADA-USDT";s:6:"course";s:7:"0.07356";s:4:"code";s:15:"binance_adausdt";s:4:"birg";s:7:"binance";}i:2906;a:4:{s:5:"title";s:7:"ADA-BNB";s:6:"course";s:7:"0.00755";s:4:"code";s:14:"binance_adabnb";s:4:"birg";s:7:"binance";}i:2907;a:4:{s:5:"title";s:9:"CLO-AKBTC";s:6:"course";s:9:"0.0004976";s:4:"code";s:16:"binance_cloakbtc";s:4:"birg";s:7:"binance";}i:2908;a:4:{s:5:"title";s:9:"CLO-AKETH";s:6:"course";s:8:"0.015888";s:4:"code";s:16:"binance_cloaketh";s:4:"birg";s:7:"binance";}i:2909;a:4:{s:5:"title";s:7:"GNT-BTC";s:6:"course";s:10:"0.00002703";s:4:"code";s:14:"binance_gntbtc";s:4:"birg";s:7:"binance";}i:2910;a:4:{s:5:"title";s:7:"GNT-ETH";s:6:"course";s:10:"0.00086032";s:4:"code";s:14:"binance_gnteth";s:4:"birg";s:7:"binance";}i:2911;a:4:{s:5:"title";s:7:"GNT-BNB";s:6:"course";s:7:"0.01805";s:4:"code";s:14:"binance_gntbnb";s:4:"birg";s:7:"binance";}i:2912;a:4:{s:5:"title";s:8:"LOO-MBTC";s:6:"course";s:10:"0.00001825";s:4:"code";s:15:"binance_loombtc";s:4:"birg";s:7:"binance";}i:2913;a:4:{s:5:"title";s:8:"LOO-METH";s:6:"course";s:10:"0.00058065";s:4:"code";s:15:"binance_loometh";s:4:"birg";s:7:"binance";}i:2914;a:4:{s:5:"title";s:8:"LOO-MBNB";s:6:"course";s:6:"0.0122";s:4:"code";s:15:"binance_loombnb";s:4:"birg";s:7:"binance";}i:2915;a:4:{s:5:"title";s:8:"XRP-USDT";s:6:"course";s:7:"0.45976";s:4:"code";s:15:"binance_xrpusdt";s:4:"birg";s:7:"binance";}i:2916;a:4:{s:5:"title";s:7:"REP-BTC";s:6:"course";s:8:"0.002099";s:4:"code";s:14:"binance_repbtc";s:4:"birg";s:7:"binance";}i:2917;a:4:{s:5:"title";s:7:"REP-ETH";s:6:"course";s:7:"0.06665";s:4:"code";s:14:"binance_repeth";s:4:"birg";s:7:"binance";}i:2918;a:4:{s:5:"title";s:7:"REP-BNB";s:6:"course";s:5:"1.397";s:4:"code";s:14:"binance_repbnb";s:4:"birg";s:7:"binance";}i:2919;a:4:{s:5:"title";s:8:"TUS-DBTC";s:6:"course";s:10:"0.00015688";s:4:"code";s:15:"binance_tusdbtc";s:4:"birg";s:7:"binance";}i:2920;a:4:{s:5:"title";s:8:"TUS-DETH";s:6:"course";s:10:"0.00500679";s:4:"code";s:15:"binance_tusdeth";s:4:"birg";s:7:"binance";}i:2921;a:4:{s:5:"title";s:8:"TUS-DBNB";s:6:"course";s:7:"0.10496";s:4:"code";s:15:"binance_tusdbnb";s:4:"birg";s:7:"binance";}i:2922;a:4:{s:5:"title";s:7:"ZEN-BTC";s:6:"course";s:8:"0.002245";s:4:"code";s:14:"binance_zenbtc";s:4:"birg";s:7:"binance";}i:2923;a:4:{s:5:"title";s:7:"ZEN-ETH";s:6:"course";s:7:"0.07149";s:4:"code";s:14:"binance_zeneth";s:4:"birg";s:7:"binance";}i:2924;a:4:{s:5:"title";s:7:"ZEN-BNB";s:6:"course";s:4:"1.52";s:4:"code";s:14:"binance_zenbnb";s:4:"birg";s:7:"binance";}i:2925;a:4:{s:5:"title";s:7:"SKY-BTC";s:6:"course";s:8:"0.000505";s:4:"code";s:14:"binance_skybtc";s:4:"birg";s:7:"binance";}i:2926;a:4:{s:5:"title";s:7:"SKY-ETH";s:6:"course";s:7:"0.01601";s:4:"code";s:14:"binance_skyeth";s:4:"birg";s:7:"binance";}i:2927;a:4:{s:5:"title";s:7:"SKY-BNB";s:6:"course";s:5:"0.337";s:4:"code";s:14:"binance_skybnb";s:4:"birg";s:7:"binance";}i:2928;a:4:{s:5:"title";s:8:"EOS-USDT";s:6:"course";s:6:"5.4206";s:4:"code";s:15:"binance_eosusdt";s:4:"birg";s:7:"binance";}i:2929;a:4:{s:5:"title";s:7:"EOS-BNB";s:6:"course";s:6:"0.5558";s:4:"code";s:14:"binance_eosbnb";s:4:"birg";s:7:"binance";}i:2930;a:4:{s:5:"title";s:7:"CVC-BTC";s:6:"course";s:10:"0.00002148";s:4:"code";s:14:"binance_cvcbtc";s:4:"birg";s:7:"binance";}i:2931;a:4:{s:5:"title";s:7:"CVC-ETH";s:6:"course";s:10:"0.00068417";s:4:"code";s:14:"binance_cvceth";s:4:"birg";s:7:"binance";}i:2932;a:4:{s:5:"title";s:7:"CVC-BNB";s:6:"course";s:7:"0.01435";s:4:"code";s:14:"binance_cvcbnb";s:4:"birg";s:7:"binance";}i:2933;a:4:{s:5:"title";s:9:"THE-TABTC";s:6:"course";s:10:"0.00001362";s:4:"code";s:16:"binance_thetabtc";s:4:"birg";s:7:"binance";}i:2934;a:4:{s:5:"title";s:9:"THE-TAETH";s:6:"course";s:10:"0.00043462";s:4:"code";s:16:"binance_thetaeth";s:4:"birg";s:7:"binance";}i:2935;a:4:{s:5:"title";s:9:"THE-TABNB";s:6:"course";s:6:"0.0091";s:4:"code";s:16:"binance_thetabnb";s:4:"birg";s:7:"binance";}i:2936;a:4:{s:5:"title";s:7:"XRP-BNB";s:6:"course";s:7:"0.04719";s:4:"code";s:14:"binance_xrpbnb";s:4:"birg";s:7:"binance";}i:2937;a:4:{s:5:"title";s:9:"TUS-DUSDT";s:6:"course";s:6:"1.0186";s:4:"code";s:16:"binance_tusdusdt";s:4:"birg";s:7:"binance";}i:2938;a:4:{s:5:"title";s:9:"IOT-AUSDT";s:6:"course";s:6:"0.4902";s:4:"code";s:16:"binance_iotausdt";s:4:"birg";s:7:"binance";}i:2939;a:4:{s:5:"title";s:8:"XLM-USDT";s:6:"course";s:7:"0.23339";s:4:"code";s:15:"binance_xlmusdt";s:4:"birg";s:7:"binance";}i:2940;a:4:{s:5:"title";s:8:"IOT-XBTC";s:6:"course";s:10:"0.00000278";s:4:"code";s:15:"binance_iotxbtc";s:4:"birg";s:7:"binance";}i:2941;a:4:{s:5:"title";s:8:"IOT-XETH";s:6:"course";s:10:"0.00008855";s:4:"code";s:15:"binance_iotxeth";s:4:"birg";s:7:"binance";}i:2942;a:4:{s:5:"title";s:7:"QKC-BTC";s:6:"course";s:10:"0.00000752";s:4:"code";s:14:"binance_qkcbtc";s:4:"birg";s:7:"binance";}i:2943;a:4:{s:5:"title";s:7:"QKC-ETH";s:6:"course";s:10:"0.00023955";s:4:"code";s:14:"binance_qkceth";s:4:"birg";s:7:"binance";}i:2944;a:4:{s:5:"title";s:7:"AGI-BTC";s:6:"course";s:10:"0.00000887";s:4:"code";s:14:"binance_agibtc";s:4:"birg";s:7:"binance";}i:2945;a:4:{s:5:"title";s:7:"AGI-ETH";s:6:"course";s:10:"0.00028225";s:4:"code";s:14:"binance_agieth";s:4:"birg";s:7:"binance";}i:2946;a:4:{s:5:"title";s:7:"AGI-BNB";s:6:"course";s:7:"0.00594";s:4:"code";s:14:"binance_agibnb";s:4:"birg";s:7:"binance";}i:2947;a:4:{s:5:"title";s:7:"NXS-BTC";s:6:"course";s:9:"0.0001175";s:4:"code";s:14:"binance_nxsbtc";s:4:"birg";s:7:"binance";}i:2948;a:4:{s:5:"title";s:7:"NXS-ETH";s:6:"course";s:8:"0.003749";s:4:"code";s:14:"binance_nxseth";s:4:"birg";s:7:"binance";}i:2949;a:4:{s:5:"title";s:7:"NXS-BNB";s:6:"course";s:6:"0.0788";s:4:"code";s:14:"binance_nxsbnb";s:4:"birg";s:7:"binance";}i:2950;a:4:{s:5:"title";s:7:"ENJ-BNB";s:6:"course";s:8:"0.005174";s:4:"code";s:14:"binance_enjbnb";s:4:"birg";s:7:"binance";}i:2951;a:4:{s:5:"title";s:8:"DAT-ABTC";s:6:"course";s:10:"0.00000607";s:4:"code";s:15:"binance_databtc";s:4:"birg";s:7:"binance";}i:2952;a:4:{s:5:"title";s:8:"DAT-AETH";s:6:"course";s:10:"0.00019349";s:4:"code";s:15:"binance_dataeth";s:4:"birg";s:7:"binance";}i:2953;a:4:{s:5:"title";s:8:"ONT-USDT";s:6:"course";s:5:"1.721";s:4:"code";s:15:"binance_ontusdt";s:4:"birg";s:7:"binance";}i:2954;a:4:{s:5:"title";s:7:"TRX-BNB";s:6:"course";s:8:"0.002421";s:4:"code";s:14:"binance_trxbnb";s:4:"birg";s:7:"binance";}i:2955;a:4:{s:5:"title";s:8:"TRX-USDT";s:6:"course";s:7:"0.02342";s:4:"code";s:15:"binance_trxusdt";s:4:"birg";s:7:"binance";}i:2956;a:4:{s:5:"title";s:8:"ETC-USDT";s:6:"course";s:6:"9.6776";s:4:"code";s:15:"binance_etcusdt";s:4:"birg";s:7:"binance";}i:2957;a:4:{s:5:"title";s:7:"ETC-BNB";s:6:"course";s:6:"0.9953";s:4:"code";s:14:"binance_etcbnb";s:4:"birg";s:7:"binance";}i:2958;a:4:{s:5:"title";s:8:"ICX-USDT";s:6:"course";s:6:"0.6557";s:4:"code";s:15:"binance_icxusdt";s:4:"birg";s:7:"binance";}i:2959;a:4:{s:5:"title";s:6:"SCB-TC";s:6:"course";s:10:"0.00000112";s:4:"code";s:13:"binance_scbtc";s:4:"birg";s:7:"binance";}i:2960;a:4:{s:5:"title";s:6:"SCE-TH";s:6:"course";s:10:"0.00003542";s:4:"code";s:13:"binance_sceth";s:4:"birg";s:7:"binance";}i:2961;a:4:{s:5:"title";s:6:"SCB-NB";s:6:"course";s:8:"0.000749";s:4:"code";s:13:"binance_scbnb";s:4:"birg";s:7:"binance";}i:2962;a:4:{s:5:"title";s:8:"NPX-SBTC";s:6:"course";s:10:"0.00000025";s:4:"code";s:15:"binance_npxsbtc";s:4:"birg";s:7:"binance";}i:2963;a:4:{s:5:"title";s:8:"NPX-SETH";s:6:"course";s:10:"0.00000784";s:4:"code";s:15:"binance_npxseth";s:4:"birg";s:7:"binance";}i:2964;a:4:{s:5:"title";s:7:"KEY-BTC";s:6:"course";s:10:"0.00000099";s:4:"code";s:14:"binance_keybtc";s:4:"birg";s:7:"binance";}i:2965;a:4:{s:5:"title";s:7:"KEY-ETH";s:6:"course";s:10:"0.00003171";s:4:"code";s:14:"binance_keyeth";s:4:"birg";s:7:"binance";}i:2966;a:4:{s:5:"title";s:7:"NAS-BTC";s:6:"course";s:9:"0.0002315";s:4:"code";s:14:"binance_nasbtc";s:4:"birg";s:7:"binance";}i:2967;a:4:{s:5:"title";s:7:"NAS-ETH";s:6:"course";s:8:"0.007401";s:4:"code";s:14:"binance_naseth";s:4:"birg";s:7:"binance";}i:2968;a:4:{s:5:"title";s:7:"NAS-BNB";s:6:"course";s:7:"0.15653";s:4:"code";s:14:"binance_nasbnb";s:4:"birg";s:7:"binance";}i:2969;a:4:{s:5:"title";s:7:"MFT-BTC";s:6:"course";s:10:"0.00000135";s:4:"code";s:14:"binance_mftbtc";s:4:"birg";s:7:"binance";}i:2970;a:4:{s:5:"title";s:7:"MFT-ETH";s:6:"course";s:10:"0.00004308";s:4:"code";s:14:"binance_mfteth";s:4:"birg";s:7:"binance";}i:2971;a:4:{s:5:"title";s:7:"MFT-BNB";s:6:"course";s:8:"0.000899";s:4:"code";s:14:"binance_mftbnb";s:4:"birg";s:7:"binance";}i:2972;a:4:{s:5:"title";s:8:"DEN-TBTC";s:6:"course";s:10:"0.00000036";s:4:"code";s:15:"binance_dentbtc";s:4:"birg";s:7:"binance";}i:2973;a:4:{s:5:"title";s:8:"DEN-TETH";s:6:"course";s:10:"0.00001175";s:4:"code";s:15:"binance_denteth";s:4:"birg";s:7:"binance";}i:2974;a:4:{s:5:"title";s:8:"ARD-RBTC";s:6:"course";s:10:"0.00001696";s:4:"code";s:15:"binance_ardrbtc";s:4:"birg";s:7:"binance";}i:2975;a:4:{s:5:"title";s:8:"ARD-RETH";s:6:"course";s:10:"0.00054236";s:4:"code";s:15:"binance_ardreth";s:4:"birg";s:7:"binance";}i:2976;a:4:{s:5:"title";s:8:"ARD-RBNB";s:6:"course";s:7:"0.01138";s:4:"code";s:15:"binance_ardrbnb";s:4:"birg";s:7:"binance";}i:2977;a:4:{s:5:"title";s:9:"NUL-SUSDT";s:6:"course";s:6:"1.1145";s:4:"code";s:16:"binance_nulsusdt";s:4:"birg";s:7:"binance";}i:2978;a:4:{s:5:"title";s:7:"HOT-BTC";s:6:"course";s:10:"0.00000016";s:4:"code";s:14:"binance_hotbtc";s:4:"birg";s:7:"binance";}i:2979;a:4:{s:5:"title";s:7:"HOT-ETH";s:6:"course";s:10:"0.00000529";s:4:"code";s:14:"binance_hoteth";s:4:"birg";s:7:"binance";}i:2980;a:4:{s:5:"title";s:7:"VET-BTC";s:6:"course";s:10:"0.00000168";s:4:"code";s:14:"binance_vetbtc";s:4:"birg";s:7:"binance";}i:2981;a:4:{s:5:"title";s:7:"VET-ETH";s:6:"course";s:10:"0.00005356";s:4:"code";s:14:"binance_veteth";s:4:"birg";s:7:"binance";}i:2982;a:4:{s:5:"title";s:8:"VET-USDT";s:6:"course";s:7:"0.01092";s:4:"code";s:15:"binance_vetusdt";s:4:"birg";s:7:"binance";}i:2983;a:4:{s:5:"title";s:7:"VET-BNB";s:6:"course";s:7:"0.00112";s:4:"code";s:14:"binance_vetbnb";s:4:"birg";s:7:"binance";}i:2984;a:4:{s:5:"title";s:8:"DOC-KBTC";s:6:"course";s:10:"0.00000375";s:4:"code";s:15:"binance_dockbtc";s:4:"birg";s:7:"binance";}i:2985;a:4:{s:5:"title";s:8:"DOC-KETH";s:6:"course";s:10:"0.00011949";s:4:"code";s:15:"binance_docketh";s:4:"birg";s:7:"binance";}i:2986;a:4:{s:5:"title";s:8:"POL-YBTC";s:6:"course";s:10:"0.00004147";s:4:"code";s:15:"binance_polybtc";s:4:"birg";s:7:"binance";}i:2987;a:4:{s:5:"title";s:8:"POL-YBNB";s:6:"course";s:7:"0.02767";s:4:"code";s:15:"binance_polybnb";s:4:"birg";s:7:"binance";}i:2988;a:4:{s:5:"title";s:7:"PHX-BTC";s:6:"course";s:10:"0.00000278";s:4:"code";s:14:"binance_phxbtc";s:4:"birg";s:7:"binance";}i:2989;a:4:{s:5:"title";s:7:"PHX-ETH";s:6:"course";s:9:"0.0000885";s:4:"code";s:14:"binance_phxeth";s:4:"birg";s:7:"binance";}i:2990;a:4:{s:5:"title";s:7:"PHX-BNB";s:6:"course";s:8:"0.001852";s:4:"code";s:14:"binance_phxbnb";s:4:"birg";s:7:"binance";}i:2991;a:4:{s:5:"title";s:6:"HCB-TC";s:6:"course";s:8:"0.000288";s:4:"code";s:13:"binance_hcbtc";s:4:"birg";s:7:"binance";}i:2992;a:4:{s:5:"title";s:6:"HCE-TH";s:6:"course";s:6:"0.0092";s:4:"code";s:13:"binance_hceth";s:4:"birg";s:7:"binance";}i:2993;a:4:{s:5:"title";s:6:"GOB-TC";s:6:"course";s:10:"0.00001139";s:4:"code";s:13:"binance_gobtc";s:4:"birg";s:7:"binance";}i:2994;a:4:{s:5:"title";s:6:"GOB-NB";s:6:"course";s:8:"0.007698";s:4:"code";s:13:"binance_gobnb";s:4:"birg";s:7:"binance";}i:2995;a:4:{s:5:"title";s:7:"PAX-BTC";s:6:"course";s:10:"0.00015646";s:4:"code";s:14:"binance_paxbtc";s:4:"birg";s:7:"binance";}i:2996;a:4:{s:5:"title";s:7:"PAX-BNB";s:6:"course";s:7:"0.10459";s:4:"code";s:14:"binance_paxbnb";s:4:"birg";s:7:"binance";}i:2997;a:4:{s:5:"title";s:8:"PAX-USDT";s:6:"course";s:6:"1.0155";s:4:"code";s:15:"binance_paxusdt";s:4:"birg";s:7:"binance";}i:2998;a:4:{s:5:"title";s:7:"PAX-ETH";s:6:"course";s:10:"0.00498594";s:4:"code";s:14:"binance_paxeth";s:4:"birg";s:7:"binance";}i:2999;a:4:{s:5:"title";s:7:"RVN-BTC";s:6:"course";s:10:"0.00000784";s:4:"code";s:14:"binance_rvnbtc";s:4:"birg";s:7:"binance";}i:3000;a:4:{s:5:"title";s:7:"RVN-BNB";s:6:"course";s:8:"0.005203";s:4:"code";s:14:"binance_rvnbnb";s:4:"birg";s:7:"binance";}i:3001;a:4:{s:5:"title";s:7:"DCR-BTC";s:6:"course";s:8:"0.006696";s:4:"code";s:14:"binance_dcrbtc";s:4:"birg";s:7:"binance";}i:3002;a:4:{s:5:"title";s:7:"DCR-BNB";s:6:"course";s:5:"4.516";s:4:"code";s:14:"binance_dcrbnb";s:4:"birg";s:7:"binance";}i:3003;a:4:{s:5:"title";s:14:"BTC-USD (high)";s:6:"course";s:7:"6420.01";s:4:"code";s:20:"bitstamp_btcusd_high";s:4:"birg";s:15:"bitstamp_btcusd";}i:3004;a:4:{s:5:"title";s:14:"BTC-USD (last)";s:6:"course";s:7:"6398.52";s:4:"code";s:20:"bitstamp_btcusd_last";s:4:"birg";s:15:"bitstamp_btcusd";}i:3005;a:4:{s:5:"title";s:13:"BTC-USD (bid)";s:6:"course";s:7:"6393.06";s:4:"code";s:19:"bitstamp_btcusd_bid";s:4:"birg";s:15:"bitstamp_btcusd";}i:3006;a:4:{s:5:"title";s:14:"BTC-USD (vwap)";s:6:"course";s:7:"6403.68";s:4:"code";s:20:"bitstamp_btcusd_vwap";s:4:"birg";s:15:"bitstamp_btcusd";}i:3007;a:4:{s:5:"title";s:13:"BTC-USD (low)";s:6:"course";s:7:"6381.25";s:4:"code";s:19:"bitstamp_btcusd_low";s:4:"birg";s:15:"bitstamp_btcusd";}i:3008;a:4:{s:5:"title";s:13:"BTC-USD (ask)";s:6:"course";s:7:"6398.52";s:4:"code";s:19:"bitstamp_btcusd_ask";s:4:"birg";s:15:"bitstamp_btcusd";}i:3009;a:4:{s:5:"title";s:14:"BTC-USD (open)";s:6:"course";s:6:"6406.1";s:4:"code";s:20:"bitstamp_btcusd_open";s:4:"birg";s:15:"bitstamp_btcusd";}i:3010;a:4:{s:5:"title";s:14:"BTC-EUR (high)";s:6:"course";s:7:"5649.45";s:4:"code";s:20:"bitstamp_btceur_high";s:4:"birg";s:15:"bitstamp_btceur";}i:3011;a:4:{s:5:"title";s:14:"BTC-EUR (last)";s:6:"course";s:7:"5624.02";s:4:"code";s:20:"bitstamp_btceur_last";s:4:"birg";s:15:"bitstamp_btceur";}i:3012;a:4:{s:5:"title";s:13:"BTC-EUR (bid)";s:6:"course";s:7:"5615.01";s:4:"code";s:19:"bitstamp_btceur_bid";s:4:"birg";s:15:"bitstamp_btceur";}i:3013;a:4:{s:5:"title";s:14:"BTC-EUR (vwap)";s:6:"course";s:7:"5630.98";s:4:"code";s:20:"bitstamp_btceur_vwap";s:4:"birg";s:15:"bitstamp_btceur";}i:3014;a:4:{s:5:"title";s:13:"BTC-EUR (low)";s:6:"course";s:7:"5610.01";s:4:"code";s:19:"bitstamp_btceur_low";s:4:"birg";s:15:"bitstamp_btceur";}i:3015;a:4:{s:5:"title";s:13:"BTC-EUR (ask)";s:6:"course";s:7:"5623.86";s:4:"code";s:19:"bitstamp_btceur_ask";s:4:"birg";s:15:"bitstamp_btceur";}i:3016;a:4:{s:5:"title";s:14:"BTC-EUR (open)";s:6:"course";s:7:"5630.37";s:4:"code";s:20:"bitstamp_btceur_open";s:4:"birg";s:15:"bitstamp_btceur";}i:3017;a:4:{s:5:"title";s:14:"EUR-USD (high)";s:6:"course";s:7:"1.13975";s:4:"code";s:20:"bitstamp_eurusd_high";s:4:"birg";s:15:"bitstamp_eurusd";}i:3018;a:4:{s:5:"title";s:14:"EUR-USD (last)";s:6:"course";s:7:"1.13367";s:4:"code";s:20:"bitstamp_eurusd_last";s:4:"birg";s:15:"bitstamp_eurusd";}i:3019;a:4:{s:5:"title";s:13:"EUR-USD (bid)";s:6:"course";s:7:"1.13361";s:4:"code";s:19:"bitstamp_eurusd_bid";s:4:"birg";s:15:"bitstamp_eurusd";}i:3020;a:4:{s:5:"title";s:14:"EUR-USD (vwap)";s:6:"course";s:7:"1.13799";s:4:"code";s:20:"bitstamp_eurusd_vwap";s:4:"birg";s:15:"bitstamp_eurusd";}i:3021;a:4:{s:5:"title";s:13:"EUR-USD (low)";s:6:"course";s:7:"1.13223";s:4:"code";s:19:"bitstamp_eurusd_low";s:4:"birg";s:15:"bitstamp_eurusd";}i:3022;a:4:{s:5:"title";s:13:"EUR-USD (ask)";s:6:"course";s:7:"1.13881";s:4:"code";s:19:"bitstamp_eurusd_ask";s:4:"birg";s:15:"bitstamp_eurusd";}i:3023;a:4:{s:5:"title";s:14:"EUR-USD (open)";s:6:"course";s:7:"1.13907";s:4:"code";s:20:"bitstamp_eurusd_open";s:4:"birg";s:15:"bitstamp_eurusd";}i:3024;a:4:{s:5:"title";s:14:"XRP-USD (high)";s:6:"course";s:7:"0.45858";s:4:"code";s:20:"bitstamp_xrpusd_high";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3025;a:4:{s:5:"title";s:14:"XRP-USD (last)";s:6:"course";s:7:"0.45291";s:4:"code";s:20:"bitstamp_xrpusd_last";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3026;a:4:{s:5:"title";s:13:"XRP-USD (bid)";s:6:"course";s:7:"0.45243";s:4:"code";s:19:"bitstamp_xrpusd_bid";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3027;a:4:{s:5:"title";s:14:"XRP-USD (vwap)";s:6:"course";s:7:"0.45436";s:4:"code";s:20:"bitstamp_xrpusd_vwap";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3028;a:4:{s:5:"title";s:13:"XRP-USD (low)";s:6:"course";s:7:"0.45028";s:4:"code";s:19:"bitstamp_xrpusd_low";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3029;a:4:{s:5:"title";s:13:"XRP-USD (ask)";s:6:"course";s:7:"0.45291";s:4:"code";s:19:"bitstamp_xrpusd_ask";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3030;a:4:{s:5:"title";s:14:"XRP-USD (open)";s:6:"course";s:6:"0.4571";s:4:"code";s:20:"bitstamp_xrpusd_open";s:4:"birg";s:15:"bitstamp_xrpusd";}i:3031;a:4:{s:5:"title";s:14:"XRP-EUR (high)";s:6:"course";s:5:"0.402";s:4:"code";s:20:"bitstamp_xrpeur_high";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3032;a:4:{s:5:"title";s:14:"XRP-EUR (last)";s:6:"course";s:5:"0.397";s:4:"code";s:20:"bitstamp_xrpeur_last";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3033;a:4:{s:5:"title";s:13:"XRP-EUR (bid)";s:6:"course";s:5:"0.397";s:4:"code";s:19:"bitstamp_xrpeur_bid";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3034;a:4:{s:5:"title";s:14:"XRP-EUR (vwap)";s:6:"course";s:7:"0.39872";s:4:"code";s:20:"bitstamp_xrpeur_vwap";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3035;a:4:{s:5:"title";s:13:"XRP-EUR (low)";s:6:"course";s:5:"0.396";s:4:"code";s:19:"bitstamp_xrpeur_low";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3036;a:4:{s:5:"title";s:13:"XRP-EUR (ask)";s:6:"course";s:7:"0.39754";s:4:"code";s:19:"bitstamp_xrpeur_ask";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3037;a:4:{s:5:"title";s:14:"XRP-EUR (open)";s:6:"course";s:7:"0.40182";s:4:"code";s:20:"bitstamp_xrpeur_open";s:4:"birg";s:15:"bitstamp_xrpeur";}i:3038;a:4:{s:5:"title";s:14:"XRP-BTC (high)";s:6:"course";s:10:"0.00007168";s:4:"code";s:20:"bitstamp_xrpbtc_high";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3039;a:4:{s:5:"title";s:14:"XRP-BTC (last)";s:6:"course";s:9:"0.0000707";s:4:"code";s:20:"bitstamp_xrpbtc_last";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3040;a:4:{s:5:"title";s:13:"XRP-BTC (bid)";s:6:"course";s:10:"0.00007064";s:4:"code";s:19:"bitstamp_xrpbtc_bid";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3041;a:4:{s:5:"title";s:14:"XRP-BTC (vwap)";s:6:"course";s:10:"0.00007088";s:4:"code";s:20:"bitstamp_xrpbtc_vwap";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3042;a:4:{s:5:"title";s:13:"XRP-BTC (low)";s:6:"course";s:10:"0.00007021";s:4:"code";s:19:"bitstamp_xrpbtc_low";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3043;a:4:{s:5:"title";s:13:"XRP-BTC (ask)";s:6:"course";s:10:"0.00007085";s:4:"code";s:19:"bitstamp_xrpbtc_ask";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3044;a:4:{s:5:"title";s:14:"XRP-BTC (open)";s:6:"course";s:9:"0.0000714";s:4:"code";s:20:"bitstamp_xrpbtc_open";s:4:"birg";s:15:"bitstamp_xrpbtc";}i:3045;a:4:{s:5:"title";s:14:"LTC-USD (high)";s:6:"course";s:5:"51.87";s:4:"code";s:20:"bitstamp_ltcusd_high";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3046;a:4:{s:5:"title";s:14:"LTC-USD (last)";s:6:"course";s:5:"51.42";s:4:"code";s:20:"bitstamp_ltcusd_last";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3047;a:4:{s:5:"title";s:13:"LTC-USD (bid)";s:6:"course";s:5:"51.29";s:4:"code";s:19:"bitstamp_ltcusd_bid";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3048;a:4:{s:5:"title";s:14:"LTC-USD (vwap)";s:6:"course";s:5:"51.62";s:4:"code";s:20:"bitstamp_ltcusd_vwap";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3049;a:4:{s:5:"title";s:13:"LTC-USD (low)";s:6:"course";s:5:"51.24";s:4:"code";s:19:"bitstamp_ltcusd_low";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3050;a:4:{s:5:"title";s:13:"LTC-USD (ask)";s:6:"course";s:5:"51.42";s:4:"code";s:19:"bitstamp_ltcusd_ask";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3051;a:4:{s:5:"title";s:14:"LTC-USD (open)";s:6:"course";s:5:"51.71";s:4:"code";s:20:"bitstamp_ltcusd_open";s:4:"birg";s:15:"bitstamp_ltcusd";}i:3052;a:4:{s:5:"title";s:14:"LTC-EUR (high)";s:6:"course";s:5:"45.54";s:4:"code";s:20:"bitstamp_ltceur_high";s:4:"birg";s:15:"bitstamp_ltceur";}i:3053;a:4:{s:5:"title";s:14:"LTC-EUR (last)";s:6:"course";s:5:"45.12";s:4:"code";s:20:"bitstamp_ltceur_last";s:4:"birg";s:15:"bitstamp_ltceur";}i:3054;a:4:{s:5:"title";s:13:"LTC-EUR (bid)";s:6:"course";s:4:"45.1";s:4:"code";s:19:"bitstamp_ltceur_bid";s:4:"birg";s:15:"bitstamp_ltceur";}i:3055;a:4:{s:5:"title";s:14:"LTC-EUR (vwap)";s:6:"course";s:4:"45.3";s:4:"code";s:20:"bitstamp_ltceur_vwap";s:4:"birg";s:15:"bitstamp_ltceur";}i:3056;a:4:{s:5:"title";s:13:"LTC-EUR (low)";s:6:"course";s:4:"45.1";s:4:"code";s:19:"bitstamp_ltceur_low";s:4:"birg";s:15:"bitstamp_ltceur";}i:3057;a:4:{s:5:"title";s:13:"LTC-EUR (ask)";s:6:"course";s:5:"45.12";s:4:"code";s:19:"bitstamp_ltceur_ask";s:4:"birg";s:15:"bitstamp_ltceur";}i:3058;a:4:{s:5:"title";s:14:"LTC-EUR (open)";s:6:"course";s:5:"45.29";s:4:"code";s:20:"bitstamp_ltceur_open";s:4:"birg";s:15:"bitstamp_ltceur";}i:3059;a:4:{s:5:"title";s:14:"LTC-BTC (high)";s:6:"course";s:9:"0.0081066";s:4:"code";s:20:"bitstamp_ltcbtc_high";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3060;a:4:{s:5:"title";s:14:"LTC-BTC (last)";s:6:"course";s:8:"0.008025";s:4:"code";s:20:"bitstamp_ltcbtc_last";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3061;a:4:{s:5:"title";s:13:"LTC-BTC (bid)";s:6:"course";s:7:"0.00802";s:4:"code";s:19:"bitstamp_ltcbtc_bid";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3062;a:4:{s:5:"title";s:14:"LTC-BTC (vwap)";s:6:"course";s:10:"0.00805869";s:4:"code";s:20:"bitstamp_ltcbtc_vwap";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3063;a:4:{s:5:"title";s:13:"LTC-BTC (low)";s:6:"course";s:8:"0.008025";s:4:"code";s:19:"bitstamp_ltcbtc_low";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3064;a:4:{s:5:"title";s:13:"LTC-BTC (ask)";s:6:"course";s:8:"0.008035";s:4:"code";s:19:"bitstamp_ltcbtc_ask";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3065;a:4:{s:5:"title";s:14:"LTC-BTC (open)";s:6:"course";s:10:"0.00805541";s:4:"code";s:20:"bitstamp_ltcbtc_open";s:4:"birg";s:15:"bitstamp_ltcbtc";}i:3066;a:4:{s:5:"title";s:14:"ETH-USD (high)";s:6:"course";s:6:"201.58";s:4:"code";s:20:"bitstamp_ethusd_high";s:4:"birg";s:15:"bitstamp_ethusd";}i:3067;a:4:{s:5:"title";s:14:"ETH-USD (last)";s:6:"course";s:6:"200.25";s:4:"code";s:20:"bitstamp_ethusd_last";s:4:"birg";s:15:"bitstamp_ethusd";}i:3068;a:4:{s:5:"title";s:13:"ETH-USD (bid)";s:6:"course";s:5:"200.4";s:4:"code";s:19:"bitstamp_ethusd_bid";s:4:"birg";s:15:"bitstamp_ethusd";}i:3069;a:4:{s:5:"title";s:14:"ETH-USD (vwap)";s:6:"course";s:6:"200.74";s:4:"code";s:20:"bitstamp_ethusd_vwap";s:4:"birg";s:15:"bitstamp_ethusd";}i:3070;a:4:{s:5:"title";s:13:"ETH-USD (low)";s:6:"course";s:5:"199.8";s:4:"code";s:19:"bitstamp_ethusd_low";s:4:"birg";s:15:"bitstamp_ethusd";}i:3071;a:4:{s:5:"title";s:13:"ETH-USD (ask)";s:6:"course";s:6:"200.75";s:4:"code";s:19:"bitstamp_ethusd_ask";s:4:"birg";s:15:"bitstamp_ethusd";}i:3072;a:4:{s:5:"title";s:14:"ETH-USD (open)";s:6:"course";s:6:"200.74";s:4:"code";s:20:"bitstamp_ethusd_open";s:4:"birg";s:15:"bitstamp_ethusd";}i:3073;a:4:{s:5:"title";s:14:"ETH-EUR (high)";s:6:"course";s:6:"177.42";s:4:"code";s:20:"bitstamp_etheur_high";s:4:"birg";s:15:"bitstamp_etheur";}i:3074;a:4:{s:5:"title";s:14:"ETH-EUR (last)";s:6:"course";s:6:"175.99";s:4:"code";s:20:"bitstamp_etheur_last";s:4:"birg";s:15:"bitstamp_etheur";}i:3075;a:4:{s:5:"title";s:13:"ETH-EUR (bid)";s:6:"course";s:6:"176.02";s:4:"code";s:19:"bitstamp_etheur_bid";s:4:"birg";s:15:"bitstamp_etheur";}i:3076;a:4:{s:5:"title";s:14:"ETH-EUR (vwap)";s:6:"course";s:6:"176.23";s:4:"code";s:20:"bitstamp_etheur_vwap";s:4:"birg";s:15:"bitstamp_etheur";}i:3077;a:4:{s:5:"title";s:13:"ETH-EUR (low)";s:6:"course";s:6:"175.42";s:4:"code";s:19:"bitstamp_etheur_low";s:4:"birg";s:15:"bitstamp_etheur";}i:3078;a:4:{s:5:"title";s:13:"ETH-EUR (ask)";s:6:"course";s:5:"176.3";s:4:"code";s:19:"bitstamp_etheur_ask";s:4:"birg";s:15:"bitstamp_etheur";}i:3079;a:4:{s:5:"title";s:14:"ETH-EUR (open)";s:6:"course";s:6:"176.45";s:4:"code";s:20:"bitstamp_etheur_open";s:4:"birg";s:15:"bitstamp_etheur";}i:3080;a:4:{s:5:"title";s:14:"ETH-BTC (high)";s:6:"course";s:10:"0.03143727";s:4:"code";s:20:"bitstamp_ethbtc_high";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3081;a:4:{s:5:"title";s:14:"ETH-BTC (last)";s:6:"course";s:10:"0.03139996";s:4:"code";s:20:"bitstamp_ethbtc_last";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3082;a:4:{s:5:"title";s:13:"ETH-BTC (bid)";s:6:"course";s:10:"0.03132015";s:4:"code";s:19:"bitstamp_ethbtc_bid";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3083;a:4:{s:5:"title";s:14:"ETH-BTC (vwap)";s:6:"course";s:9:"0.0313351";s:4:"code";s:20:"bitstamp_ethbtc_vwap";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3084;a:4:{s:5:"title";s:13:"ETH-BTC (low)";s:6:"course";s:9:"0.0312139";s:4:"code";s:19:"bitstamp_ethbtc_low";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3085;a:4:{s:5:"title";s:13:"ETH-BTC (ask)";s:6:"course";s:6:"0.0314";s:4:"code";s:19:"bitstamp_ethbtc_ask";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3086;a:4:{s:5:"title";s:14:"ETH-BTC (open)";s:6:"course";s:9:"0.0313302";s:4:"code";s:20:"bitstamp_ethbtc_open";s:4:"birg";s:15:"bitstamp_ethbtc";}i:3087;a:4:{s:5:"title";s:14:"BCH-USD (high)";s:6:"course";s:6:"435.76";s:4:"code";s:20:"bitstamp_bchusd_high";s:4:"birg";s:15:"bitstamp_bchusd";}i:3088;a:4:{s:5:"title";s:14:"BCH-USD (last)";s:6:"course";s:6:"432.25";s:4:"code";s:20:"bitstamp_bchusd_last";s:4:"birg";s:15:"bitstamp_bchusd";}i:3089;a:4:{s:5:"title";s:13:"BCH-USD (bid)";s:6:"course";s:6:"432.29";s:4:"code";s:19:"bitstamp_bchusd_bid";s:4:"birg";s:15:"bitstamp_bchusd";}i:3090;a:4:{s:5:"title";s:14:"BCH-USD (vwap)";s:6:"course";s:6:"434.24";s:4:"code";s:20:"bitstamp_bchusd_vwap";s:4:"birg";s:15:"bitstamp_bchusd";}i:3091;a:4:{s:5:"title";s:13:"BCH-USD (low)";s:6:"course";s:3:"432";s:4:"code";s:19:"bitstamp_bchusd_low";s:4:"birg";s:15:"bitstamp_bchusd";}i:3092;a:4:{s:5:"title";s:13:"BCH-USD (ask)";s:6:"course";s:6:"433.59";s:4:"code";s:19:"bitstamp_bchusd_ask";s:4:"birg";s:15:"bitstamp_bchusd";}i:3093;a:4:{s:5:"title";s:14:"BCH-USD (open)";s:6:"course";s:6:"433.87";s:4:"code";s:20:"bitstamp_bchusd_open";s:4:"birg";s:15:"bitstamp_bchusd";}i:3094;a:4:{s:5:"title";s:14:"BCH-EUR (high)";s:6:"course";s:6:"382.88";s:4:"code";s:20:"bitstamp_bcheur_high";s:4:"birg";s:15:"bitstamp_bcheur";}i:3095;a:4:{s:5:"title";s:14:"BCH-EUR (last)";s:6:"course";s:5:"380.3";s:4:"code";s:20:"bitstamp_bcheur_last";s:4:"birg";s:15:"bitstamp_bcheur";}i:3096;a:4:{s:5:"title";s:13:"BCH-EUR (bid)";s:6:"course";s:3:"380";s:4:"code";s:19:"bitstamp_bcheur_bid";s:4:"birg";s:15:"bitstamp_bcheur";}i:3097;a:4:{s:5:"title";s:14:"BCH-EUR (vwap)";s:6:"course";s:6:"381.32";s:4:"code";s:20:"bitstamp_bcheur_vwap";s:4:"birg";s:15:"bitstamp_bcheur";}i:3098;a:4:{s:5:"title";s:13:"BCH-EUR (low)";s:6:"course";s:3:"380";s:4:"code";s:19:"bitstamp_bcheur_low";s:4:"birg";s:15:"bitstamp_bcheur";}i:3099;a:4:{s:5:"title";s:13:"BCH-EUR (ask)";s:6:"course";s:6:"381.43";s:4:"code";s:19:"bitstamp_bcheur_ask";s:4:"birg";s:15:"bitstamp_bcheur";}i:3100;a:4:{s:5:"title";s:14:"BCH-EUR (open)";s:6:"course";s:5:"382.1";s:4:"code";s:20:"bitstamp_bcheur_open";s:4:"birg";s:15:"bitstamp_bcheur";}i:3101;a:4:{s:5:"title";s:14:"BCH-BTC (high)";s:6:"course";s:10:"0.06812254";s:4:"code";s:20:"bitstamp_bchbtc_high";s:4:"birg";s:15:"bitstamp_bchbtc";}i:3102;a:4:{s:5:"title";s:14:"BCH-BTC (last)";s:6:"course";s:10:"0.06764026";s:4:"code";s:20:"bitstamp_bchbtc_last";s:4:"birg";s:15:"bitstamp_bchbtc";}i:3103;a:4:{s:5:"title";s:13:"BCH-BTC (bid)";s:6:"course";s:10:"0.06763751";s:4:"code";s:19:"bitstamp_bchbtc_bid";s:4:"birg";s:15:"bitstamp_bchbtc";}i:3104;a:4:{s:5:"title";s:14:"BCH-BTC (vwap)";s:6:"course";s:10:"0.06789585";s:4:"code";s:20:"bitstamp_bchbtc_vwap";s:4:"birg";s:15:"bitstamp_bchbtc";}i:3105;a:4:{s:5:"title";s:13:"BCH-BTC (low)";s:6:"course";s:10:"0.06764026";s:4:"code";s:19:"bitstamp_bchbtc_low";s:4:"birg";s:15:"bitstamp_bchbtc";}i:3106;a:4:{s:5:"title";s:13:"BCH-BTC (ask)";s:6:"course";s:10:"0.06801674";s:4:"code";s:19:"bitstamp_bchbtc_ask";s:4:"birg";s:15:"bitstamp_bchbtc";}i:3107;a:4:{s:5:"title";s:14:"BCH-BTC (open)";s:6:"course";s:10:"0.06804762";s:4:"code";s:20:"bitstamp_bchbtc_open";s:4:"birg";s:15:"bitstamp_bchbtc";}}', 'yes');
INSERT INTO `pr_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(486, 'time_new_parser', '1540666646', 'yes'),
(490, 'mobile_change', 'a:10:{s:8:"linkhead";i:0;s:5:"phone";s:62:"[ru_RU:]8 800 123 45 67[:ru_RU][en_US:]8 800 123 45 67[:en_US]";s:3:"icq";s:0:"";s:5:"skype";s:46:"[ru_RU:]premium[:ru_RU][en_US:]premium[:en_US]";s:5:"email";s:56:"[ru_RU:]info@premium[:ru_RU][en_US:]info@premium[:en_US]";s:8:"telegram";s:48:"[ru_RU:]@premium[:ru_RU][en_US:]@premium[:en_US]";s:5:"viber";s:0:"";s:7:"whatsup";s:0:"";s:6:"jabber";s:0:"";s:5:"ctext";s:120:"[ru_RU:]Сервис обмена электронных валют.[:ru_RU][en_US:]E-currency exchange service.[:en_US]";}', 'yes'),
(491, 'mho_change', 'a:10:{s:11:"blocreviews";i:1;s:8:"partners";i:1;s:9:"lastobmen";i:1;s:6:"wtitle";s:0:"";s:6:"ititle";s:117:"[ru_RU:]Приветствуем на сайте обменного пункта![:ru_RU][en_US:]Dear guests![:en_US]";s:5:"wtext";s:0:"";s:5:"itext";s:3172:"[ru_RU:]Наш On-line сервис предназначен для тех, кто хочет быстро, безопасно и по выгодному курсу обменять такие виды электронных валют: Webmoney, Perfect Money, Qiwi, PayPal, Яндекс.Деньги, Альфа-Банк, ВТБ 24, Приват24, Visa/Master Card, Western uniоn, MoneyGram.\r\n\r\nЭтим возможности нашего сервиса не ограничиваются. В рамках проекта действуют программа лояльности, накопительная скидка и партнерская программа, воспользовавшись преимуществами которых, вы сможете совершать обмен электронных валют на более выгодных условиях. Для этого нужно просто зарегистрироваться на сайте.\r\n\r\nНаш пункт обмена электронных валют – система, созданная на базе современного программного обеспечения и содержащая весь набор необходимых функций для удобной и безопасной конвертации наиболее распространенных видов электронных денег. За время работы мы приобрели репутацию проверенного партнера и делаем все возможное, чтобы ваши впечатления от нашего сервиса были только благоприятными.[:ru_RU][en_US:]Our website is dedicated to those who wish to exchange own currency in a luxurious way! We welcome you on our grounds and hope that our online service will deliver you the most awesome experience you ever had. Our major point is to provide our clients the safest and quickest method to make transactions using each of the following payment systems: Webmoney, Perfect Money, Qiwi, PayPal, Visa/Master Card, Western uniоn, MoneyGram. \r\n\r\nMoreover, we are also pleased to inform you that here you are to encounter the best rates on the whole net. Be sure to know that we provide much more useful and popular up-to-date services among which you are to encounter affiliate programs and additional discounts as well as loyalty program. All these services will provide you to trade your currency in the most profitable ways and under the best conditions. All you need to do is register on our website and start to burn financial skies.\r\n\r\nAt last, we are pleased to announce you that our exchange system of electronic currencies based on the up-to-date software and willing to provide you with the most awesome functions, you might need for convenient and safest converting any type of electronic currency you possess. Note that our team already gained a reputation as a trusted partner and is well known worldwide. For now, we are willing to do our best for you as well as for your wallet to provide the next-level experience and positive emotions.[:en_US]";s:8:"hidecurr";s:0:"";s:9:"blocknews";i:1;s:7:"catnews";i:0;}', 'yes'),
(501, 'bcbroker', 'a:5:{s:6:"hideid";s:0:"";s:6:"onlyid";s:0:"";s:4:"test";i:0;s:10:"partofrate";i:1;s:10:"conversion";i:1;}', 'yes'),
(537, '_site_transient_timeout_theme_roots', '1541688359', 'no'),
(538, '_site_transient_theme_roots', 'a:1:{s:9:"exchanger";s:7:"/themes";}', 'no'),
(539, '_site_transient_timeout_browser_90ff8ae6231a43c42b418e1765751722', '1542291387', 'no'),
(540, '_site_transient_browser_90ff8ae6231a43c42b418e1765751722', 'a:10:{s:4:"name";s:6:"Chrome";s:7:"version";s:12:"70.0.3538.77";s:8:"platform";s:7:"Windows";s:10:"update_url";s:29:"https://www.google.com/chrome";s:7:"img_src";s:43:"http://s.w.org/images/browsers/chrome.png?1";s:11:"img_src_ssl";s:44:"https://s.w.org/images/browsers/chrome.png?1";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;s:6:"mobile";b:0;}', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_parser_pairs`
--

CREATE TABLE IF NOT EXISTS `pr_parser_pairs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title_pair_give` varchar(150) NOT NULL,
  `title_pair_get` varchar(150) NOT NULL,
  `title_birg` longtext NOT NULL,
  `pair_give` longtext NOT NULL,
  `pair_get` longtext NOT NULL,
  `menu_order` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=883 ;

--
-- Дамп данных таблицы `pr_parser_pairs`
--

INSERT INTO `pr_parser_pairs` (`id`, `title_pair_give`, `title_pair_get`, `title_birg`, `pair_give`, `pair_get`, `menu_order`) VALUES
(661, 'AMD', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_amdrub]', 1),
(662, 'RUB', 'AMD', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_amdrub]', '1', 2),
(663, 'BYN', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_bynrub]', 3),
(664, 'RUB', 'BYN', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_bynrub]', '1', 4),
(665, 'USD', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_usdrub]', 5),
(666, 'RUB', 'USD', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_usdrub]', '1', 6),
(667, 'EUR', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_eurrub]', 7),
(668, 'RUB', 'EUR', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_eurrub]', '1', 8),
(669, 'KZT', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_kztrub]', 9),
(670, 'RUB', 'KZT', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_kztrub]', '1', 10),
(671, 'CNY', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_cnyrub]', 11),
(672, 'RUB', 'CNY', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_cnyrub]', '1', 12),
(673, 'UZS', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_uzsrub]', 13),
(674, 'RUB', 'UZS', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_uzsrub]', '1', 14),
(675, 'UAH', 'RUB', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '1', '[cbr_uahrub]', 15),
(676, 'RUB', 'UAH', '[ru_RU:]CBR.RU[:ru_RU][en_US:]CBR.RU[:en_US]', '[cbr_uahrub]', '1', 16),
(677, 'EUR', 'USD', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '1', '[ecb_eurusd]', 17),
(678, 'USD', 'EUR', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '[ecb_eurusd]', '1', 18),
(679, 'EUR', 'GBP', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '1', '[ecb_eurgbp]', 19),
(680, 'GBP', 'EUR', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '[ecb_eurgbp]', '1', 20),
(681, 'EUR', 'RUB', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '1', '[ecb_eurrub]', 21),
(682, 'RUB', 'EUR', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '[ecb_eurrub]', '1', 22),
(683, 'EUR', 'CNY', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '1', '[ecb_eurcny]', 23),
(684, 'CNY', 'EUR', '[ru_RU:]ECB.EU[:ru_RU][en_US:]ECB.EU[:en_US]', '[ecb_eurcny]', '1', 24),
(685, 'EUR', 'UAH (buy)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '1', '[privatnbu_eur_uah_buy]', 25),
(686, 'UAH', 'EUR (buy)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '[privatnbu_eur_uah_buy]', '1', 26),
(687, 'EUR', 'UAH (sale)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '1', '[privatnbu_eur_uah_sale]', 27),
(688, 'UAH', 'EUR (sale)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '[privatnbu_eur_uah_sale]', '1', 28),
(689, 'RUR', 'UAH (buy)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '1', '[privatnbu_rur_uah_buy]', 29),
(690, 'UAH', 'RUR (buy)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '[privatnbu_rur_uah_buy]', '1', 30),
(691, 'RUR', 'UAH (sale)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '1', '[privatnbu_rur_uah_sale]', 31),
(692, 'UAH', 'RUR (sale)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '[privatnbu_rur_uah_sale]', '1', 32),
(693, 'USD', 'UAH (buy)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '1', '[privatnbu_usd_uah_buy]', 33),
(694, 'UAH', 'USD (buy)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '[privatnbu_usd_uah_buy]', '1', 34),
(695, 'USD', 'UAH (sale)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '1', '[privatnbu_usd_uah_sale]', 35),
(696, 'UAH', 'USD (sale)', '[ru_RU:]NBU[:ru_RU][en_US:]NBU[:en_US]', '[privatnbu_usd_uah_sale]', '1', 36),
(697, 'USD', 'UAH (buy)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '1', '[privat_usd_uah_buy]', 37),
(698, 'UAH', 'USD (buy)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '[privat_usd_uah_buy]', '1', 38),
(699, 'USD', 'UAH (sale)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '1', '[privat_usd_uah_sale]', 39),
(700, 'UAH', 'USD (sale)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '[privat_usd_uah_sale]', '1', 40),
(701, 'EUR', 'UAH (buy)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '1', '[privat_eur_uah_buy]', 41),
(702, 'UAH', 'EUR (buy)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '[privat_eur_uah_buy]', '1', 42),
(703, 'EUR', 'UAH (sale)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '1', '[privat_eur_uah_sale]', 43),
(704, 'UAH', 'EUR (sale)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '[privat_eur_uah_sale]', '1', 44),
(705, 'RUR', 'UAH (buy)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '1', '[privat_rur_uah_buy]', 45),
(706, 'UAH', 'RUR (buy)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '[privat_rur_uah_buy]', '1', 46),
(707, 'RUR', 'UAH (sale)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '1', '[privat_rur_uah_sale]', 47),
(708, 'UAH', 'RUR (sale)', '[ru_RU:]PRIVATBANK.UA[:ru_RU][en_US:]PRIVATBANK.UA[:en_US]', '[privat_rur_uah_sale]', '1', 48),
(709, 'UAH', 'BYN', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '1', '[nbrb_uahbyn]', 49),
(710, 'BYN', 'UAH', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '[nbrb_uahbyn]', '1', 50),
(711, 'USD', 'BYN', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '1', '[nbrb_usdbyn]', 51),
(712, 'BYN', 'USD', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '[nbrb_usdbyn]', '1', 52),
(713, 'EUR', 'BYN', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '1', '[nbrb_eurbyn]', 53),
(714, 'BYN', 'EUR', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '[nbrb_eurbyn]', '1', 54),
(715, 'CNY', 'BYN', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '1', '[nbrb_cnybyn]', 55),
(716, 'BYN', 'CNY', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '[nbrb_cnybyn]', '1', 56),
(717, 'RUB', 'BYN', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '1', '[nbrb_rubbyn]', 57),
(718, 'BYN', 'RUB', '[ru_RU:]NBRB.BY[:ru_RU][en_US:]NBRB.BY[:en_US]', '[nbrb_rubbyn]', '1', 58),
(719, 'USD', 'KZT', '[ru_RU:]NATIONALBANK.KZ[:ru_RU][en_US:]NATIONALBANK.KZ[:en_US]', '1', '[nationalkz_usdkzt]', 59),
(720, 'KZT', 'USD', '[ru_RU:]NATIONALBANK.KZ[:ru_RU][en_US:]NATIONALBANK.KZ[:en_US]', '[nationalkz_usdkzt]', '1', 60),
(721, 'EUR', 'KZT', '[ru_RU:]NATIONALBANK.KZ[:ru_RU][en_US:]NATIONALBANK.KZ[:en_US]', '1', '[nationalkz_eurkzt]', 61),
(722, 'KZT', 'EUR', '[ru_RU:]NATIONALBANK.KZ[:ru_RU][en_US:]NATIONALBANK.KZ[:en_US]', '[nationalkz_eurkzt]', '1', 62),
(723, 'RUB', 'KZT', '[ru_RU:]NATIONALBANK.KZ[:ru_RU][en_US:]NATIONALBANK.KZ[:en_US]', '1', '[nationalkz_rubkzt]', 63),
(724, 'KZT', 'RUB', '[ru_RU:]NATIONALBANK.KZ[:ru_RU][en_US:]NATIONALBANK.KZ[:en_US]', '[nationalkz_rubkzt]', '1', 64),
(725, 'BTC', 'USD (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_btcusd_last]', 65),
(726, 'USD', 'BTC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_btcusd_last]', '1', 66),
(727, 'BTC', 'EUR (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_btceur_last]', 67),
(728, 'EUR', 'BTC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_btceur_last]', '1', 68),
(729, 'LTC', 'USD (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_ltcusd_last]', 69),
(730, 'USD', 'LTC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_ltcusd_last]', '1', 70),
(731, 'LTC', 'EUR (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_ltceur_last]', 71),
(732, 'EUR', 'LTC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_ltceur_last]', '1', 72),
(733, 'ETH', 'USD (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_ethusd_last]', 73),
(734, 'USD', 'ETH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_ethusd_last]', '1', 74),
(735, 'DSH', 'USD (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_dshusd_last]', 75),
(736, 'USD', 'DSH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_dshusd_last]', '1', 76),
(737, 'DSH', 'EUR (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_dsheur_last]', 77),
(738, 'EUR', 'DSH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_dsheur_last]', '1', 78),
(739, 'BCH', 'USD (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_bchusd_last]', 79),
(740, 'USD', 'BCH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_bchusd_last]', '1', 80),
(741, 'BCH', 'EUR (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_bcheur_last]', 81),
(742, 'EUR', 'BCH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_bcheur_last]', '1', 82),
(743, 'BTC', 'RUB (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_btcrur_last]', 83),
(744, 'RUB', 'BTC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_btcrur_last]', '1', 84),
(745, 'LTC', 'RUB (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_ltcrur_last]', 85),
(746, 'RUB', 'LTC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_ltcrur_last]', '1', 86),
(747, 'ETH', 'RUB (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_ethrur_last]', 87),
(748, 'RUB', 'ETH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_ethrur_last]', '1', 88),
(749, 'DSH', 'RUB (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_dshrur_last]', 89),
(750, 'RUB', 'DSH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_dshrur_last]', '1', 90),
(751, 'BCH', 'RUB (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_bchrur_last]', 91),
(752, 'RUB', 'BCH (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_bchrur_last]', '1', 92),
(753, 'ZEC', 'USD (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '1', '[wex_zecusd_last]', 93),
(754, 'USD', 'ZEC (last)', '[ru_RU:]Wex.nz[:ru_RU][en_US:]Wex.nz[:en_US]', '[wex_zecusd_last]', '1', 94),
(755, 'BTC', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_btcusd_last_trade]', 95),
(756, 'USD', 'BTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_btcusd_last_trade]', '1', 96),
(757, 'BTC', 'EUR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_btceur_last_trade]', 97),
(758, 'EUR', 'BTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_btceur_last_trade]', '1', 98),
(759, 'BTC', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_btcrub_last_trade]', 99),
(760, 'RUB', 'BTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_btcrub_last_trade]', '1', 100),
(761, 'BTC', 'UAH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_btcuah_last_trade]', 101),
(762, 'UAH', 'BTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_btcuah_last_trade]', '1', 102),
(763, 'BCH', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_bchusd_last_trade]', 103),
(764, 'USD', 'BCH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_bchusd_last_trade]', '1', 104),
(765, 'BCH', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_bchrub_last_trade]', 105),
(766, 'RUB', 'BCH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_bchrub_last_trade]', '1', 106),
(767, 'DASH', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_dashusd_last_trade]', 107),
(768, 'USD', 'DASH(last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_dashusd_last_trade]', '1', 108),
(769, 'DASH', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_dashrub_last_trade]', 109),
(770, 'RUB', 'DASH(last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_dashrub_last_trade]', '1', 110),
(771, 'ETH', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_ethusd_last_trade]', 111),
(772, 'USD', 'ETH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_ethusd_last_trade]', '1', 112),
(773, 'ETH', 'EUR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_etheur_last_trade]', 113),
(774, 'EUR', 'ETH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_etheur_last_trade]', '1', 114),
(775, 'ETH', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_ethrub_last_trade]', 115),
(776, 'RUB', 'ETH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_ethrub_last_trade]', '1', 116),
(777, 'ETH', 'UAH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_ethuah_last_trade]', 117),
(778, 'UAH', 'ETH (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_ethuah_last_trade]', '1', 118),
(779, 'ETC', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_etcusd_last_trade]', 119),
(780, 'USD', 'ETC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_etcusd_last_trade]', '1', 120),
(781, 'ETC', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_etcrub_last_trade]', 121),
(782, 'RUB', 'ETC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_etcrub_last_trade]', '1', 122),
(783, 'LTC', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_ltcusd_last_trade]', 123),
(784, 'USD', 'LTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_ltcusd_last_trade]', '1', 124),
(785, 'LTC', 'EUR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_ltceur_last_trade]', 125),
(786, 'EUR', 'LTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_ltceur_last_trade]', '1', 126),
(787, 'LTC', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_ltcrub_last_trade]', 127),
(788, 'RUB', 'LTC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_ltcrub_last_trade]', '1', 128),
(789, 'ZEC', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_zecusd_last_trade]', 129),
(790, 'USD', 'ZEC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_zecusd_last_trade]', '1', 130),
(791, 'ZEC', 'EUR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_zeceur_last_trade]', 131),
(792, 'EUR', 'ZEC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_zeceur_last_trade]', '1', 132),
(793, 'ZEC', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_zecrub_last_trade]', 133),
(794, 'RUB', 'ZEC (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_zecrub_last_trade]', '1', 134),
(795, 'XRP', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_xrpusd_last_trade]', 135),
(796, 'USD', 'XRP (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_xrpusd_last_trade]', '1', 136),
(797, 'XRP', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_xrprub_last_trade]', 137),
(798, 'RUB', 'XRP (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_xrprub_last_trade]', '1', 138),
(799, 'XMR', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_xmrusd_last_trade]', 139),
(800, 'USD', 'XMR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_xmrusd_last_trade]', '1', 140),
(801, 'XMR', 'EUR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_xmreur_last_trade]', 141),
(802, 'EUR', 'XMR (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_xmreur_last_trade]', '1', 142),
(803, 'USD', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_usdrub_last_trade]', 143),
(804, 'RUB', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_usdrub_last_trade]', '1', 144),
(805, 'WAVES', 'RUB (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_wavesrub_last_trade]', 145),
(806, 'RUB', 'WAVES (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_wavesrub_last_trade]', '1', 146),
(807, 'BTC', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_btcusd_last_price]', 149),
(808, 'USD', 'BTC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_btcusd_last_price]', '1', 150),
(809, 'BTC', 'EUR (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_btceur_last_price]', 151),
(810, 'EUR', 'BTC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_btceur_last_price]', '1', 152),
(811, 'LTC', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_ltcusd_last_price]', 155),
(812, 'USD', 'LTC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_ltcusd_last_price]', '1', 156),
(813, 'ETH', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_ethusd_last_price]', 159),
(814, 'USD', 'ETH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_ethusd_last_price]', '1', 160),
(815, 'ETH', 'EUR (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_etheur_last_price]', 161),
(816, 'EUR', 'ETH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_etheur_last_price]', '1', 162),
(817, 'ETC', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_etcusd_last_price]', 165),
(818, 'USD', 'ETC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_etcusd_last_price]', '1', 166),
(819, 'DSH', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_dshusd_last_price]', 167),
(820, 'USD', 'DSH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_dshusd_last_price]', '1', 168),
(821, 'ZEC', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_zecusd_last_price]', 171),
(822, 'USD', 'ZEC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_zecusd_last_price]', '1', 172),
(823, 'XMR', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_xmrusd_last_price]', 175),
(824, 'USD', 'XMR (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_xmrusd_last_price]', '1', 176),
(825, 'XRP', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_xrpusd_last_price]', 179),
(826, 'USD', 'XRP (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_xrpusd_last_price]', '1', 180),
(827, 'BCH', 'USD (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[bitfinex_bchusd_last_price]', 183),
(828, 'USD', 'BCH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[bitfinex_bchusd_last_price]', '1', 184),
(829, 'BTC', 'USD (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_btcusd_last]', 187),
(830, 'USD', 'BTC (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_btcusd_last]', '1', 188),
(831, 'BTC', 'EUR (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_btceur_last]', 189),
(832, 'EUR', 'BTC (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_btceur_last]', '1', 190),
(833, 'EUR', 'USD (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_eurusd_last]', 191),
(834, 'USD', 'EUR (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_eurusd_last]', '1', 192),
(835, 'XRP', 'USD (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_xrpusd_last]', 193),
(836, 'USD', 'XRP (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_xrpusd_last]', '1', 194),
(837, 'LTC', 'USD (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_ltcusd_last]', 195),
(838, 'USD', 'LTC (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_ltcusd_last]', '1', 196),
(839, 'LTC', 'EUR (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_ltceur_last]', 197),
(840, 'EUR', 'LTC (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_ltceur_last]', '1', 198),
(841, 'ETH', 'USD (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_ethusd_last]', 199),
(842, 'USD', 'ETH (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_ethusd_last]', '1', 200),
(843, 'ETH', 'EUR (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_etheur_last]', 201),
(844, 'EUR', 'ETH (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_etheur_last]', '1', 202),
(845, 'BCH', 'USD (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_bchusd_last]', 203),
(846, 'USD', 'BCH (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_bchusd_last]', '1', 204),
(847, 'BCH', 'EUR (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '1', '[bitstamp_bcheur_last]', 205),
(848, 'EUR', 'BCH (last)', '[ru_RU:]Bitstamp.net[:ru_RU][en_US:]Bitstamp.net[:en_US]', '[bitstamp_bcheur_last]', '1', 206),
(849, 'BTC', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_btcusdt]', 207),
(850, 'USDT', 'BTC', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_btcusdt]', '1', 208),
(851, 'ETH', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_ethusdt]', 209),
(852, 'USDT', 'ETH', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_ethusdt]', '1', 210),
(853, 'BCC', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_bccusdt]', 211),
(854, 'USDT', 'BCC', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_bccusdt]', '1', 212),
(855, 'NEO', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_neousdt]', 213),
(856, 'USDT', 'NEO', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_neousdt]', '1', 214),
(857, 'LTC', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_ltcusdt]', 215),
(858, 'USDT', 'LTC', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_ltcusdt]', '1', 216),
(859, 'XRP', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_xrpusdt]', 217),
(860, 'USDT', 'XRP', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_xrpusdt]', '1', 218),
(861, 'ETC', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_etcusdt]', 219),
(862, 'USDT', 'ETC', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_etcusdt]', '1', 220),
(863, 'EOS', 'USDT', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '1', '[binance_eosusdt]', 221),
(864, 'USDT', 'EOS', '[ru_RU:]Binance.com[:ru_RU][en_US:]Binance.com[:en_US]', '[binance_eosusdt]', '1', 222),
(865, 'BTC', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_btcusd_last_price]', 153),
(866, 'ETH', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_ethusd_last_price]', 163),
(867, 'LTC', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_ltcusd_last_price]', 157),
(868, 'RUB', 'BTC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_btcusd_last_price]', '1', 154),
(869, 'RUB', 'LTC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_ltcusd_last_price]', '1', 158),
(870, 'RUB', 'ETH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_ethusd_last_price]', '1', 164),
(871, 'DSH', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_dshusd_last_price]', 169),
(872, 'RUB', 'DSH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_dshusd_last_price]', '1', 170),
(873, 'ZEC', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_zecusd_last_price]', 173),
(874, 'RUB', 'ZEC (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_zecusd_last_price]', '1', 174),
(875, 'XMR', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_xmrusd_last_price]', 177),
(876, 'RUB', 'XMR (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_xmrusd_last_price]', '1', 178),
(877, 'XRP', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_xrpusd_last_price]', 181),
(878, 'RUB', 'XRP (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_xrpusd_last_price]', '1', 182),
(879, 'BCH', 'RUB (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '1', '[cbr_usdrub] * [bitfinex_bchusd_last_price]', 185),
(880, 'RUB', 'BCH (last_price)', '[ru_RU:]Bitfinex.com[:ru_RU][en_US:]Bitfinex.com[:en_US]', '[cbr_usdrub] * [bitfinex_bchusd_last_price]', '1', 186),
(881, 'WAVES', 'USD (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '1', '[exmo_wavesrub_last_trade] / [cbr_usdrub]', 147),
(882, 'USD', 'WAVES (last_trade)', '[ru_RU:]Exmo.me[:ru_RU][en_US:]Exmo.me[:en_US]', '[exmo_wavesrub_last_trade] / [cbr_usdrub]', '1', 148);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_partners`
--

CREATE TABLE IF NOT EXISTS `pr_partners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `link` tinytext NOT NULL,
  `img` longtext NOT NULL,
  `site_order` bigint(20) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pr_partners`
--

INSERT INTO `pr_partners` (`id`, `title`, `link`, `img`, `site_order`, `status`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`) VALUES
(1, '[en_US:]Bitcoin[:en_US][ru_RU:]Bitcoin[:ru_RU]', '#', '/wp-content/uploads/bitcoin-bottom.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, '[en_US:]Okpay[:en_US][ru_RU:]Okpay[:ru_RU]', '#', '/wp-content/uploads/okpay-bottom.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(3, '[en_US:]Perfect Money[:en_US][ru_RU:]Perfect Money[:ru_RU]', '#', '/wp-content/uploads/pm-bottom.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(4, '[en_US:]Solidtrustpay[:en_US][ru_RU:]Solidtrustpay[:ru_RU]', '#', '/wp-content/uploads/stp-bottom.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(5, '[en_US:]Yandex.Money[:en_US][ru_RU:]Яндекс.Деньги[:ru_RU]', '#', '/wp-content/uploads/ya-bottom.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(6, '[en_US:]Webmoney[:en_US][ru_RU:]Webmoney[:ru_RU]', '#', '/wp-content/uploads/wm-botton.png', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_partner_pers`
--

CREATE TABLE IF NOT EXISTS `pr_partner_pers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sumec` varchar(50) NOT NULL DEFAULT '0',
  `pers` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pr_partner_pers`
--

INSERT INTO `pr_partner_pers` (`id`, `sumec`, `pers`) VALUES
(1, '0', '0.1'),
(2, '500', '0.2'),
(3, '5000', '0.3'),
(4, '10000', '0.4'),
(5, '15000', '0.5');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_paymerchant_logs`
--

CREATE TABLE IF NOT EXISTS `pr_paymerchant_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  `mdata` longtext NOT NULL,
  `merchant` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_plinks`
--

CREATE TABLE IF NOT EXISTS `pr_plinks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `pdate` datetime NOT NULL,
  `pbrowser` longtext NOT NULL,
  `pip` longtext NOT NULL,
  `prefer` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_pn_options`
--

CREATE TABLE IF NOT EXISTS `pr_pn_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(250) NOT NULL,
  `meta_key2` varchar(250) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_key` (`meta_key`),
  KEY `meta_key2` (`meta_key2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=231 ;

--
-- Дамп данных таблицы `pr_pn_options`
--

INSERT INTO `pr_pn_options` (`id`, `meta_key`, `meta_key2`, `meta_value`) VALUES
(1, 'up_mode', '', '0'),
(2, 'admin_panel_captcha', '', '1'),
(3, 'wchecks', '', '1'),
(4, 'cron', '', '0'),
(5, 'admincaptcha', '', '0'),
(6, 'lang_redir', '', '1'),
(7, 'admin_panel_url', '', 'prmmxchngr'),
(8, 'txtxml', 'txt', '1'),
(9, 'txtxml', 'xml', '1'),
(10, 'txtxml', 'numtxt', '12'),
(11, 'txtxml', 'numxml', '12'),
(12, 'htmlmap', 'exclude_page', 'a:26:{i:0;i:213;i:1;i:206;i:2;i:200;i:3;i:183;i:4;i:182;i:5;i:181;i:6;i:136;i:7;i:90;i:8;i:85;i:9;i:29;i:10;i:28;i:11;i:27;i:12;i:26;i:13;i:25;i:14;i:24;i:15;i:21;i:16;i:20;i:17;i:19;i:18;i:15;i:19;i:14;i:20;i:13;i:21;i:12;i:22;i:11;i:23;i:8;i:24;i:7;i:25;i:6;}'),
(13, 'htmlmap', 'exchanges', '1'),
(14, 'htmlmap', 'pages', '1'),
(15, 'htmlmap', 'news', '1'),
(16, 'exchange', 'techregtext', ''),
(17, 'exchange', 'techreg', '0'),
(18, 'exchange', 'gostnaphide', '0'),
(19, 'exchange', 'tablevid', '3'),
(20, 'exchange', 'exch_method', '0'),
(21, 'exchange', 'tablenot', '0'),
(22, 'exchange', 'reserv', '1'),
(23, 'exchange', 'flysum', '1'),
(24, 'exchange', 'redirect', '1'),
(25, 'exchange', 'autodelete', '1'),
(26, 'exchange', 'ad_h', '1'),
(27, 'exchange', 'ad_m', ''),
(28, 'exchange', 'exch_exsum', '1'),
(29, 'exchange', 'auto_reg', '1'),
(30, 'exchange', 'an1_hidden', '0'),
(31, 'exchange', 'an2_hidden', '0'),
(32, 'operator', '', '0'),
(33, 'statuswork', 'location', '1'),
(34, 'statuswork', 'text0', '[ru_RU:]Оператор offline[:ru_RU][en_US:]Operator offline[:en_US]'),
(35, 'statuswork', 'text1', '[ru_RU:]Оператор online[:ru_RU][en_US:]Operator online[:en_US]'),
(36, 'seo', 'home_title', '[ru_RU:]Обменный пункт электронных валют[:ru_RU][en_US:]Electronic currencies exchanger[:en_US]'),
(37, 'seo', 'home_key', ''),
(38, 'seo', 'home_descr', ''),
(39, 'seo', 'news_title', ''),
(40, 'seo', 'news_key', ''),
(41, 'seo', 'news_descr', ''),
(42, 'seo', 'news_temp', ''),
(43, 'seo', 'page_temp', ''),
(44, 'seo', 'exch_temp', ''),
(45, 'seo', 'exch_temp2', ''),
(46, 'seo', 'ogp_home_title', ''),
(47, 'seo', 'ogp_home_descr', ''),
(48, 'seo', 'ogp_news_title', ''),
(49, 'seo', 'ogp_news_descr', ''),
(50, 'seo', 'ogp_home_img', ''),
(51, 'seo', 'ogp_news_img', ''),
(52, 'reviews', 'count', '10'),
(53, 'reviews', 'deduce', '0'),
(54, 'reviews', 'method', 'moderation'),
(55, 'reviews', 'website', '0'),
(56, 'partners', 'status', '1'),
(57, 'partners', 'calc', '0'),
(58, 'partners', 'reserv', '1'),
(59, 'partners', 'minpay', '10'),
(60, 'naps_temp', 'description_txt', '[ru_RU:]Для обмена Вам необходимо выполнить несколько шагов:\r\n<ol>\r\n	<li>Заполните все поля представленной формы. Нажмите кнопку «Обменять».</li>\r\n	<li>Ознакомьтесь с условиями договора на оказание услуг обмена, если вы принимаете их, поставьте галочку в соответствующем поле и нажмите кнопку «Создать заявку».</li>\r\n	<li>Оплатите заявку.  Для этого следует совершить перевод необходимой суммы, следуя инструкциям на нашем сайте.</li>\r\n	<li>После выполнения указанных действий, система переместит Вас на страницу «Состояние заявки», где будет указан статус вашего перевода.</li>\r\n</ol>[:ru_RU][en_US:]For exchange you need to follow a few steps:\r\n<ol>\r\n	<li>Fill in all the fields of the form submitted. Click «Exchange».</li>\r\n	<li>Read the terms of the agreement on exchange services, when accepting it, please tick the appropriate field and press the button «Create bid».</li>\r\n	<li>Pay for the bid. To do this, transfer the necessary amount, following the instructions on our website.</li>\r\n	<li>After this is done, the system will redirect you to the «Order status» page, where the status of your transferwill be shown.</li>\r\n</ol>[:en_US]'),
(61, 'naps_temp', 'timeline_txt', '[ru_RU:]Данная операция производится в автоматическом режиме.[:ru_RU][en_US:]This operation is performed automatically.[:en_US]'),
(62, 'naps_temp', 'status_new', '[ru_RU:]<ol>\r\n 	<li>Авторизуйтесь в платежной системе XXXXXXX;</li>\r\n 	<li>Переведите указанную ниже сумму на кошелек XXXXXXX;</li>\r\n 	<li>Нажмите на кнопку "Я оплатил заявку";</li>\r\n 	<li>Ожидайте обработку заявки оператором.</li>\r\n</ol>[:ru_RU][en_US:]<ol>\r\n 	<li> <span style="line-height: 1.5;">Log in to the system XXXXXXX;</span></li>\r\n 	<li>Turn the amounts shown below on the wallet XXXXXXX;</li>\r\n 	<li>Click on the "I paid bid";</li>\r\n 	<li>Expect the processing of the application by the operator.</li>\r\n</ol>[:en_US]'),
(63, 'naps_temp', 'status_cancel', '[ru_RU:]Оплата по заявке была возвращена на ваш кошелек.[:ru_RU][en_US:]Payment on the bid has been returned to your wallet.[:en_US]'),
(64, 'naps_temp', 'status_delete', '[ru_RU:]Заявка была удалена.[:ru_RU][en_US:]Bid has been deleted.[:en_US]'),
(65, 'naps_temp', 'status_payed', '[ru_RU:]Подтверждение оплаты принято.\r\nВаша заявка обрабатывается оператором.[:ru_RU][en_US:]Confirmation of payment accepted.\r\nYour request is being processed by the operator.[:en_US]'),
(66, 'naps_temp', 'status_realpay', '[ru_RU:]Подтверждение оплаты принято.\r\nВаша заявка обрабатывается оператором.[:ru_RU][en_US:]Confirmation of payment accepted.\r\nYour request is being processed by the operator.[:en_US]'),
(67, 'naps_temp', 'status_verify', '[ru_RU:]Подтверждение оплаты принято.\r\nВаша заявка обрабатывается оператором.[:ru_RU][en_US:]Confirmation of payment accepted.\r\nYour request is being processed by the operator.[:en_US]'),
(68, 'naps_temp', 'status_error', '[ru_RU:]В заявке есть ошибки. Обратитесь в техническую поддержку.[:ru_RU][en_US:]In the bid there is an error. Please contact technical support.[:en_US]'),
(69, 'naps_temp', 'status_success', '[ru_RU:]Ваша заявка выполнена.\r\nБлагодарим за то, что воспользовались услугами нашего сервиса.\r\nОставьте, пожалуйста, <a href="/reviews/">отзыв</a> о работе нашего сервиса![:ru_RU][en_US:]Your application is complete.\r\nThank you for using the services of our service.\r\nPlease leave <a href="/reviews/">review</a> review of the work of our service![:en_US]'),
(70, 'favicon', '', '/wp-content/uploads/favicon.png'),
(71, 'logo', '', ''),
(72, 'robotstxt', 'txt', ''),
(73, 'exchange', 'adjust', '0'),
(74, 'autodel', 'enable', '1'),
(75, 'ga', 'admin_time', '60'),
(76, 'ga', 'site_time', '60'),
(77, 'exchange', 'beautynum', '0'),
(78, 'exchange', 'admin_mail', '1'),
(79, 'exchange', 'rateconv', '0'),
(80, 'naps_title', 'status_coldpay', ''),
(81, 'naps_status', 'status_coldpay', ''),
(82, 'naps_timer', 'status_coldpay', '1'),
(83, 'naps_temp', 'status_coldpay', '[ru_RU:]Ожидаем подтверждения оплаты от платежной системы. Это может занять некоторое время.[:ru_RU][en_US:]Waiting for payment confirmation from payment system. This may take some time.[:en_US]'),
(84, 'naps_title', 'status_coldsuccess', ''),
(85, 'naps_status', 'status_coldsuccess', ''),
(86, 'naps_timer', 'status_coldsuccess', '1'),
(87, 'naps_temp', 'status_coldsuccess', '[ru_RU:]Ожидаем подтверждения статуса транзакции от платежной системы. Это может занять некоторое время.[:ru_RU][en_US:]Waiting for transaction status from payment system. This may take some time.[:en_US]'),
(88, 'partners', 'wref', '0'),
(89, 'textlogo', '', ''),
(90, 'exchange', 'calctype', '1'),
(91, 'exchange', 'allow_dev', '0'),
(92, 'partners', 'clife', '0'),
(93, 'partners', 'pages', 'a:8:{i:0;s:8:"paccount";i:1;s:11:"promotional";i:2;s:6:"plinks";i:3;s:5:"pexch";i:4;s:9:"preferals";i:5;s:7:"payouts";i:6;s:11:"partnersfaq";i:7;s:5:"terms";}'),
(94, 'ga', 'ga_admin', '1'),
(95, 'ga', 'ga_site', '1'),
(96, 'apbytime', 'meneger', 'a:5:{s:6:"status";i:0;s:2:"h1";s:2:"00";s:2:"h2";s:2:"00";s:2:"m1";s:2:"00";s:2:"m2";s:2:"00";}'),
(97, 'adminpass', '', '0'),
(98, 'autodel', 'ad_h', '0'),
(99, 'autodel', 'ad_m', '15'),
(100, 'naps_title', 'status_techpay', ''),
(101, 'naps_status', 'status_techpay', ''),
(102, 'naps_timer', 'status_techpay', '1'),
(103, 'naps_temp', 'status_techpay', '[ru_RU:]Заявка находится в процессе оплаты.[:ru_RU][en_US:]Bid is in the payment process.[:en_US]'),
(104, 'operworks', 'minuts', '0'),
(105, 'xmlmap', 'exclude_page', 'a:22:{i:0;i:136;i:1;i:90;i:2;i:85;i:3;i:79;i:4;i:29;i:5;i:28;i:6;i:27;i:7;i:26;i:8;i:25;i:9;i:24;i:10;i:23;i:11;i:21;i:12;i:20;i:13;i:19;i:14;i:15;i:15;i:14;i:16;i:13;i:17;i:12;i:18;i:11;i:19;i:8;i:20;i:7;i:21;i:6;}'),
(106, 'xmlmap', 'exchanges', '1'),
(107, 'xmlmap', 'pages', '1'),
(108, 'xmlmap', 'news', '1'),
(109, 'nocopydata', '', '1'),
(110, 'exchange', 'mini_navi', '0'),
(111, 'exchange', 'mhead_style', '0'),
(112, 'exchange', 'm_ins', '0'),
(113, 'exchange', 'mp_ins', '0'),
(114, 'exchange', 'currtable', '0'),
(115, 'currtable', 'v1', '0'),
(116, 'currtable', 'v2', '0'),
(117, 'numsybm_count', '', '10'),
(118, 'user_fields', '', 'a:8:{s:5:"login";i:1;s:9:"last_name";i:1;s:10:"first_name";i:1;s:11:"second_name";i:1;s:10:"user_phone";i:1;s:10:"user_skype";i:1;s:7:"website";i:0;s:13:"user_passport";i:1;}'),
(119, 'user_fields_change', '', 'a:8:{s:9:"last_name";i:1;s:10:"first_name";i:1;s:11:"second_name";i:1;s:10:"user_phone";i:1;s:10:"user_skype";i:1;s:7:"website";i:1;s:13:"user_passport";i:1;s:5:"email";i:1;}'),
(120, 'tech', 'maintrance', '0'),
(121, 'tech', 'manualy', '0'),
(122, 'exchange', 'tableselect', '1'),
(123, 'exchange', 'ipuserhash', '1'),
(124, 'exchange', 'bacc_admin', '0'),
(125, 'exchange', 'bacc_site', '0'),
(126, 'exchange', 'maxsymb_all', '10'),
(127, 'exchange', 'maxsymb_reserv', '10'),
(128, 'exchange', 'maxsymb_course', '10'),
(129, 'exchange', 'maxpaybutton', '3'),
(130, 'naps_title', 'status_new', ''),
(131, 'naps_status', 'status_new', ''),
(132, 'naps_timer', 'status_new', '1'),
(133, 'naps_nodescr', 'status_new', '0'),
(134, 'usve', 'acc_status', '1'),
(135, 'mobile', 'tablevid', '0'),
(136, 'mobile', 'currtable', '0'),
(137, 'currtable', 'mob_v1', '0'),
(138, 'currtable', 'mob_v2', '0'),
(139, 'naps_title', 'status_payouterror', ''),
(140, 'naps_status', 'status_payouterror', ''),
(141, 'naps_timer', 'status_payouterror', '1'),
(142, 'naps_temp', 'status_payouterror', '[ru_RU:]Ошибка автоматической выплаты. Обратитесь в техническую поддержку сайта.[:ru_RU][en_US:]Automatic payout error. Contact technical support.[:en_US]'),
(143, 'naps_nodescr', 'status_payouterror', '0'),
(144, 'naps_title', 'status_cancel', ''),
(145, 'naps_status', 'status_cancel', ''),
(146, 'naps_timer', 'status_cancel', '1'),
(147, 'naps_nodescr', 'status_cancel', '0'),
(148, 'naps_title', 'status_delete', ''),
(149, 'naps_status', 'status_delete', ''),
(150, 'naps_timer', 'status_delete', '1'),
(151, 'naps_nodescr', 'status_delete', '0'),
(152, 'naps_nodescr', 'status_techpay', '0'),
(153, 'naps_title', 'status_payed', ''),
(154, 'naps_status', 'status_payed', ''),
(155, 'naps_timer', 'status_payed', '1'),
(156, 'naps_nodescr', 'status_payed', '0'),
(157, 'naps_nodescr', 'status_coldpay', '0'),
(158, 'naps_title', 'status_realpay', ''),
(159, 'naps_status', 'status_realpay', ''),
(160, 'naps_timer', 'status_realpay', '1'),
(161, 'naps_nodescr', 'status_realpay', '0'),
(162, 'naps_title', 'status_verify', ''),
(163, 'naps_status', 'status_verify', ''),
(164, 'naps_timer', 'status_verify', '1'),
(165, 'naps_nodescr', 'status_verify', '0'),
(166, 'naps_title', 'status_error', ''),
(167, 'naps_status', 'status_error', ''),
(168, 'naps_timer', 'status_error', '1'),
(169, 'naps_nodescr', 'status_error', '0'),
(170, 'naps_nodescr', 'status_coldsuccess', '0'),
(171, 'naps_title', 'status_success', ''),
(172, 'naps_status', 'status_success', ''),
(173, 'naps_timer', 'status_success', '1'),
(174, 'naps_nodescr', 'status_success', '0'),
(175, 'usve', 'disable_mtype_check', '1'),
(176, 'exchange', 'enable_step2', '1'),
(177, 'exchange', 'avsumbig', '1'),
(178, 'blacklist', 'check', 'a:6:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";}'),
(179, 'exchange', 'hidecurrtype', '0'),
(180, 'archivebids', 'txt', '1'),
(181, 'archivebids', 'loadhistory', '1'),
(182, 'autodel', 'statused', 'a:1:{i:0;s:3:"new";}'),
(183, 'exchange', 'tableajax', '1'),
(184, 'exchange', 'tableicon', '0'),
(185, 'iconbar', 'pp_user_payouts', '1'),
(186, 'iconbar', 'reviews', '1'),
(187, 'iconbar', 'verify_bids', '1'),
(188, 'iconbar', 'uv_wallets', '1'),
(189, 'iconbar', 'zreserv', '1'),
(190, 'pincode', '', '0'),
(191, 'site_captcha', '', '1'),
(192, 'admin', 'w0', '0'),
(193, 'admin', 'w1', '0'),
(194, 'admin', 'w2', '0'),
(195, 'admin', 'w3', '0'),
(196, 'admin', 'w4', '0'),
(197, 'admin', 'w5', '0'),
(198, 'admin', 'w6', '0'),
(199, 'admin', 'w7', '0'),
(200, 'admin', 'w8', '0'),
(201, 'admin', 'ws0', '0'),
(202, 'admin', 'ws1', '0'),
(203, 'admin', 'wm0', '1'),
(204, 'admin', 'wm1', '1'),
(205, 'admin', 'wm2', '0'),
(206, 'mobilelogo', '', ''),
(207, 'mobiletextlogo', '', ''),
(208, 'usve', 'wallet_new_account', '1'),
(209, 'usve', 'delete_verify_wallets', '1'),
(210, 'archivebids', 'limit_archive', '5'),
(211, 'logssettings', 'delete_autologs_day', '15'),
(212, 'logssettings', 'delete_auto_bids', '5'),
(213, 'logssettings', 'del_apbd_day', '15'),
(214, 'logssettings', 'archive_bids_day', '60'),
(215, 'logssettings', 'delete_bcclogs_day', '15'),
(216, 'logssettings', 'delete_bidlogs_day', '15'),
(217, 'logssettings', 'delete_paymerchantlogs_day', '15'),
(218, 'logssettings', 'archive_plinks_day', '15'),
(219, 'naps_title', 'description_txt', ''),
(220, 'naps_status', 'description_txt', ''),
(221, 'naps_timer', 'description_txt', '0'),
(222, 'naps_nodescr', 'description_txt', '0'),
(223, 'naps_ap_instruction', 'description_txt', '0'),
(224, 'naps_title', 'timeline_txt', ''),
(225, 'naps_status', 'timeline_txt', ''),
(226, 'naps_timer', 'timeline_txt', '0'),
(227, 'naps_nodescr', 'timeline_txt', '0'),
(228, 'naps_ap_instruction', 'timeline_txt', '0'),
(229, 'newparser', 'parser', '1'),
(230, 'newparser', 'parser_log', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_postmeta`
--

CREATE TABLE IF NOT EXISTS `pr_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=684 ;

--
-- Дамп данных таблицы `pr_postmeta`
--

INSERT INTO `pr_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(2, 4, '_wp_page_template', 'pn-homepage.php'),
(3, 11, '_wp_page_template', 'pn-pluginpage.php'),
(4, 12, '_wp_page_template', 'pn-whitepage.php'),
(5, 13, '_wp_page_template', 'pn-pluginpage.php'),
(6, 14, '_wp_page_template', 'pn-pluginpage.php'),
(7, 15, '_wp_page_template', 'pn-pluginpage.php'),
(8, 16, '_wp_page_template', 'pn-pluginpage.php'),
(9, 17, '_wp_page_template', 'pn-pluginpage.php'),
(10, 18, '_wp_page_template', 'pn-pluginpage.php'),
(11, 19, '_wp_page_template', 'pn-pluginpage.php'),
(12, 20, '_wp_page_template', 'pn-pluginpage.php'),
(13, 21, '_wp_page_template', 'pn-pluginpage.php'),
(16, 24, '_wp_page_template', 'pn-pluginpage.php'),
(17, 25, '_wp_page_template', 'pn-pluginpage.php'),
(18, 26, '_wp_page_template', 'pn-pluginpage.php'),
(19, 27, '_wp_page_template', 'pn-pluginpage.php'),
(20, 28, '_wp_page_template', 'pn-pluginpage.php'),
(21, 29, '_wp_page_template', 'pn-pluginpage.php'),
(22, 30, '_menu_item_type', 'post_type'),
(23, 30, '_menu_item_menu_item_parent', '0'),
(24, 30, '_menu_item_object_id', '4'),
(25, 30, '_menu_item_object', 'page'),
(26, 30, '_menu_item_target', ''),
(27, 30, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(28, 30, '_menu_item_xfn', ''),
(29, 30, '_menu_item_url', ''),
(31, 31, '_menu_item_type', 'post_type'),
(32, 31, '_menu_item_menu_item_parent', '0'),
(33, 31, '_menu_item_object_id', '10'),
(34, 31, '_menu_item_object', 'page'),
(35, 31, '_menu_item_target', ''),
(36, 31, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(37, 31, '_menu_item_xfn', ''),
(38, 31, '_menu_item_url', ''),
(40, 32, '_menu_item_type', 'post_type'),
(41, 32, '_menu_item_menu_item_parent', '0'),
(42, 32, '_menu_item_object_id', '5'),
(43, 32, '_menu_item_object', 'page'),
(44, 32, '_menu_item_target', ''),
(45, 32, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(46, 32, '_menu_item_xfn', ''),
(47, 32, '_menu_item_url', ''),
(49, 33, '_menu_item_type', 'post_type'),
(50, 33, '_menu_item_menu_item_parent', '0'),
(51, 33, '_menu_item_object_id', '18'),
(52, 33, '_menu_item_object', 'page'),
(53, 33, '_menu_item_target', ''),
(54, 33, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(55, 33, '_menu_item_xfn', ''),
(56, 33, '_menu_item_url', ''),
(58, 34, '_menu_item_type', 'post_type'),
(59, 34, '_menu_item_menu_item_parent', '0'),
(60, 34, '_menu_item_object_id', '17'),
(61, 34, '_menu_item_object', 'page'),
(62, 34, '_menu_item_target', ''),
(63, 34, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(64, 34, '_menu_item_xfn', ''),
(65, 34, '_menu_item_url', ''),
(67, 35, '_menu_item_type', 'post_type'),
(68, 35, '_menu_item_menu_item_parent', '0'),
(69, 35, '_menu_item_object_id', '16'),
(70, 35, '_menu_item_object', 'page'),
(71, 35, '_menu_item_target', ''),
(72, 35, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(73, 35, '_menu_item_xfn', ''),
(74, 35, '_menu_item_url', ''),
(76, 36, '_menu_item_type', 'post_type'),
(77, 36, '_menu_item_menu_item_parent', '0'),
(78, 36, '_menu_item_object_id', '7'),
(79, 36, '_menu_item_object', 'page'),
(80, 36, '_menu_item_target', ''),
(81, 36, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(82, 36, '_menu_item_xfn', ''),
(83, 36, '_menu_item_url', ''),
(94, 38, '_edit_last', '1'),
(96, 38, 'seo_title', ''),
(97, 38, 'seo_key', ''),
(98, 38, 'seo_descr', ''),
(99, 38, 'ogp_title', ''),
(100, 38, 'ogp_descr', ''),
(101, 38, '_edit_lock', '1481443290:1'),
(102, 8, '_edit_lock', '1445588870:1'),
(103, 8, '_edit_last', '1'),
(104, 8, '_wp_page_template', 'default'),
(105, 8, 'seo_title', ''),
(106, 8, 'seo_key', ''),
(107, 8, 'seo_descr', ''),
(108, 8, 'ogp_title', ''),
(109, 8, 'ogp_descr', ''),
(110, 6, '_edit_lock', '1460208649:1'),
(111, 6, '_edit_last', '1'),
(112, 6, '_wp_page_template', 'pn-whitepage.php'),
(113, 6, 'seo_title', ''),
(114, 6, 'seo_key', ''),
(115, 6, 'seo_descr', ''),
(116, 6, 'ogp_title', ''),
(117, 6, 'ogp_descr', ''),
(118, 7, '_edit_lock', '1460208650:1'),
(119, 7, '_edit_last', '1'),
(120, 7, '_wp_page_template', 'pn-whitepage.php'),
(121, 7, 'seo_title', ''),
(122, 7, 'seo_key', ''),
(123, 7, 'seo_descr', ''),
(124, 7, 'ogp_title', ''),
(125, 7, 'ogp_descr', ''),
(126, 12, '_edit_lock', '1460208577:1'),
(127, 12, '_edit_last', '1'),
(128, 12, 'seo_title', ''),
(129, 12, 'seo_key', ''),
(130, 12, 'seo_descr', ''),
(131, 12, 'ogp_title', ''),
(132, 12, 'ogp_descr', ''),
(133, 11, '_edit_lock', '1445768110:1'),
(134, 16, '_edit_lock', '1445768193:1'),
(135, 11, '_edit_last', '1'),
(136, 11, 'seo_title', ''),
(137, 11, 'seo_key', ''),
(138, 11, 'seo_descr', ''),
(139, 11, 'ogp_title', ''),
(140, 11, 'ogp_descr', ''),
(141, 21, '_edit_lock', '1445768164:1'),
(142, 19, '_edit_lock', '1445768166:1'),
(143, 20, '_edit_lock', '1445768185:1'),
(144, 13, '_edit_lock', '1445768187:1'),
(145, 29, '_edit_lock', '1445768189:1'),
(146, 4, '_edit_lock', '1445768191:1'),
(147, 10, '_edit_lock', '1445768194:1'),
(148, 10, '_edit_last', '1'),
(149, 10, '_wp_page_template', 'default'),
(150, 10, 'seo_title', ''),
(151, 10, 'seo_key', ''),
(152, 10, 'seo_descr', ''),
(153, 10, 'ogp_title', ''),
(154, 10, 'ogp_descr', ''),
(155, 16, '_edit_last', '1'),
(156, 16, 'seo_title', ''),
(157, 16, 'seo_key', ''),
(158, 16, 'seo_descr', ''),
(159, 16, 'ogp_title', ''),
(160, 16, 'ogp_descr', ''),
(161, 4, '_edit_last', '1'),
(162, 4, 'seo_title', ''),
(163, 4, 'seo_key', ''),
(164, 4, 'seo_descr', ''),
(165, 4, 'ogp_title', ''),
(166, 4, 'ogp_descr', ''),
(167, 29, '_edit_last', '1'),
(168, 29, 'seo_title', ''),
(169, 29, 'seo_key', ''),
(170, 29, 'seo_descr', ''),
(171, 29, 'ogp_title', ''),
(172, 29, 'ogp_descr', ''),
(173, 13, '_edit_last', '1'),
(174, 13, 'seo_title', ''),
(175, 13, 'seo_key', ''),
(176, 13, 'seo_descr', ''),
(177, 13, 'ogp_title', ''),
(178, 13, 'ogp_descr', ''),
(179, 20, '_edit_last', '1'),
(180, 20, 'seo_title', ''),
(181, 20, 'seo_key', ''),
(182, 20, 'seo_descr', ''),
(183, 20, 'ogp_title', ''),
(184, 20, 'ogp_descr', ''),
(185, 19, '_edit_last', '1'),
(186, 19, 'seo_title', ''),
(187, 19, 'seo_key', ''),
(188, 19, 'seo_descr', ''),
(189, 19, 'ogp_title', ''),
(190, 19, 'ogp_descr', ''),
(191, 21, '_edit_last', '1'),
(192, 21, 'seo_title', ''),
(193, 21, 'seo_key', ''),
(194, 21, 'seo_descr', ''),
(195, 21, 'ogp_title', ''),
(196, 21, 'ogp_descr', ''),
(197, 14, '_edit_lock', '1445768196:1'),
(198, 15, '_edit_lock', '1445768198:1'),
(199, 5, '_edit_lock', '1445589805:1'),
(202, 18, '_edit_lock', '1445589832:1'),
(203, 26, '_edit_lock', '1445589871:1'),
(204, 27, '_edit_lock', '1445589887:1'),
(205, 24, '_edit_lock', '1445589908:1'),
(206, 25, '_edit_lock', '1445589934:1'),
(207, 28, '_edit_lock', '1445589953:1'),
(208, 17, '_edit_lock', '1445589956:1'),
(209, 14, '_edit_last', '1'),
(210, 14, 'seo_title', ''),
(211, 14, 'seo_key', ''),
(212, 14, 'seo_descr', ''),
(213, 14, 'ogp_title', ''),
(214, 14, 'ogp_descr', ''),
(215, 15, '_edit_last', '1'),
(216, 15, 'seo_title', ''),
(217, 15, 'seo_key', ''),
(218, 15, 'seo_descr', ''),
(219, 15, 'ogp_title', ''),
(220, 15, 'ogp_descr', ''),
(221, 5, '_edit_last', '1'),
(222, 5, 'seo_title', ''),
(223, 5, 'seo_key', ''),
(224, 5, 'seo_descr', ''),
(225, 5, 'ogp_title', ''),
(226, 5, 'ogp_descr', ''),
(239, 18, '_edit_last', '1'),
(240, 18, 'seo_title', ''),
(241, 18, 'seo_key', ''),
(242, 18, 'seo_descr', ''),
(243, 18, 'ogp_title', ''),
(244, 18, 'ogp_descr', ''),
(245, 26, '_edit_last', '1'),
(246, 26, 'seo_title', ''),
(247, 26, 'seo_key', ''),
(248, 26, 'seo_descr', ''),
(249, 26, 'ogp_title', ''),
(250, 26, 'ogp_descr', ''),
(251, 27, '_edit_last', '1'),
(252, 27, 'seo_title', ''),
(253, 27, 'seo_key', ''),
(254, 27, 'seo_descr', ''),
(255, 27, 'ogp_title', ''),
(256, 27, 'ogp_descr', ''),
(257, 24, '_edit_last', '1'),
(258, 24, 'seo_title', ''),
(259, 24, 'seo_key', ''),
(260, 24, 'seo_descr', ''),
(261, 24, 'ogp_title', ''),
(262, 24, 'ogp_descr', ''),
(263, 25, '_edit_last', '1'),
(264, 25, 'seo_title', ''),
(265, 25, 'seo_key', ''),
(266, 25, 'seo_descr', ''),
(267, 25, 'ogp_title', ''),
(268, 25, 'ogp_descr', ''),
(269, 28, '_edit_last', '1'),
(270, 28, 'seo_title', ''),
(271, 28, 'seo_key', ''),
(272, 28, 'seo_descr', ''),
(273, 28, 'ogp_title', ''),
(274, 28, 'ogp_descr', ''),
(275, 17, '_edit_last', '1'),
(276, 17, 'seo_title', ''),
(277, 17, 'seo_key', ''),
(278, 17, 'seo_descr', ''),
(279, 17, 'ogp_title', ''),
(280, 17, 'ogp_descr', ''),
(281, 77, '_menu_item_type', 'post_type'),
(282, 77, '_menu_item_menu_item_parent', '0'),
(283, 77, '_menu_item_object_id', '6'),
(284, 77, '_menu_item_object', 'page'),
(285, 77, '_menu_item_target', ''),
(286, 77, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(287, 77, '_menu_item_xfn', ''),
(288, 77, '_menu_item_url', ''),
(291, 85, '_wp_page_template', 'pn-pluginpage.php'),
(292, 90, '_wp_page_template', 'pn-pluginpage.php'),
(293, 90, '_edit_lock', '1500728642:1'),
(295, 85, '_edit_lock', '1456238988:1'),
(296, 90, '_edit_last', '1'),
(297, 90, 'seo_title', ''),
(298, 90, 'seo_key', ''),
(299, 90, 'seo_descr', ''),
(300, 90, 'ogp_title', ''),
(301, 90, 'ogp_descr', ''),
(308, 85, '_edit_last', '1'),
(309, 85, 'seo_title', ''),
(310, 85, 'seo_key', ''),
(311, 85, 'seo_descr', ''),
(312, 85, 'ogp_title', ''),
(313, 85, 'ogp_descr', ''),
(321, 96, '_wp_attached_file', 'Advcash.png'),
(322, 96, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:11:"Advcash.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(323, 97, '_wp_attached_file', 'Alfabank.png'),
(324, 97, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Alfabank.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(325, 98, '_wp_attached_file', 'Bitcoin.png'),
(326, 98, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:11:"Bitcoin.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(331, 101, '_wp_attached_file', 'Liqpay.png'),
(332, 101, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Liqpay.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(333, 102, '_wp_attached_file', 'Litecoin.png'),
(334, 102, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Litecoin.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(335, 103, '_wp_attached_file', 'Livecoin.png'),
(336, 103, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Livecoin.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(337, 104, '_wp_attached_file', 'NixMoney.png'),
(338, 104, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"NixMoney.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(343, 107, '_wp_attached_file', 'Paxum.png'),
(344, 107, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:9:"Paxum.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(345, 108, '_wp_attached_file', 'Payeer.png'),
(346, 108, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Payeer.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(347, 109, '_wp_attached_file', 'Paymer.png'),
(348, 109, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Paymer.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(349, 110, '_wp_attached_file', 'Paypal.png'),
(350, 110, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Paypal.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(351, 111, '_wp_attached_file', 'Payza.png'),
(352, 111, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:9:"Payza.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(353, 112, '_wp_attached_file', 'Perfect-Money.png'),
(354, 112, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:17:"Perfect-Money.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(355, 113, '_wp_attached_file', 'Privatbank.png'),
(356, 113, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:14:"Privatbank.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(357, 114, '_wp_attached_file', 'Qiwi.png'),
(358, 114, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:8:"Qiwi.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(359, 115, '_wp_attached_file', 'Sberbank.png'),
(360, 115, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Sberbank.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(361, 116, '_wp_attached_file', 'Skrill.png'),
(362, 116, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Skrill.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(363, 117, '_wp_attached_file', 'SolidTrustPay.png'),
(364, 117, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:17:"SolidTrustPay.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(365, 118, '_wp_attached_file', 'Tinkoff.png'),
(366, 118, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:11:"Tinkoff.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(367, 119, '_wp_attached_file', 'Visa-MasterCard.png'),
(368, 119, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:19:"Visa-MasterCard.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(369, 120, '_wp_attached_file', 'WebMoney.png'),
(370, 120, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"WebMoney.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(373, 122, '_wp_attached_file', 'Yandex.png'),
(374, 122, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Yandex.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(377, 124, '_wp_attached_file', 'favicon.png'),
(378, 124, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:54;s:6:"height";i:38;s:4:"file";s:11:"favicon.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(379, 125, '_wp_attached_file', 'bitcoin-bottom.png'),
(380, 125, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:88;s:6:"height";i:31;s:4:"file";s:18:"bitcoin-bottom.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(381, 126, '_wp_attached_file', 'okpay-bottom.png'),
(382, 126, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:88;s:6:"height";i:31;s:4:"file";s:16:"okpay-bottom.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(383, 127, '_wp_attached_file', 'pm-bottom.png'),
(384, 127, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:88;s:6:"height";i:31;s:4:"file";s:13:"pm-bottom.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(385, 128, '_wp_attached_file', 'stp-bottom.png'),
(386, 128, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:88;s:6:"height";i:31;s:4:"file";s:14:"stp-bottom.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(387, 129, '_wp_attached_file', 'wm-botton.png'),
(388, 129, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:88;s:6:"height";i:31;s:4:"file";s:13:"wm-botton.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(389, 130, '_wp_attached_file', 'ya-bottom.png'),
(390, 130, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:88;s:6:"height";i:31;s:4:"file";s:13:"ya-bottom.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(393, 136, '_wp_page_template', 'pn-pluginpage.php'),
(394, 136, '_edit_lock', '1456238927:1'),
(395, 136, '_edit_last', '1'),
(396, 136, 'seo_title', ''),
(397, 136, 'seo_key', ''),
(398, 136, 'seo_descr', ''),
(399, 136, 'ogp_title', ''),
(400, 136, 'ogp_descr', ''),
(402, 139, '_wp_attached_file', 'exmo.png'),
(403, 139, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:8:"exmo.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(405, 143, '_wp_attached_file', 'Alipay.png'),
(406, 143, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"Alipay.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(416, 148, '_menu_item_type', 'post_type'),
(417, 148, '_menu_item_menu_item_parent', '0'),
(418, 148, '_menu_item_object_id', '4'),
(419, 148, '_menu_item_object', 'page'),
(420, 148, '_menu_item_target', ''),
(421, 148, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(422, 148, '_menu_item_xfn', ''),
(423, 148, '_menu_item_url', ''),
(425, 149, '_menu_item_type', 'post_type'),
(426, 149, '_menu_item_menu_item_parent', '0'),
(427, 149, '_menu_item_object_id', '11'),
(428, 149, '_menu_item_object', 'page'),
(429, 149, '_menu_item_target', ''),
(430, 149, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(431, 149, '_menu_item_xfn', ''),
(432, 149, '_menu_item_url', ''),
(434, 150, '_menu_item_type', 'post_type'),
(435, 150, '_menu_item_menu_item_parent', '0'),
(436, 150, '_menu_item_object_id', '21'),
(437, 150, '_menu_item_object', 'page'),
(438, 150, '_menu_item_target', ''),
(439, 150, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(440, 150, '_menu_item_xfn', ''),
(441, 150, '_menu_item_url', ''),
(443, 151, '_menu_item_type', 'post_type'),
(444, 151, '_menu_item_menu_item_parent', '0'),
(445, 151, '_menu_item_object_id', '19'),
(446, 151, '_menu_item_object', 'page'),
(447, 151, '_menu_item_target', ''),
(448, 151, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(449, 151, '_menu_item_xfn', ''),
(450, 151, '_menu_item_url', ''),
(452, 152, '_menu_item_type', 'post_type'),
(453, 152, '_menu_item_menu_item_parent', '0'),
(454, 152, '_menu_item_object_id', '16'),
(455, 152, '_menu_item_object', 'page'),
(456, 152, '_menu_item_target', ''),
(457, 152, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(458, 152, '_menu_item_xfn', ''),
(459, 152, '_menu_item_url', ''),
(461, 153, '_menu_item_type', 'post_type'),
(462, 153, '_menu_item_menu_item_parent', '0'),
(463, 153, '_menu_item_object_id', '10'),
(464, 153, '_menu_item_object', 'page'),
(465, 153, '_menu_item_target', ''),
(466, 153, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(467, 153, '_menu_item_xfn', ''),
(468, 153, '_menu_item_url', ''),
(470, 154, '_menu_item_type', 'post_type'),
(471, 154, '_menu_item_menu_item_parent', '0'),
(472, 154, '_menu_item_object_id', '14'),
(473, 154, '_menu_item_object', 'page'),
(474, 154, '_menu_item_target', ''),
(475, 154, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(476, 154, '_menu_item_xfn', ''),
(477, 154, '_menu_item_url', ''),
(479, 155, '_menu_item_type', 'post_type'),
(480, 155, '_menu_item_menu_item_parent', '0'),
(481, 155, '_menu_item_object_id', '15'),
(482, 155, '_menu_item_object', 'page'),
(483, 155, '_menu_item_target', ''),
(484, 155, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(485, 155, '_menu_item_xfn', ''),
(486, 155, '_menu_item_url', ''),
(488, 156, '_menu_item_type', 'post_type'),
(489, 156, '_menu_item_menu_item_parent', '0'),
(490, 156, '_menu_item_object_id', '5'),
(491, 156, '_menu_item_object', 'page'),
(492, 156, '_menu_item_target', ''),
(493, 156, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(494, 156, '_menu_item_xfn', ''),
(495, 156, '_menu_item_url', ''),
(497, 157, '_menu_item_type', 'post_type'),
(498, 157, '_menu_item_menu_item_parent', '0'),
(499, 157, '_menu_item_object_id', '18'),
(500, 157, '_menu_item_object', 'page'),
(501, 157, '_menu_item_target', ''),
(502, 157, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(503, 157, '_menu_item_xfn', ''),
(504, 157, '_menu_item_url', ''),
(506, 158, '_menu_item_type', 'post_type'),
(507, 158, '_menu_item_menu_item_parent', '0'),
(508, 158, '_menu_item_object_id', '26'),
(509, 158, '_menu_item_object', 'page'),
(510, 158, '_menu_item_target', ''),
(511, 158, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(512, 158, '_menu_item_xfn', ''),
(513, 158, '_menu_item_url', ''),
(515, 159, '_menu_item_type', 'post_type'),
(516, 159, '_menu_item_menu_item_parent', '0'),
(517, 159, '_menu_item_object_id', '27'),
(518, 159, '_menu_item_object', 'page'),
(519, 159, '_menu_item_target', ''),
(520, 159, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(521, 159, '_menu_item_xfn', ''),
(522, 159, '_menu_item_url', ''),
(524, 160, '_menu_item_type', 'post_type'),
(525, 160, '_menu_item_menu_item_parent', '0'),
(526, 160, '_menu_item_object_id', '8'),
(527, 160, '_menu_item_object', 'page'),
(528, 160, '_menu_item_target', ''),
(529, 160, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(530, 160, '_menu_item_xfn', ''),
(531, 160, '_menu_item_url', ''),
(533, 161, '_menu_item_type', 'post_type'),
(534, 161, '_menu_item_menu_item_parent', '0'),
(535, 161, '_menu_item_object_id', '24'),
(536, 161, '_menu_item_object', 'page'),
(537, 161, '_menu_item_target', ''),
(538, 161, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(539, 161, '_menu_item_xfn', ''),
(540, 161, '_menu_item_url', ''),
(542, 162, '_menu_item_type', 'post_type'),
(543, 162, '_menu_item_menu_item_parent', '0'),
(544, 162, '_menu_item_object_id', '6'),
(545, 162, '_menu_item_object', 'page'),
(546, 162, '_menu_item_target', ''),
(547, 162, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(548, 162, '_menu_item_xfn', ''),
(549, 162, '_menu_item_url', ''),
(551, 163, '_menu_item_type', 'post_type'),
(552, 163, '_menu_item_menu_item_parent', '0'),
(553, 163, '_menu_item_object_id', '12'),
(554, 163, '_menu_item_object', 'page'),
(555, 163, '_menu_item_target', ''),
(556, 163, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(557, 163, '_menu_item_xfn', ''),
(558, 163, '_menu_item_url', ''),
(560, 164, '_menu_item_type', 'post_type'),
(561, 164, '_menu_item_menu_item_parent', '0'),
(562, 164, '_menu_item_object_id', '25'),
(563, 164, '_menu_item_object', 'page'),
(564, 164, '_menu_item_target', ''),
(565, 164, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(566, 164, '_menu_item_xfn', ''),
(567, 164, '_menu_item_url', ''),
(569, 165, '_menu_item_type', 'post_type'),
(570, 165, '_menu_item_menu_item_parent', '0'),
(571, 165, '_menu_item_object_id', '28'),
(572, 165, '_menu_item_object', 'page'),
(573, 165, '_menu_item_target', ''),
(574, 165, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(575, 165, '_menu_item_xfn', ''),
(576, 165, '_menu_item_url', ''),
(578, 166, '_menu_item_type', 'post_type'),
(579, 166, '_menu_item_menu_item_parent', '0'),
(580, 166, '_menu_item_object_id', '17'),
(581, 166, '_menu_item_object', 'page'),
(582, 166, '_menu_item_target', ''),
(583, 166, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),
(584, 166, '_menu_item_xfn', ''),
(585, 166, '_menu_item_url', ''),
(586, 170, '_wp_attached_file', 'Avangardbank.png'),
(587, 170, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:16:"Avangardbank.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(588, 171, '_wp_attached_file', 'Bank-perevod.png'),
(589, 171, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:16:"Bank-perevod.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(590, 172, '_wp_attached_file', 'Cash-EUR.png'),
(591, 172, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Cash-EUR.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(592, 173, '_wp_attached_file', 'Cash-RUB.png'),
(593, 173, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Cash-RUB.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(594, 174, '_wp_attached_file', 'Cash-USD.png'),
(595, 174, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"Cash-USD.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(596, 175, '_wp_attached_file', 'PMe-voucher.png'),
(597, 175, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:15:"PMe-voucher.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(598, 176, '_wp_attached_file', 'Promsvyazbank.png'),
(599, 176, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:17:"Promsvyazbank.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(600, 177, '_wp_attached_file', 'Russstandart.png'),
(601, 177, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:16:"Russstandart.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(602, 178, '_wp_attached_file', 'VTB24.png'),
(603, 178, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:9:"VTB24.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(605, 181, '_wp_page_template', 'pn-pluginpage.php'),
(606, 182, '_wp_page_template', 'pn-pluginpage.php'),
(607, 183, '_wp_page_template', 'pn-pluginpage.php'),
(636, 182, '_edit_lock', '1501585406:1'),
(637, 183, '_edit_lock', '1501585391:1'),
(638, 183, '_edit_last', '1'),
(639, 183, 'seo_title', ''),
(640, 183, 'seo_key', ''),
(641, 183, 'seo_descr', ''),
(642, 183, 'ogp_title', ''),
(643, 183, 'ogp_descr', ''),
(644, 182, '_edit_last', '1'),
(645, 182, 'seo_title', ''),
(646, 182, 'seo_key', ''),
(647, 182, 'seo_descr', ''),
(648, 182, 'ogp_title', ''),
(649, 182, 'ogp_descr', ''),
(653, 206, '_wp_page_template', 'pn-pluginpage.php'),
(656, 211, '_wp_attached_file', 'wex.png'),
(657, 211, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:7:"wex.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(658, 215, '_wp_attached_file', 'bitcoincash.png'),
(659, 215, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:15:"bitcoincash.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(660, 216, '_wp_attached_file', 'dash.png'),
(661, 216, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:8:"dash.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(662, 217, '_wp_attached_file', 'ether.png'),
(663, 217, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:9:"ether.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(664, 218, '_wp_attached_file', 'monero.png'),
(665, 218, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"monero.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(668, 220, '_wp_attached_file', 'wawes.png'),
(669, 220, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:9:"wawes.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(670, 221, '_wp_attached_file', 'zcash.png'),
(671, 221, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:9:"zcash.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(672, 222, '_wp_attached_file', 'ripple.png'),
(673, 222, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:10:"ripple.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(674, 225, '_wp_attached_file', 'Cardano.png'),
(675, 225, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:11:"Cardano.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(676, 226, '_wp_attached_file', 'DigiByte.png'),
(677, 226, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:12:"DigiByte.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(678, 227, '_wp_attached_file', 'EOS.png'),
(679, 227, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:7:"EOS.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(680, 228, '_wp_attached_file', 'Ethereum-Classic.png'),
(681, 228, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:20:"Ethereum-Classic.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}'),
(682, 229, '_wp_attached_file', 'Stellar.png'),
(683, 229, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:50;s:6:"height";i:50;s:4:"file";s:11:"Stellar.png";s:5:"sizes";a:0:{}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_posts`
--

CREATE TABLE IF NOT EXISTS `pr_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=231 ;

--
-- Дамп данных таблицы `pr_posts`
--

INSERT INTO `pr_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(4, 1, '2015-10-22 17:31:49', '2015-10-22 14:31:49', '', '[ru_RU:]Главная[:ru_RU][en_US:]Home[:en_US]', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2015-10-23 11:30:56', '2015-10-23 08:30:56', '', 0, 'http://premiumexchanger.ru/home/', 0, 'page', '', 0),
(5, 1, '2015-10-22 17:31:49', '2015-10-22 14:31:49', '', '[ru_RU:]Новости[:ru_RU][en_US:]News[:en_US]', '', 'publish', 'closed', 'closed', '', 'news', '', '', '2015-10-23 11:45:41', '2015-10-23 08:45:41', '', 0, 'http://premiumexchanger.ru/news/', 0, 'page', '', 0),
(6, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:]<strong>1. Стороны соглашения.</strong>\r\n\r\nДоговор заключается между интернет сервисом по обмену титульных знаков, далее Исполнитель, — с одной стороны, и Заказчик, в лице того, кто воспользовался услугами Исполнителя, — с другой стороны.\r\n\r\n<strong>2. Список терминов.</strong>\r\n\r\n2.1. Обмен титульных знаков — автоматизированный продукт интернет обслуживания, который предоставляется Исполнителем на основании данных правил.\r\n2.2. Заказчик — физическое лицо, соглашающееся с условиями Исполнителя и данного соглашения, к которому присоединяется.\r\n2.3. Титульный знак — условная единица той или иной платежной системы, которая соответствует расчетам электронных систем и обозначает объем прав, соответствующих договору системы электронной оплаты и ее Заказчика.\r\n2.4. Заявка — сведения, переданные Заказчиком для использования средств Исполнителя в электронном виде и свидетельствующие о том, что он принимает условия пользования сервисом, которые предлагаются Исполнителем в данной заявке.\r\n\r\n<strong>3. Условия соглашения.</strong>\r\n\r\nДанные правила считаются организованными за счет условий общественной оферты, которая образуется во время подачи Заказчиком заявки и является одной из главных составляющих настоящего договора. Общественной офертой именуются отображаемые исполнителем сведения об условиях подачи заявки. Главным составляющим общественной оферты являются действия, сделанные в завершении подачи заявки Заказчиком и говорящие о его точных намерениях совершить сделку на условиях предложенных Исполнителем перед завершением данной заявки. Время, дата, и параметры заявки создаются Исполнителем автоматически в момент окончания формирования данной заявки. Предложение должно приняться Заказчиком в течение 24 часов от окончания формирования заявки. Договор по обслуживанию вступает в силу с момента поступления титульных знаков в полном размере, указанном в заявке, от Заказчика на реквизиты Исполнителя. Операции с титульными знаками учитываются согласно правилам, регламенту и формату электронных систем по расчетам. Договор действителен в течение срока , который устанавливается с момента подачи заявки до расторжения по инициативе одной из сторон.\r\n\r\n<strong>4. Предмет соглашения.</strong>\r\n\r\nПутем использования технических методов Исполнитель обязуется выполнять обмен титульных знаков за комиссионное вознаграждение от Заказчика, после подачи данным лицом заявки и совершает это путем продажи титульных знаков лицам, желающим их приобрести по сумме, указанной не ниже, чем в заявке поданной Заказчиком. Денежные средства Исполнитель обязуется переводить на указанные Заказчиком реквизиты. В случае возникновения во время обмена прибыли, она остается на счету Исполнителя, как дополнительная выгода и премия за комиссионные услуги.\r\n\r\n<strong>5. В дополнение.</strong>\r\n\r\n5.1. Если на счет Исполнителя поступает сумма, отличающаяся от указанной в заявке, Исполнитель делает перерасчет, который соответствует фактическому поступлению титульных знаков. Если данная сумма превышает указанную в заявке более чем на 10%, Исполнитель расторгает договор в одностороннем порядке и все средства возвращаются на реквизиты Заказчика, с учетом вычтенной суммы на комиссионные расходы во время перевода.\r\n5.2. В случае, когда титульные знаки не отправляются Исполнителем на указанные реквизиты Заказчика в течение 24 часов, Заказчик имеет полное право потребовать расторжение соглашения и аннулировать свою заявку, тем самым совершая возврат титульных знаков на свой счет в полном объеме. Заявка на расторжение соглашения и возврата титульных знаков выполняется Исполнителем в том случае, если денежные средства еще не были переведены на указанные реквизиты Заказчика. В случае аннулирования договора, возврат электронной валюты производится в течение 24 часов с момента получения требовании о расторжении договора. Если задержки при возврате возникли не по вине Исполнителя, он не несет за них ответственности.\r\n5.3. Если титульные знаки не поступаеют от Заказчика на счет Исполнителя в течение указанного срока, с момента подачи заявки Заказчиком, соглашение между сторонами расторгается Исполнителем с одной стороны, так как договор не вступает в действие. Заказчик может об этом не уведомляться. Если титульные знаки поступает на реквизиты Исполнителя после указанного срока, то такие средства переводятся обратно на счет Заказчика, причем все комиссионные расходы, связанные с переводом, вычитаются из данных средств.\r\n5.4. Если происходит задержка перевода средств на реквизиты, указанные Заказчиком, по вине расчетной системы, Исполнитель не несет ответственности за ущерб, возникающий в результате долгого поступления денежных средств. В этом случае Заказчик должен согласиться с тем, что все претензии будут предъявляться к расчетной системе, а Исполнитель оказывает свою помощь по мере своих возможностей в рамках закона.\r\n5.5. В случае обнаружения подделки коммуникационных потоков или оказания воздействия, с целью ухудшить работу Исполнителя, а именно его программного кода, заявка приостанавливается, а переведенные средства подвергаются перерасчету в соответствии с действующим соглашением. Если Заказчик не согласен с перерасчетом, он имеет полное право расторгнуть договор и титульные знаки отправятся на реквизиты указанные Заказчиком.\r\n5.6. В случае пользования услугами Исполнителя, Заказчик полностью соглашается с тем, что Исполнитель несет ограниченную ответственность соответствующую рамкам настоящих правил полученных титульных знаков и не дает дополнительных гарантий Заказчику, а также не несет перед ним дополнительной ответственности. Соответственно Заказчик  не несет дополнительной ответственности перед Исполнителем.\r\n5.7. Заказчик обязуется выполнять нормы соответствующие законодательству, а также не подделывать коммуникационные потоки и не создавать препятствий для нормальной работы программного кода Исполнителя.\r\n5.8.Исполнитель не несет ответственности за ущерб и последствия при ошибочном переводе электронной валюты в том случае, если Заказчик указал при подаче заявки неверные реквизиты.\r\n\r\n<strong>6. Гарантийный срок</strong>\r\n\r\nВ течение 24 часов с момента исполнения обмена титульных знаков Исполнитель дает гарантию на оказываемые услуги при условии, если не оговорены иные сроки.\r\n\r\n<strong>7. Непредвиденные обстоятельства.</strong>\r\n\r\nВ случае, когда в процессе обработки заявки Заказчика возникают непредвиденные обстоятельства, способствующие невыполнению Исполнителем условий договора, сроки выполнения заявки переносятся на соответствующий срок длительности форс-мажора. За просроченные обязательства Исполнитель ответственности не несет.\r\n\r\n<strong>8. Форма соглашения.</strong>\r\n\r\nДанное соглашение обе стороны, в лице Исполнителя и Заказчика, принимают как равноценный по юридической силе договор, обозначенный в письменной форме.\r\n\r\n<strong>9. Работа с картами Англии, Германии и США.</strong>\r\n\r\nДля владельцев карт стран Англии, Германии и США условия перевода титульных знаков продляются на неопределенный срок, соответствующий полной проверке данных владельца карты. Денежные средства в течение всего срока не подвергаются никаким операциям и в полном размере находятся на счете Исполнителя.\r\n\r\n<strong>10 Претензии и споры.</strong>\r\n\r\nПретензии по настоящему соглашению принимаются Исполнителем в форме электронного письма, в котором Заказчик указывает суть претензии. Данное письмо отправляется на указанные на сайте реквизиты Исполнителя.\r\n\r\n<strong>11. Проведение обменных операций.</strong>\r\n\r\n11.1.Категорически запрещается пользоваться услугами Исполнителя для проведения незаконных переводов и мошеннических действий. При заключении настоящего договора, Заказчик обязуется выполнять эти требования и в случае мошенничества нести уголовную ответственность, установленную законодательством на данный момент.\r\n11.2. В случае невозможности выполнения заявки автоматически, по не зависящим от Исполнителя обстоятельствам, таким как отсутствие связи, нехватка средств, или же ошибочные данные Заказчика, средства поступают на счет в течение последующих 24 часов или же возвращается на реквизиты Заказчика за вычетом комиссионных расходов.\r\n11.3.По первому требованию Исполнитель вправе передавать информацию о переводе электронной валюты правоохранительным органам, администрации расчетных систем, а также жертвам неправомерных действий, пострадавшим в результате доказанного судебными органами мошенничества.\r\n11.4. Заказчик обязуется представить все документы, удостоверяющие его личность, в случае подозрения о мошенничестве и отмывании денег.\r\n11.5. Заказчик обязуется не вмешиваться в работу Исполнителя и не наносить урон его программной и аппаратной части, а также Заказчик обязуется передавать точные сведения для обеспечения выполнения Исполнителем всех условий договора.\r\n\r\n<strong>12.Отказ от обязательств.</strong>\r\n\r\nИсполнитель имеет право отказа на заключение договора и выполнение заявки, причем без объяснения причин. Данный пункт применяется по отношению к любому клиенту.[:ru_RU][en_US:]<strong>1. Parties to the agreement.</strong>\r\n\r\nThe Agreement is concluded between the online service for the exchange of digital currency, hereinafter referred to as the Contractor - for one part, and the Customer, represented by a person who used the services of the Contractor, - for the other part.\r\n\r\n<strong>2. List of terms.</strong>\r\n\r\n2.1. Digital Currency Exchange - automated product of the online service, which is provided by the Contractor under these rules.\r\n\r\n2.2. Customer - a natural person, agreeing to the terms of the Contractor and this agreement that it enters into.\r\n\r\n2.3. Digital currency - a standard unit of a particular payment system, which corresponds to the calculations of electronic systems and indicates the scope of rights corresponding to a specific agreement on electronic payment system and its Customer.\r\n\r\n2.4. Application - information transmitted by the Customer for use of the Contractor''s funds in electronic form and indicating that he accepts the terms of use of the service offered by the Contractor herein.\r\n\r\n<strong>3. Terms and conditions of the agreement.</strong>\r\n\r\nThese rules are considered to be subject to the conditions of the public offer, which enters into force at the time of submission of an application by the Customer and is one of the main components of this agreement. The information about the conditions of application submission specified by the Contractor, is a Public offer. The main part of a public offer are actions made in the completion of the application submission by the Customer showing his exact intentions to make a transaction on the terms proposed by the Contractor before the end of this application. Time, date, and parameters of the application are created automatically by the Contractor by the end of application submission. The proposal should be accepted by the Customer within 24 hours before the end of formation of the application. Service agreement comes into force from the moment of receipt of digital currency in the full amount specified in the application, from the Customer according to the details set forth by the Contractor. Transactions with digital currency are accounted according to the rules, regulations and format of electronic payment systems/ The agreement is valid for a period which is set from the date of submitting the application and continued until terminated by either party.\r\n\r\n<strong>4. Matter of the agreement.</strong>\r\n\r\nUsing technical methods, the Contractor undertakes to perform digital currency exchange for a commission from the Customer, after the submitting the application by this person, and makes it through the sale of digital currency to persons wishing to purchase it for the money amount which is not lower than that in the application submitted by the Customer. The Contractor undertakes to transfer money according to the details specified by the Customer. In case when a profit occurs at the time of exchange, it remains on the account of the Contractor, as an additional benefit and a premium for commission services.\r\n\r\n<strong>5. Additional provisions.</strong>\r\n\r\n5.1. If the Contractor receives an amount on its account that differs from that indicated in the application, the Contractor makes a resettlement, which corresponds to the actual receipt of digital currency. Should this amount exceed the amount specified in the application for more than 10%, the Contractor terminates the contract unilaterally and all funds are returned to the Customer''s details, taking into account the amount deducted for commission expenses during the transfer.\r\n\r\n5.2. Should the digital currency not be sent by the Contractor to the specified details of the Customer within 24 hours, the Customer has the full right to demand the termination of the agreement and cancel the application, thereby making the return of digital currency on its account in full. Application for termination of the agreement and return of digital currency is performed by the Contractor in the event that the money has not yet been transferred according to the details of the Customer. In case of terminating the agreement, the return of e-currencies is made within 24 hours of receipt of the application for termination of the agreement. If a delay in the return occurred through no fault of the Contractor, it will not take responsibility for it.\r\n\r\n5.3. If no digital currency arrives from the Customer to the Contractor within the specified period from the date of submitting the application by the Customer, the agreement between the parties shall be terminated by the Contractor unilaterally, since the agreement does not enter into force. There may be no notice about it sent to the Customer. Shall no digital currency arrive to the details of the Contractor after the deadline, then such funds are transferred back to the account of the Customer, and all commission expenses associated with the transfer are deducted from that amount.\r\n\r\n5.4. If there is a delay in the transfer of funds to the account details specified by the Customer, through a fault of a payment system, the Contractor shall not be liable for any damage caused as a result of a delayed transfer. In this case, the Customer shall agree that all claims would be referred to the payment system, and the Contractor shall provide assistance as far as possible under the law.\r\n\r\n5.5. In case of forgery of communication flows, or due to influence in order to degrade the performance of the Contractor, namely its software code, the application is suspended, and the money transferred are subject to resettlement in accordance with the agreement in effect. Shall the Customer not agree to the resettlement, he has every right to terminate the agreement and the digital currency shall be transferred to the account details specified by the Customer.\r\n\r\n5.6. In the case of using the services of the Contractor, the Customer fully agrees that the Contractor shall bear a limited liability corresponding to these rules for obtaining digital currency and give no additional guarantees to the Customer and shall have no additional liability before the Customer. Accordingly, the Customer shall not bear an additional liability to the Contractor.\r\n\r\n5.7. The Customer agrees to comply with applicable laws and not to tamper any communication flows as well as create any obstacles to the normal operation of the program code of the Contractor.\r\n\r\n5.8. The Contractor shall not be liable for any damage or consequences of an erroneous transfer of e-currency in the event that Customer have specified wrong details during application submission.\r\n\r\n<strong>6. Warranty period</strong>\r\n\r\nWithin 24 hours of the execution of the digital currency exchange, the Contractor warrants for services provided, unless otherwise noted.\r\n\r\n<strong>7. Contingencies.</strong>\r\n\r\nIn the case where unforeseen circumstances that contribute to non-compliance with terms of the agreement by the Contractor during the processing of the Customer''s application, the timing of application accomplishment are delayed for the corresponding period of the duration of the force majeure. The Contractor is not responsible for overdue obligations.\r\n\r\n<strong>8. Form of agreement.</strong>\r\n\r\nBoth parties, represented by the Contractor and the Customer, shall take this agreement as an agreement equivalent to the validity of the contract designated in writing.\r\n\r\n<strong>9. Usage of cards of England, Germany and the United States.</strong>\r\n\r\nFor cardholders from England, Germany and the United States, the arrangements for the transfer of digital currency are extended for an indefinite period, corresponding to the period required for full verification of cardholder data. For the whole period the money is not subject to any transactions and are retained in full in the account of the Contractor.\r\n\r\n<strong>10 Claims and disputes.</strong>\r\nClaims under this agreement are received by the Contractor in the form of e-mail where the Customer specifies the essence of the claim. This mail is sent to the details specified on site of the Contractor.\r\n\r\n<strong>11. Exchange transactions performance.</strong>\r\n\r\n11.1. It is expressly prohibited to use the services of the Contractor to carry out illegal transfers and fraud. At the conclusion of this agreement, the Customer agrees to comply with these requirements and to be criminally liable in the case of fraud under the laws in force.\r\n\r\n11.2. In case of inability to fulfill orders automatically, through no fault of the Contractor, such as lack of communication, lack of funds, or erroneous data of the Customer, the money is transferred to the account within the next 24 hours or returned to the account details of the Customer, net commission expense.\r\n\r\n11.3. On demand the Contractor is entitled to release information on the transfer of electronic currency to law enforcement bodies, administration of payment systems, as well as to victims of misconduct, victims of proven judicial fraud.\r\n\r\n11.4. The Customer agrees to submit all the documents proving his identity, in case of suspicion of fraud and money laundering.\r\n\r\n11.5. The Customer agrees not to interfere with the work of the Contractor and not to cause damage to its hardware and software, as well as the Customer undertakes to provide accurate information to ensure compliance with all terms of the agreement by the Contractor.\r\n\r\n<strong>12. Liability disclaimer.</strong>\r\n\r\nThe Contractor shall have the right to refuse to sign the agreement and accomplish the application without explanation. This paragraph shall apply with respect to any client.[:en_US]', '[ru_RU:]Правила сайта[:ru_RU][en_US:]Site rules[:en_US]', '', 'publish', 'closed', 'closed', '', 'tos', '', '', '2016-04-09 16:32:59', '2016-04-09 13:32:59', '', 0, 'http://premiumexchanger.ru/tos/', 0, 'page', '', 0),
(7, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:]Уважаемые клиенты! Безопасность проведения транзакций может быть поставлена под угрозу, в связи с независящими от нашего сервиса обстоятельствами. Чтобы этого не произошло, рекомендуем ознакомиться со следующими правилами конвертации электронной валюты:\r\n<ul>\r\n	<li> Всегда требуйте подтверждения личности лица, на реквизиты которого вы собираетесь выполнить перевод средств. Сделать это можно посредством личного звонка на skype, icq либо посредством запроса информации о статусе кошелька оппонента на сайте платежной системы;</li>\r\n	<li>Будьте предельно внимательны при заполнении поля «Номер счета» адресата. Допустив ошибку, вы отправляете собственные средства в неизвестном направлении без возможности их возврата;</li>\r\n	<li>Никогда не предоставляете займы, используя «безотзывные» электронные системы оплаты. В данном случае шанс столкнуться с фактом мошенничества чрезвычайно велик;</li>\r\n	<li>Если вам предлагается сделать оплату способом, отличным от указанного в инструкции к использованию нашего сервиса, откажитесь от выполнения платежа и сообщите о случившемся нашему специалисту. То же касается выплат по заявкам, созданным не лично вами;</li>\r\n	<li>Откажитесь от проведения средств, собственниками которых являются третьи лица, через собственные банковские счета. Известны случаи, когда проведение таких транзакций за вознаграждение, приводило к тому, что владелец счета становился соучастником финансового преступления, не подозревая о злом умысле со стороны мошенников;</li>\r\n	<li>Всегда уточняйте у сотрудника обменного пункта информацию, приходящую на вашу почту.</li>\r\n</ul>\r\nНаш и подобные сервисы не предоставляют займов, не берут средства у пользователей в долг или под проценты, не принимают пожертвований. При получении сообщений подозрительного характера от нашего имени с похожих на наши либо иных реквизитов, воздержитесь от выполнения указанных там требований и сообщите о произошедшем в нашу <a href="/feedback/">службы поддержки</a>.\r\n\r\nС заботой о вашем финансовом благополучии.[:ru_RU][en_US:]Dear customers! Security of transactions can be compromised due to circumstances independent from our service. To avoid this, we recommend that you read the following e-currency conversion rules:\r\n<ul>\r\n	<li>Always ask for confirmation of identity of the person on the details of which you are going to transfer the money. This can be done through personal call on skype, icq or by requesting information on the status of the digital wallet of the opponent on the site of payment system;</li>\r\n	<li>Be very careful when filling out the field "Account Number" of the offeree. If you have made a mistake, you are sending your own money in an unknown direction without the possibility of its return;</li>\r\n	<li>Never provide loans using "irrevocable" electronic payment systems. In this case, the risk to face the fact of fraud is extremely high;</li>\r\n	<li>If you are offered to make a payment in a manner different from that specified in the instructions for use of our service, you shall refuse to execute the payment and report the incident to our expert. The same applies to payments on applications that were not created by you;</li>\r\n	<li>Give up of transacting the funds, which are owned by third parties, through your own bank accounts. There are cases when carrying out such transaction for a fee led to the fact that the account holder became an accomplice of a financial crime, being unaware of malice on the part of scams;</li>\r\n	<li>Always verify information that comes to your mail with the exchange office employee.</li>\r\n</ul>\r\nOur services and similar services do not provide loans, do not take money from people under debt or interest, and do not accept donations. When receiving messages of suspicious nature on our behalf with details similar to our or other details, please refrain from the implementation of these requirements there and tell about what happened to our <a href="/feedback/">Support Service</a>.\r\n\r\nTaking care of your financial well-being.[:en_US]', '[ru_RU:]Предупреждение[:ru_RU][en_US:]Caution[:en_US]', '', 'publish', 'closed', 'closed', '', 'notice', '', '', '2016-04-09 16:32:53', '2016-04-09 13:32:53', '', 0, 'http://premiumexchanger.ru/notice/', 0, 'page', '', 0),
(8, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:]<strong>Вопрос: Как работает партнерская программа?</strong>\r\n\r\nОтвет: Зарегистрировавшись в нашей партнерской программе, Вы получаете уникальный партнерский идентификатор, который добавляется во все Ваши ссылки (?rid=777) и HTML-код. Вы можете размещать ссылки на любые страницы нашего сервиса  на своем сайте, блоге, страничке, в сообществах и социальных сетях.<strong>   </strong>\r\n\r\n<strong>Вопрос: Сколько я буду зарабатывать, участвуя в Вашей партнерской программе?</strong>\r\n\r\nОтвет: Это зависит от многих факторов, таких как:\r\n\r\n1. Посещаемость Вашего веб-сайта или сайтов, где Вы размещаете о нас информацию.\r\n\r\n2. Соответствие тематики сайта той целевой аудитории, которая может заинтересоваться услугами обмена валют. Проще говоря, не стоит рассчитывать на большое количество переходов по Вашей партнерской ссылке, размещенной на сайте, посвященном разведению попугаев.\r\n\r\n3. Правильная подача информации. Например, мало кого привлечет одна лишь ссылка "обмен валют" без всяких описаний где-нибудь в углу веб-страницы.\r\n\r\n<strong>Вопрос: Если я поставлю свою партнерскую ссылку в подпись на форуме, будут ли учитываться переходы и все остальные условия ПП?</strong>\r\n\r\nОтвет: Да, конечно будут.\r\n\r\n<strong>Вопрос: На моем сайте уже установлены другие партнерские программы. Могу ли я быть Вашим партнером?</strong>\r\n\r\nОтвет: Да, можете. У нас нет ограничений на работу с другими партнерскими программами.\r\n\r\n<strong>Вопрос: Подходит ли мой сайт для участия в партнерской программе?</strong>\r\n\r\nОтвет: Мы приветствуем любые сайты, которые не противоречат условиям нашей партнерской программы. Посмотреть список условий можно <a href="/register/">здесь</a> (пункт 6).\r\n\r\n<strong>Вопрос: Сколько уровней в Вашей партнерской программе? Оплачивается ли привлечение новых партнеров?</strong>\r\n\r\nОтвет: В нашей партнерской программе 6-ть уровней. Привлечение новых партнеров не оплачивается.\r\n\r\n<strong>Вопрос: Не могу войти в свой аккаунт партнера. Пишет "Неверное сочетание логина и пароля". При этом я уверен, что ввожу пароль правильно.</strong>\r\n\r\nОтвет: Убедитесь, что при вводе пароля у Вас не включена русская раскладка клавиатуры или Caps Lock. Если Вы точно помните только логин – воспользуйтесь функцией <a href="/lostpass/">Напоминания пароля</a>. Пароль будет выслан на Ваш e-mail, указанный при регистрации.\r\n\r\n<strong>Вопрос: Как выплачиваются заработанные деньги?</strong>\r\n\r\nОтвет: Партнерские выплаты производятся через систему WebMoney в валюте WMZ на кошелек, указанный партнером при регистрации в партнерской программе. Как правило, на это уходит не более 2-3 часов. Не спешите отправлять нам сообщения, если с момента подачи заявки не прошло 48 часов – администратор видит все заявки и обработает Вашу в любом случае.[:ru_RU][en_US:]<b>Question: How does the affiliate program work?</b>\r\n\r\nAnswer: By registering in our affiliate program, you will get a unique affiliate ID, which is added to all your links (?rid=777) and the HTML-code. You can post links on any pages of our service on your website, blog, page, in communities and social networks.\r\n\r\n<b>Question: How much will I earn by participating in your affiliate program?</b>\r\n\r\nAnswer: It depends on many factors such as:\r\n<ol>\r\n	<li>1. Traffic to your web site or sites where you post information about us.</li>\r\n	<li>Compliance of the subject of the site with the target audience, which may be interested in the services of currency exchange. Simply put, do not rely on a large number of clicks on your affiliate link posted on the website dedicated to parrot breeding.</li>\r\n	<li>Proper presentation of information. For example, very few people will like only one reference to "foreign exchange" without any description somewhere in the corner of the web page.</li>\r\n</ol>\r\n<b>Question: If I put my affiliate link and a signature, will the transitions and all other conditions of the AP also be considered?</b>\r\n\r\nAnswer: Yes, they certainly will.\r\n\r\n<b>Question: There are other affiliate programs installed on my site. May I be your affiliate?</b>\r\n\r\nAnswer: Yes, you may. We impose no restrictions on working with other affiliate programs.\r\n\r\n<b>Question: Is the qualify of my site sufficient to participate in an affiliate program?</b>\r\n\r\nAnswer: We welcome any sites that do not contradict the conditions of our affiliate program. You can see the list of conditions <a href="/register/"><span style="color: #1155cc;"><span style="text-decoration: underline;">here</span></span></a> (paragraph 6).\r\n\r\n<b>Question: How many levels are there in your affiliate program? Is there any reward for involving new affiliates?</b>\r\n\r\nAnswer: Our affiliate program has 6 levels. There is no reward for involving any further affiliates.\r\n\r\n<b>Question: I can not log in to my affiliate account. It shows "Invalid combination of username and password". But, in this case, I''m sure I enter the password correctly.</b>\r\n\r\nAnswer: Make sure that when you enter a password you Russian keyboard layout or Caps Lock are not turned on. If you just remember only login - use the <a href="/lostpass/"><span style="color: #1155cc;"><span style="text-decoration: underline;">password reminder</span></span></a>. The password will be sent to your e-mail, specified during registration.\r\n\r\n<b>Question: How are the earned money paid off?</b>\r\n\r\nAnswer: Affiliate payments are made via WebMoney in the currency WMZ onto a wallet, said by the affiliate during a registration in affiliate program. As a rule, it takes no more than 2-3 hours. Do not rush to send us a message if it has not passed 48 hours from the filing date yet - the administrator sees all application and will process yours anyway.[:en_US]', '[ru_RU:]Партнёрский FAQ[:ru_RU][en_US:]Affiliate FAQ[:en_US]', '', 'publish', 'closed', 'closed', '', 'partnersfaq', '', '', '2015-10-23 11:30:08', '2015-10-23 08:30:08', '', 0, 'http://premiumexchanger.ru/partnersfaq/', 0, 'page', '', 0),
(10, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][contact_form][:ru_RU]', '[ru_RU:]Контакты[:ru_RU][en_US:]Feedback[:en_US]', '', 'publish', 'closed', 'closed', '', 'feedback', '', '', '2015-10-23 11:30:26', '2015-10-23 08:30:26', '', 0, 'http://premiumexchanger.ru/feedback/', 0, 'page', '', 0),
(11, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][login_page][:ru_RU]', '[ru_RU:]Авторизация[:ru_RU][en_US:]Authorization[:en_US]', '', 'publish', 'closed', 'closed', '', 'login', '', '', '2015-10-23 11:26:57', '2015-10-23 08:26:57', '', 0, 'http://premiumexchanger.ru/login/', 0, 'page', '', 0),
(12, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:]1. Зарегистрированные пользователи получают право использовать накопительную систему скидок при совершение обмене:\r\n<ul>\r\n	<li>0-99 USD - 1%</li>\r\n	<li>100-999 USD - 2%</li>\r\n	<li>1000-4999 USD - 3%</li>\r\n	<li>5000- 9999 USD - 4%</li>\r\n	<li>10000-19999 USD - 5%</li>\r\n	<li>свыше 20000 USD - 6%</li>\r\n</ul>\r\n2. Начисления и выплаты по партнерской программе ведутся в долларах (WebMoney WMZ).\r\n\r\n3. Минимальная сумма для снятия заработанных денег с партнерского счета составляет 5 USD.\r\n\r\n4. За каждый совершенный обмен по вашей партнерской ссылке вы получает вознаграждение в размере от 1% до 6% от суммы обмена. Процент отчислений зависит от суммы совершенных обменов по вашей партнерской ссылке:\r\n<ul>\r\n	<li>0-99 USD - 1%</li>\r\n	<li>100-999 USD - 2%</li>\r\n	<li>1000-4999 USD - 3%</li>\r\n	<li>5000- 9999 USD - 4%</li>\r\n	<li>10000-19999 USD - 5%</li>\r\n	<li>свыше 20000 USD - 6%</li>\r\n</ul>\r\n4.1. Указанные значения партнерских вознаграждений быть со временем изменены. При этом все заработанные средства сохраняются на счете с учетом действовавших ранее ставок.\r\n\r\n5. На странице, где вы публикуете о нас информацию должно быть четко указано об услугах, предоставляемых нашим сайтом. В рекламных текстах запрещаются любые упоминания о наличии «бесплатных бонусов» на нашем сайте.\r\n\r\n6. Запрещается размещать партнерскую ссылку:\r\n<ul>\r\n	<li>в массовых рассылках писем (СПАМ);</li>\r\n	<li>на сайтах, принудительно открывающих окна браузера, либо открывающих сайты в скрытых фреймах;</li>\r\n	<li>на сайтах, распространяющих любые материалы, прямо или косвенно нарушающие законодательство РФ;</li>\r\n	<li>на сайтах, публикующих списки сайтов с «бесплатными бонусами»;</li>\r\n	<li>на веб-страницах, закрытых от публичного просмотра с помощью авторизации (различные социальные сети, закрытые разделы форумов и т.п.).</li>\r\n</ul>\r\nСайты, нарушающие одно или несколько вышеперечисленных правил, будут занесены в черный список нашей партнерской программы. Оплата за посетителей, пришедших с подобных сайтов производиться не будет.\r\n\r\n7 . При несоблюдении данных условий аккаунт нарушителя будет заблокирован без выплат и объяснения причин.\r\n\r\n8. Партнер несет полную ответственность за сохранность своих аутентификационных данных (логина и пароля) для доступа к аккаунту.\r\n\r\n9. Данные условия могут изменяться в одностороннем порядке без оповещения участников программы, но с публикацией на этой странице.\r\n<h1>Регистрация</h1>\r\nПожалуйста, внимательно и аккуратно заполните все поля регистрационной формы. На указанный вами e-mail будет выслано уведомление о регистрации.\r\n\r\n[register_page][:ru_RU][en_US:]1. Registered users have the right to use a progressive discount system when committing the exchange:\r\n<ul>\r\n	<li>0-99 USD — 1%</li>\r\n	<li>100-999 USD — 2%</li>\r\n	<li>1000-4999 USD — 3%</li>\r\n	<li>5000- 9999 USD — 4%</li>\r\n	<li>10000-19999 USD — 5%</li>\r\n	<li>over 20000 USD — 6%</li>\r\n</ul>\r\n2. Calculation and payoff within an affiliate program are maintained in United States dollars (USD).\r\n\r\n3. The minimum amount for the withdrawal of money earned from an affiliate account is 5 USD.\r\n\r\n4. For every exchange made using your affiliate link, you receive a reward at a rate of 1% to 6% of the amount exchanged. The percentage depends on the amount of exchanges made using your affiliate link:\r\n<ul>\r\n	<li>0-99 USD — 1%</li>\r\n	<li>100-999 USD — 2%</li>\r\n	<li>1000-4999 USD — 3%</li>\r\n	<li>5000- 9999 USD — 4%</li>\r\n	<li>10000-19999 USD — 5%</li>\r\n	<li>over 20000 USD — 6%</li>\r\n</ul>\r\n4.1. These values ​​of affiliate rewards may be changed from time to time. In this case, all earnings are retained in the account taking into account the previous rates.\r\n\r\n5. It should be clearly stated on the services provided by our site on the page where you post information about us. In advertising texts, it is prohibited to mention of a "free bonus" being available on our site.\r\n\r\n6. It is prohibited to place an affiliate link:\r\n<ul>\r\n	<li>in mass mail (spam);</li>\r\n	<li>on sites, forcing to open a browser window, or opening sites in a hidden frame;</li>\r\n	<li>on sites distributing any materials that, directly or indirectly, violate the laws of the Russian Federation;</li>\r\n	<li>on sites publishing lists of sites with "free bonuses";</li>\r\n	<li>on web pages, enclosed from public view by means of authorization (various social networks, closed sections of forums, etc.).</li>\r\n	<li>Sites that violate one or more of the above rules will be blacklisted for our affiliate program. There will be no payoffs for visitors linked from these sites.</li>\r\n</ul>\r\n7 . When failing to comply with these terms and conditions, your account will be blocked without making payoffs and explanation.\r\n\r\n8. An affiliate is solely responsible for the safety of its credentials (username and password) to access the account.\r\n\r\n9. These terms and conditions may be changed unilaterally without notifying participants of the program, but with the publication on this page.\r\n\r\n[register_page][:en_US]', '[ru_RU:]Регистрация[:ru_RU][en_US:]Registration[:en_US]', '', 'publish', 'closed', 'closed', '', 'register', '', '', '2016-04-09 16:31:54', '2016-04-09 13:31:54', '', 0, 'http://premiumexchanger.ru/register/', 0, 'page', '', 0),
(13, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][lostpass_page][:ru_RU]', '[ru_RU:]Восстановление пароля[:ru_RU][en_US:]Password recovery[:en_US]', '', 'publish', 'closed', 'closed', '', 'lostpass', '', '', '2015-10-23 11:31:52', '2015-10-23 08:31:52', '', 0, 'http://premiumexchanger.ru/lostpass/', 0, 'page', '', 0);
INSERT INTO `pr_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(14, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][account_page][:ru_RU]', '[ru_RU:]Личный кабинет[:ru_RU][en_US:]Personal account[:en_US]', '', 'publish', 'closed', 'closed', '', 'account', '', '', '2015-10-23 11:45:11', '2015-10-23 08:45:11', '', 0, 'http://premiumexchanger.ru/account/', 0, 'page', '', 0),
(15, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][security_page][:ru_RU]', '[ru_RU:]Настройки безопасности[:ru_RU][en_US:]Security settings[:en_US]', '', 'publish', 'closed', 'closed', '', 'security', '', '', '2015-10-23 11:45:30', '2015-10-23 08:45:30', '', 0, 'http://premiumexchanger.ru/security/', 0, 'page', '', 0),
(16, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][sitemap][:ru_RU]', '[ru_RU:]Карта сайта[:ru_RU][en_US:]Sitemap[:en_US]', '', 'publish', 'closed', 'closed', '', 'sitemap', '', '', '2015-10-23 11:30:43', '2015-10-23 08:30:43', '', 0, 'http://premiumexchanger.ru/sitemap/', 0, 'page', '', 0),
(17, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][tarifs][:ru_RU]', '[ru_RU:]Тарифы[:ru_RU][en_US:]Tariffs[:en_US]', '', 'publish', 'closed', 'closed', '', 'tarifs', '', '', '2015-10-23 11:48:15', '2015-10-23 08:48:15', '', 0, 'http://premiumexchanger.ru/tarifs/', 0, 'page', '', 0),
(18, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][reviews_page][:ru_RU]', '[ru_RU:]Отзывы[:ru_RU][en_US:]Reviews[:en_US]', '', 'publish', 'closed', 'closed', '', 'reviews', '', '', '2015-10-23 11:46:11', '2015-10-23 08:46:11', '', 0, 'http://premiumexchanger.ru/reviews/', 0, 'page', '', 0),
(19, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][userwallets][:ru_RU]', '[ru_RU:]Ваши счета[:ru_RU][en_US:]Your payment details[:en_US]', '', 'publish', 'closed', 'closed', '', 'userwallets', '', '', '2015-10-23 11:33:39', '2015-10-23 08:33:39', '', 0, 'http://premiumexchanger.ru/userwallets/', 0, 'page', '', 0),
(20, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][userverify][:ru_RU]', '[ru_RU:]Верификация аккаунта[:ru_RU][en_US:]Account verification[:en_US]', '', 'publish', 'closed', 'closed', '', 'userverify', '', '', '2015-10-23 11:32:22', '2015-10-23 08:32:22', '', 0, 'http://premiumexchanger.ru/userverify/', 0, 'page', '', 0),
(21, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][userxch][:ru_RU]', '[ru_RU:]Ваши операции[:ru_RU][en_US:]Your operations[:en_US]', '', 'publish', 'closed', 'closed', '', 'userxch', '', '', '2015-10-23 11:33:56', '2015-10-23 08:33:56', '', 0, 'http://premiumexchanger.ru/userxch/', 0, 'page', '', 0),
(24, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][paccount_page][:ru_RU]', '[ru_RU:]Партнёрский аккаунт[:ru_RU][en_US:]Affiliate account[:en_US]', '', 'publish', 'closed', 'closed', '', 'paccount', '', '', '2015-10-23 11:47:18', '2015-10-23 08:47:18', '', 0, 'http://premiumexchanger.ru/paccount/', 0, 'page', '', 0),
(25, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][promotional_page][:ru_RU]', '[ru_RU:]Рекламные материалы[:ru_RU][en_US:]Promotional materials[:en_US]', '', 'publish', 'closed', 'closed', '', 'promotional', '', '', '2015-10-23 11:47:45', '2015-10-23 08:47:45', '', 0, 'http://premiumexchanger.ru/promotional/', 0, 'page', '', 0),
(26, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][pexch_page][:ru_RU]', '[ru_RU:]Партнёрские обмены[:ru_RU][en_US:]Affiliate exchanges[:en_US]', '', 'publish', 'closed', 'closed', '', 'pexch', '', '', '2015-10-23 11:46:43', '2015-10-23 08:46:43', '', 0, 'http://premiumexchanger.ru/pexch/', 0, 'page', '', 0),
(27, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][plinks_page][:ru_RU]', '[ru_RU:]Партнёрские переходы[:ru_RU][en_US:]Affiliate transitions[:en_US]', '', 'publish', 'closed', 'closed', '', 'plinks', '', '', '2015-10-23 11:46:58', '2015-10-23 08:46:58', '', 0, 'http://premiumexchanger.ru/plinks/', 0, 'page', '', 0),
(28, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][preferals_page][:ru_RU]', '[ru_RU:]Рефералы[:ru_RU][en_US:]Referrals[:en_US]', '', 'publish', 'closed', 'closed', '', 'preferals', '', '', '2015-10-23 11:47:56', '2015-10-23 08:47:56', '', 0, 'http://premiumexchanger.ru/preferals/', 0, 'page', '', 0),
(29, 1, '2015-10-22 17:31:50', '2015-10-22 14:31:50', '[ru_RU:][payouts_page][:ru_RU]', '[ru_RU:]Вывод партнёрских средств[:ru_RU][en_US:]Affiliate money withdrawal[:en_US]', '', 'publish', 'closed', 'closed', '', 'payouts', '', '', '2015-10-23 11:31:27', '2015-10-23 08:31:27', '', 0, 'http://premiumexchanger.ru/payouts/', 0, 'page', '', 0),
(30, 1, '2015-10-22 17:36:04', '2015-10-22 14:36:04', '', '[ru_RU:]Главная[:ru_RU][en_US:]Homepage[:en_US]', '', 'publish', 'closed', 'closed', '', '30', '', '', '2017-08-15 20:01:12', '2017-08-15 17:01:12', '', 0, 'http://premiumexchanger.ru/?p=30', 1, 'nav_menu_item', '', 0),
(31, 1, '2015-10-22 17:36:04', '2015-10-22 14:36:04', ' ', '', '', 'publish', 'closed', 'closed', '', '31', '', '', '2017-08-15 20:01:13', '2017-08-15 17:01:13', '', 0, 'http://premiumexchanger.ru/?p=31', 5, 'nav_menu_item', '', 0),
(32, 1, '2015-10-22 17:36:04', '2015-10-22 14:36:04', ' ', '', '', 'publish', 'closed', 'closed', '', '32', '', '', '2017-08-15 20:01:12', '2017-08-15 17:01:12', '', 0, 'http://premiumexchanger.ru/?p=32', 2, 'nav_menu_item', '', 0),
(33, 1, '2015-10-22 17:36:04', '2015-10-22 14:36:04', ' ', '', '', 'publish', 'closed', 'closed', '', '33', '', '', '2017-08-15 20:01:12', '2017-08-15 17:01:12', '', 0, 'http://premiumexchanger.ru/?p=33', 3, 'nav_menu_item', '', 0),
(34, 1, '2015-10-22 17:36:04', '2015-10-22 14:36:04', ' ', '', '', 'publish', 'closed', 'closed', '', '34', '', '', '2017-08-15 20:01:12', '2017-08-15 17:01:12', '', 0, 'http://premiumexchanger.ru/?p=34', 4, 'nav_menu_item', '', 0),
(35, 1, '2015-10-22 17:36:51', '2015-10-22 14:36:51', ' ', '', '', 'publish', 'closed', 'closed', '', '35', '', '', '2017-08-15 20:00:52', '2017-08-15 17:00:52', '', 0, 'http://premiumexchanger.ru/?p=35', 1, 'nav_menu_item', '', 0),
(36, 1, '2015-10-22 17:36:51', '2015-10-22 14:36:51', ' ', '', '', 'publish', 'closed', 'closed', '', '36', '', '', '2017-08-15 20:00:52', '2017-08-15 17:00:52', '', 0, 'http://premiumexchanger.ru/?p=36', 2, 'nav_menu_item', '', 0),
(38, 1, '2015-10-22 22:33:48', '2015-10-22 19:33:48', '[ru_RU:]Добро пожаловать на сайт обменного пункта![:ru_RU][en_US:]Welcome to the website of the exchange office![:en_US]', '[ru_RU:]Добро пожаловать![:ru_RU][en_US:]Welcome![:en_US]', '', 'publish', 'open', 'closed', '', 'dobro-pozhalovat', '', '', '2016-12-11 11:03:33', '2016-12-11 08:03:33', '', 0, 'http://premiumexchanger.ru/?p=38', 0, 'post', '', 0),
(77, 1, '2015-10-23 11:49:02', '2015-10-23 08:49:02', ' ', '', '', 'publish', 'closed', 'closed', '', '77', '', '', '2017-08-15 20:00:52', '2017-08-15 17:00:52', '', 0, 'http://premiumexchanger.ru/?p=77', 3, 'nav_menu_item', '', 0),
(85, 1, '2015-12-28 15:51:34', '2015-12-28 12:51:34', '[en_US:][indeposit][:en_US]', '[en_US:]Pay deposit[:en_US][ru_RU:]Оплатить депозит[:ru_RU]', '', 'publish', 'closed', 'closed', '', 'indeposit', '', '', '2016-02-23 17:49:57', '2016-02-23 14:49:57', '', 0, 'http://premiumexchanger.ru/indeposit/', 0, 'page', '', 0),
(90, 1, '2016-02-23 17:04:52', '2016-02-23 14:04:52', '[en_US:][domacc_page][:en_US][ru_RU:][domacc_page][:ru_RU]', '[en_US:]Internal account[:en_US][ru_RU:]Внутренний счет[:ru_RU]', '', 'publish', 'closed', 'closed', '', 'domacc', '', '', '2016-11-27 12:07:18', '2016-11-27 09:07:18', '', 0, 'http://premiumexchanger.ru/domacc/', 0, 'page', '', 0),
(96, 1, '2016-02-23 17:18:23', '2016-02-23 14:18:23', '', 'Advcash', '', 'inherit', 'open', 'closed', '', 'advcash', '', '', '2016-02-23 17:18:23', '2016-02-23 14:18:23', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Advcash.png', 0, 'attachment', 'image/png', 0),
(97, 1, '2016-02-23 17:18:24', '2016-02-23 14:18:24', '', 'Alfabank', '', 'inherit', 'open', 'closed', '', 'alfabank', '', '', '2016-02-23 17:18:24', '2016-02-23 14:18:24', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Alfabank.png', 0, 'attachment', 'image/png', 0),
(98, 1, '2016-02-23 17:18:24', '2016-02-23 14:18:24', '', 'Bitcoin', '', 'inherit', 'open', 'closed', '', 'bitcoin', '', '', '2016-02-23 17:18:24', '2016-02-23 14:18:24', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Bitcoin.png', 0, 'attachment', 'image/png', 0),
(101, 1, '2016-02-23 17:18:27', '2016-02-23 14:18:27', '', 'Liqpay', '', 'inherit', 'open', 'closed', '', 'liqpay', '', '', '2016-02-23 17:18:27', '2016-02-23 14:18:27', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Liqpay.png', 0, 'attachment', 'image/png', 0),
(102, 1, '2016-02-23 17:18:27', '2016-02-23 14:18:27', '', 'Litecoin', '', 'inherit', 'open', 'closed', '', 'litecoin', '', '', '2016-02-23 17:18:27', '2016-02-23 14:18:27', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Litecoin.png', 0, 'attachment', 'image/png', 0),
(103, 1, '2016-02-23 17:18:28', '2016-02-23 14:18:28', '', 'Livecoin', '', 'inherit', 'open', 'closed', '', 'livecoin', '', '', '2016-02-23 17:18:28', '2016-02-23 14:18:28', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Livecoin.png', 0, 'attachment', 'image/png', 0),
(104, 1, '2016-02-23 17:18:29', '2016-02-23 14:18:29', '', 'NixMoney', '', 'inherit', 'open', 'closed', '', 'nixmoney', '', '', '2016-02-23 17:18:29', '2016-02-23 14:18:29', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/NixMoney.png', 0, 'attachment', 'image/png', 0),
(107, 1, '2016-02-23 17:18:31', '2016-02-23 14:18:31', '', 'Paxum', '', 'inherit', 'open', 'closed', '', 'paxum', '', '', '2016-02-23 17:18:31', '2016-02-23 14:18:31', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Paxum.png', 0, 'attachment', 'image/png', 0),
(108, 1, '2016-02-23 17:18:32', '2016-02-23 14:18:32', '', 'Payeer', '', 'inherit', 'open', 'closed', '', 'payeer', '', '', '2016-02-23 17:18:32', '2016-02-23 14:18:32', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Payeer.png', 0, 'attachment', 'image/png', 0),
(109, 1, '2016-02-23 17:18:32', '2016-02-23 14:18:32', '', 'Paymer', '', 'inherit', 'open', 'closed', '', 'paymer', '', '', '2016-02-23 17:18:32', '2016-02-23 14:18:32', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Paymer.png', 0, 'attachment', 'image/png', 0),
(110, 1, '2016-02-23 17:18:34', '2016-02-23 14:18:34', '', 'Paypal', '', 'inherit', 'open', 'closed', '', 'paypal', '', '', '2016-02-23 17:18:34', '2016-02-23 14:18:34', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Paypal.png', 0, 'attachment', 'image/png', 0),
(111, 1, '2016-02-23 17:18:35', '2016-02-23 14:18:35', '', 'Payza', '', 'inherit', 'open', 'closed', '', 'payza', '', '', '2016-02-23 17:18:35', '2016-02-23 14:18:35', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Payza.png', 0, 'attachment', 'image/png', 0),
(112, 1, '2016-02-23 17:18:36', '2016-02-23 14:18:36', '', 'Perfect-Money', '', 'inherit', 'open', 'closed', '', 'perfect-money', '', '', '2016-02-23 17:18:36', '2016-02-23 14:18:36', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Perfect-Money.png', 0, 'attachment', 'image/png', 0),
(113, 1, '2016-02-23 17:18:37', '2016-02-23 14:18:37', '', 'Privatbank', '', 'inherit', 'open', 'closed', '', 'privatbank', '', '', '2016-02-23 17:18:37', '2016-02-23 14:18:37', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Privatbank.png', 0, 'attachment', 'image/png', 0),
(114, 1, '2016-02-23 17:18:39', '2016-02-23 14:18:39', '', 'Qiwi', '', 'inherit', 'open', 'closed', '', 'qiwi', '', '', '2016-02-23 17:18:39', '2016-02-23 14:18:39', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Qiwi.png', 0, 'attachment', 'image/png', 0),
(115, 1, '2016-02-23 17:18:39', '2016-02-23 14:18:39', '', 'Sberbank', '', 'inherit', 'open', 'closed', '', 'sberbank', '', '', '2016-02-23 17:18:39', '2016-02-23 14:18:39', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Sberbank.png', 0, 'attachment', 'image/png', 0),
(116, 1, '2016-02-23 17:18:40', '2016-02-23 14:18:40', '', 'Skrill', '', 'inherit', 'open', 'closed', '', 'skrill', '', '', '2016-02-23 17:18:40', '2016-02-23 14:18:40', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Skrill.png', 0, 'attachment', 'image/png', 0),
(117, 1, '2016-02-23 17:18:41', '2016-02-23 14:18:41', '', 'SolidTrustPay', '', 'inherit', 'open', 'closed', '', 'solidtrustpay', '', '', '2016-02-23 17:18:41', '2016-02-23 14:18:41', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/SolidTrustPay.png', 0, 'attachment', 'image/png', 0),
(118, 1, '2016-02-23 17:18:42', '2016-02-23 14:18:42', '', 'Tinkoff', '', 'inherit', 'open', 'closed', '', 'tinkoff', '', '', '2016-02-23 17:18:42', '2016-02-23 14:18:42', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Tinkoff.png', 0, 'attachment', 'image/png', 0),
(119, 1, '2016-02-23 17:18:42', '2016-02-23 14:18:42', '', 'Visa-MasterCard', '', 'inherit', 'open', 'closed', '', 'visa-mastercard', '', '', '2016-02-23 17:18:42', '2016-02-23 14:18:42', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Visa-MasterCard.png', 0, 'attachment', 'image/png', 0),
(120, 1, '2016-02-23 17:18:43', '2016-02-23 14:18:43', '', 'WebMoney', '', 'inherit', 'open', 'closed', '', 'webmoney', '', '', '2016-02-23 17:18:43', '2016-02-23 14:18:43', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/WebMoney.png', 0, 'attachment', 'image/png', 0),
(122, 1, '2016-02-23 17:18:45', '2016-02-23 14:18:45', '', 'Yandex', '', 'inherit', 'open', 'closed', '', 'yandex', '', '', '2016-02-23 17:18:45', '2016-02-23 14:18:45', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Yandex.png', 0, 'attachment', 'image/png', 0),
(124, 1, '2016-02-23 17:27:07', '2016-02-23 14:27:07', '', 'favicon', '', 'inherit', 'open', 'closed', '', 'favicon', '', '', '2016-02-23 17:27:07', '2016-02-23 14:27:07', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/favicon.png', 0, 'attachment', 'image/png', 0),
(125, 1, '2016-02-23 17:28:14', '2016-02-23 14:28:14', '', 'bitcoin_bottom', '', 'inherit', 'open', 'closed', '', 'bitcoin-bottom', '', '', '2016-02-23 17:28:14', '2016-02-23 14:28:14', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/bitcoin-bottom.png', 0, 'attachment', 'image/png', 0),
(126, 1, '2016-02-23 17:28:15', '2016-02-23 14:28:15', '', 'okpay_bottom', '', 'inherit', 'open', 'closed', '', 'okpay-bottom', '', '', '2016-02-23 17:28:15', '2016-02-23 14:28:15', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/okpay-bottom.png', 0, 'attachment', 'image/png', 0),
(127, 1, '2016-02-23 17:28:16', '2016-02-23 14:28:16', '', 'pm_bottom', '', 'inherit', 'open', 'closed', '', 'pm-bottom', '', '', '2016-02-23 17:28:16', '2016-02-23 14:28:16', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/pm-bottom.png', 0, 'attachment', 'image/png', 0),
(128, 1, '2016-02-23 17:28:16', '2016-02-23 14:28:16', '', 'stp_bottom', '', 'inherit', 'open', 'closed', '', 'stp-bottom', '', '', '2016-02-23 17:28:16', '2016-02-23 14:28:16', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/stp-bottom.png', 0, 'attachment', 'image/png', 0),
(129, 1, '2016-02-23 17:28:17', '2016-02-23 14:28:17', '', 'wm_botton', '', 'inherit', 'open', 'closed', '', 'wm-botton', '', '', '2016-02-23 17:28:17', '2016-02-23 14:28:17', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/wm-botton.png', 0, 'attachment', 'image/png', 0),
(130, 1, '2016-02-23 17:28:18', '2016-02-23 14:28:18', '', 'ya_bottom', '', 'inherit', 'open', 'closed', '', 'ya-bottom', '', '', '2016-02-23 17:28:18', '2016-02-23 14:28:18', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/ya-bottom.png', 0, 'attachment', 'image/png', 0),
(136, 1, '2016-02-23 17:50:32', '2016-02-23 14:50:32', '[en_US:][toinvest][:en_US]', '[en_US:]Invest[:en_US][ru_RU:]Инвестировать[:ru_RU]', '', 'publish', 'closed', 'closed', '', 'toinvest', '', '', '2016-02-23 17:51:05', '2016-02-23 14:51:05', '', 0, 'http://premiumexchanger.ru/toinvest/', 0, 'page', '', 0),
(139, 1, '2016-08-15 17:16:20', '2016-08-15 14:16:20', '', 'exmo', '', 'inherit', 'open', 'closed', '', 'exmo', '', '', '2016-08-15 17:16:20', '2016-08-15 14:16:20', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/exmo.png', 0, 'attachment', 'image/png', 0),
(143, 1, '2016-11-28 20:00:43', '2016-11-28 17:00:43', '', 'alipay', '', 'inherit', 'open', 'closed', '', 'alipay', '', '', '2016-11-28 20:00:43', '2016-11-28 17:00:43', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Alipay.png', 0, 'attachment', 'image/png', 0),
(148, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '148', '', '', '2017-08-15 20:00:37', '2017-08-15 17:00:37', '', 0, 'http://premiumexchanger.ru/?p=148', 1, 'nav_menu_item', '', 0),
(149, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', 'ru-ru-avtorizatsiya-ru-ru-en-us-authorization-en-us', '', '', '2017-08-15 20:00:37', '2017-08-15 17:00:37', '', 0, 'http://premiumexchanger.ru/?p=149', 2, 'nav_menu_item', '', 0),
(150, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '150', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=150', 10, 'nav_menu_item', '', 0),
(151, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '151', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=151', 11, 'nav_menu_item', '', 0),
(152, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '152', '', '', '2017-08-15 20:00:37', '2017-08-15 17:00:37', '', 0, 'http://premiumexchanger.ru/?p=152', 4, 'nav_menu_item', '', 0),
(153, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', 'ru-ru-kontaktyi-ru-ru-en-us-feedback-en-us', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=153', 19, 'nav_menu_item', '', 0),
(154, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', 'ru-ru-lichnyiy-kabinet-ru-ru-en-us-personal-account-en-us', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=154', 9, 'nav_menu_item', '', 0),
(155, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '155', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=155', 12, 'nav_menu_item', '', 0),
(156, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '156', '', '', '2017-08-15 20:00:37', '2017-08-15 17:00:37', '', 0, 'http://premiumexchanger.ru/?p=156', 5, 'nav_menu_item', '', 0),
(157, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '157', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=157', 7, 'nav_menu_item', '', 0),
(158, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '158', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=158', 14, 'nav_menu_item', '', 0),
(159, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '159', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=159', 15, 'nav_menu_item', '', 0),
(160, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '160', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=160', 16, 'nav_menu_item', '', 0),
(161, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '161', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=161', 13, 'nav_menu_item', '', 0),
(162, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '162', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=162', 8, 'nav_menu_item', '', 0),
(163, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', 'ru-ru-registratsiya-ru-ru-en-us-registration-en-us', '', '', '2017-08-15 20:00:37', '2017-08-15 17:00:37', '', 0, 'http://premiumexchanger.ru/?p=163', 3, 'nav_menu_item', '', 0),
(164, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '164', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=164', 17, 'nav_menu_item', '', 0),
(165, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '165', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=165', 18, 'nav_menu_item', '', 0),
(166, 1, '2016-11-30 21:19:49', '2016-11-30 18:19:49', ' ', '', '', 'publish', 'closed', 'closed', '', '166', '', '', '2017-08-15 20:00:38', '2017-08-15 17:00:38', '', 0, 'http://premiumexchanger.ru/?p=166', 6, 'nav_menu_item', '', 0),
(170, 1, '2017-01-29 14:49:14', '2017-01-29 11:49:14', '', 'Avangardbank', '', 'inherit', 'open', 'closed', '', 'avangardbank', '', '', '2017-01-29 14:49:14', '2017-01-29 11:49:14', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Avangardbank.png', 0, 'attachment', 'image/png', 0),
(171, 1, '2017-01-29 14:49:16', '2017-01-29 11:49:16', '', 'Bank-perevod', '', 'inherit', 'open', 'closed', '', 'bank-perevod', '', '', '2017-01-29 14:49:16', '2017-01-29 11:49:16', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Bank-perevod.png', 0, 'attachment', 'image/png', 0),
(172, 1, '2017-01-29 14:49:18', '2017-01-29 11:49:18', '', 'Cash-EUR', '', 'inherit', 'open', 'closed', '', 'cash-eur', '', '', '2017-01-29 14:49:18', '2017-01-29 11:49:18', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Cash-EUR.png', 0, 'attachment', 'image/png', 0),
(173, 1, '2017-01-29 14:49:20', '2017-01-29 11:49:20', '', 'Cash-RUB', '', 'inherit', 'open', 'closed', '', 'cash-rub', '', '', '2017-01-29 14:49:20', '2017-01-29 11:49:20', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Cash-RUB.png', 0, 'attachment', 'image/png', 0),
(174, 1, '2017-01-29 14:49:22', '2017-01-29 11:49:22', '', 'Cash-USD', '', 'inherit', 'open', 'closed', '', 'cash-usd', '', '', '2017-01-29 14:49:22', '2017-01-29 11:49:22', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Cash-USD.png', 0, 'attachment', 'image/png', 0),
(175, 1, '2017-01-29 14:49:24', '2017-01-29 11:49:24', '', 'PMe-voucher', '', 'inherit', 'open', 'closed', '', 'pme-voucher', '', '', '2017-01-29 14:49:24', '2017-01-29 11:49:24', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/PMe-voucher.png', 0, 'attachment', 'image/png', 0),
(176, 1, '2017-01-29 14:49:27', '2017-01-29 11:49:27', '', 'Promsvyazbank', '', 'inherit', 'open', 'closed', '', 'promsvyazbank', '', '', '2017-01-29 14:49:27', '2017-01-29 11:49:27', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Promsvyazbank.png', 0, 'attachment', 'image/png', 0),
(177, 1, '2017-01-29 14:49:29', '2017-01-29 11:49:29', '', 'Russstandart', '', 'inherit', 'open', 'closed', '', 'russstandart', '', '', '2017-01-29 14:49:29', '2017-01-29 11:49:29', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Russstandart.png', 0, 'attachment', 'image/png', 0),
(178, 1, '2017-01-29 14:49:31', '2017-01-29 11:49:31', '', 'VTB24', '', 'inherit', 'open', 'closed', '', 'vtb24', '', '', '2017-01-29 14:49:31', '2017-01-29 11:49:31', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/VTB24.png', 0, 'attachment', 'image/png', 0),
(181, 1, '2017-07-22 10:14:24', '2017-07-22 07:14:24', '[exchangestep]', '[ru_RU:]Обмен - шаги[:ru_RU][en_US:]Exchange - steps[:en_US]', '', 'publish', 'closed', 'closed', '', 'hst', '', '', '2017-07-22 10:14:24', '2017-07-22 07:14:24', '', 0, 'http://premiumexchanger.ru/hst/', 0, 'page', '', 0),
(182, 1, '2017-07-22 11:03:54', '2017-07-22 08:03:54', '', '[en_US:]User agreement for personal data processing[:en_US][ru_RU:]Пользовательское соглашение по обработке персональных данных[:ru_RU]', '', 'publish', 'closed', 'closed', '', 'terms-personal-data', '', '', '2017-08-01 13:09:44', '2017-08-01 10:09:44', '', 0, 'http://premiumexchanger.ru/terms-personal-data/', 0, 'page', '', 0),
(183, 1, '2017-07-22 11:03:54', '2017-07-22 08:03:54', '[en_US:][checkstatus_form][:en_US]', '[en_US:]Check order status[:en_US][ru_RU:]Проверка статуса заявки[:ru_RU]', '', 'publish', 'closed', 'closed', '', 'checkstatus', '', '', '2017-08-01 13:09:25', '2017-08-01 10:09:25', '', 0, 'http://premiumexchanger.ru/checkstatus/', 0, 'page', '', 0),
(200, 1, '2017-08-01 13:04:04', '2017-08-01 10:04:04', '', '[ru_RU:]Условия участия в партнерской программе[:ru_RU][en_US:]Affiliate terms and conditions[:en_US]', '', 'publish', 'closed', 'closed', '', 'terms', '', '', '2017-08-01 13:04:04', '2017-08-01 10:04:04', '', 0, 'http://premiumexchanger.ru/terms/', 0, 'page', '', 0),
(206, 1, '2017-08-01 13:59:35', '2017-08-01 10:59:35', '[exchange]', '[ru_RU:]Обмен[:ru_RU][en_US:]Exchange[:en_US]', '', 'publish', 'closed', 'closed', '', 'exchange', '', '', '2017-08-01 13:59:35', '2017-08-01 10:59:35', '', 0, 'http://premiumexchanger.ru/exchange/', 0, 'page', '', 0),
(211, 1, '2017-10-07 11:20:42', '2017-10-07 08:20:42', '', 'wex', '', 'inherit', 'open', 'closed', '', 'wex', '', '', '2017-10-07 11:20:42', '2017-10-07 08:20:42', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/wex.png', 0, 'attachment', 'image/png', 0),
(213, 1, '2017-12-17 12:21:30', '2017-12-17 09:21:30', '', '[ru_RU:]Пользовательское соглашение по обработке персональных данных[:ru_RU][en_US:]User agreement for personal data processing[:en_US]', '', 'publish', 'closed', 'closed', '', 'terms-personal-data-2', '', '', '2017-12-17 12:21:30', '2017-12-17 09:21:30', '', 0, 'http://premiumexchanger.ru/terms-personal-data-2/', 0, 'page', '', 0),
(215, 1, '2018-07-20 16:56:08', '2018-07-20 13:56:08', '', 'bitcoincash', '', 'inherit', 'open', 'closed', '', 'bitcoincash', '', '', '2018-07-20 16:56:08', '2018-07-20 13:56:08', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/bitcoincash.png', 0, 'attachment', 'image/png', 0),
(216, 1, '2018-07-20 16:56:10', '2018-07-20 13:56:10', '', 'dash', '', 'inherit', 'open', 'closed', '', 'dash', '', '', '2018-07-20 16:56:10', '2018-07-20 13:56:10', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/dash.png', 0, 'attachment', 'image/png', 0),
(217, 1, '2018-07-20 16:56:12', '2018-07-20 13:56:12', '', 'ether', '', 'inherit', 'open', 'closed', '', 'ether', '', '', '2018-07-20 16:56:12', '2018-07-20 13:56:12', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/ether.png', 0, 'attachment', 'image/png', 0),
(218, 1, '2018-07-20 16:56:15', '2018-07-20 13:56:15', '', 'monero', '', 'inherit', 'open', 'closed', '', 'monero', '', '', '2018-07-20 16:56:15', '2018-07-20 13:56:15', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/monero.png', 0, 'attachment', 'image/png', 0),
(220, 1, '2018-07-20 16:56:20', '2018-07-20 13:56:20', '', 'wawes', '', 'inherit', 'open', 'closed', '', 'wawes', '', '', '2018-07-20 16:56:20', '2018-07-20 13:56:20', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/wawes.png', 0, 'attachment', 'image/png', 0),
(221, 1, '2018-07-20 16:56:22', '2018-07-20 13:56:22', '', 'zcash', '', 'inherit', 'open', 'closed', '', 'zcash', '', '', '2018-07-20 16:56:22', '2018-07-20 13:56:22', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/zcash.png', 0, 'attachment', 'image/png', 0),
(222, 1, '2018-07-20 17:28:46', '2018-07-20 14:28:46', '', 'ripple', '', 'inherit', 'open', 'closed', '', 'ripple', '', '', '2018-07-20 17:28:46', '2018-07-20 14:28:46', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/ripple.png', 0, 'attachment', 'image/png', 0),
(225, 1, '2018-10-23 10:50:58', '2018-10-23 07:50:58', '', 'Cardano', '', 'inherit', 'open', 'closed', '', 'cardano', '', '', '2018-10-23 10:50:58', '2018-10-23 07:50:58', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Cardano.png', 0, 'attachment', 'image/png', 0),
(226, 1, '2018-10-23 10:51:01', '2018-10-23 07:51:01', '', 'DigiByte', '', 'inherit', 'open', 'closed', '', 'digibyte', '', '', '2018-10-23 10:51:01', '2018-10-23 07:51:01', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/DigiByte.png', 0, 'attachment', 'image/png', 0),
(227, 1, '2018-10-23 10:51:03', '2018-10-23 07:51:03', '', 'EOS', '', 'inherit', 'open', 'closed', '', 'eos', '', '', '2018-10-23 10:51:03', '2018-10-23 07:51:03', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/EOS.png', 0, 'attachment', 'image/png', 0),
(228, 1, '2018-10-23 10:51:05', '2018-10-23 07:51:05', '', 'Ethereum Classic', '', 'inherit', 'open', 'closed', '', 'ethereum-classic', '', '', '2018-10-23 10:51:05', '2018-10-23 07:51:05', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Ethereum-Classic.png', 0, 'attachment', 'image/png', 0),
(229, 1, '2018-10-23 10:51:08', '2018-10-23 07:51:08', '', 'Stellar', '', 'inherit', 'open', 'closed', '', 'stellar', '', '', '2018-10-23 10:51:08', '2018-10-23 07:51:08', '', 0, 'http://premiumexchanger.ru/wp-content/uploads/Stellar.png', 0, 'attachment', 'image/png', 0),
(230, 1, '2018-11-08 17:16:27', '0000-00-00 00:00:00', '', 'Черновик', '', 'auto-draft', 'open', 'closed', '', '', '', '', '2018-11-08 17:16:27', '0000-00-00 00:00:00', '', 0, 'http://premiumexchanger.ru/?p=230', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_psys`
--

CREATE TABLE IF NOT EXISTS `pr_psys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `psys_title` longtext NOT NULL,
  `psys_logo` longtext NOT NULL,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `pr_psys`
--

INSERT INTO `pr_psys` (`id`, `psys_title`, `psys_logo`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`) VALUES
(1, '[ru_RU:]Webmoney[:ru_RU][en_US:]Webmoney[:en_US]', 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/WebMoney.png[:ru_RU][en_US:]/wp-content/uploads/WebMoney.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/WebMoney.png[:ru_RU][en_US:]/wp-content/uploads/WebMoney.png[:en_US]";}', '0000-00-00 00:00:00', '2018-07-20 18:12:42', 1, 0),
(2, '[ru_RU:]Perfect Money[:ru_RU][en_US:]Perfect Money[:en_US]', 'a:2:{s:5:"logo1";s:106:"[ru_RU:]/wp-content/uploads/Perfect-Money.png[:ru_RU][en_US:]/wp-content/uploads/Perfect-Money.png[:en_US]";s:5:"logo2";s:106:"[ru_RU:]/wp-content/uploads/Perfect-Money.png[:ru_RU][en_US:]/wp-content/uploads/Perfect-Money.png[:en_US]";}', '0000-00-00 00:00:00', '2018-07-20 18:12:36', 1, 0),
(3, '[ru_RU:]Яндекс.Деньги[:ru_RU][en_US:]Yandex.Money[:en_US]', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/Yandex.png[:ru_RU][en_US:]/wp-content/uploads/Yandex.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/Yandex.png[:ru_RU][en_US:]/wp-content/uploads/Yandex.png[:en_US]";}', '0000-00-00 00:00:00', '2018-07-20 18:12:32', 1, 0),
(5, '[ru_RU:]Приват24[:ru_RU][en_US:]Privat24[:en_US]', 'a:2:{s:5:"logo1";s:100:"[ru_RU:]/wp-content/uploads/Privatbank.png[:ru_RU][en_US:]/wp-content/uploads/Privatbank.png[:en_US]";s:5:"logo2";s:100:"[ru_RU:]/wp-content/uploads/Privatbank.png[:ru_RU][en_US:]/wp-content/uploads/Privatbank.png[:en_US]";}', '0000-00-00 00:00:00', '2018-07-20 18:12:24', 1, 0),
(6, '[ru_RU:]Сбербанк[:ru_RU][en_US:]Sberbank[:en_US]', 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/Sberbank.png[:ru_RU][en_US:]/wp-content/uploads/Sberbank.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/Sberbank.png[:ru_RU][en_US:]/wp-content/uploads/Sberbank.png[:en_US]";}', '0000-00-00 00:00:00', '2018-07-20 18:12:15', 1, 0),
(7, '[ru_RU:]Bitcoin[:ru_RU][en_US:]Bitcoin[:en_US]', 'a:2:{s:5:"logo1";s:94:"[ru_RU:]/wp-content/uploads/Bitcoin.png[:ru_RU][en_US:]/wp-content/uploads/Bitcoin.png[:en_US]";s:5:"logo2";s:94:"[ru_RU:]/wp-content/uploads/Bitcoin.png[:ru_RU][en_US:]/wp-content/uploads/Bitcoin.png[:en_US]";}', '2018-07-20 17:24:35', '2018-07-20 17:25:15', 1, 0),
(8, '[ru_RU:]Ethereum[:ru_RU][en_US:]Ethereum[:en_US]', 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/ether.png[:ru_RU][en_US:]/wp-content/uploads/ether.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/ether.png[:ru_RU][en_US:]/wp-content/uploads/ether.png[:en_US]";}', '2018-07-20 17:25:44', '2018-07-20 18:12:00', 1, 0),
(9, '[ru_RU:]Litecoin[:ru_RU][en_US:]Litecoin[:en_US]', 'a:2:{s:5:"logo1";s:96:"[ru_RU:]/wp-content/uploads/Litecoin.png[:ru_RU][en_US:]/wp-content/uploads/Litecoin.png[:en_US]";s:5:"logo2";s:96:"[ru_RU:]/wp-content/uploads/Litecoin.png[:ru_RU][en_US:]/wp-content/uploads/Litecoin.png[:en_US]";}', '2018-07-20 17:26:21', '2018-07-20 18:11:55', 1, 0),
(10, '[ru_RU:]Monero[:ru_RU][en_US:]Monero[:en_US]', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/monero.png[:ru_RU][en_US:]/wp-content/uploads/monero.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/monero.png[:ru_RU][en_US:]/wp-content/uploads/monero.png[:en_US]";}', '2018-07-20 17:26:52', '2018-07-20 18:11:51', 1, 0),
(11, '[ru_RU:]Zcash[:ru_RU][en_US:]Zcash[:en_US]', 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/zcash.png[:ru_RU][en_US:]/wp-content/uploads/zcash.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/zcash.png[:ru_RU][en_US:]/wp-content/uploads/zcash.png[:en_US]";}', '2018-07-20 17:27:23', '2018-07-20 18:11:45', 1, 0),
(12, '[ru_RU:]Ripple[:ru_RU][en_US:]Ripple[:en_US]', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/ripple.png[:ru_RU][en_US:]/wp-content/uploads/ripple.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/ripple.png[:ru_RU][en_US:]/wp-content/uploads/ripple.png[:en_US]";}', '2018-07-20 17:28:55', '2018-07-20 18:11:40', 1, 0),
(13, '[ru_RU:]Dash[:ru_RU][en_US:]Dash[:en_US]', 'a:2:{s:5:"logo1";s:88:"[ru_RU:]/wp-content/uploads/dash.png[:ru_RU][en_US:]/wp-content/uploads/dash.png[:en_US]";s:5:"logo2";s:88:"[ru_RU:]/wp-content/uploads/dash.png[:ru_RU][en_US:]/wp-content/uploads/dash.png[:en_US]";}', '2018-07-20 17:29:26', '2018-07-20 18:11:36', 1, 0),
(14, '[ru_RU:]Bitcoin Cash[:ru_RU][en_US:]Bitcoin Cash[:en_US]', 'a:2:{s:5:"logo1";s:102:"[ru_RU:]/wp-content/uploads/bitcoincash.png[:ru_RU][en_US:]/wp-content/uploads/bitcoincash.png[:en_US]";s:5:"logo2";s:102:"[ru_RU:]/wp-content/uploads/bitcoincash.png[:ru_RU][en_US:]/wp-content/uploads/bitcoincash.png[:en_US]";}', '2018-07-20 17:29:54', '2018-07-20 18:11:31', 1, 0),
(15, '[ru_RU:]Waves[:ru_RU][en_US:]Waves[:en_US]', 'a:2:{s:5:"logo1";s:90:"[ru_RU:]/wp-content/uploads/wawes.png[:ru_RU][en_US:]/wp-content/uploads/wawes.png[:en_US]";s:5:"logo2";s:90:"[ru_RU:]/wp-content/uploads/wawes.png[:ru_RU][en_US:]/wp-content/uploads/wawes.png[:en_US]";}', '2018-07-20 17:30:52', '2018-07-20 18:11:27', 1, 0),
(16, '[ru_RU:]Advcash[:ru_RU][en_US:]Advcash[:en_US]', 'a:2:{s:5:"logo1";s:94:"[ru_RU:]/wp-content/uploads/Advcash.png[:ru_RU][en_US:]/wp-content/uploads/Advcash.png[:en_US]";s:5:"logo2";s:94:"[ru_RU:]/wp-content/uploads/Advcash.png[:ru_RU][en_US:]/wp-content/uploads/Advcash.png[:en_US]";}', '2018-07-20 17:31:25', '2018-07-20 18:11:20', 1, 0),
(17, '[ru_RU:]Payeer[:ru_RU][en_US:]Payeer[:en_US]', 'a:2:{s:5:"logo1";s:92:"[ru_RU:]/wp-content/uploads/Payeer.png[:ru_RU][en_US:]/wp-content/uploads/Payeer.png[:en_US]";s:5:"logo2";s:92:"[ru_RU:]/wp-content/uploads/Payeer.png[:ru_RU][en_US:]/wp-content/uploads/Payeer.png[:en_US]";}', '2018-07-20 17:31:53', '2018-07-20 18:11:15', 1, 0),
(18, '[ru_RU:]Qiwi[:ru_RU][en_US:]Qiwi[:en_US]', 'a:2:{s:5:"logo1";s:88:"[ru_RU:]/wp-content/uploads/Qiwi.png[:ru_RU][en_US:]/wp-content/uploads/Qiwi.png[:en_US]";s:5:"logo2";s:88:"[ru_RU:]/wp-content/uploads/Qiwi.png[:ru_RU][en_US:]/wp-content/uploads/Qiwi.png[:en_US]";}', '2018-07-20 17:32:22', '2018-07-20 18:11:06', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_recalc_bids`
--

CREATE TABLE IF NOT EXISTS `pr_recalc_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `enable_recalc` int(1) NOT NULL DEFAULT '0',
  `cou_hour` varchar(20) NOT NULL DEFAULT '0',
  `cou_minute` varchar(20) NOT NULL DEFAULT '0',
  `statused` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_reserve_requests`
--

CREATE TABLE IF NOT EXISTS `pr_reserve_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rdate` datetime NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `naps_title` longtext NOT NULL,
  `amount` varchar(250) NOT NULL,
  `comment` longtext NOT NULL,
  `locale` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_reviews`
--

CREATE TABLE IF NOT EXISTS `pr_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_name` tinytext NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_site` tinytext NOT NULL,
  `review_date` datetime NOT NULL,
  `review_hash` tinytext NOT NULL,
  `review_text` longtext NOT NULL,
  `review_status` varchar(150) NOT NULL DEFAULT 'moderation',
  `review_locale` varchar(10) NOT NULL,
  `vo_rate` int(5) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pr_reviews`
--

INSERT INTO `pr_reviews` (`id`, `user_id`, `user_name`, `user_email`, `user_site`, `review_date`, `review_hash`, `review_text`, `review_status`, `review_locale`, `vo_rate`, `create_date`, `edit_date`, `auto_status`, `edit_user_id`) VALUES
(1, 0, 'Гость', '', '', '2015-10-22 22:32:00', '', 'Отличный обменник!', 'publish', 'ru_RU', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_reviews_meta`
--

CREATE TABLE IF NOT EXISTS `pr_reviews_meta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `meta_key` longtext NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_schedule_operators`
--

CREATE TABLE IF NOT EXISTS `pr_schedule_operators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0',
  `h1` varchar(5) NOT NULL DEFAULT '0',
  `m1` varchar(5) NOT NULL DEFAULT '0',
  `h2` varchar(5) NOT NULL DEFAULT '0',
  `m2` varchar(5) NOT NULL DEFAULT '0',
  `d1` int(1) NOT NULL DEFAULT '0',
  `d2` int(1) NOT NULL DEFAULT '0',
  `d3` int(1) NOT NULL DEFAULT '0',
  `d4` int(1) NOT NULL DEFAULT '0',
  `d5` int(1) NOT NULL DEFAULT '0',
  `d6` int(1) NOT NULL DEFAULT '0',
  `d7` int(1) NOT NULL DEFAULT '0',
  `save_order` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_sitecaptcha_images`
--

CREATE TABLE IF NOT EXISTS `pr_sitecaptcha_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uslov` longtext NOT NULL,
  `img1` varchar(250) NOT NULL,
  `img2` varchar(250) NOT NULL,
  `img3` varchar(250) NOT NULL,
  `variant` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_sitecaptcha_user`
--

CREATE TABLE IF NOT EXISTS `pr_sitecaptcha_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `sess_hash` varchar(150) NOT NULL,
  `img1` varchar(150) NOT NULL,
  `img2` varchar(150) NOT NULL,
  `img3` varchar(150) NOT NULL,
  `num1` varchar(150) NOT NULL,
  `num2` varchar(150) NOT NULL,
  `num3` varchar(150) NOT NULL,
  `uslov` longtext NOT NULL,
  `variant` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_spbbonus`
--

CREATE TABLE IF NOT EXISTS `pr_spbbonus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `bid_id` bigint(20) NOT NULL DEFAULT '0',
  `bonus_sum` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_termmeta`
--

CREATE TABLE IF NOT EXISTS `pr_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_terms`
--

CREATE TABLE IF NOT EXISTS `pr_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `pr_terms`
--

INSERT INTO `pr_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Без рубрики', 'norubrik', 0),
(2, 'Верхнее меню / Top menu', 'verhnee-menyu-top-menu', 0),
(3, 'Нижнее меню / Footer menu', 'nizhnee-menyu-footer-menu', 0),
(4, 'Мобильное меню / Mobile menu', 'mobilnoe-menyu-mobile-menu', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_term_relationships`
--

CREATE TABLE IF NOT EXISTS `pr_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pr_term_relationships`
--

INSERT INTO `pr_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(30, 2, 0),
(31, 2, 0),
(32, 2, 0),
(33, 2, 0),
(34, 2, 0),
(35, 3, 0),
(36, 3, 0),
(38, 1, 0),
(77, 3, 0),
(148, 4, 0),
(149, 4, 0),
(150, 4, 0),
(151, 4, 0),
(152, 4, 0),
(153, 4, 0),
(154, 4, 0),
(155, 4, 0),
(156, 4, 0),
(157, 4, 0),
(158, 4, 0),
(159, 4, 0),
(160, 4, 0),
(161, 4, 0),
(162, 4, 0),
(163, 4, 0),
(164, 4, 0),
(165, 4, 0),
(166, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `pr_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `pr_term_taxonomy`
--

INSERT INTO `pr_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'nav_menu', '', 0, 5),
(3, 3, 'nav_menu', '', 0, 3),
(4, 4, 'nav_menu', '', 0, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_trans_reserv_logs`
--

CREATE TABLE IF NOT EXISTS `pr_trans_reserv_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valut_id` bigint(20) NOT NULL DEFAULT '0',
  `trans_id` bigint(20) NOT NULL DEFAULT '0',
  `trans_type` int(1) NOT NULL DEFAULT '0',
  `trans_date` datetime NOT NULL,
  `old_sum` varchar(250) NOT NULL DEFAULT '0',
  `new_sum` varchar(250) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_usermeta`
--

CREATE TABLE IF NOT EXISTS `pr_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Дамп данных таблицы `pr_usermeta`
--

INSERT INTO `pr_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'superboss'),
(2, 1, 'first_name', 'Иван'),
(3, 1, 'last_name', 'Иванов'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'pr_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(11, 1, 'pr_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp496_privacy'),
(13, 1, 'show_welcome_panel', '0'),
(15, 1, 'pr_dashboard_quick_press_last_post_id', '230'),
(17, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";i:4;s:15:"title-attribute";}'),
(18, 1, 'metaboxhidden_nav-menus', 'a:1:{i:0;s:12:"add-post_tag";}'),
(19, 1, 'nav_menu_recently_edited', '4'),
(20, 1, 'pr_user-settings', 'editor=tinymce&libraryContent=browse'),
(21, 1, 'pr_user-settings-time', '1540575634'),
(22, 1, 'closedpostboxes_dashboard', 'a:2:{i:0;s:43:"standart_update_dashboard_widget_premiumbox";i:1;s:21:"dashboard_quick_press";}'),
(23, 1, 'metaboxhidden_dashboard', 'a:3:{i:0;s:19:"dashboard_right_now";i:1;s:18:"dashboard_activity";i:2;s:21:"dashboard_quick_press";}'),
(24, 1, 'meta-box-order_dashboard', 'a:4:{s:6:"normal";s:196:"standart_security_dashboard_widget,standart_update_dashboard_widget_premiumbox,pn_license_pn_dashboard_widget,standart_user_dashboard_widget,statuswork_dashboard_widget,maintrance_dashboard_widget";s:4:"side";s:60:"dashboard_right_now,dashboard_activity,dashboard_quick_press";s:7:"column3";s:0:"";s:7:"column4";s:0:"";}'),
(25, 1, 'second_name', 'Иванович'),
(26, 1, 'user_phone', '1234567'),
(27, 1, 'user_skype', 'skype'),
(28, 1, 'user_passport', ''),
(32, 1, '', ''),
(34, 1, 'session_tokens', 'a:1:{s:64:"8dd29ed70b1a96ad9af320e90d67a631e27f93af128ca7f9d145d62ba6e0f163";a:4:{s:10:"expiration";i:1541945783;s:2:"ip";s:9:"127.0.0.1";s:2:"ua";s:114:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36";s:5:"login";i:1541686583;}}'),
(35, 1, 'managetoplevel_page_pn_napscolumnshidden', 'a:1:{i:0;s:4:"copy";}'),
(36, 1, 'pn_moduls_per_page', '100'),
(37, 1, 'show_block_new_parser', 'a:0:{}'),
(38, 1, 'trev_parser_pairs_per_page', '100');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_users`
--

CREATE TABLE IF NOT EXISTS `pr_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  `user_discount` varchar(50) NOT NULL DEFAULT '0',
  `sec_lostpass` int(1) NOT NULL DEFAULT '1',
  `sec_login` int(1) NOT NULL DEFAULT '0',
  `email_login` int(1) NOT NULL DEFAULT '0',
  `auto_login1` varchar(250) NOT NULL,
  `auto_login2` varchar(250) NOT NULL,
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `partner_pers` varchar(50) NOT NULL DEFAULT '0',
  `user_verify` int(1) NOT NULL DEFAULT '0',
  `enable_ips` longtext NOT NULL,
  `rconfirm` int(1) NOT NULL DEFAULT '1',
  `user_pin` varchar(250) NOT NULL,
  `enable_pin` int(1) NOT NULL DEFAULT '0',
  `user_browser` varchar(250) NOT NULL,
  `user_ip` varchar(250) NOT NULL,
  `user_bann` int(1) NOT NULL DEFAULT '0',
  `admin_comment` longtext NOT NULL,
  `last_adminpanel` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pr_users`
--

INSERT INTO `pr_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`, `user_discount`, `sec_lostpass`, `sec_login`, `email_login`, `auto_login1`, `auto_login2`, `ref_id`, `partner_pers`, `user_verify`, `enable_ips`, `rconfirm`, `user_pin`, `enable_pin`, `user_browser`, `user_ip`, `user_bann`, `admin_comment`, `last_adminpanel`) VALUES
(1, 'superboss', '$P$Bn.KgRJaFWfr4nPMPUIrO0ATDmE5m.0', 'superboss', 'info@premium.ru', '', '2015-10-22 14:25:04', '', 0, 'superboss', '0', 0, 0, 0, '$1$tz5.yg..$9GpXSYwtrzwGEJvUnFpoq.', '$1$Tq3.gv5.$u5wEob5qQt8GgwpQFsRJJ1', 0, '0', 0, '', 1, '', 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', '127.0.0.1', 0, '', '1541697468');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_user_discounts`
--

CREATE TABLE IF NOT EXISTS `pr_user_discounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sumec` varchar(50) NOT NULL DEFAULT '0',
  `discount` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pr_user_discounts`
--

INSERT INTO `pr_user_discounts` (`id`, `sumec`, `discount`) VALUES
(1, '0', '0'),
(2, '500', '0.1'),
(3, '1000', '0.2'),
(4, '2000', '0.3'),
(5, '5000', '0.4'),
(6, '10000', '0.5');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_user_fav`
--

CREATE TABLE IF NOT EXISTS `pr_user_fav` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `link` varchar(250) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '0',
  `menu_order` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_user_payouts`
--

CREATE TABLE IF NOT EXISTS `pr_user_payouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pay_date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `pay_sum` varchar(250) NOT NULL DEFAULT '0',
  `pay_sum_or` varchar(250) NOT NULL DEFAULT '0',
  `currency_id` bigint(20) NOT NULL DEFAULT '0',
  `psys_title` longtext NOT NULL,
  `currency_code_id` bigint(20) NOT NULL DEFAULT '0',
  `currency_code_title` varchar(250) NOT NULL,
  `pay_account` varchar(250) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `comment` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_user_wallets`
--

CREATE TABLE IF NOT EXISTS `pr_user_wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `currency_id` bigint(20) NOT NULL DEFAULT '0',
  `accountnum` longtext NOT NULL,
  `verify` int(1) NOT NULL DEFAULT '0',
  `vidzn` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pr_user_wallets`
--

INSERT INTO `pr_user_wallets` (`id`, `user_id`, `user_login`, `currency_id`, `accountnum`, `verify`, `vidzn`) VALUES
(2, 1, 'superboss', 7, '1234567812345678', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_uv_accounts`
--

CREATE TABLE IF NOT EXISTS `pr_uv_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createdate` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `valut_id` bigint(20) NOT NULL DEFAULT '0',
  `usac_id` bigint(20) NOT NULL DEFAULT '0',
  `theip` varchar(250) NOT NULL,
  `accountnum` longtext NOT NULL,
  `locale` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_uv_accounts_files`
--

CREATE TABLE IF NOT EXISTS `pr_uv_accounts_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `uv_data` longtext NOT NULL,
  `uv_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_uv_field`
--

CREATE TABLE IF NOT EXISTS `pr_uv_field` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `fieldvid` int(1) NOT NULL DEFAULT '0',
  `locale` varchar(20) NOT NULL,
  `uv_auto` varchar(250) NOT NULL,
  `uv_req` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `uv_order` bigint(20) NOT NULL DEFAULT '0',
  `helps` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pr_uv_field`
--

INSERT INTO `pr_uv_field` (`id`, `title`, `fieldvid`, `locale`, `uv_auto`, `uv_req`, `status`, `uv_order`, `helps`) VALUES
(1, '[ru_RU:]Фамилия[:ru_RU][en_US:]Surname[:en_US]', 0, '0', 'last_name', 1, 1, 0, ''),
(2, '[ru_RU:]Имя[:ru_RU][en_US:]Name[:en_US]', 0, '0', 'first_name', 1, 1, 0, ''),
(3, '[ru_RU:]Отчество[:ru_RU][en_US:]Middle name[:en_US]', 0, '0', 'second_name', 1, 1, 0, ''),
(4, '[ru_RU:]Скан вашего паспорта[:ru_RU][en_US:]Scan of your passport[:en_US]', 1, '0', '0', 1, 1, 0, ''),
(5, '[ru_RU:]Фото с развернутым паспортом в руках на фоне сайта[:ru_RU][en_US:]Foto with your passport in hand[:en_US]', 1, '0', '0', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `pr_uv_field_user`
--

CREATE TABLE IF NOT EXISTS `pr_uv_field_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `uv_data` longtext NOT NULL,
  `uv_id` bigint(20) NOT NULL DEFAULT '0',
  `uv_field` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_uv_wallets`
--

CREATE TABLE IF NOT EXISTS `pr_uv_wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_ip` varchar(250) NOT NULL,
  `currency_id` bigint(20) NOT NULL DEFAULT '0',
  `user_wallet_id` bigint(20) NOT NULL DEFAULT '0',
  `wallet_num` longtext NOT NULL,
  `comment` longtext NOT NULL,
  `locale` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_valuts`
--

CREATE TABLE IF NOT EXISTS `pr_valuts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valut_logo` longtext NOT NULL,
  `valut_decimal` int(2) NOT NULL DEFAULT '2',
  `valut_status` int(1) NOT NULL DEFAULT '1',
  `valut_reserv` varchar(50) NOT NULL DEFAULT '0',
  `xml_value` varchar(250) NOT NULL,
  `inday1` varchar(50) NOT NULL DEFAULT '0',
  `inday2` varchar(50) NOT NULL DEFAULT '0',
  `minzn` int(2) NOT NULL DEFAULT '0',
  `maxzn` int(5) NOT NULL DEFAULT '100',
  `firstzn` varchar(20) NOT NULL,
  `cifrzn` int(2) NOT NULL DEFAULT '0',
  `vidzn` int(2) NOT NULL DEFAULT '0',
  `lead_num` varchar(20) NOT NULL DEFAULT '0',
  `helps` longtext NOT NULL,
  `txt1` longtext NOT NULL,
  `txt2` longtext NOT NULL,
  `show1` int(2) NOT NULL DEFAULT '1',
  `show2` int(2) NOT NULL DEFAULT '1',
  `pvivod` int(2) NOT NULL DEFAULT '1',
  `psys_id` bigint(20) NOT NULL DEFAULT '0',
  `psys_title` longtext NOT NULL,
  `vtype_id` bigint(20) NOT NULL DEFAULT '0',
  `vtype_title` longtext NOT NULL,
  `quickpay` bigint(20) NOT NULL DEFAULT '0',
  `cf_hidden` int(2) NOT NULL DEFAULT '0',
  `psys_logo` longtext NOT NULL,
  `reserv_place` varchar(150) NOT NULL DEFAULT '0',
  `inmon1` varchar(50) NOT NULL DEFAULT '0',
  `inmon2` varchar(50) NOT NULL DEFAULT '0',
  `reserv_order` bigint(20) NOT NULL DEFAULT '0',
  `check_text` longtext NOT NULL,
  `check_purse` varchar(150) NOT NULL DEFAULT '0',
  `helps2` longtext NOT NULL,
  `user_account` int(2) NOT NULL DEFAULT '1',
  `site_order` bigint(20) NOT NULL DEFAULT '0',
  `max_reserv` varchar(50) NOT NULL DEFAULT '0',
  `payout_com` varchar(50) NOT NULL DEFAULT '0',
  `paybonus` int(2) NOT NULL DEFAULT '0',
  `vo_cat` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `pr_valuts`
--

INSERT INTO `pr_valuts` (`id`, `valut_logo`, `valut_decimal`, `valut_status`, `valut_reserv`, `xml_value`, `inday1`, `inday2`, `minzn`, `maxzn`, `firstzn`, `cifrzn`, `vidzn`, `lead_num`, `helps`, `txt1`, `txt2`, `show1`, `show2`, `pvivod`, `psys_id`, `psys_title`, `vtype_id`, `vtype_title`, `quickpay`, `cf_hidden`, `psys_logo`, `reserv_place`, `inmon1`, `inmon2`, `reserv_order`, `check_text`, `check_purse`, `helps2`, `user_account`, `site_order`, `max_reserv`, `payout_com`, `paybonus`, `vo_cat`) VALUES
(1, '/wp-content/uploads/Perfect-Money.png', 4, 1, '1000', 'PMUSD', '0', '0', 0, 0, '', 0, 0, '1', '', '', '', 1, 1, 1, 2, '[en_US:]Perfect Money[:en_US][ru_RU:]Perfect Money[:ru_RU]', 3, 'USD', 0, 0, '/wp-content/uploads/Perfect-Money.png', '0', '0', '0', 0, '', '0', '', 1, 1, '0', '0', 0, 1),
(2, '/wp-content/uploads/Okpay.png', 4, 1, '1000', 'OKUSD', '0', '0', 0, 0, '', 0, 0, '1', '', '', '', 1, 1, 1, 4, '[en_US:]Okpay[:en_US][ru_RU:]Okpay[:ru_RU]', 3, 'USD', 3, 0, '/wp-content/uploads/Okpay.png', '0', '0', '0', 0, '', '0', '', 1, 5, '0', '0', 0, 1),
(3, '/wp-content/uploads/WebMoney.png', 4, 1, '1000', 'WMZ', '0', '0', 0, 0, '', 0, 0, '1', '', '', '', 1, 1, 1, 1, '[en_US:]Webmoney[:en_US][ru_RU:]Webmoney[:ru_RU]', 3, 'USD', 0, 0, '/wp-content/uploads/WebMoney.png', '0', '0', '0', 0, '', '0', '', 1, 3, '0', '0', 0, 1),
(4, '/wp-content/uploads/WebMoney.png', 4, 1, '1000', 'WMR', '0', '0', 0, 0, '', 0, 0, '100', '', '', '', 1, 1, 1, 1, '[en_US:]Webmoney[:en_US][ru_RU:]Webmoney[:ru_RU]', 1, 'RUB', 0, 0, '/wp-content/uploads/WebMoney.png', '0', '0', '0', 0, '', '0', '', 1, 4, '0', '0', 0, 1),
(5, '/wp-content/uploads/Privatbank.png', 4, 1, '1000', 'P24UAH', '0', '0', 0, 0, '', 0, 0, '1000', '', '', '', 1, 1, 1, 5, '[en_US:]Privat24[:en_US][ru_RU:]Приват24[:ru_RU]', 4, 'UAH', 0, 0, '/wp-content/uploads/Privatbank.png', '0', '0', '0', 0, '', '0', '', 1, 8, '0', '0', 0, 1),
(6, '/wp-content/uploads/Yandex.png', 4, 1, '1000', 'YAMRUB', '0', '0', 0, 0, '', 0, 0, '100', '', '', '', 1, 1, 1, 3, '[en_US:]Yandex.Money[:en_US][ru_RU:]Яндекс.Деньги[:ru_RU]', 1, 'RUB', 2, 0, '/wp-content/uploads/Yandex.png', '0', '0', '0', 0, '', '0', '', 1, 6, '0', '0', 0, 1),
(7, '/wp-content/uploads/Sberbank.png', 4, 1, '1000', 'SBERRUB', '0', '0', 0, 0, '', 1, 1, '100', '', '', '', 1, 1, 1, 6, '[en_US:]Sberbank[:en_US][ru_RU:]Сбербанк[:ru_RU]', 1, 'RUB', 0, 0, '/wp-content/uploads/Sberbank.png', '0', '0', '0', 0, '', '0', '', 1, 7, '0', '0', 0, 3),
(8, '/wp-content/uploads/Perfect-Money.png', 4, 1, '1000', 'PMEUR', '0', '0', 0, 0, '', 0, 0, '1', '', '', '', 1, 1, 1, 2, '[en_US:]Perfect Money[:en_US][ru_RU:]Perfect Money[:ru_RU]', 2, 'EUR', 0, 0, '/wp-content/uploads/Perfect-Money.png', '0', '0', '0', 0, '', '0', '', 1, 2, '0', '0', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pr_valuts_account`
--

CREATE TABLE IF NOT EXISTS `pr_valuts_account` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `valut_id` bigint(20) NOT NULL DEFAULT '0',
  `accountnum` longtext NOT NULL,
  `count_visit` int(5) NOT NULL DEFAULT '0',
  `max_visit` int(5) NOT NULL DEFAULT '0',
  `text_comment` longtext NOT NULL,
  `inday` varchar(50) NOT NULL DEFAULT '0',
  `inmonth` varchar(50) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_verify_bids`
--

CREATE TABLE IF NOT EXISTS `pr_verify_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `auto_status` int(1) NOT NULL DEFAULT '1',
  `edit_user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `user_login` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_ip` varchar(250) NOT NULL,
  `comment` longtext NOT NULL,
  `locale` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_vo_support`
--

CREATE TABLE IF NOT EXISTS `pr_vo_support` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `menu_item` bigint(20) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `pr_zapros_reserv`
--

CREATE TABLE IF NOT EXISTS `pr_zapros_reserv` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zdate` datetime NOT NULL,
  `email` varchar(250) NOT NULL,
  `naps_id` bigint(20) NOT NULL DEFAULT '0',
  `naps_title` longtext NOT NULL,
  `zsum` varchar(250) NOT NULL,
  `comment` longtext NOT NULL,
  `locale` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
