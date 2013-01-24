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
    'CHARACHTER_LIMIT_MAX'          => 'دیدگاه ارسالی حداکثر باید %s کاراکتر باشد.',
	'CHARACHTER_LIMIT_MIN'          => 'دیدگاه ارسالی حداقل باید %s کاراکتر باشد.',
	'COMMENT_DELETE_CONFIRM'		=> 'آیا از حذف این دیدگاه مطمئن هستید ؟',
    'COMMENT_DELETE_LOGIN'			=> 'برای حذف دیدگاه باید وارد شوید.',
	'COMMENT_DELETE_PERMISSION'		=> 'اجازه حذف این دیدگاه را ندارید.',
	'COMMENT_DELETE_SUCCESS'		=> 'یدگاه با موفقیت حذف شد.',
    'COMMENT_EDIT_LOGIN'			=> 'برای ویرایش دیدگاه باید وارد شوید.',
	'COMMENT_EDIT_PERMISSION'		=> 'اجازه ویرایش این دیدگاه را ندارید.',
	'COMMENT_EDIT_SUCCESS'			=> 'دیدگاه با موفقیت ویرایش شد.',
    'COMMENT_PM'					=> 'دیدگاه جدیدی در %sاین پست%s شما، توسط %s ارسال شده است. %s',
    'COMMENT_PM_SUBJECT'			=> 'دیدگاه جدیدی در پست شما ارسال شده است',                     
    'COMMENT_SUBMIT_SUCCESS'		=> 'دیدگاه با موفقیت ثبت شد.',
	'MORE_COMMENT'					=> 'بارگذاری دیدگاه بیشتر',
	'RETURN_COMMENT_EDIT'			=> '%sبازگشت به ویرایش دیدگاه%s',
    'RETURN_COMMENT_SEND'    		=> '%sبازگشت به ارسال دیدگاه%s',
	'SEND_COMMENT'					=> 'ارسال دیدگاه به این پست',
	'SEND_COMMENT_TITLE'			=> 'ارسال دیدگاه',
                    
));
            
?>