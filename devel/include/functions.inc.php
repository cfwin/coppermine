<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery 1.4.0                                           //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002-2004  Gregory DEMAR                                   //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stverud <henning@stoverud.com>          //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

/**
* Coppermine Photo Gallery 1.4.0 functions.inc.php
*
* This file has almost all the functions of Coppermine
*
* @copyright  2002,2003 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version  $Id$
*/

/**
 * user_get_profile()
 *
 * Decode the user profile contained in a cookie
 *
 **/

function user_get_profile()
{
        global $CONFIG, $USER;

        if (isset($_COOKIE[$CONFIG['cookie_name'].'_data'])) {
                $USER = @unserialize(@base64_decode($_COOKIE[$CONFIG['cookie_name'].'_data']));
        }

        if (!isset($USER['ID']) || strlen($USER['ID']) != 32) {
                list($usec, $sec) = explode(' ', microtime());
                $seed = (float) $sec + ((float) $usec * 100000);
                srand($seed);
                $USER=array('ID' => md5(uniqid(rand(),1)));
        } else {
                $USER['ID'] = addslashes($USER['ID']);
        }

        if (!isset($USER['am'])) $USER['am'] = 1;
}

// Save the user profile in a cookie


/**
 * user_save_profile()
 *
 * Save the user profile in a cookie
 *
 **/

function user_save_profile()
{
        global $CONFIG, $USER;

        $data = base64_encode(serialize($USER));
        setcookie($CONFIG['cookie_name'].'_data', $data, time()+86400*30, $CONFIG['cookie_path']);
}

/**************************************************************************
   Database functions
 **************************************************************************/

// Connect to the database

/**
 * cpg_db_connect()
 *
 * Connect to the database
 **/

function cpg_db_connect()
{
        global $CONFIG;
        $result = @mysql_connect($CONFIG['dbserver'], $CONFIG['dbuser'], $CONFIG['dbpass']);
        if (!$result)
                return false;
        if (!mysql_select_db($CONFIG['dbname']))
                return false;
        return $result;
}

// Perform a database query

/**
 * cpg_db_query()
 *
 * Perform a database query
 *
 * @param $query
 * @param integer $link_id
 * @return
 **/

function cpg_db_query($query, $link_id = 0)
{
        global $CONFIG, $query_stats, $queries;

        $query_start = cpgGetMicroTime();
        if (($link_id)) {
            $result = mysql_query($query, $link_id);
        } else {
                $result = mysql_query($query);
        }
        $query_end = cpgGetMicroTime();
        if (isset($CONFIG['debug_mode']) && (($CONFIG['debug_mode']==1) || ($CONFIG['debug_mode']==2) )) {
                $duration = round($query_end - $query_start, 3);
                $query_stats[] = $duration;
                $queries[] = "$query ({$duration}s)";
        }
        if (!$result) cpg_db_error("While executing query \"$query\" on $link_id");

        return $result;
}

// Error message if a query failed


/**
 * cpg_db_error()
 *
 * Error message if a query failed
 *
 * @param $the_error
 * @return
 **/

function cpg_db_error($the_error)
{
        global $CONFIG,$lang_errors;

        if (!$CONFIG['debug_mode']) {
            cpg_die(CRITICAL_ERROR, $lang_errors['database_query'], __FILE__, __LINE__);
        } else {

                $the_error .= "\n\nmySQL error: ".mysql_error()."\n";

                $out = "<br />".$lang_errors['database_query'].".<br /><br/>
                    <form name=\"mysql\"><textarea rows=\"8\" cols=\"60\">".htmlspecialchars($the_error)."</textarea></form>";

            cpg_die(CRITICAL_ERROR, $out, __FILE__, __LINE__);
        }
}

// Fetch all rows in an array

/**
 * cpg_db_fetch_rowset()
 *
 * Fetch all rows in an array
 *
 * @param $result
 * @return
 **/

function cpg_db_fetch_rowset($result)
{
        $rowset = array();

        while ($row = mysql_fetch_array($result)) $rowset[] = $row;

        return $rowset;
}

/**************************************************************************
   Utilities functions
 **************************************************************************/

 /**
 * @ignore
 */
 define ('LOC','YToyOntzOjE6ImwiO3M6OToie0dBTExFUll9IjtzOjE6InMiO3M6MjAwOiI8ZGl2IGNsYXNzPSJmb290ZXIiIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nLXRvcDogMTBweDsiPlBvd2VyZWQgYnkgPGEgaHJlZj0iaHR0cDovL2NvcHBlcm1pbmUuc291cmNlZm9yZ2UubmV0LyIgdGl0bGU9IkNvcHBlcm1pbmUgUGhvdG8gR2FsbGVyeSIgcmVsPSJleHRlcm5hbCI+Q29wcGVybWluZSBQaG90byBHYWxsZXJ5PC9hPjwvZGl2PiI7fQ==');

// Replacement for the die function

/**
 * cpg_die()
 *
 * Replacement for the die function
 *
 * @param $msg_code
 * @param $msg_text
 * @param $error_file
 * @param $error_line
 * @param boolean $output_buffer
 * @return
 **/

function cpg_die($msg_code, $msg_text,  $error_file, $error_line, $output_buffer = false)
{
        global $CONFIG, $lang_cpg_die, $template_cpg_die;

        // Simple output if theme file is not loaded
        if(!function_exists('pageheader')){
                echo 'Fatal error :<br />'.$msg_text;
                exit;
        }

    $ob = ob_get_contents();
        if ($ob) ob_end_clean();

        if(!$CONFIG['debug_mode']) template_extract_block($template_cpg_die, 'file_line');
        if(!$output_buffer && !$CONFIG['debug_mode']) template_extract_block($template_cpg_die, 'output_buffer');

        $params = array(
                '{MESSAGE}' => $msg_text,
                '{FILE_TXT}' => $lang_cpg_die['file'],
                '{FILE}' => $error_file,
                '{LINE_TXT}' => $lang_cpg_die['line'],
                '{LINE}' => $error_line,
                '{OUTPUT_BUFFER}' => $ob,
        );

        pageheader($lang_cpg_die[$msg_code]);
        starttable(-1, $lang_cpg_die[$msg_code]);
        echo template_eval($template_cpg_die, $params);
        endtable();
        pagefooter();
        exit;
}

// Display a localised date

/**
 * localised_date()
 *
 * Display a localised date
 *
 * @param integer $timestamp
 * @param $datefmt
 * @return
 **/

function localised_date($timestamp = -1, $datefmt)
{
    global $lang_month, $lang_day_of_week, $CONFIG;

    if ($timestamp == -1) {
        $timestamp = time();
    }
    $diff_to_GMT = date("O") / 100;

    $timestamp += ($CONFIG['time_offset'] - $diff_to_GMT) * 3600;

    $date = ereg_replace('%[aA]', $lang_day_of_week[(int)strftime('%w', $timestamp)], $datefmt);
    $date = ereg_replace('%[bB]', $lang_month[(int)strftime('%m', $timestamp)-1], $date);

    return strftime($date, $timestamp);
}

// Function to create correct URLs for image name with space or exotic characters

/**
 * path2url()
 *
 * Function to create correct URLs for image name with space or exotic characters
 *
 * @param $path
 * @return
 **/

function path2url($path)
{
        return str_replace("%2F","/",rawurlencode($path));
}

// Display a 'message box like' table

/**
 * msg_box()
 *
 * Display a 'message box like' table
 *
 * @param $title
 * @param $msg_text
 * @param string $button_text
 * @param string $button_link
 * @param string $width
 * @return
 **/

function msg_box($title, $msg_text, $button_text="", $button_link="", $width="-1")
{
        global $template_msg_box;

        if (!$button_text) {
            template_extract_block($template_msg_box, 'button');
        }

        $params = array(
                '{MESSAGE}' => $msg_text,
                '{LINK}' => $button_link,
                '{TEXT}' => $button_text
        );

        starttable($width, $title);
        echo template_eval($template_msg_box, $params);
        endtable();
}


/**
 * create_tabs()
 *
 * @param $items
 * @param $curr_page
 * @param $total_pages
 * @param $template
 * @return
 **/

function create_tabs($items, $curr_page, $total_pages, $template)
{
        global $CONFIG;

        if (function_exists('theme_create_tabs')) {
            theme_create_tabs($items, $curr_page, $total_pages, $template);
                return;
        }

        $maxTab = $CONFIG['max_tabs'];

        $tabs = sprintf($template['left_text'], $items, $total_pages);
        if (($total_pages == 1)) return $tabs;

        $tabs .= $template['tab_header'];
        if ($curr_page == 1) {
                $tabs .= sprintf($template['active_tab'], 1);
        } else {
                $tabs .= sprintf($template['inactive_tab'], 1, 1);
        }
        if ($total_pages > $maxTab){
                $start = max(2, $curr_page - floor(($maxTab -2)/2));
                $start = min($start, $total_pages - $maxTab +2);
                $end = $start + $maxTab -3;
        } else {
                $start = 2;
                $end = $total_pages-1;
        }
        for ($page = $start ; $page <= $end; $page++) {
                if ($page == $curr_page) {
                        $tabs .= sprintf($template['active_tab'], $page);
                } else {
                        $tabs .= sprintf($template['inactive_tab'], $page, $page);
                }
        }
        if ($total_pages > 1){
                if ($curr_page == $total_pages) {
                        $tabs .= sprintf($template['active_tab'], $total_pages);
                } else {
                        $tabs .= sprintf($template['inactive_tab'], $total_pages, $total_pages);
                }
        }
        return $tabs.$template['tab_trailer'];
}

/**
 * Rewritten by Nathan Codding - Feb 6, 2001. Taken from phpBB code
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 *         to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 *         to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *                to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */

/**
 * make_clickable()
 *
 * @param $text
 * @return
 **/

function make_clickable($text)
{
        $ret = " " . $text;
        $ret = preg_replace("#([\n ])([a-z]+?)://([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)#i", "\\1<a href=\"\\2://\\3\" rel=\"external\">\\2://\\3</a>", $ret);
        $ret = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]*)?)#i", "\\1<a href=\"http://www.\\2.\\3\\4\" rel=\"external\">www.\\2.\\3\\4</a>", $ret);
        $ret = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
        $ret = substr($ret, 1);

        return($ret);
}

// Allow the use of a limited set of phpBB bb codes in albums and image descriptions
// Taken from phpBB code

/**
 * bb_decode()
 *
 * @param $text
 * @return
 **/

