<?php
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
    'ACP_COMMENTS'					=> 'Comment on posts',
	'COMMENT_ASC'					=> 'Ascending',
	'COMMENT_DESC'					=> 'Descending',
	'COMMENTS_LIMIT'				=> 'Number of comments per load',
	'COMMENTS_LIMIT_EXPLAIN'		=> 'Default number of comments within posts. This number of comments are add to previous loades.',
	'COMMENTS_MAXCHAR'				=> 'Maximum characters per comments',
	'COMMENTS_MAXCHAR_EXPLAIN'		=> 'The number of characters allowed within a comments. Set to 0 for unlimited characters.',
	'COMMENTS_MINCHAR'				=> 'Minimum characters per comments',
	'COMMENTS_MINCHAR_EXPLAIN'		=> 'The number of characters allowed within a comments. The minimum for this setting is 1.',
	'COMMENTS_TITLE'				=> 'Comment on Posts MOD',	
	'COMMENTS_TITLE_EXPLAIN'		=> 'Send Comments on topic posts',
	'COMMENT_ORDER'					=> 'Comments order',
	'COMMENT_ORDER_EXPLAIN'			=> 'Define comments display order',
	'ENABLE_COMMENTS'				=> 'Enable comment on posts MOD',
	'ENABLE_COMMENTS_EXPLAIN'		=> 'If disallowed MOD is disabled.',
	'GLOBAL_SETTINGS'				=> 'General settings',
	'SUBMIT_SETTINGS'				=> 'Save changes',

	));
?>