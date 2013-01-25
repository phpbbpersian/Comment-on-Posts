<?php
/**
 *
 * @author Ali@php (Ali Faraji) admin@phpbbpersian.com
 * @version $Id$
 * @copyright (c) 2013 ali@php (Ali Faraji)
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
 * @ignore
 */
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();


if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'Comment on Posts';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'comment_on_posts_version';


// The language file which will be included when installing
$language_file = 'mods/info_acp_comments';


/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
//$logo_img = 'styles/prosilver/imageset/site_logo.gif';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'0.1.0' => array(

		'permission_add' => array(
			array('f_comedit', 0),
			array('m_comedit', 1),
			array('f_comdelete', 0),
			array('m_comdelete', 1),
			array('u_seecom', 1),
			array('f_sendcom', 0),
		),
		
		'permission_set' => array(
			// Roles
			array('ROLE_FORUM_STANDARD', 'f_sendcom', 'role'),
			array('ROLE_FORUM_STANDARD', 'f_comdelete', 'role'),
			array('ROLE_FORUM_STANDARD', 'f_comedit', 'role'),
			array('ROLE_FORUM_FULL', 'f_sendcom', 'role'),
			array('ROLE_FORUM_FULL', 'f_comdelete', 'role'),
			array('ROLE_FORUM_FULL', 'f_comedit', 'role'),
			// Groups
			array('GUESTS', 'u_seecom', 'group'),
			array('REGISTERED', 'u_seecom', 'group'),
			array('GLOBAL_MODERATORS', 'm_comdelete', 'group'),
			array('GLOBAL_MODERATORS', 'm_comedit', 'group'),
		),

		'table_add' => array(
			array($table_prefix . 'comments', array(
				'COLUMNS' => array(
					'id' => array('UINT', NULL, 'auto_increment'),
					'post_id' => array('UINT', NULL, ''),
					'topic_id' => array('UINT', NULL, ''),
					'poster_id' => array('TIMESTAMP', NULL, ''),
					'comment_time' => array('TIMESTAMP', 0),
					'text' => array('MTEXT', NULL, ''),
					'bbcode_bitfield' => array('VCHAR', NULL, ''),
					'bbcode_uid' => array('VCHAR:8', NULL, ''),
					'bbcode_options' => array('UINT', NULL, ''),
					'enable_bbcode' => array('BOOL', 1, ''),
					'enable_smilies' => array('BOOL', 1, ''),
					'enable_magic_url' => array('BOOL', 1, ''),
				),

				'PRIMARY_KEY'	=> 'id'
			)),

		),

		'config_add' => array(
			array('enable_comments', '1', 0),
			array('comments_limit', '5', 0),
			array('max_comments_char', '0', 0),
			array('min_comments_char', '1', 0),
			array('comments_order', 'ASC', 0),
		),

		
		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_COMMENTS'),

			array('acp', 'ACP_COMMENTS', array(
					'module_basename'		=> 'comments',
					'modes'					=> array('settings'),
				),
			),
		),
		
		'cache_purge'  => array('template'),
		
	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);