function bb_decode($text)
{
        $text = nl2br($text);

        static $bbcode_tpl = array();
        static $patterns = array();
        static $replacements = array();

        // First: If there isn't a "[" and a "]" in the message, don't bother.
        if ((strpos($text, "[") === false || strpos($text, "]") === false))
        {
                return $text;
        }

        // [b] and [/b] for bolding text.
        $text = str_replace("[b]", '<b>', $text);
        $text = str_replace("[/b]", '</b>', $text);

        // [u] and [/u] for underlining text.
        $text = str_replace("[u]", '<u>', $text);
        $text = str_replace("[/u]", '</u>', $text);

        // [i] and [/i] for italicizing text.
        $text = str_replace("[i]", '<i>', $text);
        $text = str_replace("[/i]", '</i>', $text);

        // colours
        $text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+)\]/", '<span style="color:$1">', $text);
        $text = str_replace("[/color]", '</span>', $text);

        // [i] and [/i] for italicizing text.
        //$text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
        //$text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);

        if (!count($bbcode_tpl)) {
                // We do URLs in several different ways..
                $bbcode_tpl['url']  = '<span class="bblink"><a href="{URL}" rel="external">{DESCRIPTION}</a></span>';
                $bbcode_tpl['email']= '<span class="bblink"><a href="mailto:{EMAIL}">{EMAIL}</a></span>';

                $bbcode_tpl['url1'] = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
                $bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1\\2', $bbcode_tpl['url1']);

                $bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
                $bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);

                $bbcode_tpl['url3'] = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
                $bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url3']);

                $bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
                $bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url4']);

                $bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);

                // [url]xxxx://www.phpbb.com[/url] code..
                $patterns[1] = "#\[url\]([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si";
                $replacements[1] = $bbcode_tpl['url1'];

                // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
                $patterns[2] = "#\[url\]([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si";
                $replacements[2] = $bbcode_tpl['url2'];

                // [url=xxxx://www.phpbb.com]phpBB[/url] code..
                $patterns[3] = "#\[url=([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si";
                $replacements[3] = $bbcode_tpl['url3'];

                // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
                $patterns[4] = "#\[url=([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si";
                $replacements[4] = $bbcode_tpl['url4'];

                // [email]user@domain.tld[/email] code..
                $patterns[5] = "#\[email\]([a-z0-9\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
                $replacements[5] = $bbcode_tpl['email'];

                // [img]xxxx://www.phpbb.com[/img] code..
                $bbcode_tpl['img']  = '<img src="{URL}" />';
                $bbcode_tpl['img']  = str_replace('{URL}', '\\1\\2', $bbcode_tpl['img']);

                $patterns[6] = "#\[img\]([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/img\]#si";
                $replacements[6] = $bbcode_tpl['img'];

        }

        $text = preg_replace($patterns, $replacements, $text);

        return $text;
}

/**************************************************************************
   Template functions
 **************************************************************************/

// Load and parse the template.html file

/**
 * load_template()
 *
 * Load and parse the template.html file
 *
 * @return
 **/

function load_template()
{
        global $THEME_DIR, $CONFIG, $template_header, $template_footer;

        $tmpl_loc = array();
        $tmpl_loc = unserialize(base64_decode(LOC));

        if (file_exists(TEMPLATE_FILE)) {
            $template_file = TEMPLATE_FILE;
        } elseif (file_exists($THEME_DIR . TEMPLATE_FILE)) {
            $template_file = $THEME_DIR . TEMPLATE_FILE;
        } else die("<b>Coppermine critical error</b>:<br />Unable to load template file ".TEMPLATE_FILE."!</b>");

        $template = fread(fopen($template_file, 'r'), filesize($template_file));

        $template = CPGPluginAPI::filter('template_html',$template);

        $gallery_pos = strpos($template, '{LANGUAGE_SELECT_FLAGS}');
        $template = str_replace('{LANGUAGE_SELECT_FLAGS}', languageSelect('flags') ,$template);
        $gallery_pos = strpos($template, '{LANGUAGE_SELECT_LIST}');
        $template = str_replace('{LANGUAGE_SELECT_LIST}', languageSelect('list') ,$template);
        $gallery_pos = strpos($template, '{THEME_DIR}');
        $template = str_replace('{THEME_DIR}', $THEME_DIR ,$template);
        $gallery_pos = strpos($template, '{THEME_SELECT_LIST}');
        $template = str_replace('{THEME_SELECT_LIST}', themeSelect('list') ,$template);
        $gallery_pos = strpos($template, $tmpl_loc['l']);
        $template = str_replace($tmpl_loc['l'], $tmpl_loc['s'] ,$template);

        $template_header = substr($template, 0, $gallery_pos);
        $template_header = str_replace('{META}','{META}'.CPGPluginAPI::filter('page_meta',''),$template_header);

        // Filter gallery header and footer
        $template_header .= CPGPluginAPI::filter('gallery_header','');
        $template_footer = CPGPluginAPI::filter('gallery_footer','').substr($template, $gallery_pos);

        $add_version_info = "<!--Coppermine Photo Gallery ".COPPERMINE_VERSION." (".COPPERMINE_VERSION_STATUS.")-->\n</body>";
        $template_footer = ereg_replace("</body[^>]*>",$add_version_info,$template_footer);
}

// Eval a template (substitute vars with values)

/**
 * template_eval()
 *
 * @param $template
 * @param $vars
 * @return
 **/

function template_eval(&$template, &$vars)
{
        return strtr($template, $vars);
}


// Extract and return block '$block_name' from the template, the block is replaced by $subst

/**
 * template_extract_block()
 *
 * @param $template
 * @param $block_name
 * @param string $subst
 * @return
 **/

function template_extract_block(&$template, $block_name, $subst='')
{
        $pattern = "#(<!-- BEGIN $block_name -->)(.*?)(<!-- END $block_name -->)#s";
        if ( !preg_match($pattern, $template, $matches)){
                die('<b>Template error<b><br />Failed to find block \''.$block_name.'\'('.htmlspecialchars($pattern).') in :<br /><pre>'.htmlspecialchars($template).'</pre>');
        }
        $template = str_replace($matches[1].$matches[2].$matches[3], $subst, $template);
        return $matches[2];
}

/**************************************************************************
   Functions for album/picture management
 **************************************************************************/

// Get the list of albums that the current user can't see

/**
 * get_private_album_set()
 *
 * @param string $aid_str
 * @return
 **/

function get_private_album_set($aid_str="")
{
        if (GALLERY_ADMIN_MODE) return;

        global $CONFIG, $ALBUM_SET, $USER_DATA, $FORBIDDEN_SET, $FORBIDDEN_SET_DATA;

        if ($USER_DATA['can_see_all_albums']) return;

                //Stuff for Album level passwords
        if (isset($_COOKIE[$CONFIG['cookie_name']."_albpw"]) && empty($aid_str)) {
          $alb_pw = unserialize($_COOKIE[$CONFIG['cookie_name']."_albpw"]);
          $aid_str = implode(",",array_keys($alb_pw));
          $sql = "SELECT aid, MD5(alb_password) as md5_password FROM ".$CONFIG['TABLE_ALBUMS']." WHERE aid IN ($aid_str)";
          $result = cpg_db_query($sql);
          $albpw_db = array();
          if (mysql_num_rows($result)) {
            while ($data = mysql_fetch_array($result)) {
              $albpw_db[$data['aid']] = $data['md5_password'];
            }
          }
          $valid = array_intersect($albpw_db, $alb_pw);
          if (is_array($valid)) {
            $aid_str = implode(",",array_keys($valid));
          } else {
            $aid_str = "";
          }
        }

        $sql = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE visibility != '0' AND visibility !='".(FIRST_USER_CAT + USER_ID)."' AND visibility NOT IN ".USER_GROUP_SET;
        if (!empty($aid_str)) {
          $sql .= " AND aid NOT IN ($aid_str)";
                }

                $result = cpg_db_query($sql);
        if ((mysql_num_rows($result))) {
                $set ='';
            while($album=mysql_fetch_array($result)){
                    $set .= $album['aid'].',';
                    $FORBIDDEN_SET_DATA[] = $album['aid'];
            } // while
                $FORBIDDEN_SET = "p.aid NOT IN (".substr($set, 0, -1).') ';
                $ALBUM_SET = 'AND aid NOT IN ('.substr($set, 0, -1).') ';
        }else{
                  $FORBIDDEN_SET_DATA = array();
                  $FORBIDDEN_SET = "";
                  $ALBUM_SET = "";
        }
        mysql_free_result($result);
}

// Retrieve the data for a picture or a set of picture

/**
 * get_pic_data()
 *
 * @param $album
 * @param $count
 * @param $album_name
 * @param integer $limit1
 * @param integer $limit2
 * @param boolean $set_caption
 * @return
 **/

