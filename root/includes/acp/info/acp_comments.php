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
* @package module_install
*/
class acp_comments_info
{
    function module()
    { 
    return array(
        'filename'    => 'acp_comments',
        'title'        => 'ACP_COMMENTS',
        'version'    => '1.0.0',
        'modes'        => array(
            'settings'        => array('title' => 'ACP_COMMENTS', 'auth' => 'acl_a_modules', 'cat' => array('ACP_CAT_DOT_MODS')),

            ),
        );
        
    }
                            
    function install()
    {
    }
                                
    function uninstall()
    {
    }

}
?>