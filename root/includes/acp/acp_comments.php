<?php
/** 
*
* @package acp
* @version $Id$
* @copyright (c) Ali@php (Ali Faraji - http://www.phpbbpersian.com)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
            
/**
* @package acp
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_comments
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		
			$action	= request_var('action', '');
			$submit = (isset($_POST['submit'])) ? true : false;
			$form_key = 'acp_comments';	
			add_form_key($form_key);	
if ($submit && !check_form_key($form_key))
{
	$error[] = $user->lang['FORM_INVALID'];
}	
$this->page_title = 'ACP_COMMENTS';
$this->tpl_name = 'acp_comments';
$display_vars = array(
    'title' => 'ACP_COMMENT_SETTINGS',
    'vars'    => array(
        'legend1'             			=> 'GLOBAL_SETTINGS',
        'enable_comments'               => array('lang' => 'ENABLE_COMMENTS',   'validate' => 'bool',           'type' => 'radio:yes_no',   'explain' => true),
		'comments_limit'                => array('lang' => 'COMMENTS_LIMIT',    'validate' => 'int:0',          'type' => 'text:5:4',           'explain' => true),
		'comments_maxchar'              => array('lang' => 'COMMENTS_MAXCHAR',  'validate' => 'int:0',          'type' => 'text:5:4',           'explain' => true),
		'comments_minchar'              => array('lang' => 'COMMENTS_MINCHAR',  'validate' => 'int:0',          'type' => 'text:5:4',           'explain' => true),
		'comments_order'                => array('lang' => 'COMMENT_ORDER',		'validate' => 'string',			'type' => 'select', 'method' => 'comment_order', 'explain' => true),
		 
    ), 
);
 
$this->new_config = $config;
$cfg_array = (isset($_REQUEST['config'])) ? request_var('config', array('' => '')) : $this->new_config;
$error = array();
$template->assign_vars(array(
	'U_ACTION'			=> $this->u_action
));
validate_config_vars($display_vars['vars'], $cfg_array, $error);
foreach ($display_vars['vars'] as $config_name => $null)
{
	if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
	{
		continue;
	}
	$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];
	if ($submit)
	{
		set_config($config_name, $config_value);
	}
}
if ($submit)
{
trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
}
foreach ($display_vars['vars'] as $config_key => $vars)
{
    if (!is_array($vars) && strpos($config_key, 'legend') === false)
    {
        continue;
    }

    if (strpos($config_key, 'legend') !== false)
    {
        $template->assign_block_vars('options', array(
            'S_LEGEND'        => true,
            'LEGEND'        => (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
        );

        continue;
    }

    $type = explode(':', $vars['type']);

    $l_explain = '';
    if ($vars['explain'] && isset($vars['lang_explain']))
    {
        $l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
    }
    else if ($vars['explain'])
    {
        $l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
    }
    $content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

    if (empty($content))
    {
        continue;
    }

    $template->assign_block_vars('options', array(
        'KEY'            => $config_key,
        'TITLE'            => (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
        'S_EXPLAIN'        => $vars['explain'],
        'TITLE_EXPLAIN' => $l_explain,
        'CONTENT'        => $content,
    ));

    unset($display_vars['vars'][$config_key]);
}
	}
	
	function comment_order($value, $key = '')
	{
		global $user;

		return '<option value="DESC"' . (($value == 'DESC') ? ' selected="selected"' : '') . '>' . $user->lang['COMMENT_DESC'] . '</option><option value="ASC"' . (($value == 'ASC') ? ' selected="selected"' : '') . '>' . $user->lang['COMMENT_ASC'] . '</option>';

	}
}

?>