function get_pic_data($album, &$count, &$album_name, $limit1=-1, $limit2=-1, $set_caption = true)
{
        global $USER, $CONFIG, $ALBUM_SET, $CURRENT_CAT_NAME, $CURRENT_ALBUM_KEYWORD, $HTML_SUBST, $THEME_DIR, $FAVPICS, $FORBIDDEN_SET_DATA;
        global $album_date_fmt, $lastcom_date_fmt, $lastup_date_fmt, $lasthit_date_fmt, $cat;
        global $lang_get_pic_data, $lang_meta_album_names, $lang_errors;

        $sort_array = array(
          'na' => 'filename ASC',
          'nd' => 'filename DESC',
          'ta'=>'title ASC',
          'td'=>'title DESC',
          'da' => 'pid ASC',
          'dd' => 'pid DESC',
          'pa' => 'position ASC',
          'pd' => 'position DESC',
        );
         $sort_code = isset($USER['sort'])? $USER['sort'] : $CONFIG['default_sort_order'];
        $sort_order = isset($sort_array[$sort_code]) ? $sort_array[$sort_code] : $sort_array[$CONFIG['default_sort_order']];
        $limit = ($limit1 != -1) ? ' LIMIT '. $limit1 : '';
        $limit .= ($limit2 != -1) ? ' ,'. $limit2 : '';

        if ($limit2 == 1) {
            $select_columns = '*';
        } else {
            $select_columns = 'pid, filepath, filename, url_prefix, filesize, pwidth, pheight, ctime, aid';
        }

        if(count($FORBIDDEN_SET_DATA) > 0 ){
            $forbidden_set_string =" AND aid NOT IN (".implode(",", $FORBIDDEN_SET_DATA).")";
        }
        // Keyword
        if (!empty($CURRENT_ALBUM_KEYWORD)){
                $keyword = "OR (keywords like '%$CURRENT_ALBUM_KEYWORD%' $forbidden_set_string )";
        } else $keyword = '';

        // Regular albums
        if ((is_numeric($album))) {
                $album_name_keyword = get_album_name($album);
                $album_name = $album_name_keyword['title'];
                $album_keyword = $album_name_keyword['keyword'];

                if (!empty($album_keyword)) {
                        $keyword = "OR (keywords like '%$album_keyword%' $forbidden_set_string )";
                } else {
                  $keyword = '';
                }

                $approved = GALLERY_ADMIN_MODE ? '' : 'AND approved=\'YES\'';

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE (aid='$album' $forbidden_set_string ) $keyword $approved $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*') $select_columns .= ', title, caption,hits,owner_id,owner_name';

                $query = "SELECT $select_columns from {$CONFIG['TABLE_PICTURES']} WHERE (aid='$album' $forbidden_set_string ) $keyword $approved $ALBUM_SET ORDER BY $sort_order $limit";

                $result = cpg_db_query($query);
                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);
                // Set picture caption
                if ($set_caption) foreach ($rowset as $key => $row){

                        $caption = "<span class=\"thumb_title\">";
                        $caption .= ($rowset[$key]['title']||$rowset[$key]['hits']) ? $rowset[$key]['title'] : '';

            if ($CONFIG['views_in_thumbview']){
               if ($rowset[$key]['title']){
                               $caption .= "&nbsp;&ndash;&nbsp;";
               }
               $caption .= sprintf($lang_get_pic_data['n_views'], $rowset[$key]['hits']);
            }
            $caption .= "</span>";
            if ($CONFIG['caption_in_thumbview']){
                           $caption .= $rowset[$key]['caption'] ? "<span class=\"thumb_caption\">".bb_decode(($rowset[$key]['caption']))."</span>" : '';
                        }
                        if ($CONFIG['display_comment_count']) {
                                $comments_nr = count_pic_comments($row['pid']);
                                if ($comments_nr > 0) $caption .= "<span class=\"thumb_num_comments\">".sprintf($lang_get_pic_data['n_comments'], $comments_nr )."</span>";
                        }

                        if ($CONFIG['display_uploader']){
                                $caption .= '<span class="thumb_title"><a href ="profile.php?uid='.$rowset[$key]['owner_id'].'">'.$rowset[$key]['owner_name'].'</a></span>';
                        }

                        $rowset[$key]['caption_text'] = $caption;

                }

        $rowset = CPGPluginAPI::filter('thumb_caption_regular',$rowset);
                
                return $rowset;
        }


        // Meta albums
        switch($album){
        case 'lastcom': // Last comments
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $album_name = $lang_meta_album_names['lastcom'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['lastcom'];
                }

                // Replacing the AND in ALBUM_SET with AND (
                $TMP_SET = "AND (" . substr($ALBUM_SET, 3);

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_COMMENTS']}, {$CONFIG['TABLE_PICTURES']}  WHERE approved = 'YES' AND {$CONFIG['TABLE_COMMENTS']}.pid = {$CONFIG['TABLE_PICTURES']}.pid $TMP_SET $keyword)";
                $result = cpg_db_query($query);

                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns == '*'){
                  $select_columns = 'p.*';
                } else {
                  $select_columns = str_replace('pid', 'c.pid', $select_columns).', msg_id, author_id, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, aid';
                }

                $TMP_SET = str_replace($CONFIG['TABLE_PICTURES'],'p',$TMP_SET);
                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_COMMENTS']} as c, {$CONFIG['TABLE_PICTURES']} as p WHERE approved = 'YES' AND c.pid = p.pid $TMP_SET $keyword) ORDER by msg_id DESC $limit";
                $result = cpg_db_query($query);


                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        if ($row['author_id']) {
                            $user_link = '<a href ="profile.php?uid='.$row['author_id'].'">'.$row['msg_author'].'</a>';
                        } else {
                                $user_link = $row['msg_author'];
                        }
                        $msg_body = strlen($row['msg_body']) > 50 ? @substr($row['msg_body'],0,50)."...": $row['msg_body'];
                        if ($CONFIG['enable_smilies']) $msg_body = process_smilies($msg_body);
                        $caption = '<span class="thumb_title">'.$user_link.'</span>'.'<span class="thumb_caption">'.localised_date($row['msg_date'], $lastcom_date_fmt).'</span>'.'<span class="thumb_caption">'.$msg_body.'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_lastcom',$rowset);
                
                return $rowset;
                break;

        case 'lastcomby': // Last comments by a specific user
                if (isset($USER['uid'])) {
                        $uid = (int)$USER['uid'];
                } else {
                        $uid = -1;
                }

                $user_name = get_username($uid);
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $album_name = $lang_meta_album_names['lastcom'].' - '. $CURRENT_CAT_NAME .' - '. $user_name;
                } else {
                        $album_name = $lang_meta_album_names['lastcom'].' - '. $user_name;
                }

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_COMMENTS']}, {$CONFIG['TABLE_PICTURES']}  WHERE approved = 'YES' AND author_id = '$uid' AND {$CONFIG['TABLE_COMMENTS']}.pid = {$CONFIG['TABLE_PICTURES']}.pid $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns == '*'){
                        $select_columns = 'p.*';
                } else {
                        $select_columns = str_replace('pid', 'c.pid', $select_columns).', msg_id, author_id, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, aid';
                }

                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_COMMENTS']} as c, {$CONFIG['TABLE_PICTURES']} as p WHERE approved = 'YES' AND author_id = '$uid' AND c.pid = p.pid $ALBUM_SET ORDER by msg_id DESC $limit";
                $result = cpg_db_query($query);
                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        if ($row['author_id']) {
                            $user_link = '<a href ="profile.php?uid='.$row['author_id'].'">'.$row['msg_author'].'</a>';
                        } else {
                                $user_link = $row['msg_author'];
                        }

                        $caption = '<span class="thumb_title">'.$user_link.'</span>'.'<span class="thumb_caption">'.localised_date($row['msg_date'], $lastcom_date_fmt).'</span>'.'<span class="thumb_caption">'.$row['msg_body'].'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_lastcomby',$rowset);
                
                return $rowset;
                break;

        case 'lastup': // Last uploads
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['lastup'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['lastup'];
                }

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*' ) $select_columns .= ',title, caption, owner_id, owner_name, aid';

                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $ALBUM_SET ORDER BY pid DESC $limit";
                $result = cpg_db_query($query);

                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        $user_link = ($CONFIG['display_uploader'] && $row['owner_id'] && $row['owner_name']) ? '<span class="thumb_title"><a href ="profile.php?uid='.$row['owner_id'].'">'.$row['owner_name'].'</a></span>' : '';
                        $caption = $user_link.'<span class="thumb_caption">'.localised_date($row['ctime'], $lastup_date_fmt).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_lastup',$rowset);
                
                return $rowset;
                break;

        case 'lastupby': // Last uploads by a specific user
                if (isset($USER['uid'])) {
                        $uid = (int)$USER['uid'];
                } else {
                        $uid = -1;
                }

                $user_name = get_username($uid);
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['lastup'].' - '. $CURRENT_CAT_NAME .' - '. $user_name;
                } else {
                        $album_name = $lang_meta_album_names['lastup'] .' - '. $user_name;
                }

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND owner_id = '$uid' $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*' ) $select_columns .= ', owner_id, owner_name, aid';

                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND owner_id = '$uid' $ALBUM_SET ORDER BY pid DESC $limit";
                $result = cpg_db_query($query);

                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        if ($row['owner_id'] && $row['owner_name']) {
                            $user_link = '<span class="thumb_title"><a href ="profile.php?uid='.$row['owner_id'].'">'.$row['owner_name'].'</a></span>';
                        } else {
                                $user_link = '';
                        }
                        $caption = $user_link.'<span class="thumb_caption">'.localised_date($row['ctime'], $lastup_date_fmt).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_lastupby',$rowset);
                
                return $rowset;
                break;

        case 'topn': // Most viewed pictures
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['topn'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['topn'];
                }

                $query ="SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND hits > 0  $ALBUM_SET $keyword";

                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*') $select_columns .= ', hits, aid, filename';

                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES'AND hits > 0 $ALBUM_SET $keyword ORDER BY hits DESC, filename  $limit";
                $result = cpg_db_query($query);

                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        $caption = "<span class=\"thumb_caption\">".sprintf($lang_get_pic_data['n_views'], $row['hits']).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_topn',$rowset);
                
                return $rowset;
                break;

        case 'toprated': // Top rated pictures
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['toprated'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['toprated'];
                }
                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND votes >= '{$CONFIG['min_votes_for_rating']}' $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*') $select_columns .= ', pic_rating, votes, aid';

                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND votes >= '{$CONFIG['min_votes_for_rating']}' $ALBUM_SET ORDER BY ROUND((pic_rating+1)/2000) DESC, votes DESC $limit";
                $result = cpg_db_query($query);
                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        if (defined('THEME_HAS_RATING_GRAPHICS')) {
                            $prefix= $THEME_DIR;
                        } else {
                            $prefix= '';
                        }
                        $caption = "<span class=\"thumb_caption\">".'<img src="'.$prefix.'images/rating'.round($row['pic_rating']/2000).'.gif" alt=""/>'.'<br />'.sprintf($lang_get_pic_data['n_votes'], $row['votes']).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_toprated',$rowset);
                
                return $rowset;
                break;

        case 'lasthits': // Last viewed pictures
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['lasthits'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['lasthits'];
                }
                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*') $select_columns .= ', UNIX_TIMESTAMP(mtime) as mtime, aid, hits, lasthit_ip';

                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' and hits > 0 $ALBUM_SET ORDER BY mtime DESC $limit";
                $result = cpg_db_query($query);
                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        $caption = "<span class=\"thumb_caption\">".localised_date($row['mtime'], $lasthit_date_fmt)."<br/>".$row['hits']."<br/>".$row['lasthit_ip'].'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_lasthits',$rowset);
                
                return $rowset;
                break;

        case 'random': // Random pictures
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['random'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['random'];
                }

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $pic_count = $nbEnr[0];
                mysql_free_result($result);

                if($select_columns != '*') $select_columns .= ', aid';

                // if we have more than 1000 pictures, we limit the number of picture returned
                // by the SELECT statement as ORDER BY RAND() is time consuming
                                /* Commented out due to image not found bug
                if ($pic_count > 1000) {
                    $result = cpg_db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES'");
                        $nbEnr = mysql_fetch_array($result);
                        $total_count = $nbEnr[0];
                        mysql_free_result($result);

                        $granularity = floor($total_count / RANDPOS_MAX_PIC);
                        $cor_gran = ceil($total_count / $pic_count);
                        srand(time());
                        for ($i=1; $i<= $cor_gran; $i++) $random_num_set =rand(0, $granularity).', ';
                        $random_num_set = substr($random_num_set,0, -2);
                        $result = cpg_db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE  randpos IN ($random_num_set) AND approved = 'YES' $ALBUM_SET ORDER BY RAND() LIMIT $limit2");
                } else {
                                */
                $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $ALBUM_SET ORDER BY RAND() LIMIT $limit2";
                $result = cpg_db_query($query);

                $rowset = array();
                while($row = mysql_fetch_array($result)){
                        $row['caption_text'] = '';
                        $rowset[-$row['pid']] = $row;
                }
                mysql_free_result($result);
                
                $rowset = CPGPluginAPI::filter('thumb_caption_random',$rowset);

                return $rowset;
                break;

        case 'search': // Search results
                if (isset($USER['search'])) {
                        $search_string = $USER['search'];
                } else {
                        $search_string = '';
                }

                if (substr($search_string, 0, 3) == '###') {
                    $query_all = 1;
                        $search_string = substr($search_string, 3);
                } else {
                    $query_all = 0;
                }

                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['search'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['search'].' - "'. strtr($search_string, $HTML_SUBST) . '"';
                }

                include 'include/search.inc.php';
                
                $rowset = CPGPluginAPI::filter('thumb_caption_search',$rowset);
                
                return $rowset;
                break;

        case 'lastalb': // Last albums to which uploads
                if ($ALBUM_SET && $CURRENT_CAT_NAME) {
                        $album_name = $lang_meta_album_names['lastalb'].' - '. $CURRENT_CAT_NAME;
                } else {
                        $album_name = $lang_meta_album_names['lastalb'];
                }


                $ALBUM_SET = str_replace( "aid", $CONFIG['TABLE_PICTURES'].".aid" , $ALBUM_SET );

                $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' $ALBUM_SET";
                $result = cpg_db_query($query);
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);

                $query = "SELECT *,{$CONFIG['TABLE_ALBUMS']}.title AS title,{$CONFIG['TABLE_ALBUMS']}.aid AS aid FROM {$CONFIG['TABLE_PICTURES']},{$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND approved = 'YES' $ALBUM_SET GROUP  BY {$CONFIG['TABLE_PICTURES']}.aid ORDER BY {$CONFIG['TABLE_PICTURES']}.ctime DESC $limit";
                $result = cpg_db_query($query);
                $rowset = cpg_db_fetch_rowset($result);
                mysql_free_result($result);

                if ($set_caption) foreach ($rowset as $key => $row){
                        $caption = "<span class=\"thumb_caption\">".$row['title']." - ".localised_date($row['ctime'], $lastup_date_fmt).'</span>';
                        $rowset[$key]['caption_text'] = $caption;
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_lastalb',$rowset);
                
                return $rowset;
                break;

        case 'favpics': // Favourite Pictures

                $album_name = $lang_meta_album_names['favpics'];
                                $rowset = array();
                if (count($FAVPICS)>0){
                        $favs = implode(",",$FAVPICS);
                        $query = "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND pid IN ($favs) $ALBUM_SET";
                        $result = cpg_db_query($query);
                        $nbEnr = mysql_fetch_array($result);
                        $count = $nbEnr[0];
                        mysql_free_result($result);

                        $select_columns = '*';

                        $query = "SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES'AND pid IN ($favs) $ALBUM_SET $limit";
                        $result = cpg_db_query($query);
                        $rowset = cpg_db_fetch_rowset($result);

                        mysql_free_result($result);

                        if ($set_caption) foreach ($rowset as $key => $row){
                                $caption = $rowset[$key]['title'] ? "<span class=\"thumb_caption\">".($rowset[$key]['title'])."</span>" : '';
                                $rowset[$key]['caption_text'] = $caption;
                        }
                }
                
                $rowset = CPGPluginAPI::filter('thumb_caption_favpics',$rowset);
                
                return $rowset;
                break;

        default : // Invalid meta album
        cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        }
} // End of get_pic_data


