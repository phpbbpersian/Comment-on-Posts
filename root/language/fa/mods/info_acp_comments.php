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
    'ACP_COMMENTS'					=> 'دیدگاه در پست',
	'COMMENT_ASC'					=> 'صعودی',
	'COMMENT_DESC'					=> 'نزولی',
	'COMMENTS_LIMIT'				=> 'تعداد دیدگاه در هر بارگذاری',
	'COMMENTS_LIMIT_EXPLAIN'		=> 'به طور پیشفرض به همین تعداد دیدگاه نمایش داده خواهد شد و اگر بر روی "بارگذاری دیدگاه بیشتر" کلیک شود. همین تعداد دیدگاه به تعداد قبلی اضافه خواهد شد.',
	'COMMENTS_MAXCHAR'				=> 'حداکثر کاراکتر مورد قبول در ارسال دیدگاه',
	'COMMENTS_MAXCHAR_EXPLAIN'		=> 'کاربران اجازه ارسال دیدگاه بیشتر از این تعداد کاراکتر را نخواهد داشت',
	'COMMENTS_MINCHAR'				=> 'حداقل کاراکتر مورد قبول در ارسال دیدگاه',
	'COMMENTS_MINCHAR_EXPLAIN'		=> 'کاربران اجازه ارسال دیدگاه کمتر از این تعداد کاراکتر را نخواهند داشت.',
	'COMMENTS_TITLE'				=> 'افزونه دیدگاه در پست ها',	
	'COMMENTS_TITLE_EXPLAIN'		=> 'ارسال دیدگاه به پست های ارسالی در انجمن',
	'COMMENT_ORDER'					=> 'چیدمان دیدگاه ها',
	'COMMENT_ORDER_EXPLAIN'			=> 'چیدمان دیدگاه ها را مشخص کنید.',
	'ENABLE_COMMENTS'				=> 'فعال کردن افزونه دیدگاه در پست ها',
	'ENABLE_COMMENTS_EXPLAIN'		=> 'گر بله را انتخاب کنید، افزونه فعال خواهد شد.',
	'GLOBAL_SETTINGS'				=> 'تنظیمات عمومی',
	'SUBMIT_SETTINGS'				=> 'ذخیره تغییرات',

	));
?>