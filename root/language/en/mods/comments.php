<?php
/** 
*
* comment [persian]
*
* @package languages
* @version $Id$
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
                    
/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}
                        
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
                        
$lang = array_merge($lang, array(
	'CHARACHTER_LIMIT_ERROR'        => 'Character error',
    'CHARACHTER_LIMIT_MAX'          => 'The maximum allowed length is %s.',
	'CHARACHTER_LIMIT_MIN'          => 'The minimum allowed length is %s.',
	'COMMENT_DELETE_CONFIRM'		=> 'Are you sure you want to delete this comment?',
	'COMMENT_DELETE_CONFIRM_TITLE'	=> 'Delete confirmation',
    'COMMENT_DELETE_LOGIN'			=> 'You need to login in order to delete this comment.',
	'COMMENT_DELETE_PERMISSION'		=> 'You are not allowed to delete this comment.',
	'COMMENT_DELETE_SUCCESS'		=> 'This comment has been deleted successfully.',
    'COMMENT_EDIT_LOGIN'			=> 'You need to login in order to edit this comment.',
	'COMMENT_EDIT_PERMISSION'		=> 'You are not allowed to edit this comment.',
	'COMMENT_EDIT_SUCCESS'			=> 'This comment has been edited successfully.',
	'COMMENT_EDIT_TITLE'			=> 'Edit comment',
    'COMMENT_PM'					=> '%sYour post%s has recieved new comment by %s: %s',
    'COMMENT_PM_SUBJECT'			=> 'New comment notification',                     
    'COMMENT_SUBMIT_SUCCESS'		=> 'Your comment has been posted successfully.',
	'MORE_COMMENT'					=> 'Load more comments',
	'NOT_ALLOWED_SEND'				=> 'You are not allowed to send comment.',
	'RETURN_COMMENT_EDIT'			=> '%sBack to comment edit%s',
    'RETURN_COMMENT_SEND'    		=> '%sBack to comment send%s',
	'SEND_COMMENT'					=> 'Send a comment',
	'SEND_COMMENT_TITLE'			=> 'Send comment',
                    
));
            
?>