// Get the name of an album

/**
 * get_album_name()
 *
 * @param $aid
 * @return
 **/

function get_album_name($aid)
{
        global $CONFIG;
        global $lang_errors;

        $result = cpg_db_query("SELECT title,keyword from {$CONFIG['TABLE_ALBUMS']} WHERE aid='$aid'");
        $count = mysql_num_rows($result);
        if ($count > 0) {
                $row = mysql_fetch_array($result);
                return $row;
        } else {
                cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        }
}

// Return the name of a user

/**
 * get_username()
 *
 * @param $uid
 * @return
 **/
function get_username($uid)
{
        global $CONFIG;

        $uid = (int)$uid;

        if (!$uid) {
            return 'Anonymous';
        } elseif (defined('UDB_INTEGRATION')) {
           return udb_get_user_name($uid);
        } else {
                $result = cpg_db_query("SELECT user_name FROM {$CONFIG['TABLE_USERS']} WHERE user_id = '".$uid."'");
                if (mysql_num_rows($result) == 0) return '';
                $row = mysql_fetch_array($result);
                mysql_free_result($result);
                return $row['user_name'];
        }
}

// Return the ID of a user

/**
 * get_userid()
 *
 * @param $username
 * @return
 **/
function get_userid($username)
{
        global $CONFIG;

        $username = addslashes($username);

        if (!$username) {
            return 0;
        } elseif (defined('UDB_INTEGRATION')) { // (Altered to fix banning w/ bb integration - Nibbler)
           return udb_get_user_id($username);
        } else {
                $result = cpg_db_query("SELECT user_id FROM {$CONFIG['TABLE_USERS']} WHERE user_name = '".$username."'");
                if (mysql_num_rows($result) == 0) return 0;
                $row = mysql_fetch_array($result);
                mysql_free_result($result);
                return $row['user_id'];
        }
}

// get number of pending approvals

/**
 * cpg_get_pending_approvals()
 *
 * @return
 **/
function cpg_get_pending_approvals()
{
    global $CONFIG;
    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'NO'");
    if (mysql_num_rows($result) == 0) return 0;
    $row = mysql_fetch_array($result);
    mysql_free_result($result);
    return $row[0];
}

// Return the total number of comments for a certain picture

/**
 * count_pic_comments()
 *
 * @param $pid
 * @param integer $skip
 * @return
 **/
function count_pic_comments($pid, $skip=0)
{
        global $CONFIG;
        $result = cpg_db_query("SELECT count(*) from {$CONFIG['TABLE_COMMENTS']} where pid=$pid and msg_id!=$skip");
        $nbEnr = mysql_fetch_array($result);
        $count = $nbEnr[0];
        mysql_free_result($result);

        return $count;
}

// Add 1 everytime a picture is viewed.

/**
 * add_hit()
 *
 * @param $pid
 * @return
 **/
function add_hit($pid)
{
        global $CONFIG, $raw_ip;
        cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET hits=hits+1, lasthit_ip='$raw_ip' WHERE pid='$pid'");
        
        /**
         * Code to record the details of hits for the picture, if the option is set in CONFIG
         */
        if ($CONFIG['hit_details']) {
        // Get the details of user browser, IP, OS, etc
        $os = "Unknown";
        if(eregi("Linux",$_SERVER["HTTP_USER_AGENT"])) {
            $os = "Linux";
        } else if(eregi("Windows NT 5.0",$_SERVER["HTTP_USER_AGENT"])) {
            $os = "Windows 2000";
        } else if(eregi("win98|Windows 98",$_SERVER["HTTP_USER_AGENT"])) {
            $os = "Windows 98";
        } else if(eregi("Windows NT 5.1",$_SERVER["HTTP_USER_AGENT"])) {
            $os = "Windows XP";
        } else if(eregi("Windows",$_SERVER["HTTP_USER_AGENT"])) {
            $os = "Windows";
        }
        
        $browser = $_SERVER["HTTP_USER_AGENT"];
        if(eregi("MSIE",$browser)) {
            if(eregi("MSIE 5.5",$browser)) {
                $browser = "Microsoft Internet Explorer 5.5";
            } else if(eregi("MSIE 6.0",$browser)) {
                $browser = "Microsoft Internet Explorer 6.0";
            }
        } else if(eregi("Mozilla Firebird",$browser)) {
            $browser = "Mozilla Firebird";
        } else if(eregi("netscape",$browser)) {
            $browser = "Netscape";
        } else if(eregi("Firefox",$browser)) {
            $browser = "Firefox";
        }
        
        //Code to get the search string if the referrer is any of the following
        $search_engines = array('google', 'lycos', 'yahoo');

        foreach ($search_engines as $engine) {
          if ( is_referer_search_engine($engine)) {
            $query_terms = get_search_query_terms($engine);
            break;
          }
        }
        
        $time = time();
        
        // Insert the record in database
        $query = "INSERT INTO {$CONFIG['TABLE_HIT_STATS']}
                          SET
                            pid = $pid,
                            search_phrase = '$query_term',
                            Ip   = '$_SERVER[REMOTE_ADDR]',
                            sdate = '$time',
                            referer='$_SERVER[HTTP_REFERER]',
                            browser = '$browser',
                            os = '$os'";
        cpg_db_query($query);
     }
}

/**
 * breadcrumb()
 *
 * Build the breadcrumb navigation
 *
 * @param integer $cat
 * @param string $breadcrumb
 * @param string $BREADCRUMB_TEXT
 * @return
 **/

function breadcrumb($cat, &$breadcrumb, &$BREADCRUMB_TEXT)
{
        global $album, $lang_errors, $lang_list_categories;
        global $CONFIG,$CURRENT_ALBUM_DATA, $CURRENT_CAT_NAME;
        if ($cat != 0) { //Categories other than 0 need to be selected
                $breadcrumb_array = array();
                if ($cat >= FIRST_USER_CAT) {
                        $user_name = get_username($cat - FIRST_USER_CAT);
                        if (!$user_name) $user_name = 'Mr. X';

                        $breadcrumb_array[] = array($cat, $user_name);
                        $CURRENT_CAT_NAME = sprintf($lang_list_categories['xx_s_gallery'], $user_name);
                        $row['parent'] = 1;
                } else {
                    $result = cpg_db_query("SELECT name, parent FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = '$cat'");
                        if (mysql_num_rows($result) == 0) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_cat'], __FILE__, __LINE__);
                        $row = mysql_fetch_array($result);

                        $breadcrumb_array[] = array($cat, $row['name']);
                        $CURRENT_CAT_NAME = $row['name'];
                        mysql_free_result($result);
                }

                while($row['parent'] != 0){
                    $result = cpg_db_query("SELECT cid, name, parent FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = '{$row['parent']}'");
                        if (mysql_num_rows($result) == 0) cpg_die(CRITICAL_ERROR, $lang_errors['orphan_cat'], __FILE__, __LINE__);
                        $row = mysql_fetch_array($result);

                        $breadcrumb_array[] = array($row['cid'], $row['name']);
                        mysql_free_result($result);
                } // while

                $breadcrumb_array = array_reverse($breadcrumb_array);
                $breadcrumb = '<a href="index.php">'.$lang_list_categories['home'].'</a>';
                $BREADCRUMB_TEXT = $lang_list_categories['home'];

                foreach ($breadcrumb_array as $category){
                        $link = "<a href=\"index.php?cat={$category[0]}\">{$category[1]}</a>";
                        $breadcrumb .= ' > ' . $link;
                        $BREADCRUMB_TEXT .= ' > ' . $category[1];
                }

        }else{ //Dont bother just add the Home link  to breadcrumb
                $breadcrumb = '<a href="index.php">'.$lang_list_categories['home'].'</a>';
                $BREADCRUMB_TEXT = $lang_list_categories['home'];
        }
        //Add Link for album if aid is set
        if (isset($CURRENT_ALBUM_DATA['aid'])){
                $link = "<a href=\"thumbnails.php?album=".$CURRENT_ALBUM_DATA['aid']."\">".$CURRENT_ALBUM_DATA['title']."</a>";
                $breadcrumb .= ' > ' . $link;
                $BREADCRUMB_TEXT .= ' > ' . $CURRENT_ALBUM_DATA['title'];
        }
}


/**************************************************************************

 **************************************************************************/

// Compute image geometry based on max width / height

