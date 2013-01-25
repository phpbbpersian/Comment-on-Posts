<?php
/**
*
* @package phpBB3
* @version $Id$
* @copyright (c) 2013 Ali@php (Ali Faraji - http://www.phpbbpersian.com)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// Common global functions

/**
* set_var
*
* Set variable, used by {@link request_var the request_var function}
*
* @access private
*/
function show_comment($post_rowid, $topic_id, $forum_id)
{
	global $db, $user, $auth, $config, $template, $start, $cdelete_id, $cedit_id, $post_id, $phpbb_root_path, $phpEx;

	$sql_array = array(
		'SELECT'    => 'c.*, u.user_id, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_colour, u.user_rank',
		'FROM'      => array(
			COMMENTS_TABLE => 'c',
			USERS_TABLE    => 'u'
		),
		'WHERE'     =>  'c.poster_id = u.user_id
						AND post_id = ' . $post_rowid,

		'ORDER_BY'  => 'c.comment_time '. $config['comments_order'] ,
	);
	$sql = $db->sql_build_query('SELECT', $sql_array);
	$limit = request_var('limit', 0);
	if ($post_id && $limit && $post_id == $post_rowid)
	{
	$result = $db->sql_query_limit($sql,$limit + $config['comments_limit']);
	}
	else
	{
	$result = $db->sql_query_limit($sql,$config['comments_limit']);
	}
	$getcomment = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	$i = 0;
	foreach ($getcomment as $commentbody)
	{
		$commentbody['bbcode_options'] = (($commentbody['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
			(($commentbody['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) + 
			(($commentbody['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
		$text = generate_text_for_display($commentbody['text'], $commentbody['bbcode_uid'], $commentbody['bbcode_bitfield'], $commentbody['bbcode_options']);
		$linkid = $commentbody['id'];
		$comdelete_allowed = ($user->data['is_registered'] && ($auth->acl_get('m_comdelete', $forum_id) || (
			$user->data['user_id'] == $commentbody['poster_id'] &&
			$auth->acl_get('f_comdelete', $forum_id)
		)));
		$comedit_allowed = ($user->data['is_registered'] && ($auth->acl_get('m_comedit', $forum_id) || (
			$user->data['user_id'] == $commentbody['poster_id'] &&
			$auth->acl_get('f_comedit', $forum_id)
		)));

		if ($cdelete_id && !$user->data['is_registered']) 
		{
			login_box('', $user->lang['COMMENT_DELETE_LOGIN']);
		}
		if ($cedit_id && !$user->data['is_registered']) 
		{
			login_box('', $user->lang['COMMENT_EDIT_LOGIN']);
		}

		if ($cdelete_id && $auth->acl_get('f_comdelete', $forum_id) && !$auth->acl_get('m_comdelete', $forum_id)) 
		{
			$sql = 'SELECT poster_id
				FROM ' . COMMENTS_TABLE . ' 
				WHERE id = " ' . request_var('cd', 0). '"';
			$result = $db->sql_query($sql);
			$poster = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			
			if ($user->data['user_id'] != $poster['poster_id']) 
			{
				$comment_redirect = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "t=$topic_id&amp;p=$post_rowid" . (($start == 0) ? '' : "&amp;start=$start") ."#p$post_rowid");
				$comerror = $user->lang['COMMENT_DELETE_PERMISSION'] . '<br /><br />' . sprintf($user->lang['RETURN_POST'], '<a href="' . $comment_redirect . '">', '</a>');
				trigger_error($comerror);
			}
		}
		if ($cedit_id && $auth->acl_get('f_comedit', $forum_id) && !$auth->acl_get('m_comdedit', $forum_id))
		{
			$sql = 'SELECT poster_id
				FROM ' . COMMENTS_TABLE . ' 
				WHERE id = " ' . request_var('ce', 0). '"';
			$result = $db->sql_query($sql);
			$poster = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			
			if ($user->data['user_id'] != $poster['poster_id']) 
			{
				$comment_redirect = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "t=$topic_id&amp;p=$post_rowid" . (($start == 0) ? '' : "&amp;start=$start") ."#p$post_rowid");
				$comerror = $user->lang['COMMENT_EDIT_PERMISSION'] . '<br /><br />' . sprintf($user->lang['RETURN_POST'], '<a href="' . $comment_redirect . '">', '</a>');
				trigger_error($comerror);
			}
		}
		
		$sql = 'SELECT rank_title
			FROM ' . RANKS_TABLE . '
			WHERE rank_id = ' . $commentbody['user_rank'] . '';
		$result = $db->sql_query($sql);
		$rank = $db->sql_fetchrow($result);

		$db->sql_freeresult($result);
		
		
		$template->assign_block_vars('postrow.comment', array(
			'TEXT'		    => $text,
			'COMMENT_DATE'  => $user->format_date($commentbody['comment_time'], false),
			'AVATAR' 		=> get_user_avatar($commentbody['user_avatar'], $commentbody['user_avatar_type'], $commentbody['user_avatar_width'] / 2, $commentbody['user_avatar_height'] / 2),
			'USERNAME'		=> $commentbody['username'],
			'COLOUR'		=> $commentbody['user_colour'],
			'COMMENT_ID'    => $commentbody['id'],
			'OWNCOMMENT'	=> $user->data['user_id'] == $commentbody['poster_id'],
			'F_COMDELETE'	=> $auth->acl_get('f_comdelete', $forum_id),
			'M_COMDELETE'	=> $auth->acl_get('m_comdelete'),
			'U_COMDELETE'	=> ($comdelete_allowed) ? append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id&amp;p=$post_rowid" . (($start == 0) ? '' : "&amp;start=$start") ."&amp;cd=$linkid") : '',
			'U_COMDEDIT'	=> ($comedit_allowed) ? append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id&amp;p=$post_rowid" . (($limit == NULL) ? '' : "&amp;limit=".((($limit == $config['comments_limit']) ? $config['comments_limit'] : $limit))."") ."" . (($start == 0) ? '' : "&amp;start=$start") ."&amp;ce=$linkid#c$linkid") : '',
			'U_PROFILE'		=>  append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" .$commentbody['poster_id']. ""),
			'RANK_TITLE'	=> $rank['rank_title'],
		));
		
		
		if ($post_id == $post_rowid && ++$i == ($limit + $config['comments_limit'])) 
		{
			break;
		}
	}
	generate_smilies('inline', $forum_id, 'comments');


}
function add_comment($box_id, $topic_id, $forum_id) 
{
	global $db, $start, $config, $phpbb_root_path, $user, $errors, $phpEx;

	$form_key = 'send_comment';
	add_form_key($form_key);

		if (!check_form_key($form_key))
		{
			$errors[] = $user->lang['FORM_INVALID'];
		}
	
		$text = utf8_normalize_nfc(request_var('comment', '', true));

		if ((($config['max_comments_char'] == 0) ? '' : mb_strlen($text) > $config['max_comments_char']) ^ mb_strlen($text) < $config['min_comments_char'])
		{
			$comment_redirect = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "t=$topic_id&amp;box=$box_id" . (($start == 0) ? '' : "&amp;start=$start") ."#sendcomment");
			$comlenerror = (mb_strlen($text) > $config['max_comments_char'] ? sprintf($user->lang['CHARACHTER_LIMIT_MAX'], $config['max_comments_char']) :  sprintf($user->lang['CHARACHTER_LIMIT_MIN'], $config['min_comments_char'])) . '<br /><br />' . sprintf($user->lang['RETURN_COMMENT_SEND'], '<a href="' . $comment_redirect . '">', '</a>');
			trigger_error($comlenerror);
		}
	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

	$sql_ary = array(
		'text'              => $text,
		'comment_time'      => time(),
		'topic_id'          => $topic_id,
		'post_id'           => $box_id,
		'poster_id'			=> $user->data['user_id'],
		'bbcode_uid'        => $uid,
		'bbcode_bitfield'   => $bitfield,
		'bbcode_options'    => $options,
		'enable_bbcode'     => $allow_bbcode,
		'enable_magic_url'  => $allow_urls,
		'enable_smilies'    => $allow_smilies,
	);
		
	
	$sql = 'INSERT INTO ' . COMMENTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);
	$post_address = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id" . (($start == 0) ? '' : "&amp;start=$start") ."#p$box_id");
	
	include_once($phpbb_root_path . 'includes/functions_privmsgs.' . $phpEx);
	
	$touser = request_var('poster', 0);
	$message = "".sprintf($user->lang['COMMENT_PM'], '<a href="' . $post_address . '">', '</a>',$user->data['username'], '<br />[quote]'.utf8_normalize_nfc(request_var('comment', '')).'[/quote]');	
	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_smilies = $allow_urls = true;
	generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
	$message = generate_text_for_display($message, $uid, $bitfield, $options);

	$pm_data = array(
		'from_user_id'			=> $user->data['user_id'],
		'from_user_ip'			=> $user->data['user_ip'],
		'from_username'			=> $user->data['username'],
		'enable_sig'			=> true,
		'enable_bbcode'			=> $allow_bbcode,
		'enable_smilies'		=> $allow_smilies,
		'enable_urls'			=> $allow_urls,
		'icon_id'				=> 0,
		'bbcode_bitfield'		=> $bitfield,
		'bbcode_uid'			=> $uid,
		'message'				=> $message,
		'address_list'			=> array ('u' => array($touser => 'to')),
	);


	submit_pm('post', $user->lang['COMMENT_PM_SUBJECT'], $pm_data, true, false);

	$comment_redirect = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id&amp;p=$box_id" . (($start == 0) ? '' : "&amp;start=$start") ."#p$box_id");
	$comsuccess = $user->lang['COMMENT_SUBMIT_SUCCESS'] . '<br /><br />' . sprintf($user->lang['RETURN_POST'], '<a href="' . $comment_redirect . '">', '</a>');
	trigger_error($comsuccess);

}
function delete_comment($forum_id, $topic_id, $post_id, $cdelete_id)
{
	global $db, $user, $phpbb_root_path, $phpEx;
	
    if (confirm_box(true))
    {
		$sql = 'DELETE FROM ' . COMMENTS_TABLE . ' 
				WHERE id = ' . $cdelete_id . '';
		$db->sql_query($sql);
		$comment_redirect = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id&amp;p=$post_id#p$post_id");
		$comsuccess = $user->lang['COMMENT_DELETE_SUCCESS'] . '<br /><br />' . sprintf($user->lang['RETURN_POST'], '<a href="' . $comment_redirect . '">', '</a>');
		trigger_error($comsuccess);
    }
    else
    {
		confirm_box(false,$user->lang['COMMENT_DELETE_CONFIRM']);
    }
}
function edit_comment($cedit_id)
{
	global $db, $template;
	
	$sql = 'SELECT text, bbcode_uid
		FROM ' . COMMENTS_TABLE . '
		WHERE id = ' . $cedit_id . '';
	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);
	decode_message($row['text'], $row['bbcode_uid']);
	
	$template->assign_vars(array(
		'EDITTEXT'			=> $row['text'],
	));
	$db->sql_freeresult($result);
}
function update_comment($forum_id, $topic_id, $post_id, $cedit_id)
{
	global $db, $user, $config, $errors, $phpbb_root_path, $start, $phpEx;

	$form_key = 'edit_comment';
	add_form_key($form_key);

		if (!check_form_key($form_key))
		{
			$errors[] = $user->lang['FORM_INVALID'];
		}	

	$text = utf8_normalize_nfc(request_var('comment', '', true));
		
		
		if ((($config['max_comments_char'] == 0) ? '' : mb_strlen($text) > $config['max_comments_char']) ^ mb_strlen($text) < $config['min_comments_char'])
		{
			$limit = request_var('limit', 0); 
			$comment_redirect =  append_sid("{$phpbb_root_path}viewtopic.$phpEx", "t=$topic_id&amp;p=$post_id" . (($limit == NULL) ? '' : "&amp;limit=".((($limit == $config['comments_limit']) ? $config['comments_limit'] : $limit))."") ."" . (($start == 0) ? '' : "&amp;start=$start") ."&amp;ce=$cedit_id#c$cedit_id");
			$comlenerror = (mb_strlen($text) > $config['max_comments_char'] ? sprintf($user->lang['CHARACHTER_LIMIT_MAX'], $config['max_comments_char']) :  sprintf($user->lang['CHARACHTER_LIMIT_MIN'], $config['min_comments_char'])) . '<br /><br />' . sprintf($user->lang['RETURN_COMMENT_EDIT'], '<a href="' . $comment_redirect . '">', '</a>');
			trigger_error($comlenerror);
		}
	
	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

	$sql_ary = array(
		'text'              => $text,
		'topic_id'          => $topic_id,
		'post_id'           => request_var('post_id', 0),
		'poster_id'			=> $user->data['user_id'],
		'bbcode_uid'        => $uid,
		'bbcode_bitfield'   => $bitfield,
		'bbcode_options'    => $options,
		'enable_bbcode'     => $allow_bbcode,
		'enable_magic_url'  => $allow_urls,
		'enable_smilies'    => $allow_smilies,
	);

	$sql = 'UPDATE ' . COMMENTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE id = ' . $cedit_id . '';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	$comment_redirect = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;t=$topic_id&amp;p=$post_id#p$post_id");
	$comsuccess = $user->lang['COMMENT_EDIT_SUCCESS'] . '<br /><br />' . sprintf($user->lang['RETURN_POST'], '<a href="' . $comment_redirect . '">', '</a>');
	trigger_error($comsuccess);
}
?>