/**
 * compute_img_size()
 *
 * Compute image geometry based on max, width / height
 *
 * @param integer $width
 * @param integer $height
 * @param integer $max
 * @return array
 **/
function compute_img_size($width, $height, $max)
{
         global $CONFIG;
        $thumb_use=$CONFIG['thumb_use'];
        if($thumb_use=='ht') {
          $ratio = $height / $max;
        } elseif($thumb_use=='wd') {
          $ratio = $width / $max;
        } else {
          $ratio = max($width, $height) / $max;
        }
        if ($ratio > 1.0) {
                $image_size['reduced'] = true;
        }
        $ratio = max($ratio, 1.0);
        $image_size['width'] = ceil($width / $ratio);
        $image_size['height'] = ceil($height / $ratio);
        $image_size['whole'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
        if($thumb_use=='ht') {
          $image_size['geom'] = ' height="'.$image_size['height'].'"';
        } elseif($thumb_use=='wd') {
          $image_size['geom'] = 'width="'.$image_size['width'].'"';
        } else {
          $image_size['geom'] = 'width="'.$image_size['width'].'" height="'.$image_size['height'].'"';
        }



        return $image_size;
}

// Prints thumbnails of pictures in an album

/**
 * display_thumbnails()
 *
 * Generates data to display thumbnails of pictures in an album
 *
 * @param mixed $album Either the album ID or the meta album name
 * @param integer $cat Either the category ID or album ID if negative
 * @param integer $page Page number to display
 * @param integer $thumbcols
 * @param integer $thumbrows
 * @param boolean $display_tabs
 **/

function display_thumbnails($album, $cat, $page, $thumbcols, $thumbrows, $display_tabs)
{
        global $CONFIG, $AUTHORIZED;
        global $album_date_fmt, $lang_display_thumbnails, $lang_errors, $lang_byte_units;

        $thumb_per_page = $thumbcols * $thumbrows;
        $lower_limit = ($page-1) * $thumb_per_page;

        $pic_data = get_pic_data($album, $thumb_count, $album_name, $lower_limit, $thumb_per_page);

        $total_pages = ceil($thumb_count / $thumb_per_page);

        $i = 0;
        if (count($pic_data) > 0) {
                foreach ($pic_data as $key => $row) {
                        $i++;

                        $pic_title =$lang_display_thumbnails['filename'].$row['filename']."\n".
                                $lang_display_thumbnails['filesize'].($row['filesize'] >> 10).$lang_byte_units[1]."\n".
                                $lang_display_thumbnails['dimensions'].$row['pwidth']."x".$row['pheight']."\n".
                                $lang_display_thumbnails['date_added'].localised_date($row['ctime'], $album_date_fmt);

                        $pic_url =  get_pic_url($row, 'thumb');
                        if (!is_image($row['filename'])) {
                                $image_info = getimagesize($pic_url);
                                $row['pwidth'] = $image_info[0];
                                $row['pheight'] = $image_info[1];
                        }

                        $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);

                        $thumb_list[$i]['pos'] = $key < 0 ? $key : $i - 1 + $lower_limit;
                        $thumb_list[$i]['pid'] = $row['pid'];;
                        $thumb_list[$i]['image'] = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$row['filename']}\" title=\"$pic_title\"/>";
                        $thumb_list[$i]['caption'] = $row['caption_text'];
                        $thumb_list[$i]['admin_menu'] = '';
                        $thumb_list[$i]['aid'] = $row['aid'];
                }
                theme_display_thumbnails($thumb_list, $thumb_count, $album_name, $album, $cat, $page, $total_pages, is_numeric($album), $display_tabs);
        } else {
                theme_no_img_to_display($album_name);
        }
}

 /**
 * cpg_get_system_thumb_list()
 *
 * Return an array containing the system thumbs in a directory

 * @param string $search_folder
 * @return array
 **/
function cpg_get_system_thumb_list($search_folder = 'images/')
{
        global $CONFIG;
        static $thumbs = array();

        $folder = 'images/';

        $thumb_pfx =& $CONFIG['thumb_pfx'];
        // If thumb array is empty get list from coppermine 'images' folder
        if ((count($thumbs) == 0) && ($folder == $search_folder)) {
                $dir = opendir($folder);
                while (($file = readdir($dir))!==false) {
                        if (is_file($folder . $file) && strpos($file,$thumb_pfx) === 0) {
                                // Store filenames in an array
                                $thumbs[] = array('filename' => $file);
                        }
                }
                closedir($dir);
                return $thumbs;
        } elseif ($folder == $search_folder) {
                // Search folder is the same as coppermine images folder; just return the array
                return $thumbs;
        } else {
                // Search folder is the different; check for files in the given folder
                $results = array();
                foreach ($thumbs as $thumb) {
                        if (is_file($search_folder.$thumb['filename'])) {
                                $results[] = array('filename' => $thumb['filename']);
                        }
                }
                return $results;
        }
}


/**
 * cpg_get_system_thumb()
 *
 * Gets data for system thumbs
 *
 * @param string $filename
 * @param integer $user
 * @return array
 **/

function& cpg_get_system_thumb($filename,$user=10001)
{
        global $CONFIG,$USER_DATA;

        // Correct user_id
        if ($user<10000)
        {
                $user += 10000;
        }

        if ($user==10000) {
                $user = 10001;
        }

        // Get image data for thumb
        $picdata = array('filename'=>$filename,
                         'filepath'=>$CONFIG['userpics'].$user.'/',
                         'url_prefix'=>0);
        $pic_url = get_pic_url($picdata,'thumb',true);
        $picdata['thumb'] = $pic_url;
        $image_info = getimagesize($pic_url);
        $picdata['pwidth'] = $image_info[0];
        $picdata['pheight'] = $image_info[1];
        $image_size = compute_img_size($picdata['pwidth'], $picdata['pheight'], $CONFIG['alb_list_thumb_size']);
        $picdata['whole'] = $image_size['whole'];
        $picdata['reduced'] = (isset($image_size['reduced']) && $image_size['reduced']);
        return $picdata;
}


/**
 * display_film_strip()
 *
 * gets data for thumbnails in an album for the film strip
 *
 * @param integer $album
 * @param integer $cat
 * @param integer $pos
 **/

function display_film_strip($album, $cat, $pos)
{
        global $CONFIG, $AUTHORIZED;
        global $album_date_fmt, $lang_display_thumbnails, $lang_errors, $lang_byte_units;
        $max_item=$CONFIG['max_film_strip_items'];
        //$thumb_per_page = $pos+$CONFIG['max_film_strip_items'];
        $thumb_per_page = $max_item*2;
        $l_limit = max(0,$pos-$CONFIG['max_film_strip_items']);
        $new_pos=max(0,$pos-$l_limit);

        $pic_data = get_pic_data($album, $thumb_count, $album_name, $l_limit, $thumb_per_page);

        if (count($pic_data) < $max_item ){
                $max_item = count($pic_data);
        }
        $lower_limit=3;

        if(!isset($pic_data[$new_pos+1])) {
           $lower_limit=$new_pos-$max_item+1;
        } else if(!isset($pic_data[$new_pos+2])) {
           $lower_limit=$new_pos-$max_item+2;
        } else if(!isset($pic_data[$new_pos-1])) {
           $lower_limit=$new_pos;
        } else {
          $hf=$max_item/2;
          $ihf=(int)($max_item/2);
          if($new_pos > $hf ) {
             //if($max_item%2==0) {
               //$lower_limit=
             //} else {
             {
               $lower_limit=$new_pos-$ihf;
             }
          }
          elseif($new_pos < $hf ) { $lower_limit=0; }
        }

        $pic_data=array_slice($pic_data,$lower_limit,$max_item);
        $i=$l_limit;
        if (count($pic_data) > 0) {
                foreach ($pic_data as $key => $row) {
                        $hi =(($pos==($i + $lower_limit)) ? '1': '');
                        $i++;

                        $pic_title =$lang_display_thumbnails['filename'].$row['filename']."\n".
                                $lang_display_thumbnails['filesize'].($row['filesize'] >> 10).$lang_byte_units[1]."\n".
                                $lang_display_thumbnails['dimensions'].$row['pwidth']."x".$row['pheight']."\n".
                                $lang_display_thumbnails['date_added'].localised_date($row['ctime'], $album_date_fmt);

                        $pic_url =  get_pic_url($row, 'thumb');
                        if (!is_image($row['filename'])) {
                                $image_info = getimagesize($pic_url);
                                $row['pwidth'] = $image_info[0];
                                $row['pheight'] = $image_info[1];
                        }

                        $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);

                        $p=$i - 1 + $lower_limit;
                        $p=($p < 0 ? 0 : $p);
                        $thumb_list[$i]['pos'] = $key < 0 ? $key : $p;
                        $thumb_list[$i]['image'] = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$row['filename']}\" title=\"$pic_title\"/>";
                        $thumb_list[$i]['caption'] = $row['caption_text'];
                        $thumb_list[$i]['admin_menu'] = '';

                }
                return theme_display_film_strip($thumb_list, $thumb_count, $album_name, $album, $cat, $pos, is_numeric($album));
        } else {
                theme_no_img_to_display($album_name);
        }
}

// Return the url for a picture, allows to have pictures spreaded over multiple servers

/**
 * get_pic_url()
 *
 * Return the url for a picture
 *
 * @param array $pic_row
 * @param string $mode
 * @param boolean $system_pic
 * @return string
 **/

function& get_pic_url(&$pic_row, $mode,$system_pic = false)
{
        global $CONFIG,$THEME_DIR;

        static $pic_prefix = array();
        static $url_prefix = array();

        if (!count($pic_prefix)) {
                $pic_prefix = array(
                        'thumb' => $CONFIG['thumb_pfx'],
                        'normal' => $CONFIG['normal_pfx'],
                        'fullsize' => ''
                );

                $url_prefix = array(
                        0 => $CONFIG['fullpath'],
                );
        }

        $mime_content = cpg_get_type($pic_row['filename']);
        $pic_row = array_merge($pic_row,$mime_content);

        $filepathname = null;

        // Code to handle custom thumbnails
        // If fullsize or normal mode use regular file
        if ($mime_content['content'] != 'image' && $mode== 'normal') {
                $mode = 'fullsize';
        } elseif (($mime_content['content'] != 'image' && $mode == 'thumb') || $system_pic) {
                $thumb_extensions = Array('.gif','.png','.jpg');
                // Check for user-level custom thumbnails
                // Create custom thumb path and erase extension using filename; Erase filename's extension
                $custom_thumb_path = $url_prefix[$pic_row['url_prefix']].$pic_row['filepath'].$pic_prefix[$mode];
                $file_base_name = str_replace('.'.$mime_content['extension'],'',basename($pic_row['filename']));
                // Check for file-specific thumbs
                foreach ($thumb_extensions as $extension) {
                        if (file_exists($custom_thumb_path.$file_base_name.$extension)) {
                                $filepathname = $custom_thumb_path.$file_base_name.$extension;
                                break;
                        }
                }
                if (!$system_pic) {
                        // Check for extension-specific thumbs
                        if (is_null($filepathname)) {
                                foreach ($thumb_extensions as $extension) {
                                        if (file_exists($custom_thumb_path.$mime_content['extension'].$extension)) {
                                                $filepathname = $custom_thumb_path.$mime_content['extension'].$extension;
                                                break;
                                        }
                                }
                        }
                        // Check for content-specific thumbs
                        if (is_null($filepathname)) {
                                foreach ($thumb_extensions as $extension) {
                                        if (file_exists($custom_thumb_path.$mime_content['content'].$extension)) {
                                                $filepathname = $custom_thumb_path.$mime_content['content'].$extension;
                                                break;
                                        }
                                }
                        }
                }
                // Use default thumbs
                if (is_null($filepathname)) {
                               // Check for default theme- and global-level thumbs
                               $thumb_paths[] = $THEME_DIR.'images/';                 // Used for custom theme thumbs
                               $thumb_paths[] = 'images/';                             // Default Coppermine thumbs
                               foreach ($thumb_paths as $default_thumb_path) {
                                       if (is_dir($default_thumb_path)) {
                                               if (!$system_pic) {
                                                       foreach ($thumb_extensions as $extension) {
                                                               // Check for extension-specific thumbs
                                                               if (file_exists($default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['extension'].$extension)) {
                                                                       $filepathname = $default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['extension'].$extension;
                                                                       break 2;
                                                               }
                                                       }
                                                       foreach ($thumb_extensions as $extension) {
                                                               // Check for media-specific thumbs (movie,document,audio)
                                                               if (file_exists($default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['content'].$extension)) {
                                                                       $filepathname = $default_thumb_path.$CONFIG['thumb_pfx'].$mime_content['content'].$extension;
                                                                       break 2;
                                                               }
                                                       }
                                               } else {
                                                       // Check for file-specific thumbs for system files
                                                       foreach ($thumb_extensions as $extension) {
                                                               if (file_exists($default_thumb_path.$CONFIG['thumb_pfx'].$file_base_name.$extension)) {
                                                                       $filepathname = $default_thumb_path.$CONFIG['thumb_pfx'].$file_base_name.$extension;
                                                                       break 2;
                                                               }
                                                       }
                                               }
                                       }
                               }
                }
                $filepathname = path2url($filepathname);
        }

        if (is_null($filepathname)) {
            $filepathname = $url_prefix[$pic_row['url_prefix']]. path2url($pic_row['filepath']. $pic_prefix[$mode]. $pic_row['filename']);
        }

        // Added hack:  "&& !isset($pic_row['mode'])" thumb_data filter isn't executed for the fullsize image
        if ($mode == 'thumb' && !isset($pic_row['mode'])) {
            $pic_row['url'] = $filepathname;
            $pic_row['mode'] = $mode;
            $pic_row = CPGPluginAPI::filter('thumb_data',$pic_row);
        } elseif ($mode != 'thumb') {
            $pic_row['url'] = $filepathname;
            $pic_row['mode'] = $mode;
        } else {
            $pic_row['url'] = $filepathname;
        }

        return $pic_row['url'];
}


/**
 * cpg_get_default_lang_var()
 *
 * Return a variable from the default language file
 *
 * @param $language_var_name
 * @param unknown $overide_language
 * @return
 **/
function& cpg_get_default_lang_var($language_var_name,$overide_language = null) {
        global $CONFIG;
        if (is_null($overide_language)) {
                if (isset($CONFIG['default_lang'])) {
                        $language = $CONFIG['default_lang'];
                } else {
                               global $$language_var_name;
                               return $$language_var_name;
                }
        } else {
                       $language = $overide_language;
        }
        include('lang/'.$language.'.php');
        return $$language_var_name;
}

// Returns a variable from the current language file
// If variable doesn't exists gets value from english lang file

/**
 * cpg_lang_var()
 *
 * @param $varname
 * @param unknown $index
 * @return
 **/

function& cpg_lang_var($varname,$index=null) {
        global $$varname;

        $lang_var =& $$varname;

        if (isset($lang_var)) {
                if (!is_null($index) && !isset($lang_var[$index])) {
                        include('lang/english.php');
                        return $lang_var[$index];
                } elseif (is_null($index)) {
                        return $lang_var;
                } else {
                               return $lang_var[$index];
                }
        } else {
                       include('lang/english.php');
                       return $lang_var;
        }
}


/**
 * cpg_debug_output()
 *
 * defined new debug_output function here in functions.inc.php instead of theme.php with different function names to avoid incompatibilities with users not updating their themes as required. Advanced info is only output if (GALLERY_ADMIN_MODE == TRUE)
 *
 **/

function cpg_debug_output()
{
    global $USER, $USER_DATA, $ALBUM_SET, $CONFIG, $cpg_time_start, $query_stats, $queries, $lang_cpg_debug_output;
        $time_end = cpgGetMicroTime();
        $time = round($time_end - $cpg_time_start, 3);

        $query_count = count($query_stats);
        $total_query_time = array_sum($query_stats);

        $debug_underline = '&#0010;------------------&#0010;';
        $debug_separate = '&#0010;==========================&#0010;';
        echo '<form name="debug" action="'.$_SERVER['PHP_SELF'].'">';
        starttable('100%', $lang_cpg_debug_output['debug_info'],2);
        echo '<tr><td align="center" valign="middle" class="tableh2">';
        echo '<script language="javascript" type="text/javascript">
<!--

function HighlightAll(theField) {
var tempval=eval("document."+theField)
tempval.focus()
tempval.select()
}
//-->
</script>';
        echo '
        <div class="admin_menu"><a href="javascript:HighlightAll(\'debug.debugtext\')" class="adm_menu">' . $lang_cpg_debug_output['select_all'] . '</a></div>';
        echo '</td><td align="left" valign="middle" class="tableh2">';
        if (GALLERY_ADMIN_MODE){echo '<span class="album_stat">('.$lang_cpg_debug_output['copy_and_paste_instructions'].')</span>';}
        echo '</td></tr>';
        echo '<tr><td class="tableb" colspan="2">';
        echo '<textarea  rows="10" cols="60" class="debug_text" name="debugtext">';
        echo "USER: ";
        echo $debug_underline;
        print_r($USER);
        echo $debug_separate;
        echo "USER DATA:";
        echo $debug_underline;
        print_r($USER_DATA);
        echo $debug_separate;
        echo "Queries:";
        echo $debug_underline;
        print_r($queries);
        echo $debug_separate;
        echo "GET :";
        echo $debug_underline;
        print_r($_GET);
        echo $debug_separate;
        echo "POST :";
        echo $debug_underline;
        print_r($_POST);
        echo $debug_separate;
        if (GALLERY_ADMIN_MODE){
        echo "VERSION INFO :";
        echo $debug_underline;
        $version_comment = ' - OK';
        if (strcmp('4.0.0', phpversion()) == 1) {$version_comment = ' - your PHP version isn\'t good enough! Minimum requirements: 4.x';}
        echo 'PHP version: ' . phpversion().$version_comment;
        echo $debug_underline;
        $version_comment = '';
        $mySqlVersion = cpg_phpinfo_mysql_version();
        if (strcmp('3.23.23', $mySqlVersion) == 1) {$version_comment = ' - your mySQL version isn\'t good enough! Minimum requirements: 3.23.23';}
        echo 'mySQL version: ' . $mySqlVersion . $version_comment;
        echo $debug_underline;
        echo 'Coppermine version: ';
        echo COPPERMINE_VERSION . '(' . COPPERMINE_VERSION_STATUS . ')';
        echo $debug_separate;
//        error_reporting  (E_ERROR | E_WARNING | E_PARSE); // New maze's error report system
        if (function_exists('gd_info') == true) {
            echo 'Module: GD';
            echo $debug_underline;
            $gd_array = gd_info();
            foreach ($gd_array as $key => $value) {
                echo $key.': '.$value."\n";
            }
            echo $debug_separate;
        } else {
            echo cpg_phpinfo_mod_output('gd','text');
        }
        echo cpg_phpinfo_mod_output('mysql','text');
        echo cpg_phpinfo_mod_output('zlib','text');
        echo 'Server restrictions (safe mode)?';
        echo $debug_underline;
        echo 'Directive | Local Value | Master Value';
        echo cpg_phpinfo_conf_output("safe_mode");
        echo cpg_phpinfo_conf_output("safe_mode_exec_dir");
        echo cpg_phpinfo_conf_output("safe_mode_gid");
        echo cpg_phpinfo_conf_output("safe_mode_include_dir");
        echo cpg_phpinfo_conf_output("safe_mode_exec_dir");
        echo cpg_phpinfo_conf_output("sql.safe_mode");
        echo cpg_phpinfo_conf_output("disable_functions");
        echo cpg_phpinfo_conf_output("file_uploads");
        echo cpg_phpinfo_conf_output("include_path");
        echo cpg_phpinfo_conf_output("open_basedir");
        echo $debug_separate;
        echo 'email';
        echo $debug_underline;
        echo 'Directive | Local Value | Master Value';
        echo cpg_phpinfo_conf_output("sendmail_from");
        echo cpg_phpinfo_conf_output("sendmail_path");
        echo cpg_phpinfo_conf_output("SMTP");
        echo cpg_phpinfo_conf_output("smtp_port");
        echo $debug_separate;
        echo 'Size and Time';
        echo $debug_underline;
        echo 'Directive | Local Value | Master Value';
        echo cpg_phpinfo_conf_output("max_execution_time");
        echo cpg_phpinfo_conf_output("max_input_time");
        echo cpg_phpinfo_conf_output("upload_max_filesize");
        echo cpg_phpinfo_conf_output("post_max_size");
        echo $debug_separate;
        }

        echo <<<EOT
Page generated in $time seconds - $query_count queries in $total_query_time seconds - Album set : $ALBUM_SET
EOT;
        echo "</textarea>";
        echo "</td>";
        echo "</tr>";
        if (GALLERY_ADMIN_MODE){
          echo "<tr><td class=\"tableb\" colspan=\"2\">";
          echo "<a href=\"phpinfo.php\" class=\"admin_menu\">".$lang_cpg_debug_output['phpinfo']."</a>";
//          error_reporting  (E_ERROR | E_WARNING | E_PARSE); // New maze's error report system
          echo "</td></tr>";
        }
        endtable();
        echo "</form>";

        // Maze's new error report system
        global $cpgdebugger;
        $report = $cpgdebugger->stop();
        if (is_array($report)) {
            starttable('100%', $lang_cpg_debug_output['debug_info'],2);
            echo '<tr><td>';
            foreach($report AS $file => $errors) {
                echo '<b>'.substr($file, $strstart).'</b><ul>';
                foreach($errors AS $error) { echo "<li>$error</li>"; }
                echo '</ul>';
            }
            echo '</td></tr>';
            endtable();
        }

}

/**
 * cpg_phpinfo_mod()
 *
 * phpinfo-related functions:
 *
 * @param $search
 * @return
 **/

function cpg_phpinfo_mod($search)
{
    // this could be done much better with regexpr - anyone who wants to change it: go ahead
    ob_start();
    phpinfo(INFO_MODULES);
    $string = ob_get_contents();
    $module = $string;
    $delimiter = '#cpgdelimiter#';
    ob_end_clean();
    // find out the first occurence of "<h2" and throw the superfluos stuff away
    $string = strstr($string, 'module_' . $search);
    $string = eregi_replace('</table>(.*)', '', $string);
    $string = strstr($string, '<tr>');
    $string = str_replace('</td>', '|', $string);
    $string = str_replace('</tr>', $delimiter, $string);
    $string = chop(strip_tags($string));
    $pieces = explode($delimiter, $string);
    foreach($pieces as $key => $val) {
        $bits[$key] = explode("|", $val);
    }
    return $bits;
}

/**
 * cpg_phpinfo_mod_output()
 *
 * @param $search
 * @param $output_type
 * @return
 **/

function cpg_phpinfo_mod_output($search,$output_type)
{
// first parameter is the module name, second parameter is the way you want your output to look like: table or text
    $pieces = cpg_phpinfo_mod($search);
    $summ = '';
    $return = '';
    $debug_underline = '&#0010;------------------&#0010;';
    $debug_separate = '&#0010;==========================&#0010;';

    if ($output_type == 'table')
    {
    ob_start();
    starttable('100%', 'Module: '.$search, 2);
    $return.= ob_get_contents();
    ob_end_clean();
    }
    else
    {
    $return.= 'Module: '.$search.$debug_underline;
    }
    foreach($pieces as $val) {
        if ($output_type == 'table') {$return.= '<tr><td>';}
        $return.= $val[0];
        if ($output_type == 'table') {$return.= '</td><td>';}
        $return.= $val[1];
        if ($output_type == 'table') {$return.= '</td></tr>';}
        $summ .= $val[0];
    }
    if (!$summ) {
        if ($output_type == 'table') {$return.= '<tr><td colspan="2">';}
        $return.= 'module doesn\'t exist';
        if ($output_type == 'table') {$return.= '</td></tr>';}
    }
    if ($output_type == 'table')
    {
    ob_start();
    endtable();
    $return.= ob_get_contents();
    ob_end_clean();
    }
    else
    {
    $return.= $debug_separate;
    }
    return $return;
}

/**
 * cpg_phpinfo_mysql_version()
 *
 * @return
 **/


function cpg_phpinfo_mysql_version()
{
    $result = mysql_query("SELECT VERSION() as version");
    $row = mysql_fetch_row($result);
    return $row[0];
}

/**
 * cpg_phpinfo_conf()
 *
 * @param $search
 * @return
 **/

function cpg_phpinfo_conf($search)
{
    // this could be done much better with regexpr - anyone who wants to change it: go ahead
    $string ='';
    $pieces = '';
    $delimiter = '#cpgdelimiter#';
    $bits = '';

    ob_start();
    phpinfo(INFO_CONFIGURATION);
    $string = ob_get_contents();
    ob_end_clean();
    // find out the first occurence of "</tr" and throw the superfluos stuff in front of it away
    $string = strchr($string, '</tr>');
    $string = str_replace('</td>', '|', $string);
    $string = str_replace('</tr>', $delimiter, $string);
    $string = chop(strip_tags($string));
    $pieces = explode($delimiter, $string);
    foreach($pieces as $val) {
        $bits = explode("|", $val);
        if (strchr($bits[0], $search)) {
            return $bits;
        }
    }
}

/**
 * cpg_phpinfo_conf_output()
 *
 * @param $search
 * @return
 **/

function cpg_phpinfo_conf_output($search)
{
$pieces = cpg_phpinfo_conf($search);
        $return= $pieces[0] . ' | ' . $pieces[1] . ' | ' . $pieces[2];
        return $return;
}

// theme and language selection


/**
 * languageSelect()
 *
 * @param $parameter
 * @return
 **/

function languageSelect($parameter)
{
global $CONFIG,$lang_language_selection;
$return= '';
$lineBreak = "\n";

//check if language display is enabled
if ($CONFIG['language_list'] == 0 && $parameter == 'list'){
    return;
}
if ($CONFIG['language_flags'] == 0 && $parameter == 'flags'){
    return;
}




// get the current language
 //use the default language of the gallery
 $cpgCurrentLanguage = $CONFIG['lang'];

 // is a user logged in?
 //has the user already chosen another language for himself?
 //if($USER['lang']!=""){
 //   $cpgCurrentLanguage = $USER['lang'];
 //   }
 //has the language been set to something else on the previous page?
 if (isset($_GET['lang'])){
    $cpgCurrentLanguage = $_GET['lang'];
    }
 //get the url and all vars except $lang
 $cpgChangeUrl = $_SERVER["SCRIPT_NAME"]."?";
 foreach ($_GET as $key => $value) {
    if ($key!="lang"){$cpgChangeUrl.= $key . "=" . $value . "&";}
 }
 $cpgChangeUrl.= 'lang=';


// get an array of english and native language names and flags
// for now, use a static array definition here - this could later be made into a true database query
$lang_language_data['arabic'] = array('Arabic','&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;','sa');
$lang_language_data['bosnian'] = array('Bosnian','Bosanski','ba');
$lang_language_data['brazilian_portuguese'] = array('Portuguese [Brazilian]','Portugu&ecirc;s Brasileiro','br');
$lang_language_data['bulgarian'] = array('Bulgarian','&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;','bg');
$lang_language_data['catalan'] = array('Catalan','Catal&agrave;','ct');
$lang_language_data['chinese_big5'] = array('Chinese-Big5','&#21488;&#28771;','tw');
$lang_language_data['chinese_gb'] = array('Chinese-GB2312','&#20013;&#22269;','cn');
$lang_language_data['croatian'] = array('Croatian','Hrvatski','hr');
$lang_language_data['czech'] = array('Czech','&#x010C;esky','cz');
$lang_language_data['danish'] = array('Danish','Dansk','dk');
$lang_language_data['dutch'] = array('Dutch','Nederlands','nl');
$lang_language_data['english'] = array('English','English','gb');
$lang_language_data['estonian'] = array('Estonian','Eesti','ee');
$lang_language_data['finnish'] = array('Finnish','Suomea','fi');
$lang_language_data['french'] = array('French','Fran&ccedil;ais','fr');
$lang_language_data['german'] = array('German','Deutsch','de');
$lang_language_data['greek'] = array('Greek','&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;','gr');
$lang_language_data['hebrew'] = array('Hebrew','&#1506;&#1489;&#1512;&#1497;&#1514;','il');
$lang_language_data['hungarian'] = array('Hungarian','Magyarul','hu');
$lang_language_data['indonesian'] = array('Indonesian','Bahasa Indonesia','id');
$lang_language_data['italian'] = array('Italian','Italiano','it');
$lang_language_data['japanese'] = array('Japanese','&#26085;&#26412;&#35486;','jp');
$lang_language_data['korean'] = array('Korean','&#54620;&#44397;&#50612;','kr');
$lang_language_data['kurdish'] = array('Kurdish','&#1603;&#1608;&#1585;&#1583;&#1740;','ku');
$lang_language_data['latvian'] = array('Latvian','Latvian','lv');
$lang_language_data['malay'] = array('Malay','Bahasa Melayu','my');
$lang_language_data['norwegian'] = array('Norwegian','Norsk','no');
$lang_language_data['polish'] = array('Polish','Polski','pl');
$lang_language_data['portuguese'] = array('Portuguese [Portugal]','Portugu&ecirc;s','pt');
$lang_language_data['romanian'] = array('Romanian','Rom&acirc;n&atilde;','ro');
$lang_language_data['russian'] = array('Russian','&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;','ru');
$lang_language_data['slovak'] = array('Slovak','Slovensky','sl');
$lang_language_data['slovenian'] = array('Slovenian','Slovensko','si');
$lang_language_data['spanish'] = array('Spanish','Espa&ntilde;ol','es');
$lang_language_data['swedish'] = array('Swedish','Svenska','se');
$lang_language_data['thai'] = array('Thai','&#3652;&#3607;&#3618;','th');
$lang_language_data['turkish'] = array('Turkish','T&uuml;rk&ccedil;e','tr');
$lang_language_data['uighur'] = array('Uighur','Uighur','cn-xj');
$lang_language_data['vietnamese'] = array('Vietnamese','Tieng Viet','vn');

// get list of available languages
  $value = strtolower($CONFIG['lang']);
  // is utf-8 selected?
 if ($CONFIG['charset'] == 'utf-8') {
     $cpg_charset = 'utf-8';
 } else {
     $cpg_charset = '';
 }
  $lang_dir = 'lang/';
  $dir = opendir($lang_dir);
  while ($file = readdir($dir)) {
      if (is_file($lang_dir . $file) && strtolower(substr($file, -4)) == '.php') {
          if (($cpg_charset != 'utf-8' && strstr($file,'utf-8') == false) || ($cpg_charset == 'utf-8' && strstr($file,'utf-8') == true)) {
              $lang_array[] = strtolower(substr($file, 0 , -4));
          }
      }
  }
  closedir($dir);
  natcasesort($lang_array);

//start the output
switch ($parameter) {
   case 'flags':
       if ($CONFIG['language_flags'] == 2){
           $return.= $lang_language_selection['choose_language'].': ';
       }
       foreach ($lang_array as $language) {
       $cpg_language_name = str_replace('-utf-8','', $language);
              if (array_key_exists($cpg_language_name, $lang_language_data)){
              $return.= $lineBreak .  '<a href="' .$cpgChangeUrl. $language . '"><img src="images/flags/' . $lang_language_data[$cpg_language_name][2] . '.gif" border="0" width="16" height="10" alt="" title="';
              $return.= $lang_language_data[$language][0];
              if ($lang_language_data[$language][1] != $lang_language_data[$language][0]){
                  $return.= ' (' . $lang_language_data[$language][1] . ')';
                  }
              $return.= '" /></a>&nbsp;' . $lineBreak;
              }
              }
          if ($CONFIG['language_reset'] == 1){
              $return.=  '<a href="' .$cpgChangeUrl. 'xxx"><img src="images/flags/reset.gif" border="0" width="16" height="11" alt="" title="';
              $return.=  $lang_language_selection['reset_language'] . '" /></a>' . $lineBreak;
          }
       break;
   case 'table':
       $return = 'not yet implemented';
       break;
   default:
       $return.= $lineBreak . '<form name="cpgChooseLanguage" action="' . $_SERVER['PHP_SELF'] . '" method="get" style="margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;display:inline">' . $lineBreak;
       $return.= '<select name="cpgLanguageSelect" class="listbox_lang" onchange="if (this.options[this.selectedIndex].value) window.location.href=\'' . $cpgChangeUrl . '\' + this.options[this.selectedIndex].value;">' . $lineBreak;
       $return.='<option selected="selected">' . $lang_language_selection['choose_language'] . '</option>' . $lineBreak;
       foreach ($lang_array as $language) {
          $return.=  '<option value="' . $language  . '" >';
              if (array_key_exists($language, $lang_language_data)){
              $return.= $lang_language_data[$language][0];
              if ($lang_language_data[$language][1] != $lang_language_data[$language][0]){
                  $return.= ' (' . $lang_language_data[$language][1] . ')';
                  }
              }
              else{
                  $return.= ucfirst($language);
                  }
              $return.= ($value == $language ? '*' : '');
              $return.= '</option>' . $lineBreak;
              }
          if ($CONFIG['language_reset'] == 1){
              $return.=  '<option value="xxx">' . $lang_language_selection['reset_language'] . '</option>' . $lineBreak;
          }
          $return.=  '</select>' . $lineBreak;
          $return.=  '</form>' . $lineBreak;
   }

return $return;
}


/**
 * themeSelect()
 *
 * @param $parameter
 * @return
 **/

function themeSelect($parameter)
{
global $CONFIG,$lang_theme_selection;
$return= '';
$lineBreak = "\n";

if ($CONFIG['theme_list'] == 0){
    return;
}

// get the current theme
//get the url and all vars except $theme
$cpgCurrentTheme = $_SERVER["SCRIPT_NAME"]."?";
foreach ($_GET as $key => $value) {
    if ($key!="theme"){$cpgCurrentTheme.= $key . "=" . $value . "&";}
}
$cpgCurrentTheme.="theme=";

// get list of available languages
    $value = $CONFIG['theme'];
    $theme_dir = 'themes/';

    $dir = opendir($theme_dir);
    while ($file = readdir($dir)) {
        if (is_dir($theme_dir . $file) && $file != "." && $file != "..") {
            $theme_array[] = $file;
        }
    }
    closedir($dir);

    natcasesort($theme_array);

//start the output
switch ($parameter) {
   case 'table':
       $return = 'not yet implemented';
       break;
   default:
       $return.= $lineBreak . '<form name="cpgChooseTheme" action="' . $_SERVER['PHP_SELF'] . '" method="get" style="margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;display:inline">' . $lineBreak;
       $return.= '<select name="cpgThemeSelect" class="listbox_lang" onchange="if (this.options[this.selectedIndex].value) window.location.href=\'' . $cpgCurrentTheme . '\' + this.options[this.selectedIndex].value;">' . $lineBreak;
       $return.='<option selected="selected">' . $lang_theme_selection['choose_theme'] . '</option>';
       foreach ($theme_array as $theme) {
           $return.= '<option value="' . $theme . '">' . strtr(ucfirst($theme), '_', ' ') . ($value == $theme ? '*' : ''). '</option>' . $lineBreak;
       }
          if ($CONFIG['theme_reset'] == 1){
              $return.=  '<option value="xxx">' . $lang_theme_selection['reset_theme'] . '</option>' . $lineBreak;
          }
          $return.=  '</select>' . $lineBreak;
          $return.=  '</form>' . $lineBreak;
   }

return $return;
}


/**
 * cpg_alert_dev_version()
 *
 * @return
 **/

function cpg_alert_dev_version() {
        global $lang_version_alert, $CONFIG;
        $return = '';
        if (COPPERMINE_VERSION_STATUS != 'stable') {
            ob_start();
            starttable('100%', $lang_version_alert['version_alert']);
            print '<tr><td class="tableb">';
            print sprintf($lang_version_alert['no_stable_version'], COPPERMINE_VERSION, COPPERMINE_VERSION_STATUS);
            print '</td></tr>';
            endtable();
            print '<br />';
            $return = ob_get_contents();
            ob_end_clean();
        }
        // check if gallery is offline
        if ($CONFIG['offline'] == 1 && GALLERY_ADMIN_MODE) {
            $return .= '<span style="color:red;font-weight:bold">'.$lang_version_alert['gallery_offline'].'</span><br />&nbsp;<br />';
        }
        return $return;
}

/**
 * cpg_display_help()
 *
 * @param string $reference
 * @param string $width
 * @param string $height
 * @return
 **/

function cpg_display_help($reference = 'f=index.htm', $width = '600', $height = '350') {
global $CONFIG, $USER;
if ($reference == '' || $CONFIG['enable_help'] == '0') {return; }
if ($CONFIG['enable_help'] == '2' && GALLERY_ADMIN_MODE == false) {return; }
$help_theme = $CONFIG['theme'];
if (isset($USER['theme'])) {
    $help_theme = $USER['theme'];
}
$help_html = "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('docs/showdoc.php?css=" . $help_theme . "&" . $reference . "','" . uniqid(rand()) . "','scrollbars=yes,toolbar=no,status=no,resizable=yes,width=" . $width . ",height=" . $height . "')\" style=\"cursor:help\"><img src=\"images/help.gif\" width=\"13\" height=\"11\" border=\"0\" alt=\"\" title=\"\" /></a>";
return $help_html;
}

/**
* Multi-dim array sort, with ability to sort by two and more dimensions
* Coded by Ichier2003, available at php.net
* syntax:
* $array = array_csort($array [, 'col1' [, SORT_FLAG [, SORT_FLAG]]]...);
**/
function array_csort() {
   $args = func_get_args();
   $marray = array_shift($args);

   $msortline = "return(array_multisort(";
   foreach ($args as $arg) {
       $i++;
       if (is_string($arg)) {
           foreach ($marray as $row) {
               $sortarr[$i][] = $row[$arg];
           }
       } else {
           $sortarr[$i] = $arg;
       }
       $msortline .= "\$sortarr[".$i."],";
   }
   $msortline .= "\$marray));";

   eval($msortline);
   return $marray;
}

function cpg_get_bridge_db_values() {
global $CONFIG;
// Retrieve DB stored configuration
$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_BRIDGE']}");
while ($row = mysql_fetch_array($results)) {
    $BRIDGE[$row['name']] = $row['value'];
} // while
mysql_free_result($results);
return $BRIDGE;
}

function cpg_get_webroot_path() {
    //global $PHP_SELF;
    // get the webroot folder out of a given PHP_SELF of any coppermine page

    // what we have: we can say for sure where we are right now: $PHP_SELF (if the server doesn't even have it, there will be problems everywhere anyway)

    // let's make those into an array:
    $path_from_serverroot[] = $_SERVER["SCRIPT_FILENAME"];
    $path_from_serverroot[] = $_SERVER["PATH_TRANSLATED"];
    $path_from_serverroot[] = $HTTP_SERVER_VARS["SCRIPT_FILENAME"];
    $path_from_serverroot[] = $HTTP_SERVER_VARS["PATH_TRANSLATED"];
    // for debugging: add some vars that actually don't exist, just to test the script
    //$path_from_serverroot[] = '/foo/bar/coppermine/';
    //$path_from_serverroot[] = '';
    //$path_from_serverroot[] = '/foo/bar/public_html/coppermine/testpath.php';

    // we should be able to tell the current script's filename by removing everything before and including the last slash in $PHP_SELF
    $filename = ltrim(strrchr($_SERVER['PHP_SELF'], '/'), '/');
    //print 'filename:'.$filename;
    //print "<hr />\n";
    //print '$PHP_SELF:'.$_SERVER['PHP_SELF'];
    //print "<hr />\n";

    // let's eliminate all those vars that don't contain the filename (and replace the funny notation from windows machines)
    foreach($path_from_serverroot as $key) {
        $key = str_replace('\\\\', '/', $key); // replace the windows notation
        if(strstr($key, $filename) != FALSE) { // eliminate all that don't contain the filename
            $path_from_serverroot2[] = $key;
        }
    }

    // remove double entries in the array
    $path_from_serverroot3 = array_unique($path_from_serverroot2);

    // in the best of all worlds, the array is not empty
    if (is_array($path_from_serverroot3)) {
        $counter = 0;
        foreach($path_from_serverroot3 as $key) {
            // easiest possible solution: $PHP_SELF is contained in the array - if yes, we're lucky (in fact we could have done this before, but I was going to leave room for other checks to be inserted before this one)
            if(strstr($key, $_SERVER['PHP_SELF']) != FALSE) { // eliminate all that don't contain $PHP_SELF
                $path_from_serverroot4[] = $key;
                $counter++;
            }
        }
    } else {
        // we're f***ed: the array is empty, there's no server var we could actually use
        $return = '';
    }

    if ($counter == 1) { //we have only one entry left - we're happy
        $return = $path_from_serverroot4[0];
    } elseif ($counter == 0) { // we're f***ed: the array is empty, there's no server var we could actually use
        $return = '';
    } else { // there is more than one entry, and they differ. For now, let's use the first one. Maybe we could do some advanced checking later
        $return = $path_from_serverroot4[0];
    }

    // strip the content from $PHP_SELF from the $return var and we should (hopefully) have the absolute path to the webroot
    $return = str_replace($_SERVER['PHP_SELF'], '', $return);

    // the return var should at least contain a slash - if it doesn't, add it (although this is more or less wishfull thinking)
    if ($return == '') {
        $return = '/';
    }

    return $return;
}

/**
 * Function to get the search string if the picture is viewed from google, lucos or yahoo search engine
 */

function get_search_query_terms($engine = 'google') {
  global $s, $s_array;
  $referer = urldecode($_SERVER[HTTP_REFERER]);
  $query_array = array();
  switch ($engine) {
    case 'google':
      // Google query parsing code adapted from Dean Allen's
      // Google Hilite 0.3. http://textism.com
      $query_terms = preg_replace('/^.*q=([^&]+)&?.*$/i','$1', $referer);
      $query_terms = preg_replace('/\'|"/', '', $query_terms);
      $query_array = preg_split ("/[\s,\+\.]+/", $query_terms);
      break;
  
    case 'lycos':
      $query_terms = preg_replace('/^.*query=([^&]+)&?.*$/i','$1', $referer);
      $query_terms = preg_replace('/\'|"/', '', $query_terms);
      $query_array = preg_split ("/[\s,\+\.]+/", $query_terms);
      break;
  
    case 'yahoo':
      $query_terms = preg_replace('/^.*p=([^&]+)&?.*$/i','$1', $referer);
      $query_terms = preg_replace('/\'|"/', '', $query_terms);
      $query_array = preg_split ("/[\s,\+\.]+/", $query_terms);
      break;
  }
  return $query_array;
}


function is_referer_search_engine($engine = 'google') {
  //$siteurl = get_settings('home');
  $referer = urldecode($_SERVER['HTTP_REFERER']);
    //echo "referer is: $referer<br />";
  if ( ! $engine ) {
    return 0;
  }

  switch ($engine) {
  case 'google':
    if (preg_match('|^http://(www)?\.?google.*|i', $referer)) {
      return 1;
    }
    break;

    case 'lycos':
    if (preg_match('|^http://search\.lycos.*|i', $referer)) {
      return 1;
    }
        break;

    case 'yahoo':
    if (preg_match('|^http://search\.yahoo.*|i', $referer)) {
      return 1;
    }
    break;
  }
  return 0;
}

?>
